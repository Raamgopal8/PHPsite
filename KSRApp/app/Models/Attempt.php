<?php
namespace App\Models;

class Attempt extends BaseModel {
    protected $collection = 'attempts';
    public function __construct($db) { parent::__construct($db); }

    public function createAttempt($userId, $examId, $answers, $score) {
        $doc = [
            'user_id' => $userId,
            'exam_id' => $examId,
            'answers' => $answers,
            'score' => $score,
            'submitted_at' => date('c')
        ];
        return $this->insert($doc);
    }

    public function attemptsByUser($userId) {
        return $this->db->{$this->collection}->find(['user_id' => $userId])->toArray();
    }
}
