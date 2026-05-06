-- Admissions submissions table
CREATE TABLE IF NOT EXISTS admissions_submissions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    child_name VARCHAR(100) NOT NULL,
    child_gender ENUM('male', 'female') NOT NULL,
    birth_certificate_file VARCHAR(255),
    parent_name VARCHAR(100) NOT NULL,
    parent_nin VARCHAR(20) NOT NULL,
    relationship VARCHAR(50) NOT NULL,
    parent_phone VARCHAR(20) NOT NULL,
    parent_email VARCHAR(100) NOT NULL,
    residential_address LONGTEXT NOT NULL,
    special_needs LONGTEXT,
    privacy_consent BOOLEAN DEFAULT FALSE,
    status ENUM('new', 'reviewed', 'accepted', 'rejected', 'archived') DEFAULT 'new',
    notes LONGTEXT,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    reviewed_at TIMESTAMP NULL,
    reviewed_by INT NULL,
    FOREIGN KEY (reviewed_by) REFERENCES admins(id)
);
