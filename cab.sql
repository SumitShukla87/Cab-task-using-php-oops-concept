-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 28, 2020 at 02:49 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cab`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `distance` varchar(50) NOT NULL,
  `is_available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`id`, `name`, `distance`, `is_available`) VALUES
(1, 'Charbagh', '0', 1),
(2, 'Indira Nagar', '10', 1),
(3, 'BBD', '30', 1),
(4, 'Barabanki', '60', 1),
(5, 'Faizabad', '100', 1),
(6, 'Basti', '150', 1),
(7, 'Gorakhpur', '210', 1),
(8, 'Mau', '400', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ride`
--

CREATE TABLE `tbl_ride` (
  `ride_id` int(11) NOT NULL,
  `ride_date` date NOT NULL,
  `from` varchar(50) NOT NULL,
  `to` varchar(50) NOT NULL,
  `cab_type` varchar(50) NOT NULL,
  `total_distance` varchar(10) NOT NULL,
  `luggage` varchar(10) NOT NULL,
  `total_fare` varchar(10) NOT NULL,
  `status` int(1) NOT NULL,
  `customer_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ride`
--

INSERT INTO `tbl_ride` (`ride_id`, `ride_date`, `from`, `to`, `cab_type`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`) VALUES
(16, '2020-11-28', 'Charbagh', 'BBD', '3', '30', '10', '685', 2, 12),
(17, '2020-11-28', 'Charbagh', 'Faizabad', '1', '100', '0', '1193', 0, 12),
(19, '2020-09-09', 'Charbagh', 'Faizabad', '1', '100', '0', '800', 2, 12),
(20, '2020-11-28', 'Indira Nagar', 'BBD', '3', '20', '20', '495', 2, 12),
(21, '2020-11-28', 'BBD', 'Faizabad', '1', '70', '0', '887', 0, 16),
(22, '2020-11-28', 'Charbagh', 'Basti', '4', '150', '3', '2453', 1, 17),
(23, '2020-11-28', 'Charbagh', 'BBD', '2', '30', '12', '655', 1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dateofsignup` datetime NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `isblock` tinyint(1) NOT NULL,
  `password` varchar(500) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `name`, `dateofsignup`, `mobile`, `isblock`, `password`, `is_admin`) VALUES
(9, 'admin', 'Sumit Shukla', '2020-11-25 08:36:32', '8707647101', 1, '5cbcf07e36fe37142b407ace0211cbf7', 1),
(12, 't1', 'tufail', '2020-11-26 03:12:33', '8787878', 1, 'accc9105df5383111407fd5b41255e23', 0),
(16, 's1', 'Sumit', '2020-11-28 02:42:30', '8707647101', 1, 'b53b3a3d6ab90ce0268229151c9bde11', 0),
(17, 'ankit1', 'Ankit Dixit', '2020-11-28 02:42:59', '4565987825', 1, 'b53b3a3d6ab90ce0268229151c9bde11', 0),
(18, 'm1', 'MD Ismail', '2020-11-28 02:47:10', '7898653214', 0, 'b53b3a3d6ab90ce0268229151c9bde11', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  ADD PRIMARY KEY (`ride_id`),
  ADD KEY `customer_user_id` (`customer_user_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  MODIFY `ride_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  ADD CONSTRAINT `tbl_ride_ibfk_1` FOREIGN KEY (`customer_user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
