<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Event;

class EventController extends Controller {
    
    public function __construct() {
        parent::__construct();
        // Require authentication for all event actions
        if (!isset($_SESSION['user'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            exit;
        }
    }
    
    public function index() {
        // Only admins can manage events
        if ($_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(['error' => 'Forbidden']);
            exit;
        }
        
        $page = $_GET['page'] ?? 1;
        $limit = 20;
        $offset = ($page - 1) * $limit;
        
        $eventModel = new Event($this->db);
        $events = $eventModel->getAll($limit, $offset);
        $totalCount = $eventModel->getTotalCount();
        $totalPages = ceil($totalCount / $limit);
        
        $this->view('admin/events.php', [
            'events' => $events,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalCount' => $totalCount
        ]);
    }
    
    public function create() {
        // Only admins can create events
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
        
        $eventModel = new Event($this->db);
        
        try {
            $title = $_POST['title'] ?? '';
            $eventDate = $_POST['event_date'] ?? '';
            $description = $_POST['description'] ?? null;
            $isFeatured = isset($_POST['is_featured']);
            
            if (empty($title) || empty($eventDate)) {
                throw new \Exception('Title and Event Date are required');
            }
            
            // Handle image upload
            $imageUrl = null;
            if (isset($_FILES['event_image'])) {
                $fileError = $_FILES['event_image']['error'];
                if ($fileError === UPLOAD_ERR_OK) {
                    $imageUrl = $eventModel->uploadImage($_FILES['event_image']);
                } elseif ($fileError !== UPLOAD_ERR_NO_FILE) {
                    throw new \Exception('File upload failed with error code: ' . $fileError);
                }
            }
            
            $success = $eventModel->create(
                $title,
                $eventDate,
                $description,
                $imageUrl,
                $isFeatured
            );
            
            if ($success) {
                $_SESSION['flash']['success'] = 'Event added successfully!';
            } else {
                $_SESSION['flash']['error'] = 'Failed to add event';
            }
            
        } catch (\Exception $e) {
            $_SESSION['flash']['error'] = $e->getMessage();
        }
        
        $this->redirect('/admin/events');
    }
    
    public function update() {
        // Only admins can update events
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
        
        $eventModel = new Event($this->db);
        
        try {
            $id = $_POST['id'] ?? null;
            $title = $_POST['title'] ?? '';
            $eventDate = $_POST['event_date'] ?? '';
            $description = $_POST['description'] ?? null;
            $isFeatured = isset($_POST['is_featured']);
            $isActive = isset($_POST['is_active']);
            
            if (!$id || empty($title) || empty($eventDate)) {
                throw new \Exception('ID, Title, and Event Date are required');
            }
            
            // Get existing event to handle image
            $existing = $eventModel->getById($id);
            $imageUrl = $existing['image_url'] ?? null;
            
            // Handle new image upload
            if (isset($_FILES['event_image'])) {
                $fileError = $_FILES['event_image']['error'];
                if ($fileError === UPLOAD_ERR_OK) {
                    // Delete old image if exists
                    if ($imageUrl) {
                        $eventModel->deleteImage($imageUrl);
                    }
                    $imageUrl = $eventModel->uploadImage($_FILES['event_image']);
                } elseif ($fileError !== UPLOAD_ERR_NO_FILE) {
                    throw new \Exception('File upload failed with error code: ' . $fileError);
                }
            }
            
            $success = $eventModel->update(
                $id,
                $title,
                $eventDate,
                $description,
                $imageUrl,
                $isFeatured,
                $isActive
            );
            
            if ($success) {
                $_SESSION['flash']['success'] = 'Event updated successfully!';
            } else {
                $_SESSION['flash']['error'] = 'Failed to update event';
            }
            
        } catch (\Exception $e) {
            $_SESSION['flash']['error'] = $e->getMessage();
        }
        
        $this->redirect('/admin/events');
    }
    
    public function delete() {
        // Only admins can delete events
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
        
        $eventModel = new Event($this->db);
        
        // Get event to delete associated image
        $event = $eventModel->getById($id);
        if ($event && $event['image_url']) {
            $eventModel->deleteImage($event['image_url']);
        }
        
        $success = $eventModel->delete($id);
        
        header('Content-Type: application/json');
        echo json_encode(['success' => $success]);
    }
    
    public function toggleStatus() {
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
        
        $eventModel = new Event($this->db);
        $success = $eventModel->toggleStatus($id);
        
        header('Content-Type: application/json');
        echo json_encode(['success' => $success]);
    }
    
    public function toggleFeatured() {
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
        
        $eventModel = new Event($this->db);
        $success = $eventModel->toggleFeatured($id);
        
        header('Content-Type: application/json');
        echo json_encode(['success' => $success]);
    }
    
    public function getEventById() {
        $id = $_GET['id'] ?? null;
        $eventModel = new Event($this->db);
        $event = $eventModel->getById($id);
        
        if ($event) {
            header('Content-Type: application/json');
            echo json_encode(['event' => $event]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Event not found']);
        }
    }
    
    public function getEvents() {
        $eventModel = new Event($this->db);
        $featured = $eventModel->getFeatured(6);
        $recent = $eventModel->getRecent(12);
        
        header('Content-Type: application/json');
        echo json_encode([
            'featured' => $featured,
            'recent' => $recent
        ]);
    }

    public function publicGallery() {
        // Public/student-facing view of events
        $eventModel = new Event($this->db);
        
        $stmt = $this->db->prepare("SELECT * FROM events WHERE is_active = 1 ORDER BY event_date DESC, created_at DESC");
        $stmt->execute();
        $allEvents = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Group by year (using purely the year format of event_date instead of a custom batch year)
        $eventsByYear = [];
        foreach ($allEvents as $ev) {
            $year = $ev['event_date'] ? date('Y', strtotime($ev['event_date'])) : 'Other';
            if (!isset($eventsByYear[$year])) {
                $eventsByYear[$year] = [];
            }
            $eventsByYear[$year][] = $ev;
        }

        krsort($eventsByYear);

        $this->view('events_gallery.php', ['eventsByYear' => $eventsByYear]);
    }
}
?>
