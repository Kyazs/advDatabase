CREATE DATABASE IF NOT EXISTS vmsJAIL;
-- drop database vmsjail;
-- DROP DATABASE IF EXISTS vmsJAIL;
USE vmsJAIL;

CREATE TABLE IF NOT EXISTS Gender (
    gender_id INT AUTO_INCREMENT PRIMARY KEY,
    gender_name VARCHAR(50) NOT NULL UNIQUE
);
INSERT INTO Gender (gender_name) VALUES ('Male'), ('Female'), ('Non-binary'), ('Other');

CREATE TABLE IF NOT EXISTS id_types (
    id_type_id INT AUTO_INCREMENT PRIMARY KEY,
    id_type_name VARCHAR(50) NOT NULL UNIQUE
);

INSERT INTO id_types (id_type_name) VALUES ('Passport'), ('Driver''s License'), ('National ID'), ('Other');
-- Visitors table
CREATE TABLE IF NOT EXISTS Visitors (
    visitor_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    contact_number VARCHAR(20) UNIQUE,
    gender_id INT,
    date_of_birth DATE,
    country VARCHAR(20), -- Added country column
    address_street VARCHAR(255),
    address_city VARCHAR(100),
    address_province VARCHAR(100),
    address_barangay VARCHAR(100),
    address_zip VARCHAR(20),
    id_type INT,
    id_document_path TEXT,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_verified BOOLEAN DEFAULT FALSE,
    is_deleted BOOLEAN DEFAULT FALSE, -- Renamed is_delete to is_deleted,
    FOREIGN KEY (gender_id) REFERENCES Gender(gender_id),
    FOREIGN KEY (id_type) REFERENCES id_types(id_type_id)
);


-- Visitor credentials
CREATE TABLE IF NOT EXISTS VisitorCredentials (
    credential_id INT AUTO_INCREMENT PRIMARY KEY, -- Changed to allow multiple credentials
    visitor_id INT,
    username VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    is_deleted BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (visitor_id) REFERENCES Visitors (visitor_id) ON DELETE CASCADE -- Added ON DELETE
);

-- Separate table for QR code information
CREATE TABLE IF NOT EXISTS VisitorQRCode (
    qr_id INT AUTO_INCREMENT PRIMARY KEY, -- Changed to allow multiple QR codes
    visitor_id INT,
    qr_code VARCHAR(255) UNIQUE NOT NULL,
    is_deleted BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (visitor_id) REFERENCES Visitors (visitor_id) ON DELETE CASCADE -- Added ON DELETE
);

-- Inmates table (unchanged)
CREATE TABLE IF NOT EXISTS Inmates (
    inmate_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    inmate_number VARCHAR(50) UNIQUE NOT NULL,
    cell_number VARCHAR(10)
);

-- Visit statuses
CREATE TABLE IF NOT EXISTS VisitStatus (
    status_id INT AUTO_INCREMENT PRIMARY KEY,
    status_name VARCHAR(50) NOT NULL UNIQUE
);

INSERT INTO
    VisitStatus (status_name)
VALUES ('in progress'),
    ('completed'),
    ('cancelled');

-- Visits table with calculated visit_duration in application logic
CREATE TABLE IF NOT EXISTS Visits (
    visit_id INT AUTO_INCREMENT PRIMARY KEY,
    visitor_id INT,
    inmate_id INT,
    check_in_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    check_out_time TIMESTAMP NULL,
    visit_status INT DEFAULT 1, -- Refers to the VisitStatus table, default to 'in progress'
    visit_duration INT NULL, -- Calculated in application logic
    FOREIGN KEY (visitor_id) REFERENCES Visitors (visitor_id) ON DELETE CASCADE,
    FOREIGN KEY (inmate_id) REFERENCES Inmates (inmate_id),
    FOREIGN KEY (visit_status) REFERENCES VisitStatus (status_id)
);

-- Blacklist table
CREATE TABLE IF NOT EXISTS Blacklist (
    blacklist_id INT AUTO_INCREMENT PRIMARY KEY,
    visitor_id INT,
    reason TEXT,
    blacklist_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_deleted BOOLEAN DEFAULT FALSE, -- Renamed is_delete to is_deleted
    FOREIGN KEY (visitor_id) REFERENCES Visitors (visitor_id) ON DELETE CASCADE
);

-- Roles table
CREATE TABLE IF NOT EXISTS Roles (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL UNIQUE
);

INSERT INTO Roles (role_name) VALUES ('superadmin'), ('moderator');

-- Users table
CREATE TABLE IF NOT EXISTS Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role_id INT,
    FOREIGN KEY (role_id) REFERENCES Roles (role_id)
);

-- Action types table
CREATE TABLE IF NOT EXISTS ActionTypes (
    action_type_id INT AUTO_INCREMENT PRIMARY KEY,
    action_type_name VARCHAR(100) NOT NULL UNIQUE
);

INSERT INTO
    ActionTypes (action_type_name)
VALUES ('visitor_registered'),
    ('visitor_updated'),
    ('visitor_blacklisted'),
    ('visitor_unblacklisted'),
    ('inmate_added'),
    ('inmate_updated'),
    ('inmate_deleted'),
    ('visit_started'),
    ('visit_completed'),
    ('visit_cancelled'),
    ('user_added'),
    ('user_updated'),
    ('user_deleted'),
    ('audit_log_viewed');

CREATE TABLE IF NOT EXISTS AuditLog (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT, -- The user who initiated the action (can be NULL for system events)
    action_type_id INT NOT NULL, -- Foreign key to ActionTypes table
    visitor_id INT, -- Nullable foreign key to Visitors
    inmate_id INT, -- Nullable foreign key to Inmates
    visit_id INT, -- Nullable foreign key to Visits
    details TEXT, -- Optional field for additional information about the action
    FOREIGN KEY (user_id) REFERENCES Users (user_id),
    FOREIGN KEY (action_type_id) REFERENCES ActionTypes (action_type_id),
    FOREIGN KEY (visitor_id) REFERENCES Visitors (visitor_id) ON DELETE SET NULL,
    FOREIGN KEY (inmate_id) REFERENCES Inmates (inmate_id) ON DELETE SET NULL,
    FOREIGN KEY (visit_id) REFERENCES Visits (visit_id) ON DELETE SET NULL
);

DELIMITER $$
-- Triggers to Enforce Soft Deletes on  VisitorCredentials & VisitorQRCode:
CREATE TRIGGER IF NOT EXISTS soft_delete_visitor
BEFORE UPDATE ON Visitors
FOR EACH ROW
BEGIN
    IF NEW.is_deleted = TRUE THEN
        UPDATE VisitorCredentials SET is_deleted = TRUE WHERE visitor_id = OLD.visitor_id;
        UPDATE VisitorQRCode SET is_deleted = TRUE WHERE visitor_id = OLD.visitor_id;
    END IF;
END$$

-- Trigger to calculate visit duration on insert
CREATE TRIGGER IF NOT EXISTS calculate_visit_duration_insert
BEFORE INSERT ON Visits
FOR EACH ROW
BEGIN
    IF NEW.check_out_time IS NOT NULL THEN
        SET NEW.visit_duration = TIMESTAMPDIFF(MINUTE, NEW.check_in_time, NEW.check_out_time);
    ELSE
        SET NEW.visit_duration = NULL;  -- Indicate that duration is not applicable
    END IF;
END$$

-- Trigger to calculate visit duration on update
CREATE TRIGGER IF NOT EXISTS calculate_visit_duration_update
BEFORE UPDATE ON Visits
FOR EACH ROW
BEGIN
    IF NEW.check_out_time IS NOT NULL THEN
        SET NEW.visit_duration = TIMESTAMPDIFF(MINUTE, NEW.check_in_time, NEW.check_out_time);
    ELSE
        SET NEW.visit_duration = NULL;  -- Indicate that duration is not applicable
    END IF;
END$$
DELIMITER ;

-- Create indexes to improve query performance
-- Index on email for quick lookups of visitors by email
CREATE INDEX IF NOT EXISTS idx_email ON Visitors(email);
-- Index on gender_id to speed up queries filtering by gender
CREATE INDEX IF NOT EXISTS idx_gender_id ON Visitors(gender_id);
-- Index on visitor_id in VisitorCredentials for faster joins with Visitors table
CREATE INDEX IF NOT EXISTS idx_visitor_id_credentials ON VisitorCredentials(visitor_id);
-- Index on username for quick access during user login
CREATE INDEX IF NOT EXISTS idx_username ON VisitorCredentials(username);
-- Index on visitor_id in VisitorQRCode for faster joins with Visitors table
CREATE INDEX IF NOT EXISTS idx_visitor_id_qr ON VisitorQRCode(visitor_id);
-- Index on qr_code for quick lookups of QR codes
CREATE INDEX IF NOT EXISTS idx_qr_code ON VisitorQRCode(qr_code);
-- Index on inmate_number for quick access to inmates by their number
CREATE INDEX IF NOT EXISTS idx_inmate_number ON Inmates(inmate_number);
-- Index on visitor_id in Visits for faster joins with Visitors table
CREATE INDEX IF NOT EXISTS idx_visitor_id_visits ON Visits(visitor_id);
-- Index on inmate_id in Visits for faster joins with Inmates table
CREATE INDEX IF NOT EXISTS idx_inmate_id ON Visits(inmate_id);
-- Index on visit_status for filtering visits by their status
CREATE INDEX IF NOT EXISTS idx_visit_status ON Visits(visit_status);
-- Index on visitor_id in Blacklist for faster lookups of blacklisted visitors
CREATE INDEX IF NOT EXISTS idx_visitor_id_blacklist ON Blacklist(visitor_id);
-- Index on user_id in AuditLog for quick access to logs by user
CREATE INDEX IF NOT EXISTS idx_user_id ON AuditLog(user_id);
-- Index on action_type_id in AuditLog for filtering logs by action type
CREATE INDEX IF NOT EXISTS idx_action_type_id ON AuditLog(action_type_id);
-- Index on visitor_id in AuditLog for filtering logs related to specific visitors
CREATE INDEX IF NOT EXISTS idx_visitor_id_audit ON AuditLog(visitor_id);
-- Index on inmate_id in AuditLog for filtering logs related to specific inmates
CREATE INDEX IF NOT EXISTS idx_inmate_id_audit ON AuditLog(inmate_id);
-- Index on visit_id in AuditLog for filtering logs related to specific visits
CREATE INDEX IF NOT EXISTS idx_visit_id_audit ON AuditLog(visit_id);