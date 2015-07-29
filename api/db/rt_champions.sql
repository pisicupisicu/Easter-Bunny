-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 27, 2015 at 08:23 PM
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
  `tags` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=127 ;

--
-- Dumping data for table `rt_champions`
--

INSERT INTO `rt_champions` (`id`, `api_id`, `title`, `name`, `image_full`, `image_sprite`, `tags`) VALUES
(1, 412, 'the Chain Warden', 'Thresh', 'Thresh.png', 'champion3.png', 'Support,Fighter'),
(2, 266, 'the Darkin Blade', 'Aatrox', 'Aatrox.png', 'champion0.png', 'Fighter,Tank'),
(3, 23, 'the Barbarian King', 'Tryndamere', 'Tryndamere.png', 'champion3.png', 'Fighter,Assassin'),
(4, 79, 'the Rabble Rouser', 'Gragas', 'Gragas.png', 'champion1.png', 'Fighter,Mage'),
(5, 69, 'the Serpent''s Embrace', 'Cassiopeia', 'Cassiopeia.png', 'champion0.png', 'Mage'),
(6, 78, 'the Iron Ambassador', 'Poppy', 'Poppy.png', 'champion2.png', 'Fighter,Assassin'),
(7, 13, 'the Rogue Mage', 'Ryze', 'Ryze.png', 'champion2.png', 'Mage,Fighter'),
(8, 14, 'The Undead Juggernaut', 'Sion', 'Sion.png', 'champion2.png', 'Tank,Fighter'),
(9, 1, 'the Dark Child', 'Annie', 'Annie.png', 'champion0.png', 'Mage'),
(10, 43, 'the Enlightened One', 'Karma', 'Karma.png', 'champion1.png', 'Mage,Support'),
(11, 111, 'the Titan of the Depths', 'Nautilus', 'Nautilus.png', 'champion2.png', 'Tank,Fighter'),
(12, 99, 'the Lady of Luminosity', 'Lux', 'Lux.png', 'champion1.png', 'Mage,Support'),
(13, 103, 'the Nine-Tailed Fox', 'Ahri', 'Ahri.png', 'champion0.png', 'Mage,Assassin'),
(14, 2, 'the Berserker', 'Olaf', 'Olaf.png', 'champion2.png', 'Fighter,Tank'),
(15, 112, 'the Machine Herald', 'Viktor', 'Viktor.png', 'champion3.png', 'Mage'),
(16, 34, 'the Cryophoenix', 'Anivia', 'Anivia.png', 'champion0.png', 'Mage,Support'),
(17, 86, 'The Might of Demacia', 'Garen', 'Garen.png', 'champion0.png', 'Fighter,Tank'),
(18, 27, 'the Mad Chemist', 'Singed', 'Singed.png', 'champion2.png', 'Tank,Fighter'),
(19, 127, 'the Ice Witch', 'Lissandra', 'Lissandra.png', 'champion1.png', 'Mage'),
(20, 57, 'the Twisted Treant', 'Maokai', 'Maokai.png', 'champion1.png', 'Tank,Mage'),
(21, 25, 'Fallen Angel', 'Morgana', 'Morgana.png', 'champion2.png', 'Mage,Support'),
(22, 28, 'the Widowmaker', 'Evelynn', 'Evelynn.png', 'champion0.png', 'Assassin,Mage'),
(23, 105, 'the Tidal Trickster', 'Fizz', 'Fizz.png', 'champion0.png', 'Assassin,Fighter'),
(24, 238, 'the Master of Shadows', 'Zed', 'Zed.png', 'champion3.png', 'Assassin,Fighter'),
(25, 74, 'the Revered Inventor', 'Heimerdinger', 'Heimerdinger.png', 'champion1.png', 'Mage,Support'),
(26, 68, 'the Mechanized Menace', 'Rumble', 'Rumble.png', 'champion2.png', 'Fighter,Mage'),
(27, 82, 'the Master of Metal', 'Mordekaiser', 'Mordekaiser.png', 'champion2.png', 'Fighter,Mage'),
(28, 37, 'Maven of the Strings', 'Sona', 'Sona.png', 'champion3.png', 'Support,Mage'),
(29, 55, 'the Sinister Blade', 'Katarina', 'Katarina.png', 'champion1.png', 'Assassin,Mage'),
(30, 96, 'the Mouth of the Abyss', 'Kog''Maw', 'KogMaw.png', 'champion1.png', 'Marksman,Mage'),
(31, 22, 'the Frost Archer', 'Ashe', 'Ashe.png', 'champion0.png', 'Marksman,Support'),
(32, 117, 'the Fae Sorceress', 'Lulu', 'Lulu.png', 'champion1.png', 'Support,Mage'),
(33, 30, 'the Deathsinger', 'Karthus', 'Karthus.png', 'champion1.png', 'Mage'),
(34, 12, 'the Minotaur', 'Alistar', 'Alistar.png', 'champion0.png', 'Tank,Support'),
(35, 122, 'the Hand of Noxus', 'Darius', 'Darius.png', 'champion0.png', 'Fighter,Tank'),
(36, 67, 'the Night Hunter', 'Vayne', 'Vayne.png', 'champion3.png', 'Marksman,Assassin'),
(37, 110, 'the Arrow of Retribution', 'Varus', 'Varus.png', 'champion3.png', 'Marksman,Mage'),
(38, 77, 'the Spirit Walker', 'Udyr', 'Udyr.png', 'champion3.png', 'Fighter,Tank'),
(39, 126, 'the Defender of Tomorrow', 'Jayce', 'Jayce.png', 'champion1.png', 'Fighter,Marksman'),
(40, 89, 'the Radiant Dawn', 'Leona', 'Leona.png', 'champion1.png', 'Tank,Support'),
(41, 134, 'the Dark Sovereign', 'Syndra', 'Syndra.png', 'champion3.png', 'Mage,Support'),
(42, 80, 'the Artisan of War', 'Pantheon', 'Pantheon.png', 'champion2.png', 'Fighter,Assassin'),
(43, 121, 'the Voidreaver', 'Kha''Zix', 'Khazix.png', 'champion1.png', 'Assassin,Fighter'),
(44, 92, 'the Exile', 'Riven', 'Riven.png', 'champion2.png', 'Fighter,Assassin'),
(45, 42, 'the Daring Bombardier', 'Corki', 'Corki.png', 'champion0.png', 'Marksman'),
(46, 268, 'the Emperor of the Sands', 'Azir', 'Azir.png', 'champion0.png', 'Mage,Marksman'),
(47, 51, 'the Sheriff of Piltover', 'Caitlyn', 'Caitlyn.png', 'champion0.png', 'Marksman'),
(48, 76, 'the Bestial Huntress', 'Nidalee', 'Nidalee.png', 'champion2.png', 'Assassin,Fighter'),
(49, 3, 'the Sentinel''s Sorrow', 'Galio', 'Galio.png', 'champion0.png', 'Tank,Mage'),
(50, 85, 'the Heart of the Tempest', 'Kennen', 'Kennen.png', 'champion1.png', 'Mage,Marksman'),
(51, 45, 'the Tiny Master of Evil', 'Veigar', 'Veigar.png', 'champion3.png', 'Mage'),
(52, 432, 'the Wandering Caretaker', 'Bard', 'Bard.png', 'champion4.png', 'Support,Mage'),
(53, 150, 'the Missing Link', 'Gnar', 'Gnar.png', 'champion0.png', 'Fighter,Tank'),
(54, 104, 'the Outlaw', 'Graves', 'Graves.png', 'champion1.png', 'Marksman'),
(55, 90, 'the Prophet of the Void', 'Malzahar', 'Malzahar.png', 'champion1.png', 'Mage,Assassin'),
(56, 254, 'the Piltover Enforcer', 'Vi', 'Vi.png', 'champion3.png', 'Fighter,Assassin'),
(57, 10, 'The Judicator', 'Kayle', 'Kayle.png', 'champion1.png', 'Fighter,Support'),
(58, 39, 'the Will of the Blades', 'Irelia', 'Irelia.png', 'champion1.png', 'Fighter,Assassin'),
(59, 64, 'the Blind Monk', 'Lee Sin', 'LeeSin.png', 'champion1.png', 'Fighter,Assassin'),
(60, 60, 'The Spider Queen', 'Elise', 'Elise.png', 'champion0.png', 'Mage,Fighter'),
(61, 106, 'the Thunder''s Roar', 'Volibear', 'Volibear.png', 'champion3.png', 'Fighter,Tank'),
(62, 20, 'the Yeti Rider', 'Nunu', 'Nunu.png', 'champion2.png', 'Support,Fighter'),
(63, 4, 'the Card Master', 'Twisted Fate', 'TwistedFate.png', 'champion3.png', 'Mage'),
(64, 24, 'Grandmaster at Arms', 'Jax', 'Jax.png', 'champion1.png', 'Fighter,Assassin'),
(65, 102, 'the Half-Dragon', 'Shyvana', 'Shyvana.png', 'champion2.png', 'Fighter,Tank'),
(66, 429, 'the Spear of Vengeance', 'Kalista', 'Kalista.png', 'champion1.png', 'Marksman'),
(67, 36, 'the Madman of Zaun', 'Dr. Mundo', 'DrMundo.png', 'champion0.png', 'Fighter,Tank'),
(68, 223, 'the River King', 'Tahm Kench', 'TahmKench.png', 'champion4.png', 'Support,Tank'),
(69, 63, 'the Burning Vengeance', 'Brand', 'Brand.png', 'champion0.png', 'Mage'),
(70, 131, 'Scorn of the Moon', 'Diana', 'Diana.png', 'champion0.png', 'Fighter,Mage'),
(71, 113, 'the Winter''s Wrath', 'Sejuani', 'Sejuani.png', 'champion2.png', 'Tank,Fighter'),
(72, 8, 'the Crimson Reaper', 'Vladimir', 'Vladimir.png', 'champion3.png', 'Mage,Tank'),
(73, 154, 'the Secret Weapon', 'Zac', 'Zac.png', 'champion3.png', 'Tank,Fighter'),
(74, 421, 'the Void Burrower', 'Rek''Sai', 'RekSai.png', 'champion2.png', 'Fighter'),
(75, 133, 'Demacia''s Wings', 'Quinn', 'Quinn.png', 'champion2.png', 'Marksman,Fighter'),
(76, 84, 'the Fist of Shadow', 'Akali', 'Akali.png', 'champion0.png', 'Assassin'),
(77, 18, 'the Yordle Gunner', 'Tristana', 'Tristana.png', 'champion3.png', 'Marksman,Assassin'),
(78, 120, 'the Shadow of War', 'Hecarim', 'Hecarim.png', 'champion1.png', 'Fighter,Tank'),
(79, 15, 'the Battle Mistress', 'Sivir', 'Sivir.png', 'champion2.png', 'Marksman'),
(80, 236, 'the Purifier', 'Lucian', 'Lucian.png', 'champion1.png', 'Marksman'),
(81, 107, 'the Pridestalker', 'Rengar', 'Rengar.png', 'champion2.png', 'Assassin,Fighter'),
(82, 19, 'the Blood Hunter', 'Warwick', 'Warwick.png', 'champion3.png', 'Fighter,Tank'),
(83, 72, 'the Crystal Vanguard', 'Skarner', 'Skarner.png', 'champion2.png', 'Fighter,Tank'),
(84, 54, 'Shard of the Monolith', 'Malphite', 'Malphite.png', 'champion1.png', 'Tank,Fighter'),
(85, 157, 'the Unforgiven', 'Yasuo', 'Yasuo.png', 'champion3.png', 'Fighter,Assassin'),
(86, 101, 'the Magus Ascendant', 'Xerath', 'Xerath.png', 'champion3.png', 'Mage,Assassin'),
(87, 17, 'the Swift Scout', 'Teemo', 'Teemo.png', 'champion3.png', 'Marksman,Assassin'),
(88, 75, 'the Curator of the Sands', 'Nasus', 'Nasus.png', 'champion2.png', 'Fighter,Tank'),
(89, 58, 'the Butcher of the Sands', 'Renekton', 'Renekton.png', 'champion2.png', 'Fighter,Tank'),
(90, 119, 'the Glorious Executioner', 'Draven', 'Draven.png', 'champion0.png', 'Marksman'),
(91, 35, 'the Demon Jester', 'Shaco', 'Shaco.png', 'champion2.png', 'Assassin'),
(92, 50, 'the Master Tactician', 'Swain', 'Swain.png', 'champion3.png', 'Mage,Fighter'),
(93, 115, 'the Hexplosives Expert', 'Ziggs', 'Ziggs.png', 'champion4.png', 'Mage'),
(94, 91, 'the Blade''s Shadow', 'Talon', 'Talon.png', 'champion3.png', 'Assassin,Fighter'),
(95, 40, 'the Storm''s Fury', 'Janna', 'Janna.png', 'champion1.png', 'Support,Mage'),
(96, 245, 'the Boy Who Shattered Time', 'Ekko', 'Ekko.png', 'champion4.png', 'Assassin,Fighter'),
(97, 61, 'the Lady of Clockwork', 'Orianna', 'Orianna.png', 'champion2.png', 'Mage,Support'),
(98, 9, 'the Harbinger of Doom', 'Fiddlesticks', 'FiddleSticks.png', 'champion0.png', 'Mage,Support'),
(99, 114, 'the Grand Duelist', 'Fiora', 'Fiora.png', 'champion0.png', 'Fighter,Assassin'),
(100, 31, 'the Terror of the Void', 'Cho''Gath', 'Chogath.png', 'champion0.png', 'Tank,Mage'),
(101, 33, 'the Armordillo', 'Rammus', 'Rammus.png', 'champion2.png', 'Tank,Fighter'),
(102, 7, 'the Deceiver', 'LeBlanc', 'Leblanc.png', 'champion1.png', 'Assassin,Mage'),
(103, 26, 'the Chronokeeper', 'Zilean', 'Zilean.png', 'champion4.png', 'Support,Mage'),
(104, 16, 'the Starchild', 'Soraka', 'Soraka.png', 'champion3.png', 'Support,Mage'),
(105, 56, 'the Eternal Nightmare', 'Nocturne', 'Nocturne.png', 'champion2.png', 'Assassin,Fighter'),
(106, 222, 'the Loose Cannon', 'Jinx', 'Jinx.png', 'champion1.png', 'Marksman'),
(107, 83, 'the Gravedigger', 'Yorick', 'Yorick.png', 'champion3.png', 'Fighter,Mage'),
(108, 6, 'the Headsman''s Pride', 'Urgot', 'Urgot.png', 'champion3.png', 'Marksman,Fighter'),
(109, 21, 'the Bounty Hunter', 'Miss Fortune', 'MissFortune.png', 'champion2.png', 'Marksman'),
(110, 62, 'the Monkey King', 'Wukong', 'MonkeyKing.png', 'champion2.png', 'Fighter,Tank'),
(111, 53, 'the Great Steam Golem', 'Blitzcrank', 'Blitzcrank.png', 'champion0.png', 'Tank,Fighter'),
(112, 98, 'Eye of Twilight', 'Shen', 'Shen.png', 'champion2.png', 'Tank,Fighter'),
(113, 201, 'the Heart of the Freljord', 'Braum', 'Braum.png', 'champion0.png', 'Support,Tank'),
(114, 5, 'the Seneschal of Demacia', 'Xin Zhao', 'XinZhao.png', 'champion3.png', 'Fighter,Assassin'),
(115, 29, 'the Plague Rat', 'Twitch', 'Twitch.png', 'champion3.png', 'Marksman,Assassin'),
(116, 11, 'the Wuju Bladesman', 'Master Yi', 'MasterYi.png', 'champion1.png', 'Assassin,Fighter'),
(117, 44, 'the Gem Knight', 'Taric', 'Taric.png', 'champion3.png', 'Support,Fighter'),
(118, 32, 'the Sad Mummy', 'Amumu', 'Amumu.png', 'champion0.png', 'Tank,Mage'),
(119, 41, 'the Saltwater Scourge', 'Gangplank', 'Gangplank.png', 'champion0.png', 'Fighter,Melee'),
(120, 48, 'the Troll King', 'Trundle', 'Trundle.png', 'champion3.png', 'Fighter,Tank'),
(121, 38, 'the Void Walker', 'Kassadin', 'Kassadin.png', 'champion1.png', 'Assassin,Mage'),
(122, 161, 'the Eye of the Void', 'Vel''Koz', 'Velkoz.png', 'champion3.png', 'Mage'),
(123, 143, 'Rise of the Thorns', 'Zyra', 'Zyra.png', 'champion4.png', 'Mage,Support'),
(124, 267, 'the Tidecaller', 'Nami', 'Nami.png', 'champion2.png', 'Support,Mage'),
(125, 59, 'the Exemplar of Demacia', 'Jarvan IV', 'JarvanIV.png', 'champion1.png', 'Tank,Fighter'),
(126, 81, 'the Prodigal Explorer', 'Ezreal', 'Ezreal.png', 'champion0.png', 'Marksman,Mage');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
