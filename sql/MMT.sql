-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 17, 2015 at 11:20 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mmt`
--
CREATE DATABASE IF NOT EXISTS `mmt` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mmt`;

-- --------------------------------------------------------

--
-- Table structure for table `acl`
--

CREATE TABLE IF NOT EXISTS `acl` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `description` text NOT NULL,
  `display_name` varchar(30) NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acl`
--

INSERT INTO `acl` (`id`, `name`, `description`, `display_name`, `link`) VALUES
(1, 'admin_view', 'View all admins', 'View Admins', 'admin_view.php'),
(2, 'admin_add', 'Add an admin', 'Add an Admin', 'admin_add.php'),
(3, 'admin_edit', 'Edit an admin', '', ''),
(4, 'admin_revoke', 'Invalidate secret key for admin', '', ''),
(5, 'admin_delete', 'Delete an admin', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `secret` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `salt` varchar(16) NOT NULL,
  `cookie` varchar(32) NOT NULL DEFAULT '',
  `last_login` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `secret`, `password`, `salt`, `cookie`, `last_login`) VALUES
(8, 'anshumanpattanayak@gmail.com', '7be1f7a994a0cb2d9921a19fef9c52ae', 'e5b725fd14b675a4085766f70883ba68', 'namak', '4841eb01d8b6d650d74929c5de860c82', 1439808554),
(10, 'zsonix27@gmail.com', 'b7774c0b872fbf4821e6960ea3911e33', 'e5b725fd14b675a4085766f70883ba68', 'namak', '', 1439690721);

-- --------------------------------------------------------

--
-- Table structure for table `admin_access`
--

CREATE TABLE IF NOT EXISTS `admin_access` (
  `admin_id` int(11) NOT NULL,
  `access_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_access`
--

INSERT INTO `admin_access` (`admin_id`, `access_id`) VALUES
(8, 1),
(8, 2),
(8, 3),
(8, 4),
(8, 5),
(10, 1),
(10, 4);

-- --------------------------------------------------------

--
-- Table structure for table `api`
--

CREATE TABLE IF NOT EXISTS `api` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `template_id` int(11) NOT NULL,
  `created_on` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `template_id` (`template_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `api`
--

INSERT INTO `api` (`id`, `code`, `name`, `template_id`, `created_on`) VALUES
(27, 'a9f6d', 'Dirty', 41, 1439809804);

-- --------------------------------------------------------

--
-- Table structure for table `api_params`
--

CREATE TABLE IF NOT EXISTS `api_params` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `api_id` (`template_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=112 ;

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE IF NOT EXISTS `campaign` (
  `id` varchar(11) NOT NULL,
  `secret_key` varchar(32) NOT NULL,
  `api_code` varchar(6) NOT NULL,
  `sender` text NOT NULL,
  `subject` text NOT NULL,
  `payload_length` int(11) NOT NULL,
  `payload_sent` int(11) NOT NULL DEFAULT '0',
  `mails_processed` int(11) NOT NULL DEFAULT '0',
  `time_started` int(11) NOT NULL,
  `time_finished` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`id`, `secret_key`, `api_code`, `sender`, `subject`, `payload_length`, `payload_sent`, `mails_processed`, `time_started`, `time_finished`) VALUES
('5d915a97d0', '7be1f7a994a0cb2d9921a19fef9c52ae', 'a9f6d', 'abc@gmail.com', 'Test mail', 4, 4, 4, 1439810130, 1439810457),
('70c33fd7b3', '7be1f7a994a0cb2d9921a19fef9c52ae', 'a9f6d', 'abc@gmail.com', 'Test mail', 4, 4, 4, 1439810051, 1439810457);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_id` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email_id` (`email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `href` text NOT NULL,
  `url` text NOT NULL,
  `template_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `template_id` (`template_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `href`, `url`, `template_id`) VALUES
(11, 'href="http://www.google.co.in"', 'http://www.google.co.in', 41);

-- --------------------------------------------------------

--
-- Table structure for table `link_hash`
--

CREATE TABLE IF NOT EXISTS `link_hash` (
  `mail_id` int(11) NOT NULL,
  `link_id` int(11) NOT NULL,
  `hash` varchar(16) NOT NULL,
  `clicks` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mail_id`,`link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `link_hash`
--

INSERT INTO `link_hash` (`mail_id`, `link_id`, `hash`, `clicks`) VALUES
(242, 10, '2074064033a54bdf', 0),
(244, 10, 'f01708be7c34ceae', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` varchar(11) NOT NULL,
  `payload` text NOT NULL,
  `time_started` int(11) NOT NULL,
  `time_finished` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `campaign_id` (`campaign_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=250 ;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`id`, `campaign_id`, `payload`, `time_started`, `time_finished`, `status`) VALUES
(242, '70c33fd7b3', '{"to":"sertywwe@example.com","param1":"dummy0"}', 1439810051, 1439810051, 1),
(243, '70c33fd7b3', '{"to":"someone@example.com","param1":"dummy1"}', 1439810051, NULL, 4),
(244, '70c33fd7b3', '{"to":"som123eone@example.com","param1":"dummy2"}', 1439810051, 1439810051, 1),
(245, '70c33fd7b3', '{"to":"mer123ty@gmail.com","param2":"dummy3"}', 1439810052, NULL, 2),
(246, '5d915a97d0', '{"to":"sertywwe@example.com"}', 1439810150, NULL, 5),
(247, '5d915a97d0', '{"to":"someone@example.com"}', 1439810150, NULL, 4),
(248, '5d915a97d0', '{"to":"som123eone@example.com"}', 1439810150, NULL, 5),
(249, '5d915a97d0', '{"to":"mer123ty@gmail.com"}', 1439810150, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `mail_status`
--

CREATE TABLE IF NOT EXISTS `mail_status` (
  `type` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail_status`
--

INSERT INTO `mail_status` (`type`, `description`) VALUES
(0, 'Mail yet to be processed.'),
(1, 'Mail successfully sent to mailing server.'),
(2, 'Wrong number or/and value of parameters passed.'),
(3, '''to'' parameter not defined.'),
(4, 'This email id has been unsubscribed.'),
(5, 'API or template for it doesn''t exist in the database.');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE IF NOT EXISTS `template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `template` text NOT NULL,
  `created_on` int(11) NOT NULL,
  `last_updated` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `name`, `template`, `created_on`, `last_updated`) VALUES
(41, 'Demo', '<p><a href="http://www.google.co.in">http://www.google.co.in</a></p>', 1439809790, 1439810108);

-- --------------------------------------------------------

--
-- Table structure for table `unsubscribed`
--

CREATE TABLE IF NOT EXISTS `unsubscribed` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  UNIQUE KEY `user_id_2` (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `unsubscribed`
--

INSERT INTO `unsubscribed` (`user_id`, `email`) VALUES
(1, 'someone@example.com'),
(2, 'mert@gmail.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `api`
--
ALTER TABLE `api`
  ADD CONSTRAINT `api_ibfk_1` FOREIGN KEY (`template_id`) REFERENCES `template` (`id`);

--
-- Constraints for table `api_params`
--
ALTER TABLE `api_params`
  ADD CONSTRAINT `api_params_ibfk_1` FOREIGN KEY (`template_id`) REFERENCES `template` (`id`);

--
-- Constraints for table `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `links_ibfk_1` FOREIGN KEY (`template_id`) REFERENCES `template` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
