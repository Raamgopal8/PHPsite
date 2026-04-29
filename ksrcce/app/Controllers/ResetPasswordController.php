<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Models\Notification;
use App\Core\App;

class ResetPasswordController extends Controller {
    private $userModel;
    private $notificationModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new User($this->db);
        $this->notificationModel = new Notification($this->db);
    }

    public function showForgotForm() {
        $this->view('auth/forgot-password.php');
    }

    public function sendResetLink() {
        $email = $_POST['email'] ?? '';
        
        if (empty($email)) {
            $_SESSION['flash']['error'] = "Please enter your email address.";
            header("Location: /forgot-password");
            exit;
        }

        $user = $this->userModel->findByEmail($email);
        if (!$user) {
            // For security, don't reveal if user exists, but here we might want to guide them
            $_SESSION['flash']['error'] = "mailid not registered with us.";
            header("Location: /forgot-password");
            exit;
        }

        // Delete existing tokens for this user
        $this->userModel->deleteAllUserTokens($user['id']);

        // Create new token
        $token = $this->userModel->createPasswordResetToken($user['id']);
        
        // Construct reset link using APP_URL if available, fallback to host
        $appUrl = rtrim($_ENV['APP_URL'] ?? '', '/');
        if (empty($appUrl)) {
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
            $host = $_SERVER['HTTP_HOST'];
            $appUrl = "$protocol://$host";
        }
        $resetLink = "$appUrl/reset-password?token=$token";

        // Send email
        $subject = "Password Reset Request";
        $message = "You requested a password reset. Click the button below to reset your password. This link will expire in 1 hour.";
        
        // Wrap message with link for the button in template
        $htmlMessage = $message . "<br><br><a href='$resetLink' style='display: inline-block; padding: 12px 24px; background: #1e40af; color: white; text-decoration: none; border-radius: 4px;'>Reset Password</a>";

        $sent = $this->notificationModel->sendEmailNotification($email, $subject, $htmlMessage, $user['name']);

        if ($sent) {
            $_SESSION['flash']['success'] = "Password reset link has been sent to your email.";
        } else {
            $_SESSION['flash']['error'] = "Failed to send reset link. Please try again later.";
        }

        header("Location: /forgot-password");
        exit;
    }

    public function showResetForm() {
        $token = $_GET['token'] ?? '';
        
        if (empty($token)) {
            $_SESSION['flash']['error'] = "Invalid or missing token.";
            header("Location: /login");
            exit;
        }

        $resetData = $this->userModel->findByResetToken($token);
        if (!$resetData) {
            $_SESSION['flash']['error'] = "The reset link is invalid or has expired.";
            header("Location: /forgot-password");
            exit;
        }

        $this->view('auth/reset-password.php', ['token' => $token]);
    }

    public function resetPassword() {
        $token = $_POST['token'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if (empty($token)) {
            $_SESSION['flash']['error'] = "Invalid reset request.";
            header("Location: /login");
            exit;
        }

        if (strlen($password) < 6) {
            $_SESSION['flash']['error'] = "Password must be at least 6 characters long.";
            header("Location: /reset-password?token=$token");
            exit;
        }

        if ($password !== $confirmPassword) {
            $_SESSION['flash']['error'] = "Passwords do not match.";
            header("Location: /reset-password?token=$token");
            exit;
        }

        $resetData = $this->userModel->findByResetToken($token);
        if (!$resetData) {
            $_SESSION['flash']['error'] = "The reset link is invalid or has expired.";
            header("Location: /forgot-password");
            exit;
        }

        // Update password
        $updated = $this->userModel->updatePassword($resetData['user_id'], $password);
        
        if ($updated) {
            // Delete token
            $this->userModel->deleteResetToken($token);
            $_SESSION['flash']['success'] = "Your password has been reset successfully. You can now login.";
            header("Location: /login");
        } else {
            $_SESSION['flash']['error'] = "Failed to update password. Please try again.";
            header("Location: /reset-password?token=$token");
        }
        exit;
    }
}
