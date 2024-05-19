-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2024 at 07:21 PM
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
-- Database: `eva_01_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `acads`
--

CREATE TABLE `acads` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(21) NOT NULL,
  `semester` int(5) NOT NULL,
  `ay_default` int(3) NOT NULL,
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acads`
--

INSERT INTO `acads` (`id`, `academic_year`, `semester`, `ay_default`, `status`) VALUES
(1, '2023-2024', 1, 1, 1),
(2, '2023-2024', 2, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `code` varchar(21) NOT NULL,
  `admin_fname` varchar(30) NOT NULL,
  `admin_mname` varchar(21) NOT NULL,
  `admin_lname` varchar(21) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `admin_pass` varchar(60) NOT NULL,
  `usertype` varchar(21) NOT NULL,
  `token` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `code`, `admin_fname`, `admin_mname`, `admin_lname`, `admin_email`, `admin_pass`, `usertype`, `token`) VALUES
(2, 'admin2', 'Onni', '', 'Chan', '', '$2y$10$uhjrCnmTsBEm1PdkVkGpXuLxESOLsmRiAe2oXZ5LVK1sxqLBFjmW.', 'admin', ''),
(173, 'admin', 'Gen', 'Retardo', 'Roxas', 'g@gg.com', '$2y$10$F1PAN1uX1avqNkAWfvWLiueLK245eGC1Jte3MwwtOowqROcjwQfQW', 'admin', 'pZ2YYFEhna5nn1xYyaUUSScuJ4UMIHGkiK97vOVDQDUqPx3qEQihKxtp0wxt');

-- --------------------------------------------------------

--
-- Table structure for table `criterias`
--

CREATE TABLE `criterias` (
  `id` int(11) NOT NULL,
  `criteria` varchar(50) NOT NULL,
  `order_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `criterias`
--

INSERT INTO `criterias` (`id`, `criteria`, `order_by`) VALUES
(1, 'Objectives', 1),
(2, 'Materials', 2),
(3, 'Subject Matter', 3),
(4, ' Teaching Methods and Strategies', 4),
(5, 'Classroom Management', 5);

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

CREATE TABLE `evaluations` (
  `id` int(11) NOT NULL,
  `academic_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `date_taken` datetime NOT NULL,
  `token` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facultys`
--

CREATE TABLE `facultys` (
  `id` int(11) NOT NULL,
  `code` varchar(21) NOT NULL,
  `faculty_fname` varchar(30) NOT NULL,
  `faculty_mname` varchar(21) NOT NULL,
  `faculty_lname` varchar(21) NOT NULL,
  `faculty_email` varchar(30) NOT NULL,
  `faculty_pass` varchar(60) NOT NULL,
  `usertype` varchar(21) NOT NULL,
  `token` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `handlings`
--

CREATE TABLE `handlings` (
  `id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `acads_id` int(11) NOT NULL,
  `criterias_id` int(11) NOT NULL,
  `question` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `acads_id`, `criterias_id`, `question`) VALUES
(7, 1, 1, 'The teacher communicates the objectives clearly at the start of the lesson.'),
(8, 1, 1, 'The students show understanding of the objectives set by the teacher.'),
(9, 1, 1, 'The objectives are specific.'),
(10, 1, 1, 'The objectives are measurable and attainable. '),
(11, 1, 1, 'The objectives are reasonable and time-bound.'),
(12, 1, 2, 'The materials necessary in the accomplishment of the objectives are ready for use. '),
(13, 1, 2, 'The instructional materials  are appropriate for the lesson.'),
(14, 1, 2, 'The teacher uses relevant and current examples to provide clarity and encourage enthusiasm among the'),
(15, 1, 3, 'The teacher shows mastery  of the subject matter.'),
(16, 1, 3, 'The teacher draws upon the experiences and ideas of the students.'),
(29, 1, 3, 'Explanations and instructions are clear and discussed in detail.'),
(30, 1, 3, 'The lesson is linked to the previous lesson or learning.\r\n<i>Nauugnay ang bagong aralin sa nakaraang'),
(31, 1, 4, 'A variety of activities and questioning techniques  are utilized to provide  opportunities to learne'),
(32, 1, 4, 'The teacher involves all the students, listens to them, and responds appropriately and timely.'),
(33, 1, 4, 'The teacher integrates other learning devices and gadgets to capture the interest of the learners.'),
(34, 1, 4, 'The teacher consistently and properly uses the medium of instruction: Filipino or English'),
(35, 1, 5, 'The students behave well and show high standards of behavior and respect.'),
(36, 1, 5, 'The students maintain the cleanliness and proper arrangement of the classroom'),
(38, 1, 2, 'The materials necessary in the accomplishment of the objectives are ready for use. ');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `question_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `token` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `class_course` varchar(21) NOT NULL,
  `class_level` int(11) NOT NULL,
  `class_section` varchar(21) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `class_course`, `class_level`, `class_section`) VALUES
(1, 'BSIS', 3, 'A'),
(2, 'BSOM', 1, 'A'),
(3, 'BSIS', 1, 'A'),
(4, 'BSAIS', 3, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(21) NOT NULL,
  `set_systemname` varchar(30) NOT NULL,
  `set_theme` varchar(21) NOT NULL,
  `set_logo` varchar(40) NOT NULL,
  `set_schoolname` varchar(50) NOT NULL,
  `set_sem` varchar(30) NOT NULL,
  `set_acadyear` varchar(21) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `set_systemname`, `set_theme`, `set_logo`, `set_schoolname`, `set_sem`, `set_acadyear`) VALUES
(1, 'EVA-01', 'evagreen', 'logo.ico', 'Bulacan Polytechnic College', '1st', '2023-2024');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `code` varchar(21) NOT NULL,
  `stud_fname` varchar(30) NOT NULL,
  `stud_mname` varchar(21) NOT NULL,
  `stud_lname` varchar(21) NOT NULL,
  `stud_class` int(11) NOT NULL,
  `stud_email` varchar(30) NOT NULL,
  `stud_pass` varchar(60) NOT NULL,
  `usertype` varchar(21) NOT NULL,
  `token` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `code`, `stud_fname`, `stud_mname`, `stud_lname`, `stud_class`, `stud_email`, `stud_pass`, `usertype`, `token`) VALUES
(17, 'a', 'Gen', 'Retardo', 'Roxas', 1, 'g@g.com', '$2y$10$w/wdwgUk3xUa8HRAu.6CyubTwDXDuYP1pU3k9fN96UrfhHIudAMM2', 'student', 'Zy4NxuXvWZBoqL4Rl4pgbvNEKqf8njv2MYkPv3nsXTiEIz2z5bJWFolkmBJO');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `code` varchar(21) NOT NULL,
  `subject` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `code`, `subject`) VALUES
(1, 'WEBA-323', 'Web Development 323'),
(2, 'EFM-323', 'Financial Management 323'),
(3, 'EPC-323', 'Partnership and Corporation 323'),
(6, 'MOT-323', 'Management Technology');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acads`
--
ALTER TABLE `acads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `criterias`
--
ALTER TABLE `criterias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facultys`
--
ALTER TABLE `facultys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `handlings`
--
ALTER TABLE `handlings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acads`
--
ALTER TABLE `acads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `criterias`
--
ALTER TABLE `criterias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `facultys`
--
ALTER TABLE `facultys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `handlings`
--
ALTER TABLE `handlings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
