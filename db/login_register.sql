-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2024 at 08:47 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
  `description2` varchar(256) DEFAULT NULL,
  `schoolname1` varchar(256) DEFAULT NULL,
  `date7` date DEFAULT NULL,
  `date8` date DEFAULT NULL,
  `ssc` varchar(256) DEFAULT NULL,
  `description3` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `educational_details`
--

INSERT INTO `educational_details` (`id`, `user_id`, `collegename`, `date1`, `date2`, `postgraduation`, `description`, `collegename1`, `date3`, `date4`, `graduation`, `description1`, `schoolname`, `date5`, `date6`, `hsc`, `description2`, `schoolname1`, `date7`, `date8`, `ssc`, `description3`) VALUES
(1, 5, 'efdjsk', '0000-00-00', '0000-00-00', NULL, 'outg8irsygidu', 'raisoni', '0000-00-00', '2001-09-02', 'uryhfsuehfufk', NULL, 'fiysieufhieskhvs', '0000-00-00', '0000-00-00', 'feszjljfczjlkdmfkl.mc', NULL, 'utuyyhgfgv', '0000-00-00', '0000-00-00', 'erfis8yf7ursysuik', NULL),
(2, 6, 'fsxffx', '0000-00-00', '0000-00-00', NULL, '', '', '0000-00-00', '0000-00-00', '', NULL, '', '0000-00-00', '0000-00-00', '', NULL, '', '0000-00-00', '0000-00-00', '', NULL),
(0, 2, 'qw', '0000-00-00', '0000-00-00', 'w', 'w', 'w', '0000-00-00', '0000-00-00', 'w', NULL, 'w', '0000-00-00', '0000-00-00', 'w', NULL, 'w', '0000-00-00', '0000-00-00', 'w', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exp_details`
--

CREATE TABLE `exp_details` (
  `id` int(128) NOT NULL,
  `user_id` int(128) NOT NULL,
  `organisation1` varchar(256) DEFAULT NULL,
  `position1` varchar(256) DEFAULT NULL,
  `duration1` varchar(256) DEFAULT NULL,
  `description1` varchar(256) DEFAULT NULL,
  `organisation2` varchar(256) DEFAULT NULL,
  `position2` varchar(256) DEFAULT NULL,
  `duration2` varchar(256) DEFAULT NULL,
  `description2` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exp_details`
--

INSERT INTO `exp_details` (`id`, `user_id`, `organisation1`, `position1`, `duration1`, `description1`, `organisation2`, `position2`, `duration2`, `description2`) VALUES
(0, 6, 'dsfdf', 'djlksm', 'sdfdf', 'adfdfdf', 'fdsafd', 'dfdaf', 'adfdsa', 'adfdsaffd'),
(0, 2, 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w');

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
  `interest6` varchar(256) DEFAULT NULL,
  `objective` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `extra_details`
--

INSERT INTO `extra_details` (`id`, `user_id`, `skill1`, `skill2`, `skill3`, `skill4`, `skill5`, `skill6`, `interest1`, `interest2`, `interest3`, `interest4`, `interest5`, `interest6`, `objective`) VALUES
(1, 6, 'g', 'dfd', 'dfa', 'adf', 'hjbk', 'jkl.l', 'ads', 'adsf', 'adf', '', '', '', NULL),
(0, 2, 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'this is my new demo objective please check'),
(0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
(4, 2, 'aman', 'Maskare', 'amolm', '', '07387768236', 'New laxmy nagar, Gondia, GONDIYA MAHARASHTRA', 'GONDIA', '441614', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `project_developed`
--

CREATE TABLE `project_developed` (
  `id` int(128) NOT NULL,
  `user_id` int(128) NOT NULL,
  `title1` varchar(256) DEFAULT NULL,
  `link1` varchar(256) DEFAULT NULL,
  `description1` varchar(256) DEFAULT NULL,
  `title2` varchar(256) DEFAULT NULL,
  `link2` varchar(256) DEFAULT NULL,
  `description2` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_developed`
--

INSERT INTO `project_developed` (`id`, `user_id`, `title1`, `link1`, `description1`, `title2`, `link2`, `description2`) VALUES
(0, 2, 'e', 'o', 'o', 'o', 'o', 'o');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'amolmaskare1@gmail.com', 'adminadmin'),
(2, 'pratiksha', 'pratiksha@gmail.com', '$2y$10$cj5UNcKwrl0KRBQcQ0jYMunjG6t5F2A6ZBFvc8i53JELYWLIdEpDK');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
