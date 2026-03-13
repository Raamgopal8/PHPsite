<?php
namespace App\Models;

class Exam extends BaseModel {
    protected $table = 'exams';
    
    public function __construct($db) { 
        parent::__construct($db); 
    }

    public function createExam($title, $category, $duration, $data = []) {
        $doc = [
            'title' => $title,
            'category' => $category,
            'duration' => (int)$duration,
            'passing_score' => $data['passing_score'] ?? 70,
            'description' => $data['description'] ?? null,
            'instructions' => $data['instructions'] ?? null,
            'status' => 'active',
            'created_at' => date('Y-m-d H:i:s')
        ];
        return $this->insert($doc);
    }

    public function getById($id) {
        return $this->find(['id' => $id]);
    }

    public function getAvailableExams($userId) {
        $sql = "SELECT * FROM {$this->table} 
                WHERE status = 'active' 
                AND id NOT IN (SELECT exam_id FROM attempts WHERE user_id = ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
