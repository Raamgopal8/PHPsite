<?php
namespace App\Models;

class Result extends BaseModel
{
    protected $table = 'results';

    public function __construct($db = null)
    {
        parent::__construct($db);
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
            'created_at' => date('Y-m-d H:i:s')
        ];

        return $this->insert($resultData);
    }

    public function getResultsByStudent($studentId)
    {
        return $this->find(['student_id' => $studentId]);
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
        $offset = ($page - 1) * $limit;
        $where = [];
        $params = [];
        $paramTypes = [];
        
        if (!empty($filters['student_id'])) {
            $where[] = 'student_id = ?';
            $params[] = $filters['student_id'];
            $paramTypes[] = \PDO::PARAM_STR;
        }
        if (!empty($filters['exam_id'])) {
            $where[] = 'exam_id = ?';
            $params[] = $filters['exam_id'];
            $paramTypes[] = \PDO::PARAM_STR;
        }
        
        $whereClause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';
        
        // Get paginated results
        $sql = "SELECT * FROM {$this->table} $whereClause ORDER BY created_at DESC LIMIT ? OFFSET ?";
        $resultParams = $params;
        $resultParams[] = $limit;
        $resultParams[] = $offset;
        
        $stmt = $this->db->prepare($sql);
        
        // Bind parameters with their types
        foreach ($resultParams as $i => $param) {
            $paramType = isset($paramTypes[$i]) ? $paramTypes[$i] : \PDO::PARAM_STR;
            $stmt->bindValue($i + 1, $param, $paramType);
        }
        
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        // Get total count
        $countSql = "SELECT COUNT(*) as total FROM {$this->table} $whereClause";
        $countStmt = $this->db->prepare($countSql);
        
        // Only bind the where clause parameters for the count query
        foreach ($params as $i => $param) {
            $paramType = isset($paramTypes[$i]) ? $paramTypes[$i] : \PDO::PARAM_STR;
            $countStmt->bindValue($i + 1, $param, $paramType);
        }
        
        $countStmt->execute();
        $total = (int)$countStmt->fetchColumn();
        
        return [
            'data' => $results,
            'total' => $total,
            'page' => $page,
            'limit' => $limit,
            'total_pages' => $limit > 0 ? ceil($total / $limit) : 1
        ];
    }
}