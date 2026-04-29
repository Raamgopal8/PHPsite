<?php
namespace App\Models;

use PDO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

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
        // Log to system error log
        error_log("Email notification via PHPMailer for: $userEmail | Subject: $subject");
        
        $htmlMessage = $this->getEmailTemplate($subject, $message, $userName);
        
        // Log basic delivery info (without raw HTML body) for audit
        $logDir = __DIR__ . '/../../storage/logs';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }
        
        $logFile = $logDir . '/mail.log';
        $logEntry = "[" . date('Y-m-d H:i:s') . "] SUCCESS: Email queued for $userEmail | SUBJECT: $subject\n";
        file_put_contents($logFile, $logEntry, FILE_APPEND);
        
        $mail = new PHPMailer(true);
        
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = $_ENV['SMTP_HOST'] ?? 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV['SMTP_USER'] ?? '';
            $mail->Password   = $_ENV['SMTP_PASS'] ?? '';
            
            // For Gmail, STARTTLS on 587 is standard.
            $port = (int)($_ENV['SMTP_PORT'] ?? 587);
            $mail->Port = $port;
            
            if ($port === 465) {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            } else {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            }

            // Persistence of SSL options for robustness in cloud/shared environments
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            // Recipients
            $mail->setFrom($_ENV['SMTP_USER'] ?? 'cce@ksrce.ac.in', 'KSR CCE Examination Portal');
            $mail->addAddress($userEmail, $userName);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $htmlMessage;
            
            // Plain text version - ensure links are visible
            // If the message contains HTML links, we want to keep the URLs in plain text
            $plainText = $message;
            // Simple regex to extract href from any links in $plainText and append it
            if (preg_match('/<a[^>]+href=[\'"]([^\'"]+)[\'"][^>]*>([^<]*)<\/a>/i', $message, $matches)) {
                $plainText = str_replace($matches[0], $matches[2] . ": " . $matches[1], $message);
            }
            $mail->AltBody = strip_tags($plainText);

            $mail->send();
            return true;
        } catch (Exception $e) {
            $logFile = __DIR__ . '/../../storage/logs/mail.log';
            $errorLog = "[" . date('Y-m-d H:i:s') . "] ERROR: " . $mail->ErrorInfo . " | Exception: " . $e->getMessage() . "\n";
            
            // Add SMTP detailed debug info if possible
            if (isset($mail->SMTPDebug)) {
                 // Unfortunately PHPMailer's internal debug log isn't easily accessible as a string 
                 // without custom debug output handler, but we've got the main error message above.
            }
            
            $errorLog .= "SMTP Configuration - Host: " . ($mail->Host) . ", Port: " . ($mail->Port) . ", User: " . ($mail->Username) . "\n";
            $errorLog .= "--------------------------------------------------\n";
            file_put_contents($logFile, $errorLog, FILE_APPEND);
            
            error_log("PHPMailer error: {$mail->ErrorInfo}");
            error_log("Full exception trace: " . $e->getMessage());
            return false;
        }
    }
    
    private function getEmailTemplate($subject, $message, $userName) {
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>$subject</title>
            <style>
                body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #374151; margin: 0; padding: 0; background-color: #f3f4f6; }
                .wrapper { width: 100%; table-layout: fixed; background-color: #f3f4f6; padding-bottom: 40px; }
                .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); margin-top: 40px; }
                .header { background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%); color: white; padding: 30px 20px; text-align: center; }
                .header h2 { margin: 0; font-size: 24px; letter-spacing: 0.5px; }
                .content { padding: 40px 30px; }
                .content h3 { color: #111827; margin-top: 0; font-size: 18px; }
                .content p { margin-bottom: 20px; color: #4b5563; font-size: 16px; }
                .footer { text-align: center; padding: 25px; font-size: 13px; color: #9ca3af; background-color: #f9fafb; border-top: 1px solid #e5e7eb; }
                .footer p { margin: 5px 0; }
                .btn-container { text-align: center; margin-top: 30px; }
            </style>
        </head>
        <body>
            <div class='wrapper'>
                <div class='container'>
                    <div class='header'>
                        <h2>KSR CCE Examination Portal</h2>
                    </div>
                    <div class='content'>
                        <h3>Hello $userName,</h3>
                        <div style='background-color: #f9fafb; border-left: 4px solid #1e40af; padding: 15px; margin-bottom: 20px;'>
                            <p style='margin: 0;'>$message</p>
                        </div>
                        <p>If you have any questions or did not expect this email, please contact the support team at <a href='mailto:headcce@ksrce.ac.in' style='color: #1e40af; text-decoration: none;'>headcce@ksrce.ac.in</a>.</p>
                    </div>
                    <div class='footer'>
                        <p><strong>KSR College of Engineering</strong></p>
                        <p>KSR Kalvi Nagar, Tiruchengode - 637 215, Tamil Nadu</p>
                        <p>&copy; " . date('Y') . " KSR CCE. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </body>
        </html>
        ";
    }
}
?>
