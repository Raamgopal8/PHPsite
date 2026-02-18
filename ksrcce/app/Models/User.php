<?php
namespace App\Models;

class User extends BaseModel {
    protected $table = 'users';

    public function __construct($db) { 
        parent::__construct($db);
    }

    public function create($name, $email, $password, $role='student') {
        $doc = [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'role' => $role,
            'streak' => 0,
            'created_at' => date('c')
        ];
        return $this->insert($doc);
    }

    public function findByEmail($email) {
        return $this->find(['email' => $email]);
    }

    public function verify($email, $password) {
        $u = $this->findByEmail($email);
        if (!$u) return false;
        if (password_verify($password, $u['password'])) return $u;
        return false;
    }

    public function createPasswordResetToken($userId) {
        // Generate a secure random token
        $token = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', strtotime('+1 hour'));
        
        $stmt = $this->db->prepare("INSERT INTO password_reset_tokens (user_id, token, expires_at) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $token, $expiresAt]);
        
        return $token;
    }

    public function findByResetToken($token) {
        $stmt = $this->db->prepare("
            SELECT prt.*, u.email, u.id as user_id 
            FROM password_reset_tokens prt 
            JOIN users u ON prt.user_id = u.id 
            WHERE prt.token = ? AND prt.expires_at > NOW()
        ");
        $stmt->execute([$token]);
        return $stmt->fetch();
    }

    public function deleteResetToken($token) {
        $stmt = $this->db->prepare("DELETE FROM password_reset_tokens WHERE token = ?");
        return $stmt->execute([$token]);
    }

    public function updatePassword($userId, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("UPDATE users SET password = ?, updated_at = NOW() WHERE id = ?");
        return $stmt->execute([$hashedPassword, $userId]);
    }

    public function deleteAllUserTokens($userId) {
        $stmt = $this->db->prepare("DELETE FROM password_reset_tokens WHERE user_id = ?");
        return $stmt->execute([$userId]);
    }
}
