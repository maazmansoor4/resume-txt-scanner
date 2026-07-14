CREATE DATABASE IF NOT EXISTS resume_scanner;
USE resume_scanner;

CREATE TABLE IF NOT EXISTS applicants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(255),
    education VARCHAR(255),
    gpa VARCHAR(255)
);