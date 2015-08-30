-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2015 at 10:22 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl`
--

CREATE TABLE IF NOT EXISTS `acl` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acl`
--

INSERT INTO `acl` (`id`, `name`, `description`) VALUES
(1, 'admin_view', 'View all admins'),
(2, 'admin_add', 'Add an admin'),
(3, 'admin_edit', 'Edit an admin'),
(4, 'admin_revoke', 'Invalidate secret key for admin'),
(5, 'admin_delete', 'Delete an admin'),
(6, 'campaign_view', 'View a particular campaign''s all mails'),
(7, 'campaign_call', 'Start a campaign'),
(8, 'unsub_emails', 'View unsubscribed emails and remove them');

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
(8, 'anshumanpattanayak@gmail.com', '7be1f7a994a0cb2d9921a19fef9c52ae', 'e5b725fd14b675a4085766f70883ba68', 'namak', '4841eb01d8b6d650d74929c5de860c82', 1440922215),
(10, 'zsonix27@gmail.com', 'efa6f70cd7b5d6353038da6496ba3652', 'e5b725fd14b675a4085766f70883ba68', 'namak', '', 1440855574);

-- --------------------------------------------------------

--
-- Table structure for table `admin_access`
--

CREATE TABLE IF NOT EXISTS `admin_access` (
  `admin_id` int(11) NOT NULL,
  `access_id` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`,`access_id`)
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
(8, 6),
(8, 7),
(8, 8),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `api`
--

INSERT INTO `api` (`id`, `code`, `name`, `template_id`, `created_on`) VALUES
(36, 'fac53', 'Test', 44, 1440733124);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `api_params`
--

INSERT INTO `api_params` (`id`, `template_id`, `name`) VALUES
(12, 44, '{{param1}}'),
(13, 44, '{{param2}}'),
(14, 44, '{{param3}}');

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
('eb92db83b1', '7be1f7a994a0cb2d9921a19fef9c52ae', 'fac53', 'noreply@todofy.org', 'TODOFY Mail', 1, 1, 0, 1440855644, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` varchar(11) NOT NULL,
  `payload` text NOT NULL,
  `time_started` int(11) DEFAULT NULL,
  `time_finished` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `campaign_id` (`campaign_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=274 ;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`id`, `campaign_id`, `payload`, `time_started`, `time_finished`, `status`) VALUES
(273, 'eb92db83b1', '{"to":"anshumanpattanayak@gmail.com","param1":"1","param2":"2","param3":"3"}', NULL, NULL, 0);

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
(5, 'API or template for it doesn''t exist in the database.'),
(6, 'Incorrect email id specified for addressee.');

-- --------------------------------------------------------

--
-- Table structure for table `pass_verify`
--

CREATE TABLE IF NOT EXISTS `pass_verify` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_id` varchar(30) NOT NULL,
  `hash` varchar(16) NOT NULL,
  `time_started` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `name`, `template`, `created_on`, `last_updated`) VALUES
(44, 'test', '<p>Design your template here.</p>\r\n<p>{{param1}}</p>\r\n<p>{{param2}}</p>\r\n<p>{{param3}}</p>', 1440733109, 1440764510);

-- --------------------------------------------------------

--
-- Table structure for table `unsubscribed`
--

CREATE TABLE IF NOT EXISTS `unsubscribed` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `time` int(11) NOT NULL,
  `reason_id` int(11) NOT NULL,
  UNIQUE KEY `user_id_2` (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `unsubscribed`
--

INSERT INTO `unsubscribed` (`user_id`, `email`, `time`, `reason_id`) VALUES
(1, 'someone@example.com', 1440733124, 1);

-- --------------------------------------------------------

--
-- Table structure for table `unsub_reasons`
--

CREATE TABLE IF NOT EXISTS `unsub_reasons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `unsub_reasons`
--

INSERT INTO `unsub_reasons` (`id`, `reason`) VALUES
(1, 'Not interested in mails from this sender.'),
(2, 'Sender is annoying.');

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
