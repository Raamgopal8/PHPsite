-- Create achievements table for achievers
CREATE TABLE IF NOT EXISTS achievements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(255) NOT NULL,
    exam_name VARCHAR(255) NOT NULL,
    rank_or_score VARCHAR(100) NOT NULL,
    achievement_description TEXT NULL,
    image_url VARCHAR(500) NULL,
    batch_year VARCHAR(50) NULL,
    department VARCHAR(100) NULL,
    is_featured BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_is_active (is_active),
    INDEX idx_is_featured (is_featured),
    INDEX idx_created_at (created_at),
    INDEX idx_batch_year (batch_year)
);
