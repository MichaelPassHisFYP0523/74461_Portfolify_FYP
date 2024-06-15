-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 08:59 AM
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

--
-- Dumping data for table `collab_invites`
--

INSERT INTO `collab_invites` (`id`, `collab_id`, `proj_id`, `sender_id`, `receiver_id`, `status`, `message`, `created_at`) VALUES
(32, 'collab-000032', 'proj-6666ae9bf267d', 'user-00003', 'user-00005', 'pending', 'Hi im interested in your project. Contact me here!\r\n', '2024-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` varchar(100) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `job_location` varchar(100) NOT NULL,
  `salary` varchar(100) NOT NULL,
  `requirement` text NOT NULL,
  `date_posted` date NOT NULL DEFAULT current_timestamp(),
  `job_types` varchar(100) NOT NULL,
  `recruiter_id` varchar(100) NOT NULL,
  `job_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `job_title`, `job_location`, `salary`, `requirement`, `date_posted`, `job_types`, `recruiter_id`, `job_status`) VALUES
('job_66604140a5c548.30884189', 'Senior executive', 'Kuala Lumpur', '4k-6k', '-5 years experience required\r\n-Degree in revelant industry', '2024-06-05', 'Full Time', 'user-00005', 1),
('job_666042e12b9d85.91439437', 'Project Manager', 'Kuala Lumpur', '4k-6k', '-5 years experience required\r\n-Degree in revelant industry', '2024-06-05', 'Part Time', 'user-00005', 1),
('job_66604307d9dff1.96974619', 'bbbbbbbbbbbbbbbbbbbbbbbbbb', 'bbbbbbb', 'bbbbbbb', 'bbbbbbbbbbbbbbbbbbbb', '2024-06-05', 'Full Time', 'user-00005', 1),
('job_6660456c6e2994.31544677', 'Graphic designer', 'Kuching, Malaysia', '3.5k', '-', '2024-06-05', 'Full Time', 'user-00005', 1);

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

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `user_id`, `title`, `description`, `created_at`, `project_path`, `proj_status`, `project_image`) VALUES
('proj-6656bb957636b', 'user-00003', 'Virtual Interior Design Assistant', 'Create a virtual assistant that helps users visualize and design interior spaces by suggesting furniture arrangements, color schemes, and decor options.', '2024-05-30', './files/project/IMG_20240418_185958.jpg', 0, '../images/Team_Office.jpg'),
('proj-6656bccb9d870', 'user-00003', 'E-Learning Platform for Skill Development', 'Build an online platform that offers courses and resources for skill development in various domains, catering to different learning styles and proficiency levels.', '2024-05-29', './files/project/proj-6656bccb9d870.jpg', 1, '../images/Team_Office.jpg'),
('proj-6656bed0b57a2', 'user-00003', 'Urban Traffic Management System', 'Design a system to optimize traffic flow in urban areas using real-time data from sensors, cameras, and GPS devices, reducing congestion and improving efficiency.', '2024-05-29', './files/project/proj-6656bed0b57a2.png', 1, '../images/Team_Office.jpg'),
('proj-6656c028ad038', 'user-00003', 'Remote Agricultural Monitoring System', 'Create a system that uses satellite imagery and IoT sensors to monitor crop health, soil moisture levels, and weather conditions, enabling farmers to make data-driven decisions for better yield and resource management.', '2024-05-31', './files/project/proj-6656c028ad038.jpg', 0, '../images/Team_Office.jpg'),
('proj-6656c33962b9b', 'user-00003', 'Smart Home Energy Management System', 'Embark on the creation of an innovative energy management ecosystem tailored for smart homes, designed to revolutionize how households interact with energy. This advanced system will go beyond traditional automation, utilizing cutting-edge machine learning algorithms to continuously learn and adapt to the dynamic needs of users and the environment. By orchestrating appliance usage in real-time, considering factors like occupancy, time-of-use pricing, weather conditions, and individual user preferences, it will pave the way for a greener, more efficient, and cost-effective future in residential energy consumption.\"', '2024-05-29', './files/project/proj-6656c33962b9b.jpg', 1, '../images/Team_Office.jpg'),
('proj-6666a982eb533', 'user-00005', 'Development of a Mobile Banking Application for XYZ Bank', ' The project involves designing and developing a mobile app that allows users to manage their bank accounts, transfer money, pay bills, and deposit checks using their smartphones. Key features include biometric login, real-time transaction alerts, budgeting tools, and customer support chat. The development process includes UI/UX design, backend integration with existing banking systems, rigorous security testing, and a phased rollout plan.', '2024-06-10', './files/project/proj-6666a982eb533.js', 1, '../images/Team_Office.jpg'),
('proj-6666ae9bf267d', 'user-00005', 'E-commerce Website Development for MNO Retail Chain', 'This project involves developing a feature-rich e-commerce website that offers a seamless shopping experience. Features include product search and filtering, detailed product descriptions, customer reviews, personalized recommendations, and multiple payment options. The development process includes designing the user interface, building the backend infrastructure, integrating with inventory and logistics systems, and implementing cybersecurity measures to protect customer data.', '2024-06-10', './files/project/proj-6666ae9bf267d.pdf', 1, '../images/Team_Office.jpg'),
('proj-6666c0e04188b', 'user-00005', 'Launch of an Online Learning Platform for DEF University', 'The project entails creating a comprehensive online platform that offers live classes, recorded lectures, interactive assignments, and discussion forums. The platform will support various course formats, including self-paced and instructor-led courses. Development includes creating a responsive design, integrating video conferencing tools, implementing a robust Learning Management System (LMS), and setting up analytics to track student performance and engagement.', '2024-06-10', './files/project/proj-6666c0e04188b.pdf', 1, '../images/Team_Office.jpg');

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
(0, 'user-00005', 'Google', 'google@gmail.com', '0123456789', '', 'google.com.my', './images/logo_pic/google.png', '');

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
('user-00003', 'leechen787@gmail.com', '$2y$10$A8HLzepKFEnIg.lfGYjwReiFw2C26Q9E.D1dowaJJY4VfZtW7bG12', 'user', '2024-05-28 06:22:25'),
('user-00004', 'google@gmail.com', '$2y$10$i9JilQ0mj.TpiYq3YxSW7uCDG0PNDfcpKCrekX30o/S0j2PF3hk0G', 'recruiter', '2024-05-30 09:14:49'),
('user-00005', 'bapu0523@gmail.com', '$2y$10$3jGo8RGQ5iK8L3zvJoKb1ORMeuNJeI.Uwd77voUqS5YcSnrLotAIS', 'recruiter', '2024-06-02 12:57:00'),
('user-00006', 'olc6670@gmail.com', '$2y$10$Slz0eHIsGjtz0auqFg/zfuQ7AwXDwCfU1MOn62VKdnBsFyUmmtrDm', 'user', '2024-06-13 06:23:02');

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
('u-00001', 'leechen787@gmail.com', 'user-00003', 'Lee Chen', 'Ooi ', './images/pro_pic/voice-over.png', 'Male', 'Hi im blalaalalalalalallal', '', NULL, NULL, NULL, '', './files/resume/receipt.pdf', 0, '2024-06-13 13:55:26'),
('u-00002', 'google@gmail.com', 'user-00004', '', '', './images/pro_pic/voice-over.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-06-13 13:55:26'),
('u-00003', 'olc6670@gmail.com', 'user-00006', '', '', './images/pro_pic/voice-over.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-06-13 14:32:49');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recruiter_profile`
--
ALTER TABLE `recruiter_profile`
  ADD CONSTRAINT `fk` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
