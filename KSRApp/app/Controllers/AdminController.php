<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Achiever;

class AdminController extends Controller {
    public function dashboard() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login'); exit;
        }
        $exams = (new Exam($this->db))->all();
    $achievers = (new Achiever($this->db))->all();
    $resultModel = new \App\Models\Result();
    $recentResults = $resultModel->getResults([], 1, 10); // Get first 10 results

    // Pass all data to the view at once
    $this->view('admin/dashboard.php', [
        'exams' => $exams,
        'achievers' => $achievers,
        'recentResults' => $recentResults['data'] ?? [],
        'totalResults' => $recentResults['total'] ?? 0
    ]);
    
    }

    public function createExam() {
        $this->view('admin/exams_create.php');
    }

    public function postCreateExam() {
        $title = $_POST['title'] ?? '';
        $category = $_POST['category'] ?? '';
        $duration = $_POST['duration'] ?? 60;
        (new Exam($this->db))->createExam($title,$category,$duration,[]);
        $_SESSION['flash']['success'] = "Exam created.";
        $this->redirect('/admin/dashboard');
    }

    public function addQuestion() {
        $this->view('admin/add_question.php');
    }

    public function postAddQuestion() {
        $examId = $_POST['exam_id'] ?? '';
        $text = $_POST['text'] ?? '';
        $options = [
            $_POST['opt1'] ?? '',
            $_POST['opt2'] ?? '',
            $_POST['opt3'] ?? '',
            $_POST['opt4'] ?? ''
        ];
        $answer = $_POST['answer'] ?? 0;
        (new Question($this->db))->createQuestion($examId, $text, $options, (int)$answer, $_POST['explanation'] ?? '');
        $_SESSION['flash']['success'] = "Question added.";
        $this->redirect('/admin/dashboard');
    }
}
