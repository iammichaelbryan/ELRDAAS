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
  `room` int(3) NOT NULL default '0', 
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
  `name` char(52) NOT NULL default '',
  `complaint_type` enum('Plumbing','Access Control','Electrical','Furniture','Pest Control','Roofing','Appliance Repair','Other') NOT NULL default 'Plumbing',
  `status` enum('Resolved','In Progress','More Information Reqested') NOT NULL default '',
  `complaint_body` TEXT NOT NULL,
  `assigned_to` char(52) NOT NULL default '',
  PRIMARY KEY  (`complaint_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaints`
--

LOCK TABLES `complaints` WRITE;
/*!40000 ALTER TABLE `complaints` DISABLE KEYS */;
INSERT INTO `complaints` VALUES ('Marlon Pierre', 'Plumbing', 'In Progress', 'Leaking Sink', 'Maintenance Team', 'There is a constant leak from the sink in the kitchen area.'),
('Michelle Bryan', 'Roofing', 'In Progress', 'Leak in Office Roof', 'Maintenance', 'There is a leak during heavy rain'),
('Javia Gassop', 'Electrical', 'In Progress', 'Lights Flickering', 'Maintenance', 'The lights in the hallway keep flickering intermittently.');
/*!40000 ALTER TABLE `complaints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `country_code` char(3) NOT NULL default '',
  `language` char(30) NOT NULL default '',
  `official` enum('T','F') NOT NULL default 'F',
  `percentage` float(4,1) NOT NULL default '0.0',
  PRIMARY KEY  (`country_code`,`language`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES ('AFG','Pashto','T',52.4),
('NLD','Dutch','T',95.6);

/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;