<?php
namespace App\Models;

class Exam extends BaseModel {
    protected $table = 'exams';
    
    public function __construct($db) { 
        parent::__construct($db); 
    }

    public function createExam($title, $category, $duration, $questions = []) {
        $doc = [
            'title' => $title,
            'category' => $category,
            'duration' => (int)$duration,
            'status' => 'active',
            'created_at' => date('c')
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
