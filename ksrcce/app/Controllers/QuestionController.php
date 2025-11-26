<?php
namespace App\Controllers;

use App\Models\Question;
use App\Models\Exam;

class QuestionController extends BaseController {
    private $questionModel;
    private $db;

    public function __construct($db) {
        $this->db = $db;
        $this->questionModel = new Question($this->db);
        
        // Ensure user is admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login');
            exit;
        }
    }

    /**
     * Handle text file upload and parse questions
     */
    public function handleTextFileUpload() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method not allowed']);
            return;
        }

        $examId = $_POST['exam_id'] ?? null;

        // Validate file upload
        if (!isset($_FILES['text_file']) || $_FILES['text_file']['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(['success' => false, 'message' => 'No file uploaded']);
            return;
        }

        $file = $_FILES['text_file'];

        // Validate file type
        $allowedTypes = ['text/plain'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mimeType, $allowedTypes)) {
            echo json_encode(['success' => false, 'message' => 'Invalid file type. Only .txt files allowed']);
            return;
        }

        // Validate file size (5MB max)
        if ($file['size'] > 5 * 1024 * 1024) {
            echo json_encode(['success' => false, 'message' => 'File too large. Maximum 5MB allowed']);
            return;
        }

        // Read file content
        $content = file_get_contents($file['tmp_name']);

        if (empty($content)) {
            echo json_encode(['success' => false, 'message' => 'File is empty']);
            return;
        }

        try {
            // Parse and save questions
            $savedIds = $this->questionModel->parseAndSaveFromText($content, $examId);

            echo json_encode([
                'success' => true,
                'message' => 'Questions uploaded successfully',
                'saved_count' => count($savedIds),
                'question_ids' => $savedIds
            ]);
        } catch (\Exception $e) {
            error_log('Error saving questions: ' . $e->getMessage());
            echo json_encode([
                'success' => false,
                'message' => 'Error saving questions: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Save already parsed questions from frontend
     * Endpoint: POST /api/questions/save-parsed
     */
    public function saveParsedQuestions() {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method not allowed']);
            return;
        }

        // Get JSON input
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['questions']) || !is_array($input['questions'])) {
            echo json_encode(['success' => false, 'message' => 'Invalid request data']);
            return;
        }

        $examId = $input['exam_id'] ?? null;
        $questions = $input['questions'];
        $savedIds = [];

        try {
            foreach ($questions as $questionData) {
                // Validate question data
                if (!isset($questionData['text']) || 
                    !isset($questionData['options']) || 
                    !isset($questionData['answer'])) {
                    continue;
                }

                // Create question
                $result = $this->questionModel->createQuestion(
                    $examId,
                    $questionData['text'],
                    $questionData['options'],
                    $questionData['answer'],
                    $questionData['explanation'] ?? ''
                );

                if ($result) {
                    $savedIds[] = (string)$result;
                }
            }

            echo json_encode([
                'success' => true,
                'message' => 'Questions saved successfully',
                'saved_count' => count($savedIds),
                'question_ids' => $savedIds
            ]);
        } catch (\Exception $e) {
            error_log('Error saving parsed questions: ' . $e->getMessage());
            echo json_encode([
                'success' => false,
                'message' => 'Error saving questions: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Get all exams for dropdown
     * Endpoint: GET /api/exams
     */
    public function getExams() {
        header('Content-Type: application/json');

        try {
            $examModel = new Exam($this->db);
            $exams = $examModel->findAll();

            $examList = [];
            foreach ($exams as $exam) {
                $examList[] = [
                    'id' => (string)$exam['_id'],
                    'title' => $exam['title'],
                    'subject' => $exam['subject'] ?? '',
                    'duration' => $exam['duration'] ?? 0
                ];
            }

            echo json_encode([
                'success' => true,
                'exams' => $examList
            ]);
        } catch (\Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Error fetching exams: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Parse questions from text content
     * Endpoint: POST /api/questions/parse
     */
    public function parseQuestions() {
        header('Content-Type: application/json');
        
        // Get JSON input
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (empty($input['content'])) {
            echo json_encode([
                'success' => false,
                'message' => 'No content provided'
            ]);
            return;
        }
        
        try {
            $questionModel = new Question($this->db);
            $questions = $questionModel->parseQuestionsFromText($input['content']);
            
            echo json_encode([
                'success' => true,
                'questions' => $questions,
                'count' => count($questions)
            ]);
        } catch (\Exception $e) {
            error_log('Error parsing questions: ' . $e->getMessage());
            echo json_encode([
                'success' => false,
                'message' => 'Error parsing questions: ' . $e->getMessage()
            ]);
        }
    }
}
