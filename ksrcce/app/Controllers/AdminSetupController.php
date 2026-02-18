<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AdminSetupController extends Controller {
    
    public function index() {
        // Check if any admin users exist
        $stmt = $this->db->query("SELECT COUNT(*) as count FROM users WHERE role = 'admin'");
        $result = $stmt->fetch();
        $adminExists = $result['count'] > 0;
        
        $this->view('admin/setup.php', ['adminExists' => $adminExists]);
    }
    
    public function createAdmin() {
        // Validate input
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        
        $errors = [];
        
        if (empty($name)) {
            $errors[] = "Name is required";
        }
        
        if (empty($email)) {
            $errors[] = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }
        
        if (empty($password)) {
            $errors[] = "Password is required";
        } elseif (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long";
        }
        
        if ($password !== $confirmPassword) {
            $errors[] = "Passwords do not match";
        }
        
        if (!empty($errors)) {
            $_SESSION['flash']['error'] = implode(', ', $errors);
            $this->redirect('/admin/setup');
            return;
        }
        
        // Check if email already exists
        $userModel = new User($this->db);
        if ($userModel->findByEmail($email)) {
            $_SESSION['flash']['error'] = "Email already exists";
            $this->redirect('/admin/setup');
            return;
        }
        
        // Create admin user
        $userId = $userModel->create($name, $email, $password, 'admin');
        
        if ($userId) {
            $_SESSION['flash']['success'] = "Admin user created successfully! You can now login.";
            $this->redirect('/login');
        } else {
            $_SESSION['flash']['error'] = "Failed to create admin user";
            $this->redirect('/admin/setup');
        }
    }
}
