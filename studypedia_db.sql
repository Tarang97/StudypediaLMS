-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 07, 2018 at 04:47 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id5768234_studypedia_app_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cem_category`
--

CREATE TABLE `cem_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cem_category`
--

INSERT INTO `cem_category` (`category_id`, `category_name`) VALUES
(1, 'GRE'),
(4, 'UPSC'),
(6, 'GPSC'),
(12, 'IELTS');

-- --------------------------------------------------------

--
-- Table structure for table `competitive_exam`
--

CREATE TABLE `competitive_exam` (
  `cem_id` int(11) NOT NULL,
  `cem_name` varchar(100) NOT NULL,
  `cem_authors` varchar(100) NOT NULL,
  `cem_exams` varchar(50) NOT NULL,
  `cem_topics` varchar(100) NOT NULL,
  `cem_description` varchar(250) NOT NULL,
  `cem_uploaded_by_userid` int(11) NOT NULL,
  `cem_uploaded_by` varchar(100) NOT NULL,
  `cem_uploaded_on` date NOT NULL,
  `cem_file_path` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `competitive_exam`
--

INSERT INTO `competitive_exam` (`cem_id`, `cem_name`, `cem_authors`, `cem_exams`, `cem_topics`, `cem_description`, `cem_uploaded_by_userid`, `cem_uploaded_by`, `cem_uploaded_on`, `cem_file_path`) VALUES
(40, 'UPSC Prelim Paper - 1', 'Unknown', 'UPSC', 'Practice Paper', 'Practice Question for UPSC', 20, 'Dhaval Padaya', '2018-05-16', 'competitive_exam/Prelim-2014-Paper-1.pdf'),
(39, 'General Studies- GPSC', 'Unknown', 'GPSC', 'General Studies for GPSC', 'everything about GPSC General studies', 20, 'Dhaval Padaya', '2018-05-16', 'competitive_exam/General_Studies_1.pdf'),
(37, 'GRE Vocabulary', 'Quizlet', 'GRE', '1000+ Vocabs', 'Advanced GRE Words', 20, 'Dhaval Padaya', '2018-05-16', 'competitive_exam/GRE Vocabulary.pdf'),
(38, 'GPSC Syllabus Maths', 'Unknown', 'GPSC', 'Maths syllabus of GPSC', 'Complete syllabus of GPSC Maths', 20, 'Dhaval Padaya', '2018-05-16', 'competitive_exam/GPSC_1_2_syllabus_Mathematics.pdf'),
(35, 'GRE - Quantitative Reasoning', 'ETS', 'GRE', 'Practice test for GRE Quant', '1800+ Questions for practice with real time questions', 20, 'Dhaval Padaya', '2018-05-16', 'competitive_exam/Official GRE Quant Reasoning Practice Questions, Volume 1.pdf'),
(41, 'Makkar IELTS Speaking', 'Dr. KiranPreet Kaur Makkar', 'IELTS', 'IELTS Speaking Part 1, 2, 3', 'It contains latest cue card from May to August 2018 and all the time IELTS examiners ask from this.', 1, 'Admin ', '2018-05-17', '../Studypedia/competitive_exam/makkarIELTS_May-Aug Speaking_First Version_7_May_2018.pdf'),
(42, 'IELTS Writing Task 2', 'IELTS-Simon', 'IELTS', 'Sample writing task 2', 'It contains method to write the writing task-2 with sample answer and evaluation of them.', 1, 'Admin ', '2018-05-17', '../Studypedia/competitive_exam/Writing task 2 with sample answers.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `ebooks`
--

CREATE TABLE `ebooks` (
  `ebook_id` int(10) NOT NULL,
  `ebook_name` varchar(50) NOT NULL,
  `ebook_authors` varchar(100) NOT NULL,
  `uploaded_date` date NOT NULL,
  `field` varchar(20) NOT NULL,
  `topics` varchar(100) NOT NULL,
  `file_path` varchar(150) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ebooks`
--

INSERT INTO `ebooks` (`ebook_id`, `ebook_name`, `ebook_authors`, `uploaded_date`, `field`, `topics`, `file_path`, `description`) VALUES
(3, 'Dot Net Guide', 'Microsoft', '2018-05-16', 'engineering', 'Dot Net Guide for Beginners', '../Studypedia/ebooks/_Net Guide.pdf', 'Contains all basics of Dot Net.'),
(4, 'Android Programming Succintly', 'Google', '2018-05-16', 'engineering', 'Introduction to Android, SQLite', '../Studypedia/ebooks/Android_Programming_Succinctly.pdf', 'Basics of Android and Database.'),
(5, 'C# Succintly', 'Microsoft', '2018-05-16', 'engineering', 'Introduction to C#, C#.Net, WinForm, WPF', '../Studypedia/ebooks/C_Sharp_Succinctly.pdf', 'Basics of C# and use in ASP.Net'),
(6, 'Gray Hat Hacking', 'Unknown', '2018-05-16', 'engineering', 'Introduction to Ethical Hacking', '../Studypedia/ebooks/Gray Hat Hacking, 3rd Edition.pdf', 'Everything about ethical hacking and Cyber Security'),
(7, 'HOTEL MANAGEMENT AND OPERATIONS', 'Denney G. Rutherford, Ph.D., Michael J. Oâ€™Fallon, ', '2018-05-16', 'mba', 'The Hotel Development Process, The Art and Science', '../Studypedia/ebooks/HOTEL  MANAGEMENT AND OPERATIONS.pdf', 'Detail knowledge of Hotel management and process'),
(8, 'The Fast Forward MBA in Project Management', 'ERIC VERZUH', '2018-05-16', 'mba', 'PROJECT MANAGEMENT IN A CHANGING WORLD', '../Studypedia/ebooks/The Fast Forward MBA in Project Management.pdf', 'Quick Tips, Easy Solution, Cutting Edge Ideas');

-- --------------------------------------------------------

--
-- Table structure for table `ebook_category`
--

CREATE TABLE `ebook_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ebook_category`
--

INSERT INTO `ebook_category` (`category_id`, `category_name`) VALUES
(1, 'engineering'),
(2, 'mba');

-- --------------------------------------------------------

--
-- Table structure for table `guestlist`
--

CREATE TABLE `guestlist` (
  `id` int(3) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `email_read` smallint(3) NOT NULL DEFAULT '0',
  `signup_date` datetime NOT NULL,
  `status` smallint(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guestlist`
--

INSERT INTO `guestlist` (`id`, `name`, `email`, `email_read`, `signup_date`, `status`) VALUES
(4, 'Robert Downey Jr.', 'robert@gmail.com', 0, '2018-05-14 01:41:56', 1),
(6, 'Tarang Dube', 'tarangdube786@gmail.com', 0, '2018-05-16 08:18:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `sender_email` varchar(30) NOT NULL,
  `sender_name` varchar(20) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `time` datetime NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `sender_email`, `sender_name`, `subject`, `description`, `time`, `status`) VALUES
(2, 'vaibhavdube34@gmail.com', 'tony', 'Hello World!', '<p>Testing of Newsletter.</p>\r\n', '2018-05-12 15:36:27', 'active'),
(3, 'abc@gmail.com', 'Camila Cabello', 'Hey mama', '<p>Error testing in newsletter.</p>\r\n', '2018-05-12 15:57:01', 'active'),
(15, 'admin@studypedia.com', 'Administrator', 'Testing PHPMailer', 'You got this email buddy...Cheers!', '2018-05-14 12:16:46', 'active'),
(14, 'tarangdube786@gmail.com', 'Tony', 'Testing Newsletter', '<p>Newsletter Successful.</p>\r\n', '2018-05-13 14:03:20', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `uploaded_by_userid` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `subject` varchar(50) NOT NULL,
  `field` varchar(50) NOT NULL,
  `topics` varchar(50) NOT NULL,
  `file_path` varchar(150) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`note_id`, `title`, `uploaded_by_userid`, `user`, `date`, `subject`, `field`, `topics`, `file_path`, `description`) VALUES
(15, 'Predicate Logic AI', 1, 'Admin ', '2018-05-16', 'Artificial Intelligence', 'Computer Science', 'Predicate logic, Resolution Algorithm, Clause Form', 'notes/AI Ch-5 Using Predicate Logic.pdf', 'It contains everything about predicate logic in artificial intelligence.'),
(18, 'Rjindael Algorithm', 19, 'Shubham Detroja', '2018-05-16', 'Information and Network security', 'Computer Science', 'Rjindael Algorithm and Functions', 'notes/INS_VID.mp4', 'Basics encryption and Decryption of Algorithm'),
(19, 'Introduction to Cryptography', 19, 'Shubham Detroja', '2018-05-16', 'Information and Network security', 'Computer Science', 'Introduction and types of cryptography', 'notes/Ch1.pdf', 'Beginners guide to Cryptography'),
(20, 'Semantic Network', 18, 'Tarang Dubey', '2018-05-16', 'Distributed Database Management System', 'Computer Science', 'Semantic Distributed Database', 'notes/5-Semantic.pptx', 'Intro to Semantic DDBMS in form Network'),
(21, 'Data Distribution Alternatives', 18, 'Tarang Dubey', '2018-05-16', 'Distributed Database Management System', 'Computer Science', 'Design alternative, top down - Bottom up approach', 'notes/Chapter-4 & 5.PDF', 'Design alternative of DDBMS'),
(22, 'Code Generation', 18, 'Tarang Dubey', '2018-05-16', 'Compiler Design', 'Computer Science', 'Code Generation of Intermediate Code', 'notes/CD Ch-9 code generation.pdf', 'Code generation steps to generate optimize intermediate code');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL,
  `for_user_id` int(11) NOT NULL,
  `from_module` varchar(20) NOT NULL,
  `message` varchar(500) NOT NULL,
  `link` varchar(250) NOT NULL DEFAULT '#',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `read_notification` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `for_user_id`, `from_module`, `message`, `link`, `date_time`, `read_notification`) VALUES
(1, 11, 'Report', 'This notification is for testing', '#', '2018-02-16 08:52:51', 0),
(2, 11, 'Report', 'This notification is for testing', '#', '2018-02-16 08:53:19', 0),
(3, 11, 'Suggest Edit', 'This is for testing.', '#', '2018-02-16 09:03:11', 0),
(4, 11, 'Report', 'This is for testing.', 'report.php', '2018-02-17 23:38:47', 0),
(5, 11, 'Suggest Edit', 'This is for testing.', 'suggestedits.php', '2018-02-17 23:41:03', 0),
(6, 11, 'Report', 'This is for testing.', 'report.php', '2018-02-18 10:41:54', 0),
(7, 11, 'Suggest Edit', '11 Suggested one suggestion for your file sem8', 'suggestedits_file_details.php?suggestion_id=7', '2018-02-18 13:06:01', 0),
(8, 11, 'Suggest Edit', 'Tarang Dubey Suggested one suggestion for your file nothin', 'suggestedits_file_details.php?suggestion_id=10', '2018-02-18 13:47:40', 0),
(9, 11, 'Suggest Edit', 'Tarang Dubey Suggested one suggestion for your file sem8', 'suggestedits_file_details.php?suggestion_id=11', '2018-02-18 15:44:59', 0),
(10, 11, 'Report', '16 Reported your file sem8', 'reported_file_details.php?report_id=', '2018-02-18 15:45:12', 0),
(11, 11, 'Report', '16 Reported your file nothin', 'reported_file_details.php?report_id=', '2018-02-18 15:45:37', 0),
(12, 11, 'Report', 'Tarang Dubey Reported your file sem8', 'reported_file_details.php?report_id=30', '2018-02-18 15:51:14', 0),
(13, 11, 'Report', 'Tarang Dubey Reported your file nothin', 'reported_file_details.php?report_id=31', '2018-02-18 15:51:26', 0),
(14, 11, 'Delete File', 'abc xyz Deleted your file sem8due to report', 'viewprofile.php', '2018-02-18 16:14:47', 0),
(15, 11, 'Report_no_change', 'Your Reported nothin file has been approved by our moderator abc xyz and will not be deleted.', 'viewprofile.php', '2018-02-18 16:15:13', 0),
(16, 11, 'Delete File', 'abc xyz Deleted your file nothindue to report', 'viewprofile.php', '2018-02-18 16:16:01', 0),
(17, 11, 'Report', 'abc xyz Reported your file one', 'reported_file_details.php?report_id=32', '2018-02-18 16:23:29', 0),
(18, 11, 'Delete File', 'abc xyz Deleted your file onedue to report', 'viewprofile.php', '2018-02-18 16:24:16', 0),
(19, 11, 'Report', 'abc xyz Reported your file one', 'reported_file_details.php?report_id=33', '2018-02-18 16:25:26', 0),
(20, 11, 'Report', 'abc xyz Reported your file two', 'reported_file_details.php?report_id=34', '2018-02-18 16:27:08', 0),
(21, 11, 'Delete File', 'abc xyz Deleted your file \"two\" due to report', 'viewprofile.php', '2018-02-18 16:27:13', 0),
(22, 11, 'Report', 'abc xyz Reported your file \"seat\"', 'reported_file_details.php?report_id=35', '2018-02-18 16:31:47', 0),
(23, 11, 'Suggest Edit', 'abc xyz Suggested one suggestion for your file \"Pyhton\"', 'suggestedits_file_details.php?suggestion_id=12', '2018-02-18 16:32:09', 0),
(24, 11, 'Report', 'abc xyz Reported your file \"Pyhton\"', 'reported_file_details.php?report_id=36', '2018-02-18 16:32:51', 0),
(25, 11, 'Delete File', 'abc xyz Deleted your file \"seat\" due to report', 'viewprofile.php', '2018-02-18 16:33:05', 0),
(26, 11, 'Report_no_change', 'Your Reported file \"Pyhton\" has been approved by our moderator abc xyz and will not be deleted.', 'viewprofile.php', '2018-02-18 16:33:14', 0),
(27, 11, 'Report', 'abc xyz Reported your file \"any\"', 'reported_file_details.php?report_id=37', '2018-02-18 17:41:33', 0),
(28, 11, 'Report', 'abc xyz Reported your file \"AIT\"', 'reported_file_details.php?report_id=38', '2018-02-18 17:49:53', 0),
(29, 11, 'Suggest Edit', 'abc xyz Suggested one suggestion for your file \"AIT\"', 'suggestedits_file_details.php?suggestion_id=13', '2018-02-18 17:50:26', 0),
(30, 11, 'Delete File', 'Admin  Deleted your file \"any\" due to report', 'viewprofile.php', '2018-02-18 19:03:04', 0),
(31, 1, 'Report', 'Admin  Reported your file \"LP\"', 'reported_file_details.php?report_id=39', '2018-02-18 19:53:18', 0),
(32, 1, 'Delete Ebook Admin', 'Your file  has been Deleted by Admin.', 'ebooks.php', '2018-02-18 20:07:55', 0),
(33, 1, 'Delete Ebook Admin', 'Your file  has been Deleted by Admin.', 'ebooks.php', '2018-02-18 20:09:09', 0),
(34, 1, 'Delete Ebook Admin', 'Your file  has been Deleted by Admin.', 'ebooks.php', '2018-02-18 20:09:32', 0),
(35, 1, 'Delete Ebook Admin', 'Your file  has been Deleted by Admin.', 'ebooks.php', '2018-02-18 20:09:52', 0),
(36, 1, 'Delete Ebook Admin', 'Your file  has been Deleted by Admin.', 'ebooks.php', '2018-02-18 20:10:16', 0),
(37, 1, 'Delete Ebook Admin', 'Your file  has been Deleted by Admin.', 'ebooks.php', '2018-02-18 20:10:43', 0),
(38, 1, 'Delete Ebook Admin', 'Your file  has been Deleted by Admin.', 'ebooks.php', '2018-02-18 20:11:00', 0),
(39, 1, 'Delete Ebook Admin', 'Your file  has been Deleted by Admin.', 'ebooks.php', '2018-02-18 20:11:40', 0),
(40, 1, 'Delete Ebook Admin', 'Your file  has been Deleted by Admin.', 'ebooks.php', '2018-02-18 20:12:04', 0),
(41, 1, 'Delete Ebook Admin', 'Your file  has been Deleted by Admin.', 'ebooks.php', '2018-02-18 20:12:34', 0),
(42, 1, 'Delete Ebook Admin', 'Your file  has been Deleted by Admin.', 'ebooks.php', '2018-02-18 20:14:14', 0),
(43, 1, 'Delete Ebook Admin', 'Your file  has been Deleted by Admin.', 'ebooks.php', '2018-02-18 20:14:43', 0),
(44, 1, 'Delete Ebook Admin', 'Your file  has been Deleted by Admin.', 'ebooks.php', '2018-02-18 20:15:51', 0),
(45, 1, 'Delete Ebook Admin', 'Your file  has been Deleted by Admin.', 'ebooks.php', '2018-02-18 20:19:07', 0),
(46, 1, 'Delete Ebook Admin', 'Your file  has been Deleted by Admin.', 'ebooks.php', '2018-02-18 20:19:24', 0),
(47, 1, 'Delete Ebook Admin', 'Your file  has been Deleted by Admin.', 'ebooks.php', '2018-02-18 20:19:54', 0),
(48, 1, 'Delete Ebook Admin', 'Your file  has been Deleted by Admin.', 'ebooks.php', '2018-02-18 20:20:53', 0),
(49, 1, 'Delete Ebook Admin', 'Your file  has been Deleted by Admin.', 'ebooks.php', '2018-02-18 20:23:46', 0),
(50, 1, 'Delete Ebook Admin', 'Your file  has been Deleted by Admin.', 'ebooks.php', '2018-02-18 20:24:15', 0),
(51, 1, 'Delete Ebook Admin', 'Your file U has been Deleted by Admin.', 'ebooks.php', '2018-02-18 20:24:50', 0),
(52, 1, 'Delete Ebook Admin', 'Your file LP has been Deleted by Admin.', 'ebooks.php', '2018-02-18 20:26:43', 0),
(53, 1, 'Delete Ebook Admin', 'Your file  has been Deleted by Admin.', 'ebooks.php', '2018-02-18 20:27:03', 0),
(54, 1, 'Delete CEM Admin', 'Your file LP has been Deleted by Admin.', 'viewprofile.php', '2018-02-18 20:28:35', 0),
(55, 1, 'Delete Notes Admin', 'Your file fdsfs has been Deleted by Admin.', 'viewprofile.php', '2018-02-18 20:30:46', 0),
(56, 16, 'Delete Notes Admin', 'Your file fsdfs has been Deleted by Admin.', 'viewprofile.php', '2018-02-18 20:33:57', 0),
(57, 16, 'Delete CEM Admin', 'Your file fdsfsdffsdfer has been Deleted by Admin.', 'viewprofile.php', '2018-02-18 20:34:01', 0),
(58, 16, 'Delete CEM Admin', 'Your file bfbbmfds has been Deleted by Admin.', 'viewprofile.php', '2018-02-18 20:58:23', 0),
(59, 16, 'Delete Notes Admin', 'Your file one has been Deleted by Admin.', 'viewprofile.php', '2018-02-18 20:58:46', 0),
(60, 16, 'Report', 'Tarang Dubey Reported your file \"att\"', 'reported_file_details.php?report_id=40', '2018-02-18 21:02:14', 0),
(61, 16, 'Delete File', 'abc xyz Deleted your file \"att\" due to report', 'viewprofile.php', '2018-02-18 21:03:06', 0),
(62, 18, 'Report', 'Tarang Dubey Reported your file \"Artificial Intelligence\"', 'reported_file_details.php?report_id=41', '2018-05-09 20:01:33', 0),
(63, 9, 'Delete CEM Admin', 'Your file The-Official-Guide-to-the-GRE®-Verbal-Reasoning-Practice-Questions-Vol-One has been Deleted by Admin.', 'viewprofile.php', '2018-05-12 17:38:45', 0),
(64, 1, 'Delete Notes Admin', 'Your file Chapter 1 has been Deleted by Admin.', 'viewprofile.php', '2018-05-15 15:50:38', 0),
(65, 1, 'Report_no_change', 'Your Reported file \"LP\" has been approved by our moderator Shubham Detroja and will not be deleted.', 'viewprofile.php', '2018-05-16 11:23:45', 0),
(66, 18, 'Delete File', 'Shubham Detroja Deleted your file \"Artificial Intelligence\" due to report', 'viewprofile.php', '2018-05-16 11:24:10', 0),
(67, 11, 'Report_no_change', 'Your Reported file \"AIT\" has been approved by our moderator Shubham Detroja and will not be deleted.', 'viewprofile.php', '2018-05-16 11:24:16', 0),
(68, 1, 'Report', 'Admin  Reported your file \"Predicate Logic AI\"', 'reported_file_details.php?report_id=42', '2018-05-16 11:31:34', 0),
(69, 1, 'Suggest Edit', 'Admin  Suggested one suggestion for your file \"Predicate Logic AI\"', 'suggestedits_file_details.php?suggestion_id=14', '2018-05-16 11:32:51', 0),
(70, 1, 'Delete CEM Admin', 'Your file GPSC Prelim Paper - 2 has been Deleted by Admin.', 'viewprofile.php', '2018-05-16 11:49:09', 0),
(71, 1, 'Delete Notes Admin', 'Your file Game Playing - AI has been Deleted by Admin.', 'viewprofile.php', '2018-05-16 12:10:42', 0),
(72, 1, 'Delete Notes Admin', 'Your file Game Playing - AI has been Deleted by Admin.', 'viewprofile.php', '2018-05-16 12:17:34', 0),
(73, 1, 'Delete CEM Admin', 'Your file GPSC Prelim Paper has been Deleted by Admin.', 'viewprofile.php', '2018-05-16 12:20:24', 0),
(74, 1, 'Delete CEM Admin', 'Your file GPSC Prelim Paper - 2 has been Deleted by Admin.', 'viewprofile.php', '2018-05-16 12:20:43', 0),
(75, 20, 'Delete CEM Admin', 'Your file GRE - Verbal Reasoning has been Deleted by Admin.', 'viewprofile.php', '2018-05-16 12:31:50', 0),
(76, 1, 'Report', 'Dhaval Padaya Reported your file \"Predicate Logic AI\"', 'reported_file_details.php?report_id=43', '2018-05-16 12:52:05', 0),
(77, 1, 'Report_no_change', 'Your Reported file \"Predicate Logic AI\" has been approved by our moderator Shubham Detroja and will not be deleted.', 'viewprofile.php', '2018-05-16 12:54:01', 0),
(78, 19, 'Suggest Edit', 'Shubham Detroja Suggested one suggestion for your file \"Rjindael Algorithm\"', 'suggestedits_file_details.php?suggestion_id=15', '2018-05-16 12:54:45', 0),
(79, 18, 'Suggest Edit', 'Shubham Detroja Suggested one suggestion for your file \"Semantic Network\"', 'suggestedits_file_details.php?suggestion_id=16', '2018-05-16 12:57:11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `report_files`
--

CREATE TABLE `report_files` (
  `report_id` int(11) NOT NULL,
  `report_to_userid` int(11) NOT NULL,
  `report_file_name` varchar(100) NOT NULL,
  `report_file_type` varchar(50) NOT NULL,
  `report_file_id` int(10) NOT NULL,
  `report_reason` varchar(250) NOT NULL,
  `report_description` varchar(250) NOT NULL,
  `report_date` date NOT NULL,
  `reported_by_userid` int(11) NOT NULL,
  `report_stage` varchar(50) NOT NULL DEFAULT 'No Action',
  `moderated_by_userid` int(10) DEFAULT NULL,
  `moderated_on` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report_files`
--

INSERT INTO `report_files` (`report_id`, `report_to_userid`, `report_file_name`, `report_file_type`, `report_file_id`, `report_reason`, `report_description`, `report_date`, `reported_by_userid`, `report_stage`, `moderated_by_userid`, `moderated_on`) VALUES
(7, 11, 'AI', 'notes', 3, 'This file is not Study Related.', 'This is not good', '2018-01-24', 11, 'File Deleted', 11, '2018-01-24'),
(3, 11, 'French History', 'cem', 8, 'no reason', 'no reason', '2018-01-24', 11, 'File Deleted', 11, '2018-01-24'),
(11, 11, 'AI', 'cem', 9, 'This file is not Study Related.', ',ghskj', '2018-01-24', 11, 'File Deleted', 11, '2018-02-18'),
(10, 11, 'AIF', 'notes', 6, 'This file is not Study Related.', 'jfsdkhfjskd', '2018-01-24', 11, 'File Deleted', 11, '2018-02-17'),
(8, 11, 'AIM', 'notes', 4, 'This file is not Study Related.', 'fjdfkjs', '2018-01-24', 11, 'File Deleted', 11, '2018-02-13'),
(9, 11, 'AIG', 'notes', 5, 'This file is not Study Related.', 'jksfhkjd', '2018-01-24', 11, 'File Deleted', 11, '2018-01-24'),
(14, 11, 'AIT', 'cem', 11, 'This file is not Study Related.', ',sflksdjlk', '2018-01-24', 11, 'File Deleted', 11, '2018-01-24'),
(13, 11, 'AIm', 'cem', 10, 'File Subject is not according to File content.', 'jkfhksd', '2018-01-24', 11, 'File Deleted', 11, '2018-02-18'),
(15, 11, 'AIT', 'cem', 11, 'This file is not Study Related.', 'kgfjdklj', '2018-01-24', 11, 'File Deleted', 11, '2018-01-24'),
(16, 11, 'AIH', 'notes', 7, 'This file is not Study Related.', 'AI', '2018-01-25', 11, 'File Deleted', 11, '2018-01-25'),
(17, 11, 'AIG', 'notes', 4, 'This file is not Study Related.', 'This is not good', '2018-02-13', 11, 'File Deleted', 11, '2018-02-13'),
(18, 11, 'hdgjfsjd', 'cem', 14, 'This file is not Study Related.', 'not good', '2018-02-13', 11, 'File is OK', 11, '2018-02-13'),
(19, 11, 'bvcbcvb', 'notes', 5, 'This file is not Study Related.', 'fgdfgd', '2018-02-13', 11, 'File is OK', 11, '2018-02-13'),
(20, 11, 'abc', 'notes', 5, 'This file is not Study Related.', 'Yes', '2018-02-17', 11, 'File is OK', 11, '2018-02-18'),
(21, 11, 'Python', 'notes', 6, 'This file is not Study Related.', 'No', '2018-02-17', 11, 'File Deleted', 11, '2018-02-17'),
(22, 11, 'Python', 'notes', 6, 'This file is not Study Related.', 'No', '2018-02-17', 11, 'File Deleted', 11, '2018-02-17'),
(23, 11, 'Python', 'notes', 6, 'This file is not Study Related.', 'No', '2018-02-17', 11, 'File Deleted', 11, '2018-02-17'),
(24, 11, 'Python', 'notes', 6, 'This file is not Study Related.', 'No', '2018-02-17', 11, 'File Deleted', 11, '2018-02-17'),
(25, 11, 'Python', 'notes', 6, 'This file is not Study Related.', 'No', '2018-02-17', 11, 'File Deleted', 11, '2018-02-17'),
(26, 11, 'Python', 'notes', 6, 'This file is not Study Related.', 'no', '2018-02-17', 11, 'File Deleted', 11, '2018-02-17'),
(27, 11, 'python', 'notes', 8, 'This file is not Study Related.', 'unknown', '2018-02-18', 11, 'File is OK', 11, '2018-02-18'),
(28, 11, 'sem8', 'notes', 9, 'This file is not Study Related.', 'Reported', '2018-02-18', 16, 'File Deleted', 11, '2018-02-18'),
(29, 11, 'nothin', 'cem', 15, 'This file is not Study Related.', 'cem reported', '2018-02-18', 16, 'File Deleted', 11, '2018-02-18'),
(30, 11, 'sem8', 'notes', 9, 'This file is not Study Related.', 'Reported', '2018-02-18', 16, 'File Deleted', 11, '2018-02-18'),
(31, 11, 'nothin', 'cem', 15, 'This file is not Study Related.', 'Reported', '2018-02-18', 16, 'File Deleted', 11, '2018-02-18'),
(32, 11, 'one', 'notes', 10, 'This file is not Study Related.', 'same content', '2018-02-18', 11, 'File Deleted', 11, '2018-02-18'),
(33, 11, 'one', 'cem', 16, 'This file is not Study Related.', 'same', '2018-02-18', 11, 'File Deleted', 11, '2018-02-18'),
(34, 11, 'two', 'cem', 17, 'This file is not Study Related.', 'two', '2018-02-18', 11, 'File Deleted', 11, '2018-02-18'),
(35, 11, 'seat', 'cem', 18, 'This file is not Study Related.', 'seat', '2018-02-18', 11, 'File Deleted', 11, '2018-02-18'),
(36, 11, 'Pyhton', 'notes', 11, 'This file is not Study Related.', 'python', '2018-02-18', 11, 'File is OK', 11, '2018-02-18'),
(37, 11, 'any', 'cem', 20, 'This file is not Study Related.', 'reason', '2018-02-18', 11, 'File Deleted', 1, '2018-02-18'),
(38, 11, 'AIT', 'cem', 21, 'This file is not Study Related.', 'report', '2018-02-18', 11, 'File is OK', 19, '2018-05-16'),
(39, 1, 'LP', 'cem', 23, 'This file is not Study Related.', 'one', '2018-02-18', 1, 'File is OK', 19, '2018-05-16'),
(40, 16, 'att', 'cem', 26, 'This file is not Study Related.', 'jfkdhsj', '2018-02-18', 16, 'File Deleted', 11, '2018-02-18'),
(41, 18, 'Artificial Intelligence', 'notes', 1, 'This file is not Study Related.', 'testing', '2018-05-09', 18, 'File Deleted', 19, '2018-05-16'),
(42, 1, 'Predicate Logic AI', 'notes', 15, 'This file is not Study Related.', 'irrelevant material', '2018-05-16', 1, 'File is OK', 19, '2018-05-16'),
(43, 1, 'Predicate Logic AI', 'notes', 15, 'File Subject is not according to File content.', 'Change the content and make it relevant for subject.', '2018-05-16', 20, 'No Action', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suggestedits`
--

CREATE TABLE `suggestedits` (
  `suggestion_id` int(11) NOT NULL,
  `suggestion_to_userid` int(11) NOT NULL,
  `suggestion_file_type` varchar(10) NOT NULL,
  `suggestion_file_id` int(11) NOT NULL,
  `suggestion_file_name` varchar(50) NOT NULL,
  `suggestion_edit_in` varchar(20) NOT NULL,
  `suggestion_description` varchar(250) NOT NULL,
  `suggested_by_userid` int(11) NOT NULL,
  `suggested_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suggestedits`
--

INSERT INTO `suggestedits` (`suggestion_id`, `suggestion_to_userid`, `suggestion_file_type`, `suggestion_file_id`, `suggestion_file_name`, `suggestion_edit_in`, `suggestion_description`, `suggested_by_userid`, `suggested_on`) VALUES
(1, 11, 'notes', 1, 'INS VIideo', 'Title', '', 11, '2018-01-24'),
(2, 11, 'notes', 1, 'AI', 'Title', 'shgs', 11, '2018-02-02'),
(3, 11, 'notes', 1, 'AI', 'Title', 'shgs', 11, '2018-02-02'),
(4, 11, 'notes', 1, 'AI', 'Title', 'jsj', 11, '2018-02-02'),
(5, 11, 'notes', 5, 'bvcbcvb', 'Subject', 'This subject is not relevant.', 16, '2018-02-16'),
(6, 11, 'notes', 5, 'abc', 'Title', 'cv', 11, '2018-02-17'),
(7, 11, 'notes', 9, 'sem8', 'Subject', 'One', 11, '2018-02-18'),
(8, 11, 'cem', 15, 'nothin', '', '', 16, '2018-02-18'),
(9, 11, 'cem', 15, 'nothin', 'Title', 'one', 16, '2018-02-18'),
(10, 11, 'cem', 15, 'nothin', 'Title', 'one', 16, '2018-02-18'),
(11, 11, 'notes', 9, 'sem8', 'Title', 'This is file suggested', 16, '2018-02-18'),
(12, 11, 'notes', 11, 'Pyhton', 'Title', 'python', 11, '2018-02-18'),
(13, 11, 'cem', 21, 'AIT', 'Title', 'hahah', 11, '2018-02-18'),
(14, 1, 'notes', 15, 'Predicate Logic AI', 'Title', 'title is different please edit it make changes on information.', 1, '2018-05-16'),
(15, 19, 'notes', 18, 'Rjindael Algorithm', 'Topics', 'Topic is quite hard to understand please edit it and try to make it easy.', 19, '2018-05-16'),
(16, 18, 'notes', 20, 'Semantic Network', 'File content', 'Incomplete topics in file please update it.', 19, '2018-05-16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'Normal',
  `password` text NOT NULL,
  `validation_code` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `role`, `password`, `validation_code`, `active`) VALUES
(1, 'Admin', '', 'Admin', 'admin@studypedia.com', 'Admin', 'c81c456e46c2abb8f6282f13f04ef92b', '0', 1),
(2, 'Edwin', 'Diaz', 'rico', 'edwin@codingfaculty.com', 'Normal', '123', '', 0),
(9, 'Juan', 'Martinez', 'juan', 'juan@gmail.com', 'Normal', '8e6e509fba12de7be9ff1cb5333a69d2', '0', 1),
(11, 'abc', 'xyz', 'abc_xyz', 'abc_xyz@gmail.com', 'Moderator', '05d58ef1269251a11ec4d18f64d3acba', '38b351672eca175ec4505fd5e2fcd8dd', 1),
(17, 'test', 'test', 'test', 'test@studypedia.com', 'Normal', 'c81c456e46c2abb8f6282f13f04ef92b', 'da17effa9eaa3688ebb798d85766df78', 0),
(18, 'Tarang', 'Dubey', 'stark500', 'tarangdubey@gmail.com', 'Normal', '25d55ad283aa400af464c76d713c07ad', '0', 1),
(19, 'Shubham', 'Detroja', 'shubham_detroja', 'shubham@gmail.com', 'Moderator', '25d55ad283aa400af464c76d713c07ad', '3c5f59aa1d08640d02f209ac1c743162', 1),
(20, 'Dhaval', 'Padaya', 'dhaval_padaya', 'dhaval@gmail.com', 'Normal', '25d55ad283aa400af464c76d713c07ad', 'f735d67a597cbf9ae0dba54dc40b6218', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cem_category`
--
ALTER TABLE `cem_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `competitive_exam`
--
ALTER TABLE `competitive_exam`
  ADD PRIMARY KEY (`cem_id`);

--
-- Indexes for table `ebooks`
--
ALTER TABLE `ebooks`
  ADD PRIMARY KEY (`ebook_id`);

--
-- Indexes for table `ebook_category`
--
ALTER TABLE `ebook_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `guestlist`
--
ALTER TABLE `guestlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `report_files`
--
ALTER TABLE `report_files`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `suggestedits`
--
ALTER TABLE `suggestedits`
  ADD PRIMARY KEY (`suggestion_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cem_category`
--
ALTER TABLE `cem_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `competitive_exam`
--
ALTER TABLE `competitive_exam`
  MODIFY `cem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `ebooks`
--
ALTER TABLE `ebooks`
  MODIFY `ebook_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ebook_category`
--
ALTER TABLE `ebook_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `guestlist`
--
ALTER TABLE `guestlist`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `report_files`
--
ALTER TABLE `report_files`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `suggestedits`
--
ALTER TABLE `suggestedits`
  MODIFY `suggestion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
