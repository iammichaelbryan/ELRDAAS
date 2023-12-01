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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `role` enum('Admin', 'User') NOT NULL default 'User',
  `first_name` char(35) NOT NULL default '',
  `last_name` char(35) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `room` int(4) NOT NULL default 0, 
  `tower` enum('Olympus','Dragons', 'Orion', 'Phoenix', 'Apollo') NOT NULL default 'Dragons',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4080 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','Jonathan','Doe','jdoe@elrdaas.com',0,'Olympus'),
(2,'Admin','Peter','Parker','spidey54@elrdaas.com',0,'Olympus'),
(3,'User','Brendon','Urie','panic!@elrdaas.com',2211,'Dragons'),
(4,'User','Hayley','Wiliams','paramore@elrdaas.com',3195,'Phoenix');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `complaints`
--

DROP TABLE IF EXISTS `complaints`;
CREATE TABLE `complaints` (
  `id` int(6) NOT NULL auto_increment,
  `complaint_id` varchar(40) NOT NULL default '',
  `first_name` char(35) NOT NULL default '',
  `last_name` char(35) NOT NULL default '',
  `complaint_type` enum('Plumbing','Access Control','Electrical','Furniture','Pest Control','Roofing','Appliance Repair','Other') NOT NULL default 'Plumbing',
  `status` enum('Resolved','In Progress','More Information Requested') NOT NULL default 'In Progress',
  `priority` enum('Low','Medium','High') NOT NULL default 'Low',
  `complaint_title` TEXT NOT NULL,
  `assigned_to` char(52) NOT NULL default '',
  `complaint_body` TEXT NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaints`
--

LOCK TABLES `complaints` WRITE;
/*!40000 ALTER TABLE `complaints` DISABLE KEYS */;
INSERT INTO `complaints` VALUES (1,'DC-235531','Marlon', 'Pierre', 'Plumbing', 'In Progress', 'Low', 'Leaking Sink', 'Maintenance', 'There is a constant leak from the sink in the kitchen area.'),
(2,'DC-235532','Michelle', 'Bryan', 'Appliance Repair', 'Resolved', 'High', 'Leak in Office Roof', 'Maintenance', 'There is a leak during heavy rain.'),
(3, 'DC-235533','Deangelo','Bailey', 'Access Control', 'In Progress', 'High', 'Locked out', 'Security', 'Key fob does not work for Orion.'),
(4,'DC-235534','Cleona', 'Simpson', 'Appliance Repair', 'More Information Requested', 'Medium', 'Intermittent leak from refrigerator', 'Maintenance', 'There is a wet spot that forms in front of the fridge on Apollo tower, 3rd floor. It happens sometimes but not all the time.'),
(5,'DC-235535','Javia', 'Gassop', 'Electrical', 'Resolved', 'Medium', 'Lights Flickering', 'Maintenance', 'The lights in the hallway keep flickering intermittently.');
/*!40000 ALTER TABLE `complaints` ENABLE KEYS */;
UNLOCK TABLES;

--
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