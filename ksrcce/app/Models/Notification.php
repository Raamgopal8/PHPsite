<?php
namespace App\Models;

use PDO;

class Notification {
    private $db;
    
    public function __construct(PDO $db) {
        $this->db = $db;
    }
    
    public function create($userId, $title, $message, $type = 'info', $link = null) {
        $stmt = $this->db->prepare("
            INSERT INTO notifications (user_id, title, message, type, link, is_read, created_at) 
            VALUES (?, ?, ?, ?, ?, 0, ?)
        ");
        return $stmt->execute([
            $userId,
            $title,
            $message,
            $type,
            $link,
            date('c')
        ]);
    }
    
    public function getUnreadCount($userId) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count FROM notifications 
            WHERE user_id = ? AND is_read = 0
        ");
        $stmt->execute([$userId]);
        $result = $stmt->fetch();
        return $result['count'];
    }
    
    public function getUserNotifications($userId, $limit = 10, $offset = 0) {
        $stmt = $this->db->prepare("
            SELECT * FROM notifications 
            WHERE user_id = ? 
            ORDER BY created_at DESC 
            LIMIT ? OFFSET ?
        ");
        $stmt->execute([$userId, $limit, $offset]);
        return $stmt->fetchAll();
    }
    
    public function markAsRead($notificationId, $userId) {
        $stmt = $this->db->prepare("
            UPDATE notifications 
            SET is_read = 1, read_at = ? 
            WHERE id = ? AND user_id = ?
        ");
        return $stmt->execute([date('c'), $notificationId, $userId]);
    }
    
    public function markAllAsRead($userId) {
        $stmt = $this->db->prepare("
            UPDATE notifications 
            SET is_read = 1, read_at = ? 
            WHERE user_id = ? AND is_read = 0
        ");
        return $stmt->execute([date('c'), $userId]);
    }
    
    public function deleteNotification($notificationId, $userId) {
        $stmt = $this->db->prepare("
            DELETE FROM notifications 
            WHERE id = ? AND user_id = ?
        ");
        return $stmt->execute([$notificationId, $userId]);
    }
    
    public function createBulk($userIds, $title, $message, $type = 'info', $link = null) {
        $placeholders = str_repeat('(?, ?, ?, ?, ?, 0, ?),', count($userIds));
        $placeholders = rtrim($placeholders, ',');
        
        $values = [];
        $createdAt = date('c');
        foreach ($userIds as $userId) {
            $values = array_merge($values, [$userId, $title, $message, $type, $link, $createdAt]);
        }
        
        $sql = "
            INSERT INTO notifications (user_id, title, message, type, link, is_read, created_at) 
            VALUES $placeholders
        ";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($values);
    }
    
    // Email notification methods
    public function sendEmailNotification($userEmail, $subject, $message, $userName = '') {
        // In a real implementation, you would use PHPMailer, SendGrid, or similar
        // For now, we'll log and return true
        error_log("Email notification sent to: $userEmail | Subject: $subject");
        error_log("Message: $message");
        
        // You can implement actual email sending here
        // Example with mail() function (not recommended for production):
        /*
        $headers = "From: noreply@ksrce.ac.in\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        $htmlMessage = $this->getEmailTemplate($subject, $message, $userName);
        
        return mail($userEmail, $subject, $htmlMessage, $headers);
        */
        
        return true;
    }
    
    private function getEmailTemplate($subject, $message, $userName) {
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <title>$subject</title>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: #1e40af; color: white; padding: 20px; text-align: center; }
                .content { padding: 20px; background: #f9fafb; }
                .footer { text-align: center; padding: 20px; font-size: 12px; color: #666; }
                .button { display: inline-block; padding: 12px 24px; background: #1e40af; color: white; text-decoration: none; border-radius: 4px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>KSR CCE Examination Portal</h2>
                </div>
                <div class='content'>
                    <h3>Hello" . ($userName ? " $userName" : "") . ",</h3>
                    <p>$message</p>
                    <p><a href='http://your-domain.com/login' class='button'>Login to Portal</a></p>
                </div>
                <div class='footer'>
                    <p>&copy; " . date('Y') . " KSR College of Engineering. All rights reserved.</p>
                </div>
            </div>
        </body>
        </html>
        ";
    }
}
?>
