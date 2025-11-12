<?php
namespace App\Models;

class Result extends BaseModel
{
    protected $collection = 'results';

    public function __construct()
    {
        parent::__construct(\App\Config\Mongo::getConnection());
    }

    public function saveResult($data)
    {
        $resultData = [
            'student_id' => $data['student_id'],
            'student_name' => $data['student_name'],
            'exam_id' => $data['exam_id'],
            'exam_title' => $data['exam_title'],
            'score' => (int)$data['score'],
            'total_questions' => (int)$data['total_questions'],
            'percentage' => (float)$data['percentage'],
            'created_at' => new \MongoDB\BSON\UTCDateTime()
        ];

        return $this->insert($resultData);
    }

    public function getResultsByStudent($studentId)
    {
        return $this->db->{$this->collection}->find(['student_id' => $studentId])->toArray();
    }

    public function getResultsByExam($examId)
    {
        return $this->db->{$this->collection}->find(['exam_id' => $examId])->toArray();
    }

    public function getTopResults($limit = 10)
    {
        return $this->db->{$this->collection}->find(
            [],
            [
                'sort' => ['percentage' => -1],
                'limit' => $limit
            ]
        )->toArray();
    }

    public function getResults($filters = [], $page = 1, $limit = 10)
    {
    $options = [
        'skip' => ($page - 1) * $limit,
        'limit' => $limit,
        'sort' => ['created_at' => -1] // Newest first
    ];

    $query = [];
    
    // Add filters if provided
    if (!empty($filters['student_id'])) {
        $query['student_id'] = $filters['student_id'];
    }
    if (!empty($filters['exam_id'])) {
        $query['exam_id'] = $filters['exam_id'];
    }
    if (isset($filters['status'])) {
        $query['percentage'] = $filters['status'] === 'passed' 
            ? ['$gte' => 70] 
            : ['$lt' => 70];
    }

    $results = $this->db->{$this->collection}->find($query, $options)->toArray();
    $total = $this->db->{$this->collection}->countDocuments($query);

    return [
        'data' => $results,
        'total' => $total,
        'page' => $page,
        'limit' => $limit,
        'total_pages' => ceil($total / $limit)
    ];
}
}