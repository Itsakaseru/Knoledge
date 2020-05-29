-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2020 at 06:31 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `knoledge`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_missing_student_assignment` ()  BEGIN
DECLARE counter INTEGER;
DECLARE i INTEGER;
DECLARE j INTEGER;
DECLARE exist INTEGER;
DECLARE temp INTEGER;
DECLARE temp2 INTEGER;
DECLARE temp3 INTEGER;
DECLARE temp4 INTEGER;
SET counter = (SELECT COUNT(*) FROM users);
SET i = (SELECT userID FROM users WHERE roleID=3 LIMIT 1);
WHILE i <= counter
DO
SET temp2 = i - 1;
SET temp = (SELECT roleID FROM users LIMIT 1 OFFSET temp2);
IF temp = 3 THEN
SET exist = (SELECT COUNT(*) FROM assignments WHERE StudentID=i);
IF exist = 1 THEN
SET j = 0;
SET temp4 = (SELECT COUNT(*) FROM subjects);
WHILE j < counter
DO
SET temp3 = j + 1;
INSERT INTO assignments(StudentID, SubjectID) VALUES(i, temp3);
SET j = j + 1;
END WHILE;
END IF;
END IF;
SET i = i + 1;
END WHILE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_missing_student_class` ()  BEGIN
DECLARE i INTEGER;
DECLARE counter INTEGER;
DECLARE added INTEGER;
DECLARE birthyear INTEGER;
SET i = (SELECT studentID FROM assignments LIMIT 1);
SET counter = (SELECT studentID FROM assignments ORDER BY studentID DESC LIMIT 1);
WHILE i <= counter
DO
SET added = (SELECT IF(classID=0, 0, 1) FROM assignments WHERE studentID = i LIMIT 1);
IF added = 0 THEN
SET birthyear = (SELECT YEAR(dob) FROM users WHERE userID=i);
IF birthyear = '2000' THEN UPDATE assignments SET classID=4 WHERE studentID=i;
ELSEIF birthyear = '2001' THEN UPDATE assignments SET classID=3 WHERE studentID=i;
ELSEIF birthyear = '2002' THEN
IF FLOOR(RAND() * 10 / 5) = 1 THEN UPDATE assignments SET classID=2 WHERE studentID=i;
ELSE UPDATE assignments SET classID=1 WHERE studentID=i;
END IF;
END IF;
END IF;
SET i = i + 1;
END WHILE;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `current_class` (`id` INTEGER) RETURNS INT(11) BEGIN
DECLARE highest INTEGER;
DECLARE role INTEGER;
SET role = (SELECT roleID FROM users WHERE userID=id);
IF role = 3 THEN 
SET highest = (SELECT classID FROM assignments JOIN users ON studentID=userID AND userid=id AND subjectid=1 ORDER BY classID DESC LIMIT 1);
ELSE
SET highest = 0;
END IF;
RETURN highest;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `studentID` int(5) NOT NULL,
  `classID` int(2) NOT NULL DEFAULT 0,
  `subjectID` int(2) NOT NULL,
  `assignmentScore` int(3) NOT NULL DEFAULT 0,
  `midtermScore` int(3) NOT NULL DEFAULT 0,
  `finaltermScore` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`studentID`, `classID`, `subjectID`, `assignmentScore`, `midtermScore`, `finaltermScore`) VALUES
(13, 1, 1, 84, 88, 79),
(13, 3, 1, 0, 0, 0),
(13, 1, 2, 76, 82, 77),
(13, 3, 2, 0, 0, 0),
(13, 1, 3, 85, 78, 80),
(13, 3, 3, 0, 0, 0),
(13, 1, 4, 90, 85, 88),
(13, 3, 4, 0, 0, 0),
(13, 1, 5, 80, 86, 76),
(13, 3, 5, 0, 0, 0),
(14, 3, 1, 0, 0, 0),
(14, 3, 2, 0, 0, 0),
(14, 3, 3, 0, 0, 0),
(14, 3, 4, 0, 0, 0),
(14, 3, 5, 0, 0, 0),
(15, 3, 1, 0, 0, 0),
(15, 3, 2, 0, 0, 0),
(15, 3, 3, 0, 0, 0),
(15, 3, 4, 0, 0, 0),
(15, 3, 5, 0, 0, 0),
(16, 3, 1, 0, 0, 0),
(16, 3, 2, 0, 0, 0),
(16, 3, 3, 0, 0, 0),
(16, 3, 4, 0, 0, 0),
(16, 3, 5, 0, 0, 0),
(17, 3, 1, 0, 0, 0),
(17, 3, 2, 0, 0, 0),
(17, 3, 3, 0, 0, 0),
(17, 3, 4, 0, 0, 0),
(17, 3, 5, 0, 0, 0),
(18, 4, 1, 0, 0, 0),
(18, 4, 2, 0, 0, 0),
(18, 4, 3, 0, 0, 0),
(18, 4, 4, 0, 0, 0),
(18, 4, 5, 0, 0, 0),
(19, 1, 1, 0, 0, 0),
(19, 1, 2, 0, 0, 0),
(19, 1, 3, 0, 0, 0),
(19, 1, 4, 0, 0, 0),
(19, 1, 5, 0, 0, 0),
(20, 3, 1, 0, 0, 0),
(20, 3, 2, 0, 0, 0),
(20, 3, 3, 0, 0, 0),
(20, 3, 4, 0, 0, 0),
(20, 3, 5, 0, 0, 0),
(21, 3, 1, 0, 0, 0),
(21, 3, 2, 0, 0, 0),
(21, 3, 3, 0, 0, 0),
(21, 3, 4, 0, 0, 0),
(21, 3, 5, 0, 0, 0),
(22, 2, 1, 0, 0, 0),
(22, 2, 2, 0, 0, 0),
(22, 2, 3, 0, 0, 0),
(22, 2, 4, 0, 0, 0),
(22, 2, 5, 0, 0, 0),
(23, 2, 1, 0, 0, 0),
(23, 2, 2, 0, 0, 0),
(23, 2, 3, 0, 0, 0),
(23, 2, 4, 0, 0, 0),
(23, 2, 5, 0, 0, 0),
(24, 1, 1, 0, 0, 0),
(24, 1, 2, 0, 0, 0),
(24, 1, 3, 0, 0, 0),
(24, 1, 4, 0, 0, 0),
(24, 1, 5, 0, 0, 0),
(25, 1, 1, 0, 0, 0),
(25, 1, 2, 0, 0, 0),
(25, 1, 3, 0, 0, 0),
(25, 1, 4, 0, 0, 0),
(25, 1, 5, 0, 0, 0),
(26, 1, 1, 0, 0, 0),
(26, 1, 2, 0, 0, 0),
(26, 1, 3, 0, 0, 0),
(26, 1, 4, 0, 0, 0),
(26, 1, 5, 0, 0, 0),
(27, 1, 1, 0, 0, 0),
(27, 1, 2, 0, 0, 0),
(27, 1, 3, 0, 0, 0),
(27, 1, 4, 0, 0, 0),
(27, 1, 5, 0, 0, 0),
(28, 1, 1, 0, 0, 0),
(28, 1, 2, 0, 0, 0),
(28, 1, 3, 0, 0, 0),
(28, 1, 4, 0, 0, 0),
(28, 1, 5, 0, 0, 0),
(29, 1, 1, 0, 0, 0),
(29, 1, 2, 0, 0, 0),
(29, 1, 3, 0, 0, 0),
(29, 1, 4, 0, 0, 0),
(29, 1, 5, 0, 0, 0),
(30, 1, 1, 0, 0, 0),
(30, 1, 2, 0, 0, 0),
(30, 1, 3, 0, 0, 0),
(30, 1, 4, 0, 0, 0),
(30, 1, 5, 0, 0, 0),
(31, 2, 1, 0, 0, 0),
(31, 2, 2, 0, 0, 0),
(31, 2, 3, 0, 0, 0),
(31, 2, 4, 0, 0, 0),
(31, 2, 5, 0, 0, 0),
(32, 2, 1, 0, 0, 0),
(32, 2, 2, 0, 0, 0),
(32, 2, 3, 0, 0, 0),
(32, 2, 4, 0, 0, 0),
(32, 2, 5, 0, 0, 0),
(33, 3, 1, 0, 0, 0),
(33, 3, 2, 0, 0, 0),
(33, 3, 3, 0, 0, 0),
(33, 3, 4, 0, 0, 0),
(33, 3, 5, 0, 0, 0),
(34, 2, 1, 0, 0, 0),
(34, 2, 2, 0, 0, 0),
(34, 2, 3, 0, 0, 0),
(34, 2, 4, 0, 0, 0),
(34, 2, 5, 0, 0, 0),
(35, 1, 1, 0, 0, 0),
(35, 1, 2, 0, 0, 0),
(35, 1, 3, 0, 0, 0),
(35, 1, 4, 0, 0, 0),
(35, 1, 5, 0, 0, 0),
(36, 4, 1, 0, 0, 0),
(36, 4, 2, 0, 0, 0),
(36, 4, 3, 0, 0, 0),
(36, 4, 4, 0, 0, 0),
(36, 4, 5, 0, 0, 0),
(37, 4, 1, 0, 0, 0),
(37, 4, 2, 0, 0, 0),
(37, 4, 3, 0, 0, 0),
(37, 4, 4, 0, 0, 0),
(37, 4, 5, 0, 0, 0),
(38, 4, 1, 0, 0, 0),
(38, 4, 2, 0, 0, 0),
(38, 4, 3, 0, 0, 0),
(38, 4, 4, 0, 0, 0),
(38, 4, 5, 0, 0, 0),
(39, 4, 1, 0, 0, 0),
(39, 4, 2, 0, 0, 0),
(39, 4, 3, 0, 0, 0),
(39, 4, 4, 0, 0, 0),
(39, 4, 5, 0, 0, 0),
(40, 4, 1, 0, 0, 0),
(40, 4, 2, 0, 0, 0),
(40, 4, 3, 0, 0, 0),
(40, 4, 4, 0, 0, 0),
(40, 4, 5, 0, 0, 0),
(41, 1, 1, 0, 0, 0),
(41, 1, 2, 0, 0, 0),
(41, 1, 3, 0, 0, 0),
(41, 1, 4, 0, 0, 0),
(41, 1, 5, 0, 0, 0),
(42, 2, 1, 0, 0, 0),
(42, 2, 2, 0, 0, 0),
(42, 2, 3, 0, 0, 0),
(42, 2, 4, 0, 0, 0),
(42, 2, 5, 0, 0, 0),
(43, 2, 1, 0, 0, 0),
(43, 2, 2, 0, 0, 0),
(43, 2, 3, 0, 0, 0),
(43, 2, 4, 0, 0, 0),
(43, 2, 5, 0, 0, 0),
(44, 4, 1, 0, 0, 0),
(44, 4, 2, 0, 0, 0),
(44, 4, 3, 0, 0, 0),
(44, 4, 4, 0, 0, 0),
(44, 4, 5, 0, 0, 0),
(45, 4, 1, 0, 0, 0),
(45, 4, 2, 0, 0, 0),
(45, 4, 3, 0, 0, 0),
(45, 4, 4, 0, 0, 0),
(45, 4, 5, 0, 0, 0),
(46, 3, 1, 0, 0, 0),
(46, 3, 2, 0, 0, 0),
(46, 3, 3, 0, 0, 0),
(46, 3, 4, 0, 0, 0),
(46, 3, 5, 0, 0, 0),
(47, 3, 1, 0, 0, 0),
(47, 3, 2, 0, 0, 0),
(47, 3, 3, 0, 0, 0),
(47, 3, 4, 0, 0, 0),
(47, 3, 5, 0, 0, 0),
(48, 4, 1, 0, 0, 0),
(48, 4, 2, 0, 0, 0),
(48, 4, 3, 0, 0, 0),
(48, 4, 4, 0, 0, 0),
(48, 4, 5, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `classID` int(2) NOT NULL,
  `className` varchar(3) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `instructorID` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`classID`, `className`, `description`, `instructorID`) VALUES
(0, NULL, 'No class assigned', 1),
(1, '1-A', NULL, 6),
(2, '1-B', NULL, 10),
(3, '2-A', NULL, 8),
(4, '3-A', NULL, 12);

-- --------------------------------------------------------

--
-- Stand-in structure for view `class_maininstructors`
-- (See below for the actual view)
--
CREATE TABLE `class_maininstructors` (
`classID` int(2)
,`className` varchar(3)
,`instructorID` int(5)
,`instructorName` varchar(511)
);

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `genderID` int(1) NOT NULL,
  `genderName` varchar(63) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`genderID`, `genderName`, `description`) VALUES
(1, 'Male', ''),
(2, 'Female', ''),
(3, 'Unspecified', '');

-- --------------------------------------------------------

--
-- Table structure for table `reqeditprofile`
--

CREATE TABLE `reqeditprofile` (
  `notificationID` int(5) NOT NULL,
  `description` varchar(255) NOT NULL,
  `targetID` int(5) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reqeditprofile`
--

INSERT INTO `reqeditprofile` (`notificationID`, `description`, `targetID`, `firstName`, `lastName`, `email`) VALUES
(1, 'change email from chitanda.eru@mail.com to eru.chitanda@mail.com', 43, NULL, NULL, 'eru.chitanda@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `reqreview`
--

CREATE TABLE `reqreview` (
  `notificationID` int(5) NOT NULL,
  `description` varchar(255) NOT NULL,
  `targetID` int(5) NOT NULL,
  `subjectID` int(2) NOT NULL,
  `requestType` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `request_editprofile`
-- (See below for the actual view)
--
CREATE TABLE `request_editprofile` (
`notificationID` int(5)
,`description` varchar(255)
,`targetID` int(5)
,`currentFirstName` varchar(255)
,`currentLastName` varchar(255)
,`currentEmail` varchar(255)
,`firstName` varchar(255)
,`lastName` varchar(255)
,`email` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `request_review`
-- (See below for the actual view)
--
CREATE TABLE `request_review` (
`notificationID` int(5)
,`description` varchar(255)
,`targetID` int(5)
,`fullName` varchar(511)
,`subjectID` int(2)
,`subjectName` varchar(64)
,`requestType` int(1)
,`requested` varchar(12)
);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleID` int(2) NOT NULL,
  `roleName` varchar(64) NOT NULL,
  `roleDescription` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleID`, `roleName`, `roleDescription`) VALUES
(1, 'Admin', NULL),
(2, 'Teacher', NULL),
(3, 'Student', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `student_allscores`
-- (See below for the actual view)
--
CREATE TABLE `student_allscores` (
`studentID` int(5)
,`fullName` varchar(511)
,`classID` int(2)
,`className` varchar(3)
,`subjectID` int(2)
,`subjectName` varchar(64)
,`assignment` int(3)
,`midterm` int(3)
,`finalterm` int(3)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `student_class`
-- (See below for the actual view)
--
CREATE TABLE `student_class` (
`studentID` int(5)
,`fullName` varchar(511)
,`classID` int(2)
,`className` varchar(3)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `student_classcoors`
-- (See below for the actual view)
--
CREATE TABLE `student_classcoors` (
`studentID` int(5)
,`fullName` varchar(511)
,`classID` int(2)
,`instructorID` int(5)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `student_currentscores`
-- (See below for the actual view)
--
CREATE TABLE `student_currentscores` (
`studentID` int(5)
,`fullName` varchar(511)
,`classID` int(2)
,`className` varchar(3)
,`subjectID` int(2)
,`subjectName` varchar(64)
,`assignment` int(3)
,`midterm` int(3)
,`finalterm` int(3)
);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subjectID` int(2) NOT NULL,
  `subjectName` varchar(64) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `coordinatorID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subjectID`, `subjectName`, `description`, `coordinatorID`) VALUES
(1, 'Mathematics', NULL, 3),
(2, 'Indonesian', NULL, 8),
(3, 'English', NULL, 2),
(4, 'Civics', NULL, 4),
(5, 'ICT', NULL, 7);

-- --------------------------------------------------------

--
-- Stand-in structure for view `subject_coors`
-- (See below for the actual view)
--
CREATE TABLE `subject_coors` (
`subjectID` int(2)
,`subjectName` varchar(64)
,`coordinatorID` int(5)
,`fullName` varchar(511)
);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `subjectID` int(2) NOT NULL,
  `classID` int(2) NOT NULL,
  `teacherID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`subjectID`, `classID`, `teacherID`) VALUES
(3, 1, 2),
(3, 2, 2),
(3, 3, 2),
(3, 4, 2),
(1, 3, 3),
(4, 3, 4),
(4, 1, 5),
(4, 2, 5),
(1, 4, 6),
(5, 1, 7),
(5, 2, 7),
(5, 3, 7),
(5, 4, 7),
(2, 3, 8),
(2, 1, 9),
(2, 2, 9),
(4, 4, 10),
(2, 4, 11),
(1, 1, 12),
(1, 2, 12);

-- --------------------------------------------------------

--
-- Stand-in structure for view `teacher_subjects`
-- (See below for the actual view)
--
CREATE TABLE `teacher_subjects` (
`teacherID` int(5)
,`fullName` varchar(511)
,`subjectID` int(2)
,`subjectName` varchar(64)
,`classID` int(2)
,`className` varchar(3)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(5) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `dob` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `hash` varchar(64) NOT NULL,
  `ppPath` varchar(255) DEFAULT NULL,
  `salt` varchar(5) NOT NULL,
  `genderID` int(1) NOT NULL,
  `roleID` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `firstName`, `lastName`, `dob`, `email`, `hash`, `ppPath`, `salt`, `genderID`, `roleID`) VALUES
(1, 'Shigeru', 'Itou', '1996-07-22', 'shigeru.itou@knoledge.com', '709916b52f23b3163b135668bc9849ebf4774760d1ed499f8ab19ed594270206', NULL, 'wpgfw', 1, 1),
(2, 'Severus', 'Snape', '1960-01-09', 'severus.snape@knoledge.com', '37692c84b14e5345535e893da6db288be4bdf1b23da61ca2b4fa3d1876b81cc6', NULL, 'oewyn', 1, 2),
(3, 'Koro', '', '1987-03-13', 'koro.sensei@knoledge.com', 'd9345baf8aff0fc2046477580a71221b90ec2ce72d224473851efe045553519f', NULL, 'launv', 3, 2),
(4, 'Hideo', 'Harada', '1974-07-12', 'hideo.harada@knoledge.com', 'ba2fb7b523f4e1b36012e1bf126b8cf0ec8e8792971b29762503440bcc31d344', NULL, 'mqvdk', 1, 2),
(5, 'Jiraiya', '', '1972-08-28', 'jiraiya.sensei@knoledge.com', '9b8c79805fc2f0c51b2fe462a21af48eff2da07d28c0c44ce40dffd6cac81608', NULL, 'borzv', 1, 2),
(6, 'Ririko', 'Kagome', '1985-10-13', 'ririko.kagome@knoledge.com', '9cd169fe6acbca098543ab89098bfb4a92e08cd010569db84ebef9f6a8bdb653', NULL, 'woqwo', 2, 2),
(7, 'Tearju', 'Lunatique', '1986-04-24', 'tearju.lunatique@knoledge.com', '82a3961eae9a6c17fb88a31a08c40ce062e706cb2d75702e3cf6b9d36cee07ce', NULL, 'gzzif', 2, 2),
(8, 'Biscuit', 'Krueger', '1954-03-02', 'biscuit.krueger@knoledge.com', '52518e712be9e75eda5661ad7a9c77a0db85eaf8bcc89e280b589a6aea3c8f5e', NULL, 'dzlyq', 2, 2),
(9, 'Kagami', 'Junichirou', '1985-10-06', 'kagami.junichirou@knoledge.com', '2ad1bd37ca8ca88d027718b6b43ce5da38985107761c12a1be5d058f7a95b894', NULL, 'jejra', 1, 2),
(10, 'Sakura', 'Karasuma', '1983-10-19', 'sakura.karasuma@knoledge.com', 'aa98477838d5639972fcb2b28be6cfb21401eb05aa90f7d23e96e92e00dde10b', NULL, 'ynjae', 2, 2),
(11, 'Sawako', 'Yamanaka', '1984-01-31', 'sawako.yamanaka@knoledge.com', '8703c5d18d8d734ef8ed5cd0fc3d467e6946c0554804b36a69d40d32e36aaaf2', NULL, 'vpkvj', 2, 2),
(12, 'Glenn', 'Radars', '1989-05-27', 'glenn.radars@knoledge.com', '154935f5ac926604bef8907c55fde84e3d3eb706aba9bb1515f51b0fa762555f', NULL, 'cnoxw', 1, 2),
(13, 'Kaguya', 'Shinomiya', '2001-03-19', 'kaguya.shinomiya@mail.com', '72a46946787c354019db1f57ce33f461a095b4938ba9a05e2c7d38611c4e5911', 'c51ce410c124a10e0db5e4b97fc2af39.jpg', 'fshgb', 2, 3),
(14, 'Chika', 'Fujiwara', '2001-06-22', 'chika.fujiwara@mail.com', '59fdd86439ac9fac7a5f7356d8408d5e532b4e44dbab91e816e3590dfee8901e', NULL, 'sqjah', 2, 3),
(15, 'Miyuki', 'Shirogane', '2001-01-20', 'miyuki.shirogane@mail.com', 'e70cdb2c29040bc0a14bdbe7f7ca7e4d4db46e80cc893c8e8b9d671373211e62', NULL, 'zdexg', 2, 3),
(16, 'Yuu', 'Ishigami', '2001-04-11', 'yuu.ishigami@mail.com', '5355af2e4ae2d3ecd64c1c35d7157f52535db5b35c65b0de610bff329b12dc1c', NULL, 'xnvts', 1, 3),
(17, 'You', 'Watanabe', '2001-04-17', 'you.watanabe@mail.com', 'b30e0e0c86075ce5234d4fcc6a579783400ddabc86faa1bfeb035370feab103f', NULL, 'mqjss', 2, 3),
(18, 'Mari', 'Ohara', '2000-06-13', 'mari.ohara@mail.com', '280609edf61fc1a158cbaa6321ce5338f8875ca4504e983a2d085cf52929ca23', NULL, 'albui', 2, 3),
(19, 'Yui', 'Hirasawa', '2002-11-27', 'yui.hirasawa@mail.com', '4a89566964e8cc8ecb844a0ab111886eca3690218240ee2d98ff2e7872058419', NULL, 'jewww', 2, 3),
(20, 'Shigeo', 'Kageyama', '2001-05-12', 'shigeo.kageyama@mail.com', '7a3d17e63bc7b1277ee0839772cc11a797e284f398dc644fdbcaccae709f63c3', NULL, 'uanak', 1, 3),
(21, 'Haruhi', 'Suzumiya', '2001-10-08', 'haruhi.suzumiya@mail.com', '251352a9d1befa049db9965d8a3218b728c9dfa78ad522f7e418fd517f0ddd96', NULL, 'epvab', 2, 3),
(22, 'Nako', 'Sunao', '2002-08-29', 'nako.sunao@mail.com', 'a39b514fa48486f5df5ff177780e9d59632513d131c83f3cc164295126a5d27f', NULL, 'hnlda', 2, 3),
(23, 'Yuuko', 'Aioi', '2002-05-26', 'yuuko.aioi@mail.com', 'fd7585fbb57bf24d720f26fce04d8f37059883d6a8bac5eab16a32f46c9f9dbb', NULL, 'ijfis', 2, 3),
(24, 'Mikoto', 'Masaka', '2002-05-02', 'mikoto.masaka@mail.com', '7016f45c126132d6b3bd4139f25ebff08f78d44160eff0be6ea107f2dd048130', NULL, 'qimkc', 2, 3),
(25, 'Kuroko', 'Shirai', '2002-07-30', 'kuroko.shirai@mail.com', 'a12ad68effc2620b779b90bb439f6168cc83a8077e1565b1e4d10309b31a7bed', NULL, 'ugnyt', 2, 3),
(26, 'Kumiko', 'Oumae', '2002-08-21', 'kumiko.oumae@mail.com', '7b4e883a4d445e9f3ef525630692d3d94181799b050ae8fa4cb8f8c465bf85f7', NULL, 'ipqkn', 2, 3),
(27, 'Reina', 'Kousaka', '2002-05-15', 'reina.kousaka@mail.com', 'b4406c251f287aa01e7967ca7ef617018da7064177a35f4d57aefe773e3c11a4', NULL, 'loreo', 2, 3),
(28, 'Nadeshiko', 'Kagamihara', '2002-09-22', 'nadeshiko.kagamihara@mail.com', '9f51635b3a07cd6e6d1142dfad94d79cb1162df1f6fca6ff8436238fedf454e8', NULL, 'ocgcq', 2, 3),
(29, 'Rin', 'Shima', '2002-11-10', 'rin.shima@mail.com', 'a3806e9918d7f5b7ba227e557b33566ac5e0f68d9ac25ff027b378b6f06240c3', NULL, 'wmchv', 2, 3),
(30, 'Mashiro', 'Shiina', '2002-06-13', 'mashiro.shiina@mail.com', 'd0249bb7bf7736554e2731d6bd236b32a6e9a61199a195bcec285e015912058f', NULL, 'brgqa', 2, 3),
(31, 'Nanami', 'Aoyama', '2002-09-06', 'nanami.aoyama@mail.com', '01107d9d870eac4fd231ddb6fcd053dc08280794bc74e1188df1a0df4acea99a', NULL, 'klzmz', 2, 3),
(32, 'Sorata', 'Kanda', '2002-05-09', 'sorata.kanda@@mail.com', '5362c7ad2f0a65a83b59da9036af8bfd4e42b9fade441c8b476a6f197b8e6119', NULL, 'bblxj', 1, 3),
(33, 'Akane', 'Mizuno', '2001-12-03', 'akane.mizuno@mail.com', '2a54ec6856ded17a436365d82ede8fbc6b47f9fafdad9e1c28390ba4aefd35c9', NULL, 'kemcw', 2, 3),
(34, 'Koutarou', 'Azumi', '2002-07-08', 'koutarou.azumi@mail.com', 'd2a3eae5bb82a6e6f57148c942fdece97e79e60fe563440717c1f8dcb400a641', NULL, 'gurms', 1, 3),
(35, 'Kasumi', 'Nomura', '2002-06-23', 'kasumi.nomura@mail.com', 'b59a8fff164e67a9e79e08f7229e950205a24ff857c8b1e3a9b45ea511171e96', NULL, 'xyrtt', 2, 3),
(36, 'Rikka', 'Takanashi', '2000-06-12', 'rikka.takanashi@mail.com', '486e0b65c956fa2f4c302cb2cd71af122d87bc758eb80e0b381eb0d5b74731b9', NULL, 'vkpvq', 2, 3),
(37, 'Shinka', 'Nibutani', '2000-08-30', 'shinka.nibutani@mail.com', '9bf1d1a042ad5b204e876911649b4813fdcca79d9b046f2eba8d6f0e19753e7b', NULL, 'cultt', 2, 3),
(38, 'Yuuta', 'Togashi', '2000-05-13', 'yuuta.togashi@mail.com', '65871e187d4f472fe7acd990a9842069c2bb14b4bb92435949ae436f5831f934', NULL, 'sreri', 1, 3),
(39, 'Karma', 'Akabane', '2000-12-25', 'karma.akabane@mail.com', 'ac588c53f1413d1cb0cd0d5ad799dd02fb2645c2ea2cb43977d439a5ae544ce7', NULL, 'jcfnx', 1, 3),
(40, 'Nagisa', 'Shiota', '2000-07-20', 'nagisa.shiota@mail.com', '70d10d8e08a5aa51c5df066be7f520ac6b1a5c5c453ac32d696a9abcf9b7dfbf', NULL, 'qpnst', 1, 3),
(41, 'Sakamichi', 'Onoda', '2002-03-07', 'sakamichi.onoda@mail.com', 'aa0fea6f6d58cb43ea8370b0203e1e7c41ff9457a8961f97db4de520e06e06a2', NULL, 'wnnho', 1, 3),
(42, 'Houtarou', 'Oreki', '2002-04-28', 'houtarou.oreki@mail.com', '5e3e08d72887a9918339604b2c94b9dca530b488ff948ee27daaa3aa1f18a177', NULL, 'wqzab', 1, 3),
(43, 'Eru', 'Chitanda', '2002-07-24', 'chitanda.eru@mail.com', '1d8daf85363f46651e330821b2d4486ca8f257cbffa4980835cf8300cc4f6eaf', NULL, 'zfhkn', 2, 3),
(44, 'Nagisa', 'Furukawa', '2000-12-24', 'nagisa.furukawa@mail.com', 'f51138fa66624e7545eda38dea8275ad3495dd2e4fd561ea13e0880cfdddb0b1', NULL, 'ntonn', 2, 3),
(45, 'Tomoya', 'Okazaki', '2000-10-30', 'tomoya.okazaki@mail.com', '887b19da0e2433b670395225fd3115a2c470ac54754171f5382c50edbe103fe9', NULL, 'nqbrx', 1, 3),
(46, 'Kyouko', 'Toshinou', '2001-03-28', 'kyouko.toshinou@mail.com', '7c88b2a13b5dcf4e2dbb6807593e4cae779612cdd902974f26fe61c5d95a5ecd', NULL, 'hoopt', 2, 3),
(47, 'Akari', 'Akaza', '2001-07-24', 'akari.akaza@mail.com', '11013abf98dbe6b84efbf66e701697b77971ec6591cd4b142b2bcf55de4e6dbc', NULL, 'dstwy', 2, 3),
(48, 'Jotaro', 'Kujo', '2000-04-27', 'jotaro.kujo@mail.com', '5b0392c95065bbd6d2b84fc074c62d56c13cfd989eb0e81434a0e64e6adb3f63', NULL, 'diooo', 1, 3);

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `add_student` AFTER INSERT ON `users` FOR EACH ROW BEGIN
DECLARE i INTEGER;
DECLARE counter INTEGER;
DECLARE notificationcount INTEGER;
IF NEW.roleID=3 THEN
SET i = 0;
SET counter = (SELECT COUNT(*) FROM subjects);
SET notificationcount = (SELECT COUNT(*) FROM notifications);
WHILE i < counter DO
INSERT INTO assignments(studentID, subjectID) VALUES(NEW.userID, i + 1);
SET i = i + 1;
END WHILE;
SET notificationcount = notificationcount + 1;
INSERT INTO notifications(notificationID, description, notificationType, jsonMsg) VALUES(notificationcount, CONCAT('Add entry for ', NEW.firstName, '''s scores'), 2, '{"info":"added","description":"New student added"}');
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_info`
-- (See below for the actual view)
--
CREATE TABLE `user_info` (
`userID` int(5)
,`fullName` varchar(511)
,`dob` date
,`email` varchar(255)
,`genderID` int(1)
,`genderName` varchar(63)
,`roleID` int(2)
,`roleName` varchar(64)
);

-- --------------------------------------------------------

--
-- Structure for view `class_maininstructors`
--
DROP TABLE IF EXISTS `class_maininstructors`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `class_maininstructors`  AS  select `classes`.`classID` AS `classID`,`classes`.`className` AS `className`,`classes`.`instructorID` AS `instructorID`,if(`users`.`lastName` = '' or `users`.`lastName` is null,`users`.`firstName`,concat(`users`.`firstName`,' ',`users`.`lastName`)) AS `instructorName` from (`classes` join `users` on(`classes`.`instructorID` = `users`.`userID` and `classes`.`classID` > 0)) ;

-- --------------------------------------------------------

--
-- Structure for view `request_editprofile`
--
DROP TABLE IF EXISTS `request_editprofile`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `request_editprofile`  AS  select `reqeditprofile`.`notificationID` AS `notificationID`,`reqeditprofile`.`description` AS `description`,`reqeditprofile`.`targetID` AS `targetID`,`users`.`firstName` AS `currentFirstName`,`users`.`lastName` AS `currentLastName`,`users`.`email` AS `currentEmail`,`reqeditprofile`.`firstName` AS `firstName`,`reqeditprofile`.`lastName` AS `lastName`,`reqeditprofile`.`email` AS `email` from (`reqeditprofile` join `users` on(`reqeditprofile`.`targetID` = `users`.`userID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `request_review`
--
DROP TABLE IF EXISTS `request_review`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `request_review`  AS  select `reqreview`.`notificationID` AS `notificationID`,`reqreview`.`description` AS `description`,`reqreview`.`targetID` AS `targetID`,if(`users`.`lastName` = '' or `users`.`lastName` is null,`users`.`firstName`,concat(`users`.`firstName`,' ',`users`.`lastName`)) AS `fullName`,`reqreview`.`subjectID` AS `subjectID`,`subjects`.`subjectName` AS `subjectName`,`reqreview`.`requestType` AS `requestType`,if(`reqreview`.`requestType` = 1,'Assignment',if(`reqreview`.`requestType` = 2,'Mid-term',if(`reqreview`.`requestType` = 3,'Final-term','Unknown type'))) AS `requested` from (`reqreview` join (`users` join `subjects`) on(`reqreview`.`targetID` = `users`.`userID` and `reqreview`.`subjectID` = `subjects`.`subjectID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `student_allscores`
--
DROP TABLE IF EXISTS `student_allscores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_allscores`  AS  select `users`.`userID` AS `studentID`,if(`users`.`lastName` = '' or `users`.`lastName` is null,`users`.`firstName`,concat(`users`.`firstName`,' ',`users`.`lastName`)) AS `fullName`,`assignments`.`classID` AS `classID`,`classes`.`className` AS `className`,`assignments`.`subjectID` AS `subjectID`,`subjects`.`subjectName` AS `subjectName`,`assignments`.`assignmentScore` AS `assignment`,`assignments`.`midtermScore` AS `midterm`,`assignments`.`finaltermScore` AS `finalterm` from (`assignments` join ((`users` join `subjects`) join `classes`) on(`assignments`.`studentID` = `users`.`userID` and `assignments`.`subjectID` = `subjects`.`subjectID` and `assignments`.`classID` = `classes`.`classID`)) order by `users`.`userID`,`assignments`.`classID`,`assignments`.`subjectID` ;

-- --------------------------------------------------------

--
-- Structure for view `student_class`
--
DROP TABLE IF EXISTS `student_class`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_class`  AS  select `users`.`userID` AS `studentID`,if(`users`.`lastName` = '' or `users`.`lastName` is null,`users`.`firstName`,concat(`users`.`firstName`,' ',`users`.`lastName`)) AS `fullName`,`classes`.`classID` AS `classID`,`classes`.`className` AS `className` from (`users` join (`assignments` join `classes`) on(`users`.`userID` = `assignments`.`studentID` and `assignments`.`classID` = `classes`.`classID` and `assignments`.`classID` = `current_class`(`users`.`userID`))) group by `assignments`.`studentID` ;

-- --------------------------------------------------------

--
-- Structure for view `student_classcoors`
--
DROP TABLE IF EXISTS `student_classcoors`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_classcoors`  AS  select `assignments`.`studentID` AS `studentID`,if(`users`.`lastName` = '' or `users`.`lastName` is null,`users`.`firstName`,concat(`users`.`firstName`,' ',`users`.`lastName`)) AS `fullName`,`assignments`.`classID` AS `classID`,`classes`.`instructorID` AS `instructorID` from (`assignments` join (`users` join `classes`) on(`assignments`.`studentID` = `users`.`userID` and `assignments`.`classID` = `classes`.`classID`)) group by if(`users`.`lastName` = '' or `users`.`lastName` is null,`users`.`firstName`,concat(`users`.`firstName`,' ',`users`.`lastName`)) ;

-- --------------------------------------------------------

--
-- Structure for view `student_currentscores`
--
DROP TABLE IF EXISTS `student_currentscores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_currentscores`  AS  select `users`.`userID` AS `studentID`,if(`users`.`lastName` = '' or `users`.`lastName` is null,`users`.`firstName`,concat(`users`.`firstName`,' ',`users`.`lastName`)) AS `fullName`,`assignments`.`classID` AS `classID`,`classes`.`className` AS `className`,`assignments`.`subjectID` AS `subjectID`,`subjects`.`subjectName` AS `subjectName`,`assignments`.`assignmentScore` AS `assignment`,`assignments`.`midtermScore` AS `midterm`,`assignments`.`finaltermScore` AS `finalterm` from (`assignments` join ((`users` join `subjects`) join `classes`) on(`assignments`.`studentID` = `users`.`userID` and `assignments`.`subjectID` = `subjects`.`subjectID` and `assignments`.`classID` = `classes`.`classID` and `assignments`.`classID` = `current_class`(`assignments`.`studentID`))) order by `users`.`userID`,`assignments`.`classID`,`assignments`.`subjectID` ;

-- --------------------------------------------------------

--
-- Structure for view `subject_coors`
--
DROP TABLE IF EXISTS `subject_coors`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `subject_coors`  AS  select `subjects`.`subjectID` AS `subjectID`,`subjects`.`subjectName` AS `subjectName`,`subjects`.`coordinatorID` AS `coordinatorID`,if(`users`.`lastName` = '' or `users`.`lastName` is null,`users`.`firstName`,concat(`users`.`firstName`,' ',`users`.`lastName`)) AS `fullName` from (`subjects` join `users` on(`subjects`.`coordinatorID` = `users`.`userID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `teacher_subjects`
--
DROP TABLE IF EXISTS `teacher_subjects`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `teacher_subjects`  AS  select `teachers`.`teacherID` AS `teacherID`,if(`users`.`lastName` = '' or `users`.`lastName` is null,`users`.`firstName`,concat(`users`.`firstName`,' ',`users`.`lastName`)) AS `fullName`,`teachers`.`subjectID` AS `subjectID`,`subjects`.`subjectName` AS `subjectName`,`teachers`.`classID` AS `classID`,`classes`.`className` AS `className` from (`teachers` join ((`users` join `subjects`) join `classes`) on(`teachers`.`teacherID` = `users`.`userID` and `teachers`.`subjectID` = `subjects`.`subjectID` and `teachers`.`classID` = `classes`.`classID`)) order by 1 ;

-- --------------------------------------------------------

--
-- Structure for view `user_info`
--
DROP TABLE IF EXISTS `user_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_info`  AS  select `users`.`userID` AS `userID`,if(`users`.`lastName` = '' or `users`.`lastName` is null,`users`.`firstName`,concat(`users`.`firstName`,' ',`users`.`lastName`)) AS `fullName`,`users`.`dob` AS `dob`,`users`.`email` AS `email`,`users`.`genderID` AS `genderID`,`genders`.`genderName` AS `genderName`,`users`.`roleID` AS `roleID`,`roles`.`roleName` AS `roleName` from (`users` join (`genders` join `roles`) on(`users`.`genderID` = `genders`.`genderID` and `users`.`roleID` = `roles`.`roleID`)) order by `users`.`userID` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`studentID`,`subjectID`,`classID`) USING BTREE,
  ADD KEY `subjectID` (`subjectID`),
  ADD KEY `classID` (`classID`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`classID`),
  ADD KEY `instructorID` (`instructorID`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`genderID`);

--
-- Indexes for table `reqeditprofile`
--
ALTER TABLE `reqeditprofile`
  ADD PRIMARY KEY (`notificationID`),
  ADD KEY `targetID` (`targetID`);

--
-- Indexes for table `reqreview`
--
ALTER TABLE `reqreview`
  ADD PRIMARY KEY (`notificationID`),
  ADD KEY `targetID` (`targetID`),
  ADD KEY `subjectID` (`subjectID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subjectID`),
  ADD KEY `coordinatorID` (`coordinatorID`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacherID`,`subjectID`,`classID`) USING BTREE,
  ADD KEY `classID` (`classID`),
  ADD KEY `subjectID` (`subjectID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `roleID` (`roleID`),
  ADD KEY `genderID` (`genderID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `classID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `genderID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reqeditprofile`
--
ALTER TABLE `reqeditprofile`
  MODIFY `notificationID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reqreview`
--
ALTER TABLE `reqreview`
  MODIFY `notificationID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roleID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subjectID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `assignments_ibfk_2` FOREIGN KEY (`subjectID`) REFERENCES `subjects` (`subjectID`),
  ADD CONSTRAINT `assignments_ibfk_3` FOREIGN KEY (`classID`) REFERENCES `classes` (`classID`);

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`instructorID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `reqeditprofile`
--
ALTER TABLE `reqeditprofile`
  ADD CONSTRAINT `reqeditprofile_ibfk_1` FOREIGN KEY (`targetID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `reqreview`
--
ALTER TABLE `reqreview`
  ADD CONSTRAINT `reqreview_ibfk_1` FOREIGN KEY (`targetID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `reqreview_ibfk_2` FOREIGN KEY (`subjectID`) REFERENCES `subjects` (`subjectID`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`coordinatorID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`classID`) REFERENCES `classes` (`classID`),
  ADD CONSTRAINT `teachers_ibfk_2` FOREIGN KEY (`subjectID`) REFERENCES `subjects` (`subjectID`),
  ADD CONSTRAINT `teachers_ibfk_3` FOREIGN KEY (`teacherID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `roles` (`roleID`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`genderID`) REFERENCES `genders` (`genderID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
