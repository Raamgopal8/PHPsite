<?php
namespace App\Controllers;

use App\Models\Result;

class ResultController extends Controller
{
    protected $resultModel;

    public function __construct()
    {
        parent::__construct();
        $this->resultModel = new Result();
    }

    public function saveResult()
    {
        $data = $this->request->getJSON(true);
        
        try {
            $result = $this->resultModel->saveResult($data);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Result saved successfully',
                'data' => ['id' => (string)$result->getInsertedId()]
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to save result: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getStudentResults($studentId)
    {
        try {
            $results = $this->resultModel->getResultsByStudent($studentId);
            return $this->response->setJSON([
                'success' => true,
                'data' => $results
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to fetch results: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getExamResults($examId)
    {
        try {
            $results = $this->resultModel->getResultsByExam($examId);
            return $this->response->setJSON([
                'success' => true,
                'data' => $results
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to fetch exam results: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getTopResults()
    {
        $limit = $this->request->getGet('limit') ?? 10;
        
        try {
            $results = $this->resultModel->getTopResults($limit);
            return $this->response->setJSON([
                'success' => true,
                'data' => $results
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to fetch top results: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function updates()
    {
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    header('Connection: keep-alive');
    
    // Send a comment to keep the connection alive
    echo ":" . str_repeat(" ", 2048) . "\n"; // 2KB padding for IE
    echo "retry: 5000\n\n";
    flush();

    // This is a simplified example - in a real app, you'd check for new results
    // and only send updates when there are changes
    while (true) {
        // Check for new results (you'll need to implement this logic)
        // $newResults = $this->resultModel->getNewResultsSince($lastCheck);
        
        // For now, we'll just send a ping every 30 seconds
        echo "data: " . json_encode([
            'type' => 'ping',
            'time' => date('Y-m-d H:i:s')
        ]) . "\n\n";
        flush();
        
        // Wait for 30 seconds before sending the next update
        sleep(30);
    }
    }

public function adminResults()
{
    try {
        $page = $this->request->getGet('page') ? (int)$this->request->getGet('page') : 1;
        $limit = $this->request->getGet('limit') ? (int)$this->request->getGet('limit') : 10;
        
        $filters = [
            'student_id' => $this->request->getGet('student_id'),
            'exam_id' => $this->request->getGet('exam_id'),
            'status' => $this->request->getGet('status')
        ];

        $results = $this->resultModel->getResults($filters, $page, $limit);
        
        return $this->response->setJSON([
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
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Failed to fetch results: ' . $e->getMessage()
        ], 500);
    }
}
}