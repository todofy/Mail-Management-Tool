-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 11, 2015 at 01:51 PM
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
(8, 'anshumanpattanayak@gmail.com', '7be1f7a994a0cb2d9921a19fef9c52ae', 'e5b725fd14b675a4085766f70883ba68', 'namak', '86a3b9ed22fd6e24436f02c5a62cd541', 1439269569),
(10, 'zsonix27@gmail.com', '182153e6d75f87ee45aa07434200f69c', 'e5b725fd14b675a4085766f70883ba68', 'namak', '', 1436965833);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `api`
--

INSERT INTO `api` (`id`, `code`, `name`, `template_id`, `created_on`) VALUES
(4, '47a7b', 'API_Registration', 22, 1436715969),
(20, '01e9d', 'Demo', 22, 1436972332),
(24, '6b4b1', 'API_Test', 33, 1439253619);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=108 ;

--
-- Dumping data for table `api_params`
--

INSERT INTO `api_params` (`id`, `template_id`, `name`) VALUES
(103, 22, '{{email_id}}'),
(104, 22, '{{password}}'),
(105, 22, '{{secret}}'),
(107, 33, '{{param1}}');

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
  `time_started` int(11) NOT NULL,
  `time_finished` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `url` text NOT NULL,
  `hash` varchar(16) NOT NULL,
  `template_id` int(11) NOT NULL,
  `clicks` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `template_id` (`template_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `url`, `hash`, `template_id`, `clicks`) VALUES
(1, 'http://www.google.com', 'a3a5759c5b56cf8c', 34, 0),
(2, 'https://www.facebook.com/?_rdr', '13da41a6acaea643', 34, 0),
(3, 'http://www.google.com', '97921e70d1dafde4', 33, 0);

-- --------------------------------------------------------

--
-- Table structure for table `link_suffix`
--

CREATE TABLE IF NOT EXISTS `link_suffix` (
  `mail_id` int(11) NOT NULL,
  `link_id` int(11) NOT NULL,
  `hash` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` varchar(11) NOT NULL,
  `payload` text NOT NULL,
  `sent` int(11) NOT NULL DEFAULT '0',
  `seen` int(11) NOT NULL DEFAULT '0',
  `time_started` int(11) NOT NULL,
  `time_finished` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `campaign_id` (`campaign_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `name`, `template`, `created_on`, `last_updated`) VALUES
(22, 'Registration', '<h2><span style="color: #993300;"><strong>Welcome to TODOFY</strong></span></h2>\r\n<hr />\r\n<p>Hi,</p>\r\n<p>We are really happy to notify that you have been registered to Todofy with email id : <strong>{{email_id}}</strong>.</p>\r\n<p>Your randomly generated password is : <strong>{{password}}</strong>.</p>\r\n<p><em><span style="color: #ff0000;">(You can change your password by going into ''Profile'' after logging in. Also, you can check your access rights in your profile.)</span></em></p>\r\n<p>Your secret key for using APIs is : <strong>{{secret}}</strong>.</p>\r\n<hr />\r\n<p style="text-align: right;">-Todofy Team</p>', 1436699982, 1439124491),
(32, 'Dummy', '<p>Design your template here.</p>', 1439204304, 1439204304),
(33, 'Test mail', '<p>{{param1}}</p>\r\n<p><a href="http://www.google.com">www.google.com</a></p>\r\n<p></p>', 1439253596, 1439282005),
(34, 'asdf', '<p>Design your template here.</p>\r\n<p><a href="http://www.google.com">www.google.com</a></p>\r\n<p><a href="https://www.facebook.com/?_rdr">https://www.facebook.com/?_rdr</a></p>\r\n<p></p>\r\n<p></p>', 1439277595, 1439277595);

-- --------------------------------------------------------

--
-- Table structure for table `unsubscribed`
--

CREATE TABLE IF NOT EXISTS `unsubscribed` (
  `user_id` int(11) NOT NULL,
  UNIQUE KEY `user_id_2` (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

--
-- Constraints for table `unsubscribed`
--
ALTER TABLE `unsubscribed`
  ADD CONSTRAINT `unsubscribed_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `email` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
