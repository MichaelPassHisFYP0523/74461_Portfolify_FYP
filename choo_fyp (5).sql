-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2024 at 09:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `collab_invites`
--

CREATE TABLE `collab_invites` (
  `id` int(11) NOT NULL,
  `collab_id` varchar(100) NOT NULL,
  `proj_id` varchar(100) DEFAULT NULL,
  `sender_id` varchar(100) DEFAULT NULL,
  `receiver_id` varchar(100) DEFAULT NULL,
  `status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `message` text NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` varchar(100) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `job_desc` text NOT NULL,
  `job_location` varchar(100) NOT NULL,
  `salary` varchar(100) NOT NULL,
  `requirement` text NOT NULL,
  `date_posted` date NOT NULL DEFAULT current_timestamp(),
  `job_types` varchar(100) NOT NULL,
  `recruiter_id` varchar(100) NOT NULL,
  `job_status` int(11) NOT NULL DEFAULT 1,
  `job_image` varchar(100) NOT NULL DEFAULT 'images/jobs/it-professional-works-startup-project.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_application`
--

CREATE TABLE `job_application` (
  `application_id` varchar(100) NOT NULL,
  `job_id` varchar(100) NOT NULL,
  `applicant_id` varchar(100) NOT NULL,
  `application_status` enum('pending','reviewed','accepted','rejected') DEFAULT 'pending',
  `cover_letter` text DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `project_path` varchar(100) NOT NULL,
  `proj_status` int(11) NOT NULL,
  `project_image` varchar(255) NOT NULL DEFAULT '../images/Team_Office.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recruiter_profile`
--

CREATE TABLE `recruiter_profile` (
  `r_id` int(11) NOT NULL,
  `User_ID` varchar(100) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_phone` varchar(20) NOT NULL,
  `about` text DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `background` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recruiter_profile`
--

INSERT INTO `recruiter_profile` (`r_id`, `User_ID`, `company_name`, `contact_email`, `contact_phone`, `about`, `website`, `logo`, `background`) VALUES
(4, 'user-00003', 'Google', 'google@gmail.com', '012349686', 'Google LLC (Google), a subsidiary of Alphabet Inc, is a provider of search and advertising services on the internet. The company\'s business areas include advertising, search, platforms and operating systems, and enterprise and hardware products.', 'www.google.com.my', './images/logo_pic/channels4_profile.jpg', 'Google began as an online search firm, but it now offers more than 50 Internet services and products, from e-mail and online document creation to software for mobile phones and tablet computers. In addition, its 2012 acquisition of Motorola Mobility put the company in the position to sell hardware in the form of mobile phones. Google’s broad product portfolio and size make it one of the top four influential companies in the high-tech marketplace, along with Apple, IBM, and Microsoft. Despite its myriad of products, the original search tool remains the core of Google’s success. In 2016 Alphabet earned nearly all of its revenue from Google advertising based on users’ search requests.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_ID` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('recruiter','user') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `email`, `password`, `role`, `created_at`) VALUES
('user-00001', 'olc6670@gmail.com', '$2y$10$r2ttA/oJeOCfCQIh/Jp/7OqGzc7isIiS8Y0ZK1i9gbB7q.HBmuIwe', 'user', '2024-06-20 05:45:59'),
('user-00002', 'leechen787@gmail.com', '$2y$10$RgPPWb9BueqCO85Pv6xJvu1iz5fzBjtonNMgQTZ5GLEHGew9P4eoS', 'user', '2024-06-20 05:46:39'),
('user-00003', 'google@gmail.com', '$2y$10$WvXPfR65nuCAqtmnwNlG3OsXC3Rvl9jcnqWY7oCdYgqgdVXlKu5e6', 'recruiter', '2024-06-20 05:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `u_id` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `User_ID` varchar(100) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `Lastname` varchar(100) NOT NULL,
  `ProfilePicture` varchar(255) DEFAULT 'images/profilepic_default.jpg',
  `Gender` varchar(20) DEFAULT NULL,
  `Bio` text DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL,
  `Skills` text DEFAULT NULL,
  `Education` text DEFAULT NULL,
  `Experience` text DEFAULT NULL,
  `SocialMediaLinks` text DEFAULT NULL,
  `Resume` varchar(255) DEFAULT NULL,
  `profile_views` int(11) DEFAULT 0,
  `LastActive` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`u_id`, `email`, `User_ID`, `FirstName`, `Lastname`, `ProfilePicture`, `Gender`, `Bio`, `Location`, `Skills`, `Education`, `Experience`, `SocialMediaLinks`, `Resume`, `profile_views`, `LastActive`) VALUES
('u-00001', 'olc6670@gmail.com', 'user-00001', '', '', 'images/profilepic_default.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-06-20 13:45:59'),
('u-00002', 'leechen787@gmail.com', 'user-00002', '', '', 'images/profilepic_default.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-06-20 13:46:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `collab_invites`
--
ALTER TABLE `collab_invites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `collab_id` (`collab_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `job_application`
--
ALTER TABLE `job_application`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `applicant_id` (`applicant_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `recruiter_profile`
--
ALTER TABLE `recruiter_profile`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `fk` (`User_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `collab_invites`
--
ALTER TABLE `collab_invites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `recruiter_profile`
--
ALTER TABLE `recruiter_profile`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `job_application`
--
ALTER TABLE `job_application`
  ADD CONSTRAINT `job_application_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`),
  ADD CONSTRAINT `job_application_ibfk_2` FOREIGN KEY (`applicant_id`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `recruiter_profile`
--
ALTER TABLE `recruiter_profile`
  ADD CONSTRAINT `fk` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
