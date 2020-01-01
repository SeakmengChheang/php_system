-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 01, 2020 at 02:51 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `academic` varchar(20) NOT NULL,
  `semester` tinyint(3) UNSIGNED NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `courseCode` varchar(20) NOT NULL,
  `cgId` int(11) NOT NULL,
  `courseDescription` text NOT NULL,
  `createdBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `academic`, `semester`, `courseName`, `courseCode`, `cgId`, `courseDescription`, `createdBy`) VALUES
(86, '2019-2020', 3, 'Data Structures and Algorithms', 'CS 201', 3, 'Term 1: CS 2  (3 cr)', 2),
(148, '2018-2019', 2, 'Java', 'MIS 230', 3, 'Java programming language for MIS', 5),
(150, '2019-2020', 1, 'C++ Programming', 'CS 125', 4, 'N/A', 5),
(154, '2019-2020', 7, 'C++ Advance', 'CS 126', 3, 'N/A', 5),
(155, '2017-2018', 1, 'Web', 'CS 260', 1, 'N/A', 5),
(159, '2019-2020', 1, 'Web Development', 'CS 230', 3, 'asd', 5),
(161, '2019-2020', 1, 'Artificial Intelligence', 'CS 340', 3, 'N/A', 5),
(162, '2019-2020', 1, 'web1', 'CS 128', 1, 'asd', 5),
(163, '2019-2020', 4, 'Web Development - Advance', 'CS 200', 3, 'ABS', 5);

--
-- Triggers `course`
--
DELIMITER $$
CREATE TRIGGER `before_delete` BEFORE DELETE ON `course` FOR EACH ROW BEGIN
DELETE FROM student WHERE student.courseId = old.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `course_group`
--

CREATE TABLE `course_group` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_group`
--

INSERT INTO `course_group` (`id`, `name`) VALUES
(1, 'Business'),
(2, 'Economic'),
(3, 'Programming'),
(4, 'Engineering');

-- --------------------------------------------------------

--
-- Stand-in structure for view `course_view`
-- (See below for the actual view)
--
CREATE TABLE `course_view` (
`id` int(11)
,`academic` varchar(20)
,`semester` tinyint(3) unsigned
,`course_name` varchar(255)
,`course_code` varchar(20)
,`course_group` varchar(50)
,`course_desc` text
,`author` varchar(100)
,`created_by` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffId` int(11) NOT NULL,
  `position` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffId`, `position`) VALUES
(2, 'Instructor'),
(5, 'Instructor');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentId` int(11) NOT NULL,
  `courseId` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentId`, `courseId`) VALUES
(6, 86),
(4, 148),
(4, 86),
(4, 150),
(8, 148),
(8, 154),
(8, 86),
(9, 154),
(9, 86),
(4, 162);

--
-- Triggers `student`
--
DELIMITER $$
CREATE TRIGGER `check_stuId_cId_same` BEFORE INSERT ON `student` FOR EACH ROW BEGIN
	DECLARE cnt INT;
	SET cnt = (SELECT COUNT(*) FROM student WHERE studentId = new.studentId AND courseId = new.courseId);
    IF cnt = 1 THEN
    	SET new.studentId = NULL;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `fullName`, `role`) VALUES
(2, 'vheng2', 'vheng2', 'vheng2', 'staff'),
(4, 'meng', 'meng', 'Seakmeng Chheang', 'student'),
(5, 'mengs', 'meng', 'Seakmeng Chheang2', 'staff'),
(6, 'seakmeng', 'meng', 'Raymond', 'student'),
(8, 'meng1', 'meng', 'MengA', 'student'),
(9, 'schheang', '1234', 'Baby', 'student');

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `before_del_user` BEFORE DELETE ON `user` FOR EACH ROW BEGIN 
IF (old.role = "staff") THEN 
	DELETE FROM staff WHERE staff.staffId = old.id;
    DELETE FROM course WHERE old.id = course.createdBy;
ELSE IF (old.role = "student") THEN
	DELETE FROM student WHERE old.id = student.studentId;
END IF;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure for view `course_view`
--
DROP TABLE IF EXISTS `course_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `course_view`  AS  select `c`.`id` AS `id`,`c`.`academic` AS `academic`,`c`.`semester` AS `semester`,`c`.`courseName` AS `course_name`,`c`.`courseCode` AS `course_code`,`cg`.`name` AS `course_group`,`c`.`courseDescription` AS `course_desc`,`user`.`fullName` AS `author`,`c`.`createdBy` AS `created_by` from ((`course` `c` join `course_group` `cg` on(`cg`.`id` = `c`.`cgId`)) join `user` on(`user`.`id` = `c`.`createdBy`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courseName` (`courseName`),
  ADD UNIQUE KEY `courseCode` (`courseCode`),
  ADD KEY `cgId` (`cgId`),
  ADD KEY `createdBy` (`createdBy`);

--
-- Indexes for table `course_group`
--
ALTER TABLE `course_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD KEY `staffId` (`staffId`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD KEY `studentId` (`studentId`),
  ADD KEY `courseId` (`courseId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `username_2` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `course_group`
--
ALTER TABLE `course_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`cgId`) REFERENCES `course_group` (`id`),
  ADD CONSTRAINT `course_ibfk_2` FOREIGN KEY (`createdBy`) REFERENCES `user` (`id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`staffId`) REFERENCES `user` (`id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`studentId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`courseId`) REFERENCES `course` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
