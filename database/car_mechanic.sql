-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2025 at 07:15 PM
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
-- Database: `car_mechanic`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `make` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `year` int(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `is_approved` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `working_on` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `make`, `model`, `year`, `date`, `time`, `is_approved`, `image`, `working_on`) VALUES
(1, 3, 'Volkswagen', 'Passat', 2021, '2025-09-25', '12:00', 'false', 'passat.jpg', 'false'),
(3, 3, 'Yugo', 'Koral 45', 1991, '2025-10-15', '17:00', 'false', 'Yugo 45.jpg', 'false'),
(4, 2, 'Porsche', '911', 2023, '2025-09-30', '19:00', 'true', 'porsche.jpg', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `engine_type` varchar(255) DEFAULT NULL,
  `horsepower` int(11) DEFAULT NULL,
  `torque` int(11) DEFAULT NULL,
  `transmission` varchar(255) DEFAULT NULL,
  `drivetrain` varchar(255) DEFAULT NULL,
  `fuel_type` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `confirm_password` varchar(255) DEFAULT NULL,
  `is_admin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `confirm_password`, `is_admin`) VALUES
(1, 'Dren', 'drengashi', 'drengashi@gmail.com', '$2y$10$KbHWC34PL5XURmPXEsr04O22Y.GZNFS2XVfTRgntWuy2NypN3apDK', '$2y$10$y6jev/RRKV4BLvUN4U9rO.4Xa.YBVR2dsAu2x8grIZlNV8soZqGNm', 'true'),
(2, 'Deon', 'deonbeka', 'deonbeka@gmail.com', '$2y$10$v2E6o/5V50AFCqj1g4h26eTzVxJhoBzALTj8YhwkFeFXTXEs/eyua', '$2y$10$m1pX5NsxUlrsg6yxF/Y1sueJ0uubRr7aMKFV2UONX1tv5ho1ZfaPC', 'false'),
(3, 'Gerti', 'gerticalaj', 'gerticalaj@gmail.com', '$2y$10$41S51.lNVVZ9Pmki6TOwEufgaHZ7MbSNtO.ljruRMKWzHSjlYXHcS', '$2y$10$jLI../Qll6I4hYITArHbK.raKHGSKFsqbuCsg3d77aSDSlpwm30rO', 'false');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
