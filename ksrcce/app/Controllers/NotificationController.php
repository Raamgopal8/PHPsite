<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Notification;

class NotificationController extends Controller {
    
    public function __construct() {
        parent::__construct();
        // Require authentication for all notification actions
        if (!isset($_SESSION['user'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            exit;
        }
    }
    
    public function index() {
        $userId = $_SESSION['user']['id'];
        $notificationModel = new Notification($this->db);
        
        $page = $_GET['page'] ?? 1;
        $limit = 20;
        $offset = ($page - 1) * $limit;
        
        $notifications = $notificationModel->getUserNotifications($userId, $limit, $offset);
        $unreadCount = $notificationModel->getUnreadCount($userId);
        
        $this->view('notifications/index.php', [
            'notifications' => $notifications,
            'unreadCount' => $unreadCount,
            'currentPage' => $page,
            'totalPages' => ceil(count($notifications) / $limit)
        ]);
    }
    
    public function getUnreadCount() {
        $userId = $_SESSION['user']['id'];
        $notificationModel = new Notification($this->db);
        $count = $notificationModel->getUnreadCount($userId);
        
        header('Content-Type: application/json');
        echo json_encode(['count' => $count]);
    }
    
    public function getRecent() {
        $userId = $_SESSION['user']['id'];
        $notificationModel = new Notification($this->db);
        $notifications = $notificationModel->getUserNotifications($userId, 5);
        
        header('Content-Type: application/json');
        echo json_encode(['notifications' => $notifications]);
    }
    
    public function markAsRead() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            exit;
        }
        
        $data = json_decode(file_get_contents('php://input'), true);
        $notificationId = $data['notification_id'] ?? null;
        $userId = $_SESSION['user']['id'];
        
        if (!$notificationId) {
            http_response_code(400);
            echo json_encode(['error' => 'Notification ID required']);
            exit;
        }
        
        $notificationModel = new Notification($this->db);
        $success = $notificationModel->markAsRead($notificationId, $userId);
        
        header('Content-Type: application/json');
        echo json_encode(['success' => $success]);
    }
    
    public function markAllAsRead() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            exit;
        }
        
        $userId = $_SESSION['user']['id'];
        $notificationModel = new Notification($this->db);
        $success = $notificationModel->markAllAsRead($userId);
        
        header('Content-Type: application/json');
        echo json_encode(['success' => $success]);
    }
    
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            exit;
        }
        
        $data = json_decode(file_get_contents('php://input'), true);
        $notificationId = $data['notification_id'] ?? null;
        $userId = $_SESSION['user']['id'];
        
        if (!$notificationId) {
            http_response_code(400);
            echo json_encode(['error' => 'Notification ID required']);
            exit;
        }
        
        $notificationModel = new Notification($this->db);
        $success = $notificationModel->deleteNotification($notificationId, $userId);
        
        header('Content-Type: application/json');
        echo json_encode(['success' => $success]);
    }
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            exit;
        }
        
        // Only admins can create notifications
        if ($_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(['error' => 'Forbidden']);
            exit;
        }
        
        $data = json_decode(file_get_contents('php://input'), true);
        $title = $data['title'] ?? '';
        $message = $data['message'] ?? '';
        $type = $data['type'] ?? 'info';
        $link = $data['link'] ?? null;
        $targetUsers = $data['target_users'] ?? 'all'; // 'all', 'students', 'admins', or specific user IDs
        
        $notificationModel = new Notification($this->db);
        
        if ($targetUsers === 'all') {
            // Get all users
            $stmt = $this->db->query("SELECT id FROM users");
            $users = $stmt->fetchAll();
            $userIds = array_column($users, 'id');
            $success = $notificationModel->createBulk($userIds, $title, $message, $type, $link);
        } elseif ($targetUsers === 'students') {
            // Get all students
            $stmt = $this->db->query("SELECT id FROM users WHERE role = 'student'");
            $users = $stmt->fetchAll();
            $userIds = array_column($users, 'id');
            $success = $notificationModel->createBulk($userIds, $title, $message, $type, $link);
        } elseif ($targetUsers === 'admins') {
            // Get all admins
            $stmt = $this->db->query("SELECT id FROM users WHERE role = 'admin'");
            $users = $stmt->fetchAll();
            $userIds = array_column($users, 'id');
            $success = $notificationModel->createBulk($userIds, $title, $message, $type, $link);
        } else {
            // Specific user IDs
            $userIds = is_array($targetUsers) ? $targetUsers : [$targetUsers];
            $success = $notificationModel->createBulk($userIds, $title, $message, $type, $link);
        }
        
        header('Content-Type: application/json');
        echo json_encode(['success' => $success]);
    }
}
?>
