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
  `level` enum('Admin', 'User') NOT NULL default 'User',
  `first_name` char(35) NOT NULL default '',
  `last_name` char(35) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `room` int(4) NOT NULL default '0', 
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
(3,'User','Brendon','Urie','panic!@elrdaas.com',81,'Dragons'),
(4,'User','Hayley','Wiliams','paramore@elrdaas.com',422,'Phoenix');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `complaints`
--

DROP TABLE IF EXISTS `complaints`;
CREATE TABLE `complaints` (
  `complaint_id` int(11) NOT NULL auto_increment,
  `first_name` char(35) NOT NULL default '',
  `last_name` char(35) NOT NULL default '',
  `complaint_type` enum('Plumbing','Access Control','Electrical','Furniture','Pest Control','Roofing','Appliance Repair','Other') NOT NULL default 'Plumbing',
  `status` enum('Resolved','In Progress','More Information Requested') NOT NULL default 'In Progress',
  `priority` enum('Low','Medium','High') NOT NULL default 'Low',
  `complaint_title` TEXT NOT NULL,
  `assigned_to` char(52) NOT NULL default '',
  `complaint_body` TEXT NOT NULL,
  PRIMARY KEY  (`complaint_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaints`
--

LOCK TABLES `complaints` WRITE;
/*!40000 ALTER TABLE `complaints` DISABLE KEYS */;
INSERT INTO `complaints` VALUES 
(235531,'Marlon', 'Pierre', 'Plumbing', 'In Progress', 'Low', 'Leaking Sink', 'Maintenance', 'There is a constant leak from the sink in the kitchen area.'),
(235532,'Michelle', 'Bryan', 'Appliance Repair', 'Resolved', 'High', 'Leak in Office Roof', 'Maintenance', 'There is a leak during heavy rain.'),
(235533,'Deangelo','Bailey', 'Access Control', 'In Progress', 'High', 'Locked out', 'Security', 'Key fob does not work for Orion.'),
(235534,'Cleon', 'Simpson', 'Appliance Repair', 'More Information Requested', 'Medium', 'Intermittent leak from refrigerator', 'Maintenance', 'There is a wet spot that forms in front of the fridge on Apollo tower, 3rd floor. It happens sometimes but not all the time.'),
(235535,'Javia', 'Gassop', 'Electrical', 'Resolved', 'Medium', 'Lights Flickering', 'Maintenance', 'The lights in the hallway keep flickering intermittently.');
/*!40000 ALTER TABLE `complaints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL auto_increment,
  `status` enum('Confirmed', 'Cancelled') NOT NULL default 'Confirmed',
  `student_name` char(52) NOT NULL default '',
  `created_date` DATE NOT NULL,
  `appointment_time` TIME NOT NULL,
  `service` enum('Washing & Drying','Stain Removal','Unattended Wash & Dry') NOT NULL default 'Washing & Drying',
  `loads` int(3) NOT NULL default '1',
  PRIMARY KEY  (`appointment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
INSERT INTO `appointments` VALUES (41286,'Leonardo Lewis','2023-11-26','14:08:32','Stain Removal', 1),
(41287,'Bruce Banner','2023-11-26','14:08:32','Unattended Wash & Dry', 4),
(41288,'Raheem Sterling','2023-11-24','09:13:55','Washing & Drying', 2),
(41289,'Peter Griffin','2023-11-25','16:35:21','Unattended Wash & Dry', 3);

/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback` (
  `request_id` int(11) NOT NULL '0',
  `student_name` char(35) NOT NULL default '',
  `feedback` TEXT NOT NULL,
  `rating` int(1) NOT NULL '0',
  PRIMARY KEY  (`request_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `complaints` VALUES 
(235532,'Javia Gassop',S),
(235535,'Michelle', 'Bryan'),;
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES; 


/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;