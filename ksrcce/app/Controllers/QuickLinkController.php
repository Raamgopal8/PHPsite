<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\QuickLink;

class QuickLinkController extends Controller {
    protected $quickLinkModel;
    
    public function __construct() {
        parent::__construct();
        $this->quickLinkModel = new QuickLink($this->db);
    }
    
    public function store() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit;
        }
        
        $title = trim($_POST['title'] ?? '');
        $url = trim($_POST['url'] ?? '');
        $icon = trim($_POST['icon'] ?? 'link');
        
        if (empty($title) || empty($url)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Title and URL are required']);
            exit;
        }
        
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid URL format']);
            exit;
        }
        
        $maxOrder = $this->db->query("SELECT MAX(sort_order) as max_order FROM quick_links")->fetch()['max_order'] ?? 0;
        
        $data = [
            'title' => $title,
            'url' => $url,
            'icon' => $icon,
            'sort_order' => $maxOrder + 1
        ];
        
        if ($this->quickLinkModel->create($data)) {
            echo json_encode(['success' => true, 'message' => 'Quick link added successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to add quick link']);
        }
        exit;
    }
    
    public function update($id = null) {
        $id = $id ?? $_GET['id'] ?? null;
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit;
        }
        
        $link = $this->quickLinkModel->getById($id);
        if (!$link) {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Quick link not found']);
            exit;
        }
        
        $title = trim($_POST['title'] ?? '');
        $url = trim($_POST['url'] ?? '');
        $icon = trim($_POST['icon'] ?? 'link');
        
        if (empty($title) || empty($url)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Title and URL are required']);
            exit;
        }
        
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid URL format']);
            exit;
        }
        
        $data = [
            'title' => $title,
            'url' => $url,
            'icon' => $icon
        ];
        
        if ($this->quickLinkModel->update($id, $data)) {
            echo json_encode(['success' => true, 'message' => 'Quick link updated successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to update quick link']);
        }
        exit;
    }
    
    public function delete($id = null) {
        $id = $id ?? $_GET['id'] ?? null;
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit;
        }
        
        $link = $this->quickLinkModel->getById($id);
        if (!$link) {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Quick link not found']);
            exit;
        }
        
        if ($this->quickLinkModel->delete($id)) {
            echo json_encode(['success' => true, 'message' => 'Quick link deleted successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to delete quick link']);
        }
        exit;
    }
    
    public function toggleStatus($id = null) {
        $id = $id ?? $_GET['id'] ?? null;
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit;
        }
        
        $link = $this->quickLinkModel->getById($id);
        if (!$link) {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Quick link not found']);
            exit;
        }
        
        if ($this->quickLinkModel->toggleStatus($id)) {
            $updatedLink = $this->quickLinkModel->getById($id);
            echo json_encode([
                'success' => true, 
                'message' => 'Quick link status updated',
                'is_active' => $updatedLink['is_active']
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to update quick link status']);
        }
        exit;
    }
    
    public function reorder() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit;
        }
        
        $linkIds = $_POST['link_ids'] ?? [];
        if (is_string($linkIds)) {
            $linkIds = json_decode($linkIds, true);
        }
        
        if (empty($linkIds) || !is_array($linkIds)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid link IDs']);
            exit;
        }
        
        if ($this->quickLinkModel->reorder($linkIds)) {
            echo json_encode(['success' => true, 'message' => 'Quick links reordered successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to reorder quick links']);
        }
        exit;
    }
    
    public function getAll() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit;
        }
        
        $links = $this->quickLinkModel->getAll();
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $links]);
        exit;
    }
}
