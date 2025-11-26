<?php
namespace App\Models;

class Syllabus extends BaseModel 
{
    protected $table = 'syllabus';

    /**
     * Save syllabus content for an exam
     * 
     * @param string $examId
     * @param string $content
     * @return bool|string
     */
    public function saveSyllabus($examId, $content)
    {
        try {
            // Check if syllabus exists for this exam
            $existing = $this->find(['exam_id' => $examId]);
            
            if ($existing) {
                // Update existing syllabus
                return $this->update(
                    ['_id' => $existing['_id']],
                    [
                        'content' => $content,
                        'updated_at' => date('c')
                    ]
                );
            } else {
                // Create new syllabus
                return $this->insert([
                    'exam_id' => $examId,
                    'content' => $content,
                    'created_at' => date('c'),
                    'updated_at' => date('c')
                ]);
            }
        } catch (\Exception $e) {
            error_log("Error saving syllabus: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get syllabus by exam ID
     * 
     * @param string $examId
     * @return array|null
     */
    public function getByExam($examId)
    {
        try {
            return $this->find(['exam_id' => $examId]);
        } catch (\Exception $e) {
            error_log("Error fetching syllabus: " . $e->getMessage());
            return null;
        }
    }
}