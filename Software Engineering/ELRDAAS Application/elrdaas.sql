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

--
-- Table structure for table `admins`
--
CREATE TABLE `admins` (
  `id` int(11) NOT NULL auto_increment,
  `first_name` char(35) NOT NULL default '',
  `last_name` char(35) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `password` varchar(255) NOT NULL default '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4080 DEFAULT CHARSET=utf8mb4;



--
-- Dumping data for table `admins`
LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Jonathan','Doe','jonathandoe@fakemail.com','adminpassword'),
(2,'Peter','Parker','peterparker@fakemail.com','adminpassword'),
(3,'Michelle','Bryan','mjaybryan2@gmail.com','adminpassword');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;


CREATE TABLE `residents` (
  `id` int(11) NOT NULL auto_increment,
  `first_name` char(35) NOT NULL default '',
  `last_name` char(35) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `password` varchar(255) NOT NULL default '',
  `room` int(4) NOT NULL default 0,
  `tower` enum('Olympus','Dragons', 'Orion', 'Phoenix', 'Apollo') NOT NULL default 'Dragons',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4080 DEFAULT CHARSET=utf8mb4;


--
-- Dumping data for table `residents`
--
INSERT INTO `residents` VALUES 
(1, 'Brendon', 'Urie', 'brendonurrie@fakemail.com', 'respassword', 5211, 'Dragons'),
(2, 'Hayley', 'Williams', 'haleywilliams@gmail.com', 'respassword', 2115, 'Phoenix'),
(3, 'Michael', 'Bryan', 'mikeybryan2310@gmail.com', 'respassword', 5118, 'Dragons');









DROP TABLE IF EXISTS `complaints`;
CREATE TABLE `complaints` (
  `complaint_id` varchar(40) NOT NULL,
  `first_name` varchar(35) NOT NULL,
  `last_name` varchar(35) NOT NULL,
  `complaint_type` enum('Room Issue', 'Communal Area Issue', 'General Request') NOT NULL,
  `complaint_body` text NOT NULL,
  `status` enum('Resolved', 'Pending Assignment', 'Assigned') NOT NULL,
  `priority` enum('Low', 'Medium', 'High') NOT NULL,
  `assigned_to` varchar(52) NOT NULL,
  PRIMARY KEY (`complaint_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;


-- Dumping data for table `complaints`
--


LOCK TABLES `complaints` WRITE;
/*!40000 ALTER TABLE `complaints` DISABLE KEYS */;

INSERT INTO `complaints` (complaint_id, first_name, last_name, complaint_type, complaint_body, status, priority, assigned_to) VALUES
('DC-0001', 'Jane', 'Doe', 'Room Issue', 'The air conditioning in my room is not working.', 'Pending Assignment', 'High', 'Admin1'),
('DC-0002', 'John', 'Smith', 'Communal Area Issue', 'The lights in the main hallway are flickering.', 'In Progress', 'Medium', 'Admin2'),
('DC-0003', 'Alice', 'Johnson', 'General Request', 'I need assistance with room key replacement.', 'Resolved', 'Low', 'Admin3'),
('DC-0004', 'Bob', 'Brown', 'Room Issue', 'My window will not close properly.', 'Assigned', 'Medium', 'Admin4'),
('DC-0005', 'Carol', 'Davis', 'General Request', 'The vending machine on the 2nd floor is out of order.', 'Pending Assignment', 'Low', 'Admin5');

/*!40000 ALTER TABLE `complaints` ENABLE KEYS */;
UNLOCK TABLES;


-- Table structure for table `appointments`
--        

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE `appointments` (
  `id` int(3) NOT NULL auto_increment,
  `appointment_id` varchar(40) NOT NULL default '',
  `status` enum('Confirmed', 'Cancelled') NOT NULL default 'Confirmed',
  `student_name` char(52) NOT NULL default '',
  `created_date` DATE NOT NULL,
  `appointment_time` TIME NOT NULL,
  `service` enum('Washing & Drying','Stain Removal','Unattended Wash & Dry') NOT NULL default 'Washing & Drying',
  `loads` int(3) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
INSERT INTO `appointments` VALUES (1,'LA-41286','Confirmed','Leonardo Lewis','2023-11-27','19:18:52','Stain Removal', 1),
(2,'LA-41287','Confirmed','Bruce Banner','2023-11-26','14:08:32','Unattended Wash & Dry', 4),
(3,'LA-41288','Confirmed','Raheem Sterling','2023-11-25','16:35:21','Washing & Drying', 2),
(4,'LA-41289','Confirmed','Peter Griffin','2023-11-25','12:43:58','Unattended Wash & Dry', 3);

/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback` (
  `request_id` varchar(20) NOT NULL default '',
  `student_name` char(35) NOT NULL default '',
  `feedback` TEXT NOT NULL,
  `rating` int(1) NOT NULL default 0,
  PRIMARY KEY  (`request_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES ('DC-235532','Michelle Bryan','Service was impeccable.', '5'),
('DC-235535','Javia Gassop','Maintenance men were courteous and resolved my issues quickly.', '4');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES; 

--
-- Table structure for table `notices`
--


DROP TABLE IF EXISTS `notices`;
CREATE TABLE `notices` (
  `notice_id` int(4) NOT NULL auto_increment,
  `notice_date` varchar(20),
  `notice_time` varchar(20),
  `notice_subject` varchar(20) NOT NULL default '',
  `notice_content` TEXT NOT NULL,
  PRIMARY KEY  (`notice_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notices`
--

LOCK TABLES `notices` WRITE;
/*!40000 ALTER TABLE `notices` DISABLE KEYS */;
INSERT INTO `notices` VALUES (1,'2023-11-25', '08:00:00', 'Reminder: Upcoming Maintenance', 'Please be informed about scheduled server maintenance between 1:00am - 3:00 on December 3. Internet services will be intermittent.'),
(2,'2023-11-24', '08:00:00', 'Towers Implement Automated Domestic System.', 'Dear Residents,\n\nWe are pleased to announce the implementation of an automated domestic system for our towers. This system aims to streamline and improve various domestic services within the towers, including maintenance, cleaning, and security.\n\nWith this new system, you can expect smoother operations and better service quality. Please feel free to reach out if you have any questions or concerns.\n\nBest regards,\nThe Management Team');
/*!40000 ALTER TABLE `notices` ENABLE KEYS */;
UNLOCK TABLES; 