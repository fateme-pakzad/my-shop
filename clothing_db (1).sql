-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2025 at 05:50 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clothing_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `price` int(11) NOT NULL,
  `description` text COLLATE utf8_persian_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`) VALUES
(1, 'لباس', 100000, 'لباس بچه خوشگل شیک', 'bache.JPG'),
(2, 'کت و دامن', 200000, 'لباس زنانه خوشگل و مجلسی', 'zanane.JPG'),
(3, 'پیراهن', 250000, 'لباس مردانه جذاب', 'mardane.JPG'),
(4, 'کت وشلوار', 452900, 'مدل لباس زنانه اسپرت شیک', 'a.JPG'),
(6, 'تیشرت', 459900, 'ست لباس مشکی زنانه و مردانه', 'k;.JPG'),
(7, 'تیشرت', 239900, 'ست تیشرت وشلوار مردانه', 'g.JPG'),
(8, 'لباس اسپرت', 259900, 'مدل لباس بچه گانه اسپرت شیک', 'j.JPG'),
(9, 'لباس شلوار', 520000, 'لباس بچه خوشگل', 'u.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `admin`) VALUES
(1, 'fatemre', 'fatemepakmehr14@gmail.com', '$2y$10$OnG8TVQ4Jropk23h3XDjQ.aadhmZR7YCxlR/2t8.qJs6DZx0dZngK', '2025-06-02 10:00:49', 0),
(3, 'farzad', 'farzadpakzad10@gmail.com', '$2y$10$LDol5Jj4H/l3fhVYFGfDl.JC7WU5fgm6Nq8yPcRFDIIqEtgsMfqSO', '2025-06-02 12:21:28', 0),
(4, 'fa', 'fa@gmail.com', '$2y$10$n.LHRved.dkPp6vAi2o/wem5F3FNPBpkCfMtaS6eC6Iq7JQjcKJ8.', '2025-06-07 13:45:03', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
