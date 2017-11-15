-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2017 at 04:07 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentsportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `semester` int(11) DEFAULT NULL,
  `subject_id` int(11) NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `due_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = drafted\n1 = published\n2 = closed\n',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `batch_id`, `semester`, `subject_id`, `lecturer_id`, `due_date`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 3, 0, '2016-09-21 18:30:00', NULL, 'sdsds', 0, '2016-09-19 17:34:47', '2016-09-19 17:34:47'),
(2, 1, 2, 3, 2, '2016-09-20 18:30:00', NULL, 'wwwwwwwww\nwewelwekw\nwewewew', 0, '2016-09-20 14:32:17', '2016-09-20 14:32:17'),
(3, 1, NULL, 3, 2, '2016-09-20 18:30:00', NULL, 'wwwwwwwww\nwewelwekw\nwewewew', 0, '0000-00-00 00:00:00', '2016-09-20 14:32:28'),
(4, 1, NULL, 3, 2, '2016-09-20 18:30:00', 'Assignment 4', 'wwwwwwwww\nwewelwekw\nwewewew', 1, '0000-00-00 00:00:00', '2016-09-21 05:27:25'),
(5, 14, NULL, 14, 21, '2017-11-30 08:00:00', NULL, 'eeee', 0, '2017-11-12 17:07:43', '2017-11-12 17:07:43'),
(6, 14, NULL, 14, 21, '2017-11-30 08:00:00', NULL, 'eeee', 0, '2017-11-12 17:07:43', '2017-11-12 17:07:43'),
(7, 14, NULL, 15, 21, '2017-11-30 08:00:00', NULL, 'dfdfdfdf', 1, '2017-11-12 17:09:09', '2017-11-12 17:09:28'),
(8, 14, NULL, 15, 21, '2017-11-17 08:00:00', NULL, 'It works fine. But it is disabling date till today.\r\n\r\nAs example if today is 04-20-2013 and i disable past dates by setting startDate: new Date(). but I am able to select date from 04-21-2013.\r\n\r\nUPDATED: i can solve it as following for UTC zone:', 1, '2017-11-14 12:48:59', '2017-11-14 12:55:25'),
(9, 14, NULL, 15, 21, '2017-11-30 08:00:00', 'Assignment 2', 'assasasasasaas\r\n\r\nsssssssss ssdsdsdsddss', 0, '2017-11-15 03:12:23', '2017-11-15 03:16:08');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_attachments`
--

CREATE TABLE `assignment_attachments` (
  `id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `original_file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assignment_attachments`
--

INSERT INTO `assignment_attachments` (`id`, `assignment_id`, `file_name`, `original_file_name`) VALUES
(1, 2, '2-1474381937-appraisalformtemplate.doc', ''),
(2, 3, '3-1474381948-Bug Fix List- Round 3.doc', 'Bug Fix List- Round 3.doc'),
(3, 4, '4-1474381969-appraisalformtemplate.doc', 'appraisalformtemplate.doc'),
(4, 4, '1-1474382113-Concept Draft.docx', 'Concept Draft.docx'),
(5, 1, '1-1474385358-', ''),
(6, 1, '1-1474385407-', ''),
(11, 4, '4-1474386491-Concept Draft.docx', 'Concept Draft.docx'),
(12, 4, '4-1474386540-Concept Draft.docx', 'Concept Draft.docx'),
(13, 4, '4-1474386573-Concept Draft.docx', 'Concept Draft.docx'),
(14, 4, '4-1474386720-Concept Draft.docx', 'Concept Draft.docx'),
(15, 5, '5-1510474063-Progress Report Template V2.docx', 'Progress Report Template V2.docx'),
(16, 6, '6-1510474063-Progress Report Template V2.docx', 'Progress Report Template V2.docx'),
(17, 7, '7-1510474149-Progress Report Template V2.docx', 'Progress Report Template V2.docx'),
(18, 7, '7-1510474168-image-0-02-06-ad3d6a3601938bf76da93053fd62335131b39cdcd008e18c958903b3639880ed-V.jpg', 'image-0-02-06-ad3d6a3601938bf76da93053fd62335131b39cdcd008e18c958903b3639880ed-V.jpg'),
(19, 8, '8-1510631339-0801021.docx', '0801021.docx'),
(20, 9, '9-1510683143-mithuni2013.docx', 'mithuni2013.docx');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_submissions`
--

CREATE TABLE `assignment_submissions` (
  `id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_user_id` int(11) NOT NULL,
  `original_file_name` varchar(250) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  `date_submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assignment_submissions`
--

INSERT INTO `assignment_submissions` (`id`, `assignment_id`, `student_id`, `student_user_id`, `original_file_name`, `file_name`, `date_submitted`) VALUES
(1, 7, 28, 28, '20170121_190927.jpg', '7-28-1510484643-20170121_190927.jpg', '2017-11-14 03:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `year` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `course_category_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `duration` int(4) NOT NULL,
  `current_semester_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = active\n2 = deleted',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `course_category_id`, `start_date`, `duration`, `current_semester_id`, `status`, `created_at`, `updated_at`) VALUES
(10, 'Civil-2017', 0, '2017-09-21', 36, 0, 3, '2017-09-19 19:18:02', '0000-00-00 00:00:00'),
(11, 'BSE-2017', 0, '2017-09-21', 12, 7, 3, '2017-11-11 13:35:48', '0000-00-00 00:00:00'),
(12, 'Mechanical-2017', 2, '2017-09-21', 12, 0, 2, '2017-09-19 19:18:20', '0000-00-00 00:00:00'),
(13, 'Civil-2017', 1, '2017-10-19', 14, 0, 2, '2017-10-07 04:50:17', '0000-00-00 00:00:00'),
(14, 'BSE-2017', 0, '2017-11-13', 42, 15, 1, '2017-11-11 19:24:20', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `course_category`
--

CREATE TABLE `course_category` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_category`
--

INSERT INTO `course_category` (`id`, `name`) VALUES
(1, 'Civil'),
(2, 'Mechanical'),
(3, 'Electrical'),
(4, 'QS'),
(5, 'BSE');

-- --------------------------------------------------------

--
-- Table structure for table `course_semesters`
--

CREATE TABLE `course_semesters` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `semester_number` int(4) NOT NULL,
  `semester_year` int(4) NOT NULL,
  `start_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_semesters`
--

INSERT INTO `course_semesters` (`id`, `course_id`, `semester_number`, `semester_year`, `start_date`) VALUES
(1, 1, 1, 2, '2016-07-07'),
(2, 1, 2, 1, '2016-12-02'),
(3, 7, 1, 1, '2017-12-29'),
(4, 2, 1, 1, '2017-09-14'),
(6, 10, 1, 1, '2017-09-19'),
(7, 11, 1, 1, '2017-09-22'),
(8, 12, 1, 1, '2017-09-22'),
(9, 13, 1, 1, '2017-10-06'),
(13, 14, 1, 1, '2017-11-17'),
(15, 14, 2, 1, '2017-11-17');

-- --------------------------------------------------------

--
-- Table structure for table `course_subjects`
--

CREATE TABLE `course_subjects` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL DEFAULT '0',
  `course_id` int(11) NOT NULL DEFAULT '0',
  `course_semester_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_subjects`
--

INSERT INTO `course_subjects` (`id`, `subject_id`, `course_id`, `course_semester_id`) VALUES
(1, 3, 1, 1),
(2, 4, 1, 1),
(3, 2, 1, 1),
(4, 3, 1, 2),
(5, 4, 1, 2),
(6, 5, 1, 2),
(7, 1, 1, 2),
(9, 14, 10, 6),
(10, 13, 10, 6),
(11, 14, 11, 5),
(12, 13, 11, 7),
(13, 13, 12, 8),
(14, 14, 12, 8),
(15, 14, 11, 7),
(16, 13, 13, 9),
(17, 14, 13, 9),
(18, 14, 14, 13),
(22, 15, 14, 15),
(23, 14, 14, 15);

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exam_result_details`
--

CREATE TABLE `exam_result_details` (
  `id` int(11) NOT NULL,
  `exam_result_id` varchar(45) NOT NULL,
  `subject_id` varchar(45) NOT NULL,
  `grade` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`) VALUES
(1, 'IT LAB 1'),
(2, 'IT LAB 2'),
(3, 'IT LAB 3'),
(4, 'ELECTRICAL LAB 1'),
(5, 'LECTURE HALL 1'),
(6, 'LECTURE HALL 2');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `staff_designation_id` int(11) DEFAULT NULL,
  `admin_approval_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = sent invite\n1 = user loggedin and updated profile\n2 = admin approved.\n3 = admin rejected\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `user_id`, `staff_designation_id`, `admin_approval_status`) VALUES
(3, 20, 3, 0),
(4, 21, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff_designations`
--

CREATE TABLE `staff_designations` (
  `id` int(11) NOT NULL,
  `designation` varchar(45) NOT NULL,
  `slug` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff_designations`
--

INSERT INTO `staff_designations` (`id`, `designation`, `slug`) VALUES
(1, 'Assistant Lecturer', 'assit.lecturer'),
(2, 'Lecturer', 'lecturer'),
(3, 'Senior Lecturer', 'sr.lecturer'),
(4, 'Demonstrator', 'demonstrator');

-- --------------------------------------------------------

--
-- Table structure for table `staff_subjects`
--

CREATE TABLE `staff_subjects` (
  `staff_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff_subjects`
--

INSERT INTO `staff_subjects` (`staff_id`, `subject_id`) VALUES
(3, 13),
(3, 14),
(4, 13),
(4, 14),
(4, 15);

-- --------------------------------------------------------

--
-- Table structure for table `staff_timetables`
--

CREATE TABLE `staff_timetables` (
  `id` int(11) NOT NULL,
  `lecturer_id` varchar(45) DEFAULT NULL COMMENT 'id of staff table',
  `demo_id` varchar(45) DEFAULT NULL COMMENT 'id of staff table',
  `batch_id` varchar(45) NOT NULL,
  `subject_id` varchar(45) NOT NULL,
  `location_id` int(11) NOT NULL,
  `lesson_type` enum('theory','practicals') DEFAULT NULL,
  `date` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reg_no` varchar(45) NOT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `reg_no`, `course_id`) VALUES
(14, 19, 'CE001', 1),
(15, 22, '12121', 1),
(21, 28, 'reg-1232434555', 14);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(45) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `code`, `is_deleted`) VALUES
(13, '10011', 'IT1', 0),
(14, 'EN001', 'English', 0),
(15, 'Java', 'X1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subject_categories`
--

CREATE TABLE `subject_categories` (
  `subject_id` int(11) NOT NULL,
  `course_category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject_categories`
--

INSERT INTO `subject_categories` (`subject_id`, `course_category_id`) VALUES
(12, 5),
(12, 1),
(14, 3),
(14, 2),
(14, 4),
(13, 3),
(15, 5),
(15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

CREATE TABLE `timetables` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `parent_event_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `lecturer_id` int(11) DEFAULT NULL COMMENT 'id of staff table',
  `demo_id` int(11) DEFAULT NULL COMMENT 'id of staff table (demonstrator id)',
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timetables`
--

INSERT INTO `timetables` (`id`, `course_id`, `subject_id`, `parent_event_id`, `date`, `time_from`, `time_to`, `lecturer_id`, `demo_id`, `location_id`) VALUES
(1, 1, 3, 0, '2016-09-20', '12:57:00', '14:57:00', 2, NULL, 4),
(2, 1, 3, 0, '2016-09-20', '12:57:00', '14:57:00', 2, NULL, 4),
(3, 1, 3, 2, '2016-09-27', '12:57:00', '14:57:00', 2, NULL, 4),
(4, 1, 3, 2, '2016-10-04', '12:57:00', '14:57:00', 2, NULL, 4),
(5, 1, 3, 2, '2016-10-11', '12:57:00', '14:57:00', 2, NULL, 4),
(6, 1, 4, 0, '2016-09-21', '09:32:00', '11:32:00', 2, NULL, 1),
(7, 1, 4, 6, '2016-09-22', '09:32:00', '11:32:00', 2, NULL, 1),
(8, 1, 4, 6, '2016-09-23', '09:32:00', '11:32:00', 2, NULL, 1),
(9, 1, 4, 6, '2016-09-26', '09:32:00', '11:32:00', 2, NULL, 1),
(10, 1, 4, 6, '2016-09-27', '09:32:00', '11:32:00', 2, NULL, 1),
(11, 1, 4, 6, '2016-09-28', '09:32:00', '11:32:00', 2, NULL, 1),
(12, 1, 4, 6, '2016-09-29', '09:32:00', '11:32:00', 2, NULL, 1),
(13, 1, 4, 6, '2016-09-30', '09:32:00', '11:32:00', 2, NULL, 1),
(14, 1, 4, 6, '2016-10-03', '09:32:00', '11:32:00', 2, NULL, 1),
(15, 1, 4, 6, '2016-10-04', '09:32:00', '11:32:00', 2, NULL, 1),
(16, 1, 4, 6, '2016-10-05', '09:32:00', '11:32:00', 2, NULL, 1),
(17, 1, 4, 6, '2016-10-06', '09:32:00', '11:32:00', 2, NULL, 1),
(18, 1, 4, 6, '2016-10-07', '09:32:00', '11:32:00', 2, NULL, 1),
(19, 1, 4, 6, '2016-10-10', '09:32:00', '11:32:00', 2, NULL, 1),
(20, 1, 4, 6, '2016-10-11', '09:32:00', '11:32:00', 2, NULL, 1),
(21, 1, 4, 6, '2016-10-12', '09:32:00', '11:32:00', 2, NULL, 1),
(22, 1, 4, 6, '2016-10-13', '09:32:00', '11:32:00', 2, NULL, 1),
(23, 1, 4, 6, '2016-10-14', '09:32:00', '11:32:00', 2, NULL, 1),
(24, 1, 4, 6, '2016-10-17', '09:32:00', '11:32:00', 2, NULL, 1),
(25, 1, 4, 6, '2016-10-18', '09:32:00', '11:32:00', 2, NULL, 1),
(26, 1, 4, 6, '2016-10-19', '09:32:00', '11:32:00', 2, NULL, 1),
(27, 1, 4, 6, '2016-10-20', '09:32:00', '11:32:00', 2, NULL, 1),
(28, 1, 4, 6, '2016-10-21', '09:32:00', '11:32:00', 2, NULL, 1),
(29, 1, 4, 6, '2016-10-24', '09:32:00', '11:32:00', 2, NULL, 1),
(30, 1, 4, 6, '2016-10-25', '09:32:00', '11:32:00', 2, NULL, 1),
(31, 1, 4, 6, '2016-10-26', '09:32:00', '11:32:00', 2, NULL, 1),
(32, 1, 4, 6, '2016-10-27', '09:32:00', '11:32:00', 2, NULL, 1),
(33, 1, 3, 0, '2017-08-24', '12:08:00', '12:08:00', 2, NULL, 1),
(34, 11, 13, 0, '2017-09-28', '23:09:00', '23:09:00', 21, NULL, 1),
(35, 11, 13, 0, '2017-10-10', '08:30:00', '08:30:00', 21, NULL, 1),
(36, 11, 13, 0, '2017-10-02', '08:30:00', '08:30:00', 21, NULL, 1),
(37, 11, 13, 0, '2017-10-03', '08:30:00', '08:30:00', 20, NULL, 1),
(38, 11, 13, 0, '2017-10-04', '08:30:00', '08:30:00', 20, NULL, 1),
(39, 11, 13, 0, '2017-10-05', '08:30:00', '08:30:00', 21, NULL, 2),
(40, 11, 13, 0, '2017-10-06', '08:30:00', '09:00:00', 21, NULL, 2),
(41, 14, 15, 0, '2017-11-13', '08:30:00', '10:15:00', 21, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type_id` tinyint(2) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile_no` varchar(45) NOT NULL,
  `profile_image` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '\n1 = active\n2 = disable\n3 = delete\n4 = pending approval',
  `is_email_verified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type_id`, `username`, `password`, `full_name`, `email`, `mobile_no`, `profile_image`, `created_at`, `updated_at`, `status`, `is_email_verified`) VALUES
(1, 1, 'admin', '0192023a7bbd73250516f069df18b500', 'Amin', 'admin@hnde.com', '', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
(19, 3, 'CE001', '501df69458b6d7d2ad8cc8e13e84bc56', 'GCV', 'gcv@yahoo.com', '33', NULL, '2017-09-20 04:34:23', '2017-09-19 19:35:13', 1, 0),
(20, 2, '0', 'd0d1b3721f62133f8e8b6eb710e58ad1', 'PGL Shantha', 'pgl@gmail.com', '212', NULL, '0000-00-00 00:00:00', '2017-09-19 19:39:13', 1, 0),
(21, 2, 'ishara@gmail.com', '05a823c101178dd5ad81d43147007355', 'Ishara', 'ishara@gmail.com', '434', NULL, '0000-00-00 00:00:00', '2017-10-08 10:18:15', 1, 0),
(22, 3, '12121', '81dc9bdb52d04dc20036dbd8313ed055', 'sdsdsd', 'gkr1@gmail.com', '23444433', NULL, '2017-10-03 10:33:14', '2017-11-11 13:05:15', 1, 0),
(28, 3, 'reg-1232434555', 'cc03e747a6afbbcbf8be7668acfebee5', 'Kulanga Ruwani', 'gkruwani@gmail.com', '111111', NULL, '2017-11-05 21:34:34', '2017-11-11 12:32:51', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_email_verifications`
--

CREATE TABLE `user_email_verifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = pending 1 = verified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_email_verifications`
--

INSERT INTO `user_email_verifications` (`id`, `user_id`, `timestamp`, `status`) VALUES
(1, 27, 1509885061, 0),
(3, 28, 1510401510, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL,
  `user_type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `user_type`) VALUES
(1, 'admin'),
(2, 'staff'),
(3, 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment_attachments`
--
ALTER TABLE `assignment_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_category`
--
ALTER TABLE `course_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_semesters`
--
ALTER TABLE `course_semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_subjects`
--
ALTER TABLE `course_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_result_details`
--
ALTER TABLE `exam_result_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`,`user_id`);

--
-- Indexes for table `staff_designations`
--
ALTER TABLE `staff_designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_subjects`
--
ALTER TABLE `staff_subjects`
  ADD UNIQUE KEY `staff_id` (`staff_id`,`subject_id`);

--
-- Indexes for table `staff_timetables`
--
ALTER TABLE `staff_timetables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reg_no` (`reg_no`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetables`
--
ALTER TABLE `timetables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_email_verifications`
--
ALTER TABLE `user_email_verifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `assignment_attachments`
--
ALTER TABLE `assignment_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `course_category`
--
ALTER TABLE `course_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `course_semesters`
--
ALTER TABLE `course_semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `course_subjects`
--
ALTER TABLE `course_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exam_result_details`
--
ALTER TABLE `exam_result_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `staff_designations`
--
ALTER TABLE `staff_designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `staff_timetables`
--
ALTER TABLE `staff_timetables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `timetables`
--
ALTER TABLE `timetables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `user_email_verifications`
--
ALTER TABLE `user_email_verifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
