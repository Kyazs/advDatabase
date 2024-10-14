CREATE DATABASE IF NOT EXISTS vmsJAIL;

USE vmsJAIL;

CREATE TABLE IF NOT EXISTS Visitors (
    visitor_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE,
    contact_number VARCHAR(15),
    date_of_birth DATE,
    address_street VARCHAR(255),
    address_city VARCHAR(100),
    address_state VARCHAR(100),
    address_zip VARCHAR(10),
    id_document_path TEXT,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_verified BOOLEAN DEFAULT FALSE
);

-- Separate table for visitor credentials
CREATE TABLE IF NOT EXISTS VisitorCredentials (
    visitor_id INT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    FOREIGN KEY (visitor_id) REFERENCES Visitors (visitor_id)
);

-- Separate table for QR code information
CREATE TABLE IF NOT EXISTS VisitorQRCode (
    visitor_id INT PRIMARY KEY,
    qr_code VARCHAR(255) UNIQUE NOT NULL,
    FOREIGN KEY (visitor_id) REFERENCES Visitors (visitor_id)
);

-- Table for storing inmate information
CREATE TABLE IF NOT EXISTS Inmates (
    inmate_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    inmate_number VARCHAR(50) UNIQUE NOT NULL, -- Assuming each inmate has a unique number 
    cell_number VARCHAR(10)
);

-- Table for storing visit records
CREATE TABLE IF NOT EXISTS Visits (
    visit_id INT AUTO_INCREMENT PRIMARY KEY,
    visitor_id INT,
    inmate_id INT,
    check_in_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    check_out_time TIMESTAMP NULL,
    visit_status ENUM(
        'in progress',
        'completed',
        'cancelled'
    ) DEFAULT 'in progress',
    visit_duration INT, -- Calculated on checkout
    FOREIGN KEY (visitor_id) REFERENCES Visitors (visitor_id),
    FOREIGN KEY (inmate_id) REFERENCES Inmates (inmate_id)
);

-- Table for storing blacklist records (removed is_blacklisted from Visitors)
CREATE TABLE IF NOT EXISTS Blacklist (
    blacklist_id INT AUTO_INCREMENT PRIMARY KEY,
    visitor_id INT UNIQUE, -- One visitor can be blacklisted at a time
    reason TEXT,
    blacklist_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (visitor_id) REFERENCES Visitors (visitor_id)
);

-- Table for storing admin and moderator accounts (unchanged)
CREATE TABLE IF NOT EXISTS Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL, -- Store password hashes, not plain text passwords
    role ENUM('superadmin', 'moderator') NOT NULL
);

-- Table for logging actions (unchanged)
CREATE TABLE IF NOT EXISTS AuditLog (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT, -- The user who initiated the action (can be NULL for system events)
    action_type ENUM(
        'visitor_registered',
        'visitor_updated',
        'visitor_blacklisted',
        'visitor_unblacklisted',
        'visitor_logged_in',
        'visitor_qr_code_generated',
        'visit_started',
        'visit_ended',
        'inmate_added',
        'inmate_updated',
        'inmate_deleted',
        'user_created',
        'user_updated',
        'user_deleted'
    ) NOT NULL,
    target_table ENUM(
        'Visitors',
        'Inmates',
        'Visits',
        'Blacklist',
        'Users'
    ) NOT NULL,
    target_record_id INT, -- The ID of the record affected by the action
    details TEXT -- Optional field for additional information about the action
);