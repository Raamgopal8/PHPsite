<?php
namespace App\Models;

class Attempt extends BaseModel {
    protected $table = 'attempts';
    public function __construct($db) { parent::__construct($db); }

    public function createAttempt($userId, $examId, $answers, $score) {
        $doc = [
            'user_id' => $userId,
            'exam_id' => $examId,
            'answers' => json_encode($answers),
            'score' => $score,
            'submitted_at' => date('Y-m-d H:i:s')
        ];
        return $this->insert($doc);
    }

}
