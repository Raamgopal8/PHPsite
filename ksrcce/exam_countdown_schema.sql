-- Create exam countdowns table
CREATE TABLE IF NOT EXISTS exam_countdowns (
    id INT AUTO_INCREMENT PRIMARY KEY,
    exam_name VARCHAR(255) NOT NULL,
    exam_date DATE NOT NULL,
    exam_time TIME DEFAULT '09:00:00',
    description TEXT NULL,
    target_audience ENUM('all', 'students', 'admins') DEFAULT 'all',
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_exam_date (exam_date),
    INDEX idx_is_active (is_active),
    INDEX idx_target_audience (target_audience)
);
