-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 13, 2017 at 09:36 AM
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

-- --
-- -- Table structure for table `chat`
-- --



-- --------------------------------------------------------

--
-- Table structure for table `parking`
--

DROP TABLE IF EXISTS `parking`;
CREATE TABLE IF NOT EXISTS `parking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `longitude` double NOT NULL,
  `latitude` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_number` varchar(10) NOT NULL,
  `nr_parcare` int(100) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `details` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parking_id` int(11) NOT NULL,
  `price` int(10) NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parking_id` (`parking_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `starts_numbers` int(11) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `user_id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `admin` enum('user','admin','quest') NOT NULL DEFAULT 'user',
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `user_name`, `email`, `creation_date`, `last_login`, `user_status`, `admin`, `password`, `birth_date`, `phone`, `picture_link`, `user_ip`, `active`, `ban_time`) VALUES
(2, 'Rares', 'Puscas', 'yorares30', 'rares@gmail.com', '2017-12-12 11:16:25', NULL, 'online', 'user', '$5$rounds=5000$usesomes2343ilas$iZeZPEhQmOY3Rb/ykPPTijt/7UNqmw1JD1mgXWjXwnD', '2000-10-11', 741058260, NULL, '::1', 'unbanned', NULL),
(3, 'Rares', 'Puscas', 'yorareadwads30', 'raradawdes@gmail.com', '2017-12-12 11:20:27', NULL, 'offline', 'user', '$5$rounds=5000$usesomes2343ilas$iZeZPEhQmOY3Rb/ykPPTijt/7UNqmw1JD1mgXWjXwnD', '2000-10-11', 741058260, NULL, '::1', 'unbanned', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
