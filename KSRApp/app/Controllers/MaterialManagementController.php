<?php
namespace App\Controllers;

use App\Core\Controller;

class MaterialManagementController extends Controller {
    
    public function index() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        $stmt = $this->db->prepare("SELECT * FROM materials ORDER BY created_at DESC");
        $stmt->execute();
        $materials = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $this->view('admin/materials/index.php', ['materials' => $materials]);
    }

    public function create() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        $this->view('admin/materials/create.php');
    }

    public function store() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        try {
            $title = $_POST['title'] ?? '';
            $category = $_POST['category'] ?? '';
            $url = $_POST['url'] ?? '';
            $description = $_POST['description'] ?? '';

            if (empty($title) || empty($category) || empty($url)) {
                $_SESSION['flash']['error'] = 'Title, category, and URL are required.';
                $this->redirect('/admin/materials/create');
                return;
            }

            // Validate URL format
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                $_SESSION['flash']['error'] = 'Please enter a valid URL.';
                $this->redirect('/admin/materials/create');
                return;
            }

            // Save to database
            $stmt = $this->db->prepare("INSERT INTO materials (title, category, url, description) VALUES (?, ?, ?, ?)");
            $stmt->execute([$title, $category, $url, $description]);

            $_SESSION['flash']['success'] = 'Material link added successfully!';
            $this->redirect('/admin/materials');

        } catch (\Exception $e) {
            error_log("Error adding material link: " . $e->getMessage());
            $_SESSION['flash']['error'] = 'Error adding material link: ' . $e->getMessage();
            $this->redirect('/admin/materials/create');
        }
    }

    public function show() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['flash']['error'] = 'Material ID is required.';
            $this->redirect('/admin/materials');
            return;
        }

        $stmt = $this->db->prepare("SELECT * FROM materials WHERE id = ?");
        $stmt->execute([$id]);
        $material = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$material) {
            $_SESSION['flash']['error'] = 'Material not found.';
            $this->redirect('/admin/materials');
            return;
        }

        $this->view('admin/materials/show.php', ['material' => $material]);
    }

    public function delete() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['flash']['error'] = 'Material ID is required.';
            $this->redirect('/admin/materials');
            return;
        }

        try {
            $stmt = $this->db->prepare("DELETE FROM materials WHERE id = ?");
            $stmt->execute([$id]);

            $_SESSION['flash']['success'] = 'Material deleted successfully!';
        } catch (\Exception $e) {
            $_SESSION['flash']['error'] = 'Error deleting material.';
        }

        $this->redirect('/admin/materials');
    }
}
