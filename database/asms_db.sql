-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2024 at 09:43 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) NOT NULL,
  `title` varchar(190) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `start_date`, `end_date`) VALUES
(1, 'title', 'title', '2024-03-04', '2024-03-05'),
(3, 'bmw', 'bmw', '2024-03-05', '2024-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_list`
--

CREATE TABLE `inventory_list` (
  `id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `quantity` int(30) NOT NULL DEFAULT 0,
  `stock_date` date NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fournisseur` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_list`
--

INSERT INTO `inventory_list` (`id`, `product_id`, `quantity`, `stock_date`, `date_created`, `date_updated`, `fournisseur`) VALUES
(1, 7, 5, '2022-04-27', '2022-05-04 10:33:01', '2022-05-04 10:33:01', ''),
(2, 7, 3, '2022-04-30', '2022-05-04 10:34:01', '2022-05-04 10:34:01', ''),
(3, 6, 10, '2022-03-25', '2022-05-04 10:34:21', '2022-05-04 10:34:21', ''),
(4, 4, 20, '2022-03-25', '2022-05-04 10:34:36', '2022-05-04 10:34:36', ''),
(5, 5, 25, '2022-04-25', '2022-05-04 10:34:49', '2022-05-04 10:34:49', ''),
(6, 1, 16, '2022-02-15', '2022-05-04 10:35:07', '2022-05-04 10:35:07', ''),
(7, 2, 100, '2022-03-29', '2022-05-04 10:35:32', '2024-03-05 19:59:43', ''),
(8, 3, 4, '2022-01-15', '2022-05-04 10:35:56', '2022-05-04 10:35:56', ''),
(9, 8, 500, '2024-03-04', '2024-03-04 21:27:50', '2024-03-04 21:27:50', ''),
(10, 2, 500, '2024-03-05', '2024-03-05 20:05:40', '2024-03-05 20:05:40', '3');

-- --------------------------------------------------------

--
-- Table structure for table `mechanic_list`
--

CREATE TABLE `mechanic_list` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mechanic_list`
--

INSERT INTO `mechanic_list` (`id`, `firstname`, `status`, `delete_flag`, `date_added`, `date_updated`) VALUES
(3, 'SPA', 1, 1, '2024-03-05 18:57:10', '2024-03-05 19:00:48');

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` float(15,2) NOT NULL DEFAULT 0.00,
  `image_path` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`id`, `name`, `description`, `price`, `image_path`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Mags', 'Test Mags', 6500.00, 'uploads/products/1.png?v=1651631335', 1, 0, '2022-05-04 10:28:54', '2022-05-04 10:28:55'),
(2, 'Spark Plug', 'Test Spark Plug', 650.00, 'uploads/products/2.png?v=1651631360', 1, 0, '2022-05-04 10:29:20', '2022-05-04 10:29:20'),
(3, 'Side Mirrors', 'Test Side Mirrors', 1300.00, 'uploads/products/3.png?v=1651631379', 1, 0, '2022-05-04 10:29:39', '2022-05-04 10:29:39'),
(4, 'Engine Oil 1L', 'Test Engine Oil 1L', 450.00, 'uploads/products/4.png?v=1651631402', 1, 0, '2022-05-04 10:30:02', '2022-05-04 10:30:02'),
(5, 'Engine Oil 4L', 'Test Engine Oil 4L', 1100.00, 'uploads/products/5.png?v=1651631427', 1, 0, '2022-05-04 10:30:27', '2022-05-04 10:30:27'),
(6, 'Fox Suspension', 'Test Fox Suspension', 7800.00, 'uploads/products/6.png?v=1651631456', 1, 0, '2022-05-04 10:30:56', '2022-05-04 10:30:56'),
(7, 'Battery', 'Test Battery', 1400.00, 'uploads/products/7.png?v=1651631475', 1, 0, '2022-05-04 10:31:15', '2022-05-04 10:31:15'),
(8, 'Total Huile 1L', 'Total Huile 1L', 500.00, '', 1, 0, '2024-03-04 21:27:31', '2024-03-04 21:27:31');

-- --------------------------------------------------------

--
-- Table structure for table `service_list`
--

CREATE TABLE `service_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` float(15,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_list`
--

INSERT INTO `service_list` (`id`, `name`, `description`, `price`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Full Engine Check-up', 'Full Engine Check-up', 450.00, 1, 0, '2022-05-04 09:17:45', '2022-05-04 09:17:45'),
(2, 'Change Oil', 'Change Oil', 250.00, 1, 0, '2022-05-04 09:18:06', '2022-05-04 09:18:06'),
(3, 'Tire Replacement', 'Tire Replacement', 250.00, 1, 0, '2022-05-04 09:19:01', '2022-05-04 09:19:01'),
(4, 'Repainting', 'Car Repainting', 850.00, 1, 0, '2022-05-04 09:19:36', '2022-05-04 09:19:36'),
(5, 'Engine Overhaul', 'Engine Overhauling', 1800.00, 1, 0, '2022-05-04 09:20:33', '2022-05-04 09:20:33'),
(6, 'test', 'test', 1.00, 1, 1, '2022-05-04 09:20:49', '2022-05-04 09:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_list`
--

CREATE TABLE `supplier_list` (
  `id` int(66) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'GARAGE MB'),
(6, 'short_name', 'GARAGE MB'),
(11, 'logo', 'uploads/logo.png?v=1651626775'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover.png?v=1651626884');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_list`
--

CREATE TABLE `transaction_list` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `mechanic_id` int(30) DEFAULT NULL,
  `code` varchar(100) NOT NULL,
  `client_name` text NOT NULL,
  `contact` text NOT NULL,
  `ice` text NOT NULL,
  `rc` text NOT NULL,
  `matricule` text NOT NULL,
  `marque` text NOT NULL,
  `modele` text NOT NULL,
  `kilometrage` text NOT NULL,
  `amount` float(15,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '\r\n0=Pending,\r\n1=On-Progress,\r\n2=Done,\r\n3=Paid,\r\n4=Cancelled',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_list`
--

INSERT INTO `transaction_list` (`id`, `user_id`, `mechanic_id`, `code`, `client_name`, `contact`, `ice`, `rc`, `matricule`, `marque`, `modele`, `kilometrage`, `amount`, `status`, `date_created`, `date_updated`) VALUES
(2, 1, NULL, '202403020001', 'Simo', '066000000', 'ICE', 'RC', 'AA1000000', 'BMW', 'M2', '1000000', 700.00, 0, '2024-03-02 14:22:30', '2024-03-02 14:22:30'),
(3, 1, NULL, '202403020002', 'Simo', '06666666666', '', '', '22222', 'Audi', 'A4', '10000', 1400.00, 3, '2024-03-02 14:49:16', '2024-03-02 17:45:12'),
(5, 1, NULL, '202403020004', 'R5', 'R5', 'R5', 'R5', 'R5', 'R5', 'R5', 'R5', 5100.00, 2, '2024-03-02 16:11:46', '2024-03-02 17:43:10'),
(6, 1, NULL, '202403030001', 'Nom', 'Num', '', '', '11111111', 'BMW', 'M2', '1000000', 3600.00, 3, '2024-03-02 17:46:02', '2024-03-02 17:50:43'),
(7, 1, NULL, '202403030002', 'GJHGJ', 'GHGJHG', 'gjhgjh', 'jhgjhg', 'hgjhgj', 'gjhgjhg', 'ghjghgj', 'hgjhg', 70.00, 2, '2024-03-02 17:47:09', '2024-03-02 17:47:58'),
(8, 1, NULL, '202403050001', 'Anas', '066666666', 'ICE', 'RC', '1212121212', 'MERCEDES', 'BENZ', '131355', 500.00, 3, '2024-03-04 21:29:51', '2024-03-04 21:30:48'),
(9, 1, NULL, '202403050002', 'heazhejk', 'kjhjkqse', 'jsdfhks', 'jsdhfkjq', 'sdjfhqskdfj', 'jsdfhqksj', 'jsdfhk', 'jsdfhkjqdsf', 21400.00, 0, '2024-03-04 21:33:14', '2024-03-04 21:33:14');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_products`
--

CREATE TABLE `transaction_products` (
  `transaction_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `price` float(15,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_products`
--

INSERT INTO `transaction_products` (`transaction_id`, `product_id`, `qty`, `price`) VALUES
(2, 4, 1, 200.00),
(5, 5, 1, 5000.00),
(3, 4, 2, 100.00),
(3, 1, 3, 300.00),
(6, 7, 9, 200.00),
(7, 7, 1, 20.00),
(8, 8, 3, 500.00),
(9, 5, 1, 1100.00),
(9, 4, 1, 450.00),
(9, 6, 1, 7800.00),
(9, 1, 1, 6500.00),
(9, 3, 1, 1300.00),
(9, 2, 1, 650.00);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_services`
--

CREATE TABLE `transaction_services` (
  `transaction_id` int(30) NOT NULL,
  `service_id` int(30) NOT NULL,
  `price` float(15,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_services`
--

INSERT INTO `transaction_services` (`transaction_id`, `service_id`, `price`) VALUES
(2, 2, 500.00),
(5, 2, 100.00),
(3, 2, 100.00),
(3, 5, 200.00),
(6, 5, 1800.00),
(7, 2, 50.00),
(9, 2, 250.00),
(9, 5, 1800.00),
(9, 1, 450.00),
(9, 4, 850.00),
(9, 3, 250.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatars/1.png?v=1649834664', NULL, 1, '2021-01-20 14:02:37', '2022-04-13 15:24:24'),
(2, 'Mark', 'Cooper', 'mcooper', '0c4635c5af0f173c26b0d85b6c9b398b', 'uploads/avatars/2.png?v=1650520142', NULL, 2, '2022-04-21 13:49:02', '2022-05-04 10:56:39'),
(3, 'John', 'Smith', 'jsmith', '1254737c076cf867dc53d60a0364f38e', 'uploads/avatars/3.png?v=1650527149', NULL, 2, '2022-04-21 15:45:49', '2022-04-21 15:46:23'),
(4, 'Simo', 'Simo', 'simo', '202cb962ac59075b964b07152d234b70', NULL, NULL, 2, '2024-03-04 21:41:09', '2024-03-04 21:41:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_list`
--
ALTER TABLE `inventory_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `mechanic_list`
--
ALTER TABLE `mechanic_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_list`
--
ALTER TABLE `service_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_list`
--
ALTER TABLE `transaction_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `mechanic_id` (`mechanic_id`);

--
-- Indexes for table `transaction_products`
--
ALTER TABLE `transaction_products`
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `service_id` (`product_id`);

--
-- Indexes for table `transaction_services`
--
ALTER TABLE `transaction_services`
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inventory_list`
--
ALTER TABLE `inventory_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mechanic_list`
--
ALTER TABLE `mechanic_list`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `service_list`
--
ALTER TABLE `service_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `transaction_list`
--
ALTER TABLE `transaction_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory_list`
--
ALTER TABLE `inventory_list`
  ADD CONSTRAINT `product_id_fk_il` FOREIGN KEY (`product_id`) REFERENCES `product_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `transaction_list`
--
ALTER TABLE `transaction_list`
  ADD CONSTRAINT `mechanic_id_fk_tl` FOREIGN KEY (`mechanic_id`) REFERENCES `mechanic_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id_fk_tl` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `transaction_products`
--
ALTER TABLE `transaction_products`
  ADD CONSTRAINT `product_id_fk_tp` FOREIGN KEY (`product_id`) REFERENCES `product_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `transaction_id_fk_tp` FOREIGN KEY (`transaction_id`) REFERENCES `transaction_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `transaction_services`
--
ALTER TABLE `transaction_services`
  ADD CONSTRAINT `service_id_fk_ts` FOREIGN KEY (`service_id`) REFERENCES `service_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `transaction_id_fk_ts` FOREIGN KEY (`transaction_id`) REFERENCES `transaction_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
