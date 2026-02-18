<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Achievement;

class AchievementController extends Controller {
    
    public function __construct() {
        parent::__construct();
        // Require authentication for all achievement actions
        if (!isset($_SESSION['user'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            exit;
        }
    }
    
    public function index() {
        // Only admins can manage achievements
        if ($_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(['error' => 'Forbidden']);
            exit;
        }
        
        $page = $_GET['page'] ?? 1;
        $limit = 20;
        $offset = ($page - 1) * $limit;
        
        $achievementModel = new Achievement($this->db);
        $achievements = $achievementModel->getAll($limit, $offset);
        $totalCount = $achievementModel->getTotalCount();
        $totalPages = ceil($totalCount / $limit);
        
        $this->view('admin/achievements.php', [
            'achievements' => $achievements,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalCount' => $totalCount
        ]);
    }
    
    public function create() {
        // Only admins can create achievements
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
        
        $achievementModel = new Achievement($this->db);
        
        try {
            $studentName = $_POST['student_name'] ?? '';
            $examName = $_POST['exam_name'] ?? '';
            $rankOrScore = $_POST['rank_or_score'] ?? '';
            $description = $_POST['achievement_description'] ?? null;
            $batchYear = $_POST['batch_year'] ?? null;
            $department = $_POST['department'] ?? null;
            $isFeatured = isset($_POST['is_featured']);
            
            if (empty($studentName) || empty($examName) || empty($rankOrScore)) {
                throw new \Exception('Student name, exam name, and rank/score are required');
            }
            
            // Handle image upload
            $imageUrl = null;
            if (isset($_FILES['achievement_image'])) {
                $fileError = $_FILES['achievement_image']['error'];
                if ($fileError === UPLOAD_ERR_OK) {
                    $imageUrl = $achievementModel->uploadImage($_FILES['achievement_image']);
                } elseif ($fileError !== UPLOAD_ERR_NO_FILE) {
                    // unexpected error
                    throw new \Exception('File upload failed with error code: ' . $fileError);
                }
            }
            
            $success = $achievementModel->create(
                $studentName,
                $examName,
                $rankOrScore,
                $description,
                $imageUrl,
                $batchYear,
                $department,
                $isFeatured
            );
            
            if ($success) {
                $_SESSION['flash']['success'] = 'Achievement added successfully!';
            } else {
                $_SESSION['flash']['error'] = 'Failed to add achievement';
            }
            
        } catch (\Exception $e) {
            $_SESSION['flash']['error'] = $e->getMessage();
        }
        
        $this->redirect('/admin/achievements');
    }
    
    public function update() {
        // Only admins can update achievements
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
        
        $achievementModel = new Achievement($this->db);
        
        try {
            $id = $_POST['id'] ?? null;
            $studentName = $_POST['student_name'] ?? '';
            $examName = $_POST['exam_name'] ?? '';
            $rankOrScore = $_POST['rank_or_score'] ?? '';
            $description = $_POST['achievement_description'] ?? null;
            $batchYear = $_POST['batch_year'] ?? null;
            $department = $_POST['department'] ?? null;
            $isFeatured = isset($_POST['is_featured']);
            $isActive = isset($_POST['is_active']);
            
            if (!$id || empty($studentName) || empty($examName) || empty($rankOrScore)) {
                throw new \Exception('ID, student name, exam name, and rank/score are required');
            }
            
            // Get existing achievement to handle image
            $existing = $achievementModel->getById($id);
            $imageUrl = $existing['image_url'] ?? null;
            
            // Handle new image upload
            if (isset($_FILES['achievement_image'])) {
                $fileError = $_FILES['achievement_image']['error'];
                if ($fileError === UPLOAD_ERR_OK) {
                    // Delete old image if exists
                    if ($imageUrl) {
                        $achievementModel->deleteImage($imageUrl);
                    }
                    $imageUrl = $achievementModel->uploadImage($_FILES['achievement_image']);
                } elseif ($fileError !== UPLOAD_ERR_NO_FILE) {
                    throw new \Exception('File upload failed with error code: ' . $fileError);
                }
            }
            
            $success = $achievementModel->update(
                $id,
                $studentName,
                $examName,
                $rankOrScore,
                $description,
                $imageUrl,
                $batchYear,
                $department,
                $isFeatured,
                $isActive
            );
            
            if ($success) {
                $_SESSION['flash']['success'] = 'Achievement updated successfully!';
            } else {
                $_SESSION['flash']['error'] = 'Failed to update achievement';
            }
            
        } catch (\Exception $e) {
            $_SESSION['flash']['error'] = $e->getMessage();
        }
        
        $this->redirect('/admin/achievements');
    }
    
    public function delete() {
        // Only admins can delete achievements
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
        
        $achievementModel = new Achievement($this->db);
        
        // Get achievement to delete associated image
        $achievement = $achievementModel->getById($id);
        if ($achievement && $achievement['image_url']) {
            $achievementModel->deleteImage($achievement['image_url']);
        }
        
        $success = $achievementModel->delete($id);
        
        header('Content-Type: application/json');
        echo json_encode(['success' => $success]);
    }
    
    public function toggleStatus() {
        // Only admins can toggle achievements
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
        
        $achievementModel = new Achievement($this->db);
        $success = $achievementModel->toggleStatus($id);
        
        header('Content-Type: application/json');
        echo json_encode(['success' => $success]);
    }
    
    public function toggleFeatured() {
        // Only admins can toggle featured status
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
        
        $achievementModel = new Achievement($this->db);
        $success = $achievementModel->toggleFeatured($id);
        
        header('Content-Type: application/json');
        echo json_encode(['success' => $success]);
    }
    
    public function getAchievements() {
        // Get achievements for students
        $achievementModel = new Achievement($this->db);
        $featured = $achievementModel->getFeatured(6);
        $recent = $achievementModel->getRecent(12);
        
        header('Content-Type: application/json');
        echo json_encode([
            'featured' => $featured,
            'recent' => $recent
        ]);
    }
}
?>
