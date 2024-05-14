-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2024 at 09:45 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `choo_fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_ID` varchar(255) NOT NULL,
  `project_title` text NOT NULL,
  `project_desc` text NOT NULL,
  `project_image` varchar(255) NOT NULL,
  `project_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_ID`, `project_title`, `project_desc`, `project_image`, `project_date`) VALUES
('Proj-6641dc630715b', 'Smart Home Energy Management System', 'Develop a system that optimizes energy usage in a smart home by controlling appliances based on user preferences, weather forecasts, and real-time energy prices.', '../images/Team_Office.jpg', '2024-05-01 17:35:12'),
('Proj-6641ddf06242d', 'Virtual Interior Design Assistant', 'Create a virtual assistant that helps users visualize and design interior spaces by suggesting furniture arrangements, color schemes, and decor options.', '../images/Team_Office.jpg', '2024-05-03 00:00:00'),
('Proj-6641de06ca887', 'E-Learning Platform for Skill Development', 'Build an online platform that offers courses and resources for skill development in various domains, catering to different learning styles and proficiency levels.', '../images/Team_Office.jpg', '1900-01-24 17:37:29'),
('Proj-6641def526130', 'Urban Traffic Management System', 'Design a system to optimize traffic flow in urban areas using real-time data from sensors, cameras, and GPS devices, reducing congestion and improving efficiency.', '../images/Team_Office.jpg', '2024-01-09 00:00:00'),
('Proj-6641df0a0a79e', 'Virtual Reality Therapy for Anxiety', 'Build a virtual reality experience designed to help individuals with anxiety disorders by exposing them to controlled, immersive environments that simulate relaxation techniques and coping strategies.', '../images/Team_Office.jpg', '2024-01-15 17:36:57'),
('Proj-6641df797278c', 'Remote Agricultural Monitoring System', 'Create a system that uses satellite imagery and IoT sensors to monitor crop health, soil moisture levels, and weather conditions, enabling farmers to make data-driven decisions for better yield and resource management.', '../images/Team_Office.jpg', '2024-05-13 17:38:24');

-- --------------------------------------------------------

--
-- Table structure for table `recruiter`
--

CREATE TABLE `recruiter` (
  `recruiter_ID` varchar(255) NOT NULL,
  `company_Name` varchar(255) DEFAULT NULL,
  `rec_username` varchar(255) NOT NULL,
  `rec_password` varchar(255) NOT NULL,
  `rec_email` varchar(255) NOT NULL,
  `rec_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `UserID` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `Lastname` varchar(100) NOT NULL,
  `ProfilePicture` varchar(255) DEFAULT 'images/profilepic_default.jpg',
  `Gender` varchar(20) DEFAULT NULL,
  `Bio` text DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL,
  `Skills` text DEFAULT NULL,
  `Education` text DEFAULT NULL,
  `Experience` text DEFAULT NULL,
  `SocialMediaLinks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`UserID`, `Email`, `Password`, `FirstName`, `Lastname`, `ProfilePicture`, `Gender`, `Bio`, `Location`, `Skills`, `Education`, `Experience`, `SocialMediaLinks`) VALUES
('00000002', 'yooooooooooooo', '$2y$10$y9w7Mnk4igWvlU9LbXTRsO3v7WmDgjIaWP1o.wLBt95yIU3m2Fr4S', 'LEECHEN', 'OOI', 'images/profilepic_default.jpg', 'Male', NULL, NULL, NULL, NULL, NULL, NULL),
('1', 'leechen787@gmail.com', '$2y$10$ItZmMbG/Wqtpd/UcY2CbFeIqKDwXk806Ad/8kaY1E7Y15KEQWJqv.', 'Lee Chen', 'Ooi', 'images/profilepic_default.jpg', 'Female', '', NULL, NULL, NULL, NULL, NULL),
('2', 'yyyyyyyyyyyyyyyyyy', '$2y$10$Nrx6lfcpxLogDXdEMYAfeujGKLrB156E/i1QPmOVy/dEytcVfE/Yy', 'LEECHEN', 'OOI', 'images/profilepic_default.jpg', 'Male', NULL, NULL, NULL, NULL, NULL, NULL),
('3', 'leechen898', '$2y$10$rWSguVJV3gfimsEXVhfXPuXToXKhSloziO8B1f04Rng7XWohv/Kfa', 'Lee Chen', 'Ooi', 'images/profilepic_default.jpg', 'Female', NULL, NULL, NULL, NULL, NULL, NULL),
('5', 'bruhh', '$2y$10$LO3FjLG6tFMb5kwSxIXxhuzHXqXBG3g1yfko7cq9aph37qPFcPO0a', 'Lee Chen', 'Ooi', 'images/profilepic_default.jpg', 'Female', NULL, NULL, NULL, NULL, NULL, NULL),
('user-000', 'yooo8888', '$2y$10$6NfWzvTO5umib7VyOVChou9PGEsLS2I5wNrDVN1sT1PbWtf.xGvPS', 'LEECHEN', 'OOI', 'images/profilepic_default.jpg', 'Male', NULL, NULL, NULL, NULL, NULL, NULL),
('user-00002', '111111111111', '$2y$10$FW5U5ZklrmNSaNK1BsAZhOT6IRUDxPG..Bm9a1YDhseolCqyW.nAa', 'yong seng', 'wwwwwwww', 'images/profilepic_default.jpg', 'Male', NULL, NULL, NULL, NULL, NULL, NULL),
('user-00003', '777', '$2y$10$V1X4eMc1aMvtAYrhf8K1juURzydg4wjlbnK.RzE6TVW/3y/pjsCLq', 'uuu', 'ttt', 'images/profilepic_default.jpg', 'Female', NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_ID`);

--
-- Indexes for table `recruiter`
--
ALTER TABLE `recruiter`
  ADD PRIMARY KEY (`recruiter_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
