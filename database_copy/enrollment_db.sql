-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2015 at 01:49 PM
-- Server version: 5.6.17-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `enrollment_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `clientId` int(5) NOT NULL AUTO_INCREMENT,
  `clientName` varchar(100) NOT NULL,
  `accountNumber` varchar(10) NOT NULL,
  `cdhNumber` varchar(10) NOT NULL,
  `addedBy` int(4) NOT NULL,
  `addedOn` timestamp NOT NULL,
  PRIMARY KEY (`clientId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientName`, `accountNumber`, `cdhNumber`, `addedBy`, `addedOn`) VALUES
(1, 'Freedom Health', '1092838', '1000300400', 1, '2015-07-27 11:47:42');

-- --------------------------------------------------------

--
-- Table structure for table `client_users`
--

CREATE TABLE IF NOT EXISTS `client_users` (
  `userId` int(5) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(25) NOT NULL,
  `date_added` timestamp NOT NULL,
  `clientId` int(5) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `client_users`
--

INSERT INTO `client_users` (`userId`, `first_name`, `last_name`, `email`, `phone`, `password`, `date_added`, `clientId`) VALUES
(1, 'Peace', 'Odiase', 'peace@m.com', '1234500600', '1234', '2015-07-27 11:48:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `internal_users`
--

CREATE TABLE IF NOT EXISTS `internal_users` (
  `userId` int(4) NOT NULL AUTO_INCREMENT,
  `first_name` int(30) NOT NULL,
  `last_name` int(30) NOT NULL,
  `email` int(100) NOT NULL,
  `phone` int(15) NOT NULL,
  `password` int(20) NOT NULL,
  `rights` int(20) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
