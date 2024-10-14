### Things to do in order to build Web app
	- DRAW ON HOW YOU WANT THE WEBSITE TO LOOK LIKE
	- RESEARCH ABOUT VISITOR MANAGEMENT SYSTEM
	- RESEARCH ABOUT HOW TO IMPLEMENT THE QR
	- bu
## INFORMATION ABOUT THE PROJECT 
>	-  [GPT PROMPT](https://chatgpt.com/share/66e57643-66c8-8004-b9ac-49bdab216d94)
>	- [AISTUDIO PROMPT](https://aistudio.google.com/app/prompts/1eU8peAHGtJNJIz7txgK7_mG4jFoew-ek)
### **Key Features of VMS**
1. **Visitor Registration**:
    - Create a form to register visitors.
    - After registration, generate a unique **QR code** linked to the visitor's account.
    - Store visitor details (name, contact, date of birth, address, etc.) in the database.
2. **QR Code Generation**:
    - After successful registration, generate a **QR code**.
    - Ensure the QR code contains visitor ID, visit date, and unique session info.
3. **Visitor Check-In & Check-Out**:
    - At the jail entrance, the visitor scans the QR code.
    - Use a **scanner device or mobile** (browser-based scanning) to track when they scan in (Check-in time) and when they scan out (Check-out time).
    - Store check-in and check-out timestamps in the database.
4. **Visitor Status Tracking**:
    - A dashboard for the admin to see who is currently inside the jail, who visited recently, and how long each visit lasted.
6. **Blacklist Visitors**
	- Implement a feature that allows jail authorities to blacklist certain visitors, preventing them from registering or entering the jail.
	- This could be based on visitor behavior, past incidents, or other criteria.
7.  **Visit History & Logs**
	- Provide each visitor with access to their visit history, showing previous visits, dates, times, and duration.
	- Jail authorities should have a complete log of all visitor activities, including any missed or denied visits.
8.  **Visitor Identification Validation**
	- Add a **document verification** feature where visitors must upload an ID (e.g., driver’s license, passport) during registration, which will be verified by the jail authorities before the QR code is issued.
9. **Visitor Analytics & Reports**
	- Generate reports and analytics on visitor activity, such as peak visit times, most frequent visitors, average visit duration, and total daily or monthly visitors. This could help jail administration with resource allocation and management.
## USER FUNCTIONS
- __ADMIN
	*A higher-level authority who oversees the entire system.*
	- (create, delete, or modify Moderator accounts).
	- Delete or Un-blacklist  a Visitor
- __MODERATOR 
	*Jail staff who manage the visitor management system.*
	- View and approve visitor registrations (including document verification).
	- Track visitors’ check-ins, check-outs, and status.
	- Blacklist visitors if needed.
	- Manage inmates and their visitors.
	- **Access Level**: Full access to all visitor data, visit logs, and reports.
- __VISITOR
	*People who visit the jail to see an inmate.*
	- Register on the system.
	- Upload ID for verification.
	- Receive and use their QR code to check in and out.
	- View their visit history.
## ALGORITHM
- **1. Visitor Registration & QR Code Generation**
	- **INFO**
		- **User Action:** Visitor provides information (name, contact, etc.) and submits the registration form.
		- **System Actions:**
		    - **Validate:** Check for data completeness and format.
		    - **ID Verification:** Prompt the visitor to upload an ID document for later review by a Moderator.
		    - **Generate Visitor ID:** Assign a unique identifier to the visitor.
		    - **Generate QR Code:** Create a unique QR code encoding:
		        - Visitor ID
		        - Current date
		        - Potentially a unique session identifier
		    - **Store:** Save visitor data (including QR code) in the visitors table.
		- **Output:** Display/send the QR code to the visitor (e.g., by email or on-screen for download).
	[[1. Visitor Registration & QR Code Generation Flowchart]]
- **2. Visitor Check-In**
	- **User Action:** Visitor arrives at the jail and presents their QR code to the scanning device/system.
	- **System Actions:**
	    - **Scan & Decode:** Read the QR code to retrieve the encoded visitor information.
	    - **Validate:**
	        - Check if the Visitor ID exists in the visitors table.
	        - Check if the visitor is blacklisted (is_blacklisted flag).
	        - Verify the date (to prevent use of old QR codes).
	    - **Inmate Validation**
		    - Prompt the Visitor to Enter the Name or ID of the inmate they are visiting.
		    - Verify if the Input Name or ID of the inmate exists;
	    - **Record Check-in:**
	        - If validation successful, create a new record in the visits table with:
	            - visitor_id
	            - inmate_id (link to the inmate they're visiting)
	            - check_in_time (current timestamp)
	            - visit_status (set to 'in progress' or equivalent)
	    - **Output:**
	        - **Success:** Display a confirmation message to the visitor (and optionally, the officer).
	        - **Failure:** Display an appropriate error message (e.g., "Invalid QR code," "Visitor Blacklisted").
	[[2. Visitor Check-In Flowchart]]
- 3. **Visitor Check-Out**
	- **User Action:** Visitor scans their QR code again when leaving the jail.
	- **System Actions:**
	    - **Scan & Decode:** Read the QR code.
	    - **Retrieve Visit Record:** Find the corresponding record in the visits table using the visitor_id and a visit_status indicating an ongoing visit.
	    - **Record Check-Out:**
	        - Update the visits record with:
	            - check_out_time (current timestamp)
	            - visit_status (set to 'completed')
	    - **Calculate Visit Duration:** Determine the time difference between check_in_time and check_out_time, and store it in the visit_duration field.
	    - **Output:** Display a confirmation message ("Check-out successful").
- 4. **Admin/Moderator Functions**
	- **Manage Visitors:**
	    - Search, view, edit, and delete visitor records.
	    - Blacklist/Un-blacklist visitors.
	    - Approve/Reject ID documents (if applicable).
	- **Manage Inmates:**
	    - Add, edit, or remove inmates.
	- **View Dashboard:**
	    - Monitor current visitors (those checked-in).
	    - View recent visits.
	    - Access visitor analytics and generate reports.
	- **Manage Accounts (for Superadmins):**
	    - Create, delete, or modify Moderator accounts.
	[[Moderator Functions]]



    ## SQL SCHEMA
```SQL
-- Table for storing visitor information (personal info only)
CREATE TABLE Visitors (
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
CREATE TABLE VisitorCredentials (
    visitor_id INT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    FOREIGN KEY (visitor_id) REFERENCES Visitors(visitor_id)
);

-- Separate table for QR code information
CREATE TABLE VisitorQRCode (
    visitor_id INT PRIMARY KEY,
    qr_code VARCHAR(255) UNIQUE NOT NULL,
    FOREIGN KEY (visitor_id) REFERENCES Visitors(visitor_id)
);

-- Table for storing inmate information
CREATE TABLE Inmates (
    inmate_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    inmate_number VARCHAR(50) UNIQUE NOT NULL, -- Assuming each inmate has a unique number 
    cell_number VARCHAR(10) 
);

-- Table for storing visit records
CREATE TABLE Visits (
    visit_id INT AUTO_INCREMENT PRIMARY KEY,
    visitor_id INT,
    inmate_id INT,
    check_in_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    check_out_time TIMESTAMP,
    visit_status ENUM('in progress', 'completed', 'cancelled') DEFAULT 'in progress',
    visit_duration INT, -- Calculated on checkout
    FOREIGN KEY (visitor_id) REFERENCES Visitors(visitor_id),
    FOREIGN KEY (inmate_id) REFERENCES Inmates(inmate_id)
);

-- Table for storing blacklist records (removed is_blacklisted from Visitors)
CREATE TABLE Blacklist (
    blacklist_id INT AUTO_INCREMENT PRIMARY KEY,
    visitor_id INT UNIQUE, -- One visitor can be blacklisted at a time
    reason TEXT,
    blacklist_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (visitor_id) REFERENCES Visitors(visitor_id)
);

-- Table for storing admin and moderator accounts (unchanged)
CREATE TABLE Users ( 
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL, -- Store password hashes, not plain text passwords
    role ENUM('superadmin', 'moderator') NOT NULL
);

-- Table for logging actions (unchanged)
CREATE TABLE AuditLog (
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
    target_table ENUM('Visitors', 'Inmates', 'Visits', 'Blacklist', 'Users') NOT NULL,
    target_record_id INT, -- The ID of the record affected by the action
    details TEXT -- Optional field for additional information about the action
);