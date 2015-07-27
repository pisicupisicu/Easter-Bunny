-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 25, 2015 at 06:16 PM
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
-- Table structure for table `rt_champions`
--

CREATE TABLE IF NOT EXISTS `rt_champions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `api_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_full` varchar(255) NOT NULL,
  `image_sprite` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=127 ;

--
-- Dumping data for table `rt_champions`
--

INSERT INTO `rt_champions` (`id`, `api_id`, `title`, `name`, `image_full`, `image_sprite`) VALUES
(1, 412, 'the Chain Warden', 'Thresh', 'Thresh.png', 'champion3.png'),
(2, 266, 'the Darkin Blade', 'Aatrox', 'Aatrox.png', 'champion0.png'),
(3, 23, 'the Barbarian King', 'Tryndamere', 'Tryndamere.png', 'champion3.png'),
(4, 79, 'the Rabble Rouser', 'Gragas', 'Gragas.png', 'champion1.png'),
(5, 69, 'the Serpent''s Embrace', 'Cassiopeia', 'Cassiopeia.png', 'champion0.png'),
(6, 78, 'the Iron Ambassador', 'Poppy', 'Poppy.png', 'champion2.png'),
(7, 13, 'the Rogue Mage', 'Ryze', 'Ryze.png', 'champion2.png'),
(8, 14, 'The Undead Juggernaut', 'Sion', 'Sion.png', 'champion2.png'),
(9, 1, 'the Dark Child', 'Annie', 'Annie.png', 'champion0.png'),
(10, 43, 'the Enlightened One', 'Karma', 'Karma.png', 'champion1.png'),
(11, 111, 'the Titan of the Depths', 'Nautilus', 'Nautilus.png', 'champion2.png'),
(12, 99, 'the Lady of Luminosity', 'Lux', 'Lux.png', 'champion1.png'),
(13, 103, 'the Nine-Tailed Fox', 'Ahri', 'Ahri.png', 'champion0.png'),
(14, 2, 'the Berserker', 'Olaf', 'Olaf.png', 'champion2.png'),
(15, 112, 'the Machine Herald', 'Viktor', 'Viktor.png', 'champion3.png'),
(16, 34, 'the Cryophoenix', 'Anivia', 'Anivia.png', 'champion0.png'),
(17, 86, 'The Might of Demacia', 'Garen', 'Garen.png', 'champion0.png'),
(18, 27, 'the Mad Chemist', 'Singed', 'Singed.png', 'champion2.png'),
(19, 127, 'the Ice Witch', 'Lissandra', 'Lissandra.png', 'champion1.png'),
(20, 57, 'the Twisted Treant', 'Maokai', 'Maokai.png', 'champion1.png'),
(21, 25, 'Fallen Angel', 'Morgana', 'Morgana.png', 'champion2.png'),
(22, 28, 'the Widowmaker', 'Evelynn', 'Evelynn.png', 'champion0.png'),
(23, 105, 'the Tidal Trickster', 'Fizz', 'Fizz.png', 'champion0.png'),
(24, 238, 'the Master of Shadows', 'Zed', 'Zed.png', 'champion3.png'),
(25, 74, 'the Revered Inventor', 'Heimerdinger', 'Heimerdinger.png', 'champion1.png'),
(26, 68, 'the Mechanized Menace', 'Rumble', 'Rumble.png', 'champion2.png'),
(27, 82, 'the Master of Metal', 'Mordekaiser', 'Mordekaiser.png', 'champion2.png'),
(28, 37, 'Maven of the Strings', 'Sona', 'Sona.png', 'champion3.png'),
(29, 55, 'the Sinister Blade', 'Katarina', 'Katarina.png', 'champion1.png'),
(30, 96, 'the Mouth of the Abyss', 'Kog''Maw', 'KogMaw.png', 'champion1.png'),
(31, 22, 'the Frost Archer', 'Ashe', 'Ashe.png', 'champion0.png'),
(32, 117, 'the Fae Sorceress', 'Lulu', 'Lulu.png', 'champion1.png'),
(33, 30, 'the Deathsinger', 'Karthus', 'Karthus.png', 'champion1.png'),
(34, 12, 'the Minotaur', 'Alistar', 'Alistar.png', 'champion0.png'),
(35, 122, 'the Hand of Noxus', 'Darius', 'Darius.png', 'champion0.png'),
(36, 67, 'the Night Hunter', 'Vayne', 'Vayne.png', 'champion3.png'),
(37, 110, 'the Arrow of Retribution', 'Varus', 'Varus.png', 'champion3.png'),
(38, 77, 'the Spirit Walker', 'Udyr', 'Udyr.png', 'champion3.png'),
(39, 126, 'the Defender of Tomorrow', 'Jayce', 'Jayce.png', 'champion1.png'),
(40, 89, 'the Radiant Dawn', 'Leona', 'Leona.png', 'champion1.png'),
(41, 134, 'the Dark Sovereign', 'Syndra', 'Syndra.png', 'champion3.png'),
(42, 80, 'the Artisan of War', 'Pantheon', 'Pantheon.png', 'champion2.png'),
(43, 121, 'the Voidreaver', 'Kha''Zix', 'Khazix.png', 'champion1.png'),
(44, 92, 'the Exile', 'Riven', 'Riven.png', 'champion2.png'),
(45, 42, 'the Daring Bombardier', 'Corki', 'Corki.png', 'champion0.png'),
(46, 268, 'the Emperor of the Sands', 'Azir', 'Azir.png', 'champion0.png'),
(47, 51, 'the Sheriff of Piltover', 'Caitlyn', 'Caitlyn.png', 'champion0.png'),
(48, 76, 'the Bestial Huntress', 'Nidalee', 'Nidalee.png', 'champion2.png'),
(49, 3, 'the Sentinel''s Sorrow', 'Galio', 'Galio.png', 'champion0.png'),
(50, 85, 'the Heart of the Tempest', 'Kennen', 'Kennen.png', 'champion1.png'),
(51, 45, 'the Tiny Master of Evil', 'Veigar', 'Veigar.png', 'champion3.png'),
(52, 432, 'the Wandering Caretaker', 'Bard', 'Bard.png', 'champion4.png'),
(53, 150, 'the Missing Link', 'Gnar', 'Gnar.png', 'champion0.png'),
(54, 104, 'the Outlaw', 'Graves', 'Graves.png', 'champion1.png'),
(55, 90, 'the Prophet of the Void', 'Malzahar', 'Malzahar.png', 'champion1.png'),
(56, 254, 'the Piltover Enforcer', 'Vi', 'Vi.png', 'champion3.png'),
(57, 10, 'The Judicator', 'Kayle', 'Kayle.png', 'champion1.png'),
(58, 39, 'the Will of the Blades', 'Irelia', 'Irelia.png', 'champion1.png'),
(59, 64, 'the Blind Monk', 'Lee Sin', 'LeeSin.png', 'champion1.png'),
(60, 60, 'The Spider Queen', 'Elise', 'Elise.png', 'champion0.png'),
(61, 106, 'the Thunder''s Roar', 'Volibear', 'Volibear.png', 'champion3.png'),
(62, 20, 'the Yeti Rider', 'Nunu', 'Nunu.png', 'champion2.png'),
(63, 4, 'the Card Master', 'Twisted Fate', 'TwistedFate.png', 'champion3.png'),
(64, 24, 'Grandmaster at Arms', 'Jax', 'Jax.png', 'champion1.png'),
(65, 102, 'the Half-Dragon', 'Shyvana', 'Shyvana.png', 'champion2.png'),
(66, 429, 'the Spear of Vengeance', 'Kalista', 'Kalista.png', 'champion1.png'),
(67, 36, 'the Madman of Zaun', 'Dr. Mundo', 'DrMundo.png', 'champion0.png'),
(68, 223, 'the River King', 'Tahm Kench', 'TahmKench.png', 'champion4.png'),
(69, 63, 'the Burning Vengeance', 'Brand', 'Brand.png', 'champion0.png'),
(70, 131, 'Scorn of the Moon', 'Diana', 'Diana.png', 'champion0.png'),
(71, 113, 'the Winter''s Wrath', 'Sejuani', 'Sejuani.png', 'champion2.png'),
(72, 8, 'the Crimson Reaper', 'Vladimir', 'Vladimir.png', 'champion3.png'),
(73, 154, 'the Secret Weapon', 'Zac', 'Zac.png', 'champion3.png'),
(74, 421, 'the Void Burrower', 'Rek''Sai', 'RekSai.png', 'champion2.png'),
(75, 133, 'Demacia''s Wings', 'Quinn', 'Quinn.png', 'champion2.png'),
(76, 84, 'the Fist of Shadow', 'Akali', 'Akali.png', 'champion0.png'),
(77, 18, 'the Yordle Gunner', 'Tristana', 'Tristana.png', 'champion3.png'),
(78, 120, 'the Shadow of War', 'Hecarim', 'Hecarim.png', 'champion1.png'),
(79, 15, 'the Battle Mistress', 'Sivir', 'Sivir.png', 'champion2.png'),
(80, 236, 'the Purifier', 'Lucian', 'Lucian.png', 'champion1.png'),
(81, 107, 'the Pridestalker', 'Rengar', 'Rengar.png', 'champion2.png'),
(82, 19, 'the Blood Hunter', 'Warwick', 'Warwick.png', 'champion3.png'),
(83, 72, 'the Crystal Vanguard', 'Skarner', 'Skarner.png', 'champion2.png'),
(84, 54, 'Shard of the Monolith', 'Malphite', 'Malphite.png', 'champion1.png'),
(85, 157, 'the Unforgiven', 'Yasuo', 'Yasuo.png', 'champion3.png'),
(86, 101, 'the Magus Ascendant', 'Xerath', 'Xerath.png', 'champion3.png'),
(87, 17, 'the Swift Scout', 'Teemo', 'Teemo.png', 'champion3.png'),
(88, 75, 'the Curator of the Sands', 'Nasus', 'Nasus.png', 'champion2.png'),
(89, 58, 'the Butcher of the Sands', 'Renekton', 'Renekton.png', 'champion2.png'),
(90, 119, 'the Glorious Executioner', 'Draven', 'Draven.png', 'champion0.png'),
(91, 35, 'the Demon Jester', 'Shaco', 'Shaco.png', 'champion2.png'),
(92, 50, 'the Master Tactician', 'Swain', 'Swain.png', 'champion3.png'),
(93, 115, 'the Hexplosives Expert', 'Ziggs', 'Ziggs.png', 'champion4.png'),
(94, 91, 'the Blade''s Shadow', 'Talon', 'Talon.png', 'champion3.png'),
(95, 40, 'the Storm''s Fury', 'Janna', 'Janna.png', 'champion1.png'),
(96, 245, 'the Boy Who Shattered Time', 'Ekko', 'Ekko.png', 'champion4.png'),
(97, 61, 'the Lady of Clockwork', 'Orianna', 'Orianna.png', 'champion2.png'),
(98, 9, 'the Harbinger of Doom', 'Fiddlesticks', 'FiddleSticks.png', 'champion0.png'),
(99, 114, 'the Grand Duelist', 'Fiora', 'Fiora.png', 'champion0.png'),
(100, 31, 'the Terror of the Void', 'Cho''Gath', 'Chogath.png', 'champion0.png'),
(101, 33, 'the Armordillo', 'Rammus', 'Rammus.png', 'champion2.png'),
(102, 7, 'the Deceiver', 'LeBlanc', 'Leblanc.png', 'champion1.png'),
(103, 26, 'the Chronokeeper', 'Zilean', 'Zilean.png', 'champion4.png'),
(104, 16, 'the Starchild', 'Soraka', 'Soraka.png', 'champion3.png'),
(105, 56, 'the Eternal Nightmare', 'Nocturne', 'Nocturne.png', 'champion2.png'),
(106, 222, 'the Loose Cannon', 'Jinx', 'Jinx.png', 'champion1.png'),
(107, 83, 'the Gravedigger', 'Yorick', 'Yorick.png', 'champion3.png'),
(108, 6, 'the Headsman''s Pride', 'Urgot', 'Urgot.png', 'champion3.png'),
(109, 21, 'the Bounty Hunter', 'Miss Fortune', 'MissFortune.png', 'champion2.png'),
(110, 62, 'the Monkey King', 'Wukong', 'MonkeyKing.png', 'champion2.png'),
(111, 53, 'the Great Steam Golem', 'Blitzcrank', 'Blitzcrank.png', 'champion0.png'),
(112, 98, 'Eye of Twilight', 'Shen', 'Shen.png', 'champion2.png'),
(113, 201, 'the Heart of the Freljord', 'Braum', 'Braum.png', 'champion0.png'),
(114, 5, 'the Seneschal of Demacia', 'Xin Zhao', 'XinZhao.png', 'champion3.png'),
(115, 29, 'the Plague Rat', 'Twitch', 'Twitch.png', 'champion3.png'),
(116, 11, 'the Wuju Bladesman', 'Master Yi', 'MasterYi.png', 'champion1.png'),
(117, 44, 'the Gem Knight', 'Taric', 'Taric.png', 'champion3.png'),
(118, 32, 'the Sad Mummy', 'Amumu', 'Amumu.png', 'champion0.png'),
(119, 41, 'the Saltwater Scourge', 'Gangplank', 'Gangplank.png', 'champion0.png'),
(120, 48, 'the Troll King', 'Trundle', 'Trundle.png', 'champion3.png'),
(121, 38, 'the Void Walker', 'Kassadin', 'Kassadin.png', 'champion1.png'),
(122, 161, 'the Eye of the Void', 'Vel''Koz', 'Velkoz.png', 'champion3.png'),
(123, 143, 'Rise of the Thorns', 'Zyra', 'Zyra.png', 'champion4.png'),
(124, 267, 'the Tidecaller', 'Nami', 'Nami.png', 'champion2.png'),
(125, 59, 'the Exemplar of Demacia', 'Jarvan IV', 'JarvanIV.png', 'champion1.png'),
(126, 81, 'the Prodigal Explorer', 'Ezreal', 'Ezreal.png', 'champion0.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
