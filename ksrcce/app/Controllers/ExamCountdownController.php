<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\ExamCountdown;

class ExamCountdownController extends Controller {
    
    public function __construct() {
        parent::__construct();
        // Require authentication for all countdown actions
        if (!isset($_SESSION['user'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            exit;
        }
    }
    
    public function index() {
        // Only admins can manage countdowns
        if ($_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(['error' => 'Forbidden']);
            exit;
        }
        
        $countdownModel = new ExamCountdown($this->db);
        $countdowns = $countdownModel->getAll();
        
        $this->view('admin/exam-countdowns.php', [
            'countdowns' => $countdowns
        ]);
    }
    
    public function create() {
        // Only admins can create countdowns
        if ($_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(['error' => 'Forbidden']);
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            exit;
        }
        
        $data = json_decode(file_get_contents('php://input'), true);
        $examName = $data['exam_name'] ?? '';
        $examDate = $data['exam_date'] ?? '';
        $examTime = $data['exam_time'] ?? '09:00:00';
        $description = $data['description'] ?? null;
        $targetAudience = $data['target_audience'] ?? 'all';
        
        if (empty($examName) || empty($examDate)) {
            http_response_code(400);
            echo json_encode(['error' => 'Exam name and date are required']);
            exit;
        }
        
        $countdownModel = new ExamCountdown($this->db);
        $success = $countdownModel->create($examName, $examDate, $examTime, $description, $targetAudience);
        
        header('Content-Type: application/json');
        echo json_encode(['success' => $success]);
    }
    
    public function update() {
        // Only admins can update countdowns
        if ($_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(['error' => 'Forbidden']);
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            exit;
        }
        
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? null;
        $examName = $data['exam_name'] ?? '';
        $examDate = $data['exam_date'] ?? '';
        $examTime = $data['exam_time'] ?? '09:00:00';
        $description = $data['description'] ?? null;
        $targetAudience = $data['target_audience'] ?? 'all';
        $isActive = $data['is_active'] ?? true;
        
        if (!$id || empty($examName) || empty($examDate)) {
            http_response_code(400);
            echo json_encode(['error' => 'ID, exam name and date are required']);
            exit;
        }
        
        $countdownModel = new ExamCountdown($this->db);
        $success = $countdownModel->update($id, $examName, $examDate, $examTime, $description, $targetAudience, $isActive);
        
        header('Content-Type: application/json');
        echo json_encode(['success' => $success]);
    }
    
    public function delete() {
        // Only admins can delete countdowns
        if ($_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(['error' => 'Forbidden']);
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            exit;
        }
        
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? null;
        
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'ID is required']);
            exit;
        }
        
        $countdownModel = new ExamCountdown($this->db);
        $success = $countdownModel->delete($id);
        
        header('Content-Type: application/json');
        echo json_encode(['success' => $success]);
    }
    
    public function toggle() {
        // Only admins can toggle countdowns
        if ($_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(['error' => 'Forbidden']);
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            exit;
        }
        
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? null;
        
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'ID is required']);
            exit;
        }
        
        $countdownModel = new ExamCountdown($this->db);
        $success = $countdownModel->toggleStatus($id);
        
        header('Content-Type: application/json');
        echo json_encode(['success' => $success]);
    }
    
    public function getCountdowns() {
        // Get countdowns for current user role
        $targetAudience = $_SESSION['user']['role'] === 'admin' ? 'admins' : 'students';
        $countdownModel = new ExamCountdown($this->db);
        $countdowns = $countdownModel->getAllCountdownData($targetAudience);
        
        header('Content-Type: application/json');
        echo json_encode(['countdowns' => $countdowns]);
    }
    
    public function getCountdown($id) {
        $countdownModel = new ExamCountdown($this->db);
        $countdown = $countdownModel->getCountdownData($id);
        
        if (!$countdown) {
            http_response_code(404);
            echo json_encode(['error' => 'Countdown not found']);
            exit;
        }
        
        header('Content-Type: application/json');
        echo json_encode(['countdown' => $countdown]);
    }
}
?>
