<?php
namespace App\Models;

use PDO;

class Achievement {
    private $db;
    
    public function __construct(PDO $db) {
        $this->db = $db;
    }
    
    public function create($studentName, $examName, $rankOrScore, $description = null, $imageUrl = null, $batchYear = null, $department = null, $isFeatured = false) {
        $stmt = $this->db->prepare("
            INSERT INTO achievements (student_name, exam_name, rank_or_score, achievement_description, image_url, batch_year, department, is_featured, is_active) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1)
        ");
        return $stmt->execute([
            $studentName,
            $examName,
            $rankOrScore,
            $description,
            $imageUrl,
            $batchYear,
            $department,
            $isFeatured
        ]);
    }
    
    public function getAll($limit = 20, $offset = 0) {
        $stmt = $this->db->prepare("
            SELECT * FROM achievements 
            WHERE is_active = 1 
            ORDER BY is_featured DESC, created_at DESC 
            LIMIT :limit OFFSET :offset
        ");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllAchievements() {
        $stmt = $this->db->prepare("
            SELECT * FROM achievements 
            ORDER BY created_at DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getFeatured($limit = 5) {
        $stmt = $this->db->prepare("
            SELECT * FROM achievements 
            WHERE is_active = 1 AND is_featured = 1 
            ORDER BY created_at DESC 
            LIMIT :limit
        ");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getRecent($limit = 10) {
        $stmt = $this->db->prepare("
            SELECT * FROM achievements 
            WHERE is_active = 1 
            ORDER BY created_at DESC 
            LIMIT :limit
        ");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getById($id) {
        $stmt = $this->db->prepare("
            SELECT * FROM achievements WHERE id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public function update($id, $studentName, $examName, $rankOrScore, $description, $imageUrl, $batchYear, $department, $isFeatured, $isActive) {
        $stmt = $this->db->prepare("
            UPDATE achievements 
            SET student_name = ?, exam_name = ?, rank_or_score = ?, achievement_description = ?, 
                image_url = ?, batch_year = ?, department = ?, is_featured = ?, is_active = ?, updated_at = CURRENT_TIMESTAMP
            WHERE id = ?
        ");
        return $stmt->execute([
            $studentName,
            $examName,
            $rankOrScore,
            $description,
            $imageUrl,
            $batchYear,
            $department,
            $isFeatured,
            $isActive,
            $id
        ]);
    }
    
    public function delete($id) {
        $stmt = $this->db->prepare("
            DELETE FROM achievements WHERE id = ?
        ");
        return $stmt->execute([$id]);
    }
    
    public function toggleStatus($id) {
        $stmt = $this->db->prepare("
            UPDATE achievements 
            SET is_active = NOT is_active, updated_at = CURRENT_TIMESTAMP
            WHERE id = ?
        ");
        return $stmt->execute([$id]);
    }
    
    public function toggleFeatured($id) {
        $stmt = $this->db->prepare("
            UPDATE achievements 
            SET is_featured = NOT is_featured, updated_at = CURRENT_TIMESTAMP
            WHERE id = ?
        ");
        return $stmt->execute([$id]);
    }
    
    public function getTotalCount() {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count FROM achievements WHERE is_active = 1
        ");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['count'];
    }
    
    public function uploadImage($file) {
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }
        
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        
        if (!in_array($file['type'], $allowedTypes)) {
            throw new \Exception('Invalid file type. Only JPEG, PNG, and WebP are allowed.');
        }
        
        if ($file['size'] > $maxFileSize) {
            throw new \Exception('File size too large. Maximum size is 5MB.');
        }
        
        // Final sanity check on error code
        if ($file['error'] !== UPLOAD_ERR_OK) {
             throw new \Exception('File upload failed with error code: ' . $file['error']);
        }
        
        
        $uploadDir = __DIR__ . '/../../public/assets/achievements/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = 'achievement_' . time() . '_' . uniqid() . '.' . $extension;
        $filepath = $uploadDir . $filename;
        
        if (move_uploaded_file($file['tmp_name'], $filepath)) {
            return '/assets/achievements/' . $filename;
        }
        
        return null;
    }
    
    public function deleteImage($imageUrl) {
        if (empty($imageUrl)) {
            return true;
        }
        
        
        $filepath = __DIR__ . '/../../public/' . ltrim($imageUrl, '/');
        if (file_exists($filepath)) {
            return unlink($filepath);
        }
        
        return true;
    }
}
?>
