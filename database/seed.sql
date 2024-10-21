-- SQL to populate initial data for testing


-- 1. Insert Sample Visitors
INSERT INTO Visitors (first_name, last_name, email, contact_number, date_of_birth, address_street, address_city, address_state, address_zip, id_document_path, is_verified)
VALUES 
('John', 'Doe', 'john.doe@example.com', '1234567890', '1980-01-15', '123 Main St', 'Cityville', 'StateA', '12345', 'uploads/ids/john_doe_id.pdf', TRUE),
('Jane', 'Smith', 'jane.smith@example.com', '0987654321', '1990-05-22', '456 Maple Ave', 'Townsville', 'StateB', '67890', 'uploads/ids/jane_smith_id.pdf', TRUE),
('Tom', 'Johnson', 'tom.johnson@example.com', '2345678901', '1985-09-30', '789 Oak Rd', 'Villageville', 'StateC', '54321', 'uploads/ids/tom_johnson_id.pdf', FALSE),
('Emily', 'Williams', 'emily.williams@example.com', '3456789012', '1995-07-10', '321 Pine St', 'Hamletville', 'StateD', '98765', 'uploads/ids/emily_williams_id.pdf', TRUE);

-- 2. Insert Sample Visitor Credentials
INSERT INTO VisitorCredentials (visitor_id, username, password_hash)
VALUES 
(1, 'johndoe', '$2y$10$wz7EMW9hIdK/7rPdwIeyJ.fxPvwpzbsK/ebHCdTLgA4HOosN6gt3W'), -- Password hash for 'password123'
(2, 'janesmith', '$2y$10$KjXrnpVx4PVZz9Rk.ZHwZeOpPK6O/Xh.2lbsoh/FCMwlB6UMAxVZm'), -- Password hash for 'password456'
(3, 'tomjohnson', '$2y$10$F4KieM7NQ3l6I7MP7XzehOvlTxd7mjNpMezk.pflK1.U9AoP1H34W'), -- Password hash for 'password789'
(4, 'emilywilliams', '$2y$10$TsV5IqTHPqzAwe9sJUMOR.2ACRTuvOQOkz8DYwOiQyRaA9U7n/QFS'); -- Password hash for 'password321'

-- 3. Insert Sample QR Codes
INSERT INTO VisitorQRCode (visitor_id, qr_code)
VALUES 
(1, 'QR1_JOHNDOE_2024'),
(2, 'QR2_JANESMITH_2024'),
(3, 'QR3_TOMJOHNSON_2024'),
(4, 'QR4_EMILYWILLIAMS_2024');

-- 4. Insert Sample Inmates
INSERT INTO Inmates (first_name, last_name, inmate_number, cell_number)
VALUES 
('Michael', 'Brown', 'IN12345', 'C-12'),
('David', 'Miller', 'IN67890', 'B-8'),
('Laura', 'Wilson', 'IN54321', 'A-3'),
('Susan', 'Taylor', 'IN98765', 'D-10');

-- 5. Insert Sample Visits
INSERT INTO Visits (visitor_id, inmate_id, check_in_time, check_out_time, visit_status, visit_duration)
VALUES 
(1, 1, '2024-10-01 09:00:00', '2024-10-01 10:00:00', 'completed', 60),
(2, 2, '2024-10-02 14:30:00', '2024-10-02 15:00:00', 'completed', 30),
(3, 3, '2024-10-03 11:00:00', NULL, 'in progress', NULL),
(4, 4, '2024-10-04 16:00:00', '2024-10-04 17:30:00', 'completed', 90);

-- 6. Insert Sample Blacklist Entries
INSERT INTO Blacklist (visitor_id, reason)
VALUES 
(3, 'Attempted to bring contraband into the facility');

-- 7. Insert Sample Users (Admins/Moderators)
INSERT INTO Users (username, password_hash, role)
VALUES 
('admin', '$2y$10$Ls5hEB9FZ/sbvO/PnCZeb.gPvZ1WSv4f3ReJD8fFsGmCwZHE6duwW', 'superadmin'), -- Password hash for 'adminpass'
('mod1', '$2y$10$XsHZaJx0GHGeAEb4hHCU7eavLqCwkkL47ZLoUODZV/A0FghXOR.SS', 'moderator'); -- Password hash for 'modpass'

-- 8. Insert Sample Audit Logs
INSERT INTO AuditLog (user_id, action_type, target_table, target_record_id, details)
VALUES 
(1, 'visitor_registered', 'Visitors', 1, 'Registered visitor John Doe'),
(2, 'visitor_blacklisted', 'Blacklist', 3, 'Tom Johnson was blacklisted for contraband'),
(1, 'inmate_added', 'Inmates', 1, 'Inmate Michael Brown added'),
(2, 'visit_started', 'Visits', 3, 'Visit started for Tom Johnson');

