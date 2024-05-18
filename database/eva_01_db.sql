-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2024 at 04:30 AM
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
(1, '2023-2024', 1, 1, 2),
(2, '2023-2024', 2, 0, 2),
(3, '2023-2024', 1, 0, 2),
(4, '2024-2025', 1, 0, 0);

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
(1, 'admin', 'Boy', 'Retardo', 'Bakal', 'genesisroxas4@gmaiil.com', '1234', 'admin', ''),
(2, 'admin2', 'Onni', '', 'Chan', '', '1234', 'admin', '');

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
  `subject_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `date_taken` datetime NOT NULL,
  `token` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluations`
--

INSERT INTO `evaluations` (`id`, `academic_id`, `class_id`, `stud_id`, `subject_id`, `faculty_id`, `comment`, `date_taken`, `token`) VALUES
(18, 1, 1, 17, 3, 7, 'halow', '2024-05-17 11:18:37', 'r9RvtTewkrNt4xj5BGKNclJjx');

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

--
-- Dumping data for table `facultys`
--

INSERT INTO `facultys` (`id`, `code`, `faculty_fname`, `faculty_mname`, `faculty_lname`, `faculty_email`, `faculty_pass`, `usertype`, `token`) VALUES
(5, '24-00001', 'Manny', 'D', 'Pacquiao', 'mannyp@g.com', '$2y$10$PyR8dQnNCNkdJ74VkZJpZuQ66xgj6iokja2D1gdj6msezPN6MOwyy', 'faculty', 'LOhB6fMjuTo1iakZz9jlJ5zNzMmkWlZx1qwQVFM2t2fpfi1AW3RZ0T459yDP'),
(6, '24-00002', 'Alex', 'G', 'Mercer', 'alexm@m.com', '$2y$10$w1ysEDCzoCki6yJQhvdYpeI9fcs0jwzMRs43HGgOgcdoHYS9kYIy.', 'faculty', '6suboZI6918q0rpimswjmw38x2hocEazoL6vKYSoEhz9jFRNIuoWJ02Ct5vG'),
(7, '24-00003', 'Carl', 'J', 'Johnson', 'carlj@g.com', '$2y$10$Z2fzSdLQnJCjhuHOjhXs9OZPkaxg75iDI7hX2qJL1vA8XqZMVbO7i', 'faculty', 'hr9M9nnzb5ak98bZSMiTktgj2xLesAOnAwncEZHHTaE2AzQDgJ8EoWZo2Tli');

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

--
-- Dumping data for table `handlings`
--

INSERT INTO `handlings` (`id`, `faculty_id`, `subject_id`, `section_id`) VALUES
(44, 5, 2, 1),
(45, 6, 2, 1),
(46, 7, 3, 1),
(49, 7, 2, 2);

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
(36, 1, 5, 'The students maintain the cleanliness and proper arrangement of the classroom. They follow the \"Clea');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `question_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `token` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`question_id`, `rate`, `token`) VALUES
(7, 1, 'YwIFmh9J8cVQGuQBDuUr09jwP'),
(8, 1, 'YwIFmh9J8cVQGuQBDuUr09jwP'),
(9, 1, 'YwIFmh9J8cVQGuQBDuUr09jwP'),
(10, 1, 'YwIFmh9J8cVQGuQBDuUr09jwP'),
(11, 1, 'YwIFmh9J8cVQGuQBDuUr09jwP'),
(12, 1, 'YwIFmh9J8cVQGuQBDuUr09jwP'),
(13, 1, 'YwIFmh9J8cVQGuQBDuUr09jwP'),
(14, 1, 'YwIFmh9J8cVQGuQBDuUr09jwP'),
(15, 1, 'YwIFmh9J8cVQGuQBDuUr09jwP'),
(16, 1, 'YwIFmh9J8cVQGuQBDuUr09jwP'),
(29, 1, 'YwIFmh9J8cVQGuQBDuUr09jwP'),
(30, 1, 'YwIFmh9J8cVQGuQBDuUr09jwP'),
(31, 1, 'YwIFmh9J8cVQGuQBDuUr09jwP'),
(32, 1, 'YwIFmh9J8cVQGuQBDuUr09jwP'),
(33, 1, 'YwIFmh9J8cVQGuQBDuUr09jwP'),
(34, 1, 'YwIFmh9J8cVQGuQBDuUr09jwP'),
(35, 1, 'YwIFmh9J8cVQGuQBDuUr09jwP'),
(36, 1, 'YwIFmh9J8cVQGuQBDuUr09jwP'),
(7, 1, 'M2KCvsZOhwdgYIbiKF3makM7y'),
(8, 1, 'M2KCvsZOhwdgYIbiKF3makM7y'),
(9, 1, 'M2KCvsZOhwdgYIbiKF3makM7y'),
(10, 1, 'M2KCvsZOhwdgYIbiKF3makM7y'),
(11, 1, 'M2KCvsZOhwdgYIbiKF3makM7y'),
(12, 1, 'M2KCvsZOhwdgYIbiKF3makM7y'),
(13, 1, 'M2KCvsZOhwdgYIbiKF3makM7y'),
(14, 1, 'M2KCvsZOhwdgYIbiKF3makM7y'),
(15, 1, 'M2KCvsZOhwdgYIbiKF3makM7y'),
(16, 1, 'M2KCvsZOhwdgYIbiKF3makM7y'),
(29, 1, 'M2KCvsZOhwdgYIbiKF3makM7y'),
(30, 1, 'M2KCvsZOhwdgYIbiKF3makM7y'),
(31, 1, 'M2KCvsZOhwdgYIbiKF3makM7y'),
(32, 1, 'M2KCvsZOhwdgYIbiKF3makM7y'),
(33, 1, 'M2KCvsZOhwdgYIbiKF3makM7y'),
(34, 1, 'M2KCvsZOhwdgYIbiKF3makM7y'),
(35, 1, 'M2KCvsZOhwdgYIbiKF3makM7y'),
(36, 1, 'M2KCvsZOhwdgYIbiKF3makM7y'),
(7, 1, 'BIbwHTMGHqXpzZweQXOdiwNjR'),
(8, 1, 'BIbwHTMGHqXpzZweQXOdiwNjR'),
(9, 1, 'BIbwHTMGHqXpzZweQXOdiwNjR'),
(10, 1, 'BIbwHTMGHqXpzZweQXOdiwNjR'),
(11, 1, 'BIbwHTMGHqXpzZweQXOdiwNjR'),
(12, 1, 'BIbwHTMGHqXpzZweQXOdiwNjR'),
(13, 1, 'BIbwHTMGHqXpzZweQXOdiwNjR'),
(14, 1, 'BIbwHTMGHqXpzZweQXOdiwNjR'),
(15, 1, 'BIbwHTMGHqXpzZweQXOdiwNjR'),
(16, 1, 'BIbwHTMGHqXpzZweQXOdiwNjR'),
(29, 1, 'BIbwHTMGHqXpzZweQXOdiwNjR'),
(30, 1, 'BIbwHTMGHqXpzZweQXOdiwNjR'),
(31, 1, 'BIbwHTMGHqXpzZweQXOdiwNjR'),
(32, 1, 'BIbwHTMGHqXpzZweQXOdiwNjR'),
(33, 1, 'BIbwHTMGHqXpzZweQXOdiwNjR'),
(34, 1, 'BIbwHTMGHqXpzZweQXOdiwNjR'),
(35, 1, 'BIbwHTMGHqXpzZweQXOdiwNjR'),
(36, 1, 'BIbwHTMGHqXpzZweQXOdiwNjR'),
(7, 1, 'Zqlcj2lUwpJChnchUMGb0fra2'),
(8, 1, 'Zqlcj2lUwpJChnchUMGb0fra2'),
(9, 1, 'Zqlcj2lUwpJChnchUMGb0fra2'),
(10, 1, 'Zqlcj2lUwpJChnchUMGb0fra2'),
(11, 1, 'Zqlcj2lUwpJChnchUMGb0fra2'),
(12, 1, 'Zqlcj2lUwpJChnchUMGb0fra2'),
(13, 1, 'Zqlcj2lUwpJChnchUMGb0fra2'),
(14, 1, 'Zqlcj2lUwpJChnchUMGb0fra2'),
(15, 1, 'Zqlcj2lUwpJChnchUMGb0fra2'),
(16, 1, 'Zqlcj2lUwpJChnchUMGb0fra2'),
(29, 1, 'Zqlcj2lUwpJChnchUMGb0fra2'),
(30, 1, 'Zqlcj2lUwpJChnchUMGb0fra2'),
(31, 1, 'Zqlcj2lUwpJChnchUMGb0fra2'),
(32, 1, 'Zqlcj2lUwpJChnchUMGb0fra2'),
(33, 1, 'Zqlcj2lUwpJChnchUMGb0fra2'),
(34, 1, 'Zqlcj2lUwpJChnchUMGb0fra2'),
(35, 1, 'Zqlcj2lUwpJChnchUMGb0fra2'),
(36, 1, 'Zqlcj2lUwpJChnchUMGb0fra2'),
(7, 1, 'En4WNhP8BDlEkRo06MsRifpfd'),
(8, 1, 'En4WNhP8BDlEkRo06MsRifpfd'),
(9, 1, 'En4WNhP8BDlEkRo06MsRifpfd'),
(10, 1, 'En4WNhP8BDlEkRo06MsRifpfd'),
(11, 1, 'En4WNhP8BDlEkRo06MsRifpfd'),
(12, 1, 'En4WNhP8BDlEkRo06MsRifpfd'),
(13, 1, 'En4WNhP8BDlEkRo06MsRifpfd'),
(14, 1, 'En4WNhP8BDlEkRo06MsRifpfd'),
(15, 1, 'En4WNhP8BDlEkRo06MsRifpfd'),
(16, 1, 'En4WNhP8BDlEkRo06MsRifpfd'),
(29, 1, 'En4WNhP8BDlEkRo06MsRifpfd'),
(30, 1, 'En4WNhP8BDlEkRo06MsRifpfd'),
(31, 1, 'En4WNhP8BDlEkRo06MsRifpfd'),
(32, 1, 'En4WNhP8BDlEkRo06MsRifpfd'),
(33, 1, 'En4WNhP8BDlEkRo06MsRifpfd'),
(34, 1, 'En4WNhP8BDlEkRo06MsRifpfd'),
(35, 1, 'En4WNhP8BDlEkRo06MsRifpfd'),
(36, 1, 'En4WNhP8BDlEkRo06MsRifpfd'),
(7, 1, '4PcJYm9KNXHmwBmQne8eFCC0q'),
(8, 1, '4PcJYm9KNXHmwBmQne8eFCC0q'),
(9, 1, '4PcJYm9KNXHmwBmQne8eFCC0q'),
(10, 1, '4PcJYm9KNXHmwBmQne8eFCC0q'),
(11, 1, '4PcJYm9KNXHmwBmQne8eFCC0q'),
(12, 1, '4PcJYm9KNXHmwBmQne8eFCC0q'),
(13, 1, '4PcJYm9KNXHmwBmQne8eFCC0q'),
(14, 1, '4PcJYm9KNXHmwBmQne8eFCC0q'),
(15, 1, '4PcJYm9KNXHmwBmQne8eFCC0q'),
(16, 1, '4PcJYm9KNXHmwBmQne8eFCC0q'),
(29, 1, '4PcJYm9KNXHmwBmQne8eFCC0q'),
(30, 1, '4PcJYm9KNXHmwBmQne8eFCC0q'),
(31, 1, '4PcJYm9KNXHmwBmQne8eFCC0q'),
(32, 1, '4PcJYm9KNXHmwBmQne8eFCC0q'),
(33, 1, '4PcJYm9KNXHmwBmQne8eFCC0q'),
(34, 1, '4PcJYm9KNXHmwBmQne8eFCC0q'),
(35, 1, '4PcJYm9KNXHmwBmQne8eFCC0q'),
(36, 1, '4PcJYm9KNXHmwBmQne8eFCC0q'),
(7, 1, 'vjQd5qnd5XAHiN3BkVnRPbJV8'),
(8, 1, 'vjQd5qnd5XAHiN3BkVnRPbJV8'),
(9, 1, 'vjQd5qnd5XAHiN3BkVnRPbJV8'),
(10, 1, 'vjQd5qnd5XAHiN3BkVnRPbJV8'),
(11, 1, 'vjQd5qnd5XAHiN3BkVnRPbJV8'),
(12, 1, 'vjQd5qnd5XAHiN3BkVnRPbJV8'),
(13, 3, 'vjQd5qnd5XAHiN3BkVnRPbJV8'),
(14, 3, 'vjQd5qnd5XAHiN3BkVnRPbJV8'),
(15, 1, 'vjQd5qnd5XAHiN3BkVnRPbJV8'),
(16, 1, 'vjQd5qnd5XAHiN3BkVnRPbJV8'),
(29, 1, 'vjQd5qnd5XAHiN3BkVnRPbJV8'),
(30, 1, 'vjQd5qnd5XAHiN3BkVnRPbJV8'),
(31, 1, 'vjQd5qnd5XAHiN3BkVnRPbJV8'),
(32, 1, 'vjQd5qnd5XAHiN3BkVnRPbJV8'),
(33, 1, 'vjQd5qnd5XAHiN3BkVnRPbJV8'),
(34, 1, 'vjQd5qnd5XAHiN3BkVnRPbJV8'),
(35, 1, 'vjQd5qnd5XAHiN3BkVnRPbJV8'),
(36, 1, 'vjQd5qnd5XAHiN3BkVnRPbJV8'),
(7, 1, 'r9RvtTewkrNt4xj5BGKNclJjx'),
(8, 1, 'r9RvtTewkrNt4xj5BGKNclJjx'),
(9, 1, 'r9RvtTewkrNt4xj5BGKNclJjx'),
(10, 1, 'r9RvtTewkrNt4xj5BGKNclJjx'),
(11, 1, 'r9RvtTewkrNt4xj5BGKNclJjx'),
(12, 1, 'r9RvtTewkrNt4xj5BGKNclJjx'),
(13, 1, 'r9RvtTewkrNt4xj5BGKNclJjx'),
(14, 1, 'r9RvtTewkrNt4xj5BGKNclJjx'),
(15, 1, 'r9RvtTewkrNt4xj5BGKNclJjx'),
(16, 1, 'r9RvtTewkrNt4xj5BGKNclJjx'),
(29, 1, 'r9RvtTewkrNt4xj5BGKNclJjx'),
(30, 1, 'r9RvtTewkrNt4xj5BGKNclJjx'),
(31, 1, 'r9RvtTewkrNt4xj5BGKNclJjx'),
(32, 1, 'r9RvtTewkrNt4xj5BGKNclJjx'),
(33, 1, 'r9RvtTewkrNt4xj5BGKNclJjx'),
(34, 1, 'r9RvtTewkrNt4xj5BGKNclJjx'),
(35, 1, 'r9RvtTewkrNt4xj5BGKNclJjx'),
(36, 1, 'r9RvtTewkrNt4xj5BGKNclJjx');

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
(14, '123', 'gNE', 'GESG', 'SEGSE', 2, 'G@gg.com', '$2y$10$ycNKFIiZRCq7Y43CI003SOLjQuNnVc6C.CHEMo9RAG5I0UY0I85q2', 'student', 'e60RMe0aHITKknM53JUVgqTWikU6M8lOIJKDBSeS4mlH2zBhWAzyzRDVpsGn'),
(15, '1234', 'gen', 'ehg', 'segseg', 2, 'g@g.com', '$2y$10$ejUf3WVpIAxwggHtBVA1hOyS.kpEM1OfzGjPSCJioXZwUJ25s6dXq', 'student', '3Tip2GfA2bcnlirqVB3z0jPMxCxkwslsaAoS4PDa0VjDrM9OBuKHkcZ1olw7'),
(16, '12345', 'gfeswg', 'gsegse', 'gseges', 2, 'g@gh.c0kk', '$2y$10$mGQ9ojf.wCD6GV3zNk3t0epMaWQMnL.UwRKE0IvWogHg7oVJi.UPa', 'student', 'lbHrZiSqWEElaNbsFUsCTsLCHxJeyl0mEslHsblfL9Y5RKTPIeyCW6YLEJ44'),
(17, 'a', 'Gen', 'Retardo', 'Roxas', 1, 'g@g.com', '$2y$10$0p4CNpff/YjbgvPWHoceyOiADHP3swPDvFujSbZuev1lgijA6mKfu', 'student', 'Zy4NxuXvWZBoqL4Rl4pgbvNEKqf8njv2MYkPv3nsXTiEIz2z5bJWFolkmBJO');

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
(4, 'WEBA-313', 'wEB');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `criterias`
--
ALTER TABLE `criterias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `facultys`
--
ALTER TABLE `facultys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `handlings`
--
ALTER TABLE `handlings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
