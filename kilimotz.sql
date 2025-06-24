-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2025 at 01:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kilimotz`
--

-- --------------------------------------------------------

--
-- Table structure for table `crops`
--

CREATE TABLE `crops` (
  `id` int(11) NOT NULL,
  `farmer_id` int(11) NOT NULL,
  `crop_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crops`
--

INSERT INTO `crops` (`id`, `farmer_id`, `crop_name`, `quantity`, `image`, `submitted_at`) VALUES
(1, 3, 'maize', 5, '', '2025-05-31 11:24:16'),
(2, 3, 'beans', 7, '', '2025-05-31 11:26:34'),
(3, 3, 'casava', 2, '', '2025-05-31 11:31:00'),
(4, 3, 'maize', 3, '', '2025-05-31 11:45:37');

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(11) NOT NULL,
  `crop_name` varchar(100) DEFAULT NULL,
  `price_per_kg` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trader_requests`
--

CREATE TABLE `trader_requests` (
  `id` int(11) NOT NULL,
  `trader_name` varchar(100) DEFAULT NULL,
  `crop_requested` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `request_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'farmer', '$2y$10$.UkHZixNSZXIu4/Tn7eO1uAYFaOMP6ZI7W9ZxWYQTnRM6oCIB.e/S', 'farmer', '2025-05-28 22:48:20'),
(2, 'trader', '$2y$10$MBzedITdOjIx5aC31oIQzeZglt/kICDt4cCIP6/wgmaS0kQU20Yny', 'trader', '2025-05-28 22:54:48'),
(3, 'omary', '$2y$10$uDaIC/z2t7Ea.wcyzgZ8Nuo8yHHdpH0N8/xYTrO1CegbWgh6cHd/i', 'farmer', '2025-05-28 22:56:55'),
(5, 'mashamba', '$2y$10$Xjb1jn/T5ti5GIVplQqr/OqCwZWCYM7oyxafVJ5DoWxOlqMF1aQjS', 'farmer', '2025-05-29 08:04:06'),
(6, 'hamza', '$2y$10$zFZIxH.Eqd9wEl2C3.AoqeXOtBr598AKD8.xKtguC2p3Bf7/EWpmC', 'government', '2025-05-29 08:58:30'),
(7, 'mr farmer', '$2y$10$3bXRBT3F0/Q.q/sYzRXlouQTL/P2Fc8gLBd5Xz1v5AXZ1WInQ6ChG', 'farmer', '2025-05-30 22:24:19'),
(8, 'chiggahmanalone', '$2y$10$xdEcv62pif51HVgnfv0Zr.ZKusu437kQsBdXSQs1jGPNVYtHx6djq', 'farmer', '2025-05-30 22:26:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crops`
--
ALTER TABLE `crops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trader_requests`
--
ALTER TABLE `trader_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_role` (`username`,`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crops`
--
ALTER TABLE `crops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trader_requests`
--
ALTER TABLE `trader_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
