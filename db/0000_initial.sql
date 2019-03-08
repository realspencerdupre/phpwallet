-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 01, 2015 at 04:39 PM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wallet`
--
CREATE DATABASE `wallet`;
USE `wallet`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(300) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `username` varchar(65) NOT NULL,
  `email` varchar(256),
  `password` varchar(300) NOT NULL,
  `admin` varchar(1) DEFAULT NULL,
  `locked` varchar(1) DEFAULT NULL,
  `supportpin` varchar(6) DEFAULT NULL,
  `secret` varchar(16) DEFAULT NULL,
  `authused` varchar(1) DEFAULT NULL,
  `email_conf` int(11),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(64),
  `date` varchar(300) NOT NULL,
  `pay_curr` varchar(16) NOT NULL,
  `pay_amt` BIGINT DEFAULT 0,
  `tok_amt` BIGINT DEFAULT 0,
  `user` varchar(65) NOT NULL,
  `pay_addr` varchar(256) DEFAULT NULL,
  `sweep_addr` varchar(256) DEFAULT NULL,
  `confirmed` varchar(1) DEFAULT 0,
  `swept` varchar(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;


CREATE TABLE IF NOT EXISTS `configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `current_migration` VARCHAR(256),
  `current_version` VARCHAR(256),
  `private` varchar(512) DEFAULT NULL,
  `public` varchar(256) DEFAULT NULL,
  `host` VARCHAR(256),
  `coinmax` DECIMAL(16, 8),
  `email_host` VARCHAR(256),
  `email_port` int(11),
  `email_user` VARCHAR(256),
  `email_pass` VARCHAR(256),
  `email_from` VARCHAR(256),
  `email_tls` VARCHAR(1),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT IGNORE INTO `configuration` (`id`, `current_migration`, `current_version`, `coinmax`) VALUES (1, "0000", "0000", 9999);
--
-- Dumping data for table `users`
--

INSERT IGNORE INTO `users` (`id`, `date`, `ip`, `username`, `password`, `admin`, `locked`) VALUES
(1, '', 'localhost', 'piWallet', '$2y$10$9KalPpQkWkVu7VOSRT.SqOBkCXxFQMCq17mNYUpg92EMF7TvAozPG', '1', NULL);

INSERT IGNORE INTO `users` (`id`, `date`, `ip`, `username`, `password`, `admin`, `locked`) VALUES
(1, '', 'localhost', 'piWallet_wait', '$2y$10$9KalPpQkWkVu7VOSRT.SqOBkCXxFQMCq17mNYUpg92EMF7TvAozPG', '1', NULL);

CREATE TABLE IF NOT EXISTS `logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` VARCHAR(255) not null,
  `datetime` VARCHAR(255),
  `user_agent` varchar(1024) NOT NULL,
  `ip` varchar(64) NOT NULL,
  `success` varchar(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;


CREATE TABLE IF NOT EXISTS `confirmations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(256) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `code` varchar(256) DEFAULT NULL,
  `confirmed` VARCHAR(1),
  `date` VARCHAR(64),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;


CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(256) DEFAULT NULL,
  `short` varchar(256) DEFAULT NULL,
  `rate` decimal(16,8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
