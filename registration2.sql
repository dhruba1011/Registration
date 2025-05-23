-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2025 at 06:08 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registration2`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  `session` varchar(3) DEFAULT NULL,
  `course` varchar(10) DEFAULT NULL,
  `batch` varchar(10) DEFAULT NULL,
  `regno` varchar(25) DEFAULT NULL,
  `class_days` varchar(20) DEFAULT NULL,
  `class_times` varchar(20) DEFAULT NULL,
  `sname` varchar(30) DEFAULT NULL,
  `fname` varchar(30) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `cast` varchar(10) DEFAULT NULL,
  `phone1` varchar(10) DEFAULT NULL,
  `phone2` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `last_exam` varchar(10) DEFAULT NULL,
  `mp_mark` int(11) DEFAULT NULL,
  `hs_mark` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`session`, `course`, `batch`, `regno`, `class_days`, `class_times`, `sname`, `fname`, `gender`, `cast`, `phone1`, `phone2`, `dob`, `last_exam`, `mp_mark`, `hs_mark`) VALUES
('76', 'CITA', '25051', '7600001', 'MON-THR', '8AM-10AM', 'parimal biswas', 'sanjay biswas', 'MALE', 'GENERAL', '1234567890', '1234567890', NULL, 'mp', 52, 0),
('77', 'ADFAS', '', '7600001', 'TUE-FRI', '', 'Gparimal biswas', 'Tsanjay biswas', 'MALE', 'GENERAL', '1234567890', '1234567890', '2000-05-04', 'mp', 56, 66),
('77', 'CDTA', '6666', '56-780000', 'MON-THR', '', 'Hhhh', 'Thhhhh', 'MALE', 'OBC', '5555555', '6666666', '2025-04-09', 'HS', 36, 36),
('77', 'CDTA', '6666', '56-780000', 'MON-THR', '', 'Hhhh', 'Thhhhh', 'MALE', 'OBC', '5555555', '6666666', '2025-04-09', 'HS', 36, 36),
('77', 'DDTA', 'Yy', '56-780000', 'WED-SAT', '4PM-6PM', 'Yfgg', 'Thhhhh', 'FEMALE', 'ST', '5555555', '6666666', '2025-04-15', 'GRADUATION', 25, 22),
('77', 'DDTA', 'Yy', '56-780000', 'WED-SAT', '4PM-6PM', 'Yfgg', 'Thhhhh', 'FEMALE', 'ST', '5555555', '6666666', '2025-04-15', 'GRADUATION', 25, 22),
('77', 'ADFAS', '25051', '7600001', 'MON-THR', '6PM-8PM', 'parimal biswas', 'sanjay biswas', 'MALE', 'GEN', '1234567890', '1234567890', '2025-04-09', 'HS', 66, 55),
('77', 'ADFAS', '25051', '7600001', 'MON-THR', '6PM-8PM', 'parimal biswas', 'sanjay biswas', 'MALE', 'GEN', '1234567890', '1234567890', '2025-04-09', 'HS', 66, 55),
('77', 'DDTA', 'Yy', '56-780000', 'WED-SAT', '4PM-6PM', 'Yfgg', 'Thhhhh', 'FEMALE', 'ST', '5555555', '6666666', '2025-04-15', 'GRADUATION', 25, 22),
('77', 'cdta', '24001', '7600001', 'MON-THR', '2PM-4PM', 'parimal biswas', 'sanjay biswas', 'FEMALE', 'GEN', '1234567890', '1234567890', '2025-04-11', 'HS', 55, 55),
('77', 'cita', '25001', '7600001', 'MON-THR', '2PM-4PM', 'parimal biswas', 'sanjay biswas', 'FEMALE', 'GEN', '1234567890', '1234567890', '2025-04-03', 'HS', 66, 66),
('77', 'dfas', '33001', '7600001', 'MON-THR', '2PM-4PM', 'parimal biswas', 'sanjay biswas', 'MALE', 'GEN', '1234567890', '1234567890', '2025-04-05', 'HS', 18, 30),
('77', 'ddta', '34001', '56-780000', 'WED-SAT', '6PM-8PM', 'Yfgg', 'Thhhhh', 'MALE', 'ST', '5555555', '6666666', '2025-04-09', 'MP', 18, 30),
('77', 'CITA', '25001', 'YS-HBA/78-7500123/20', 'MON-THR', '2PM-4PM', 'PARIMAL BISWAS', 'TSANJAY BISWAS', 'MALE', 'SC', '1234567890', '1234567890', '2025-05-06', 'MP', 99, 99),
('77', 'ADFAS', '43001', 'YS-HBA/ttt', 'MON-THR', '4PM-6PM', 'TT', 'TT', 'MALE', 'SC', '1234567890', '1234567890', '2025-05-08', 'MP', 55, 55),
('77', 'CITA', '25001', 'YS-HBA/78-7507723/2026', 'MON-THR', '4PM-6PM', 'PARIMAL BISWAS', 'SANJAY BISWAS', 'MALE', 'SC', '1234567890', '1234567890', '2025-04-25', 'HS', 88, 88),
('77', 'ADITA', '45002', 'YS-HBA/77-7700125/2025', 'MON-THR', '2PM-4PM', 'SITARAMAN', 'VEDANT', 'MALE', 'GEN', '123456789', '123456888', '2004-05-11', 'HS', 56, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `session` varchar(3) DEFAULT NULL,
  `cita` varchar(50) DEFAULT NULL,
  `dita` varchar(50) DEFAULT NULL,
  `adita` varchar(50) DEFAULT NULL,
  `cdta` varchar(50) DEFAULT NULL,
  `ddta` varchar(50) DEFAULT NULL,
  `cfas` varchar(50) DEFAULT NULL,
  `dfas` varchar(50) DEFAULT NULL,
  `adfas` varchar(50) DEFAULT NULL,
  `cdtp` varchar(50) DEFAULT NULL,
  `ddtp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--
insert INTO `settings` (`session`, `cita`, `dita`, `adita`, `cdta`, `ddta`, `cfas`, `dfas`, `adfas`, `cdtp`, `ddtp`) VALUES
('77', '25001', '35001', '45001', '24001', NULL, '23001', '33001', '43001', '22001', '32001');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
