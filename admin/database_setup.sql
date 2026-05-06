-- Create database
CREATE DATABASE IF NOT EXISTS calyst_school;
USE calyst_school;

-- Admin users table
CREATE TABLE IF NOT EXISTS admins (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    role VARCHAR(20) DEFAULT 'editor',
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL
);

-- School settings table
CREATE TABLE IF NOT EXISTS school_settings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value LONGTEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Pages content table
CREATE TABLE IF NOT EXISTS pages_content (
    id INT PRIMARY KEY AUTO_INCREMENT,
    page_slug VARCHAR(50) UNIQUE NOT NULL,
    page_title VARCHAR(200) NOT NULL,
    page_content LONGTEXT,
    meta_description VARCHAR(160),
    meta_keywords VARCHAR(200),
    updated_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (updated_by) REFERENCES admins(id)
);

-- News & Events table
CREATE TABLE IF NOT EXISTS news_events (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    description LONGTEXT,
    event_date DATE,
    event_time TIME,
    category ENUM('news', 'event') DEFAULT 'news',
    featured_image VARCHAR(255),
    is_published BOOLEAN DEFAULT TRUE,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES admins(id)
);

-- Staff/Administration table
CREATE TABLE IF NOT EXISTS staff (
    id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(100) NOT NULL,
    title VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(20),
    bio LONGTEXT,
    photo_url VARCHAR(255),
    display_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Gallery table
CREATE TABLE IF NOT EXISTS gallery (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    image_url VARCHAR(255) NOT NULL,
    category VARCHAR(50),
    display_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Testimonials table
CREATE TABLE IF NOT EXISTS testimonials (
    id INT PRIMARY KEY AUTO_INCREMENT,
    author_name VARCHAR(100) NOT NULL,
    author_title VARCHAR(100),
    testimonial_text LONGTEXT NOT NULL,
    is_published BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Fees table
CREATE TABLE IF NOT EXISTS fees (
    id INT PRIMARY KEY AUTO_INCREMENT,
    class_name VARCHAR(100) NOT NULL,
    tuition_amount DECIMAL(10, 2) NOT NULL,
    activity_fee DECIMAL(10, 2),
    transport_fee DECIMAL(10, 2),
    other_fees TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Contact submissions table
CREATE TABLE IF NOT EXISTS contact_submissions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(200),
    message LONGTEXT NOT NULL,
    status ENUM('new', 'read', 'replied', 'archived') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default admin user (username: admin, password: admin123)
INSERT IGNORE INTO admins (username, email, password_hash, full_name, role) VALUES
('admin', 'admin@calystschool.com', '$2y$10$2DJHs.P8s5UqNwVJQyQ9eOqW.R.L.2Dz2zE.F.K.L.8.8.8.8.8.8', 'Administrator', 'admin');

-- Insert initial school settings
INSERT IGNORE INTO school_settings (setting_key, setting_value) VALUES
('school_name', 'Calyst Christian School'),
('school_motto', 'HOFU YA BWANA'),
('school_phone_1', '+256 774-744-394'),
('school_phone_2', '+256 752-482-066'),
('school_email', 'mugalureagan18@gmail.com'),
('school_address', 'Uganda'),
('facebook_url', 'https://www.facebook.com/profile.php?id=100090556566888'),
('instagram_url', 'https://www.instagram.com/calystchristianschool?igsh=MXJyeGR0eXhqY2M5cA=='),
('youtube_url', 'https://youtube.com/@calystchristianschools?si=bYJ8VI1UN6YCzrmH');
