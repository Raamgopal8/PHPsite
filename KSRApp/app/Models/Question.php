<?php
namespace App\Models;

class Question extends BaseModel {
    protected $collection = 'questions';
    public function __construct($db) { parent::__construct($db); }

    public function createQuestion($examId, $text, $options, $answer, $explanation = '') {
        $doc = [
            'exam_id' => $examId,
            'text' => $text,
            'options' => $options,
            'answer' => $answer,
            'explanation' => $explanation
        ];
        return $this->insert($doc);
    }

    public function findByExam($examId) {
        return $this->db->{$this->collection}->find(['exam_id' => $examId])->toArray();
    }
}
