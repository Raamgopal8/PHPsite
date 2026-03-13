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
        
        // Fetch Exam Countdowns
        $countdownModel = new \App\Models\ExamCountdown($this->db);
        $countdowns = $countdownModel->getAllCountdowns();

        // Fetch Achievements
        $achievementModel = new \App\Models\Achievement($this->db);
        $achievers = $achievementModel->getAllAchievements();

        // Fetch Events
        $eventModel = new \App\Models\Event($this->db);
        $eventsList = $eventModel->getAllEvents();

        $resultModel = new \App\Models\Result($this->db);
        $recentResults = $resultModel->getResults([], 1, 10); // Get first 10 results

        // Fetch Recent Logins
        $recentLogins = [];
        try {
            $stmt = $this->db->prepare("
                SELECT l.*, u.name, u.college, u.department, u.year 
                FROM login_logs l 
                JOIN users u ON l.user_id = u.id 
                ORDER BY l.login_time DESC 
                LIMIT 5
            ");
            $stmt->execute();
            $recentLogins = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {}

        // Fetch Official Links
        $officialLinks = [];
        try {
            $stmt = $this->db->prepare("SELECT * FROM official_links ORDER BY created_at DESC");
            $stmt->execute();
            $officialLinks = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {}

        // Pass all data to the view at once
        $this->view('admin/dashboard.php', [
            'exams' => $exams,
            'countdowns' => $countdowns,
            'achievers' => $achievers,
            'eventsList' => $eventsList,
            'recentResults' => $recentResults['data'] ?? [],
            'totalResults' => $recentResults['total'] ?? 0,
            'recentLogins' => $recentLogins,
            'officialLinks' => $officialLinks
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
                SELECT l.*, u.name, u.email, u.college, u.department, u.year 
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
                
                if ($log['logout_time']) {
                    $log['formatted_logout'] = date('M d, H:i', strtotime($log['logout_time']));
                    $log['status_class'] = 'text-gray-500'; // Offline/Logged out
                } else {
                    // Check last_activity for timeout (e.g., 5 minutes = 300 seconds)
                    $lastActivity = $log['last_activity'] ? strtotime($log['last_activity']) : strtotime($log['login_time']);
                    $timeSinceActivity = time() - $lastActivity;
                    
                    if ($timeSinceActivity < 300) {
                        $log['formatted_logout'] = 'Online';
                        $log['status_class'] = 'text-green-600 font-bold';
                    } else {
                        $log['formatted_logout'] = 'Offline'; // Timed out
                        $log['status_class'] = 'text-gray-400';
                    }
                }
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
        $examId = $examModel->createExam($title, $category, $duration, [
            'passing_score' => $_POST['passing_score'] ?? 70,
            'description' => $_POST['description'] ?? null,
            'instructions' => $_POST['instructions'] ?? null
        ]);
        
        if ($examId && !empty($questions)) {
            $questionModel = new Question($this->db);
            foreach ($questions as $index => $q) {
                if (empty($q['text']) || empty($q['options'])) continue;
                
                $imagePath = null;
                // Handle image upload if present
                if (isset($_FILES['questions']['name'][$index]['new_image']) && 
                    $_FILES['questions']['error'][$index]['new_image'] === UPLOAD_ERR_OK) {
                    
                    $file = [
                        'name' => $_FILES['questions']['name'][$index]['new_image'],
                        'type' => $_FILES['questions']['type'][$index]['new_image'],
                        'tmp_name' => $_FILES['questions']['tmp_name'][$index]['new_image'],
                        'error' => $_FILES['questions']['error'][$index]['new_image'],
                        'size' => $_FILES['questions']['size'][$index]['new_image']
                    ];
                    
                    try {
                        $uploadedPath = $questionModel->uploadQuestionImage($file);
                        if ($uploadedPath) {
                            $imagePath = $uploadedPath;
                        }
                    } catch (\Exception $e) {
                        error_log("Question image upload failed: " . $e->getMessage());
                    }
                }

                $questionModel->create([
                    'exam_id' => $examId,
                    'question_text' => $q['text'],
                    'options' => $q['options'],
                    'correct_answer' => (int)($q['correct_answer'] ?? 0),
                    'explanation' => $q['explanation'] ?? '',
                    'question_image' => $imagePath,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
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
    public function printLogins() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login'); exit;
        }

        try {
            $stmt = $this->db->prepare("
                SELECT l.*, u.name, u.email, u.college, u.department, u.year 
                FROM login_logs l 
                JOIN users u ON l.user_id = u.id 
                ORDER BY l.login_time DESC 
            ");
            $stmt->execute();
            $logins = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            
            $this->view('admin/print_logins.php', ['logins' => $logins]);
        } catch (\Exception $e) {
            die("Error loading logs");
        }
    }

    public function printScores() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login'); exit;
        }

        $resultModel = new \App\Models\Result($this->db);
        $resultsData = $resultModel->getResults([], 1, 10000); // Fetch up to 10k records for printing
        $results = $resultsData['data'] ?? [];
        
        $this->view('admin/print_scores.php', ['results' => $results]);
    }
}
