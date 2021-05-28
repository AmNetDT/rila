-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 28, 2021 at 02:42 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `riladb`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_history`
--

DROP TABLE IF EXISTS `academic_history`;
CREATE TABLE IF NOT EXISTS `academic_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT (0),
  `school` varchar(50) DEFAULT '',
  `from` varchar(50) DEFAULT '',
  `to` varchar(50) DEFAULT '',
  `field_of_study` varchar(50) DEFAULT '',
  `qulification_received` varchar(100) DEFAULT '',
  `when_` int DEFAULT (0),
  `modify` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

DROP TABLE IF EXISTS `employer`;
CREATE TABLE IF NOT EXISTS `employer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) DEFAULT (_utf8mb4''),
  `when_` int DEFAULT (0),
  `name` varchar(50) DEFAULT (_utf8mb4''),
  `occupation` varchar(50) DEFAULT (_utf8mb4''),
  `position` varchar(50) DEFAULT (_utf8mb4''),
  `job_description` varchar(50) DEFAULT (_utf8mb4''),
  `office_address` varchar(50) DEFAULT (_utf8mb4''),
  `phone` varchar(50) DEFAULT (_utf8mb4''),
  `modify` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT (0),
  `filename` varchar(100) DEFAULT '',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

DROP TABLE IF EXISTS `library`;
CREATE TABLE IF NOT EXISTS `library` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ISBN` varchar(20) DEFAULT '',
  `title` varchar(100) DEFAULT '',
  `author` varchar(50) DEFAULT '',
  `category` varchar(50) DEFAULT '',
  `quatity` varchar(50) DEFAULT '',
  `added_by` varchar(11) DEFAULT '',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT '',
  `address` text,
  `phone` varchar(25) DEFAULT '',
  `email` varchar(100) DEFAULT '',
  `added_by` varchar(11) DEFAULT '',
  `created` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `address`, `phone`, `email`, `added_by`) VALUES
(3, 'RCCG', 'Ibadan Exp', '09012345678', 'asd@yahoo.com', 'E012345'),
(4, 'Victoria Island', 'Victoria Island, Lagos. ', '09087654321', 'asdf@jkl.com', 'E012345'),
(20, 'Isherri District', 'Isherri - Berger', '08123454321', 'amnetdt@yahoo.com', 'E012345'),
(21, 'Ijebu Ode', 'Plot 2, Imagbon Community, Ita-Oluwo, ikorodu, Lagos', '08135277641', 'amnetdt@yahoo.com', 'E012345'),
(22, 'Ibadan', 'KM 28, Lekki - Epe Expr Way', '00000000000', 'jean.khalil@greatbrandsng.com', 'E012345');

-- --------------------------------------------------------

--
-- Table structure for table `next_of_kin`
--

DROP TABLE IF EXISTS `next_of_kin`;
CREATE TABLE IF NOT EXISTS `next_of_kin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT (_utf8mb4''),
  `phone` varchar(25) DEFAULT (_utf8mb4''),
  `address` varchar(255) DEFAULT (_utf8mb4''),
  `relationship` varchar(50) DEFAULT (_utf8mb4''),
  `modify` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(30) DEFAULT '',
  `payment_type` varchar(30) DEFAULT '',
  `amount` decimal(15,2) DEFAULT (0.00),
  `paid` decimal(15,2) DEFAULT (0.00),
  `balance` decimal(15,2) DEFAULT (0.00),
  `remark` varchar(30) DEFAULT '',
  `added_by` varchar(11) DEFAULT '',
  `status` int DEFAULT '0',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

DROP TABLE IF EXISTS `payment_type`;
CREATE TABLE IF NOT EXISTS `payment_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `added_by` varchar(10) DEFAULT '',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`id`, `name`, `added_by`) VALUES
(1, 'Tutorial', 'E012345'),
(2, 'Matriculation', 'E012345'),
(3, 'Graduation', 'E012345');

-- --------------------------------------------------------

--
-- Table structure for table `programmes`
--

DROP TABLE IF EXISTS `programmes`;
CREATE TABLE IF NOT EXISTS `programmes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `school_id` varchar(50) DEFAULT '',
  `programme` varchar(50) DEFAULT '',
  `modify` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

DROP TABLE IF EXISTS `regions`;
CREATE TABLE IF NOT EXISTS `regions` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT (_utf8mb4''),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

DROP TABLE IF EXISTS `schools`;
CREATE TABLE IF NOT EXISTS `schools` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(20) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `type`) VALUES
(1, 'Master'),
(2, 'Degree'),
(3, 'Special Course'),
(4, 'All');

-- --------------------------------------------------------

--
-- Table structure for table `staff_record`
--

DROP TABLE IF EXISTS `staff_record`;
CREATE TABLE IF NOT EXISTS `staff_record` (
  `id` int NOT NULL AUTO_INCREMENT,
  `member_id` varchar(11) DEFAULT (_utf8mb4''),
  `firstname` varchar(30) DEFAULT '',
  `lastname` varchar(30) DEFAULT '',
  `othername` varchar(30) DEFAULT '',
  `category` varchar(100) DEFAULT '',
  `designation` varchar(100) DEFAULT '',
  `phone` varchar(25) DEFAULT '',
  `email` varchar(100) DEFAULT '',
  `schools` varchar(100) DEFAULT '',
  `location` varchar(255) DEFAULT '',
  `added_by` varchar(11) DEFAULT '',
  `image` varchar(100) DEFAULT (_utf8mb4''),
  `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `staff_record`
--

INSERT INTO `staff_record` (`id`, `member_id`, `firstname`, `lastname`, `othername`, `category`, `designation`, `phone`, `email`, `schools`, `location`, `added_by`, `image`, `created`) VALUES
(1, 'EF01234', '', '', '', '', '', '', '', '', '', 'E012345', '', '2021-05-23 17:21:37'),
(2, 'EC01234', '', '', '', '', '', '', '', '', '', 'E012345', '', '2021-05-23 17:20:53'),
(3, 'EL01234', '', '', '', '', '', '', '', '', '', 'E012345', '', '2021-05-23 17:22:19'),
(4, 'E012345', '', '', '', '', '', '', '', '', '', 'E012345', '', '2021-05-27 19:00:09'),
(5, 'EC00123', '', '', '', '', '', '', '', '', '', 'E012345', '', '2021-05-28 15:06:15');

-- --------------------------------------------------------

--
-- Table structure for table `students_record`
--

DROP TABLE IF EXISTS `students_record`;
CREATE TABLE IF NOT EXISTS `students_record` (
  `id` int NOT NULL AUTO_INCREMENT,
  `member_id` varchar(11) DEFAULT '',
  `matric_no` varchar(30) DEFAULT (_utf8mb4''),
  `firstname` varchar(30) DEFAULT '',
  `lastname` varchar(30) DEFAULT '',
  `othername` varchar(30) DEFAULT '',
  `date_of_Birth` varchar(30) DEFAULT (_utf8mb4''),
  `place_of_Birth` varchar(30) DEFAULT (_utf8mb4''),
  `nationality` varchar(50) DEFAULT (_utf8mb4''),
  `state_of_origin` varchar(50) DEFAULT (_utf8mb4''),
  `LGA` varchar(100) DEFAULT (_utf8mb4''),
  `marital` varchar(30) DEFAULT (_utf8mb4''),
  `spouse_name` varchar(50) DEFAULT (_utf8mb4''),
  `maiden_name` varchar(50) DEFAULT (_utf8mb4''),
  `date_married` varchar(50) DEFAULT (_utf8mb4''),
  `no_of_children` varchar(11) DEFAULT (_utf8mb4''),
  `phone` varchar(25) DEFAULT '',
  `email` varchar(100) DEFAULT '',
  `schools` varchar(100) DEFAULT '',
  `location` varchar(255) DEFAULT '',
  `course_duration` varchar(30) DEFAULT (_utf8mb4''),
  `added_by` varchar(11) DEFAULT '',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students_record`
--

INSERT INTO `students_record` (`id`, `member_id`, `matric_no`, `firstname`, `lastname`, `othername`, `date_of_Birth`, `place_of_Birth`, `nationality`, `state_of_origin`, `LGA`, `marital`, `spouse_name`, `maiden_name`, `date_married`, `no_of_children`, `phone`, `email`, `schools`, `location`, `course_duration`, `added_by`, `created`, `image`) VALUES
(1, 'S012345', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'EC01234', '0000-00-00 00:00:00', ''),
(2, 'ST01234', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'EC01234', '2021-05-28 12:39:46', ''),
(3, 'ST01233', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'EC01234', '2021-05-28 14:47:43', ''),
(5, 'ST01222', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'EC01234', '2021-05-28 15:03:34', ''),
(6, 'ST01111', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'EC01234', '2021-05-28 15:04:29', ''),
(7, 'ST12000', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'EC00123', '2021-05-28 15:07:15', '');

-- --------------------------------------------------------

--
-- Table structure for table `syscategory`
--

DROP TABLE IF EXISTS `syscategory`;
CREATE TABLE IF NOT EXISTS `syscategory` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `syscategory`
--

INSERT INTO `syscategory` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Cordinator'),
(3, 'Finance'),
(4, 'Library'),
(5, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT (_utf8mb4''),
  `syscategory` int DEFAULT NULL,
  `added_by` varchar(10) DEFAULT '',
  `school` int DEFAULT NULL,
  `location` int DEFAULT NULL,
  `password` varchar(64) NOT NULL DEFAULT (_utf8mb4''),
  `salt` varchar(32) NOT NULL DEFAULT (_utf8mb4''),
  `joined` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `syscategory`, `added_by`, `school`, `location`, `password`, `salt`, `joined`) VALUES
('E012345', 1, 'E012345', 4, 3, '0b363e795210a771c0d5757cc2d8abb0cb866db6770b4e1339d0a57037aa68d7', '9f0c6aa1f825fe27e40f4045421dc671', '2021-05-17 14:53:00'),
('EC01234', 2, 'E012345', 4, 22, 'e08b6735497f812c97030f436ada043445a63d670a9e52a49888a2ce3acee10e', '4377cd99f1a8f9638f805448bbd1ecd2', '2021-05-23 16:20:53'),
('EF01234', 3, 'E012345', 4, 3, '6da9368b07dcdb9bbf09f9b6ab7c5bc8236b7fd1567314d87c8a53d1ca99eb60', '8818e7ba685a2c93c1212f0d6a3870e4', '2021-05-23 16:21:37'),
('EL01234', 4, 'E012345', 4, 3, 'd3960146a44be86cfbcbbea5c34aa8fb6cb7f633a48844fd4e9cbb9b27985d62', '7b8f502a614327a3e93c1170aa9a7963', '2021-05-23 16:22:19'),
('S012345', 5, 'EC01234', 1, 22, 'ce6832894a0dc7cd93fc5e219530f59593115fcd597c4d6cdcc1b5ff414dd801', 'f58714a12876f339281be82c80e2b10d', '2021-05-28 12:17:58'),
('ST01234', 5, 'EC01234', 1, 22, '98cefdabd0c130d5f0e3d7cad02ca90d14600a751a38c66cf8dd0d15ed11d98a', '1b0ed8aeb010bca2673110d7c1656f5d', '2021-05-28 14:55:04'),
('ST01233', 5, 'E012345', 1, 21, '4de50f1d206317cccf0f94ee06fcb35414adf3b6e4aaae1ec1894e327c658529', '06cf17055a1b6e5e5bf7eb5899035555', '2021-05-28 14:55:17'),
('ST01222', 5, 'EC01234', 1, 22, '480474efa37c8b43515bc2cad7ae80c76f05b2e8b4f7c7f0c84113657d406b3c', 'f0ef2ed3ee4e97832696aad0d1eeb784', '2021-05-28 14:03:34'),
('ST01111', 5, 'EC01234', 3, 22, '9fd9197c87f2c3fc7e5fb710992ddfd65425150f2b944faed64d18566b2a1ce0', '71eb3082958d36dc3c77e3a4c745b5bd', '2021-05-28 14:04:29'),
('EC00123', 2, 'E012345', 4, 21, '291d82a8e1b438a2c8188d709fe6702a7e22d928fb07ca1467f2d5985c2bb999', 'fb4c3c641ff8c3fe02c13682d2f4aad2', '2021-05-28 14:06:15'),
('ST12000', 5, 'EC00123', 2, 21, 'b30ab591e3b5567b17de4004f83867320fd8901eef18bfa05900cc05de34e0ff', '157f17a105e794888ec0403e62028ab4', '2021-05-28 14:07:15');

-- --------------------------------------------------------

--
-- Table structure for table `user_session`
--

DROP TABLE IF EXISTS `user_session`;
CREATE TABLE IF NOT EXISTS `user_session` (
  `id` int NOT NULL AUTO_INCREMENT,
  `member_id` int DEFAULT (0),
  `hash` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_session`
--

INSERT INTO `user_session` (`member_id`, `hash`) VALUES
(1, 'c2cd0d74a7bfc32bcf04d078a492f1a8f25655a6346310e8baae4f12b83fda56');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
