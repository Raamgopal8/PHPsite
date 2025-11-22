<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Attempt;
use App\Models\User;

class ExamController extends Controller {
    private $examModel;
    private $questionModel;
    private $attemptModel;
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->examModel = new Exam($this->db);
        $this->questionModel = new Question($this->db);
        $this->attemptModel = new Attempt($this->db);
        $this->userModel = new User($this->db);
        
        // Check if user is logged in
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
        
        // Get current route
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Define admin-only routes
        $adminRoutes = [
            '/admin/dashboard',
            '/admin/exams/create',
            '/admin/questions/add',
            // Add other admin routes here
        ];
        
        // Check if current route is admin-only and user is not admin
        foreach ($adminRoutes as $adminRoute) {
            if (strpos($uri, $adminRoute) === 0 && $_SESSION['user']['role'] !== 'admin') {
                $_SESSION['flash']['error'] = 'Access denied. Admin privileges required.';
                header('Location: /');
                exit;
            }
        }
    }

    // Admin: List all exams
    public function index() {
        $exams = $this->examModel->all();
        $this->view('admin/exams.php', [
            'exams' => $exams
        ]);
    }

    // Show exam creation form with question management
    public function createForm() {
        $this->view('admin/exams_create', [
            'title' => 'Create New Exam',
            'exam' => null,
            'questions' => []
        ]);
    }

    // Handle exam creation
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Start transaction if your DB supports it
                
                // Create exam
                $examData = [
                    'title' => $_POST['title'],
                    'category' => $_POST['category'],
                    'duration' => (int)$_POST['duration'],
                    'passing_score' => isset($_POST['passing_score']) ? (int)$_POST['passing_score'] : 60,
                    'status' => 'draft',
                    'created_at' => date('c'),
                    'updated_at' => date('c')
                ];

                $examId = $this->examModel->create($examData);

                // Handle questions if any
                if (isset($_POST['questions']) && is_array($_POST['questions'])) {
                    $this->saveQuestions($examId, $_POST['questions']);
                }

                $_SESSION['flash']['success'] = 'Exam created successfully!';
                header('Location: /admin/exams/edit/' . $examId);
                exit;

            } catch (\Exception $e) {
                $_SESSION['flash']['error'] = 'Error creating exam: ' . $e->getMessage();
                $this->view('admin/exams_create', [
                    'title' => 'Create New Exam',
                    'exam' => $_POST,
                    'questions' => $_POST['questions'] ?? []
                ]);
            }
        } else {
            $this->createForm();
        }
    }

    // Save questions for an exam
    private function saveQuestions($examId, $questions) {
        foreach ($questions as $questionData) {
            if (empty($questionData['text']) || empty($questionData['options'])) continue;
            
            $question = [
                'exam_id' => $examId,
                'text' => $questionData['text'],
                'options' => $questionData['options'],
                'answer' => (int)$questionData['answer'],
                'explanation' => $questionData['explanation'] ?? '',
                'created_at' => date('c')
            ];
            
            $this->questionModel->create($question);
        }
    }

    // Edit exam form
    public function edit($examId = null) {
        $examId = $examId ?? $_GET['id'] ?? null;
        if (!$examId) {
            $_SESSION['flash']['error'] = 'Exam ID missing';
            header('Location: /admin/exams');
            exit;
        }

        $exam = $this->examModel->findById($examId);
        if (!$exam) {
            $_SESSION['flash']['error'] = 'Exam not found';
            header('Location: /admin/exams');
            exit;
        }

        $questions = $this->questionModel->findByExam($examId);
        
        $this->view('admin/exams_create', [
            'title' => 'Edit Exam: ' . $exam['title'],
            'exam' => $exam,
            'questions' => $questions
        ]);
    }

    // Update exam
    public function update($examId = null) {
        $examId = $examId ?? $_POST['id'] ?? $_GET['id'] ?? null;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                if (!$examId) {
                    throw new \Exception('Exam ID missing');
                }

                $examData = [
                    'title' => $_POST['title'],
                    'category' => $_POST['category'],
                    'duration' => (int)$_POST['duration'],
                    'passing_score' => isset($_POST['passing_score']) ? (int)$_POST['passing_score'] : 60,
                    'updated_at' => date('c')
                ];

                $this->examModel->update($examId, $examData);

                // Handle questions
                if (isset($_POST['questions']) && is_array($_POST['questions'])) {
                    // First delete existing questions
                    $this->questionModel->deleteByExam($examId);
                    // Then save new ones
                    $this->saveQuestions($examId, $_POST['questions']);
                }

                $_SESSION['flash']['success'] = 'Exam updated successfully!';
                header('Location: /admin/exams');
                exit;

            } catch (\Exception $e) {
                $_SESSION['flash']['error'] = 'Error updating exam: ' . $e->getMessage();
                $this->view('admin/exams_create', [
                    'title' => 'Edit Exam',
                    'exam' => array_merge(['id' => $examId], $_POST),
                    'questions' => $_POST['questions'] ?? []
                ]);
            }
        } else {
            $this->edit($examId);
        }
    }

    // Delete exam
    public function delete($examId = null) {
        $examId = $examId ?? $_GET['id'] ?? null;
        if (!$examId) {
            $_SESSION['flash']['error'] = 'Exam ID missing';
            header('Location: /admin/exams');
            exit;
        }

        try {
            // Delete questions first (if not handled by FK cascade)
            $this->questionModel->deleteByExam($examId);
            
            // Delete exam
            $this->examModel->delete($examId);
            
            $_SESSION['flash']['success'] = 'Exam deleted successfully';
        } catch (\Exception $e) {
            $_SESSION['flash']['error'] = 'Error deleting exam: ' . $e->getMessage();
        }
        
        header('Location: /admin/exams');
        exit;
    }

    public function studentDashboard() {
        // require login
        if (!isset($_SESSION['user'])) header('Location: /login');
        $db = $this->db;
        $exams = $this->examModel->all();
        $this->view('student/dashboard.php', ['exams' => $exams, 'user' => $_SESSION['user']]);
    }

    public function listExams() {
        $db = $this->db;
        $exams = $this->examModel->all();
        $this->view('student/exams.php', ['exams' => $exams]);
    }

    public function takeExam() {
        $db = $this->db;
        $examId = $_GET['id'] ?? null;
        if (!$examId) {
            echo "Exam id missing.";
            return;
        }
        $examModel = new Exam($db);
        $questionModel = new Question($db);
        $exam = $examModel->find(['id' => $examId]) ?: $examModel->find(['id' => ['$eq' => $examId]]);
        // If your _id is stored as string, the first find works. If using ObjectId, adjust accordingly.
        $questions = $questionModel->findByExam($examId);
        $this->view('student/take_exam.php', ['exam' => $exam, 'questions' => $questions]);
    }
    
    public function submitExam() {
        $db = $this->db;
        $user = $_SESSION['user'] ?? null;
        if (!$user) { $this->redirect('/login'); }
        
        // Get user ID with fallback support for both old (_id) and new (id) session formats
        $userId = $user['id'] ?? $user['_id'] ?? null;
        
        // If still no valid user ID, fetch from database
        if (empty($userId) && !empty($user['email'])) {
            $userModel = new User($db);
            $dbUser = $userModel->findByEmail($user['email']);
            if ($dbUser) {
                $userId = $dbUser['id'];
                // Update session with correct ID
                $_SESSION['user']['id'] = $userId;
            }
        }
        
        // Validate we have a user ID
        if (empty($userId)) {
            $_SESSION['flash']['error'] = "Session error. Please log in again.";
            $this->redirect('/login');
            return;
        }
        
        $answers = $_POST['answers'] ?? [];
        $examId = $_POST['exam_id'] ?? null;
        $qModel = new Question($db);
        $attemptModel = new Attempt($db);

        // compute score
        $score = 0;
        foreach ($answers as $qId => $ans) {
            $q = $qModel->find(['id' => $qId]);
            if ($q && isset($q['correct_answer'])) {
                if ((string)$q['correct_answer'] === (string)$ans) $score += 1;
            }
        }

        $attemptModel->createAttempt($userId, $examId, $answers, $score);

        // update streak simple logic
        $userModel = new User($db);
        $u = $userModel->find(['id' => $userId]);
        if ($u) {
            $streak = ($u['streak'] ?? 0) + 1;
            $userModel->update(['id' => $u['id']], ['streak' => $streak]);
        }

        $_SESSION['flash']['success'] = "Exam submitted. Score: {$score}";
        $this->redirect('/student/dashboard');
    }
    
   public function parseQuestions() {
    // Ensure no output has been sent
    if (headers_sent()) {
        error_log('Headers already sent in ' . __FILE__ . ' on line ' . __LINE__);
        exit('Headers already sent');
    }
    
    // Set headers first to ensure proper JSON response
    header('Content-Type: application/json; charset=utf-8');
    
    // Create response array
    $response = [
        'success' => false,
        'message' => '',
        'questions' => []
    ];
    
    // Enable output buffering
    ob_start();
    
    try {
        // Enable error reporting for debugging
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        // Log the request
        error_log('Starting file upload processing');
    
        // Debug: Log the incoming request
        error_log('File upload request received: ' . print_r($_FILES, true));
        
        // Check if file was uploaded
        if (!isset($_FILES['file'])) {
            throw new Exception('No file was uploaded.');
        }
        
        $file = $_FILES['file'];
        
        // Check for upload errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $error = $this->getUploadError($file['error']);
            error_log('File upload error: ' . $error);
            throw new Exception('File upload error: ' . $error);
        }
        
        // Check file size (max 10MB)
        $maxFileSize = 10 * 1024 * 1024; // 10MB
        if ($file['size'] > $maxFileSize) {
            throw new Exception('File is too large. Maximum size allowed is 10MB.');
        }
        
        // Check file type
        $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
        $fileType = mime_content_type($file['tmp_name']);
        
        if (!in_array($fileType, $allowedTypes)) {
            throw new Exception('Invalid file type. Please upload a PDF, JPG, or PNG file.');
        }

        $file = $_FILES['file'];
        $fileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        // Debug: Log file info
        error_log('Processing file: ' . $file['name'] . ', type: ' . $fileType);
        
        $text = '';

        // Check if required classes exist
        if ($fileType === 'pdf' && !class_exists('\Smalot\PdfParser\Parser')) {
            throw new Exception('PDF Parser library not found. Run: composer require smalot/pdfparser');
        } 
        else if (in_array($fileType, ['jpg', 'jpeg', 'png']) && !class_exists('\thiagoalessio\TesseractOCR\TesseractOCR')) {
            throw new Exception('Tesseract OCR library not found. Run: composer require thiagoalessio/tesseract_ocr');
        }

        // Handle PDF files
        if (strpos($fileType, 'pdf') !== false) {
            if (!class_exists('\Smalot\PdfParser\Parser')) {
                throw new Exception('PDF Parser library is not installed. Please run: composer require smalot/pdfparser');
            }
            
            try {
                $parser = new \Smalot\PdfParser\Parser();
                $pdf = $parser->parseFile($file['tmp_name']);
                $text = $pdf->getText();
                
                if (empty(trim($text))) {
                    throw new Exception('The PDF appears to be empty or the text could not be extracted.');
                }
                
            } catch (\Exception $e) {
                throw new Exception('Error parsing PDF: ' . $e->getMessage());
            }
        } 
        // Handle image files
        else if (strpos($fileType, 'jpeg') !== false || strpos($fileType, 'png') !== false) {
            if (!class_exists('\thiagoalessio\TesseractOCR\TesseractOCR')) {
                throw new Exception('Tesseract OCR is not installed. Please run: composer require thiagoalessio/tesseract_ocr');
            }
            
            try {
                $tesseract = new \thiagoalessio\TesseractOCR\TesseractOCR($file['tmp_name']);
                $text = $tesseract->run();
                
                if (empty(trim($text))) {
                    throw new Exception('No text could be extracted from the image.');
                }
                
            } catch (\Exception $e) {
                throw new Exception('Error processing image: ' . $e->getMessage());
            }
        }

        // Debug: Log extracted text
        error_log('Extracted text: ' . substr($text, 0, 200) . '...');

        $questions = $this->parseTextToQuestions($text);
        
        $response['success'] = true;
        $response['questions'] = $questions;
        
        // Clear any previous output
        if (ob_get_level() > 0) {
            ob_clean();
        }
        
        // Encode and output the response
        $jsonResponse = json_encode($response);
        if ($jsonResponse === false) {
            throw new \Exception('Failed to encode JSON: ' . json_last_error_msg());
        }
        
        echo $jsonResponse;
    } catch (\Exception $e) {
        // Clear any previous output
        if (ob_get_level() > 0) {
            ob_clean();
        }
        
        http_response_code(400);
        error_log('Error in parseQuestions: ' . $e->getMessage());
        
        $response['success'] = false;
        $response['message'] = $e->getMessage();
        
        // Only include trace in debug mode
        if (ini_get('display_errors')) {
            $response['trace'] = $e->getTraceAsString();
        }
        
        $jsonResponse = json_encode($response);
        if ($jsonResponse === false) {
            $jsonResponse = json_encode([
                'success' => false,
                'message' => 'An error occurred and we couldn\'t generate a proper error message.'
            ]);
        }
        
        // Clean any previous output and send the response
        if (ob_get_level() > 0) {
            ob_end_clean();
        }
        
        // Set headers and output the response
        header('Content-Type: application/json');
        echo $jsonResponse;
        exit;
    } catch (\Exception $e) {
        // Clean any previous output
        if (ob_get_level() > 0) {
            ob_end_clean();
        }
        
        // Log the error
        error_log('Error in parseQuestions: ' . $e->getMessage());
        
        // Return error response
        header('Content-Type: application/json');
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'An error occurred while processing the file: ' . $e->getMessage(),
            'error' => $e->getMessage(),
            'trace' => DEBUG_MODE ? $e->getTraceAsString() : null
        ]);
        exit;
    }
}

private function getUploadError($errorCode) {
    $errors = [
        UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded',
        UPLOAD_ERR_NO_FILE => 'No file was uploaded',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
        UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload',
    ];
    return $errors[$errorCode] ?? "Unknown upload error (Code: $errorCode)";
}

private function parseTextToQuestions($text) {
    // Split text into lines and filter out empty ones
    $lines = array_filter(array_map('trim', explode("\n", $text)));
    $questions = [];
    $currentQuestion = null;
    $currentOptions = [];
    $correctAnswers = [];
    
    // Expected format:
    // 1. Question text
    // A) Option 1
    // B) Option 2
    // C) Option 3
    // D) Option 4
    // Answer: A
    
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line)) continue;
        
        // Check for question (starts with number followed by a dot or parenthesis)
        if (preg_match('/^(\d+)[.)]\s*(.+)/', $line, $matches)) {
            // Save previous question if exists
            if ($currentQuestion !== null) {
                $questions[] = [
                    'text' => $currentQuestion,
                    'options' => $currentOptions,
                    'answer' => $correctAnswers
                ];
            }
            
            // Start new question
            $currentQuestion = $matches[2];
            $currentOptions = [];
            $correctAnswers = [];
        } 
        // Check for option (starts with a letter followed by a dot/parenthesis)
        elseif (preg_match('/^([A-Z])[.)]\s*(.+)/', $line, $matches)) {
            $currentOptions[$matches[1]] = $matches[2];
        } 
        // Check for answer line
        elseif (preg_match('/^answer\s*[:.]?\s*([A-Z])(?:\s*,\s*([A-Z]))*/i', $line, $matches, PREG_OFFSET_CAPTURE)) {
            // Get all answer letters (supports multiple correct answers)
            $answerPart = substr($line, $matches[0][1] + strlen($matches[0][0]));
            $answerLetters = [];
            
            // Add the first answer
            $answerLetters[] = strtoupper($matches[1][0]);
            
            // Check for additional answers
            if (preg_match_all('/[A-Z]/i', $answerPart, $additionalMatches)) {
                foreach ($additionalMatches[0] as $letter) {
                    $answerLetters[] = strtoupper($letter);
                }
            }
            
            $correctAnswers = array_unique($answerLetters);
        }
        // If line doesn't match any pattern, append to the last element
        elseif ($currentQuestion !== null) {
            if (empty($currentOptions)) {
                // Append to question text if no options yet
                $currentQuestion .= ' ' . $line;
            } else {
                // Append to the last option
                end($currentOptions);
                $lastKey = key($currentOptions);
                $currentOptions[$lastKey] .= ' ' . $line;
            }
        }
    }
    
    // Add the last question if exists
    if ($currentQuestion !== null) {
        $questions[] = [
            'text' => $currentQuestion,
            'options' => $currentOptions,
            'answer' => $correctAnswers
        ];
    }
    
    return $questions;
}
    
    public function showGatepage(){
        if(!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['student', 'admin'])){ header('Location: /login'); exit; }
        $this->view('student/gate.php');
    }

    public function showTnspcpage(){
        if(!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['student', 'admin'])){ header('Location: /login'); exit; }
        $this->view('student/tnpsc.php');
    }

    public function showCSEPage(){
        if(!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['student', 'admin'])){ header('Location: /login'); exit; }
        
        
        $this->view('student/cse.php');
    }

    public function showECEPage(){
        if(!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['student', 'admin'])){ header('Location: /login'); exit; }
        $this->view('student/ece.php');
    }

    public function showMECHPage(){
        if(!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['student', 'admin'])){ header('Location: /login'); exit; }
        $this->view('student/mech.php');
    }

    public function showEEPage(){
        if(!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['student', 'admin'])){ header('Location: /login'); exit; }
        $this->view('student/ee.php');
    }

    public function showCIVILPage(){
        if(!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['student', 'admin'])){ header('Location: /login'); exit; }
        $this->view('student/civil.php');
    }
    
    public function showGroup1Page(){
        if(!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['student', 'admin'])){ header('Location: /login'); exit; }
        $this->view('student/group1.php');
    }

    public function showGroup2Page(){
        if(!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['student', 'admin'])){ header('Location: /login'); exit; }
        $this->view('student/group2.php');
    }

    public function showGroup4Page(){
        if(!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['student', 'admin'])){ header('Location: /login'); exit; }
        $this->view('student/group4.php');
    }

    


}
