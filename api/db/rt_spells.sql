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
-- Table structure for table `rt_spells`
--

CREATE TABLE IF NOT EXISTS `rt_spells` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `spell_id` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `spell_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `key` varchar(255) CHARACTER SET utf8 NOT NULL,
  `summonerLevel` int(11) NOT NULL,
  `image_full` varchar(255) CHARACTER SET utf8 NOT NULL,
  `image_sprite` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `spell_id` (`spell_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `rt_spells`
--

INSERT INTO `rt_spells` (`ID`, `spell_id`, `description`, `spell_name`, `key`, `summonerLevel`, `image_full`, `image_sprite`) VALUES
(16, 1, 'Removes all disables and summoner spell debuffs affecting your champion and lowers the duration of incoming disables by 65% for 3 seconds.', 'Cleanse', 'SummonerBoost', 6, 'SummonerBoost.png', 'spell0.png'),
(17, 12, 'After channeling for 3.5 seconds, teleports your champion to target allied structure, minion, or ward.', 'Teleport', 'SummonerTeleport', 6, 'SummonerTeleport.png', 'spell0.png'),
(18, 30, 'Quickly travel to the Poro King''s side.', 'To the King!', 'SummonerPoroRecall', 1, 'SummonerPoroRecall.png', 'spell0.png'),
(19, 14, 'Ignites target enemy champion, dealing 70-410 true damage (depending on champion level) over 5 seconds, grants you vision of the target, and reduces healing effects on them for the duration.', 'Ignite', 'SummonerDot', 10, 'SummonerDot.png', 'spell0.png'),
(20, 6, 'Your champion can move through units and has 27% increased Movement Speed for 10 seconds', 'Ghost', 'SummonerHaste', 1, 'SummonerHaste.png', 'spell0.png'),
(21, 32, 'Throw a snowball in a straight line at your enemies. If it hits an enemy, they become marked and your champion can quickly travel to the marked target as a follow up.', 'Mark', 'SummonerSnowball', 1, 'SummonerSnowball.png', 'spell13.png'),
(22, 7, 'Restores 90-345 Health (depending on champion level) and grants 30% Movement Speed for 1 second to you and target allied champion. This healing is halved for units recently affected by Summoner Heal.', 'Heal', 'SummonerHeal', 1, 'SummonerHeal.png', 'spell0.png'),
(23, 11, 'Deals 390-1000 true damage (depending on champion level) to target epic or large monster or enemy minion.', 'Smite', 'SummonerSmite', 10, 'SummonerSmite.png', 'spell0.png'),
(24, 3, 'Exhausts target enemy champion, reducing their Movement Speed and Attack Speed by 30%, their Armor and Magic Resist by 10, and their damage dealt by 40% for 2.5 seconds.', 'Exhaust', 'SummonerExhaust', 4, 'SummonerExhaust.png', 'spell0.png'),
(25, 31, 'Throw a Poro at your enemies. If it hits, you can quickly travel to your target as a follow up.', 'Poro Toss', 'SummonerPoroThrow', 1, 'SummonerPoroThrow.png', 'spell0.png'),
(26, 13, 'Restores 40% of your champion''s maximum Mana. Also restores allies for 40% of their maximum Mana', 'Clarity', 'SummonerMana', 1, 'SummonerMana.png', 'spell0.png'),
(27, 21, 'Shields your champion for 115-455 (depending on champion level) for 2 seconds.', 'Barrier', 'SummonerBarrier', 4, 'SummonerBarrier.png', 'spell0.png'),
(28, 2, 'Reveals a small area of the map for your team for 5 seconds.', 'Clairvoyance', 'SummonerClairvoyance', 8, 'SummonerClairvoyance.png', 'spell0.png'),
(29, 4, 'Teleports your champion a short distance toward your cursor''s location.', 'Flash', 'SummonerFlash', 8, 'SummonerFlash.png', 'spell0.png'),
(30, 17, 'Allied Turret: Grants massive regeneration for 8 seconds. Enemy Turret: Reduces damage dealt by 80% for 8 seconds.', 'Garrison', 'SummonerOdinGarrison', 1, 'SummonerOdinGarrison.png', 'spell0.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
