-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Aug 03, 2023 at 02:17 PM
-- Server version: 10.6.12-MariaDB-1:10.6.12+maria~ubu2004-log
-- PHP Version: 8.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `FinalBattle`
--
CREATE DATABASE IF NOT EXISTS `FinalBattle` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `FinalBattle`;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `nameClass` varchar(30) NOT NULL,
  `avatar` varchar(80) NOT NULL,
  `side` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `nameClass`, `avatar`, `side`) VALUES
(1, 'Warrior', 'images/warrior.gif', 'hero'),
(2, 'Rogue', 'images/rogue.gif', 'hero'),
(3, 'Mage', 'images/wizard.gif', 'hero'),
(4, 'Ranger', 'images/ranger.gif', 'hero'),
(5, 'Ogre', 'images/monster.png', 'monster'),
(6, 'Sorcier', 'images/monster1.png', 'monster'),
(7, 'Fantassin', 'images/monster2.png', 'monster'),
(8, 'cleric', 'images/monstre3.png', 'monster');

-- --------------------------------------------------------

--
-- Table structure for table `heroes`
--

CREATE TABLE `heroes` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `health_point` int(11) NOT NULL DEFAULT 100,
  `attack` int(11) NOT NULL DEFAULT 50,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `heroes`
--

INSERT INTO `heroes` (`id`, `name`, `health_point`, `attack`, `class_id`) VALUES
(4, 'mathieu', 100, 50, 4),
(5, 'ismael', 100, 60, 2),
(6, 'Alexandre', 80, 30, 3),
(7, 'yvan', 140, 40, 1),
(8, 'david', 80, 30, 3),
(9, 'melyne', 100, 50, 4),
(10, 'mélanie', 100, 50, 4),
(11, 'Gérard', 100, 50, 4),
(20, 'soslan', 140, 40, 1),
(22, 'hamza', 80, 30, 3),
(27, 'serge', 140, 40, 1),
(29, 'hamza', 80, 30, 3);

-- --------------------------------------------------------

--
-- Table structure for table `monsters`
--

CREATE TABLE `monsters` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `health_point` int(11) NOT NULL DEFAULT 100,
  `avatar` varchar(50) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monsters`
--

INSERT INTO `monsters` (`id`, `name`, `health_point`, `avatar`, `class_id`) VALUES
(1, 'Bard', 300, 'images/sorcier.gif', 6),
(2, 'MidJourney', 300, 'images/ogre.gif', 5),
(3, 'ChatGPT', 300, 'images/fantassin.gif', 7),
(4, 'DALL-E', 300, 'images/cleric.gif', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `heroes`
--
ALTER TABLE `heroes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `monsters`
--
ALTER TABLE `monsters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `heroes`
--
ALTER TABLE `heroes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `monsters`
--
ALTER TABLE `monsters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `heroes`
--
ALTER TABLE `heroes`
  ADD CONSTRAINT `hero_to_class` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `monsters`
--
ALTER TABLE `monsters`
  ADD CONSTRAINT `monster_to_class` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
