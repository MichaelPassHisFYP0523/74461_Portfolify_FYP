-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 04:08 AM
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
  `job_image` varchar(100) NOT NULL DEFAULT 'images/jobs/it-professional-works-startup-project.jpg',
  `job_industry` varchar(100) NOT NULL,
  `job_views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `job_title`, `job_desc`, `job_location`, `salary`, `requirement`, `date_posted`, `job_types`, `recruiter_id`, `job_status`, `job_image`, `job_industry`, `job_views`) VALUES
('job_6678365f761e21.70492990', 'Software Developer', 'Develops and maintains software applications.', 'Kuala Lumpur, MY', 'RM3000-RM5000', 'Bachelor\'s degree in Computer Science or related field\r\nProficiency in programming languages (e.g., Java, Python, C++)\r\nExperience with software development frameworks (e.g., .NET, Spring)\r\nStrong problem-solving skills\r\nAbility to work in a team environment', '2024-06-23', 'Full Time', 'user-00003', 1, './files/images/job_6678365f761e21.70492990.png', 'Information Technology (IT)', 0),
('job_6678373409ef77.47944892', 'Web Developer', 'Creates and maintains websites.', 'Kuching, MY', 'RM3000-RM4000', 'Bachelor\'s degree in Computer Science, Information Technology, or related field\r\nProficiency in web technologies (e.g., HTML, CSS, JavaScript)\r\nExperience with web development frameworks (e.g., React, Angular, Vue)\r\nStrong understanding of responsive design\r\nGood communication and teamwork skills', '2024-06-23', 'Full Time', 'user-00003', 1, './files/images/job_6678373409ef77.47944892.png', 'Information Technology (IT)', 1),
('job_667837da3a6297.27199801', 'Accountant', 'Manages financial records and transactions.', 'Penang, MY', 'RM4000-RM5000', 'Bachelor\'s degree in Accounting, Finance, or related field\r\nCertified Public Accountant (CPA) designation preferred\r\nExperience with accounting software (e.g., QuickBooks, SAP)\r\nStrong attention to detail\r\nExcellent organizational and time management skills', '2024-06-23', 'Full Time', 'user-00003', 1, './files/images/job_667837da3a6297.27199801.jpg', 'Finance', 0),
('job_667838eebeb8c5.43211085', 'Support Analyst', 'To support and maintain the company’s mission critical business applications.', 'Sabah, MY', 'RM4000-RM5000', 'BSc degree in Software Engineering or IT equivalent\r\n1-2 years in troubleshooting and analytical skills Programming/Support and debugging exposure in either of COBOL/ RPG/ Java/ C or C++\r\nFresh Graduates are also encouraged to apply (training will be provided)\r\nCommunicate well both in written and verbal', '2024-06-23', 'Full Time', 'user-00003', 1, './files/images/job_667838eebeb8c5.43211085.png', 'Information Technology (IT)', 0),
('job_6678394c751844.14954836', 'Robotic Software Engineer', 'Perform research and development on improving the docking, localization, path planning and navigation algorithms of the AMR. ', 'Penang, MY', 'RM4000-RM7000', 'Candidates possess at least a Bachelor\'s Degree or Master in Computer Science, Software Engineering, Robotics or related field \r\nStrong math skills, familiarity with mathematical optimization in autonomous navigation and computer vision\r\nAt least 1 year in software development on autonomous robot. \r\nProgramming skill (s): Python, C++, C#.Net, ASP.Net, Spring, JavaScript, JQuery, CSS, Mobile application, Linux, SQL, Object Oriented Program, Artificial Intelligence, Computer Vision and etc.', '2024-06-23', 'Full Time', 'user-00003', 1, './files/images/job_6678394c751844.14954836.png', 'Information Technology (IT)', 0),
('job_66783b9aee59f5.62549473', 'Product Engineering Manager', 'Responsible for reviewing and supervision of new products and existing product designs, which includes but not limited to Filtration, Office Automation, Automotive and Sub-assemblies. ', 'Johor, MY', 'RM3000-RM5000', 'Graduate mechanical, manufacturing or production engineer - B.Sc., B.Eng. or higher. \r\nSolid experience of min 5 years managing high-volume manufacturing / semi-automated assembly processes - your experience will probably have been gained (but not exclusively) ', '2024-06-23', 'Full Time', 'user-00004', 1, './files/images/job_66783b9aee59f5.62549473.jpg', 'Engineering', 0),
('job_66783bfa965591.54015572', 'Maintenance Engineer', 'f', 'Johor, MY', 'RM3000-RM4500', 'f', '2024-06-23', 'Full Time', 'user-00004', 1, './files/images/job_66783bfa965591.54015572.jpg', 'Engineering', 0),
('job_66783dca1da567.27729944', 'Product Planning Specialist', 'Conduct user demand research and user behavior analysis, and formulate product development plans based on business positioning;\r\n2. According to product planning, determine product functions, processes, user experience and back-end solutions, draw product prototypes, and write relevant requirements documents;', 'Johor, MY', 'RM 3,500 – RM 5,200', '1. Clear logic and able to understand and explore customer needs;\r\n2. More than two years of experience as a mobile product manager, intermediate product manager or above, experience in Internet products\r\n3. Sensitive to business and data, good at identifying and solving problems;', '2024-06-23', 'Full Time', 'user-00004', 1, './files/images/job_66783dca1da567.27729944.jpg', 'Sales and Marketing', 0),
('job_66783e6d067b97.96978039', 'Engineering and Computer Science Intern (Bachelor)', 'Collaborate with experienced engineers to troubleshoot and resolve production issues, ensuring the smooth operation of our manufacturing processes.\r\nContribute to the design, development, and implementation of automated projects aimed at enhancing efficiency, precision, and overall productivity.', 'Penang, MY', 'RM 1,500', 'Diploma or Degree in Electrical and Electronics or ECE or equivalent relevant. \r\nStrong problem-solving skills and an analytical mindset.\r\nProficiency in relevant software tools, such as CAD, programming languages, and data analysis tools, is a plus.', '2024-06-23', 'Internship', 'user-00004', 1, './files/images/job_66783e6d067b97.96978039.png', 'Information Technology (IT)', 0),
('job_66783f13474cd6.06638430', 'Part Time Lecturer', 'To prepare lecture materials\r\n- To conduct lectures during designated lecture hours\r\n- To evaluate student performance in a particular course\r\n- To provide counseling for students', 'Penang, MY', 'RM2000-RM3000', 'Computer Science, Mechanical Engineering, Marketing, Business, Accounting, Broadcasting Media etc.', '2024-06-23', 'Part Time', 'user-00004', 1, './files/images/job_66783f13474cd6.06638430.jpg', 'Education', 1),
('job_667840d2ad9da1.05029999', 'IT Teacher/ Coding Teacher/ Programming Teacher', 'ffff', 'Sibu, Sarawak', 'RM2000-RM3000', 'Suitable candidates should hold Bachelor’s degree or higher (preferably in IT/Computer Science). Knowledge of Android/JavaScript/WordPress would be a strong competitive advantage.', '2024-06-23', 'Part Time', 'user-00004', 1, './files/images/job_667840d2ad9da1.05029999.png', 'Information Technology (IT)', 0),
('job_667842addf2442.66132511', 'Pharmacist', ' Dispenses medications and advises patients.', 'Kuching,MY', 'RM2000-RM3000', 'Doctor of Pharmacy (Pharm.D.) degree from an accredited pharmacy program, plus passing the NAPLEX exam and obtaining state licensure.', '2024-06-23', 'Full Time', 'user-00005', 1, './files/images/job_667842addf2442.66132511.jpg', 'Healthcare', 0),
('job_6678432acf84e6.81899630', 'Physiotherapist', 'Assess and analyse patients\' complaints directly related to the conditions referred, with accurate clinical reasoning\r\nPlan and implement treatment while ensuring patient safety and effectiveness of intervention', 'Kuala Lumpur, MY', 'RM 2,800 – RM 4,200', 'Preferably Diploma/Bachelor/Masters in Physiotherapy\r\nGood communication, interpersonal and patient handling skills preferred, able to work as a team member in a multi-disciplinary setting.\r\nMust be fully vaccinated with COVID-19 vaccinations.\r\nPreferably with driving license.', '2024-06-23', 'Full Time', 'user-00005', 1, './files/images/job_6678432acf84e6.81899630.jpg', 'Healthcare', 0),
('job_6678460fd8c735.65440227', 'Human Resources cum Administration Executive', 'Manage employee leave policies \r\nImprove HR policy \r\nRevise performance appraisal systems \r\nManage the hiring/recruitment process \r\n', 'Seri Kembangan, Selangor', 'RM 2,800 – RM 3,800', 'Minimum 2 years of experience in HR \r\nProficient in Mandarin, English and Bahasa Malaysia \r\nCommunication skills ', '2024-06-23', 'Full Time', 'user-00005', 1, './files/images/job_6678460fd8c735.65440227.png', 'Human Resources', 0),
('job_667846ccd089a2.26400000', 'Route Planner Junior Executive', 'Prepare Route Design base on forecasting orders.\r\nPlan and coordinate operations by monitoring the arrival & departure of parcels to region sorting hub and analyse or investigate the reason of delays and ensure the operation is plans according to the schedules and on-time delivery and make sure all deliveries are according to the service level agreement.', 'Kuala Lumpur, MY', 'RM 3,000 – RM 3,800', 'Candidate must possess at least a Bachelor\'s Degree, Post Graduate Diploma, Professional Degree, Airline Operation/Airport Management, Logistic/Transportation, Business Studies/Administration/Management, Maritime Studies or equivalent.\r\nFresh graduate or 1 year(s) of working experience in the related field is required for this position.\r\nFluency in Mandarin is preferred for candidates as the role involves interactions with Mandarin-speaking clients.', '2024-06-24', 'Full Time', 'user-00005', 1, './files/images/job_667846ccd089a2.26400000.jpeg', 'Manufacturing', 0),
('job_66784789e756c1.72771793', 'E-commerce & Marketing Executive', 'Work closely with cross-functional teams including marketing, logistics, IT, brand merchandising, and finance.\r\nEnsure that marketplace branding, content, and visuals are aligned with all brand priorities and direction.\r\nMaintain relationships with marketplace Key Account Managers and establish Joint Business Plans to grow sales.', 'Penang, MY', 'RM 2,500 – RM 3,200', 'Bachelor\'s degree in Business, Marketing, E-commerce, or a related field.\r\nAt least 1-2 years of e-commerce experience managing in-house B2C and/or marketplace platforms (e.g., Lazada, Shopee, TikTok).\r\nExperience managing a team; regional experience is a plus.\r\nProficiency in using e-commerce platforms and tools (e.g., sitegiant, Big seller)\r\nStrong analytical skills with the ability to interpret data and make data-driven decisions.', '2024-06-24', 'Full Time', 'user-00005', 1, './files/images/job_66784789e756c1.72771793.png', 'Retail', 3),
('job_66784863840b23.52302608', 'Capsule Hotel Associates - Front Office &Housekeeping', 'Responsible to welcome and greet guests.\r\nResponsible to answer and direct incoming calls. \r\nResponsible for room reservations, proper room allocation and the issuance of room keys.', 'Kota Kinabalu, Sabah', 'RM 1,500 – RM 2,250', 'Candidate must possess at least a Higher Secondary/STPM/\"A\" Level/Pre-U, Professional Certificate, Diploma, Advanced/Higher/Graduate Diploma, Food & Beverage Services Management, Hospitality/Tourism/Hotel Management, Business Studies/Administration/Management or equivalent.\r\nRequired language(s): Mandarin, English, BM', '2024-06-24', 'Full Time', 'user-00006', 1, './files/images/job_66784863840b23.52302608.jpg', 'Hospitality and Tourism', 0),
('job_667848aeac56c1.29077791', 'Tea Barista', 'Understand and fulfilling task relevant to operate a food & beverage outlet.\r\nAble to learn inside-out about tea-based beverage outlet including skillset to brew the beverage based out in-house recipe.\r\nGreeting customers in a friendly manner and taking food and drink orders.\r\nPreparing and serving beverages such as tea and other specialty drinks.\r\nResponding to and resolving customer concerns or complaints.', 'Penang', 'RM 2,000 – RM 2,500', 'Candidate with/without SPM.\r\nPossess own transport.\r\nNo prior working experience required.\r\nHave a typhoid vaccine before start working (Can be claimed).\r\nAble to work for full-time (Part-time application will not be entertained).\r\nAble to go for 1-2 weeks training in KL (Hostel provided during training).', '2024-06-24', 'Full Time', 'user-00006', 1, './files/images/job_667848aeac56c1.29077791.jpg', 'Hospitality and Tourism', 5);

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

--
-- Dumping data for table `job_application`
--

INSERT INTO `job_application` (`application_id`, `job_id`, `applicant_id`, `application_status`, `cover_letter`, `resume`, `applied_at`) VALUES
('rL4Vf03Urv', 'job_667848aeac56c1.29077791', 'user-00002', 'pending', './files/resume/Poster Guides.pdf', './files/resume/FYP1 & 2 Important Dates.pdf', '2024-06-23 17:19:18');

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
  `project_image` varchar(255) NOT NULL DEFAULT '../images/Team_Office.jpg',
  `project_view` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `user_id`, `title`, `description`, `created_at`, `project_path`, `proj_status`, `project_image`, `project_view`) VALUES
('proj-6656bb957636b', 'user-00001', 'Virtual Interior Design Assistant', 'Create a virtual assistant that helps users visualize and design interior spaces by suggesting furniture arrangements, color schemes, and decor options.', '2024-05-30', './files/project/IMG_20240418_185958.jpg', 0, '../images/Team_Office.jpg', 0),
('proj-6656bccb9d870', 'user-00004', 'E-Learning Platform for Skill Development', 'Build an online platform that offers courses and resources for skill development in various domains, catering to different learning styles and proficiency levels.', '2024-05-29', './files/project/proj-6656bccb9d870.jpg', 1, '../images/Team_Office.jpg', 0),
('proj-6656bed0b57a2', 'user-00003', 'Urban Traffic Management System', 'Design a system to optimize traffic flow in urban areas using real-time data from sensors, cameras, and GPS devices, reducing congestion and improving efficiency.', '2024-05-29', './files/project/proj-6656bed0b57a2.png', 1, '../images/Team_Office.jpg', 0),
('proj-6656c028ad038', 'user-00006', 'Remote Agricultural Monitoring System', 'Create a system that uses satellite imagery and IoT sensors to monitor crop health, soil moisture levels, and weather conditions, enabling farmers to make data-driven decisions for better yield and resource management.', '2024-05-31', './files/project/proj-6656c028ad038.jpg', 1, '../images/Team_Office.jpg', 0),
('proj-6656c33962b9b', 'user-00003', 'Smart Home Energy Management System', 'Embark on the creation of an innovative energy management ecosystem tailored for smart homes, designed to revolutionize how households interact with energy. This advanced system will go beyond traditional automation, utilizing cutting-edge machine learning algorithms to continuously learn and adapt to the dynamic needs of users and the environment. By orchestrating appliance usage in real-time, considering factors like occupancy, time-of-use pricing, weather conditions, and individual user preferences, it will pave the way for a greener, more efficient, and cost-effective future in residential energy consumption.\"', '2024-05-29', './files/project/proj-6656c33962b9b.jpg', 1, '../images/Team_Office.jpg', 0),
('proj-6666a982eb533', 'user-00005', 'Development of a Mobile Banking Application for XYZ Bank', ' The project involves designing and developing a mobile app that allows users to manage their bank accounts, transfer money, pay bills, and deposit checks using their smartphones. Key features include biometric login, real-time transaction alerts, budgeting tools, and customer support chat. The development process includes UI/UX design, backend integration with existing banking systems, rigorous security testing, and a phased rollout plan.', '2024-06-10', './files/project/proj-6666a982eb533.js', 1, '../images/Team_Office.jpg', 0),
('proj-6666ae9bf267d', 'user-00002', 'E-commerce Website Development for MNO Retail Chain', 'This project involves developing a feature-rich e-commerce website that offers a seamless shopping experience. Features include product search and filtering, detailed product descriptions, customer reviews, personalized recommendations, and multiple payment options. The development process includes designing the user interface, building the backend infrastructure, integrating with inventory and logistics systems, and implementing cybersecurity measures to protect customer data.', '2024-06-10', './files/project/proj-6666ae9bf267d.pdf', 1, '../images/Team_Office.jpg', 1),
('proj-6666c0e04188b', 'user-00006', 'Launch of an Online Learning Platform for DEF University', 'The project entails creating a comprehensive online platform that offers live classes, recorded lectures, interactive assignments, and discussion forums. The platform will support various course formats, including self-paced and instructor-led courses. Development includes creating a responsive design, integrating video conferencing tools, implementing a robust Learning Management System (LMS), and setting up analytics to track student performance and engagement.', '2024-06-10', './files/project/proj-6666c0e04188b.pdf', 0, '../images/Team_Office.jpg', 0);

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
  `background` text NOT NULL,
  `profileView` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recruiter_profile`
--

INSERT INTO `recruiter_profile` (`r_id`, `User_ID`, `company_name`, `contact_email`, `contact_phone`, `about`, `website`, `logo`, `background`, `profileView`) VALUES
(4, 'user-00003', 'Google', 'google@gmail.com', '012349686', 'Google LLC (Google), a subsidiary of Alphabet Inc, is a provider of search and advertising services on the internet. The company\'s business areas include advertising, search, platforms and operating systems, and enterprise and hardware products.', 'www.google.com.my', './images/logo_pic/channels4_profile.jpg', 'Google began as an online search firm, but it now offers more than 50 Internet services and products, from e-mail and online document creation to software for mobile phones and tablet computers. In addition, its 2012 acquisition of Motorola Mobility put the company in the position to sell hardware in the form of mobile phones. Google’s broad product portfolio and size make it one of the top four influential companies in the high-tech marketplace, along with Apple, IBM, and Microsoft. Despite its myriad of products, the original search tool remains the core of Google’s success. In 2016 Alphabet earned nearly all of its revenue from Google advertising based on users’ search requests.', 1),
(5, 'user-00004', 'Apple', 'apple@gmail.com', '123456789', 'Apple Inc. is an American multinational corporation and technology company headquartered in Cupertino, California, in Silicon Valley. It designs, develops, and sells consumer electronics, computer software, and online services.', 'https://www.apple.com/my/', './images/logo_pic/images (1).png', 'Apple Computer Company was founded on April 1, 1976, by Steve Jobs, Steve Wozniak, and Ronald Wayne as a partnership. The company\'s first product is the Apple I, a computer designed and hand-built entirely by Wozniak. To finance its creation, Jobs sold his Volkswagen Bus, and Wozniak sold his HP-65 calculator.', 0),
(6, 'user-00005', '', '', '', NULL, NULL, NULL, '', 5),
(7, 'user-00006', 'Renaissance Holding', '', '', '', '', './images/logo_pic/dslr-camera-icon-vector-illustration-clip-art-57551.jpg', '', 0);

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
('user-00003', 'google@gmail.com', '$2y$10$WvXPfR65nuCAqtmnwNlG3OsXC3Rvl9jcnqWY7oCdYgqgdVXlKu5e6', 'recruiter', '2024-06-20 05:47:30'),
('user-00004', 'apple@gmail.com', '$2y$10$FCwrirb61NShY85rvYsCju.DwB00K/5p8lNLzKH9EzVp.sQupm02S', 'recruiter', '2024-06-23 15:05:27'),
('user-00005', 'huawei@gmail.com', '$2y$10$sqBVCBpYFQjwbpFdumREh.Fwu20fPDDlhiyDjdMlB5wRzAPdjMqL.', 'recruiter', '2024-06-23 15:39:11'),
('user-00006', 'umobile@gmail.com', '$2y$10$xkCFu1GVCDTX4/eqapIIte2m3B66DZWT380lnwn4asS7H6JgxPW9a', 'recruiter', '2024-06-23 16:05:58');

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
  `LastActive` datetime NOT NULL DEFAULT current_timestamp(),
  `prefer_industry` varchar(100) NOT NULL,
  `expected_salary` varchar(100) NOT NULL,
  `availability` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`u_id`, `email`, `User_ID`, `FirstName`, `Lastname`, `ProfilePicture`, `Gender`, `Bio`, `Location`, `Skills`, `Education`, `Experience`, `SocialMediaLinks`, `Resume`, `profile_views`, `LastActive`, `prefer_industry`, `expected_salary`, `availability`) VALUES
('u-00001', 'olc6670@gmail.com', 'user-00001', '', '', 'images/profilepic_default.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-06-23 21:52:32', '', '', ''),
('u-00002', 'leechen787@gmail.com', 'user-00002', '', '', 'images/profilepic_default.jpg', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 12, '2024-06-24 09:28:36', 'Information Technology (IT)', 'RM3000-RM10k', 'Now');

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
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
