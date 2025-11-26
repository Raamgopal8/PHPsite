<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller {
    public function login() {
        $this->view('auth/login.php');
    }

    public function postLogin() {
        $db = $this->db;
        $userModel = new User($db);
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $user = $userModel->verify($email, $password);
        if ($user) {
            // store minimal user in session
            $_SESSION['user'] = ['id' => (string)$user['id'], 'name'=>$user['name'], 'email'=>$user['email'], 'role'=>$user['role']];
            
            // Log the login event
            try {
                $sessionId = session_id();
                if (!$sessionId) {
                    session_start();
                    $sessionId = session_id();
                }
                
                $stmt = $db->prepare("INSERT INTO login_logs (user_id, ip_address, user_agent, session_id) VALUES (?, ?, ?, ?)");
                $ip = $_SERVER['REMOTE_ADDR'] ?? null;
                $agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
                $stmt->execute([$user['id'], $ip, $agent, $sessionId]);
            } catch (\Exception $e) {
                // Silently fail logging to not prevent login
                error_log("Login logging failed: " . $e->getMessage());
            }

            if ($user['role'] === 'admin') {
                $this->redirect('/admin/dashboard');
            } else {
                $this->redirect('/student/dashboard');
            }
        }
        $_SESSION['flash']['error'] = "Invalid credentials";
        $this->redirect('/login');
    }

    public function register() {
        $this->view('auth/register.php');
    }

    public function postRegister() {
        $db = $this->db;
        $userModel = new User($db);
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $pwd = $_POST['password'] ?? '';
        if ($userModel->findByEmail($email)) {
            $_SESSION['flash']['error'] = "Email already registered";
            $this->redirect('/register');
        }
        $userModel->create($name, $email, $pwd, 'student');
        $_SESSION['flash']['success'] = "Registration complete. Login.";
        $this->redirect('/login');
    }

    public function logout() {
        // Record logout time
        try {
            $sessionId = session_id();
            if ($sessionId) {
                $db = $this->db;
                $stmt = $db->prepare("UPDATE login_logs SET logout_time = CURRENT_TIMESTAMP WHERE session_id = ?");
                $stmt->execute([$sessionId]);
            }
        } catch (\Exception $e) {
            error_log("Logout logging failed: " . $e->getMessage());
        }

        session_destroy();
        $this->redirect('/login');
    }
}
