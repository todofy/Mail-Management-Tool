-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 15, 2015 at 09:46 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `secret`, `password`, `salt`, `cookie`, `last_login`) VALUES
(8, 'anshumanpattanayak@gmail.com', '7be1f7a994a0cb2d9921a19fef9c52ae', 'e5b725fd14b675a4085766f70883ba68', 'namak', '86a3b9ed22fd6e24436f02c5a62cd541', 1439628825),
(10, 'zsonix27@gmail.com', '182153e6d75f87ee45aa07434200f69c', 'e5b725fd14b675a4085766f70883ba68', 'namak', '', 1436965833),
(11, 'safsa@sdfds.cdfo', '516ab040424996df7378ab11d365681d', '6d8a256625c64ecd6f4b9b73403588e5', '07f82b', '', NULL);

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
(10, 4),
(11, 1),
(11, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `api`
--

INSERT INTO `api` (`id`, `code`, `name`, `template_id`, `created_on`) VALUES
(4, '47a7b', 'API_Registration', 22, 1436715969),
(20, '01e9d', 'Demo', 22, 1436972332),
(26, '12aed', 'New API', 36, 1439482185);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=110 ;

--
-- Dumping data for table `api_params`
--

INSERT INTO `api_params` (`id`, `template_id`, `name`) VALUES
(103, 22, '{{email_id}}'),
(104, 22, '{{password}}'),
(105, 22, '{{secret}}'),
(109, 36, '{{param1}}');

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
('15668c0ca5', '7be1f7a994a0cb2d9921a19fef9c52ae', '12aed', 'abc@gmail.com', 'Test mail', 3, 3, 3, 1439628814, 1439632009),
('402bc66229', '7be1f7a994a0cb2d9921a19fef9c52ae', '12aed', 'abc@gmail.com', 'Test mail', 3, 3, 3, 1439628845, 1439632009),
('7bacf21788', '7be1f7a994a0cb2d9921a19fef9c52ae', '12aed', 'abc@gmail.com', 'Test mail', 4, 4, 4, 1439629879, 1439632009),
('83e83c784e', '7be1f7a994a0cb2d9921a19fef9c52ae', '12aed', 'abc@gmail.com', 'Test mail', 3, 3, 3, 1439628888, 1439632009),
('adddd31423', '7be1f7a994a0cb2d9921a19fef9c52ae', '12aed', 'abc@gmail.com', 'Test mail', 3, 3, 3, 1439622944, 1439632009),
('b65c6ff481', '7be1f7a994a0cb2d9921a19fef9c52ae', '12aed', 'abc@gmail.com', 'Test mail', 3, 3, 3, 1439624172, 1439632009);

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
  `template_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `template_id` (`template_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `url`, `template_id`) VALUES
(4, 'http://www.google.co.in', 36);

-- --------------------------------------------------------

--
-- Table structure for table `link_hash`
--

CREATE TABLE IF NOT EXISTS `link_hash` (
  `mail_id` int(11) NOT NULL,
  `link_id` int(11) NOT NULL,
  `hash` varchar(16) NOT NULL,
  `clicks` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `link_hash`
--

INSERT INTO `link_hash` (`mail_id`, `link_id`, `hash`, `clicks`) VALUES
(183, 4, '1ba8c1d555a61d25', 0),
(186, 4, '9010924dff644fd6', 0),
(189, 4, 'e13e495e7b74fa23', 0),
(192, 4, 'b75333b6b520bbef', 0),
(195, 4, '077c0194b6d233a4', 0),
(198, 4, 'dab956188e951f08', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=202 ;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`id`, `campaign_id`, `payload`, `time_started`, `time_finished`, `status`) VALUES
(183, 'adddd31423', '{"to":"someone@example.com","param1":"dummy1"}', 1439623271, 1439623271, 1),
(184, 'adddd31423', '{"param1":"dummy2"}', 1439623271, NULL, 3),
(185, 'adddd31423', '{"to":"mert@gmail.com","param2":"dummy3"}', 1439623271, NULL, 2),
(186, 'b65c6ff481', '{"to":"someone@example.com","param1":"dummy1"}', 1439628572, 1439628572, 1),
(187, 'b65c6ff481', '{"param1":"dummy2"}', 1439628572, NULL, 3),
(188, 'b65c6ff481', '{"to":"mert@gmail.com","param2":"dummy3"}', 1439628572, NULL, 2),
(189, '15668c0ca5', '{"to":"someone@example.com","param1":"dummy1"}', 1439628814, 1439628814, 1),
(190, '15668c0ca5', '{"param1":"dummy2"}', 1439628814, NULL, 3),
(191, '15668c0ca5', '{"to":"mert@gmail.com","param2":"dummy3"}', 1439628814, NULL, 2),
(192, '402bc66229', '{"to":"someone@example.com","param1":"dummy1"}', 1439628845, 1439628845, 1),
(193, '402bc66229', '{"param1":"dummy2"}', 1439628845, NULL, 3),
(194, '402bc66229', '{"to":"mert@gmail.com","param2":"dummy3"}', 1439628845, NULL, 2),
(195, '83e83c784e', '{"to":"someone@example.com","param1":"dummy1"}', 1439628889, 1439628889, 1),
(196, '83e83c784e', '{"param1":"dummy2"}', 1439628889, NULL, 3),
(197, '83e83c784e', '{"to":"mert@gmail.com","param2":"dummy3"}', 1439628889, NULL, 2),
(198, '7bacf21788', '{"to":"sertywwe@example.com","param1":"dummy0"}', 1439629879, 1439629879, 1),
(199, '7bacf21788', '{"to":"someone@example.com","param1":"dummy1"}', 1439629879, NULL, 4),
(200, '7bacf21788', '{"param1":"dummy2"}', 1439629879, NULL, 3),
(201, '7bacf21788', '{"to":"mert@gmail.com","param2":"dummy3"}', 1439629879, NULL, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `name`, `template`, `created_on`, `last_updated`) VALUES
(22, 'Registration', '<h2><span style="color: #993300;"><strong>Welcome to TODOFY</strong></span></h2>\r\n<hr />\r\n<p>Hi,</p>\r\n<p>We are really happy to notify that you have been registered to Todofy with email id : <strong>{{email_id}}</strong>.</p>\r\n<p>Your randomly generated password is : <strong>{{password}}</strong>.</p>\r\n<p><em><span style="color: #ff0000;">(You can change your password by going into ''Profile'' after logging in. Also, you can check your access rights in your profile.)</span></em></p>\r\n<p>Your secret key for using APIs is : <strong>{{secret}}</strong>.</p>\r\n<hr />\r\n<p style="text-align: right;">-Todofy Team</p>', 1436699982, 1439124491),
(32, 'Dummy', '<p>Design your template here.</p>', 1439204304, 1439204304),
(36, 'RTY', '<p>{{param1}}</p>\r\n<p><a href="http://www.google.co.in">www.google.co.in</a></p>\r\n<p></p>', 1439482154, 1439482154);

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
