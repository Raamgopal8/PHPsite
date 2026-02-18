<?php
namespace App\Models;

use PDO;

class ExamCountdown {
    private $db;
    
    public function __construct(PDO $db) {
        $this->db = $db;
    }
    
    public function create($examName, $examDate, $examTime = '09:00:00', $description = null, $targetAudience = 'all') {
        $stmt = $this->db->prepare("
            INSERT INTO exam_countdowns (exam_name, exam_date, exam_time, description, target_audience, is_active) 
            VALUES (?, ?, ?, ?, ?, 1)
        ");
        return $stmt->execute([
            $examName,
            $examDate,
            $examTime,
            $description,
            $targetAudience
        ]);
    }
    
    public function getAll($limit = 10) {
        $stmt = $this->db->prepare("
            SELECT * FROM exam_countdowns 
            WHERE is_active = 1 
            ORDER BY exam_date ASC 
            LIMIT :limit
        ");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllCountdowns() {
        $stmt = $this->db->prepare("
            SELECT * FROM exam_countdowns 
            ORDER BY exam_date ASC 
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getActiveCountdowns($targetAudience = 'all') {
        $stmt = $this->db->prepare("
            SELECT * FROM exam_countdowns 
            WHERE is_active = 1 
            AND (target_audience = :audience OR target_audience = 'all')
            AND exam_date >= CURDATE()
            ORDER BY exam_date ASC 
            LIMIT 5
        ");
        $stmt->bindValue(':audience', $targetAudience);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getById($id) {
        $stmt = $this->db->prepare("
            SELECT * FROM exam_countdowns WHERE id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public function update($id, $examName, $examDate, $examTime, $description, $targetAudience, $isActive) {
        $stmt = $this->db->prepare("
            UPDATE exam_countdowns 
            SET exam_name = ?, exam_date = ?, exam_time = ?, description = ?, 
                target_audience = ?, is_active = ?, updated_at = CURRENT_TIMESTAMP
            WHERE id = ?
        ");
        return $stmt->execute([
            $examName,
            $examDate,
            $examTime,
            $description,
            $targetAudience,
            $isActive,
            $id
        ]);
    }
    
    public function delete($id) {
        $stmt = $this->db->prepare("
            DELETE FROM exam_countdowns WHERE id = ?
        ");
        return $stmt->execute([$id]);
    }
    
    public function toggleStatus($id) {
        $stmt = $this->db->prepare("
            UPDATE exam_countdowns 
            SET is_active = NOT is_active, updated_at = CURRENT_TIMESTAMP
            WHERE id = ?
        ");
        return $stmt->execute([$id]);
    }
    
    public function getCountdownData($id) {
        $countdown = $this->getById($id);
        if (!$countdown) return null;
        
        $examDateTime = new \DateTime($countdown['exam_date'] . ' ' . $countdown['exam_time']);
        $now = new \DateTime();
        $interval = $now->diff($examDateTime);
        
        return [
            'exam' => $countdown,
            'days' => $interval->days,
            'hours' => $interval->h,
            'minutes' => $interval->i,
            'seconds' => $interval->s,
            'total_seconds' => $examDateTime->getTimestamp() - $now->getTimestamp(),
            'is_past' => $interval->invert
        ];
    }
    
    public function getAllCountdownData($targetAudience = 'all') {
        $countdowns = $this->getActiveCountdowns($targetAudience);
        $data = [];
        
        foreach ($countdowns as $countdown) {
            $examDateTime = new \DateTime($countdown['exam_date'] . ' ' . $countdown['exam_time']);
            $now = new \DateTime();
            $interval = $now->diff($examDateTime);
            
            $data[] = [
                'exam' => $countdown,
                'days' => $interval->days,
                'hours' => $interval->h,
                'minutes' => $interval->i,
                'seconds' => $interval->s,
                'total_seconds' => $examDateTime->getTimestamp() - $now->getTimestamp(),
                'is_past' => $interval->invert
            ];
        }
        
        return $data;
    }
}
?>
