-- Modify syllabi table to use links instead of content
ALTER TABLE syllabi 
DROP COLUMN content,
ADD COLUMN url VARCHAR(500) NOT NULL AFTER subject;
