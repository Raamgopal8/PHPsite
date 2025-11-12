<?php
namespace App\Models;

class Exam extends BaseModel {
    protected $collection = 'exams';
    public function __construct($db) { parent::__construct($db); }

    public function createExam($title, $category, $duration, $questions = []) {
        $doc = [
            'title' => $title,
            'category' => $category,
            'duration' => (int)$duration,
            'questions' => $questions,
            'status' => 'active',
            'created_at' => date('c')
        ];
        return $this->insert($doc);
    }

    public function getById($id) {
        return $this->find(['_id' => $id]);
    }
}
