<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class PasswordViewController extends Controller {
    
    public function __construct() {
        // Only allow access in development or with special permission
        if (!$this->isDevelopmentEnvironment() && !$this->hasAdminPermission()) {
            http_response_code(403);
            echo "Access Denied: This feature is only available in development environment or with special admin permissions.";
            exit;
        }
    }
    
    public function index() {
        $db = $this->db;
        $userModel = new User($db);
        
        // Get all users with their passwords
        $stmt = $db->query("SELECT id, name, email, password, role, created_at FROM users ORDER BY created_at DESC");
        $users = $stmt->fetchAll();
        
        // Decrypt passwords for display
        foreach ($users as &$user) {
            $user['password_decrypted'] = $this->decryptPassword($user['password']);
            $user['password_type'] = $this->getPasswordType($user['password']);
        }
        
        $this->view('admin/password-view.php', ['users' => $users]);
    }
    
    public function decryptSingle() {
        $userId = $_GET['id'] ?? null;
        if (!$userId) {
            $_SESSION['flash']['error'] = "User ID is required";
            $this->redirect('/admin/password-view');
            return;
        }
        
        $db = $this->db;
        $stmt = $db->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch();
        
        if (!$user) {
            $_SESSION['flash']['error'] = "User not found";
            $this->redirect('/admin/password-view');
            return;
        }
        
        $decryptedPassword = $this->decryptPassword($user['password']);
        $passwordType = $this->getPasswordType($user['password']);
        
        // Return JSON response for AJAX requests
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            header('Content-Type: application/json');
            echo json_encode([
                'password' => $decryptedPassword,
                'type' => $passwordType,
                'user_id' => $userId
            ]);
            exit;
        }
        
        // For non-AJAX, show in a popup-friendly view
        $this->view('admin/password-view-details.php', [
            'user_id' => $userId,
            'password' => $decryptedPassword,
            'type' => $passwordType
        ]);
    }
    
    private function decryptPassword($hashedPassword) {
        // Check if it's a bcrypt hash
        if (password_get_info($hashedPassword)['algo'] === PASSWORD_BCRYPT) {
            return "[BCRYPT HASH - Cannot be decrypted] " . substr($hashedPassword, 0, 20) . "...";
        }
        
        // Check if it might be MD5 (legacy)
        if (strlen($hashedPassword) === 32 && ctype_xdigit($hashedPassword)) {
            return "[MD5 HASH - Cannot be decrypted] " . $hashedPassword;
        }
        
        // Check if it's plain text (should not happen but handle it)
        if (!preg_match('/^[a-zA-Z0-9\/\.\$]+$/', $hashedPassword)) {
            return $hashedPassword; // It's already plain text
        }
        
        // For other hash types, return as is
        return "[ENCRYPTED - " . substr($hashedPassword, 0, 20) . "...]";
    }
    
    private function getPasswordType($hashedPassword) {
        $info = password_get_info($hashedPassword);
        
        if ($info['algo'] === PASSWORD_BCRYPT) {
            return "BCRYPT (Secure)";
        }
        
        if (strlen($hashedPassword) === 32 && ctype_xdigit($hashedPassword)) {
            return "MD5 (Insecure - Legacy)";
        }
        
        if (!preg_match('/^[a-zA-Z0-9\/\.\$]+$/', $hashedPassword)) {
            return "Plain Text (Insecure)";
        }
        
        return "Unknown Hash Type";
    }
    
    private function isDevelopmentEnvironment() {
        return ($_ENV['APP_ENV'] ?? 'production') === 'development' || 
               isset($_GET['dev_mode']) || 
               $_SERVER['SERVER_NAME'] === 'localhost';
    }
    
    private function hasAdminPermission() {
        // Check if current user has special permission to view passwords
        if (!isset($_SESSION['user'])) {
            return false;
        }
        
        $user = $_SESSION['user'];
        return $user['role'] === 'admin' && 
               isset($user['permissions']) && 
               in_array('view_passwords', $user['permissions'] ?? []);
    }
    
    public function exportPasswords() {
        if (!$this->isDevelopmentEnvironment() && !$this->hasAdminPermission()) {
            http_response_code(403);
            echo "Access Denied";
            exit;
        }
        
        $db = $this->db;
        $stmt = $db->query("SELECT id, name, email, password, role, created_at FROM users ORDER BY created_at DESC");
        $users = $stmt->fetchAll();
        
        // Prepare CSV export
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="passwords_export_' . date('Y-m-d_H-i-s') . '.csv"');
        
        $output = fopen('php://output', 'w');
        
        // CSV header
        fputcsv($output, ['ID', 'Name', 'Email', 'Password', 'Password Type', 'Role', 'Created At']);
        
        foreach ($users as $user) {
            fputcsv($output, [
                $user['id'],
                $user['name'],
                $user['email'],
                $this->decryptPassword($user['password']),
                $this->getPasswordType($user['password']),
                $user['role'],
                $user['created_at']
            ]);
        }
        
        fclose($output);
        exit;
    }
}
