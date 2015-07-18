-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 18, 2015 at 12:21 PM
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
(8, 'anshumanpattanayak@gmail.com', '7be1f7a994a0cb2d9921a19fef9c52ae', 'e5b725fd14b675a4085766f70883ba68', 'namak', '', 1437191489),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `api`
--

INSERT INTO `api` (`id`, `code`, `name`, `template_id`, `created_on`) VALUES
(4, '47a7b', 'API_Registration', 22, 1436715969),
(19, '1d3e2', 'Dummy', 23, 1436951666),
(20, '01e9d', 'Demo', 22, 1436972332);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

--
-- Dumping data for table `api_params`
--

INSERT INTO `api_params` (`id`, `template_id`, `name`) VALUES
(90, 22, '{{email_id}}'),
(91, 22, '{{password}}'),
(92, 22, '{{secret}}'),
(97, 23, '{{toy1}}'),
(98, 23, '{{toy2}}'),
(99, 23, '{{toy3}}');

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE IF NOT EXISTS `campaign` (
  `id` varchar(11) NOT NULL,
  `api_id` int(11) NOT NULL,
  `payload` text NOT NULL,
  `called_on` int(11) NOT NULL,
  `todo` int(11) NOT NULL DEFAULT '0',
  `done` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `api_id` (`api_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`id`, `api_id`, `payload`, `called_on`, `todo`, `done`, `status`) VALUES
('040d9b48eb', 19, '<p>somethingelsenew</p>', 0, 0, 0, 0),
('184f218198', 4, '<h2><span style="color: #993300;"><strong>Welcome to TODOFY</strong></span></h2>\r\n<hr />\r\n<p>Hi,</p>\r\n<p>We are really happy to notify that you have been registered to Todofy with email id : <strong>zsonix27@gmail.com</strong>.</p>\r\n<p>Your randomly generated password is : <strong>pswrd</strong>.</p>\r\n<p><em><span style="color: #ff0000;">(You can change your password by going into ''Profile'' after logging in. Also, you can check your access rights in your profile.)</span></em></p>\r\n<p>Your secret key for using APIs is : <strong>1234567890</strong>.</p>\r\n<hr />\r\n<p style="text-align: right;">-Todofy Team</p>', 0, 0, 0, 0),
('37c0e1067e', 19, '<p>somethingelsenew</p>', 0, 0, 0, 0),
('4bc23415ce', 19, '<p>somethingelsenew</p>', 0, 0, 0, 0),
('558ec4b033', 19, '<p>somethingelsenew</p>', 1437217344, 0, 0, 0),
('af2db5ed06', 19, '<p>somethingelsenew</p>', 0, 0, 0, 0);

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
  `mail_id` int(11) NOT NULL,
  `hash` varchar(32) NOT NULL,
  `url` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `mail_id` (`mail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` varchar(11) NOT NULL,
  `sent` int(1) NOT NULL DEFAULT '0',
  `seen` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `campaign_id` (`campaign_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`id`, `campaign_id`, `sent`, `seen`) VALUES
(1, '4bc23415ce', 0, 0),
(2, 'af2db5ed06', 0, 0),
(3, '184f218198', 0, 0),
(4, '37c0e1067e', 0, 0),
(5, '040d9b48eb', 1, 0),
(6, '558ec4b033', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE IF NOT EXISTS `queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `name`, `template`, `created_on`, `last_updated`) VALUES
(22, 'Registration', '<h2><span style="color: #993300;"><strong>Welcome to TODOFY</strong></span></h2>\r\n<hr />\r\n<p>Hi,</p>\r\n<p>We are really happy to notify that you have been registered to Todofy with email id : <strong>{{email_id}}</strong>.</p>\r\n<p>Your randomly generated password is : <strong>{{password}}</strong>.</p>\r\n<p><em><span style="color: #ff0000;">(You can change your password by going into ''Profile'' after logging in. Also, you can check your access rights in your profile.)</span></em></p>\r\n<p>Your secret key for using APIs is : <strong>{{secret}}</strong>.</p>\r\n<hr />\r\n<p style="text-align: right;">-Todofy Team</p>', 1436699982, 1436971824),
(23, 'Dummy Template', '<p>{{toy1}}{{toy2}}{{toy3}}</p>', 1436951651, 1437148787);

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
-- Constraints for table `campaign`
--
ALTER TABLE `campaign`
  ADD CONSTRAINT `campaign_ibfk_1` FOREIGN KEY (`api_id`) REFERENCES `api` (`id`);

--
-- Constraints for table `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `links_ibfk_1` FOREIGN KEY (`mail_id`) REFERENCES `mail` (`id`);

--
-- Constraints for table `mail`
--
ALTER TABLE `mail`
  ADD CONSTRAINT `mail_ibfk_1` FOREIGN KEY (`campaign_id`) REFERENCES `campaign` (`id`);

--
-- Constraints for table `unsubscribed`
--
ALTER TABLE `unsubscribed`
  ADD CONSTRAINT `unsubscribed_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `email` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
