-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2023 at 04:25 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinevotingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `CandidateID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `cname` varchar(255) NOT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `ElectionID` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`CandidateID`, `UserID`, `cname`, `Photo`, `ElectionID`, `status`) VALUES
(29, 60280, 'vikkram', '../uploads/vikkram.jpg', 160, 0),
(30, 62866, 'suresh', '../uploads/suresh.png', 160, 0),
(31, 31846, 'Vignesh', '../uploads/vignesh.jpg', 160, 0),
(32, 6237, 'Gladwin A J', '../uploads/gladwin.png', 160, 0);

-- --------------------------------------------------------

--
-- Table structure for table `elections`
--

CREATE TABLE `elections` (
  `ElectionID` int(11) NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Start_Date` date NOT NULL,
  `End_Date` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `elections`
--

INSERT INTO `elections` (`ElectionID`, `Title`, `Description`, `Start_Date`, `End_Date`, `status`) VALUES
(160, 'CLASS REPRESENTATIVE ', 'good class representative leads the class to good path', '2023-12-18', '2023-12-18', 'Ended');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `PositionID` int(11) NOT NULL,
  `ElectionID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`PositionID`, `ElectionID`, `Title`, `Description`) VALUES
(35, 160, 'class rep', 'Some Position Description');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Mobile` varchar(10) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Role` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Mobile`, `Password`, `Photo`, `Role`) VALUES
(6237, 'Gladwin A J', '9519519510', '$2y$10$gbXRcToRCKzRbeNb4a/FmOteZ40hKw2HNjIt5Hi5zlzWmGCQhal3G', '../uploads/gladwin.png', 'candidate'),
(11073, 'Phranav', '7894561230', '$2y$10$yE8IHZLuHSX5CoUUZrrg3efEwvMoS4Jw9h8aH3oVEvnKpexKONfPa', '../uploads/passport-size-photo.jpg', 'voter'),
(31846, 'Vignesh', '9639639630', '$2y$10$5GCHBr1gn/DCjtPD8CajtOOfb2HVJgK8OEgnLknkhprDOIw/BhG4u', '../uploads/vignesh.jpg', 'candidate'),
(60280, 'vikkram', '7417417410', '$2y$10$PlRcntVU8nifv5yaG7lMmOy6cp2Yg3FJLfhrUhy/lXXUM7ZJeCBVW', '../uploads/vikkram.jpg', 'candidate'),
(62866, 'suresh', '8528528520', '$2y$10$Pl1DJwAdkQmcHSr.NySNBeJZGPR1qVuA4fdl7CkOQ2dXII8xEsgdm', '../uploads/suresh.png', 'candidate');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `VoteID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ElectionID` int(11) DEFAULT NULL,
  `CandidateID` int(11) DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`VoteID`, `UserID`, `ElectionID`, `CandidateID`, `Timestamp`) VALUES
(39, 11073, 160, 29, '2023-12-19 05:11:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`CandidateID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ElectionID` (`ElectionID`);

--
-- Indexes for table `elections`
--
ALTER TABLE `elections`
  ADD PRIMARY KEY (`ElectionID`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`PositionID`),
  ADD KEY `ElectionID` (`ElectionID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`VoteID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ElectionID` (`ElectionID`),
  ADD KEY `CandidateID` (`CandidateID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `CandidateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `elections`
--
ALTER TABLE `elections`
  MODIFY `ElectionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `PositionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65024;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `VoteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `candidates_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `candidates_ibfk_2` FOREIGN KEY (`ElectionID`) REFERENCES `elections` (`ElectionID`);

--
-- Constraints for table `positions`
--
ALTER TABLE `positions`
  ADD CONSTRAINT `positions_ibfk_1` FOREIGN KEY (`ElectionID`) REFERENCES `elections` (`ElectionID`);

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`ElectionID`) REFERENCES `elections` (`ElectionID`),
  ADD CONSTRAINT `votes_ibfk_3` FOREIGN KEY (`CandidateID`) REFERENCES `candidates` (`CandidateID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
