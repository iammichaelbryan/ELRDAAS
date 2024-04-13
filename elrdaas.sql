-- MySQL dump 10.11
--
-- to install this database, from a terminal, type:
-- mysql -u USERNAME -p -h SERVERNAME elrdaas < elrdaas.sql
--
-- Host: localhost    Database: elrdaas
-- ------------------------------------------------------
-- Server version   5.0.45-log

DROP DATABASE IF EXISTS elrdaas;
CREATE DATABASE elrdaas;
USE elrdaas;

DROP TABLE IF EXISTS admins;
CREATE TABLE admins (
    id INT AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    tower ENUM('1', '2', '3', '4', '5') NOT NULL,
    assigned_complaints TEXT,
    PRIMARY KEY (id)
);

INSERT INTO admins (first_name, last_name, email, password, tower) VALUES
('Admin', 'One', 'admin1@example.com', 'password1', '1'),
('Admin', 'Two', 'admin2@example.com', 'password2', '2'),
('Admin', 'Three', 'admin3@example.com', 'password3', '3'),
('Admin', 'Four', 'admin4@example.com', 'password4', '4'),
('Admin', 'Five', 'admin5@example.com', 'password5', '5');

DROP TABLE IF EXISTS residents;
CREATE TABLE residents (
    id INT AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    tower ENUM('1', '2', '3', '4', '5') NOT NULL,
    complaints_made TEXT,
    PRIMARY KEY (id)
);

INSERT INTO residents (first_name, last_name, email, password, tower) VALUES
('Resident', 'One', 'resident1@example.com', 'password1', '1'),
('Resident', 'Two', 'resident2@example.com', 'password2', '2'),
('Resident', 'Three', 'resident3@example.com', 'password3', '3'),
('Resident', 'Four', 'resident4@example.com', 'password4', '4'),
('Resident', 'Five', 'resident5@example.com', 'password5', '5');

SET time_zone = '-05:00';

DROP TABLE IF EXISTS complaints;
CREATE TABLE complaints (
    id INT AUTO_INCREMENT,
    complaint_id VARCHAR(255) NOT NULL,
    complaint_type ENUM('Room Issue', 'Communal Area Issue', 'General Request') NOT NULL,
    complaint_body TEXT NOT NULL DEFAULT '',
    date_submitted DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Resolved', 'Pending Assignment', 'Assigned', 'In Progress') NOT NULL,
    priority ENUM('Low', 'Medium', 'High') NOT NULL DEFAULT 'Medium',
    assigned_to TEXT NOT NULL DEFAULT '',
    tower ENUM('1', '2', '3', '4', '5') NOT NULL,
    PRIMARY KEY (id)
);
ALTER TABLE complaints ADD COLUMN first_name VARCHAR(255) NOT NULL;
ALTER TABLE complaints ADD COLUMN last_name VARCHAR(255) NOT NULL;
ALTER TABLE complaints ADD COLUMN resident_id INT NOT NULL;
ALTER TABLE complaints ADD COLUMN message TEXT NOT NULL DEFAULT '';
/*ALTER TABLE complaints ADD COLUMN date_resolved DATETIME;*/


-- Inserting dummy data for complaints
INSERT INTO complaints (complaint_id, resident_id, first_name, last_name, complaint_type, complaint_body, date_submitted, status, priority, assigned_to, tower, message) VALUES
('C001', 1, 'John', 'Doe', 'Room Issue', 'Leaky faucet in bathroom.',NOW(), 'Pending Assignment', 'Medium', '', '1', 'Hello we will be looking into this issue shortly.'),
('C002', 2, 'Jane', 'Smith', 'Communal Area Issue', 'Broken elevator in Tower 2.', NOW(), 'Pending Assignment', 'Medium', '', '2', 'Hello we will be looking into this issue shortly.'),
('C003', 3, 'Emily', 'Johnson', 'General Request', 'Request for additional trash bins.', NOW(), 'Resolved', 'Low', 'Admin One', '3', 'Hello we will be looking into this issue shortly.'),
('C004', 4, 'Michael', 'Brown', 'Room Issue', 'Faulty air conditioning unit in Room 405.', NOW(), 'Assigned', 'High', 'Admin Two', '4', 'Hello we will be looking into this issue shortly.'),
('C005', 5, 'Sarah', 'Davis', 'Communal Area Issue', 'Leaking pipe in the laundry room.', NOW(), 'In Progress', 'Medium', 'Admin Three', '5', 'Hello we will be looking into this issue shortly.');



CREATE TABLE appointments (
    id INT AUTO_INCREMENT,
    appointment_id VARCHAR(40) NOT NULL DEFAULT '',
    status ENUM('Confirmed', 'Cancelled') NOT NULL DEFAULT 'Confirmed',
    resident_first_name VARCHAR(255) NOT NULL,
    resident_last_name VARCHAR(255) NOT NULL,
    resident_id INT NOT NULL,
    appointment_date DATE NOT NULL,  -- Changed from created_date for clarity
    appointment_time TIME NOT NULL,
    service ENUM('Wash Only', 'Dry Only', 'Washing & Drying', 'Unattended Wash & Dry') NOT NULL DEFAULT 'Washing & Drying',
    loads INT NOT NULL DEFAULT 1 CHECK (loads <= 3),
    cost INT NOT NULL DEFAULT 0, 
    PRIMARY KEY (id)
);


-- Inserting dummy data for appointments
INSERT INTO appointments (appointment_id, status, resident_first_name, resident_last_name, appointment_date, appointment_time, service, loads) VALUES
('A001', 'Confirmed', 'John', 'Doe', '2023-03-10', '14:00:00', 'Washing & Drying', 2),
('A002', 'Cancelled', 'Jane', 'Smith', '2023-03-11', '10:00:00', 'Dry Only', 1),
('A003', 'Confirmed', 'Emily', 'Johnson', '2023-03-12', '16:00:00', 'Wash Only', 3),
('A004', 'Confirmed', 'Michael', 'Brown', '2023-03-13', '09:00:00', 'Unattended Wash & Dry', 1),
('A005', 'Confirmed', 'Sarah', 'Davis', '2023-03-14', '15:00:00', 'Washing & Drying', 2);

DROP TABLE IF EXISTS feedback;
CREATE TABLE feedback (
    id INT AUTO_INCREMENT,
    request_id VARCHAR(20) NOT NULL DEFAULT '',
    student_name CHAR(35) NOT NULL DEFAULT '',
    feedback TEXT NOT NULL,
    rating INT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- Inserting dummy data for feedback, adjusted to use auto-incremented primary key 'id'
INSERT INTO feedback (request_id, student_name, feedback, rating) VALUES
('FB001', 'John Doe', 'Very satisfied with the laundry service.', 5),
('FB002', 'Jane Smith', 'The drying machines are a bit slow.', 3),
('FB003', 'Emily Johnson', 'Had a great experience, very efficient.', 4),
('FB004', 'Michael Brown', 'Could improve the cleanliness around washing machines.', 2),
('FB005', 'Sarah Davis', 'Friendly staff and good service.', 5);

DROP TABLE IF EXISTS notices;
CREATE TABLE notices (
    id INT AUTO_INCREMENT,
    admin_id INT NOT NULL,
    notice_id VARCHAR(255) NOT NULL,
    notice_date DATE,
    notice_time TIME,
    notice_subject VARCHAR(255) NOT NULL DEFAULT '',
    notice_content TEXT NOT NULL,
    PRIMARY KEY (id)
);
ALTER TABLE notices ADD COLUMN first_name VARCHAR(255) NOT NULL;
ALTER TABLE notices ADD COLUMN last_name VARCHAR(255) NOT NULL;

-- Inserting dummy data for notices
INSERT INTO notices (admin_id, notice_id, notice_date, notice_time, notice_subject, notice_content) VALUES
(1, 'N001', '2023-03-10', '08:00:00', 'Maintenance Update', 'The gym will be closed for maintenance on March 15th.'),
(5, 'N002', '2023-03-11', '09:00:00', 'Parking Allocation', 'Additional parking spots available from April.'),
(3, 'N003', '2023-03-12', '10:00:00', 'Security Measures', 'New security cameras have been installed in common areas.'),
(4, 'N004', '2023-03-13', '11:00:00', 'Community Meeting', 'Annual residents meeting scheduled for March 20th.'),
(2, 'N005', '2023-03-14', '12:00:00', 'Water Shutdown', 'Temporary water shutdown for maintenance on March 18th.');

DROP TABLE IF EXISTS scheduled_notices;

CREATE TABLE scheduled_notices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    notice_id VARCHAR(255) NOT NULL,
    execute_date DATE NOT NULL,
    execute_time TIME NOT NULL,
    notice_subject VARCHAR(255) NOT NULL,
    notice_content TEXT NOT NULL,
    status ENUM('Pending', 'Executed') DEFAULT 'Pending'
);

DROP TABLE IF EXISTS notifications;

CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    user_type ENUM('Admin', 'Resident') NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    notification_type ENUM('Complaint', 'Appointment', 'Notice') NOT NULL,
    notification_id INT NOT NULL,
    message TEXT NOT NULL,
    status ENUM('Unread', 'Read') DEFAULT 'Unread'
);

UNLOCK TABLES