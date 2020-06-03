-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2018 at 08:32 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `scroll_table`
--

CREATE TABLE `scroll_table` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scroll_table`
--

INSERT INTO `scroll_table` (`id`, `Name`, `Email`, `Password`) VALUES
(1, 'Moiz', 'moiztandawala52@gmail.com', '123456'),
(2, 'Yash', 'yash@gmail.com', '123456'),
(3, 'Moiz', 'moiztandawala52@gmail.com', '123456'),
(4, 'Yash', 'yash@gmail.com', '123456'),
(5, 'Moiz', 'moiztandawala52@gmail.com', '123456'),
(6, 'Yash', 'yash@gmail.com', '123456'),
(7, 'Moiz', 'moiztandawala52@gmail.com', '123456'),
(8, 'Yash', 'yash@gmail.com', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scroll_table`
--
ALTER TABLE `scroll_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scroll_table`
--
ALTER TABLE `scroll_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
