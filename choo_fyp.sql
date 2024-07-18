-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2024 at 10:15 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collab_invites`
--

INSERT INTO `collab_invites` (`id`, `collab_id`, `proj_id`, `sender_id`, `receiver_id`, `status`, `message`, `created_at`) VALUES
(46, 'collab-000046', 'proj-6656bed0b57a2', 'user-00007', 'user-00003', 'pending', 'hi', '2024-07-03'),
(47, 'collab-000047', 'proj-667976cb1c8db', 'user-00003', 'user-00002', 'pending', 'Hi', '2024-07-03'),
(48, 'collab-000048', 'proj-668510a13894d', 'user-00002', 'user-00001', 'pending', 'hi im interested in your project. pls contact me', '2024-07-18'),
(49, 'collab-000049', 'proj-66855d7ce9a84', 'user-00001', 'user-00009', 'pending', 'hi', '2024-07-18'),
(50, 'collab-000050', 'proj-667976cb1c8db', 'user-00001', 'user-00002', 'pending', 'hi', '2024-07-18'),
(51, 'collab-000051', 'proj-6666ae9bf267d', 'user-00001', 'user-00002', 'accepted', 'hi contact me pls', '2024-07-18');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `job_title`, `job_desc`, `job_location`, `salary`, `requirement`, `date_posted`, `job_types`, `recruiter_id`, `job_status`, `job_image`, `job_industry`, `job_views`) VALUES
('job_6678365f761e21.70492990', 'Software Developer', 'Develops and maintains software applications.', 'Kuala Lumpur, MY', 'RM3000-RM5000', 'Bachelor\'s degree in Computer Science or related field\r\nProficiency in programming languages (e.g., Java, Python, C++)\r\nExperience with software development frameworks (e.g., .NET, Spring)\r\nStrong problem-solving skills\r\nAbility to work in a team environment', '2024-06-23', 'Full Time', 'user-00003', 1, './files/images/job_6678365f761e21.70492990.png', 'Information Technology (IT)', 6),
('job_6678373409ef77.47944892', 'Web Developer', 'Creates and maintains websites.', 'Kuching, MY', 'RM3000-RM4000', 'Bachelor\'s degree in Computer Science, Information Technology, or related field\r\nProficiency in web technologies (e.g., HTML, CSS, JavaScript)\r\nExperience with web development frameworks (e.g., React, Angular, Vue)\r\nStrong understanding of responsive design\r\nGood communication and teamwork skills', '2024-06-23', 'Full Time', 'user-00003', 1, './files/images/job_6678373409ef77.47944892.png', 'Information Technology (IT)', 5),
('job_667837da3a6297.27199801', 'Accountant', 'Manages financial records and transactions.', 'Penang, MY', 'RM4000-RM5000', 'Bachelor\'s degree in Accounting, Finance, or related field\r\nCertified Public Accountant (CPA) designation preferred\r\nExperience with accounting software (e.g., QuickBooks, SAP)\r\nStrong attention to detail\r\nExcellent organizational and time management skills', '2024-06-23', 'Full Time', 'user-00003', 1, './files/images/job_667837da3a6297.27199801.jpg', 'Finance', 2),
('job_667838eebeb8c5.43211085', 'Support Analyst', 'To support and maintain the company’s mission critical business applications.', 'Sabah, MY', 'RM4000-RM5000', 'BSc degree in Software Engineering or IT equivalent\r\n1-2 years in troubleshooting and analytical skills Programming/Support and debugging exposure in either of COBOL/ RPG/ Java/ C or C++\r\nFresh Graduates are also encouraged to apply (training will be provided)\r\nCommunicate well both in written and verbal', '2024-06-23', 'Full Time', 'user-00003', 1, './files/images/job_667838eebeb8c5.43211085.png', 'Information Technology (IT)', 0),
('job_6678394c751844.14954836', 'Robotic Software Engineer', 'Perform research and development on improving the docking, localization, path planning and navigation algorithms of the AMR. ', 'Penang, MY', 'RM4000-RM7000', 'Candidates possess at least a Bachelor\'s Degree or Master in Computer Science, Software Engineering, Robotics or related field \r\nStrong math skills, familiarity with mathematical optimization in autonomous navigation and computer vision\r\nAt least 1 year in software development on autonomous robot. \r\nProgramming skill (s): Python, C++, C#.Net, ASP.Net, Spring, JavaScript, JQuery, CSS, Mobile application, Linux, SQL, Object Oriented Program, Artificial Intelligence, Computer Vision and etc.', '2024-06-23', 'Full Time', 'user-00003', 1, './files/images/job_6678394c751844.14954836.png', 'Information Technology (IT)', 1),
('job_66783b9aee59f5.62549473', 'Product Engineering Manager', 'Responsible for reviewing and supervision of new products and existing product designs, which includes but not limited to Filtration, Office Automation, Automotive and Sub-assemblies. ', 'Johor, MY', 'RM3000-RM5000', 'Graduate mechanical, manufacturing or production engineer - B.Sc., B.Eng. or higher. \r\nSolid experience of min 5 years managing high-volume manufacturing / semi-automated assembly processes - your experience will probably have been gained (but not exclusively) ', '2024-06-23', 'Full Time', 'user-00004', 1, './files/images/job_66783b9aee59f5.62549473.jpg', 'Engineering', 0),
('job_66783bfa965591.54015572', 'Maintenance Engineer', 'f', 'Johor, MY', 'RM3000-RM4500', 'f', '2024-06-23', 'Full Time', 'user-00004', 1, './files/images/job_66783bfa965591.54015572.jpg', 'Engineering', 0),
('job_66783dca1da567.27729944', 'Product Planning Specialist', 'Conduct user demand research and user behavior analysis, and formulate product development plans based on business positioning;\r\n2. According to product planning, determine product functions, processes, user experience and back-end solutions, draw product prototypes, and write relevant requirements documents;', 'Johor, MY', 'RM 3,500 – RM 5,200', '1. Clear logic and able to understand and explore customer needs;\r\n2. More than two years of experience as a mobile product manager, intermediate product manager or above, experience in Internet products\r\n3. Sensitive to business and data, good at identifying and solving problems;', '2024-06-23', 'Full Time', 'user-00004', 1, './files/images/job_66783dca1da567.27729944.jpg', 'Sales and Marketing', 0),
('job_66783e6d067b97.96978039', 'Engineering and Computer Science Intern (Bachelor)', 'Collaborate with experienced engineers to troubleshoot and resolve production issues, ensuring the smooth operation of our manufacturing processes.\r\nContribute to the design, development, and implementation of automated projects aimed at enhancing efficiency, precision, and overall productivity.', 'Penang, MY', 'RM 1,500', 'Diploma or Degree in Electrical and Electronics or ECE or equivalent relevant. \r\nStrong problem-solving skills and an analytical mindset.\r\nProficiency in relevant software tools, such as CAD, programming languages, and data analysis tools, is a plus.', '2024-06-23', 'Internship', 'user-00004', 1, './files/images/job_66783e6d067b97.96978039.png', 'Information Technology (IT)', 2),
('job_66783f13474cd6.06638430', 'Part Time Lecturer', 'To prepare lecture materials\r\n- To conduct lectures during designated lecture hours\r\n- To evaluate student performance in a particular course\r\n- To provide counseling for students', 'Penang, MY', 'RM2000-RM3000', 'Computer Science, Mechanical Engineering, Marketing, Business, Accounting, Broadcasting Media etc.', '2024-06-23', 'Part Time', 'user-00004', 1, './files/images/job_66783f13474cd6.06638430.jpg', 'Education', 5),
('job_667840d2ad9da1.05029999', 'IT Teacher/ Coding Teacher/ Programming Teacher', 'ffff', 'Sibu, Sarawak', 'RM2000-RM3000', 'Suitable candidates should hold Bachelor’s degree or higher (preferably in IT/Computer Science). Knowledge of Android/JavaScript/WordPress would be a strong competitive advantage.', '2024-06-23', 'Part Time', 'user-00004', 1, './files/images/job_667840d2ad9da1.05029999.png', 'Information Technology (IT)', 2),
('job_66784863840b23.52302608', 'Capsule Hotel Associates - Front Office &Housekeeping', 'Responsible to welcome and greet guests.\r\nResponsible to answer and direct incoming calls. \r\nResponsible for room reservations, proper room allocation and the issuance of room keys.', 'Kota Kinabalu, Sabah', 'RM 1,500 – RM 2,250', 'Candidate must possess at least a Higher Secondary/STPM/\"A\" Level/Pre-U, Professional Certificate, Diploma, Advanced/Higher/Graduate Diploma, Food & Beverage Services Management, Hospitality/Tourism/Hotel Management, Business Studies/Administration/Management or equivalent.\r\nRequired language(s): Mandarin, English, BM', '2024-06-24', 'Full Time', 'user-00006', 1, './files/images/job_66784863840b23.52302608.jpg', 'Hospitality and Tourism', 4),
('job_667848aeac56c1.29077791', 'Tea Barista', 'Understand and fulfilling task relevant to operate a food & beverage outlet.\r\nAble to learn inside-out about tea-based beverage outlet including skillset to brew the beverage based out in-house recipe.\r\nGreeting customers in a friendly manner and taking food and drink orders.\r\nPreparing and serving beverages such as tea and other specialty drinks.\r\nResponding to and resolving customer concerns or complaints.', 'Penang', 'RM 2,000 – RM 2,500', 'Candidate with/without SPM.\r\nPossess own transport.\r\nNo prior working experience required.\r\nHave a typhoid vaccine before start working (Can be claimed).\r\nAble to work for full-time (Part-time application will not be entertained).\r\nAble to go for 1-2 weeks training in KL (Hostel provided during training).', '2024-06-24', 'Full Time', 'user-00006', 1, './files/images/job_667848aeac56c1.29077791.jpg', 'Hospitality and Tourism', 8),
('job_668503efb3c042.19220357', 'Dahlia College Marketing Team Leader', 'draft and communicate marketing strategies to achieve objectives, plan and organize community outreach events, and cultivate partnerships with local organizations. They also manage social media, develop promotional materials, and analyze market trends.', 'Kota Samarahan ', '2000', 'Degree in Marketing', '2024-07-03', 'Full Time', 'user-00008', 1, './files/images/job_668503efb3c042.19220357.png', 'Sales and Marketing', 38);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_application`
--

INSERT INTO `job_application` (`application_id`, `job_id`, `applicant_id`, `application_status`, `cover_letter`, `resume`, `applied_at`) VALUES
('oVypHbYlNo', 'job_667840d2ad9da1.05029999', 'user-00009', 'pending', './files/resume/20th FCSIT FYP Symposium Tentative (amended).pdf', './files/resume/Day 1 - 03 July 2024 FYP Exhibition and Presentation v2.pdf', '2024-07-03 20:41:19'),
('rL4Vf03Urv', 'job_667848aeac56c1.29077791', 'user-00002', 'pending', './files/resume/Poster Guides.pdf', './files/resume/FYP1 & 2 Important Dates.pdf', '2024-06-23 17:19:18');

-- --------------------------------------------------------

--
-- Table structure for table `profile_views`
--

CREATE TABLE `profile_views` (
  `profile_id` varchar(100) NOT NULL,
  `view_date` date NOT NULL,
  `view_count` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile_views`
--

INSERT INTO `profile_views` (`profile_id`, `view_date`, `view_count`) VALUES
('user-00001', '2024-07-12', 8),
('user-00001', '2024-07-13', 13),
('user-00001', '2024-07-14', 9),
('user-00001', '2024-07-15', 23),
('user-00001', '2024-07-16', 5),
('user-00001', '2024-07-17', 10),
('user-00001', '2024-07-18', 1),
('user-00002', '2024-07-18', 2),
('user-00003', '2024-07-18', 1);

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
  `proj_status` int(11) NOT NULL DEFAULT 1,
  `project_image` varchar(255) NOT NULL DEFAULT '../images/Team_Office.jpg',
  `project_view` int(11) NOT NULL DEFAULT 0,
  `proj_field` varchar(100) NOT NULL,
  `collab_type` varchar(100) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `user_id`, `title`, `description`, `created_at`, `project_path`, `proj_status`, `project_image`, `project_view`, `proj_field`, `collab_type`) VALUES
('proj-6656bb957636b', 'user-00001', 'Virtual Interior Design Assistant', 'Create a virtual assistant that helps users visualize and design interior spaces by suggesting furniture arrangements, color schemes, and decor options.', '2024-05-30', './files/project/IMG_20240418_185958.jpg', 0, '../images/Team_Office.jpg', 0, 'Others', 'International'),
('proj-6656bccb9d870', 'user-00004', 'E-Learning Platform for Skill Development', 'Build an online platform that offers courses and resources for skill development in various domains, catering to different learning styles and proficiency levels.', '2024-05-29', './files/project/proj-6656bccb9d870.jpg', 1, '../images/Team_Office.jpg', 2, 'Education', 'Local'),
('proj-6656bed0b57a2', 'user-00003', 'Urban Traffic Management System', 'Design a system to optimize traffic flow in urban areas using real-time data from sensors, cameras, and GPS devices, reducing congestion and improving efficiency.', '2024-05-29', './files/project/proj-6656bed0b57a2.png', 0, '../images/Team_Office.jpg', 5, 'Information Technology (IT)', 'Local'),
('proj-6656c028ad038', 'user-00006', 'Remote Agricultural Monitoring System', 'Create a system that uses satellite imagery and IoT sensors to monitor crop health, soil moisture levels, and weather conditions, enabling farmers to make data-driven decisions for better yield and resource management.', '2024-05-31', './files/project/proj-6656c028ad038.jpg', 1, '../images/Team_Office.jpg', 6, 'Information Technology (IT)', 'International'),
('proj-6656c33962b9b', 'user-00003', 'Smart Home Energy Management System', 'Embark on the creation of an innovative energy management ecosystem tailored for smart homes, designed to revolutionize how households interact with energy. This advanced system will go beyond traditional automation, utilizing cutting-edge machine learning algorithms to continuously learn and adapt to the dynamic needs of users and the environment. By orchestrating appliance usage in real-time, considering factors like occupancy, time-of-use pricing, weather conditions, and individual user preferences, it will pave the way for a greener, more efficient, and cost-effective future in residential energy consumption.', '2024-05-29', './files/project/proj-6656c33962b9b.jpg', 1, '../images/Team_Office.jpg', 3, 'Information Technology (IT)', 'International'),
('proj-6666a982eb533', 'user-00005', 'Development of a Mobile Banking Application for XYZ Bank', ' The project involves designing and developing a mobile app that allows users to manage their bank accounts, transfer money, pay bills, and deposit checks using their smartphones. Key features include biometric login, real-time transaction alerts, budgeting tools, and customer support chat. The development process includes UI/UX design, backend integration with existing banking systems, rigorous security testing, and a phased rollout plan.', '2024-06-10', './files/project/proj-6666a982eb533.js', 1, '../images/Team_Office.jpg', 7, 'Information Technology (IT)', 'International'),
('proj-6666ae9bf267d', 'user-00002', 'E-commerce Website Development for MNO Retail Chain', 'This project involves developing a feature-rich e-commerce website that offers a seamless shopping experience. Features include product search and filtering, detailed product descriptions, customer reviews, personalized recommendations, and multiple payment options. The development process includes designing the user interface, building the backend infrastructure, integrating with inventory and logistics systems, and implementing cybersecurity measures to protect customer data.', '2024-06-10', './files/project/proj-6666ae9bf267d.pdf', 1, '../images/Team_Office.jpg', 20, 'Information Technology (IT)', 'International'),
('proj-6666c0e04188b', 'user-00006', 'Launch of an Online Learning Platform for DEF University', 'The project entails creating a comprehensive online platform that offers live classes, recorded lectures, interactive assignments, and discussion forums. The platform will support various course formats, including self-paced and instructor-led courses. Development includes creating a responsive design, integrating video conferencing tools, implementing a robust Learning Management System (LMS), and setting up analytics to track student performance and engagement.', '2024-06-10', './files/project/proj-6666c0e04188b.pdf', 0, '../images/Team_Office.jpg', 0, 'Education', 'Local'),
('proj-668510a13894d', 'user-00001', 'Hiking Photographer', 'Hi I am looking for passionate Hiking Photographer on 7th July. Do collab with me and let me know anything. ', '2024-07-03', './files/project/proj-668510dd1390a.JPG', 1, './files/images/image-668510dd14214.JPG', 17, 'Others', 'Local'),
('proj-668521a853002', 'user-00009', 'Tree planting project', 'We will organize a tree planting project in November. We are looking for anyone who loves natures and willing to build up this project together. ', '2024-07-03', './files/project/proj-668521a853002.png', 1, './files/images/image-668521a8532db.JPG', 9, 'Others', 'Local'),
('proj-66855d7ce9a84', 'user-00009', 'Beach Cleaning', 'Beach cleaning project, we needed crew to collab with us. Do collab with us!', '2024-07-03', './files/project/proj-66855d7ce9a84.mp4', 1, './files/images/image-66855d7ce9f90.jpg', 45, 'Others', 'Local'),
('proj-6698875029da3', 'user-00002', 'Development of an Automated Vehicle Counting System', 'This project focuses on developing an automated vehicle counting system using computer vision techniques. The system utilizes archived CCTV footage to count and classify vehicles in real-time, improving traffic management and data collection for urban planning. The project aims to replace traditional manual methods with an efficient, accurate, and scalable solution.', '2024-07-18', './files/project/proj-6698875029da3.docx', 1, './files/images/image-6698875029fbe.jpeg', 19, 'Information Technology (IT)', 'Local');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recruiter_profile`
--

INSERT INTO `recruiter_profile` (`r_id`, `User_ID`, `company_name`, `contact_email`, `contact_phone`, `about`, `website`, `logo`, `background`, `profileView`) VALUES
(4, 'user-00003', 'Google', 'google@gmail.com', '012349686', 'Google LLC (Google), a subsidiary of Alphabet Inc, is a provider of search and advertising services on the internet. The company\'s business areas include advertising, search, platforms and operating systems, and enterprise and hardware products.', 'www.google.com.my', './images/logo_pic/channels4_profile.jpg', 'Google began as an online search firm, but it now offers more than 50 Internet services and products, from e-mail and online document creation to software for mobile phones and tablet computers. In addition, its 2012 acquisition of Motorola Mobility put the company in the position to sell hardware in the form of mobile phones. Google’s broad product portfolio and size make it one of the top four influential companies in the high-tech marketplace, along with Apple, IBM, and Microsoft. Despite its myriad of products, the original search tool remains the core of Google’s success. In 2016 Alphabet earned nearly all of its revenue from Google advertising based on users’ search requests.', 6),
(5, 'user-00004', 'Apple', 'apple@gmail.com', '123456789', 'Apple Inc. is an American multinational corporation and technology company headquartered in Cupertino, California, in Silicon Valley. It designs, develops, and sells consumer electronics, computer software, and online services.', 'https://www.apple.com/my/', './images/logo_pic/images (1).png', 'Apple Computer Company was founded on April 1, 1976, by Steve Jobs, Steve Wozniak, and Ronald Wayne as a partnership. The company\'s first product is the Apple I, a computer designed and hand-built entirely by Wozniak. To finance its creation, Jobs sold his Volkswagen Bus, and Wozniak sold his HP-65 calculator.', 3),
(7, 'user-00006', 'Renaissance Holding', '', '', '', '', './images/logo_pic/dslr-camera-icon-vector-illustration-clip-art-57551.jpg', '', 4),
(9, 'user-00008', 'UNIMAS Holding', 'helpdesk@unimasholdings.com', '+60 82 22 2000', 'Established in 2006, UNIMAS Holdings Sdn. Bhd.  (UHSB) is a commercial and investment arm  of Universiti Malaysia Sarawak (UNIMAS). It is a  company (Company no. 727487-D) incorporated  in Malaysia under the Companies Act 1965.\r\n\r\nAs a wholly owned subsidiary of UNIMAS,  UHSB is primarily established to diversify the  revenues generation for the university and create  entrepreneurial opportunities that will benefit  both internal and external communities of  UNIMAS. The company’s main business activities  are to leverage on UNIMAS facilities, academic  experts and resources through intellectual  services, research ventures, and strategic  partnerships with the public and private sectors', 'https://www.unimasholdings.unimas.my/', './images/logo_pic/download (1).png', 'UNIMAS Holdings Sdn. Bhd. plays a pivotal role  in matching the various gaps across industries  with the pool of expertise, knowledge, and  resources available within UNIMAS through  impactful consultancy projects.', 17),
(10, 'user-00011', '', '', '', NULL, NULL, NULL, '', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `email`, `password`, `role`, `created_at`) VALUES
('user-00001', 'olc6670@gmail.com', '$2y$10$r2ttA/oJeOCfCQIh/Jp/7OqGzc7isIiS8Y0ZK1i9gbB7q.HBmuIwe', 'user', '2024-06-20 05:45:59'),
('user-00002', 'leechen787@gmail.com', '$2y$10$RgPPWb9BueqCO85Pv6xJvu1iz5fzBjtonNMgQTZ5GLEHGew9P4eoS', 'user', '2024-06-20 05:46:39'),
('user-00003', 'google@gmail.com', '$2y$10$WvXPfR65nuCAqtmnwNlG3OsXC3Rvl9jcnqWY7oCdYgqgdVXlKu5e6', 'recruiter', '2024-06-20 05:47:30'),
('user-00004', 'apple@gmail.com', '$2y$10$FCwrirb61NShY85rvYsCju.DwB00K/5p8lNLzKH9EzVp.sQupm02S', 'recruiter', '2024-06-23 15:05:27'),
('user-00005', 'huawei@gmail.com', '$2y$10$sqBVCBpYFQjwbpFdumREh.Fwu20fPDDlhiyDjdMlB5wRzAPdjMqL.', 'recruiter', '2024-06-23 15:39:11'),
('user-00006', 'umobile@gmail.com', '$2y$10$xkCFu1GVCDTX4/eqapIIte2m3B66DZWT380lnwn4asS7H6JgxPW9a', 'recruiter', '2024-06-23 16:05:58'),
('user-00007', 'bapu2305@gmail.com', '$2y$10$93284C6WHtedFvmeYctphuVQqlIbW/L.DpOv58usYRgB0EomaQ/0q', 'recruiter', '2024-07-03 05:50:40'),
('user-00008', 'recruitertesting@email.com', '$2y$10$8QmhfysDMik24i..tfJcA.5GmVFAVtFtJ3aeD/dkUFWr5sJqY6o6q', 'recruiter', '2024-07-03 07:36:49'),
('user-00009', 'usertesting@email.com', '$2y$10$vcxiPmpAXHxTFpqrhewR1e46KTszjza8CG12tb5EYP618e52CxJCW', 'user', '2024-07-03 08:56:09'),
('user-00010', '1234@gmail.com', '$2y$10$zg1buzmrcR2aCv2Pxn9lCewZzWKCbqYi7ZvpdehixwYXfbvY5yf/u', 'user', '2024-07-17 13:40:57'),
('user-00011', '1111@hotmail.com', '$2y$10$Mm75SXaFTgmOnRSIGgwS.u3SxGma/dVpjmnX6lTBcS2pd63QrQMDu', 'recruiter', '2024-07-17 13:58:04');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`u_id`, `email`, `User_ID`, `FirstName`, `Lastname`, `ProfilePicture`, `Gender`, `Bio`, `Location`, `Skills`, `Education`, `Experience`, `SocialMediaLinks`, `Resume`, `profile_views`, `LastActive`, `prefer_industry`, `expected_salary`, `availability`) VALUES
('u-00001', 'olc6670@gmail.com', 'user-00001', 'Leonal Sigar', 'Jame', './images/pro_pic/photo1705494717.jpeg', 'Male', 'Hi my name is Leonal. I graduated at UNIMAS, Bachelor\'s Degree of Computer Science in Multimedia Computing. ', 'Kuching', 'C++, C, Javascript, Computer Graphics, UI/UX. Grade 7 in ABRSM Piano', 'SPM 10A+\r\nSTPM CGPA 3.5', 'Internship at XeerSoft ', '', NULL, 25, '2024-07-18 11:54:27', 'Information Technology (IT)', 'RM0-RM3000', 'Now'),
('u-00002', 'leechen787@gmail.com', 'user-00002', 'Lee Chen', 'Ooi', './images/pro_pic/IMG_20221223_140553.jpg', 'Female', 'Hi! I am Ooi Lee Chen. graduaed at UNIMAS Bachelor\'s Degree in Computer Science Multimedia Computing. ', 'Kuala Lumpur', 'C++, C, Javascript, Computer Graphics, ', 'SPM: 9A 1B\r\nSTPM: CGPA 3.33', 'Internship at XeerSoft ', '', NULL, 34, '2024-07-18 10:28:51', 'Information Technology (IT)', 'RM0-RM3000', '2 weeks'),
('u-00003', 'usertesting@email.com', 'user-00009', 'Yong Sheng', 'Choo', './images/pro_pic/IMG_1993.jpg', 'Male', 'Hi, I am Choo Yong Sheng, graduated at UNIMAS Bachelor\'s Degree of Computer Science in Multimedia Computing. ', 'Batu Pahat', 'C++, C, Javascript, Computer Graphics, UI/UX. Grade 7 in ABRSM Piano', NULL, 'Internship at XeerSoft ', '', './files/resume/Blue Minimalist Modern Professional Lead Recruiter Resume (1).pdf', 15, '2024-07-03 22:13:02', 'Information Technology (IT)', '', ''),
('u-00004', '1234@gmail.com', 'user-00010', '', '', 'images/profilepic_default.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-07-17 23:42:06', '', '', '');

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
-- Indexes for table `profile_views`
--
ALTER TABLE `profile_views`
  ADD PRIMARY KEY (`profile_id`,`view_date`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `recruiter_profile`
--
ALTER TABLE `recruiter_profile`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
