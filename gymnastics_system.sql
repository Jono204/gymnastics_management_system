-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 08, 2026 at 12:39 PM
-- Server version: 8.0.45
-- PHP Version: 8.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gymnastics_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `gymnasts`
--

CREATE TABLE `gymnasts` (
  `id` int NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `membership_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `contact_no` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `training_program` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `enrollment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gymnasts`
--

INSERT INTO `gymnasts` (`id`, `full_name`, `membership_id`, `email`, `contact_no`, `date_of_birth`, `training_program`, `enrollment_date`) VALUES
(7, 'Joanne Street', '0846578829', 'Joan.getsFit@gmail.com', '0648321558', '2000-01-03', 'Intermediate', '2025-07-15'),
(9, 'Stefan Koler', '0467523311', 'Stef.lifts4fun@gmail.com', '0715782984', '2004-02-18', 'Advanced', '2025-11-17'),
(12, 'Jason Black', '0467563802', 'Jason.Fitjason@gmial.com', '0836475937', '1994-09-27', 'Advanced', '2022-06-16'),
(13, 'Mark Nomad', '8753492063', 'MarkieNmd@gmail.com', '0843528462', '1999-01-07', 'Beginner', '2023-08-16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gymnasts`
--
ALTER TABLE `gymnasts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `membership_id` (`membership_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gymnasts`
--
ALTER TABLE `gymnasts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
