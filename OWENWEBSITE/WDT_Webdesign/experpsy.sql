-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2024 at 05:58 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `experpsy`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `msg_date` datetime DEFAULT NULL,
  `msg_from` varchar(8) DEFAULT NULL,
  `msg_to` varchar(8) DEFAULT NULL,
  `message` varchar(1024) CHARACTER SET utf16 COLLATE utf16_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `msg_date`, `msg_from`, `msg_to`, `message`) VALUES
(64, '2024-02-18 12:45:26', 'USER101', 'corvin', 'Hello Corvin'),
(65, '2024-02-18 12:45:38', 'USER101', 'corvin', 'I need a Psychologist Help Service'),
(66, '2024-02-18 12:45:53', 'corvin', 'USER101', 'Hello there how may I help you with?');

-- --------------------------------------------------------

--
-- Table structure for table `psychologist`
--

CREATE TABLE `psychologist` (
  `psycho_id` int(11) NOT NULL,
  `user_id` varchar(8) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `description` varchar(512) CHARACTER SET utf16 COLLATE utf16_general_ci DEFAULT NULL,
  `photo` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `psychologist`
--

INSERT INTO `psychologist` (`psycho_id`, `user_id`, `name`, `description`, `photo`) VALUES
(1, 'elonmusk', '(PL)Elon Musk', 'Elon Musk is a businessman and investor who is known for his work in space transportation and exploration, electric vehicles and renewable energy, artificial intelligence, infrastructure, and transportation. He is the founder, chairman, CEO, and CTO of SpaceX; angel investor, CEO, product architect, and former chairman of Tesla, Inc.; owner, chairman, and CTO of X Corp.; founder of the Boring Company and xAI; co-founder of Neuralink and OpenAI; and president of the Musk Foundation. Musk was born in Pretoria', 'Elonmusk.jpg'),
(2, 'corvin', '(PL)Corvin', 'A complete dumbass. Any suggestion from him will turn out to be wrong so badly.', 'Corvin.jpg'),
(3, 'owen', '(PL)OWEN', 'I\'m OWEN, The ExperPsy Founder & Owner. I myself is the Psychologist which I was very interested on Helping people and also trying to make my OWN life better. I\'m here to help you and let\'s improve our lives TOGETHER.', 'IMG_20230705_090504.jpg'),
(4, 'donalt', '(PL)Random Dude', 'A random dude, just to fill the page', 'donald-trump-cnn-tweet.jpg'),
(9, 'message', 'Check Message', 'Check you message purposes', 'checknewmessage.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `psychologist`
--
ALTER TABLE `psychologist`
  ADD PRIMARY KEY (`psycho_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `psychologist`
--
ALTER TABLE `psychologist`
  MODIFY `psycho_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
