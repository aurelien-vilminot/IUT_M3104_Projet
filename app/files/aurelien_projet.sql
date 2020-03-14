-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: mysql-aurelien.alwaysdata.net
-- Generation Time: Feb 22, 2020 at 05:55 PM
-- Server version: 10.2.17-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aurelien_projet`
--

-- --------------------------------------------------------

--
-- Table structure for table `DISCUSSION`
--

CREATE TABLE `DISCUSSION` (
  `ID` int(11) NOT NULL,
  `TITLE` varchar(50) NOT NULL,
  `STATE` tinyint(1) NOT NULL,
  `NB_LIKE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `DISCUSSION`
--

INSERT INTO `DISCUSSION` (`ID`, `TITLE`, `STATE`, `NB_LIKE`) VALUES
(1, 'Discussion 1', 0, 1),
(2, 'Discussion 2', 1, 2),
(3, 'Discussion 3', 1, 2),
(4, 'Discussion 4', 1, 3),
(5, 'Discussion 5', 1, 0),
(6, 'Discussion 6', 1, 2),
(7, 'Discussion 7', 1, 2),
(8, 'Discussion 8', 1, 1),
(9, 'Discussion 9', 1, 1),
(10, 'Discussion 10', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `LIKE_DISCUSSION`
--

CREATE TABLE `LIKE_DISCUSSION` (
  `ID_USER` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `ID_DISCUSSION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `LIKE_DISCUSSION`
--

INSERT INTO `LIKE_DISCUSSION` (`ID_USER`, `ID_DISCUSSION`) VALUES
('user1', 7),
('user1', 6),
('user1', 10),
('user1', 1),
('user1', 2),
('user1', 4),
('user2', 2),
('user2', 8),
('user2', 4),
('user2', 6),
('user3', 7),
('user3', 9),
('user3', 3),
('user4', 3),
('user4', 4);

-- --------------------------------------------------------

--
-- Table structure for table `MESSAGE`
--

CREATE TABLE `MESSAGE` (
  `ID` int(11) NOT NULL,
  `CONTENT` varchar(100) NOT NULL,
  `STATE` tinyint(1) NOT NULL,
  `ID_DISCUSSION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `MESSAGE`
--

INSERT INTO `MESSAGE` (`ID`, `CONTENT`, `STATE`, `ID_DISCUSSION`) VALUES
(1, 'Salut comment ça va', 0, 1),
(2, 'Bien et toi ?', 0, 1),
(3, 'Super merci !', 0, 1),
(4, 'Tu as vu le match hier?', 0, 1),
(5, 'Et oui !', 0, 1),
(6, 'C\'était du beau jeu de ballon', 0, 1),
(7, 'Et ma foi c\'est l\'OM!', 0, 1),
(8, 'Bon, allez j\'y vais.', 0, 1),
(9, 'Ok a+', 0, 1),
(10, 'Ciao :)', 0, 1),
(11, 'Salut comment ça va', 0, 2),
(12, 'Bien et toi ?', 0, 2),
(13, 'Super merci !', 0, 2),
(14, 'Tu as vu le match hier?', 0, 2),
(15, 'Et oui !', 0, 2),
(16, 'C\'était du beau jeu de ballon', 0, 2),
(17, 'Salut comment ça va', 0, 3),
(18, 'Bien et toi ?', 0, 3),
(19, 'Super merci !', 0, 3),
(20, 'Tu as vu le match hier?', 0, 3),
(21, 'Et oui !', 0, 3),
(22, 'C\'était du beau jeu de ballon', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `TOKEN_USER`
--

CREATE TABLE `TOKEN_USER` (
  `ID_USER` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `TOKEN` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `USER`
--

CREATE TABLE `USER` (
  `LOGIN` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `MAIL` varchar(50) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `ADMIN` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `USER`
--

INSERT INTO `USER` (`LOGIN`, `MAIL`, `PASSWORD`, `ADMIN`) VALUES
('Tom', 'itsneyraa@outlook.fr', '$2y$10$YWosdFWF9WaCsQCjZ7Bx9evgOVY1eKcOd7UV6vZU7hHOOldJ52jxe', 0),
('root', 'root@root.com', '$2y$10$0.IkIu3rbP.LfQ84seDaGemi8rSz/dVvFlTTy2mesfQ795b0PU.ZW', 1),
('user1', 'user1@fai.com', '$2y$10$vOLc0RyqOyGSa.w8xSk3sOVG.0aAndB9Okaf57plCnzM/XCIzP/CK', 0),
('user2', 'user2@fai.com', '$2y$10$u8wHIcLYiE8dP7KCEWMuoO3hf2kEoKGYg7/H5Ehg.f5qR4oNTQgVK', 0),
('user3', 'user3@fai.com', '$2y$10$s1KryMMhLt4XEbVtnaUva.IZWNNYoxkazah.s/JQyWhShQ8K2TEwW', 0),
('user4', 'user4@fai.com', '$2y$10$pOh6nd8XEzc9S2KS18sENuamECpsZL9ttAvo/Mdu1Myo8KVOxETSi', 0),
('user5', 'user5@fai.com', '$2y$10$11z4od9bNyDvqlxqXWJ8yu4XL4LHoYkfTFZpodVxZtaB2gw18IPMa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `USER_MESSAGE`
--

CREATE TABLE `USER_MESSAGE` (
  `ID_USER` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `ID_MESSAGE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `USER_MESSAGE`
--

INSERT INTO `USER_MESSAGE` (`ID_USER`, `ID_MESSAGE`) VALUES
('user1', 1),
('user2', 1),
('user1', 2),
('user2', 2),
('user1', 3),
('user2', 3),
('user1', 4),
('user2', 4),
('user3', 4),
('user1', 5),
('user2', 5),
('user1', 6),
('user2', 6),
('user3', 6),
('user1', 7),
('user2', 7),
('user3', 7),
('user1', 8),
('user2', 8),
('user1', 9),
('user2', 10),
('user1', 11),
('user2', 11),
('user1', 12),
('user2', 12),
('user1', 13),
('user2', 13),
('user1', 14),
('user2', 14),
('user3', 14),
('user1', 15),
('user2', 15),
('user1', 16),
('user2', 16),
('user3', 16),
('user1', 17),
('user2', 17),
('user1', 18),
('user2', 18),
('user1', 19),
('user2', 19),
('user1', 20),
('user2', 20),
('user3', 20),
('user1', 21),
('user2', 21),
('user1', 22),
('user2', 22),
('user3', 22);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `DISCUSSION`
--
ALTER TABLE `DISCUSSION`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `LIKE_DISCUSSION`
--
ALTER TABLE `LIKE_DISCUSSION`
  ADD KEY `C4` (`ID_USER`),
  ADD KEY `C5` (`ID_DISCUSSION`);

--
-- Indexes for table `MESSAGE`
--
ALTER TABLE `MESSAGE`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `C1` (`ID_DISCUSSION`);

--
-- Indexes for table `TOKEN_USER`
--
ALTER TABLE `TOKEN_USER`
  ADD KEY `C6` (`ID_USER`);

--
-- Indexes for table `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`LOGIN`);

--
-- Indexes for table `USER_MESSAGE`
--
ALTER TABLE `USER_MESSAGE`
  ADD KEY `C2` (`ID_USER`),
  ADD KEY `C3` (`ID_MESSAGE`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `DISCUSSION`
--
ALTER TABLE `DISCUSSION`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `MESSAGE`
--
ALTER TABLE `MESSAGE`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `LIKE_DISCUSSION`
--
ALTER TABLE `LIKE_DISCUSSION`
  ADD CONSTRAINT `C4` FOREIGN KEY (`ID_USER`) REFERENCES `USER` (`LOGIN`) ON UPDATE CASCADE,
  ADD CONSTRAINT `C5` FOREIGN KEY (`ID_DISCUSSION`) REFERENCES `DISCUSSION` (`ID`);

--
-- Constraints for table `MESSAGE`
--
ALTER TABLE `MESSAGE`
  ADD CONSTRAINT `C1` FOREIGN KEY (`ID_DISCUSSION`) REFERENCES `DISCUSSION` (`ID`);

--
-- Constraints for table `TOKEN_USER`
--
ALTER TABLE `TOKEN_USER`
  ADD CONSTRAINT `C6` FOREIGN KEY (`ID_USER`) REFERENCES `USER` (`LOGIN`) ON UPDATE CASCADE;

--
-- Constraints for table `USER_MESSAGE`
--
ALTER TABLE `USER_MESSAGE`
  ADD CONSTRAINT `C2` FOREIGN KEY (`ID_USER`) REFERENCES `USER` (`LOGIN`) ON UPDATE CASCADE,
  ADD CONSTRAINT `C3` FOREIGN KEY (`ID_MESSAGE`) REFERENCES `MESSAGE` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
