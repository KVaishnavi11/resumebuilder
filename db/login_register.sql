-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 06:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_register`
--

-- --------------------------------------------------------

--
-- Table structure for table `personal_details`
--

CREATE TABLE `personal_details` (
  `id` int(11) NOT NULL,
  `user_id` int(12) DEFAULT NULL,
  `firstname` varchar(256) DEFAULT NULL,
  `lastname` varchar(256) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `headline` varchar(256) DEFAULT NULL,
  `phonenumber` varchar(256) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `city` varchar(256) DEFAULT NULL,
  `postcode` varchar(256) DEFAULT NULL,
  `linkedin` varchar(256) DEFAULT NULL,
  `github` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_details`
--

INSERT INTO `personal_details` (`id`, `user_id`, `firstname`, `lastname`, `email`, `headline`, `phonenumber`, `address`, `city`, `postcode`, `linkedin`, `github`) VALUES
(1, NULL, 'Vaishnavi', 'Kamdee', 'vaishnavikamdee2304@gmail.com', '', '+19130075365', 'Nagpur', 'Nagpur', '440022', '', ''),
(2, NULL, 'Amol', 'Maskare', 'vaishnavikamdee2304@gmail.com', 'Software Enginerr', '9130075365', 'Nagpur', 'Nagpur', '440022', 'www.amolmaskare', 'wwwjfdifjdj'),
(3, NULL, 'Vaishnavi', 'Kamdee', 'vaishnavikamdee2304@gmail.com', 'web development', '+19130075365', 'Nagpur', 'Nagpur', '440022', 'www.vaishnavi', 'xvndlfkjads');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'Vaishnavi', 'vaishnavikamdee2304@gmail.com', 'Vaish234'),
(2, 'pratiksha', 'protuefj@gmail.com', 'pratiksha'),
(3, 'cdfgh', 'vasisj@gmail.com', 'asdfghjk'),
(4, 'Ashish', 'Ashish@gmail.com', '$2y$10$UvutCArIHaMPWHORu1GxLOBzQaWl4uBfMW1UDteH3etam7z3Tr0B6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `personal_details`
--
ALTER TABLE `personal_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `personal_details`
--
ALTER TABLE `personal_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
