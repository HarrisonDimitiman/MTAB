-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2022 at 08:11 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mtab`
--

-- --------------------------------------------------------

--
-- Table structure for table `contestants`
--

CREATE TABLE `contestants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `height` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `educational` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contestants`
--

INSERT INTO `contestants` (`id`, `name`, `age`, `location`, `height`, `weight`, `birthdate`, `image`, `educational`, `number`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Person 1', '21', 'Person 1', '123', '123', '2022-04-29', 'uploads/contestant/o1G9wkzYHzskGCx9CElquPBSYmd4961ObvJzb18e.png', 'Person 1', '1', '2022-04-28 09:48:31', '2022-04-28 09:48:31', NULL),
(2, 'Person 2', '23', 'Person 2', '123', '123', '2022-04-29', 'uploads/contestant/ZTmpJMtQyIqm6vN4LBTkMp2TLravFus6ecbH6TnY.png', 'Person 2', '2', '2022-04-28 09:48:54', '2022-04-28 09:48:54', NULL),
(3, 'Person 3', '12', 'Person 3', '123', '123', '2022-04-29', 'uploads/contestant/Ftecyk6BfFko7d9mXbmW5iG5G6C34AfCz80ef6Xt.png', '12', '3', '2022-04-28 09:49:38', '2022-04-28 09:49:38', NULL),
(4, 'Person 4', '12', 'Person 4', '213', '13', '2022-04-29', 'uploads/contestant/ZQrtbqYAVz9Odl3FaJmQkRZfNUKaeVHL2r168gmr.png', 'Person 4', '4', '2022-04-28 09:50:12', '2022-04-28 09:50:12', NULL),
(5, 'Person 5', '12', 'Person 5', '123', '123', '2022-04-29', 'uploads/contestant/i6VrQKBf4YN4lA1lafbIye5qXniXbhztLIu5butI.png', '12', '5', '2022-04-28 09:50:31', '2022-04-28 09:50:31', NULL),
(6, 'Person 6', '123', 'Person 6', '123', '123', '2022-04-29', 'uploads/contestant/XuLnI3t4HWB2oPXLHaxKuXLGVOLKDfIIbpUHLTH4.png', 'Person 6', '6', '2022-04-28 09:50:51', '2022-04-28 09:50:51', NULL),
(7, 'Person 7', '123', 'Person 7', '12312', '123', '2022-04-29', 'uploads/contestant/KYpjOMSJIqUs4y931vsFTx6zLZW7UuIpXH8Jw51o.png', 'Person 7', '7', '2022-04-28 09:51:15', '2022-04-28 09:51:15', NULL),
(8, 'Person 8', '123', 'Person 8', '123', '123', '2022-04-29', 'uploads/contestant/gMoucpiPyLUfrlV8wSDRa5DV2X8lFEa74E6zVgul.png', 'Person 8', '8', '2022-04-28 09:51:37', '2022-04-28 09:51:37', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contestants`
--
ALTER TABLE `contestants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contestants`
--
ALTER TABLE `contestants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
