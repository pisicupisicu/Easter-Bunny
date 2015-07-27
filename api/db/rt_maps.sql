-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 27, 2015 at 08:24 PM
-- Server version: 5.5.38
-- PHP Version: 5.4.38-1+deb.sury.org~precise+2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `weblight_teemo`
--

-- --------------------------------------------------------

--
-- Table structure for table `rt_maps`
--

CREATE TABLE IF NOT EXISTS `rt_maps` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `map_id` int(11) NOT NULL,
  `map_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `image_full` varchar(255) CHARACTER SET utf8 NOT NULL,
  `image_sprite` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `map_id` (`map_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `rt_maps`
--

INSERT INTO `rt_maps` (`ID`, `map_id`, `map_name`, `image_full`, `image_sprite`) VALUES
(1, 1, 'SummonersRift', 'map1.png', 'map0.png'),
(2, 10, 'NewTwistedTreeline', 'map10.png', 'map0.png'),
(3, 11, 'SummonersRiftNew', 'map11.png', 'map0.png'),
(4, 12, 'ProvingGroundsNew', 'map12.png', 'map0.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
