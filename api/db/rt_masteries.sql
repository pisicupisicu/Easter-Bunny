-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 28, 2015 at 09:01 PM
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
-- Table structure for table `rt_masteries`
--

CREATE TABLE IF NOT EXISTS `rt_masteries` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `mastery_id` int(11) NOT NULL,
  `ranks` int(11) NOT NULL,
  `description` text NOT NULL,
  `mastery_name` varchar(255) NOT NULL,
  `prereq` int(11) NOT NULL,
  `masteryTree` varchar(255) NOT NULL,
  `image_full` varchar(255) NOT NULL,
  `image_sprite` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `rt_masteries`
--

INSERT INTO `rt_masteries` (`ID`, `mastery_id`, `ranks`, `description`, `mastery_name`, `prereq`, `masteryTree`, `image_full`, `image_sprite`) VALUES
(1, 4353, 3, '+2% Cooldown Reduction and reduces the cooldown of Activated Items by 8% | +3.5% Cooldown Reduction and reduces the cooldown of Activated Items by 14% | +5% Cooldown Reduction and reduces the cooldown of Activated Items by 20% | ', 'Intelligence', 0, 'Utility', '4353.png', 'mastery0.png'),
(2, 4352, 1, 'Grants +3 Gold (+8 Gold on Melee champion) each time an enemy champion is attacked. This cannot trigger on the same champion more than once every 5 seconds | ', 'Bandit', 4342, 'Utility', '4352.png', 'mastery0.png'),
(3, 4253, 1, 'Reduces damage taken by 2% from enemies that have impaired movement (slows, snares, taunts, stuns, etc.) | ', 'Oppression', 0, 'Defense', '4253.png', 'mastery0.png'),
(4, 4113, 4, '+1.25% Cooldown Reduction | +2.5% Cooldown Reduction | +3.75% Cooldown Reduction | +5% Cooldown Reduction | ', 'Sorcery', 0, 'Offense', '4113.png', 'mastery0.png'),
(5, 4251, 1, 'Increases self-healing, Health Regen, Lifesteal, and Spellvamp by 10% when below 25% Health | ', 'Second Wind', 4241, 'Defense', '4251.png', 'mastery0.png'),
(6, 4112, 4, '+1.25% Attack Speed | +2.5% Attack Speed | +3.75% Attack Speed | +5% Attack Speed | ', 'Fury', 0, 'Offense', '4112.png', 'mastery0.png'),
(7, 4252, 4, 'Increases bonus Armor and Magic Resist by 2.5% | Increases bonus Armor and Magic Resist by 5% | Increases bonus Armor and Magic Resist by 7.5% | Increases bonus Armor and Magic Resist by 10% | ', 'Enchanted Armor', 0, 'Defense', '4252.png', 'mastery0.png'),
(8, 4111, 1, 'Melee - Deal an additional 2% damage and receive an additional 1% damage Ranged - Deal an additional 1.5% damage and receive an additional 1.5% damage | ', 'Double-Edged Sword', 0, 'Offense', '4111.png', 'mastery0.png'),
(9, 4152, 3, '+2% Armor and Magic Penetration | +4% Armor and Magic Penetration | +6% Armor and Magic Penetration | ', 'Devastating Strikes', 0, 'Offense', '4152.png', 'mastery0.png'),
(10, 4212, 2, '+1 Health per 5 seconds | +2 Health per 5 seconds | ', 'Recovery', 0, 'Defense', '4212.png', 'mastery0.png'),
(11, 4211, 2, 'Reduces incoming damage from champion basic attacks by 1 | Reduces incoming damage from champion basic attacks by 2 | ', 'Block', 0, 'Defense', '4211.png', 'mastery0.png'),
(12, 4151, 1, 'Critical hits grant +5% Attack Speed for 3 seconds (stacks up to 3 times) | ', 'Frenzy', 0, 'Offense', '4151.png', 'mastery0.png'),
(13, 4154, 1, 'Basic Attacks also deal bonus magic damage equal to 5% of Ability Power | ', 'Arcane Blade', 0, 'Offense', '4154.png', 'mastery0.png'),
(14, 4311, 1, 'Reduces the casting time of Recall by 1 second Dominion - Reduces the casting time of Enhanced Recall by 0.5 seconds | ', 'Phasewalker', 0, 'Utility', '4311.png', 'mastery0.png'),
(15, 4314, 1, 'Increases the cast range of trinket items by 15% | ', 'Scout', 0, 'Utility', '4314.png', 'mastery0.png'),
(16, 4362, 1, '+20 Movement Speed out of combat | ', 'Wanderer', 0, 'Utility', '4362.png', 'mastery0.png'),
(17, 4313, 3, '+25 Mana | +50 Mana | +75 Mana | ', 'Expanded Mind', 0, 'Utility', '4313.png', 'mastery0.png'),
(18, 4312, 3, '+0.5% Movement Speed | +1% Movement Speed | +1.5% Movement Speed | ', 'Fleet of Foot', 0, 'Utility', '4312.png', 'mastery0.png'),
(19, 4213, 2, 'Reduces the effectiveness of slows by 7.5% | Reduces the effectiveness of slows by 15% | ', 'Swiftness', 0, 'Defense', '4213.png', 'mastery0.png'),
(20, 4214, 2, 'Reduces damage taken from neutral monsters by 1 This does not affect lane minions | Reduces damage taken from neutral monsters by 2 This does not affect lane minions | ', 'Tough Skin', 0, 'Defense', '4214.png', 'mastery0.png'),
(21, 4114, 1, 'Basic attacks and single target spells deal an additional 2 damage to minions and monsters This does not trigger off of area of effect damage or damage over time effects | ', 'Butcher', 0, 'Offense', '4114.png', 'mastery0.png'),
(22, 4122, 3, '+4 Attack Damage at level 18 (+0.22 Attack Damage per level) | +7 Attack Damage at level 18 (+0.39 Attack Damage per level) | +10 Attack Damage at level 18 (+0.55 Attack Damage per level) | ', 'Brute Force', 0, 'Offense', '4122.png', 'mastery0.png'),
(23, 4121, 1, 'Damaging an enemy with a spell increases allied champions'' damage to that enemy by 1% for the next 3 seconds | ', 'Expose Weakness', 0, 'Offense', '4121.png', 'mastery0.png'),
(24, 4124, 1, 'Killing a unit restores 3 Health and 1 Mana | ', 'Feast', 4114, 'Offense', '4124.png', 'mastery0.png'),
(25, 4262, 1, '+3 Armor and Magic Resist for each nearby enemy champion | ', 'Legendary Guardian', 0, 'Defense', '4262.png', 'mastery0.png'),
(26, 4123, 3, '+6 Ability Power at level 18 (+0.33 Ability Power per level) | +11 Ability Power at level 18 (+0.61 Ability Power per level) | +16 Ability Power at level 18 (+0.89 Ability Power per level) | ', 'Mental Force', 0, 'Offense', '4123.png', 'mastery0.png'),
(27, 4221, 1, 'Melee - Reduces all incoming damage from champions by 2 Ranged - Reduces all incoming damage from champions by 1 | ', 'Unyielding', 4211, 'Defense', '4221.png', 'mastery0.png'),
(28, 4162, 1, '+3% increased damage | ', 'Havoc', 0, 'Offense', '4162.png', 'mastery0.png'),
(29, 4222, 3, '+12 Health | +24 Health | +36 Health | ', 'Veteran''s Scars', 0, 'Defense', '4222.png', 'mastery0.png'),
(30, 4322, 3, 'Reduces the cooldown of Summoner Spells by 4% | Reduces the cooldown of Summoner Spells by 7% | Reduces the cooldown of Summoner Spells by 10% | ', 'Summoner''s Insight', 0, 'Utility', '4322.png', 'mastery0.png'),
(31, 4333, 3, '+1% Lifesteal and Spellvamp | +2% Lifesteal and Spellvamp | +3% Lifesteal and Spellvamp | ', 'Vampirism', 0, 'Utility', '4333.png', 'mastery0.png'),
(32, 4332, 1, 'Increases the duration of shrine, relic, quest, and neutral monster buffs by 20% | ', 'Runic Affinity', 0, 'Utility', '4332.png', 'mastery0.png'),
(33, 4224, 1, 'Taking Basic Attack Damage from neutral monsters cause them to bleed, dealing physical damage equal to 1% of their current Health each second This does not work against lane minions | ', 'Bladed Armor', 4214, 'Defense', '4224.png', 'mastery0.png'),
(34, 4331, 3, '+0.5 Gold every 10 seconds | +1 Gold every 10 seconds | +1.5 Gold every 10 seconds | ', 'Greed', 0, 'Utility', '4331.png', 'mastery0.png'),
(35, 4134, 3, 'Increases damage dealt to champions below 20% Health by 5% | Increases damage dealt to champions below 35% Health by 5% | Increases damage dealt to champions below 50% Health by 5% | ', 'Executioner', 0, 'Offense', '4134.png', 'mastery0.png'),
(36, 4132, 1, '+4 Attack Damage | ', 'Martial Mastery', 4122, 'Offense', '4132.png', 'mastery0.png'),
(37, 4133, 1, '+6 Ability Power | ', 'Arcane Mastery', 4123, 'Offense', '4133.png', 'mastery0.png'),
(38, 4234, 3, '+2 Magic Resist | +3.5 Magic Resist | +5 Magic Resist | ', 'Resistance', 0, 'Defense', '4234.png', 'mastery0.png'),
(39, 4131, 1, 'Damaging an enemy champion with a Basic Attack increases Spell Damage by 1%, stacking up to 3 times (max 3% damage increase) | ', 'Spell Weaving', 0, 'Offense', '4131.png', 'mastery0.png'),
(40, 4233, 3, '+2 Armor | +3.5 Armor | +5 Armor | ', 'Hardiness', 0, 'Defense', '4233.png', 'mastery0.png'),
(41, 4232, 1, '+3% Maximum Health | ', 'Juggernaut', 4222, 'Defense', '4232.png', 'mastery0.png'),
(42, 4323, 1, '+1 Health Regen per 5 seconds for every 300 maximum Mana | ', 'Strength of Spirit', 4313, 'Utility', '4323.png', 'mastery0.png'),
(43, 4231, 1, 'Reduces the duration of crowd control effects by 10% | ', 'Tenacious', 0, 'Defense', '4231.png', 'mastery0.png'),
(44, 4324, 1, 'Increases the duration of potions and elixirs by 10% | ', 'Alchemist', 0, 'Utility', '4324.png', 'mastery0.png'),
(45, 4342, 1, '+40 Starting Gold | ', 'Wealth', 0, 'Utility', '4342.png', 'mastery0.png'),
(46, 4341, 1, '+1 Gold each time an ally kills a nearby lane minion | ', 'Scavenger', 4331, 'Utility', '4341.png', 'mastery0.png'),
(47, 4344, 2, '+10 Experience every 10 seconds while near a higher level allied champion | +20 Experience every 10 seconds while near a higher level allied champion | ', 'Inspiration', 0, 'Utility', '4344.png', 'mastery0.png'),
(48, 4343, 3, 'Restore 0.5% of missing Mana every 5 seconds | Restore 1.0% of missing Mana every 5 seconds | Restore 1.5% of missing Mana every 5 seconds | ', 'Meditation', 0, 'Utility', '4343.png', 'mastery0.png'),
(49, 4143, 3, 'Increases Ability Power by 2% | Increases Ability Power by 3.5% | Increases Ability Power by 5% | ', 'Archmage', 0, 'Offense', '4143.png', 'mastery0.png'),
(50, 4144, 1, 'Champion kills and assists restore 5% missing Health and Mana | ', 'Dangerous Game', 4134, 'Offense', '4144.png', 'mastery0.png'),
(51, 4241, 3, 'Regenerates 0.35% of missing Health every 5 seconds | Regenerates 0.675% of missing Health every 5 seconds | Regenerates 1% of missing Health every 5 seconds | ', 'Perseverance ', 0, 'Defense', '4241.png', 'mastery0.png'),
(52, 4334, 1, 'Health potions are upgraded into Biscuits that restore an additional 20 Health and 10 Mana instantly upon consumption | ', 'Culinary Master', 4324, 'Utility', '4334.png', 'mastery0.png'),
(53, 4243, 1, 'Reduces the total damage taken from critical strikes by 10% | ', 'Reinforced Armor', 4233, 'Defense', '4243.png', 'mastery0.png'),
(54, 4242, 1, 'Gain 4% of your bonus Armor as Magic Resist if you have more bonus Armor than bonus Magic Resist Gain 4% of your bonus Magic Resist as Armor if you have more bonus Magic Resist than bonus Armor | ', 'Adaptive Armor', 0, 'Defense', '4242.png', 'mastery0.png'),
(55, 4141, 1, 'Damaging an enemy champion with a spell increases Basic Attack Damage by 1%, stacking up to 3 times (max 3% damage increase) | ', 'Blade Weaving', 4131, 'Offense', '4141.png', 'mastery0.png'),
(56, 4142, 3, 'Increases bonus Attack Damage by 2% | Increases Bonus Attack Damage by 3.5% | Increases Bonus Attack Damage by 5% | ', 'Warlord', 0, 'Offense', '4142.png', 'mastery0.png'),
(57, 4244, 1, 'Reduces damage taken by 4% from Area of Effect magic damage | ', 'Evasive', 4234, 'Defense', '4244.png', 'mastery0.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
