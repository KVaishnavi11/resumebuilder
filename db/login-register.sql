-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2024 at 08:56 AM
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
-- Table structure for table `educational_details`
--

CREATE TABLE `educational_details` (
  `id` int(128) NOT NULL,
  `user_id` int(254) DEFAULT NULL,
  `collegename` varchar(256) DEFAULT NULL,
  `date1` date DEFAULT NULL,
  `date2` date DEFAULT NULL,
  `postgraduation` varchar(256) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `collegename1` varchar(256) DEFAULT NULL,
  `date3` date DEFAULT NULL,
  `date4` date DEFAULT NULL,
  `graduation` varchar(256) DEFAULT NULL,
  `description1` varchar(256) DEFAULT NULL,
  `schoolname` varchar(256) DEFAULT NULL,
  `date5` date DEFAULT NULL,
  `date6` date DEFAULT NULL,
  `hsc` varchar(256) DEFAULT NULL,
  `description3` varchar(256) DEFAULT NULL,
  `schoolname1` varchar(256) DEFAULT NULL,
  `date7` date DEFAULT NULL,
  `date8` date DEFAULT NULL,
  `ssc` varchar(256) DEFAULT NULL,
  `description4` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exp-detail`
--

CREATE TABLE `exp-detail` (
  `id` int(128) NOT NULL,
  `user_id` int(128) NOT NULL,
  `Organisation1` varchar(256) DEFAULT NULL,
  `position1` varchar(256) DEFAULT NULL,
  `duration` varchar(256) DEFAULT NULL,
  `description1` varchar(256) DEFAULT NULL,
  `Organisation2` varchar(256) DEFAULT NULL,
  `position2` varchar(256) DEFAULT NULL,
  `duration2` varchar(256) DEFAULT NULL,
  `description2` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extra_details`
--

CREATE TABLE `extra_details` (
  `id` int(128) NOT NULL,
  `user_id` int(254) NOT NULL,
  `skill1` varchar(256) DEFAULT NULL,
  `skill2` varchar(256) DEFAULT NULL,
  `skill3` varchar(256) DEFAULT NULL,
  `skill4` varchar(256) DEFAULT NULL,
  `skill5` varchar(256) DEFAULT NULL,
  `skill6` varchar(256) DEFAULT NULL,
  `interest1` varchar(256) DEFAULT NULL,
  `interest2` varchar(256) DEFAULT NULL,
  `interest3` varchar(256) DEFAULT NULL,
  `interest4` varchar(256) DEFAULT NULL,
  `interest5` varchar(256) DEFAULT NULL,
  `interest6` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `project-developed`
--

CREATE TABLE `project-developed` (
  `id` int(128) NOT NULL,
  `user_id` int(128) NOT NULL,
  `title1` varchar(256) DEFAULT NULL,
  `link1` varchar(256) DEFAULT NULL,
  `description1` varchar(256) DEFAULT NULL,
  `title2` varchar(256) DEFAULT NULL,
  `link2` varchar(256) DEFAULT NULL,
  `description2` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(4, 'Ashish', 'Ashish@gmail.com', '$2y$10$UvutCArIHaMPWHORu1GxLOBzQaWl4uBfMW1UDteH3etam7z3Tr0B6'),
(5, 'Vaish', 'vaishnavi2304@gmail.com', '$2y$10$mgvyPc.tLMzdOs8cQ8ve.ebcFzRg72VUky7IX08OfIgo92sltvwn6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `educational_details`
--
ALTER TABLE `educational_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exp-detail`
--
ALTER TABLE `exp-detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extra_details`
--
ALTER TABLE `extra_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_details`
--
ALTER TABLE `personal_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project-developed`
--
ALTER TABLE `project-developed`
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
-- AUTO_INCREMENT for table `educational_details`
--
ALTER TABLE `educational_details`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extra_details`
--
ALTER TABLE `extra_details`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_details`
--
ALTER TABLE `personal_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
