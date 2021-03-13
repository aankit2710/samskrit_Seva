-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2020 at 11:49 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lenskart`
--

-- --------------------------------------------------------

--
-- Table structure for table `powerlenses`
--

CREATE TABLE `powerlenses` (
  `lenses_id` int(11) NOT NULL,
  `power_id` varchar(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `features` text,
  `status` tinyint(1) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `powerlenses`
--

INSERT INTO `powerlenses` (`lenses_id`, `power_id`, `title`, `amount`, `features`, `status`, `created_on`, `modified_on`) VALUES
(5, '1', 'test', 199, 's@#s@#s@#s@#d@#d@#dq@#d', 1, '2020-12-09 00:00:00', '2020-12-09 20:49:25'),
(7, '1', 'test2', 299, 'a@#B@#C@#D@#E@#F@#-@#-', 1, '2020-12-09 00:00:00', '0000-00-00 00:00:00'),
(8, '2', 'TEST 3', 399, 'A@#B@#B@#C@#B@#J@#J@#-', 1, '2020-12-09 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `powerlenses`
--
ALTER TABLE `powerlenses`
  ADD PRIMARY KEY (`lenses_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `powerlenses`
--
ALTER TABLE `powerlenses`
  MODIFY `lenses_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
