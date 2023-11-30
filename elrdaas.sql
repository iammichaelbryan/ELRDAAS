-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 30, 2023 at 12:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elrdaas`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(3) NOT NULL,
  `appointment_id` varchar(40) NOT NULL DEFAULT '',
  `status` enum('Confirmed','Cancelled') NOT NULL DEFAULT 'Confirmed',
  `student_name` char(52) NOT NULL DEFAULT '',
  `created_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `service` enum('Washing & Drying','Stain Removal','Unattended Wash & Dry') NOT NULL DEFAULT 'Washing & Drying',
  `loads` int(3) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `appointment_id`, `status`, `student_name`, `created_date`, `appointment_time`, `service`, `loads`) VALUES
(1, 'LA-41286', 'Confirmed', 'Leonardo Lewis', '2023-11-27', '19:18:52', 'Stain Removal', 1),
(2, 'LA-41287', 'Confirmed', 'Bruce Banner', '2023-11-26', '14:08:32', 'Unattended Wash & Dry', 4),
(3, 'LA-41288', 'Confirmed', 'Raheem Sterling', '2023-11-25', '16:35:21', 'Washing & Drying', 2),
(4, 'LA-41289', 'Confirmed', 'Peter Griffin', '2023-11-25', '12:43:58', 'Unattended Wash & Dry', 3);

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(6) NOT NULL,
  `complaint_id` varchar(40) NOT NULL DEFAULT '',
  `first_name` char(35) NOT NULL DEFAULT '',
  `last_name` char(35) NOT NULL DEFAULT '',
  `complaint_type` enum('Plumbing','Access Control','Electrical','Furniture','Pest Control','Roofing','Appliance Repair','Other') NOT NULL DEFAULT 'Plumbing',
  `status` enum('Resolved','In Progress','More Information Requested') NOT NULL DEFAULT 'In Progress',
  `priority` enum('Low','Medium','High') NOT NULL DEFAULT 'Low',
  `complaint_title` text NOT NULL,
  `assigned_to` char(52) NOT NULL DEFAULT '',
  `complaint_body` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `complaint_id`, `first_name`, `last_name`, `complaint_type`, `status`, `priority`, `complaint_title`, `assigned_to`, `complaint_body`) VALUES
(1, 'DC-235531', 'Marlon', 'Pierre', 'Plumbing', 'In Progress', 'Low', 'Leaking Sink', 'Maintenance', 'There is a constant leak from the sink in the kitchen area.'),
(2, 'DC-235532', 'Michelle', 'Bryan', 'Appliance Repair', 'Resolved', 'High', 'Leak in Office Roof', 'Maintenance', 'There is a leak during heavy rain.'),
(3, 'DC-235533', 'Deangelo', 'Bailey', 'Access Control', 'In Progress', 'High', 'Locked out', 'Security', 'Key fob does not work for Orion.'),
(4, 'DC-235534', 'Cleona', 'Simpson', 'Appliance Repair', 'More Information Requested', 'Medium', 'Intermittent leak from refrigerator', 'Maintenance', 'There is a wet spot that forms in front of the fridge on Apollo tower, 3rd floor. It happens sometimes but not all the time.'),
(5, 'DC-235535', 'Javia', 'Gassop', 'Electrical', 'Resolved', 'Medium', 'Lights Flickering', 'Maintenance', 'The lights in the hallway keep flickering intermittently.');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `request_id` varchar(20) NOT NULL DEFAULT '',
  `student_name` char(35) NOT NULL DEFAULT '',
  `feedback` text NOT NULL,
  `rating` int(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`request_id`, `student_name`, `feedback`, `rating`) VALUES
('DC-235532', 'Michelle Bryan', 'Service was impeccable.', 5),
('DC-235535', 'Javia Gassop', 'Maintenance men were courteous and resolved my issues quickly.', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `notice_id` int(4) NOT NULL,
  `notice_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `notice_subject` varchar(20) NOT NULL DEFAULT '',
  `notice_content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`notice_id`, `notice_time`, `notice_subject`, `notice_content`) VALUES
(1, '2023-11-30 13:00:00', 'Reminder: Upcoming M', 'Please be informed about scheduled server maintenance between 1:00am - 3:00 on December 3. Internet services will be intermittent.'),
(2, '2023-11-30 13:00:00', 'Towers Implement Aut', 'Dear Residents,\n\nWe are pleased to announce the implementation of an automated domestic system for our towers. This system aims to streamline and improve various domestic services within the towers, including maintenance, cleaning, and security.\n\nWith this new system, you can expect smoother operations and better service quality. Please feel free to reach out if you have any questions or concerns.\n\nBest regards,\nThe Management Team');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` enum('Admin','User') NOT NULL DEFAULT 'User',
  `first_name` char(35) NOT NULL DEFAULT '',
  `last_name` char(35) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `room` int(4) NOT NULL DEFAULT 0,
  `tower` enum('Olympus','Dragons','Orion','Phoenix','Apollo') NOT NULL DEFAULT 'Dragons'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `first_name`, `last_name`, `email`, `room`, `tower`) VALUES
(1, 'Admin', 'Jonathan', 'Doe', 'jdoe@elrdaas.com', 0, 'Olympus'),
(2, 'Admin', 'Peter', 'Parker', 'spidey54@elrdaas.com', 0, 'Olympus'),
(3, 'User', 'Brendon', 'Urie', 'panic!@elrdaas.com', 2211, 'Dragons'),
(4, 'User', 'Hayley', 'Wiliams', 'paramore@elrdaas.com', 3195, 'Phoenix');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `notice_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4080;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;