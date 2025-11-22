-- Add logout_time and session_id to login_logs
ALTER TABLE login_logs 
ADD COLUMN logout_time TIMESTAMP NULL DEFAULT NULL,
ADD COLUMN session_id VARCHAR(255) NULL;

-- Add index for session_id for faster lookups during logout
CREATE INDEX idx_session_id ON login_logs(session_id);
