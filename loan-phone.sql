-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 12, 2020 at 04:48 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.28-2+ubuntu18.04.1+deb.sury.org+2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loan-phone`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` tinyint(4) NOT NULL,
  `en_name` varchar(120) NOT NULL,
  `kh_name` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `website` varchar(90) DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `description` text,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `header` text,
  `footer` text,
  `vat` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `en_name`, `kh_name`, `address`, `email`, `phone`, `website`, `logo`, `description`, `create_at`, `header`, `footer`, `vat`) VALUES
(1, 'Angkor Coffee Co., Ltd', 'អង្គរ ខហ្វហ្វី ឯ.ក', 'ផ្ទះលេខ ៣១ ផ្លូវ​ លំ​ ភូមិត្រពាំឈូក សង្កាត់ ទឹកថ្លា ខណ្ឌ​ សែនសុខភ្នំពេញ', 'angkorcoffee@gmail.com', '(+855) 23 66 66 198 / 016 538 567', 'www.angkorcoffee.com', 'uploads/logos//CeYt5YzqE6rcwSYCxopoDqfCSZ2Pg8XU1HITDnwc.png', NULL, '2019-02-03 15:40:10', 'No 31, St Lub, Phom Tropeing Chhuk, Shag Kat Toeuk Thla, Khan Sensok, Phnom', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(90) NOT NULL,
  `alias` varchar(120) DEFAULT NULL,
  `list` tinyint(4) NOT NULL DEFAULT '0',
  `insert` tinyint(4) NOT NULL DEFAULT '0',
  `update` tinyint(4) NOT NULL DEFAULT '0',
  `delete` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `alias`, `list`, `insert`, `update`, `delete`) VALUES
(1, 'Role', 'Role', 0, 0, 0, 0),
(2, 'User', 'User', 0, 0, 0, 0),
(3, 'permission', 'Permission', 0, 0, 0, 0),
(4, 'company', 'Company', 0, 0, 0, 0),
(9, 'uom', 'Unit', 0, 0, 0, 0),
(54, 'category', 'Category', 0, 0, 0, 0),
(55, 'exchange', 'Exchange', 0, 0, 0, 0),
(57, 'product', 'Products', 0, 0, 0, 0),
(58, 'customer', 'Customers', 0, 0, 0, 0),
(59, 'invoice', 'Invoices', 0, 0, 0, 0),
(60, 'stock_in', 'Stock In', 0, 0, 0, 0),
(61, 'stock_out', 'Stock Out', 0, 0, 0, 0),
(62, 'stock_balance', 'Stock Balance Report', 0, 0, 0, 0),
(63, 'sale_report', 'Sale Detail Report', 0, 0, 0, 0),
(64, 'sale_summary', 'Sale Summary Report', 0, 0, 0, 0),
(65, 'stock_in', 'Stock In Detail Report', 0, 0, 0, 0),
(66, 'stock_in_summary', 'Stock In Summary Report', 0, 0, 0, 0),
(67, 'stock_out', 'Stock Out Detail Report', 0, 0, 0, 0),
(68, 'stock_out_summary', 'Stock Out Summary Report', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `phone_shops`
--

CREATE TABLE `phone_shops` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` varchar(120) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `active`) VALUES
(1, 'Administrator', 1),
(2, 'Manager', 0),
(3, 'hello World!', 0),
(4, 'Tallyman', 0),
(5, 'Controller', 0),
(6, 'Viewer', 0),
(99, 'POS Seller', 0),
(100, 'Test', 0),
(101, 'dfdsf', 0),
(102, 'sdf', 0),
(103, 'dfsdf', 0),
(104, 'dsfsadfsdfsfsadf', 0),
(105, 'seller', 1),
(106, 'Accountant', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `list` int(11) NOT NULL DEFAULT '0',
  `insert` int(11) NOT NULL DEFAULT '0',
  `update` int(11) NOT NULL DEFAULT '0',
  `delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `permission_id`, `list`, `insert`, `update`, `delete`) VALUES
(1, 1, 1, 1, 1, 1, 1),
(2, 1, 2, 1, 1, 1, 1),
(3, 1, 3, 1, 1, 1, 1),
(4, 1, 4, 1, 1, 1, 1),
(5, 1, 5, 1, 1, 1, 1),
(6, 1, 6, 1, 1, 1, 1),
(7, 1, 7, 1, 1, 1, 1),
(8, 1, 8, 1, 1, 1, 1),
(9, 1, 9, 1, 1, 1, 1),
(10, 1, 10, 1, 1, 1, 1),
(11, 1, 11, 1, 1, 1, 1),
(12, 1, 12, 1, 1, 1, 1),
(13, 1, 13, 1, 1, 1, 1),
(14, 1, 14, 1, 1, 1, 1),
(15, 1, 15, 1, 1, 1, 1),
(16, 1, 16, 1, 1, 1, 1),
(17, 1, 17, 1, 1, 1, 1),
(18, 1, 18, 1, 1, 1, 1),
(19, 1, 19, 1, 1, 1, 1),
(20, 1, 20, 1, 1, 1, 1),
(21, 4, 5, 1, 0, 0, 0),
(22, 4, 7, 1, 0, 0, 0),
(23, 4, 9, 1, 0, 0, 0),
(24, 4, 10, 1, 0, 0, 0),
(25, 4, 13, 1, 1, 0, 0),
(26, 4, 14, 1, 1, 0, 0),
(27, 1, 21, 1, 1, 1, 1),
(28, 1, 22, 1, 1, 1, 1),
(29, 5, 5, 1, 0, 0, 0),
(30, 5, 7, 1, 0, 0, 0),
(31, 5, 8, 1, 0, 0, 0),
(32, 5, 10, 1, 0, 0, 0),
(33, 5, 9, 1, 0, 0, 0),
(34, 5, 23, 1, 0, 0, 0),
(35, 1, 25, 1, 1, 1, 1),
(36, 1, 23, 1, 1, 1, 1),
(37, 1, 24, 1, 1, 1, 1),
(38, 1, 26, 1, 1, 1, 1),
(39, 1, 27, 1, 1, 1, 1),
(40, 1, 28, 1, 1, 1, 1),
(41, 1, 29, 1, 1, 1, 1),
(42, 1, 30, 1, 1, 1, 1),
(43, 1, 31, 1, 1, 1, 1),
(44, 1, 32, 1, 1, 1, 1),
(45, 1, 33, 1, 1, 1, 1),
(46, 1, 34, 1, 1, 1, 1),
(47, 4, 34, 1, 1, 0, 0),
(48, 5, 6, 1, 0, 0, 0),
(49, 5, 13, 1, 1, 0, 0),
(50, 5, 14, 1, 1, 0, 0),
(51, 5, 19, 1, 1, 0, 0),
(52, 5, 20, 1, 1, 0, 0),
(53, 5, 31, 1, 1, 0, 0),
(54, 5, 34, 1, 1, 0, 0),
(55, 5, 15, 0, 0, 0, 0),
(56, 4, 6, 1, 0, 0, 0),
(57, 4, 8, 1, 0, 0, 0),
(58, 4, 19, 1, 0, 0, 0),
(59, 4, 20, 1, 0, 0, 0),
(60, 4, 31, 1, 1, 0, 0),
(61, 4, 33, 1, 1, 0, 0),
(62, 5, 33, 1, 1, 0, 0),
(63, 1, 35, 1, 1, 1, 1),
(64, 1, 36, 1, 1, 1, 1),
(65, 1, 37, 1, 1, 1, 1),
(66, 1, 38, 1, 1, 1, 1),
(67, 1, 39, 1, 1, 1, 1),
(68, 6, 5, 1, 0, 0, 0),
(69, 4, 35, 1, 0, 0, 0),
(70, 1, 40, 1, 1, 1, 1),
(71, 1, 41, 1, 1, 1, 1),
(72, 1, 42, 1, 1, 0, 0),
(73, 1, 43, 1, 1, 0, 0),
(74, 1, 44, 1, 1, 0, 0),
(75, 1, 45, 1, 1, 0, 0),
(76, 1, 46, 1, 1, 1, 1),
(77, 1, 47, 1, 1, 1, 1),
(78, 1, 48, 1, 1, 1, 1),
(79, 1, 49, 1, 1, 1, 1),
(80, 1, 50, 1, 1, 1, 1),
(81, 99, 50, 1, 1, 0, 0),
(82, 1, 51, 1, 1, 1, 1),
(83, 1, 52, 1, 1, 1, 1),
(84, 1, 53, 1, 1, 1, 1),
(85, 1, 54, 1, 1, 1, 1),
(86, 1, 55, 1, 1, 1, 1),
(87, 1, 57, 1, 1, 1, 1),
(88, 1, 58, 1, 1, 1, 1),
(89, 1, 59, 1, 1, 1, 1),
(90, 1, 60, 1, 1, 1, 1),
(91, 1, 61, 1, 1, 1, 1),
(92, 1, 62, 1, 1, 1, 1),
(93, 1, 63, 1, 1, 1, 1),
(94, 1, 64, 1, 1, 1, 1),
(95, 1, 65, 1, 1, 1, 1),
(96, 1, 66, 1, 1, 1, 1),
(97, 1, 67, 1, 1, 1, 1),
(98, 1, 68, 1, 1, 1, 1),
(99, 105, 4, 1, 1, 0, 0),
(100, 105, 9, 1, 1, 0, 0),
(101, 105, 54, 1, 1, 0, 0),
(102, 105, 55, 1, 0, 0, 0),
(103, 105, 57, 1, 0, 0, 0),
(104, 105, 58, 1, 0, 0, 0),
(105, 105, 59, 1, 1, 0, 0),
(106, 105, 60, 1, 0, 0, 0),
(107, 105, 61, 1, 0, 0, 0),
(108, 105, 62, 1, 0, 0, 0),
(109, 105, 63, 1, 0, 0, 0),
(110, 105, 64, 1, 0, 0, 0),
(111, 105, 65, 1, 0, 0, 0),
(112, 105, 66, 1, 0, 0, 0),
(113, 105, 67, 1, 0, 0, 0),
(114, 105, 68, 1, 0, 0, 0),
(115, 106, 59, 1, 1, 0, 0),
(116, 106, 62, 1, 0, 0, 0),
(117, 106, 63, 1, 0, 0, 0),
(118, 106, 64, 1, 0, 0, 0),
(119, 106, 65, 1, 0, 0, 0),
(120, 106, 66, 1, 0, 0, 0),
(121, 106, 67, 1, 0, 0, 0),
(122, 106, 68, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT 'default.png',
  `language` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `role_id` int(11) NOT NULL DEFAULT '1',
  `active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `username`, `email`, `phone`, `password`, `remember_token`, `created_at`, `updated_at`, `photo`, `language`, `role_id`, `active`) VALUES
(1, 'Chheng', 'Y', 'Female', 'admin', 'admin@gmail.com', '086956747', '$2y$10$9tIWTPPo5IQBtnj2l6Q07.zdpnks0DDnmR7AVwSmYBLzfzls/YQ9O', 'nj867zZp49Ezrzh20ltST2Xpdb7pHrUPvYGijRe9Y1z5QOZ0xx9MMQqym0td', '2017-05-27 22:35:52', '2017-05-27 22:35:52', 'uploads/users/oRuoyJqXanL1vOXWT75fGXR9HOtrb4z9d3unsvao.png', 'en', 1, 1),
(22, 'root', 'root', 'Male', 'root', 'hengvongkol@gmail.com', '086397627', '$2y$10$zjR6YTPEBNRTddFk9km3DuJgtao9rgdj0qq5VSOtoRY2RyS/Msby.', NULL, NULL, NULL, 'default.png', 'en', 1, 1),
(23, 'Account', 'Account', 'Female', 'accountant', NULL, NULL, '$2y$10$WFKzuaGy6VPm.mnFY5KizuEkyrqdXL8KpZSN32Wzs4DGiPOPhG4YC', NULL, NULL, NULL, 'default.png', 'en', 106, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phone_shops`
--
ALTER TABLE `phone_shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `phone_shops`
--
ALTER TABLE `phone_shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
