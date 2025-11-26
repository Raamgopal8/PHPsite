<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\BaseModel;

class SyllabusManagementController extends Controller {
    
    public function index() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        $stmt = $this->db->prepare("SELECT * FROM syllabi ORDER BY created_at DESC");
        $stmt->execute();
        $syllabi = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $this->view('admin/syllabi/index.php', ['syllabi' => $syllabi]);
    }

    public function create() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        $this->view('admin/syllabi/create.php');
    }

    public function store() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        try {
            $title = $_POST['title'] ?? '';
            $subject = $_POST['subject'] ?? '';
            $url = $_POST['url'] ?? '';

            if (empty($title) || empty($subject) || empty($url)) {
                $_SESSION['flash']['error'] = 'All fields are required.';
                $this->redirect('/admin/syllabi/create');
                return;
            }

            // Validate URL format
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                $_SESSION['flash']['error'] = 'Please enter a valid URL.';
                $this->redirect('/admin/syllabi/create');
                return;
            }

            // Save to database
            $stmt = $this->db->prepare("INSERT INTO syllabi (title, subject, url) VALUES (?, ?, ?)");
            $stmt->execute([$title, $subject, $url]);

            $_SESSION['flash']['success'] = 'Syllabus link added successfully!';
            $this->redirect('/admin/syllabi');

        } catch (\Exception $e) {
            error_log("Error adding syllabus link: " . $e->getMessage());
            $_SESSION['flash']['error'] = 'Error adding syllabus link: ' . $e->getMessage();
            $this->redirect('/admin/syllabi/create');
        }
    }

    public function show() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['flash']['error'] = 'Syllabus ID is required.';
            $this->redirect('/admin/syllabi');
            return;
        }

        $stmt = $this->db->prepare("SELECT * FROM syllabi WHERE id = ?");
        $stmt->execute([$id]);
        $syllabus = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$syllabus) {
            $_SESSION['flash']['error'] = 'Syllabus not found.';
            $this->redirect('/admin/syllabi');
            return;
        }

        $this->view('admin/syllabi/show.php', ['syllabus' => $syllabus]);
    }

    public function delete() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['flash']['error'] = 'Syllabus ID is required.';
            $this->redirect('/admin/syllabi');
            return;
        }

        try {
            $stmt = $this->db->prepare("DELETE FROM syllabi WHERE id = ?");
            $stmt->execute([$id]);

            $_SESSION['flash']['success'] = 'Syllabus deleted successfully!';
        } catch (\Exception $e) {
            $_SESSION['flash']['error'] = 'Error deleting syllabus.';
        }

        $this->redirect('/admin/syllabi');
    }
}
