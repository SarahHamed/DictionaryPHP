-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2021 at 11:11 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nti`
--

-- --------------------------------------------------------

--
-- Table structure for table `myusers`
--

CREATE TABLE `myusers` (
  `userId` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int(11) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `dicId` int(11) DEFAULT NULL,
  `depID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `myusers`
--

INSERT INTO `myusers` (`userId`, `password`, `name`, `email`, `phone`, `specialization`, `dicId`, `depID`) VALUES
(2, 'Abcdef&2', 'Raheeq', 'Raheeq@hotmail.com', 123456789, 'Engineering', NULL, 1),
(3, 'Abcdef&2', 'Shosho', 'shosho@hotmail.com', 1234567890, 'Engineering', NULL, 1),
(4, 'Abcdef&2', 'Reem', 'reem@hotmail.com', 123654795, 'Engineering', NULL, 1),
(5, 'Abcdef&2', 'Lama', 'lama@hotmail.com', 963258741, 'Engineering', NULL, 1),
(6, 'Abcdef&2', 'Aya', 'aya@hotmail.com', 1236547895, 'Bussiness', NULL, 4),
(7, 'Abcdef&2', 'Mariem', 'mariem@hotmail.com', 963258741, 'Medicine', NULL, 2),
(8, 'Abcdef&2', 'Fareda', 'fareda@hotmail.com', 932617754, 'NotSelected', NULL, 5),
(9, 'Abcdef&2', 'mm', 'mm@hotmail.com', 147852369, 'NotSelected', NULL, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `myusers`
--
ALTER TABLE `myusers`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `dicId` (`dicId`),
  ADD KEY `depID` (`depID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `myusers`
--
ALTER TABLE `myusers`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `myusers`
--
ALTER TABLE `myusers`
  ADD CONSTRAINT `dep` FOREIGN KEY (`depID`) REFERENCES `departments` (`depID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `dictionaryId` FOREIGN KEY (`dicId`) REFERENCES `tableclassification` (`dicId`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
