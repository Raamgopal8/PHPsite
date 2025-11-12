<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Attempt;
use App\Models\User;

class ExamController extends Controller {
    public function studentDashboard() {
        // require login
        if (!isset($_SESSION['user'])) header('Location: /login');
        $db = $this->db;
        $examModel = new Exam($db);
        $exams = $examModel->all();
        $this->view('student/dashboard.php', ['exams' => $exams, 'user' => $_SESSION['user']]);
    }

    public function listExams() {
        $db = $this->db;
        $exams = (new Exam($db))->all();
        $this->view('student/exams.php', ['exams' => $exams]);
    }

    public function takeExam() {
        $db = $this->db;
        $examId = $_GET['id'] ?? null;
        if (!$examId) {
            echo "Exam id missing.";
            return;
        }
        $examModel = new Exam($db);
        $questionModel = new Question($db);
        $exam = $examModel->find(['_id' => $examId]) ?: $examModel->find(['_id' => ['$eq' => $examId]]);
        // If your _id is stored as string, the first find works. If using ObjectId, adjust accordingly.
        $questions = $questionModel->findByExam($examId);
        $this->view('student/take_exam.php', ['exam' => $exam, 'questions' => $questions]);
    }

    public function submitExam() {
        $db = $this->db;
        $user = $_SESSION['user'] ?? null;
        if (!$user) { $this->redirect('/login'); }
        $answers = $_POST['answers'] ?? [];
        $examId = $_POST['exam_id'] ?? null;
        $qModel = new Question($db);
        $attemptModel = new Attempt($db);

        // compute score
        $score = 0;
        foreach ($answers as $qId => $ans) {
            $q = $qModel->find(['_id' => $qId]);
            if ($q && isset($q['answer'])) {
                if ((string)$q['answer'] === (string)$ans) $score += 1;
            }
        }

        $attemptModel->createAttempt($user['_id'], $examId, $answers, $score);

        // update streak simple logic
        $userModel = new User($db);
        $u = $userModel->find(['_id' => $user['_id']]);
        if ($u) {
            $streak = ($u['streak'] ?? 0) + 1;
            $userModel->update(['_id' => $u['_id']], ['streak' => $streak]);
        }

        $_SESSION['flash']['success'] = "Exam submitted. Score: {$score}";
        $this->redirect('/student/dashboard');
    }
}
