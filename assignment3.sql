-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2021 at 05:30 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment3`
--

-- --------------------------------------------------------

--
-- Table structure for table `mechanic`
--

CREATE TABLE `mechanic` (
  `mechanic_id` varchar(30) NOT NULL,
  `servicing_cars` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mechanic`
--

INSERT INTO `mechanic` (`mechanic_id`, `servicing_cars`) VALUES
('ADS', 1),
('ARS', 1),
('FCB', 1),
('RMA', 1),
('SKT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userpanel`
--

CREATE TABLE `userpanel` (
  `client_id` int(30) NOT NULL,
  `client_name` varchar(30) NOT NULL,
  `client_address` varchar(50) NOT NULL,
  `client_phone` varchar(30) NOT NULL,
  `client_license` varchar(30) NOT NULL,
  `client_engine` varchar(30) NOT NULL,
  `client_appDate` date NOT NULL,
  `client_choice` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userpanel`
--

INSERT INTO `userpanel` (`client_id`, `client_name`, `client_address`, `client_phone`, `client_license`, `client_engine`, `client_appDate`, `client_choice`) VALUES
(19, 'Nafis Bin Reza', 'Adabor, dhaka', '01521409824', 'HJKLJH', 'YRUEO', '0000-00-00', 'ADS'),
(20, 'Reza', 'Flat #3B, House #432/433, Road #03, Baitul Aman Ho', '01521409824', 'YUOERH', 'uhbnckh', '1996-08-08', 'ARS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mechanic`
--
ALTER TABLE `mechanic`
  ADD PRIMARY KEY (`mechanic_id`),
  ADD UNIQUE KEY `mechanic` (`mechanic_id`);

--
-- Indexes for table `userpanel`
--
ALTER TABLE `userpanel`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `client_id` (`client_id`),
  ADD UNIQUE KEY `client_name` (`client_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `userpanel`
--
ALTER TABLE `userpanel`
  MODIFY `client_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
