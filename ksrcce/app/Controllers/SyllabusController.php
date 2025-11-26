<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Syllabus;

class SyllabusController extends Controller
{
    // Controller for handling syllabus uploads
    private $syllabusModel;

    public function __construct()
    {
        parent::__construct();
        $this->syllabusModel = new Syllabus($this->db);
    }

    /**
     * Show upload form
     */
    public function uploadForm($examId)
    {
        $syllabus = $this->syllabusModel->getByExam($examId);
        $this->view('admin/syllabus_upload', [
            'examId' => $examId,
            'syllabus' => $syllabus
        ]);
    }

    /**
     * Handle syllabus file upload
     */
    public function upload()
    {
        $examId = $_POST['exam_id'] ?? '';
        
        if (empty($examId)) {
            $_SESSION['flash']['error'] = 'Exam ID is required';
            $this->redirectBack();
            return;
        }

        if (!isset($_FILES['syllabus_file']) || $_FILES['syllabus_file']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['flash']['error'] = 'Please select a valid file to upload';
            $this->redirect('/admin/exams/' . $examId . '/syllabus');
            return;
        }

        $fileContent = file_get_contents($_FILES['syllabus_file']['tmp_name']);
        if ($fileContent === false) {
            $_SESSION['flash']['error'] = 'Failed to read the uploaded file';
            $this->redirect('/admin/exams/' . $examId . '/syllabus');
            return;
        }

        $result = $this->syllabusModel->saveSyllabus($examId, $fileContent);
        
        if ($result) {
            $_SESSION['flash']['success'] = 'Syllabus uploaded successfully!';
        } else {
            $_SESSION['flash']['error'] = 'Failed to save syllabus. Please try again.';
        }

        $this->redirect('/admin/exams/' . $examId . '/syllabus');
    }

    /**
     * View syllabus
     */
    public function viewSyllabus($examId)
    {
        $syllabus = $this->syllabusModel->getByExam($examId);
        
        if (!$syllabus) {
            $_SESSION['flash']['error'] = 'Syllabus not found';
            $this->redirect('/admin/exams');
            return;
        }

        header('Content-Type: text/plain');
        echo $syllabus['content'];
        exit;
    }

    /**
     * Student view syllabus
     */
    public function studentView($examId)
    {
        // Check if user is logged in and is a student
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
            $_SESSION['flash']['error'] = 'Access denied';
            $this->redirect('/login');
            return;
        }

        $syllabus = $this->syllabusModel->getByExam($examId);
        
        if (!$syllabus) {
            echo "Syllabus not available for this exam.";
            exit;
        }

        header('Content-Type: text/plain');
        echo $syllabus['content'];
        exit;
    }
}