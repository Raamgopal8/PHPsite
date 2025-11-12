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
            $_SESSION['user'] = ['_id' => (string)$user['_id'], 'name'=>$user['name'], 'email'=>$user['email'], 'role'=>$user['role']];
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
        session_destroy();
        $this->redirect('/login');
    }
}
