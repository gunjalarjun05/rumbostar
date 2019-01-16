-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2016 at 11:04 AM
-- Server version: 5.6.33-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rumbostar`
--

-- --------------------------------------------------------

--
-- Table structure for table `rs_users`
--

CREATE TABLE IF NOT EXISTS `rs_users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `users_name` varchar(300) NOT NULL,
  `users_email` varchar(300) NOT NULL,
  `users_psw` varchar(300) NOT NULL,
  `users_num` bigint(20) NOT NULL,
  `users_reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_updated_date` timestamp NULL,
  `users_status` enum('ACTIVE','DACTIVE','','') NOT NULL DEFAULT 'DACTIVE',
  `users_verification_code` varchar(255) NOT NULL,
  `users_type` enum('ADMIN','USER','','') NOT NULL DEFAULT 'USER',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `rs_users`
--

INSERT INTO `rs_users` (`user_id`, `users_name`, `users_email`, `users_psw`, `users_num`, `users_reg_date`, `users_updated_date`, `users_status`, `users_verification_code`, `users_type`) VALUES
(1, 'Gaurav Gandhi', 'gauravsgandhi@gmail.com', '25f9e794323b453885f5181f1b624d0b', 9699718107, '2016-12-02 12:59:56', '2016-12-02 12:59:56', 'DACTIVE', '', 'USER');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
