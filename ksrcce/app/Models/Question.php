<?php
namespace App\Models;

use PDO;
use PDOException;

class Question extends BaseModel 
{
    protected $table = 'questions';

    /**
     * Parse text content and extract questions
     */
    public function parseQuestionsFromText($content) 
    {
        $questions = [];
        $lines = explode("\n", trim($content));
        $currentQuestion = null;

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;

            if (preg_match('/^(\d+\.|Q[:.]?\s*)(.+)/i', $line, $matches)) {
                if ($currentQuestion) {
                    $questions[] = $currentQuestion;
                }
                $currentQuestion = [
                    'text' => trim($matches[2]),
                    'options' => [],
                    'answer' => -1,
                    'explanation' => '',
                    'image' => null
                ];
            }
            elseif (preg_match('/^([A-D])\)\s*\*?(.+?)\*?\s*$/i', $line, $matches)) {
                if ($currentQuestion) {
                    $optionText = trim($matches[2]);
                    $currentQuestion['options'][] = $optionText;
                    if (strpos($line, '*') !== false) {
                        $currentQuestion['answer'] = count($currentQuestion['options']) - 1;
                    }
                }
            }
            elseif (preg_match('/\[(image|figure):\s*([^\]]+)\]/i', $line, $matches) && $currentQuestion) {
                $currentQuestion['image'] = trim($matches[2]);
            }
            elseif (preg_match('/^(Explanation|Exp|Answer):\s*(.+)/i', $line, $matches) && $currentQuestion) {
                $currentQuestion['explanation'] = trim($matches[2]);
            }
        }

        if ($currentQuestion) {
            $questions[] = $currentQuestion;
        }

        return $questions;
    }

    /**
     * Create a new question
     */
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO questions (exam_id, question_text, options, correct_answer, explanation, question_image) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['exam_id'],
            $data['question_text'] ?? $data['text'] ?? '',
            json_encode($data['options']),
            $data['correct_answer'] ?? $data['answer'] ?? 0,
            $data['explanation'] ?? null,
            $data['question_image'] ?? $data['image'] ?? null
        ]);
    }

    /**
     * Legacy wrapper for create
     */
    public function createQuestion($examId, $text, $options, $answer, $explanation = '') {
        return $this->create([
            'exam_id' => $examId,
            'question_text' => $text,
            'options' => $options,
            'correct_answer' => $answer,
            'explanation' => $explanation
        ]);
    }

    /**
     * Update a question
     */
    public function update($conditions, $data) {
        // If $conditions is not an array, assume it's the ID
        if (!is_array($conditions)) {
            $conditions = ['id' => $conditions];
        }

        $stmt = $this->db->prepare("
            UPDATE questions 
            SET question_text = ?, options = ?, correct_answer = ?, explanation = ?, question_image = ?, updated_at = CURRENT_TIMESTAMP
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['question_text'] ?? $data['text'] ?? '',
            json_encode($data['options']),
            $data['correct_answer'] ?? $data['answer'] ?? 0,
            $data['explanation'] ?? null,
            $data['question_image'] ?? $data['image'] ?? null,
            $conditions['id']
        ]);
    }

    /**
     * Upload question image
     */
    public function uploadQuestionImage($file) {
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }
        
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        
        if (!in_array($file['type'], $allowedTypes)) {
            throw new \Exception('Invalid file type.');
        }
        
        if ($file['size'] > $maxFileSize) {
            throw new \Exception('File size too large.');
        }
        
        $uploadDir = __DIR__ . '/../../public/assets/questions/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = 'question_' . time() . '_' . uniqid() . '.' . $extension;
        $filepath = $uploadDir . $filename;
        
        if (move_uploaded_file($file['tmp_name'], $filepath)) {
            return '/assets/questions/' . $filename;
        }
        
        return null;
    }

    /**
     * Delete question image
     */
    public function deleteQuestionImage($imageUrl) {
        if (empty($imageUrl)) return true;
        $filepath = __DIR__ . '/../../public' . $imageUrl;
        if (file_exists($filepath)) {
            return unlink($filepath);
        }
        return true;
    }

    public function findByExam($examId)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE exam_id = ? ORDER BY id ASC");
            $stmt->execute([$examId]);
            $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($questions as &$question) {
                if (isset($question['options']) && is_string($question['options'])) {
                    $question['options'] = json_decode($question['options'], true) ?? [];
                }
            }
            return $questions;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function deleteByExam($examId)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE exam_id = ?");
        return $stmt->execute([$examId]);
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        $question = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($question && isset($question['options']) && is_string($question['options'])) {
            $question['options'] = json_decode($question['options'], true) ?? [];
        }
        return $question;
    }
}
