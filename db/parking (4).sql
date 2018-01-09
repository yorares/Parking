-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 21, 2017 at 10:59 AM
-- Server version: 5.7.19
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
-- Database: `parking`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `date_sent` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_read` datetime DEFAULT NULL,
  `user_id_recive` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_id_recive` (`user_id_recive`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `user_id`, `content`, `date_sent`, `date_read`, `user_id_recive`) VALUES
(2, 2, 'adwdwa', '2007-10-20 15:11:12', '2017-12-20 13:23:31', 2),
(3, 3, 'adwdwa', '2007-10-20 15:11:12', '2017-12-20 13:48:14', 2),
(4, 3, 'adwdasdaswa', '2007-10-20 15:11:12', '2007-10-20 15:11:15', 2),
(5, 3, 'adwdasdaswa', '2007-11-20 15:11:12', '2007-10-20 15:11:15', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ip_address`
--

DROP TABLE IF EXISTS `ip_address`;
CREATE TABLE IF NOT EXISTS `ip_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ip_address` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parking`
--

DROP TABLE IF EXISTS `parking`;
CREATE TABLE IF NOT EXISTS `parking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` int(10) NOT NULL,
  `longitude` double NOT NULL,
  `latitude` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `parking_num` int(100) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `details` varchar(500) NOT NULL,
  `reserved` enum('1','0') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parking`
--

INSERT INTO `parking` (`id`, `price`, `longitude`, `latitude`, `user_id`, `parking_num`, `start_date`, `end_date`, `details`, `reserved`) VALUES
(1, 250, 450, 480, 2, 25, '2007-10-20 10:11:12', '2007-10-20 15:11:12', 'dau in chirie', '0'),
(2, 200, 121, 212, 2, 22, '2007-10-20 10:11:12', '2007-10-20 10:11:13', 'asdsada', '0'),
(3, 200, 5, 10, 2, 25, '2007-10-20 10:11:12', '2007-10-20 10:11:15', 'ftytyvbjhbytc', '0'),
(4, 200, 5, 10, 2, 25, '2007-10-20 10:11:12', '2007-10-20 10:11:15', 'ftytyvbjhbytc', '0'),
(5, 200, 5, 10, 2, 25, '2007-10-20 10:11:12', '2007-10-20 10:11:15', 'ftytyvbjhbytc', '0'),
(6, 200, 5, 10, 2, 25, '2007-10-20 10:11:12', '2007-10-20 10:11:15', 'ftytyvbjhbytc', '0'),
(7, 200, 5, 10, 2, 25, '2007-10-20 10:11:12', '2007-10-20 10:11:15', 'ftytyvbjhbytc', '0'),
(8, 200, 5, 10, 2, 25, '2007-10-20 10:11:12', '2007-10-20 10:11:15', 'ftytyvbjhbytc', '0');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parking_id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `car_number` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parking_id` (`parking_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `parking_id`, `user_id`, `car_number`, `price`, `payment_date`) VALUES
(2, 1, 2, 'run', 200, '2007-10-20 15:11:12'),
(3, 1, 2, 'run', 250, '2017-12-19 13:06:13'),
(4, 1, 2, 'ruan', 250, '2017-12-19 13:22:09');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stars_number` int(11) NOT NULL,
  `total_num_reviews` int(200) DEFAULT NULL,
  `message` varchar(1000) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_id_receive` int(200) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parking_id` int(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_id_recive` (`user_id_receive`),
  KEY `parking_id` (`parking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `stars_number`, `total_num_reviews`, `message`, `user_id`, `user_id_receive`, `creation_date`, `parking_id`) VALUES
(1, 5, 1, 'brovo mai', 2, 1, '2017-12-14 09:51:34', 1),
(2, 2, 1, 'brovo mai2', 3, 1, '2017-12-14 07:51:35', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(127) NOT NULL,
  `last_name` varchar(127) NOT NULL,
  `user_name` varchar(127) NOT NULL,
  `email` varchar(200) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NULL DEFAULT NULL,
  `user_status` enum('online','offline') NOT NULL DEFAULT 'offline',
  `role` enum('user','admin','quest') NOT NULL DEFAULT 'user',
  `password` varchar(500) NOT NULL,
  `birth_date` date NOT NULL,
  `phone` int(11) NOT NULL,
  `picture_link` varchar(200) DEFAULT NULL,
  `user_ip` varchar(30) DEFAULT NULL,
  `active` enum('banned','unbanned') NOT NULL DEFAULT 'unbanned',
  `ban_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `user_name`, `email`, `creation_date`, `last_login`, `user_status`, `role`, `password`, `birth_date`, `phone`, `picture_link`, `user_ip`, `active`, `ban_time`) VALUES
(2, 'Rares', 'Puscas', 'yorares30', 'rares@gmail.com', '2017-12-12 11:16:25', '2017-12-20 11:27:03', 'online', 'admin', '$5$rounds=5000$usesomes2343ilas$iZeZPEhQmOY3Rb/ykPPTijt/7UNqmw1JD1mgXWjXwnD', '2000-10-11', 741058260, NULL, '::1', 'unbanned', '2017-12-13 12:54:53'),
(3, 'Rares', 'Puscas', 'yorareadwads30', 'raradawdes@gmail.com', '2017-12-12 11:20:27', NULL, 'offline', 'user', '$5$rounds=5000$usesomes2343ilas$iZeZPEhQmOY3Rb/ykPPTijt/7UNqmw1JD1mgXWjXwnD', '2000-10-11', 741058260, NULL, '::1', 'unbanned', NULL),
(5, 'Rares', 'Puscas', 'yorares302', 'awdararadawdes@gmail.com', '2017-12-20 12:05:03', NULL, 'offline', 'user', '$5$rounds=5000$usesomes2343ilas$iZeZPEhQmOY3Rb/ykPPTijt/7UNqmw1JD1mgXWjXwnD', '2000-10-11', 741058260, NULL, '::1', 'unbanned', NULL),
(6, 'Rares', 'Puscas', 'yorares2', 'wdes@gmail.com', '2017-12-20 12:06:11', NULL, 'offline', 'user', '$5$rounds=5000$usesomes2343ilas$iZeZPEhQmOY3Rb/ykPPTijt/7UNqmw1JD1mgXWjXwnD', '2000-10-11', 741058260, NULL, '::1', 'unbanned', NULL),
(7, 'Rares', 'Puscas', 'yorares3', 'wdeks@gmail.com', '2017-12-20 12:07:00', NULL, 'offline', 'user', '$5$rounds=5000$usesomes2343ilas$iZeZPEhQmOY3Rb/ykPPTijt/7UNqmw1JD1mgXWjXwnD', '1000-10-11', 741058260, NULL, '::1', 'unbanned', NULL),
(8, 'Rares', 'Puscas', 'yorares4', 'wdeksd@gmail.com', '2017-12-20 12:10:37', NULL, 'offline', 'user', '$5$rounds=5000$usesomes2343ilas$iZeZPEhQmOY3Rb/ykPPTijt/7UNqmw1JD1mgXWjXwnD', '1000-10-21', 741058260, NULL, '::1', 'unbanned', NULL),
(9, 'Rares', 'Puscas', 'yorares5', 'wdekssd@gmail.com', '2017-12-20 12:11:36', NULL, 'offline', 'user', '$5$rounds=5000$usesomes2343ilas$iZeZPEhQmOY3Rb/ykPPTijt/7UNqmw1JD1mgXWjXwnD', '1000-10-21', 741058260, NULL, '::1', 'unbanned', NULL),
(10, 'Rares', 'Puscas', 'yorares6', 'wdekssjd@gmail.com', '2017-12-20 12:12:46', NULL, 'offline', 'user', '$5$rounds=5000$usesomes2343ilas$iZeZPEhQmOY3Rb/ykPPTijt/7UNqmw1JD1mgXWjXwnD', '1000-10-21', 741058260, NULL, '::1', 'unbanned', NULL),
(11, 'Rares', 'Puscas', 'yorares7', 'wdjd@gmail.com', '2017-12-20 12:13:31', NULL, 'offline', 'user', '$5$rounds=5000$usesomes2343ilas$iZeZPEhQmOY3Rb/ykPPTijt/7UNqmw1JD1mgXWjXwnD', '1000-10-21', 741058260, NULL, '::1', 'unbanned', NULL),
(12, 'Rares', 'Puscas', 'yorares8', 'wdjdjjj@gmail.com', '2017-12-20 12:16:33', NULL, 'offline', 'user', '$5$rounds=5000$usesomes2343ilas$iZeZPEhQmOY3Rb/ykPPTijt/7UNqmw1JD1mgXWjXwnD', '1901-10-21', 741058260, NULL, '::1', 'unbanned', NULL),
(13, 'Rares', 'Puscas', 'yorares9', 'wdjdjjdrgj@gmail.com', '2017-12-20 12:17:05', NULL, 'offline', 'user', '$5$rounds=5000$usesomes2343ilas$iZeZPEhQmOY3Rb/ykPPTijt/7UNqmw1JD1mgXWjXwnD', '2017-10-21', 741058260, NULL, '::1', 'unbanned', NULL),
(14, 'Rares', 'Puscas', 'yorares10', 'wdjdjjzdfdrgj@gmail.com', '2017-12-20 12:19:29', NULL, 'offline', 'user', '$5$rounds=5000$usesomes2343ilas$iZeZPEhQmOY3Rb/ykPPTijt/7UNqmw1JD1mgXWjXwnD', '2000-10-21', 741058260, NULL, '::1', 'unbanned', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`user_id_recive`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ip_address`
--
ALTER TABLE `ip_address`
  ADD CONSTRAINT `ip_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parking`
--
ALTER TABLE `parking`
  ADD CONSTRAINT `parking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_ibfk_3` FOREIGN KEY (`parking_id`) REFERENCES `parking` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
