-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2025 at 07:17 PM
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
(1, 'Dren', 'drengashi', 'drengashi@gmail.com', '$2y$10$j.5Zl7n3vlTi/u8tsev74e.K.JiPmFPGN2D0BN8M5dV.Bg0s5lVhq', '$2y$10$1hwcbN6ihTSxdubhrxUHgupTAQ51YHPPziTGqXZ1mBwuiq18UtoPG', 'true'),
(3, 'Deon', 'deonbeka', 'deonbeka@gmail.com', '$2y$10$Ap.WlnVXTzmscdpS6w6/x.jpUkTXVMkEsg30wvRtxSkTHV4n0t8ye', '$2y$10$vEUH8YlId3rwqpufx1Aguuhswn1R6.hiAY8D5QRsp8iuVfYYlxZmW', 'false'),
(4, 'Amant', 'amantzabeli', 'amantzabeli@gmail.com', '$2y$10$jK1IOJnYfJZJZE3EWOEQSOfCYf6bW3ZmGb3ECbQVUgsKMtyhsmoM.', '$2y$10$Q67MczLW//tKvHKXft8I7ugmGqjR0T6bdjXHWD2ddli1EfqGZq/Sm', 'false');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
