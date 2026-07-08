-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2026 at 01:06 AM
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
-- Database: `skar`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_price`, `product_quantity`, `description`) VALUES
(1, 'Mango Blaze', 29.99, 14, 'Mango Fruity Blaze'),
(2, 'Red Surge', 29.99, 50, 'Refreshing red drink'),
(3, 'Blue Ice', 29.99, 40, 'Cool blue beverage'),
(4, 'Grape Shock', 29.99, 30, 'Sweet grape flavored drink'),
(5, 'Citrus Burst', 29.99, 60, 'Tangy citrus drink'),
(6, 'Green Strike', 29.99, 35, 'Energetic green drink'),
(7, 'Grey Lime', 29.99, 50, 'Refreshing lime drink'),
(8, 'Tangy RaspBerry', 29.99, 14, 'Raspberry Fruity Blaze');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `skar_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `review_text` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `skar_id`, `product_id`, `rating`, `review_text`, `created_at`) VALUES
(1, 1, 1, 5, 'Love this! Super refreshing.', '2026-02-27 04:54:21'),
(2, 2, 2, 4, 'Nice taste, but a bit too sweet for me.', '2026-02-27 04:54:26'),
(3, 2, 2, 4, 'Nice taste, but a bit too sweet for me.', '2026-02-27 04:54:31'),
(4, 1, 3, 3, 'It’s okay, not my favorite.', '2026-02-27 04:54:35'),
(5, 2, 6, 4, 'Nice', '2026-02-27 05:34:51');

-- --------------------------------------------------------

--
-- Table structure for table `skaracc`
--

CREATE TABLE `skaracc` (
  `skar_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skaracc`
--

INSERT INTO `skaracc` (`skar_id`, `username`, `email`, `password`) VALUES
(1, 'apple', 'apple@gmail.com', '$2y$10$/Djw1eW/ys25jKz5U1TLheakxu.icIf6vp6NeeiysTxCkmzxAKxCK'),
(2, 'ball', 'ball@gmail.com', '$2y$10$nazlj2C0m1CYUEKzUdFxhOFuQPoiIh8RlEX5XKCwJ89uABy86DFSe'),
(3, 'rhino', 'rhino@gmail.com', '$2y$10$mhaztGOjIJCV.EtmaLFdC.qi2USuoxdsbRPXvgSbH6wuflDV15gAy'),
(4, 'Zebra', 'Zebra@gmail.com', '$2y$10$ugJIIWo26vNplAOU6qn1qe7JimCFxfl8DWcc5vfKSRxhbiDR.eE3C'),
(5, 'test', 'test@gmail.com', '$2y$10$r359O3GLk6KTVXNkH8uVsey2uhpe6pE9D2Pja4vIXgCgeBwnP6F.a'),
(6, 'ant', 'ant@gmail.com', '$2y$10$mmhemG7XA5mZ/.Iwr6l/VuvFV/KTV7yqgpiuT.C1cW8QIFt1nmbh.'),
(7, 'carp', 'carp@gmail.com', '$2y$10$f53vupdjVFeKRwjgA20gJuXEnwVxq32Nppa1miysXTF0U2eIZOdcO'),
(8, 'abc', 'abc@gmail.com', '$2y$10$lvty9nH2TcrIUVVJHt/7COAjBj06ICoXE9EKICdSpqN9pIEobBWJW');

-- --------------------------------------------------------

--
-- Table structure for table `user_cart`
--

CREATE TABLE `user_cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cart`
--

INSERT INTO `user_cart` (`cart_id`, `user_id`, `product_id`, `quantity`, `created_at`) VALUES
(4, 3, 3, 1, '2026-03-16 07:12:47'),
(35, 6, 2, 3, '2026-03-16 17:58:25'),
(38, 6, 3, 4, '2026-03-16 18:00:51'),
(46, 6, 5, 2, '2026-03-16 18:00:58'),
(49, 6, 4, 1, '2026-03-16 18:01:23'),
(61, 1, 3, 1, '2026-03-16 18:28:22'),
(68, 8, 3, 1, '2026-03-16 18:36:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `skaracc`
--
ALTER TABLE `skaracc`
  ADD PRIMARY KEY (`skar_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD UNIQUE KEY `unique_user_product` (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `skaracc`
--
ALTER TABLE `skaracc`
  MODIFY `skar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_cart`
--
ALTER TABLE `user_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD CONSTRAINT `user_cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `skaracc` (`skar_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
