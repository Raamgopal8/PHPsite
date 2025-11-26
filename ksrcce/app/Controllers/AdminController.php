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
    $resultModel = new \App\Models\Result($this->db);
    $recentResults = $resultModel->getResults([], 1, 10); // Get first 10 results

    // Pass all data to the view at once
    $this->view('admin/dashboard.php', [
        'exams' => $exams,
        'achievers' => $achievers,
        'recentResults' => $recentResults['data'] ?? [],
        'totalResults' => $recentResults['total'] ?? 0
    ]);
    
    }

    public function getRecentLogins() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(['error' => 'Unauthorized']);
            exit;
        }

        try {
            $stmt = $this->db->prepare("
                SELECT l.*, u.name, u.email 
                FROM login_logs l 
                JOIN users u ON l.user_id = u.id 
                ORDER BY l.login_time DESC 
                LIMIT 5
            ");
            $stmt->execute();
            $logs = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            
            // Format date for frontend
            foreach ($logs as &$log) {
                $log['formatted_time'] = date('M d, H:i', strtotime($log['login_time']));
                $log['formatted_logout'] = $log['logout_time'] ? date('M d, H:i', strtotime($log['logout_time'])) : 'Active';
            }
            
            header('Content-Type: application/json');
            echo json_encode($logs);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
        exit;
    }

    public function createExam() {
        $this->view('admin/exams_create.php');
    }

    public function postCreateExam() {
        $title = $_POST['title'] ?? '';
        $category = $_POST['category'] ?? '';
        $duration = $_POST['duration'] ?? 60;
        $questions = $_POST['questions'] ?? [];
        
        $examModel = new Exam($this->db);
        $examId = $examModel->createExam($title, $category, $duration, []);
        
        if ($examId && !empty($questions)) {
            $questionModel = new Question($this->db);
            foreach ($questions as $q) {
                if (empty($q['text']) || empty($q['options'])) continue;
                
                $questionModel->createQuestion(
                    $examId,
                    $q['text'],
                    $q['options'],
                    (int)($q['correct_answer'] ?? 0),
                    $q['explanation'] ?? ''
                );
            }
        }
        
        $_SESSION['flash']['success'] = "Exam created successfully.";
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
