-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2012 at 04:47 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `security`
--
CREATE DATABASE `security` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `security`;

-- --------------------------------------------------------

--
-- Table structure for table `people7489`
--

CREATE TABLE IF NOT EXISTS `people7489` (
  `Username` varchar(32) NOT NULL,
  `PassHash` varchar(64) NOT NULL,
  `Voted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `people7489`
--

INSERT INTO `people7489` (`Username`, `PassHash`, `Voted`) VALUES
('ernestkirstein11271990', '9cbbdb5ef53b0f78a27194954065960491efcd03426c07960654e1f58cb72617', 1);

-- --------------------------------------------------------

--
-- Table structure for table `votes9230`
--

CREATE TABLE IF NOT EXISTS `votes9230` (
  `ID` varchar(10) NOT NULL,
  `PassHash` varchar(64) NOT NULL,
  `Vote` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes9230`
--

INSERT INTO `votes9230` (`ID`, `PassHash`, `Vote`) VALUES
('0698818900', '78104a619abf5e268c01aeb11ceaae976022a785378305a0812e6be37f1c5782', ''),
('0903378662', '8560e7eff7a3c75a123702e2a672815164f95c7cfdf2969638d516c1ea5f1ed7', ''),
('4980158469', 'ee6065086d0cc95b7aa6c49100bd318399f13e27be69219bd343ea171aaef5d3', ''),
('6592029317', '5a4c593887d06c5b27b074d9f1ec773b2cddd9b2588f4a6a1254d451fa458358', 'Vermin%20Supreme'),
('9270665042', '3c58e498bc1d5abd2e20c37fb20869e5cac4788ab617b781d11c28f9ca2ebf13', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
