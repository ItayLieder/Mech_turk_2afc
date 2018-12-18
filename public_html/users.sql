-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2015 at 06:39 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `itay`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `worker_id` varchar(60) NOT NULL,
  `age` tinyint(3) unsigned NOT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `musical_experience` text NOT NULL,
  `creation_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `modification_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `worker_id`, `age`, `gender`, `musical_experience`, `creation_time`, `modification_time`, `active`) VALUES
(1, '13', 107, 'male', '0', '2015-10-28 00:00:00', '2015-10-28 19:04:51', 0),
(2, '1456', 107, '', '90 years', '2015-10-28 19:29:04', NULL, 1),
(3, '1456', 27, '', '90 years', '2015-10-28 19:29:16', NULL, 1),
(4, '', 0, '', '', '2015-10-28 19:30:55', NULL, 1),
(5, '', 0, '', '', '2015-10-28 19:31:03', NULL, 1),
(6, '', 0, '', '', '2015-10-28 19:31:41', NULL, 1),
(7, '', 0, '', '', '2015-10-28 19:32:58', NULL, 1),
(8, '', 0, '', '', '2015-10-28 19:33:03', NULL, 1),
(9, '6767', 28, '', '7.8', '2015-10-28 19:36:46', NULL, 1),
(10, '1234', 22, '', '3.4', '2015-10-28 19:38:21', NULL, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
