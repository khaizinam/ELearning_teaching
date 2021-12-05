-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2021 at 09:49 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `ID` decimal(7,0) NOT NULL,
  `f_name` varchar(225) NOT NULL,
  `l_name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `ID` varchar(10) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `name` varchar(225) NOT NULL,
  `maximum` int(5) NOT NULL,
  `subjectID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`ID`, `semester`, `name`, `maximum`, `subjectID`) VALUES
('1', '201', 'L05', 50, 'CO1003'),
('2', '201', 'DT01', 40, 'CO1003');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `ID` int(10) NOT NULL,
  `name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`ID`, `name`) VALUES
(1, 'Khoa Học Máy Tính CLC'),
(2, 'Kĩ Thuật máy tính'),
(5, 'Dệt may'),
(8, 'Vũ khí hóa học'),
(9, 'Thiên văn học'),
(10, 'Thiên tướng học'),
(11, 'Cơ khí'),
(12, 'Vũ trụ');

-- --------------------------------------------------------

--
-- Table structure for table `enrolls`
--

CREATE TABLE `enrolls` (
  `ID` int(10) NOT NULL,
  `semester` int(4) NOT NULL,
  `pupilID` decimal(7,0) NOT NULL,
  `subjectID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `ID` decimal(7,0) NOT NULL,
  `f_name` varchar(225) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `DepartmentID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`ID`, `f_name`, `l_name`, `DepartmentID`) VALUES
('1913445', 'Anna Phạm', 'Vương', 10),
('1913478', 'Jonny', 'Trí Nguyễn', 9),
('1913778', 'Nguyễn Hữu', 'Khải', 8);

-- --------------------------------------------------------

--
-- Table structure for table `publish`
--

CREATE TABLE `publish` (
  `ID` int(5) NOT NULL,
  `textbookID` decimal(13,0) NOT NULL,
  `publisherID` decimal(7,0) NOT NULL,
  `Date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `ID` decimal(7,0) NOT NULL,
  `name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pupil`
--

CREATE TABLE `pupil` (
  `ID` decimal(7,0) NOT NULL,
  `f_name` varchar(225) NOT NULL,
  `l_name` varchar(225) NOT NULL,
  `status` varchar(50) NOT NULL,
  `DepartmentID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pupil`
--

INSERT INTO `pupil` (`ID`, `f_name`, `l_name`, `status`, `DepartmentID`) VALUES
('1913778', 'Nguyễn Thanh', 'Xuân', 'Active', 10),
('1913779', 'Nguyễn Văn', 'Học', 'Active', 10),
('1917884', 'Nguyễn Thanh', 'Quyết', 'Active', 2);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `ID` varchar(10) NOT NULL,
  `name` varchar(225) NOT NULL,
  `credits` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`ID`, `name`, `credits`) VALUES
('CO1003', 'Cơ sở dữ Liệu', 4);

-- --------------------------------------------------------

--
-- Table structure for table `textbook`
--

CREATE TABLE `textbook` (
  `Isbn` decimal(13,0) NOT NULL,
  `title` varchar(225) NOT NULL,
  `file` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `subjectID` (`subjectID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `enrolls`
--
ALTER TABLE `enrolls`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `pupilID` (`pupilID`),
  ADD KEY `subjectID` (`subjectID`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `DepartmentID` (`DepartmentID`);

--
-- Indexes for table `publish`
--
ALTER TABLE `publish`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `textbookID` (`textbookID`),
  ADD KEY `publisherID` (`publisherID`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pupil`
--
ALTER TABLE `pupil`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `DepartmentID` (`DepartmentID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `textbook`
--
ALTER TABLE `textbook`
  ADD PRIMARY KEY (`Isbn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `enrolls`
--
ALTER TABLE `enrolls`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publish`
--
ALTER TABLE `publish`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`subjectID`) REFERENCES `subject` (`ID`);

--
-- Constraints for table `enrolls`
--
ALTER TABLE `enrolls`
  ADD CONSTRAINT `enrolls_ibfk_1` FOREIGN KEY (`pupilID`) REFERENCES `pupil` (`ID`),
  ADD CONSTRAINT `enrolls_ibfk_2` FOREIGN KEY (`subjectID`) REFERENCES `subject` (`ID`);

--
-- Constraints for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD CONSTRAINT `lecturer_ibfk_1` FOREIGN KEY (`DepartmentID`) REFERENCES `department` (`ID`);

--
-- Constraints for table `publish`
--
ALTER TABLE `publish`
  ADD CONSTRAINT `publish_ibfk_1` FOREIGN KEY (`textbookID`) REFERENCES `textbook` (`Isbn`),
  ADD CONSTRAINT `publish_ibfk_2` FOREIGN KEY (`publisherID`) REFERENCES `publisher` (`ID`);

--
-- Constraints for table `pupil`
--
ALTER TABLE `pupil`
  ADD CONSTRAINT `pupil_ibfk_1` FOREIGN KEY (`DepartmentID`) REFERENCES `department` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
