<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\Material;

class MaterialController extends Controller {
    public function list() {
        $materials = (new Material($this->db))->all();
        $this->view('student/exams.php', ['materials' => $materials]); // reuse view or create separate
    }

    public function upload() {
        if (!isset($_FILES['file'])) { $this->redirect('/admin/dashboard'); }
        $file = $_FILES['file'];
        $targetDir = __DIR__ . '/../../public/uploads/';
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
        $filename = time() . '-' . basename($file['name']);
        $target = $targetDir . $filename;
        if (move_uploaded_file($file['tmp_name'], $target)) {
            (new Material($this->db))->upload($_POST['title'], '/uploads/' . $filename, $_POST['type'] ?? 'pdf', $_POST['subject'] ?? '');
            $_SESSION['flash']['success'] = "File uploaded";
        } else {
            $_SESSION['flash']['error'] = "Upload failed";
        }
        $this->redirect('/admin/dashboard');
    }
}
