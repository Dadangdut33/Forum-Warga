-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 22, 2022 at 04:38 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum_sederhana`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(1000) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userID` varchar(50) NOT NULL,
  `postID` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_UserComment` (`userID`),
  KEY `FK_CommentPost` (`postID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `details` varchar(500) NOT NULL,
  `link` varchar(500) DEFAULT NULL,
  `type` varchar(300) DEFAULT NULL,
  `isRead` tinyint(1) DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userID` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_UserNotif` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `content` varchar(5000) DEFAULT NULL,
  `pinned` int(1) NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `views` bigint(20) NOT NULL DEFAULT '0',
  `userID` varchar(50) NOT NULL,
  `topicID` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_UserPost` (`userID`),
  KEY `FK_PostTopic` (`topicID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `pinned`, `time`, `views`, `userID`, `topicID`) VALUES
(2, 'test  ', 'dasd asd asd asd asdasdasdasdasdasdadasdasdasdadasdas ', 0, '2022-11-30 13:44:42', 18, 'Fauzan', 7),
(5, 'tasdas        ', 'd asd as dad asd asdada', 1, '2022-12-21 14:22:28', 49, 'Fauzan', 7);

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

DROP TABLE IF EXISTS `topic`;
CREATE TABLE IF NOT EXISTS `topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`id`, `name`) VALUES
(7, 'General'),
(8, 'Announcement'),
(9, 'News'),
(10, 'Games'),
(11, 'Technology');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `email` varchar(100) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT '0',
  `bio` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `isAdmin`, `bio`) VALUES
('Ammar', '$2y$10$8oEauy1b6IQfsbMNKEgWeuw3k6vdsmQmBEt19TaMlXBxWUcd5JPeK', 'ammar@gmail.com', 1, ''),
('Cherrie', '$2y$10$eMHg3nKdzvsQsrfTspnMROeqiK15WHscnxeToBmvwAf7GB8gyIVzq', 'cherrie@gmail.com', 1, ''),
('Fardal', '$2y$10$GN1maH6HoBxIkpIQPfygZuksk1fuD3GZNxJpzXj.ivpCO90/e5qNi', 'fardal@gmail.com', 1, ''),
('Fauzan', '$2y$10$Ec1Pct9cNfV4LIDKnLkSUesxyJrcrvARsm.Fm/PHHCryghrZ8if5C', 'fauzan@gmail.com', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `web_config`
--

DROP TABLE IF EXISTS `web_config`;
CREATE TABLE IF NOT EXISTS `web_config` (
  `id` int(11) NOT NULL DEFAULT '1',
  `forum_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `web_config`
--

INSERT INTO `web_config` (`id`, `forum_name`) VALUES
(1, 'Ciputat');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_CommentPost` FOREIGN KEY (`postID`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_UserComment` FOREIGN KEY (`userID`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `FK_UserNotif` FOREIGN KEY (`userID`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_PostTopic` FOREIGN KEY (`topicID`) REFERENCES `topic` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_UserPost` FOREIGN KEY (`userID`) REFERENCES `users` (`username`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
