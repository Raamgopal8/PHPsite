<?php
namespace App\Models;

use PDO;
use PDOException;

class Question extends BaseModel 
{
    protected $table = 'questions';

    /**
     * Parse text content and extract questions
     * 
     * @param string $content Text content to parse
     * @return array Array of parsed questions
     */
    public function parseQuestionsFromText($content) 
    {
        $questions = [];
        $lines = explode("\n", trim($content));
        $currentQuestion = null;

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;

            // Check for question line (starts with number and dot or Q:)
            if (preg_match('/^(\d+\.|Q[:.]?\s*)(.+)/i', $line, $matches)) {
                if ($currentQuestion) {
                    $questions[] = $currentQuestion;
                }
                $currentQuestion = [
                    'text' => trim($matches[2]),
                    'options' => [],
                    'answer' => -1,
                    'explanation' => ''
                ];
            }
            // Check for option (starts with a letter and parenthesis)
            elseif (preg_match('/^([A-D])\)\s*\*?(.+?)\*?\s*$/i', $line, $matches)) {
                if ($currentQuestion) {
                    $optionText = trim($matches[2]);
                    $currentQuestion['options'][] = $optionText;
                    
                    // If line has an asterisk, it's the correct answer
                    if (strpos($line, '*') !== false) {
                        $currentQuestion['answer'] = count($currentQuestion['options']) - 1;
                    }
                }
            }
            // Check for explanation
            elseif (preg_match('/^Explanation[:\s]+(.+)/i', $line, $matches) && $currentQuestion) {
                $currentQuestion['explanation'] = trim($matches[1]);
            }
            // If it's a continuation of the question or option
            elseif ($currentQuestion) {
                if (empty($currentQuestion['options'])) {
                    $currentQuestion['text'] .= ' ' . $line;
                } else {
                    $lastOption = count($currentQuestion['options']) - 1;
                    if ($lastOption >= 0) {
                        $currentQuestion['options'][$lastOption] .= ' ' . $line;
                    }
                }
            }
        }

        // Add the last question
        if ($currentQuestion) {
            $questions[] = $currentQuestion;
        }

        return $questions;
    }

    /**
     * Save multiple questions for an exam
     * 
     * @param string $examId
     * @param array $questions
     * @return array Array of inserted question IDs
     */
    public function saveQuestions($examId, $questions) 
    {
        $insertedIds = [];
        
        foreach ($questions as $question) {
            if (empty($question['text']) || count($question['options']) < 2 || $question['answer'] === -1) {
                continue; // Skip invalid questions
            }
            
            $result = $this->createQuestion(
                $examId,
                $question['text'],
                $question['options'],
                $question['answer'],
                $question['explanation'] ?? ''
            );
            
            if ($result) {
                $insertedIds[] = $result;
            }
        }
        
        return $insertedIds;
    }

    /**
     * Create a new question
     * 
     * @param int $examId
     * @param string $text
     * @param array $options
     * @param int $answer
     * @param string $explanation
     * @return int|bool Inserted question ID or false on failure
     */
    public function createQuestion($examId, $text, $options, $answer, $explanation = '')
    {
        try {
            $optionsJson = json_encode($options);
            
            $stmt = $this->db->prepare("
                INSERT INTO {$this->table} 
                (exam_id, question_text, options, correct_answer, explanation, created_at) 
                VALUES (?, ?, ?, ?, ?, NOW())
            ");
            
            $stmt->execute([
                $examId,
                $text,
                $optionsJson,
                $answer,
                $explanation
            ]);
            
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error creating question: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Find questions by exam ID
     * 
     * @param int $examId
     * @return array
     */
    public function findByExam($examId)
    {
        try {
            $stmt = $this->db->prepare("
                SELECT * FROM {$this->table} 
                WHERE exam_id = ? 
                ORDER BY id ASC
            ");
            
            $stmt->execute([$examId]);
            $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Decode JSON options field for each question
            foreach ($questions as &$question) {
                if (isset($question['options']) && is_string($question['options'])) {
                    $question['options'] = json_decode($question['options'], true) ?? [];
                }
            }
            
            return $questions;
        } catch (PDOException $e) {
            error_log("Error finding questions: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Get a single question by ID
     * 
     * @param int $id
     * @return array|bool Question data or false if not found
     */
    public function findById($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error finding question: " . $e->getMessage());
            return false;
        }
    }
}