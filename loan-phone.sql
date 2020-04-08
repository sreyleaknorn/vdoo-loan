-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 08, 2020 at 08:36 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.29-1+ubuntu18.04.1+deb.sury.org+1

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

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `create_at`, `active`) VALUES
(1, 'Sreyleak', '09999999', '2020-03-12 10:00:33', 1),
(2, 'Dara', '098500081', '2020-03-19 08:53:04', 1),
(3, 'Yu Dalin', '099776655', '2020-03-19 09:02:10', 1),
(4, 'Kunthea', '012334455', '2020-03-20 08:30:13', 1),
(5, 'Mr. Samnang', '098500081', '2020-03-22 04:12:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `loanpayments`
--

CREATE TABLE `loanpayments` (
  `id` int(10) UNSIGNED NOT NULL,
  `loan_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `loanschedule_id` int(11) NOT NULL,
  `receive_amount` double(8,3) NOT NULL DEFAULT '0.000',
  `receive_date` date DEFAULT NULL,
  `note` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loanpayments`
--

INSERT INTO `loanpayments` (`id`, `loan_id`, `customer_id`, `loanschedule_id`, `receive_amount`, `receive_date`, `note`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 133.330, '2020-03-18', NULL, 0, '2020-03-18 16:29:52', '2020-03-18 16:29:52'),
(2, 1, 1, 2, 133.330, '2020-03-18', NULL, 0, '2020-03-18 16:30:57', '2020-03-18 16:30:57'),
(3, 1, 1, 3, 133.330, '2020-03-18', NULL, 0, '2020-03-18 16:31:08', '2020-03-18 16:31:08'),
(4, 1, 1, 4, 133.330, '2020-03-18', NULL, 0, '2020-03-18 16:31:12', '2020-03-18 16:31:12'),
(5, 1, 1, 5, 133.330, '2020-03-18', NULL, 0, '2020-03-18 16:31:16', '2020-03-18 16:31:16'),
(6, 1, 1, 6, 133.330, '2020-03-18', NULL, 0, '2020-03-18 16:31:20', '2020-03-18 16:31:20'),
(7, 1, 1, 7, 133.330, '2020-03-18', NULL, 0, '2020-03-18 16:31:26', '2020-03-18 16:31:26'),
(8, 1, 1, 8, 133.330, '2020-03-18', NULL, 0, '2020-03-18 16:31:31', '2020-03-18 16:31:31'),
(9, 1, 1, 9, 133.330, '2020-03-18', NULL, 0, '2020-03-18 16:31:35', '2020-03-18 16:31:35'),
(10, 1, 1, 10, 133.330, '2020-03-18', NULL, 0, '2020-03-18 16:31:39', '2020-03-18 16:31:39'),
(11, 1, 1, 11, 133.330, '2020-03-18', NULL, 0, '2020-03-18 16:31:44', '2020-03-18 16:31:44'),
(12, 1, 1, 12, 133.330, '2020-03-19', NULL, 0, '2020-03-18 16:31:53', '2020-03-18 16:31:53'),
(13, 2, 1, 13, 196.670, '2020-03-18', NULL, 0, '2020-03-18 16:37:00', '2020-03-18 16:37:00'),
(14, 2, 1, 14, 196.670, '2020-03-18', NULL, 0, '2020-03-18 16:37:05', '2020-03-18 16:37:05'),
(15, 2, 1, 15, 196.670, '2020-03-18', NULL, 1, '2020-03-18 16:37:09', '2020-03-18 16:37:09'),
(16, 2, 1, 16, 196.670, '2020-03-18', NULL, 1, '2020-03-18 16:37:12', '2020-03-18 16:37:12'),
(17, 2, 1, 17, 100.000, '2020-03-18', NULL, 1, '2020-03-18 16:37:26', '2020-03-18 16:37:26'),
(18, 2, 1, 17, 96.670, '2020-03-18', NULL, 1, '2020-03-18 16:37:32', '2020-03-18 16:37:32'),
(19, 2, 1, 18, 196.670, '2020-03-18', NULL, 1, '2020-03-18 16:37:37', '2020-03-18 16:37:37'),
(20, 2, 1, 18, 0.000, '2020-03-18', NULL, 0, '2020-03-18 16:43:04', '2020-03-18 16:43:04'),
(21, 3, 1, 19, 0.000, '2020-03-18', NULL, 0, '2020-03-18 16:44:15', '2020-03-18 16:44:15'),
(22, 3, 1, 19, 100.000, '2020-03-18', NULL, 0, '2020-03-18 16:51:12', '2020-03-18 16:51:12'),
(23, 3, 1, 19, 15.000, '2020-03-18', NULL, 0, '2020-03-18 16:51:20', '2020-03-18 16:51:20'),
(24, 3, 1, 20, 115.000, '2020-03-19', NULL, 0, '2020-03-19 09:05:03', '2020-03-19 09:05:03'),
(25, 2, 1, 13, 196.670, '2020-03-20', NULL, 1, '2020-03-20 02:37:33', '2020-03-20 02:37:33'),
(26, 2, 1, 14, 196.670, '2020-03-20', NULL, 1, '2020-03-20 02:38:37', '2020-03-20 02:38:37'),
(27, 4, 3, 22, 216.670, '2020-03-20', NULL, 0, '2020-03-20 04:17:20', '2020-03-20 04:17:20'),
(28, 4, 3, 23, 216.667, '2020-03-20', NULL, 1, '2020-03-20 08:29:39', '2020-03-20 08:29:39'),
(29, 5, 4, 28, 216.667, '2020-03-20', NULL, 0, '2020-03-20 08:34:44', '2020-03-20 08:34:44'),
(30, 5, 4, 29, 216.666, '2020-03-20', NULL, 0, '2020-03-20 09:55:23', '2020-03-20 09:55:23'),
(31, 5, 4, 29, 0.001, '2020-03-20', NULL, 0, '2020-03-20 09:55:39', '2020-03-20 09:55:39'),
(32, 4, 3, 22, 216.670, '2020-03-20', NULL, 1, '2020-03-20 09:57:09', '2020-03-20 09:57:09'),
(33, 6, 5, 34, 120.000, '2020-03-22', NULL, 0, '2020-03-22 04:16:30', '2020-03-22 04:16:30'),
(34, 6, 5, 35, 120.000, '2020-03-22', NULL, 0, '2020-03-22 04:16:47', '2020-03-22 04:16:47'),
(35, 6, 5, 36, 120.000, '2020-03-22', NULL, 0, '2020-03-22 04:17:00', '2020-03-22 04:17:00'),
(36, 6, 5, 37, 120.000, '2020-03-22', NULL, 0, '2020-03-22 04:17:06', '2020-03-22 04:17:06'),
(37, 6, 5, 38, 120.000, '2020-03-22', NULL, 0, '2020-03-22 04:17:11', '2020-03-22 04:17:11'),
(38, 6, 5, 39, 120.000, '2020-03-22', NULL, 1, '2020-03-22 04:17:15', '2020-03-22 04:17:15'),
(39, 6, 5, 40, 120.000, '2020-03-22', NULL, 0, '2020-03-22 04:17:19', '2020-03-22 04:17:19'),
(40, 6, 5, 41, 120.000, '2020-03-22', NULL, 1, '2020-03-22 04:17:24', '2020-03-22 04:17:24'),
(41, 6, 5, 42, 120.000, '2020-03-22', NULL, 1, '2020-03-22 04:17:28', '2020-03-22 04:17:28'),
(42, 6, 5, 43, 120.000, '2020-03-22', NULL, 0, '2020-03-22 04:17:36', '2020-03-22 04:17:36'),
(43, 6, 5, 34, 120.000, '2020-03-22', NULL, 0, '2020-03-22 04:18:17', '2020-03-22 04:18:17'),
(44, 5, 4, 29, 216.667, '2020-03-22', NULL, 0, '2020-03-22 04:19:33', '2020-03-22 04:19:33'),
(45, 5, 4, 30, 100.000, '2020-03-25', NULL, 0, '2020-03-25 04:56:23', '2020-03-25 04:56:23'),
(46, 5, 4, 30, 216.667, '2020-03-25', NULL, 0, '2020-03-25 07:47:04', '2020-03-25 07:47:04'),
(47, 5, 4, 31, 216.667, '2020-03-25', NULL, 0, '2020-03-25 07:47:04', '2020-03-25 07:47:04'),
(48, 6, 5, 35, 120.000, '2020-03-25', NULL, 0, '2020-03-25 07:49:32', '2020-03-25 07:49:32'),
(49, 6, 5, 36, 120.000, '2020-03-25', NULL, 0, '2020-03-25 07:49:32', '2020-03-25 07:49:32'),
(50, 6, 5, 43, 120.000, '2020-03-25', NULL, 0, '2020-03-25 07:49:32', '2020-03-25 07:49:32'),
(51, 6, 5, 34, 120.000, '2020-03-25', NULL, 0, '2020-03-25 07:49:46', '2020-03-25 07:49:46'),
(52, 6, 5, 36, 100.000, '2020-03-25', NULL, 1, '2020-03-25 07:50:43', '2020-03-25 07:50:43'),
(53, 6, 5, 34, 120.000, '2020-03-25', NULL, 1, '2020-03-25 07:51:03', '2020-03-25 07:51:03'),
(54, 6, 5, 36, 20.000, '2020-03-25', NULL, 0, '2020-03-25 07:51:03', '2020-03-25 07:51:03'),
(55, 6, 5, 43, 120.000, '2020-03-25', NULL, 0, '2020-03-25 07:51:03', '2020-03-25 07:51:03'),
(56, 6, 5, 36, 20.000, '2020-03-25', NULL, 1, '2020-03-25 07:51:33', '2020-03-25 07:51:33'),
(57, 6, 5, 43, 120.000, '2020-03-25', NULL, 1, '2020-03-25 07:51:33', '2020-03-25 07:51:33'),
(58, 6, 5, 37, 100.000, '2020-03-25', NULL, 1, '2020-03-25 08:26:58', '2020-03-25 08:26:58'),
(59, 6, 5, 35, 120.000, '2020-03-25', NULL, 1, '2020-03-25 08:27:25', '2020-03-25 08:27:25'),
(60, 6, 5, 37, 20.000, '2020-03-25', NULL, 0, '2020-03-25 08:27:25', '2020-03-25 08:27:25'),
(61, 6, 5, 38, 120.000, '2020-03-25', NULL, 1, '2020-03-25 08:28:22', '2020-03-25 08:28:22'),
(62, 6, 5, 37, 20.000, '2020-03-25', NULL, 1, '2020-03-25 08:28:43', '2020-03-25 08:28:43'),
(63, 6, 5, 40, 120.000, '2020-03-25', NULL, 1, '2020-03-25 08:28:43', '2020-03-25 08:28:43'),
(64, 7, 2, 44, 165.333, '2020-03-27', NULL, 1, '2020-03-27 08:46:37', '2020-03-27 08:46:37'),
(65, 7, 2, 45, 150.000, '2020-03-28', NULL, 1, '2020-03-28 07:20:00', '2020-03-28 07:20:00'),
(66, 7, 2, 46, 150.000, '2020-03-28', NULL, 1, '2020-03-28 07:20:00', '2020-03-28 07:20:00'),
(67, 7, 2, 47, 150.000, '2020-03-28', NULL, 1, '2020-03-28 07:20:00', '2020-03-28 07:20:00'),
(68, 7, 2, 48, 150.000, '2020-03-28', NULL, 1, '2020-03-28 07:20:00', '2020-03-28 07:20:00'),
(69, 7, 2, 49, 150.000, '2020-03-28', NULL, 1, '2020-03-28 07:20:00', '2020-03-28 07:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `model_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `serial` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `bill_no` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `loan_date` date NOT NULL,
  `release_date` date DEFAULT NULL,
  `loan_amount` double(8,2) NOT NULL,
  `loan_interest` double(8,3) NOT NULL,
  `start_interest_date` date DEFAULT NULL,
  `total_interest` double(8,3) NOT NULL DEFAULT '0.000',
  `total_amount` double(8,3) NOT NULL DEFAULT '0.000',
  `due_amount` double(8,3) NOT NULL DEFAULT '0.000',
  `paid_amount` double(8,3) NOT NULL DEFAULT '0.000',
  `num_repayment` int(11) NOT NULL DEFAULT '0',
  `repayment_type` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `note` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `paid_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `customer_id`, `shop_id`, `model_name`, `serial`, `bill_no`, `loan_date`, `release_date`, `loan_amount`, `loan_interest`, `start_interest_date`, `total_interest`, `total_amount`, `due_amount`, `paid_amount`, `num_repayment`, `repayment_type`, `active`, `note`, `status`, `paid_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'iphone 7', 'AAABBBCC', NULL, '2020-03-17', '2020-03-17', 1000.00, 5.000, '2020-03-17', 600.000, 1600.000, 0.000, 1600.000, 12, 'Month', 0, NULL, 'paying', NULL, NULL, NULL),
(2, 1, 3, 'iphone 7', 'AAABBBCC', NULL, '2020-03-17', '2020-03-17', 1000.00, 3.000, '2020-03-17', 180.000, 1180.000, 0.000, 1180.000, 6, 'Month', 1, 'testing', 'paid', '2020-03-20', NULL, NULL),
(3, 1, 1, 'iphone 7', 'AAABBBCC', NULL, '2020-03-18', '2020-03-18', 300.00, 5.000, '2020-03-18', 45.000, 345.000, 115.000, 230.000, 3, 'Month', 0, NULL, 'paying', NULL, '2020-03-18 16:43:48', '2020-03-18 16:43:48'),
(4, 3, 4, 'iphone 7', 'AAABBBCC', NULL, '2020-03-19', '2020-03-19', 1000.00, 5.000, '2020-03-19', 300.000, 1300.000, 866.667, 433.333, 6, 'Month', 1, 'Testing', 'stopped', NULL, '2020-03-19 09:02:29', '2020-03-19 09:02:29'),
(5, 4, 5, 'iphone 8 plus', '0033333777788', '02333', '2020-03-20', '2020-03-20', 1000.00, 5.000, '2020-03-20', 300.000, 1300.000, 766.667, 533.333, 6, 'Month', 0, 'Tesing new', 'paying', NULL, '2020-03-20 08:31:55', '2020-03-20 08:31:55'),
(6, 5, 6, 'iPhone X max', 'XXXMMM', 'INV00001', '2020-03-22', '2020-03-22', 1000.00, 2.000, '2020-03-22', 200.000, 1200.000, 0.000, 1200.000, 10, 'Month', 1, NULL, 'paid', '2020-03-25', '2020-03-22 04:13:44', '2020-03-22 04:13:44'),
(7, 2, 2, 'iphone 8', 'AAABBBCC', 'INV00005', '2020-03-27', '2020-03-27', 800.00, 4.000, '2020-03-27', 192.000, 992.000, 0.000, 915.333, 6, 'Month', 1, NULL, 'paid', '2020-03-28', '2020-03-27 08:44:30', '2020-03-27 08:44:30'),
(8, 4, 6, 'Sumsung', 'hhssss', 'INV00006', '2020-03-28', '2020-03-28', 500.00, 4.000, '2020-03-28', 120.000, 620.000, 620.000, 0.000, 6, 'Month', 1, NULL, 'stopped', NULL, '2020-03-28 03:04:03', '2020-03-28 03:04:03');

-- --------------------------------------------------------

--
-- Table structure for table `loanschedules`
--

CREATE TABLE `loanschedules` (
  `id` int(10) UNSIGNED NOT NULL,
  `loan_id` int(11) NOT NULL,
  `pay_date` date NOT NULL,
  `principal_amount` double(8,3) NOT NULL DEFAULT '0.000',
  `interest_amount` double(8,3) NOT NULL DEFAULT '0.000',
  `total_amount` double(8,3) NOT NULL,
  `due_amount` double(8,3) NOT NULL DEFAULT '0.000',
  `paid_amount` double(8,3) NOT NULL DEFAULT '0.000',
  `paid_date` date DEFAULT NULL,
  `ispaid` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loanschedules`
--

INSERT INTO `loanschedules` (`id`, `loan_id`, `pay_date`, `principal_amount`, `interest_amount`, `total_amount`, `due_amount`, `paid_amount`, `paid_date`, `ispaid`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-04-17', 83.333, 50.000, 133.333, 0.000, 133.333, '2020-03-18', 1, 0, NULL, NULL),
(2, 1, '2020-05-17', 83.333, 50.000, 133.333, 0.000, 133.333, '2020-03-18', 1, 0, NULL, NULL),
(3, 1, '2020-06-17', 83.333, 50.000, 133.333, 0.000, 133.333, '2020-03-18', 1, 0, NULL, NULL),
(4, 1, '2020-07-17', 83.333, 50.000, 133.333, 0.000, 133.333, '2020-03-18', 1, 0, NULL, NULL),
(5, 1, '2020-08-17', 83.333, 50.000, 133.333, 0.000, 133.333, '2020-03-18', 1, 0, NULL, NULL),
(6, 1, '2020-09-17', 83.333, 50.000, 133.333, 0.000, 133.333, '2020-03-18', 1, 0, NULL, NULL),
(7, 1, '2020-10-17', 83.333, 50.000, 133.333, 0.000, 133.333, '2020-03-18', 1, 0, NULL, NULL),
(8, 1, '2020-11-17', 83.333, 50.000, 133.333, 0.000, 133.333, '2020-03-18', 1, 0, NULL, NULL),
(9, 1, '2020-12-17', 83.333, 50.000, 133.333, 0.000, 133.333, '2020-03-18', 1, 0, NULL, NULL),
(10, 1, '2021-01-17', 83.333, 50.000, 133.333, 0.000, 133.333, '2020-03-18', 1, 0, NULL, NULL),
(11, 1, '2021-02-17', 83.333, 50.000, 133.333, 0.000, 133.333, '2020-03-18', 1, 0, NULL, NULL),
(12, 1, '2021-03-17', 83.333, 50.000, 133.333, 0.000, 133.333, '2020-03-19', 1, 0, NULL, NULL),
(13, 2, '2020-04-17', 166.667, 30.000, 196.667, 0.000, 196.667, '2020-03-20', 1, 1, NULL, NULL),
(14, 2, '2020-05-17', 166.667, 30.000, 196.667, 0.000, 196.667, '2020-03-20', 1, 1, NULL, NULL),
(15, 2, '2020-06-17', 166.667, 30.000, 196.667, 0.000, 196.667, '2020-03-18', 1, 1, NULL, NULL),
(16, 2, '2020-07-17', 166.667, 30.000, 196.667, 0.000, 196.667, '2020-03-18', 1, 1, NULL, NULL),
(17, 2, '2020-08-17', 166.667, 30.000, 196.667, 0.000, 196.667, '2020-03-18', 1, 1, NULL, NULL),
(18, 2, '2020-09-17', 166.667, 30.000, 196.667, 0.000, 196.667, '2020-03-18', 1, 1, NULL, NULL),
(19, 3, '2020-04-18', 100.000, 15.000, 115.000, 0.000, 115.000, '2020-03-18', 1, 0, '2020-03-18 16:43:48', '2020-03-18 16:43:48'),
(20, 3, '2020-05-18', 100.000, 15.000, 115.000, 0.000, 115.000, '2020-03-19', 1, 0, '2020-03-18 16:43:48', '2020-03-18 16:43:48'),
(22, 4, '2020-04-19', 166.667, 50.000, 216.667, 0.000, 216.667, '2020-03-20', 1, 1, '2020-03-19 09:02:29', '2020-03-19 09:02:29'),
(23, 4, '2020-03-29', 166.667, 50.000, 216.667, 0.000, 216.667, '2020-03-20', 1, 1, '2020-03-19 09:02:29', '2020-03-19 09:02:29'),
(24, 4, '2020-03-29', 166.667, 50.000, 216.667, 216.667, 0.000, NULL, 0, 1, '2020-03-19 09:02:29', '2020-03-19 09:02:29'),
(25, 4, '2020-07-19', 166.667, 50.000, 216.667, 216.667, 0.000, NULL, 0, 1, '2020-03-19 09:02:29', '2020-03-19 09:02:29'),
(26, 4, '2020-08-19', 166.667, 50.000, 216.667, 216.667, 0.000, NULL, 0, 1, '2020-03-19 09:02:29', '2020-03-19 09:02:29'),
(27, 4, '2020-09-19', 166.667, 50.000, 216.667, 216.667, 0.000, NULL, 0, 1, '2020-03-19 09:02:29', '2020-03-19 09:02:29'),
(28, 5, '2020-04-20', 166.667, 50.000, 216.667, 0.000, 216.667, '2020-03-20', 1, 0, '2020-03-20 08:31:55', '2020-03-20 08:31:55'),
(29, 5, '2020-05-20', 166.667, 50.000, 216.667, 0.000, 216.667, '2020-03-22', 1, 0, '2020-03-20 08:31:55', '2020-03-20 08:31:55'),
(30, 5, '2020-06-20', 166.667, 50.000, 216.667, 0.000, 216.667, '2020-03-25', 1, 0, '2020-03-20 08:31:55', '2020-03-20 08:31:55'),
(31, 5, '2020-07-20', 166.667, 50.000, 216.667, 0.000, 216.667, '2020-03-25', 1, 0, '2020-03-20 08:31:55', '2020-03-20 08:31:55'),
(32, 5, '2020-08-20', 166.667, 50.000, 216.667, 0.000, 216.667, '2020-03-25', 1, 0, '2020-03-20 08:31:55', '2020-03-20 08:31:55'),
(33, 5, '2020-09-20', 166.667, 50.000, 216.667, 216.667, 0.000, NULL, 0, 0, '2020-03-20 08:31:55', '2020-03-20 08:31:55'),
(34, 6, '2020-04-22', 100.000, 20.000, 120.000, 0.000, 120.000, '2020-03-25', 1, 1, '2020-03-22 04:13:44', '2020-03-22 04:13:44'),
(35, 6, '2020-05-22', 100.000, 20.000, 120.000, 0.000, 120.000, '2020-03-25', 1, 1, '2020-03-22 04:13:44', '2020-03-22 04:13:44'),
(36, 6, '2020-06-22', 100.000, 20.000, 120.000, 0.000, 120.000, '2020-03-25', 1, 1, '2020-03-22 04:13:44', '2020-03-22 04:13:44'),
(37, 6, '2020-07-22', 100.000, 20.000, 120.000, 0.000, 120.000, '2020-03-25', 1, 1, '2020-03-22 04:13:44', '2020-03-22 04:13:44'),
(38, 6, '2020-08-22', 100.000, 20.000, 120.000, 0.000, 120.000, '2020-03-25', 1, 1, '2020-03-22 04:13:44', '2020-03-22 04:13:44'),
(39, 6, '2020-09-22', 100.000, 20.000, 120.000, 0.000, 120.000, '2020-03-22', 1, 1, '2020-03-22 04:13:44', '2020-03-22 04:13:44'),
(40, 6, '2020-10-22', 100.000, 20.000, 120.000, 0.000, 120.000, '2020-03-25', 1, 1, '2020-03-22 04:13:44', '2020-03-22 04:13:44'),
(41, 6, '2020-11-22', 100.000, 20.000, 120.000, 0.000, 120.000, '2020-03-22', 1, 1, '2020-03-22 04:13:44', '2020-03-22 04:13:44'),
(42, 6, '2020-12-22', 100.000, 20.000, 120.000, 0.000, 120.000, '2020-03-22', 1, 1, '2020-03-22 04:13:44', '2020-03-22 04:13:44'),
(43, 6, '2021-01-22', 100.000, 20.000, 120.000, 0.000, 120.000, '2020-03-25', 1, 1, '2020-03-22 04:13:44', '2020-03-22 04:13:44'),
(44, 7, '2020-04-27', 133.333, 32.000, 165.333, 0.000, 165.333, '2020-03-27', 1, 1, '2020-03-27 08:44:31', '2020-03-27 08:44:31'),
(45, 7, '2020-05-27', 133.333, 32.000, 165.333, 0.000, 150.000, '2020-03-28', 1, 1, '2020-03-27 08:44:31', '2020-03-27 08:44:31'),
(46, 7, '2020-06-27', 133.333, 32.000, 165.333, 0.000, 150.000, '2020-03-28', 1, 1, '2020-03-27 08:44:31', '2020-03-27 08:44:31'),
(47, 7, '2020-07-27', 133.333, 32.000, 165.333, 0.000, 150.000, '2020-03-28', 1, 1, '2020-03-27 08:44:31', '2020-03-27 08:44:31'),
(48, 7, '2020-08-27', 133.333, 32.000, 165.333, 0.000, 150.000, '2020-03-28', 1, 1, '2020-03-27 08:44:31', '2020-03-27 08:44:31'),
(49, 7, '2020-09-27', 133.333, 32.000, 165.333, 0.000, 150.000, '2020-03-28', 1, 1, '2020-03-27 08:44:31', '2020-03-27 08:44:31'),
(50, 8, '2020-04-28', 83.333, 20.000, 103.333, 103.333, 0.000, NULL, 0, 1, '2020-03-28 03:04:03', '2020-03-28 03:04:03'),
(51, 8, '2020-05-28', 83.333, 20.000, 103.333, 103.333, 0.000, NULL, 0, 1, '2020-03-28 03:04:03', '2020-03-28 03:04:03'),
(52, 8, '2020-06-28', 83.333, 20.000, 103.333, 103.333, 0.000, NULL, 0, 1, '2020-03-28 03:04:03', '2020-03-28 03:04:03'),
(53, 8, '2020-07-28', 83.333, 20.000, 103.333, 103.333, 0.000, NULL, 0, 1, '2020-03-28 03:04:03', '2020-03-28 03:04:03'),
(54, 8, '2020-08-28', 83.333, 20.000, 103.333, 103.333, 0.000, NULL, 0, 1, '2020-03-28 03:04:03', '2020-03-28 03:04:03'),
(55, 8, '2020-09-28', 83.333, 20.000, 103.333, 103.333, 0.000, NULL, 0, 1, '2020-03-28 03:04:03', '2020-03-28 03:04:03');

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
(1, 'Role', 'តួនាទី', 0, 0, 0, 0),
(2, 'User', 'អ្នកប្រើប្រាស់', 0, 0, 0, 0),
(3, 'permission', 'សិទ្ធិ', 0, 0, 0, 0),
(4, 'company', 'ក្រុមហ៊ុន', 0, 0, 0, 0),
(58, 'customer', 'អតិថិជន', 0, 0, 0, 0),
(73, 'payment_report', 'របាយការណ៍ចំណូល', 0, 0, 0, 0),
(69, 'phone_shop', 'ហាងទូរស័ព្ទ', 0, 0, 0, 0),
(70, 'loan', 'កម្ចី', 0, 0, 0, 0),
(71, 'loanschedule', 'តារាងបង់ប្រាក់', 0, 0, 0, 0),
(72, 'loanpayment', 'ការបង់ប្រាក់', 0, 0, 0, 0),
(74, 'expense_report', 'របាយការណ៍ចំណាយ', 0, 0, 0, 0);

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

--
-- Dumping data for table `phone_shops`
--

INSERT INTO `phone_shops` (`id`, `name`, `phone`, `address`, `active`, `create_at`) VALUES
(1, 'ABC', '09999999', 'No. 37-39 Preah Monireth Blvd. Sangkat Veal Vong, Khan 7 Makara Phnom Penh, Cambodia', 1, '2020-03-13 02:01:19'),
(2, 'BBC', '0999999922', 'PP , Cambodia2', 1, '2020-03-13 02:02:00'),
(3, 'VBR', '099678544', 'PP Cambodia', 1, '2020-03-13 02:37:04'),
(4, 'Shop 1', '0778899662', 'Toul Kork, PP, Cambodia', 1, '2020-03-19 09:01:52'),
(5, 'Dyna Phone', '0778899662', 'PP', 1, '2020-03-20 08:30:34'),
(6, 'Nika', '09999999', NULL, 1, '2020-03-22 04:12:42');

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
(122, 106, 68, 1, 0, 0, 0),
(123, 1, 69, 1, 1, 1, 1),
(124, 1, 70, 1, 1, 1, 1),
(125, 1, 71, 1, 1, 1, 1),
(126, 1, 72, 1, 1, 1, 1),
(127, 1, 73, 1, 1, 1, 1),
(128, 1, 74, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stop_payments`
--

CREATE TABLE `stop_payments` (
  `id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `stop_date` date NOT NULL,
  `reason` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stop_payments`
--

INSERT INTO `stop_payments` (`id`, `loan_id`, `stop_date`, `reason`, `active`, `create_at`) VALUES
(1, 4, '2020-03-27', 'អតិថិជនឈប់បង់ប្រាក់', 1, '2020-03-27 15:14:19'),
(2, 8, '2020-03-28', 'Return the number of elements in an array:\r\n\r\n<?php', 1, '2020-03-28 14:31:22');

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
(1, 'Chheng', 'Y', 'Female', 'admin', 'admin@gmail.com', '086956747', '$2y$10$9tIWTPPo5IQBtnj2l6Q07.zdpnks0DDnmR7AVwSmYBLzfzls/YQ9O', '4xmnIAyb2Y0NOSAM6ap467NQ1gO6A4p3ZQ0eotsAoKfpERJPWS7rFkkO7Koz', '2017-05-27 22:35:52', '2017-05-27 22:35:52', 'uploads/users/oRuoyJqXanL1vOXWT75fGXR9HOtrb4z9d3unsvao.png', 'en', 1, 1),
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
-- Indexes for table `loanpayments`
--
ALTER TABLE `loanpayments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loanschedules`
--
ALTER TABLE `loanschedules`
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
-- Indexes for table `stop_payments`
--
ALTER TABLE `stop_payments`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `loanpayments`
--
ALTER TABLE `loanpayments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `loanschedules`
--
ALTER TABLE `loanschedules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `phone_shops`
--
ALTER TABLE `phone_shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `stop_payments`
--
ALTER TABLE `stop_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
