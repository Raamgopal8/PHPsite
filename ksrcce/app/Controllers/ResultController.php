<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Result;

class ResultController extends Controller
{
    protected $resultModel;

    public function __construct()
    {
        parent::__construct();
        $this->resultModel = new Result($this->db);
    }
// ...
    public function adminResults()
    {
        try {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
            
            $filters = [
                'student_id' => $_GET['student_id'] ?? null,
                'exam_id' => $_GET['exam_id'] ?? null,
                'status' => $_GET['status'] ?? null
            ];

            $results = $this->resultModel->getResults($filters, $page, $limit);
            
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'data' => $results['data'],
                'pagination' => [
                    'total' => $results['total'],
                    'page' => $results['page'],
                    'limit' => $results['limit'],
                    'total_pages' => $results['total_pages']
                ]
            ]);
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Failed to fetch results: ' . $e->getMessage()
            ]);
        }
    }

    public function saveResult()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        
        try {
            $result = $this->resultModel->saveResult($data);
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'message' => 'Result saved successfully',
                'data' => ['id' => (string)$this->db->lastInsertId()] 
            ]); // Result::saveResult returns insert return value (bool/stmt), not ID object, assume usage of lastInsertId
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Failed to save result: ' . $e->getMessage()
            ]);
        }
    }

    public function getStudentResults($studentId)
    {
        try {
            $results = $this->resultModel->getResultsByStudent($studentId);
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'data' => $results
            ]);
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Failed to fetch results: ' . $e->getMessage()
            ]);
        }
    }

    public function getExamResults($examId)
    {
        try {
            $results = $this->resultModel->getResultsByExam($examId);
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'data' => $results
            ]);
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Failed to fetch exam results: ' . $e->getMessage()
            ]);
        }
    }

    public function getTopResults()
    {
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        
        try {
            $results = $this->resultModel->getTopResults($limit);
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'data' => $results
            ]);
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Failed to fetch top results: ' . $e->getMessage()
            ]);
        }
    }
    
    public function updates()
    {
        // Return a simple JSON response instead of a blocking stream
        header('Content-Type: application/json');
        echo json_encode([
            'type' => 'ping',
            'time' => date('Y-m-d H:i:s')
        ]);
        exit;
    }


}