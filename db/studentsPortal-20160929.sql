-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: studentsPortal
-- ------------------------------------------------------
-- Server version	5.5.49-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `assignment_attachments`
--

DROP TABLE IF EXISTS `assignment_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assignment_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assignment_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `original_file_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignment_attachments`
--

LOCK TABLES `assignment_attachments` WRITE;
/*!40000 ALTER TABLE `assignment_attachments` DISABLE KEYS */;
INSERT INTO `assignment_attachments` VALUES (1,2,'2-1474381937-appraisalformtemplate.doc',''),(2,3,'3-1474381948-Bug Fix List- Round 3.doc','Bug Fix List- Round 3.doc'),(3,4,'4-1474381969-appraisalformtemplate.doc','appraisalformtemplate.doc'),(4,4,'1-1474382113-Concept Draft.docx','Concept Draft.docx'),(5,1,'1-1474385358-',''),(6,1,'1-1474385407-',''),(11,4,'4-1474386491-Concept Draft.docx','Concept Draft.docx'),(12,4,'4-1474386540-Concept Draft.docx','Concept Draft.docx'),(13,4,'4-1474386573-Concept Draft.docx','Concept Draft.docx'),(14,4,'4-1474386720-Concept Draft.docx','Concept Draft.docx');
/*!40000 ALTER TABLE `assignment_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assignment_submissions`
--

DROP TABLE IF EXISTS `assignment_submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assignment_submissions` (
  `id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date_submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignment_submissions`
--

LOCK TABLES `assignment_submissions` WRITE;
/*!40000 ALTER TABLE `assignment_submissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `assignment_submissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assignments`
--

DROP TABLE IF EXISTS `assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assignments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `batch_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `due_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = drafted\n1 = published\n2 = closed\n',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '0 = not published\n1 = published\n2 =  due date is over\n3 = deleted',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignments`
--

LOCK TABLES `assignments` WRITE;
/*!40000 ALTER TABLE `assignments` DISABLE KEYS */;
INSERT INTO `assignments` VALUES (1,1,3,0,'2016-09-21 18:30:00','sdsds',0,'2016-09-19 17:34:47','2016-09-19 17:34:47'),(2,1,3,2,'2016-09-20 18:30:00','wwwwwwwww\nwewelwekw\nwewewew',0,'2016-09-20 14:32:17','2016-09-20 14:32:17'),(3,1,3,2,'2016-09-20 18:30:00','wwwwwwwww\nwewelwekw\nwewewew',0,'0000-00-00 00:00:00','2016-09-20 14:32:28'),(4,1,3,2,'2016-09-20 18:30:00','wwwwwwwww\nwewelwekw\nwewewew',1,'0000-00-00 00:00:00','2016-09-21 05:27:25');
/*!40000 ALTER TABLE `assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `batches`
--

DROP TABLE IF EXISTS `batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `batches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `year` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `batches`
--

LOCK TABLES `batches` WRITE;
/*!40000 ALTER TABLE `batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_semesters`
--

DROP TABLE IF EXISTS `course_semesters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_semesters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `semester_number` int(4) NOT NULL,
  `semester_year` int(4) NOT NULL,
  `start_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_semesters`
--

LOCK TABLES `course_semesters` WRITE;
/*!40000 ALTER TABLE `course_semesters` DISABLE KEYS */;
INSERT INTO `course_semesters` VALUES (1,1,1,2,'2016-07-07'),(2,1,2,1,'2016-12-02');
/*!40000 ALTER TABLE `course_semesters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_subjects`
--

DROP TABLE IF EXISTS `course_subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL DEFAULT '0',
  `course_id` int(11) NOT NULL DEFAULT '0',
  `course_semester_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_subjects`
--

LOCK TABLES `course_subjects` WRITE;
/*!40000 ALTER TABLE `course_subjects` DISABLE KEYS */;
INSERT INTO `course_subjects` VALUES (1,3,1,1),(2,4,1,1),(3,2,1,1),(4,3,1,2),(5,4,1,2),(6,5,1,2),(7,1,1,2);
/*!40000 ALTER TABLE `course_subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(45) NOT NULL,
  `start_date` date NOT NULL,
  `duration` int(4) NOT NULL,
  `current_semester_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = active\n2 = deleted',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'sdsd','xx','2016-08-12',0,1,1,'2016-08-17 10:10:44','0000-00-00 00:00:00'),(2,'sdsd','xx','2016-08-12',0,2,1,'2016-09-17 06:20:14','0000-00-00 00:00:00'),(3,'eeeee','xx','0000-00-00',0,0,1,'2016-09-29 12:25:39','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_result_details`
--

DROP TABLE IF EXISTS `exam_result_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam_result_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_result_id` varchar(45) NOT NULL,
  `subject_id` varchar(45) NOT NULL,
  `grade` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_result_details`
--

LOCK TABLES `exam_result_details` WRITE;
/*!40000 ALTER TABLE `exam_result_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam_result_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_results`
--

DROP TABLE IF EXISTS `exam_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `batch_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_results`
--

LOCK TABLES `exam_results` WRITE;
/*!40000 ALTER TABLE `exam_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (1,'IT LAB 1'),(2,'IT LAB 2'),(3,'IT LAB 3'),(4,'ELECTRICAL LAB 1'),(5,'LECTURE HALL 1'),(6,'LECTURE HALL 2');
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `staff_designation_id` int(11) DEFAULT NULL,
  `admin_approval_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = sent invite\n1 = user loggedin and updated profile\n2 = admin approved.\n3 = admin rejected\n',
  PRIMARY KEY (`id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (1,2,1,0);
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff_designations`
--

DROP TABLE IF EXISTS `staff_designations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff_designations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(45) NOT NULL,
  `slug` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_designations`
--

LOCK TABLES `staff_designations` WRITE;
/*!40000 ALTER TABLE `staff_designations` DISABLE KEYS */;
INSERT INTO `staff_designations` VALUES (1,'Assistant Lecturer','assit.lecturer'),(2,'Lecturer','lecturer'),(3,'Senior Lecturer','sr.lecturer'),(4,'Demonstrator','demonstrator');
/*!40000 ALTER TABLE `staff_designations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff_timetables`
--

DROP TABLE IF EXISTS `staff_timetables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff_timetables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lecturer_id` varchar(45) DEFAULT NULL COMMENT 'id of staff table',
  `demo_id` varchar(45) DEFAULT NULL COMMENT 'id of staff table',
  `batch_id` varchar(45) NOT NULL,
  `subject_id` varchar(45) NOT NULL,
  `location_id` int(11) NOT NULL,
  `lesson_type` enum('theory','practicals') DEFAULT NULL,
  `date` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_timetables`
--

LOCK TABLES `staff_timetables` WRITE;
/*!40000 ALTER TABLE `staff_timetables` DISABLE KEYS */;
/*!40000 ALTER TABLE `staff_timetables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `reg_no` varchar(45) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,5,'1234',2);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(45) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` VALUES (1,'xxxRRR','RRR',0),(2,'sds','sdsd',0),(3,'ffff','f',0),(4,'xx','sdsdsss',0),(5,'sdsdss','tmr',0);
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timetables`
--

DROP TABLE IF EXISTS `timetables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `timetables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `parent_event_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `lecturer_id` int(11) DEFAULT NULL COMMENT 'id of staff table',
  `demo_id` int(11) DEFAULT NULL COMMENT 'id of staff table (demonstrator id)',
  `location_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timetables`
--

LOCK TABLES `timetables` WRITE;
/*!40000 ALTER TABLE `timetables` DISABLE KEYS */;
INSERT INTO `timetables` VALUES (1,1,3,0,'2016-09-20','12:57:00','14:57:00',2,NULL,4),(2,1,3,0,'2016-09-20','12:57:00','14:57:00',2,NULL,4),(3,1,3,2,'2016-09-27','12:57:00','14:57:00',2,NULL,4),(4,1,3,2,'2016-10-04','12:57:00','14:57:00',2,NULL,4),(5,1,3,2,'2016-10-11','12:57:00','14:57:00',2,NULL,4),(6,1,4,0,'2016-09-21','09:32:00','11:32:00',2,NULL,1),(7,1,4,6,'2016-09-22','09:32:00','11:32:00',2,NULL,1),(8,1,4,6,'2016-09-23','09:32:00','11:32:00',2,NULL,1),(9,1,4,6,'2016-09-26','09:32:00','11:32:00',2,NULL,1),(10,1,4,6,'2016-09-27','09:32:00','11:32:00',2,NULL,1),(11,1,4,6,'2016-09-28','09:32:00','11:32:00',2,NULL,1),(12,1,4,6,'2016-09-29','09:32:00','11:32:00',2,NULL,1),(13,1,4,6,'2016-09-30','09:32:00','11:32:00',2,NULL,1),(14,1,4,6,'2016-10-03','09:32:00','11:32:00',2,NULL,1),(15,1,4,6,'2016-10-04','09:32:00','11:32:00',2,NULL,1),(16,1,4,6,'2016-10-05','09:32:00','11:32:00',2,NULL,1),(17,1,4,6,'2016-10-06','09:32:00','11:32:00',2,NULL,1),(18,1,4,6,'2016-10-07','09:32:00','11:32:00',2,NULL,1),(19,1,4,6,'2016-10-10','09:32:00','11:32:00',2,NULL,1),(20,1,4,6,'2016-10-11','09:32:00','11:32:00',2,NULL,1),(21,1,4,6,'2016-10-12','09:32:00','11:32:00',2,NULL,1),(22,1,4,6,'2016-10-13','09:32:00','11:32:00',2,NULL,1),(23,1,4,6,'2016-10-14','09:32:00','11:32:00',2,NULL,1),(24,1,4,6,'2016-10-17','09:32:00','11:32:00',2,NULL,1),(25,1,4,6,'2016-10-18','09:32:00','11:32:00',2,NULL,1),(26,1,4,6,'2016-10-19','09:32:00','11:32:00',2,NULL,1),(27,1,4,6,'2016-10-20','09:32:00','11:32:00',2,NULL,1),(28,1,4,6,'2016-10-21','09:32:00','11:32:00',2,NULL,1),(29,1,4,6,'2016-10-24','09:32:00','11:32:00',2,NULL,1),(30,1,4,6,'2016-10-25','09:32:00','11:32:00',2,NULL,1),(31,1,4,6,'2016-10-26','09:32:00','11:32:00',2,NULL,1),(32,1,4,6,'2016-10-27','09:32:00','11:32:00',2,NULL,1);
/*!40000 ALTER TABLE `timetables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_types`
--

LOCK TABLES `user_types` WRITE;
/*!40000 ALTER TABLE `user_types` DISABLE KEYS */;
INSERT INTO `user_types` VALUES (1,'admin'),(2,'staff'),(3,'student');
/*!40000 ALTER TABLE `user_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'admin','0192023a7bbd73250516f069df18b500','Amin','admin@hnde.com','',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(2,2,'sampathperera@hotmail.com','0192023a7bbd73250516f069df18b500','saaaa','sampathperera@hotmail.com','233232',NULL,'0000-00-00 00:00:00','2016-09-18 07:53:27',1),(3,3,'ranasinghe.thushan@gmail.com','0192023a7bbd73250516f069df18b500','Thushan','Ranasinghe','176726726','','0000-00-00 00:00:00','0000-00-00 00:00:00',1),(4,3,'twwwd@cc.com','','Tmrsds','twwwd@cc.com','223232',NULL,'2016-09-23 18:18:19','2016-09-23 18:18:19',4),(5,3,'twwwdesss@cc.com','81dc9bdb52d04dc20036dbd8313ed055','Tmrsds ratsdc','twwwdesss@cc.com','223232332',NULL,'2016-09-23 18:21:19','2016-09-23 18:21:23',4);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-29 18:27:33
