<?php
namespace App\Controllers;

use App\Models\Question;
use App\Models\Exam;

use App\Core\Controller;

class QuestionController extends Controller {
    private $questionModel;
    // private $db; // inherited from Controller

    public function __construct() {
        parent::__construct();
        $this->questionModel = new Question($this->db);
        
        // Ensure user is admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login');
            exit;
        }
    }

    /**
     * Show the add question form
     */
    public function showAddQuestionForm() {
        // This method just displays the form
        // The actual form handling is done by JavaScript
        $this->view('admin/add_question.php');
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
                $result = $this->questionModel->create([
                    'exam_id' => $examId,
                    'question_text' => $questionData['text'],
                    'options' => $questionData['options'],
                    'correct_answer' => $questionData['answer'],
                    'explanation' => $questionData['explanation'] ?? '',
                    'question_image' => $questionData['image'] ?? null
                ]);

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
     * Handle individual question creation with image upload
     * Endpoint: POST /api/questions/create
     */
    public function createQuestion() {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method not allowed']);
            return;
        }

        $examId = $_POST['exam_id'] ?? null;
        $questionText = $_POST['question_text'] ?? '';
        $options = json_decode($_POST['options'] ?? '[]', true);
        $correctAnswer = $_POST['correct_answer'] ?? 0;
        $explanation = $_POST['explanation'] ?? '';

        // Validate required fields
        if (!$examId || !$questionText || empty($options)) {
            echo json_encode(['success' => false, 'message' => 'Missing required fields']);
            return;
        }

        try {
            $questionImage = null;
            
            // Handle image upload
            if (isset($_FILES['question_image']) && $_FILES['question_image']['error'] === UPLOAD_ERR_OK) {
                $questionImage = $this->questionModel->uploadQuestionImage($_FILES['question_image']);
            }

            // Create question
            $result = $this->questionModel->create([
                'exam_id' => $examId,
                'question_text' => $questionText,
                'options' => $options,
                'correct_answer' => $correctAnswer,
                'explanation' => $explanation,
                'question_image' => $questionImage
            ]);

            if ($result) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Question created successfully',
                    'question_id' => $result,
                    'image_url' => $questionImage
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to create question']);
            }
        } catch (\Exception $e) {
            error_log('Error creating question: ' . $e->getMessage());
            echo json_encode([
                'success' => false,
                'message' => 'Error creating question: ' . $e->getMessage()
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
                    'id' => (string)($exam['id'] ?? $exam['_id'] ?? ''),
                    'title' => $exam['title'] ?? '',
                    'subject' => $exam['category'] ?? $exam['subject'] ?? '',
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
