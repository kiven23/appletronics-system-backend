-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 12, 2023 at 05:02 PM
-- Server version: 10.3.29-MariaDB-0ubuntu0.20.10.1
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appletronics_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_charts`
--

CREATE TABLE `access_charts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `access_for` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `access_charts`
--

INSERT INTO `access_charts` (`id`, `name`, `created_at`, `updated_at`, `access_for`) VALUES
(1, 'Branch C&C', '2018-10-21 12:06:28', '2018-10-21 12:06:28', 0),
(2, 'MIS', '2018-10-21 12:06:29', '2018-10-21 12:06:29', 0),
(3, 'Branch Motorpool', '2018-10-21 12:06:30', '2018-10-21 12:06:30', 0),
(4, 'Branch Inventory', '2018-10-21 12:06:30', '2018-10-21 12:06:30', 0),
(5, 'Branch Purchasing & Inventory', '2018-10-21 12:06:30', '2018-10-21 12:06:30', 0),
(6, 'Branch Operations', '2018-10-21 12:06:31', '2018-10-21 12:06:31', 0),
(7, 'Branch Sales', '2018-10-21 12:06:33', '2018-10-21 12:06:33', 0),
(8, 'Branch Treasury', '2018-10-21 12:06:34', '2018-10-21 12:06:34', 0),
(9, 'HR Division', '2018-10-21 12:06:42', '2018-10-21 12:06:42', 0),
(10, 'Branch MS', '2018-10-21 12:06:43', '2018-10-21 12:06:43', 0),
(11, 'Nancayasan Acct. Analyst', '2019-06-03 18:54:58', '2019-06-03 18:54:58', 0),
(12, 'Nancayasan BICI', '2019-06-03 19:08:47', '2019-06-03 19:08:47', 0),
(13, 'Nancayasan BICS', '2019-06-03 19:10:45', '2019-06-03 19:10:45', 0),
(14, 'Nancayasan Cashier', '2019-06-03 19:15:10', '2019-06-03 19:15:10', 0),
(15, 'Nancayasan CCS', '2019-06-03 19:17:13', '2019-06-03 19:17:13', 0),
(16, 'Nancayasan Driver', '2019-06-03 19:58:28', '2019-06-03 19:58:28', 0),
(17, 'Nancayasan SS/Technician/Helper', '2019-06-03 20:04:56', '2019-06-03 20:04:56', 0),
(18, 'Nancayasan MSS', '2019-06-03 20:08:31', '2019-06-03 20:08:31', 0),
(19, 'Urdaneta SS/Asst.SS/Technician/Helper', '2019-06-08 13:39:26', '2019-06-08 13:39:26', 0),
(20, 'Urdaneta CCS/Asst.CCS', '2019-06-08 13:39:43', '2019-06-08 13:39:43', 0),
(21, 'Urdaneta Account Analyst', '2019-06-08 13:40:01', '2019-06-08 13:40:01', 0),
(22, 'Urdaneta MSS/Asst.MSS', '2019-06-08 13:40:20', '2019-06-08 13:40:20', 0),
(23, 'Urdaneta BICS', '2019-06-08 13:40:30', '2019-06-08 13:40:30', 0),
(24, 'Urdaneta BICI', '2019-06-08 13:40:38', '2019-06-08 13:40:38', 0),
(25, 'Urdaneta Cashier', '2019-06-08 13:41:07', '2019-06-08 13:41:07', 0),
(26, 'Urdaneta Driver', '2019-06-08 13:41:14', '2019-06-08 13:41:14', 0),
(27, 'approver', '2020-12-16 10:53:58', '2020-12-16 10:53:58', 1),
(28, 'MRF APPROVER', '2021-02-25 11:04:37', '2021-02-25 11:04:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `access_chart_user_maps`
--

CREATE TABLE `access_chart_user_maps` (
  `id` int(10) UNSIGNED NOT NULL,
  `accesschart_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `access_level` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `access_chart_user_maps`
--

INSERT INTO `access_chart_user_maps` (`id`, `accesschart_id`, `user_id`, `access_level`, `created_at`, `updated_at`) VALUES
(9, 11, 68, 1, '2019-06-03 18:56:39', '2019-06-03 18:56:39'),
(10, 11, 1142, 2, '2019-06-03 19:05:50', '2019-06-03 19:05:50'),
(11, 11, 844, 2, '2019-06-03 19:06:21', '2019-06-03 19:12:43'),
(12, 12, 67, 1, '2019-06-03 19:09:16', '2019-06-03 19:09:16'),
(13, 12, 69, 2, '2019-06-03 19:09:28', '2019-06-03 19:09:28'),
(14, 12, 1146, 3, '2019-06-03 19:09:42', '2019-06-03 19:09:42'),
(15, 12, 1144, 3, '2019-06-03 19:10:02', '2019-06-03 19:13:23'),
(16, 13, 67, 1, '2019-06-03 19:11:03', '2019-06-03 19:11:03'),
(17, 13, 69, 2, '2019-06-03 19:11:13', '2019-06-03 19:11:13'),
(18, 13, 843, 3, '2019-06-03 19:11:23', '2019-06-03 19:11:23'),
(19, 13, 844, 3, '2019-06-03 19:11:31', '2019-06-03 19:12:04'),
(20, 14, 67, 1, '2019-06-03 19:15:35', '2019-06-03 19:15:35'),
(21, 14, 69, 2, '2019-06-03 19:15:43', '2019-06-03 19:15:43'),
(22, 14, 1147, 3, '2019-06-03 19:15:58', '2019-06-03 19:15:58'),
(23, 14, 844, 3, '2019-06-03 19:16:17', '2019-06-03 19:16:17'),
(24, 15, 69, 1, '2019-06-03 19:17:57', '2019-06-03 19:17:57'),
(25, 15, 1142, 2, '2019-06-03 19:18:16', '2019-06-03 19:18:16'),
(26, 15, 844, 2, '2019-06-03 19:18:29', '2019-06-03 19:18:29'),
(27, 16, 63, 1, '2019-06-03 19:58:59', '2019-06-03 19:58:59'),
(28, 16, 69, 2, '2019-06-03 19:59:10', '2019-06-03 19:59:10'),
(29, 16, 1143, 3, '2019-06-03 19:59:23', '2019-06-03 19:59:23'),
(30, 16, 1144, 3, '2019-06-03 19:59:31', '2019-06-03 19:59:31'),
(31, 17, 69, 1, '2019-06-03 20:07:46', '2019-06-03 20:07:46'),
(32, 17, 1141, 2, '2019-06-03 20:07:55', '2019-06-03 20:07:55'),
(33, 17, 1144, 2, '2019-06-03 20:08:06', '2019-06-03 20:08:06'),
(34, 18, 69, 1, '2019-06-03 20:08:55', '2019-06-03 20:08:55'),
(35, 18, 843, 2, '2019-06-03 20:09:07', '2019-06-03 20:09:07'),
(36, 18, 844, 2, '2019-06-03 20:09:17', '2019-06-03 20:09:17'),
(37, 21, 24, 1, '2019-06-08 13:42:12', '2019-07-12 19:39:59'),
(38, 21, 48, 2, '2019-06-08 13:45:30', '2019-06-08 13:45:30'),
(39, 21, 1142, 3, '2019-06-08 13:45:39', '2019-06-08 13:45:39'),
(40, 21, 844, 3, '2019-06-08 13:45:48', '2019-06-08 13:45:48'),
(41, 24, 49, 1, '2019-06-08 13:47:10', '2019-06-08 13:47:10'),
(42, 24, 48, 2, '2019-06-08 13:47:18', '2019-06-08 13:47:18'),
(43, 24, 1146, 3, '2019-06-08 13:47:26', '2019-06-08 13:47:26'),
(44, 24, 1144, 3, '2019-06-08 13:47:34', '2019-06-08 13:47:34'),
(45, 19, 48, 1, '2019-06-08 13:49:15', '2019-06-08 13:49:15'),
(46, 19, 1141, 2, '2019-06-08 13:49:29', '2019-06-08 13:49:29'),
(47, 19, 1144, 2, '2019-06-08 13:49:39', '2019-06-08 13:49:39'),
(48, 22, 48, 1, '2019-06-08 13:51:31', '2019-06-08 13:51:31'),
(49, 22, 843, 2, '2019-06-08 13:51:40', '2019-06-08 13:51:40'),
(50, 22, 844, 2, '2019-06-08 13:51:48', '2019-06-08 13:51:48'),
(51, 26, 50, 1, '2019-06-08 13:53:01', '2019-06-08 14:33:58'),
(52, 26, 48, 2, '2019-06-08 13:53:13', '2019-06-08 13:53:13'),
(53, 26, 1143, 3, '2019-06-08 13:53:26', '2019-06-08 13:53:26'),
(54, 26, 1144, 3, '2019-06-08 13:53:34', '2019-06-08 13:53:34'),
(55, 20, 48, 1, '2019-06-08 13:55:48', '2019-06-08 13:55:48'),
(56, 20, 1142, 2, '2019-06-08 13:55:57', '2019-06-08 13:55:57'),
(57, 20, 844, 2, '2019-06-08 13:56:05', '2019-06-08 13:56:05'),
(58, 25, 49, 1, '2019-06-08 13:57:45', '2019-06-08 13:57:45'),
(59, 25, 48, 2, '2019-06-08 13:57:51', '2019-06-08 13:57:51'),
(60, 25, 1147, 3, '2019-06-08 13:58:00', '2019-06-08 13:58:00'),
(61, 25, 844, 3, '2019-06-08 13:58:07', '2019-06-08 13:58:07'),
(62, 23, 49, 1, '2019-06-08 13:59:04', '2019-06-08 13:59:04'),
(63, 23, 48, 2, '2019-06-08 13:59:11', '2019-06-08 13:59:11'),
(64, 23, 843, 3, '2019-06-08 13:59:20', '2019-06-08 13:59:20'),
(65, 23, 844, 3, '2019-06-08 13:59:27', '2019-06-08 13:59:27'),
(66, 2, 842, 1, '2019-06-10 12:54:42', '2019-06-10 12:54:42'),
(67, 2, 843, 2, '2019-06-10 12:54:52', '2019-06-10 12:54:52'),
(68, 2, 844, 2, '2019-06-10 12:56:18', '2019-06-10 12:56:18'),
(69, 2, 845, 3, '2019-06-10 12:56:26', '2019-06-10 12:56:26'),
(70, 2, 846, 3, '2019-06-10 12:56:35', '2019-06-10 12:56:35'),
(71, 21, 51, 1, '2019-07-12 19:40:10', '2019-07-12 19:40:10'),
(75, 28, 1593, 1, '2021-02-26 02:28:54', '2021-02-26 02:28:54'),
(76, 28, 762, 2, '2022-06-27 20:19:44', '2022-06-27 20:19:44'),
(77, 28, 694, 1, '2022-06-27 20:19:58', '2022-06-27 20:19:58');

-- --------------------------------------------------------

--
-- Table structure for table `access_levels`
--

CREATE TABLE `access_levels` (
  `id` int(10) UNSIGNED NOT NULL,
  `level` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `access_levels`
--

INSERT INTO `access_levels` (`id`, `level`, `created_at`, `updated_at`) VALUES
(1, 5, NULL, '2022-06-27 20:19:30');

-- --------------------------------------------------------

--
-- Table structure for table `bk_customer_histories`
--

CREATE TABLE `bk_customer_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middlename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barangay` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactperson` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpnumber` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emailaddress` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `houseno` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mcity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organization` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialinstruction` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephoneno` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bk_customer_histories`
--

INSERT INTO `bk_customer_histories` (`id`, `firstname`, `lastname`, `middlename`, `barangay`, `contactperson`, `cpnumber`, `emailaddress`, `houseno`, `mcity`, `organization`, `province`, `specialinstruction`, `street`, `telephoneno`, `created_at`, `updated_at`) VALUES
(2, 'steven', 'calimlim', 'fernandez', 'Adams (Pob.)', 'steven', '9283748364', 'calimlim.steven@gmail.com', 'house 2', 'Adams', '1', 'Ilocos Norte', 'intruction', 'street', '09152212673', '2023-01-12 03:05:47', '2023-01-12 03:05:47'),
(3, 'mike', 'goldmaster', 'fernandez', 'Amilongan', NULL, '9374837467', 'calimlim.steven@gmail.com', NULL, 'Alilem', NULL, 'Ilocos Sur', NULL, NULL, NULL, '2023-01-12 07:29:09', '2023-01-12 07:29:09');

-- --------------------------------------------------------

--
-- Table structure for table `bk_customer_infos`
--

CREATE TABLE `bk_customer_infos` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middlename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barangay` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactperson` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpnumber` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emailaddress` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `houseno` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mcity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organization` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialinstruction` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephoneno` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bk_customer_infos`
--

INSERT INTO `bk_customer_infos` (`id`, `firstname`, `lastname`, `middlename`, `barangay`, `contactperson`, `cpnumber`, `emailaddress`, `houseno`, `mcity`, `organization`, `province`, `specialinstruction`, `street`, `telephoneno`, `created_at`, `updated_at`) VALUES
(5, 'steven', 'calimlim', 'fernandez', 'Adams (Pob.)', 'steven', '9283748364', 'calimlim.steven@gmail.com', 'house 2', 'Adams', '1', 'Ilocos Norte', 'intruction', 'street', '09152212673', '2023-01-12 03:05:47', '2023-01-12 03:05:47'),
(6, 'calimlim', 'steven', 'fernandez', 'Adams (Pob.)', 'steven', '9283748364', 'calimlim.steven@gmail.com', 'house 2', 'undefined', 'undefined', 'Ilocos Norte', 'undefined', 'street', '09152212673', '2023-01-12 03:17:57', '2023-01-12 03:17:57'),
(7, 'calimlim', 'steven', 'fernandez', '[object Object]', 'steven', '9283748364', 'calimlim.steven@gmail.com', 'house 2', 'undefined', 'undefined', '[object Object]', 'undefined', 'street', '09152212673', '2023-01-12 03:18:11', '2023-01-12 03:18:11'),
(8, 'mike', 'goldmaster', 'fernandez', 'Amilongan', NULL, '9374837467', 'calimlim.steven@gmail.com', NULL, 'Alilem', NULL, 'Ilocos Sur', NULL, NULL, NULL, '2023-01-12 07:29:09', '2023-01-12 07:29:09');

-- --------------------------------------------------------

--
-- Table structure for table `bk_jobs_updates`
--

CREATE TABLE `bk_jobs_updates` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `requestid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bk_jobs_updates`
--

INSERT INTO `bk_jobs_updates` (`id`, `date`, `avatar`, `title`, `subtitle`, `created_at`, `updated_at`, `requestid`, `user`) VALUES
(2, NULL, '/logo.jpg', 'Under Observation', 'test', '2023-01-12 03:14:19', '2023-01-12 03:14:19', 'REF-INSTALLATION-655189', '@Steven');

-- --------------------------------------------------------

--
-- Table structure for table `bk_requests`
--

CREATE TABLE `bk_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `requestid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requesttype` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customerid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unitid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additionalrequest1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additionalrequest2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialinstruction` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(233) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identify` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bookby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locandorg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organizationname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surveyloc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `callid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `installer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `installationdate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bk_requests`
--

INSERT INTO `bk_requests` (`id`, `requestid`, `requesttype`, `customerid`, `branch`, `userid`, `unitid`, `attachment`, `additionalrequest1`, `additionalrequest2`, `specialinstruction`, `created_at`, `updated_at`, `status`, `identify`, `bookby`, `locandorg`, `organizationname`, `surveyloc`, `callid`, `installer`, `installationdate`) VALUES
(2, 'REF-INSTALLATION-655189', 'INSTALLATION', '5', '5', '1607', '2f31e6be8e25ff4cf2b6eb0a45c434e6', 'BookingSystemAttachments/drbQss4XoG5Vyfx4DECsZjUyY7lZSULVntzB9Q5C.png', NULL, NULL, 'intruction', '2023-01-12 03:05:47', '2023-01-12 03:30:09', '1', 'INSTALLATION/5/1607', 'enter your complete name', NULL, 'organization', 'undefined', '432423', NULL, NULL),
(3, 'REF-INSTALLATION-799805', 'INSTALLATION', '6', '5', '1607', '9f21185bcab5e8a8228979e958ea6b66', '', 'undefined', 'undefined', 'undefined', '2023-01-12 03:17:57', '2023-01-12 03:17:57', '5', 'INSTALLATION/5/1607', 'undefined', 'undefined', 'undefined', 'undefined', NULL, NULL, NULL),
(4, 'REF-INSTALLATION-229229', 'INSTALLATION', '7', '5', '1607', 'ee9d7e074fe31b6811747a58cbd0781c', '', 'undefined', 'undefined', 'undefined', '2023-01-12 03:18:11', '2023-01-12 03:18:11', '0', 'INSTALLATION/5/1607', 'undefined', 'undefined', 'undefined', 'undefined', NULL, NULL, NULL),
(5, 'REF-REPAIR-151940', 'REPAIR', '8', '5', '1609', '7923feb9101058daf0fc575be88b5c7d', '', NULL, NULL, NULL, '2023-01-12 07:29:09', '2023-01-12 07:29:09', '0', 'REPAIR/5/1609', NULL, NULL, 'undefined', 'undefined', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bk_scalates`
--

CREATE TABLE `bk_scalates` (
  `id` int(10) UNSIGNED NOT NULL,
  `customername` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categories` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requestid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bk_scalates`
--

INSERT INTO `bk_scalates` (`id`, `customername`, `categories`, `status`, `branch`, `requestid`, `created_at`, `updated_at`) VALUES
(1, 'STEVEN', 'TEST', '1', '4', '4324', '2023-01-12 04:12:27', '2023-01-12 04:12:27');

-- --------------------------------------------------------

--
-- Table structure for table `bk_scalate_updates`
--

CREATE TABLE `bk_scalate_updates` (
  `id` int(10) UNSIGNED NOT NULL,
  `scalate_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `threads` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bk_units`
--

CREATE TABLE `bk_units` (
  `id` int(10) UNSIGNED NOT NULL,
  `appliancetype` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datepurchase` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliverydate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `demandreplacement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locationofinstallation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paidamoun` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prodcategories` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `propertytype` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serialno` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unitcondition` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallfinish` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warrantycondition` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `withpowersupply` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unitid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ornumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `problem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bk_units`
--

INSERT INTO `bk_units` (`id`, `appliancetype`, `area`, `brand`, `datepurchase`, `deliverydate`, `demandreplacement`, `level`, `location`, `locationofinstallation`, `model`, `paidamoun`, `priority`, `prodcategories`, `propertytype`, `qty`, `serialno`, `time`, `unitcondition`, `wallfinish`, `warrantycondition`, `withpowersupply`, `created_at`, `updated_at`, `unitid`, `ornumber`, `problem`) VALUES
(2, 'SIDE BY SIDE', '324234', 'PANASONIC', '2023-01-12', '2023-01-12', '', '1st FLOOR', 'OFFICE', 'Adams (Pob.),Adams,Ilocos Norte', '10R-A7413E', '32423', 'HIGH', 'REFRIGERATOR', NULL, '1', '342342343', '01:02', 'REPO', 'RESIDENTIAL', 'WARRANTY', 'YES', '2023-01-12 03:05:47', '2023-01-12 03:05:47', '2f31e6be8e25ff4cf2b6eb0a45c434e6', '234234', NULL),
(3, 'SIDE BY SIDE', '324234', 'PANASONIC', '2023-01-12', '2023-01-12', '', '1st FLOOR', 'OFFICE', 'Adams (Pob.),Adams,Ilocos Norte', '10R-A7413E', '32423', 'HIGH', 'REFRIGERATOR', NULL, '1', '342342343', '01:02', 'REPO', 'RESIDENTIAL', 'WARRANTY', 'YES', '2023-01-12 03:05:47', '2023-01-12 03:05:47', '2f31e6be8e25ff4cf2b6eb0a45c434e6', '234234', NULL),
(4, 'SIDE BY SIDE', '2322', 'PANASONIC', '2023-01-12', '', '', '2nd FLOOR', 'HOME', 'Adams (Pob.),undefined,Ilocos Norte', '10R-A7413E', '', '', 'REFRIGERATOR', NULL, '1', '', ':', 'BRAND NEW', 'RESIDENTIAL', 'OUT WARRANTY', 'YES', '2023-01-12 03:17:57', '2023-01-12 03:17:57', '9f21185bcab5e8a8228979e958ea6b66', '', NULL),
(5, 'SIDE BY SIDE', '2322', 'PANASONIC', '2023-01-12', '', '', '2nd FLOOR', 'HOME', 'Adams (Pob.),undefined,Ilocos Norte', '10R-A7413E', '', '', 'REFRIGERATOR', NULL, '1', '', ':', 'BRAND NEW', 'RESIDENTIAL', 'OUT WARRANTY', 'YES', '2023-01-12 03:17:57', '2023-01-12 03:17:57', '9f21185bcab5e8a8228979e958ea6b66', '', NULL),
(6, 'SIDE BY SIDE', '2322', 'PANASONIC', '2023-01-12', '', '', '2nd FLOOR', 'HOME', 'Adams (Pob.),undefined,Ilocos Norte', '10R-A7413E', '', '', 'REFRIGERATOR', NULL, '1', '', ':', 'BRAND NEW', 'RESIDENTIAL', 'OUT WARRANTY', 'YES', '2023-01-12 03:17:57', '2023-01-12 03:17:57', '9f21185bcab5e8a8228979e958ea6b66', '', NULL),
(7, 'SIDE BY SIDE', '2322', 'PANASONIC', '2023-01-12', '', '', '2nd FLOOR', 'HOME', 'Adams (Pob.),undefined,Ilocos Norte', '10R-A7413E', '', '', 'REFRIGERATOR', NULL, '1', '', ':', 'BRAND NEW', NULL, 'OUT WARRANTY', 'RESIDENTIAL', '2023-01-12 03:18:11', '2023-01-12 03:18:11', 'ee9d7e074fe31b6811747a58cbd0781c', NULL, NULL),
(8, 'SIDE BY SIDE', '2322', 'PANASONIC', '2023-01-12', '', '', '2nd FLOOR', 'HOME', 'Adams (Pob.),undefined,Ilocos Norte', '10R-A7413E', '', '', 'REFRIGERATOR', NULL, '1', '', ':', 'BRAND NEW', NULL, 'OUT WARRANTY', 'RESIDENTIAL', '2023-01-12 03:18:11', '2023-01-12 03:18:11', 'ee9d7e074fe31b6811747a58cbd0781c', NULL, NULL),
(9, 'SIDE BY SIDE', '2322', 'PANASONIC', '2023-01-12', '', '', '2nd FLOOR', 'HOME', 'Adams (Pob.),undefined,Ilocos Norte', '10R-A7413E', '', '', 'REFRIGERATOR', NULL, '1', '', ':', 'BRAND NEW', NULL, 'OUT WARRANTY', 'RESIDENTIAL', '2023-01-12 03:18:11', '2023-01-12 03:18:11', 'ee9d7e074fe31b6811747a58cbd0781c', NULL, NULL),
(10, 'N/A', NULL, 'WHIRLPOOL', '2023-01-12', NULL, '', NULL, NULL, 'Amilongan,Alilem,Ilocos Sur', '4LSC9255DZ1', NULL, 'MEDIUM', 'WASHING MACHINE', NULL, '', '234234234', ':', 'BRAND NEW', NULL, 'OUT WARRANTY', NULL, '2023-01-12 07:29:09', '2023-01-12 07:29:09', '7923feb9101058daf0fc575be88b5c7d', NULL, 'NOT WASHING');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `sapcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id` int(10) UNSIGNED NOT NULL,
  `machine_number` int(11) DEFAULT NULL,
  `bsched_id` int(11) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whscode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bm_oic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `companies` int(22) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sap_segment` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seriesname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`sapcode`, `id`, `machine_number`, `bsched_id`, `region_id`, `name`, `whscode`, `bm_oic`, `companies`, `created_at`, `updated_at`, `sap_segment`, `seriesname`) VALUES
('ADMI-PN', 1, 103, 1, 2, 'Admin', 'ADMN,ADM2,ANON', 'Mariel Quitaleg', NULL, NULL, '2020-11-23 21:10:28', '001', 'ADMIN'),
('AGOO-LU', 2, 141, 1, 3, 'Agoo', 'AGOO', 'Albert Quilondrino', 4, NULL, '2020-06-19 15:22:31', '034', 'AGOO'),
('ALAM-PN', 3, 108, NULL, 1, 'Alaminos', 'ALAM', 'Richard Mariano', 3, NULL, '2020-06-29 12:33:51', '032', 'ALAMINOS'),
('APAL-PM', 4, 114, 0, 1, 'Apalit', 'APLT', 'Donard Dale Tabinas', 8, NULL, '2018-10-21 18:25:05', '042', 'APALIT'),
('APPL-PN', 5, 148, 0, 2, 'Appletronics Main Office', 'APPL2', 'Arnel Salagubang', 1, NULL, '2019-10-30 19:27:17', '059', 'APPL'),
(NULL, 6, 999, 0, 2, 'Appletronics Santiago', 'APLS', 'John Doe', NULL, NULL, '2019-10-30 19:27:41', '059', 'APPL'),
('BAGU-BN', 7, 115, 0, 3, 'Baguio', 'BAGU', 'Elenita Parazo', 4, NULL, '2018-10-21 18:25:56', '013', 'BAGUIO'),
('BALA-BT', 8, 144, 0, 1, 'Balanga', 'BALA', 'Christian Paul', 9, NULL, '2018-10-21 18:26:08', '051', 'BALANGA'),
('BALI-BL', 9, 137, 0, 1, 'Baliuag', 'BALI', 'Philip Baylon', 8, NULL, '2018-10-21 18:26:18', '044', 'BALIUAG'),
('BANT-SR', 10, 116, 0, 3, 'Bantay', 'BANT', 'Etelyn Tagayuna', 6, NULL, '2018-10-21 18:29:45', '016', 'BANTAY'),
('BATA-NR', 11, 117, 0, 3, 'Batac', 'BATC', 'Mark Leo Rabbon', 5, NULL, '2018-10-21 18:29:59', '028', 'BATAC'),
('BAYA-PN', 12, 109, NULL, 1, 'Bayambang', 'BAYA', 'Fedema Rivera', 3, NULL, '2020-06-29 12:34:23', '033', 'BAYAMBAN'),
('CAMI-TR', 13, 118, 0, 1, 'Camiling', 'CMLG', 'Ma. Catherine Valdez', 10, NULL, '2018-10-21 18:30:23', '024', 'CAMILING'),
('CAND-SR', 14, 119, 0, 3, 'Candon', 'CAND', 'Leo Baliton', 4, NULL, '2018-10-21 18:30:35', '014', 'CANDON'),
('CAPA-TR', 15, 120, 0, 1, 'Capas', 'CAPA', 'Alma Joy Casoy', 10, NULL, '2018-10-21 18:30:44', '029', 'CAPAS'),
('CAUA-IA', 16, 121, 0, 2, 'Cauayan', 'CAUA', 'Michael Iris Grande', 7, NULL, '2018-10-21 18:30:54', '040', 'CAUAYAN'),
('DAGU-PN', 17, 112, 0, 3, 'Dagupan', 'DAGU', 'Rhodora Pedro', 3, NULL, '2018-10-21 18:31:05', '006', 'DAGUPAN'),
('IBAZ-ZM', 18, 143, 0, 1, 'Iba', 'IBAZ', 'Armando Jr. Ochua', 9, NULL, '2018-10-21 18:31:14', '050', 'IBA'),
('ILAG-IA', 19, 145, NULL, 2, 'Ilagan', 'ILAG', 'Kevin Jasper Magno', 5, NULL, '2021-01-07 15:15:19', '052', 'ILAG'),
('LAOA-NR', 20, 122, 0, 3, 'Laoag', 'LAOA', 'Osborne Dela Cruz', 5, NULL, '2018-10-21 18:31:26', '015', 'LAOAG'),
('MABA-PM', 21, 123, 0, 1, 'Mabalacat', 'MABA,MABI', 'Regina Rabang', 8, NULL, '2019-09-05 17:04:21', '031', 'BALA'),
('MANA-PN', 22, 111, 0, 3, 'Manaoag', 'MANA', 'Caroline Operaña', 3, NULL, '2018-10-21 18:31:47', '008', 'MANAOAG'),
('MANG-PN', 23, 110, 0, 3, 'Mangaldan', 'MANG', 'Roselida Manaois', 3, NULL, '2018-10-21 18:31:57', '007', 'MANGALDN'),
('MONC-TR', 24, 124, 0, 1, 'Moncada', 'MONC', 'Marilou Mauricio', 10, NULL, '2018-10-21 18:32:11', '019', 'MONCADA'),
('NAGU-LU', 25, 136, 0, 3, 'Naguilian', 'NAGU', 'Lanilyn Edna Florendo', 4, NULL, '2018-10-21 18:32:23', '012', 'NAGU'),
('NANC-PN', 26, 105, 0, 2, 'Nancayasan', 'NANC', 'Rhodora Cancino', 1, NULL, '2018-10-21 18:32:37', '027', 'NANC'),
(NULL, 27, 155, 0, 2, 'Appletronics-Addessa', 'APPL', 'Arnel Salagubang', 1, NULL, '2019-10-30 19:28:48', '059', 'APPL'),
('PANI-TR', 28, 125, 0, 1, 'Paniqui', 'PANI', 'Leslie Soliman', 10, NULL, '2018-10-21 18:32:48', '017', 'PANIQUI'),
('POZO-PN', 29, 126, 0, 3, 'Pozorrubio', 'POZO', 'Lowella Perez', 1, NULL, '2018-10-21 18:32:58', '009', 'PZRRUBIO'),
('ROSA-PN', 30, 107, 0, 2, 'Rosales', 'ROSS', 'Imelda Mones', 1, NULL, '2018-10-21 18:33:10', '004', 'ROSALES'),
('ROSA-LU', 31, 127, 0, 3, 'Rosario', 'ROSO', 'Ailen Jucar', 4, NULL, '2018-10-21 18:33:20', '010', 'ROSARIO'),
('ROXA-IA', 32, 140, 0, 2, 'Roxas', 'ROXA', 'Charisse Sales', 7, NULL, '2018-10-21 18:33:30', '048', 'ROXA'),
('SANC-PN', 33, 129, NULL, 1, 'San Carlos', 'SNCA', 'Edward Gallarin', 3, NULL, '2020-06-29 12:35:52', '043', 'SNCARLOS'),
('SANF-LU', 34, 128, 0, 3, 'San Fernando', 'SFLU', 'Clarisa Ugma', 4, NULL, '2018-10-21 18:33:56', '011', 'SANFRNDO'),
('SANJ-NE', 35, 130, 0, 2, 'San Jose', 'SNJO,EASY', 'Rose Marie Espiritu', 7, NULL, '2021-11-10 21:39:05', '002', 'SNJO'),
('SANC-CG', 36, 142, 0, 2, 'Sanchez Mira', 'SANC', 'Manolito Bonifacio Leonador', 5, NULL, '2018-10-21 18:34:21', '049', 'SANC'),
('SANT-SR', 37, 134, 0, 3, 'Santa Cruz', 'STCR', 'Irene Lolie Abajo', 4, NULL, '2018-10-21 18:34:33', NULL, 'MANGATAR'),
('STAM-BL', 38, 149, 0, 1, 'Santa Maria', 'STAM', 'Frankie Viernes', 8, NULL, '2018-10-21 18:34:47', NULL, 'MARI'),
('SANT-IA', 39, 131, 0, 2, 'Santiago', 'STGO', 'Dikela Managad', 7, NULL, '2018-10-21 18:34:59', '041', 'SANTIAGO'),
('SIND-PM', 40, 132, 0, 1, 'Sindalan', 'SIND', 'Frederick Taylan', 9, NULL, '2018-10-21 18:35:09', '035', 'SINDALAN'),
('SOLA-NV', 41, 135, 0, 2, 'Solano', 'SOLA', 'Josen Bautista', 7, NULL, '2018-10-21 18:35:21', '046', 'SOLANO'),
('TARL-TR', 42, 133, 0, 1, 'Tarlac', 'TARL', 'Raquel Sarguet', 10, NULL, '2018-10-21 18:35:32', '018', 'TARLAC'),
('TAYU-PN', 43, 113, 0, 2, 'Tayug', 'TAYU', 'Rose Ann Bugarin', 1, NULL, '2018-10-21 18:35:44', '005', 'TAYUG'),
('TUGU-CG', 44, 139, 0, 2, 'Tuguegarao', 'TUGU', 'Charince Parajas', 5, NULL, '2018-10-21 18:35:54', '047', 'TUGU'),
('TUMA-IA', 45, 147, 0, 2, 'Tumauini', 'TUMA', 'Marcelino Lazo Jr.', 5, NULL, '2018-10-23 10:27:59', '054', 'TUMAUINI'),
('UMIN-PN', 46, 138, 0, 2, 'Umingan', 'UMIN', 'Mary Ann Tolentino', 1, NULL, '2018-10-21 18:37:07', '037', 'UMINGAN'),
('URDA-PN', 47, 104, 0, 2, 'Urdaneta', 'URDA,URD2', 'Joan Laulita', 1, NULL, '2019-05-24 17:07:57', '002', 'URDAALEX'),
('VILL-PN', 48, 106, 0, 2, 'Villasis', 'VILL', 'Mariles Dela Cruz', 1, NULL, '2018-10-21 18:37:28', '003', 'VILLASIS'),
('BAMB-NV', 50, 146, NULL, 2, 'Bambang', 'BAMB', 'Verylie Ann Martinez', 7, '2018-10-21 18:29:12', '2018-10-21 18:29:12', '053', 'BAMB'),
('BUNT-CG', 51, 151, 0, 2, 'Buntun', 'BUNT', 'Jessica Amor', 5, '2018-10-31 12:06:43', '2019-07-16 19:10:50', '057', 'BUNT'),
('MAGA-PM', 52, 152, 0, 1, 'Magalang', 'MAGA', 'Mariel Baoanin', 8, '2018-10-31 12:07:53', '2019-07-16 19:13:23', '056', 'MAGA'),
('MALO-BL', 53, 150, 0, 1, 'Malolos', 'MALO', 'Alexander Cunanan', 8, '2018-10-31 12:08:21', '2019-07-16 19:10:35', '062', 'MALO'),
('SUBI-ZM', 54, 153, 0, 1, 'Subic', 'SUBI', 'Mc Jeron Caronongan', 9, '2018-12-14 13:46:07', '2019-07-16 19:11:31', '061', 'SUBI'),
(NULL, 57, NULL, NULL, NULL, 'Main Office', NULL, NULL, NULL, '2019-03-12 19:38:41', '2019-03-12 19:38:41', '001', 'MANGATAR'),
('MANM-PN', 58, 900, NULL, 1, 'Mangatarem', 'MANM', 'Eliseo John Buenaventura', 3, '2019-11-11 18:47:30', '2020-06-29 12:35:25', '063', 'MANGATAR'),
('GAPA-NE', 59, 9999, NULL, 1, 'Gapan', 'GAPA', 'Johnlyn Agpoon', 7, '2020-02-13 14:45:46', '2020-06-29 12:34:51', '064', 'GAPA'),
('PAND-PM', 61, 158, 0, 1, 'Pandan', 'PAND', 'Emerson Villar', 9, '2020-11-05 14:37:35', '2021-02-12 14:55:59', '066', 'PAND'),
('CONC-TR', 62, 157, NULL, 1, 'Concepcion', 'CONC', 'Jesthony Bryan Leysa', 10, '2020-11-05 15:12:04', '2020-11-05 15:12:04', '065', 'CONC'),
('MARI-BT', 63, 581, 0, 1, 'Mariveles', 'MARI', 'Jerome Salivio', 9, '2020-11-26 13:47:13', '2020-11-27 14:22:36', '067', 'MARI'),
('SANF-PN', 65, 3452, 1, 3, 'San Fabian', 'SANF', 'John Doe', 3, '2021-03-25 15:06:40', '2021-03-25 15:06:40', NULL, ''),
('LING-PN', 66, 2345, 0, 2, 'Lingayen', 'LING', 'Nelson G. Serrano', 3, '2021-05-21 18:03:07', '2021-07-02 19:00:53', NULL, 'LING'),
('BINA-PN', 67, 3423, 0, 2, 'Binalonan', 'BINA', 'Danny Quero', 1, '2021-05-31 13:02:35', '2021-07-06 18:05:45', NULL, 'BINALONA'),
('GUIM-NE', 68, 23423, 0, 2, 'Guimba', 'GUIM', 'John Doe', 7, '2021-05-31 13:03:24', '2021-07-06 18:14:08', '003', 'MANGATAR'),
('ZARA-NE', 70, 567, 0, 2, 'Zaragoza', 'ZARA', 'Jeffrey Gorospe Pascual', 7, '2022-03-22 18:20:18', '2022-03-22 18:23:11', '004', ''),
(NULL, 71, 160, 0, 2, 'SUAL', 'SUAL', 'Main Office', NULL, '2022-03-26 15:46:21', '2022-04-25 22:45:40', '001', 'SUAL');

-- --------------------------------------------------------

--
-- Table structure for table `branch_schedules`
--

CREATE TABLE `branch_schedules` (
  `id` int(10) UNSIGNED NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branch_schedules`
--

INSERT INTO `branch_schedules` (`id`, `time_from`, `time_to`, `created_at`, `updated_at`) VALUES
(1, '08:00:00', '17:00:00', '2018-11-10 21:03:55', '2018-11-10 21:03:55'),
(2, '08:30:00', '17:30:00', '2018-11-10 21:04:10', '2018-11-10 21:04:10'),
(3, '09:00:00', '18:00:00', '2018-11-10 21:04:18', '2018-11-10 21:04:18'),
(4, '09:30:00', '18:30:00', '2018-11-10 21:04:33', '2018-11-10 21:04:33'),
(5, '10:00:00', '19:00:00', '2018-11-10 21:04:51', '2018-11-10 21:04:51');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `address`, `contact`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Addessa Corporation', '#43 4/F Galleria Bldg., Alexander Street Poblacion, Urdaneta City, Pangasinan', NULL, NULL, NULL, NULL),
(2, 'Appletronics', 'Nancayasan, Urdaneta City, Pangasinan', NULL, NULL, NULL, NULL),
(3, 'Appliantech Incorporation', '.', NULL, NULL, '2021-08-10 13:43:13', '2021-08-10 13:43:44'),
(4, 'Electroloop Incorporation', '.', NULL, NULL, '2021-08-10 13:45:09', '2021-08-10 13:45:09'),
(5, 'Telegaps Appliance Corporation', '.', NULL, NULL, '2021-08-10 13:45:42', '2021-08-10 13:45:42'),
(6, 'Metro Ilocos Appliancein  Inc.', '.', NULL, NULL, '2021-08-10 13:46:19', '2021-08-10 13:46:19'),
(7, 'Easy to own appliance corp.', '.', NULL, NULL, '2021-08-10 13:46:53', '2021-08-10 13:46:53'),
(8, 'Threathons inc.', '.', NULL, NULL, '2021-08-10 13:47:20', '2021-08-10 13:47:20'),
(9, 'Technoboom Appliances Inc.', '.', NULL, NULL, '2021-08-10 13:47:48', '2021-08-10 13:47:48'),
(10, 'Pan Appliance Corporation', '.', NULL, NULL, '2021-08-10 13:48:06', '2021-08-10 13:48:06');

-- --------------------------------------------------------

--
-- Table structure for table `custom_db`
--

CREATE TABLE `custom_db` (
  `id` int(55) NOT NULL,
  `dbname` varchar(255) DEFAULT NULL,
  `server` varchar(255) DEFAULT NULL,
  `port` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `connection` varchar(255) DEFAULT NULL,
  `entryname` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `custom_db`
--

INSERT INTO `custom_db` (`id`, `dbname`, `server`, `port`, `username`, `password`, `connection`, `entryname`) VALUES
(1, 'ADDESSA_NEWPROD', '192.168.1.248', '1433', 'webportal', '123$qweR', 'sqlsrv', 'b9e46cd90a1288c7fa07e226934c8df1'),
(21, 'TESTEASYOWN', '192.168.1.15', '1433', 'sapprog9', '124$qweR', 'sqlsrv', '6ec2ce98492d5e9898885fe186e50653'),
(22, 'ReportsFinance', '192.168.1.13', '1433', 'sapprog105', '124$qweR', 'sqlsrv', '7279f466b64f2099266553eba43fef48');

-- --------------------------------------------------------

--
-- Table structure for table `database_selections`
--

CREATE TABLE `database_selections` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbname` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `database_selections`
--

INSERT INTO `database_selections` (`id`, `dbname`, `connection`, `created_at`, `updated_at`) VALUES
(5, 'ADDESSA_NEWPROD - 192.168.1.248', 'b9e46cd90a1288c7fa07e226934c8df1', NULL, NULL),
(25, 'TESTEASYOWN - 192.168.1.15', '6ec2ce98492d5e9898885fe186e50653', NULL, NULL),
(26, 'ReportsFinance - 192.168.1.13', '7279f466b64f2099266553eba43fef48', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `division_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `division_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Credit & Collection', '2018-10-21 12:06:28', '2020-06-19 15:21:02'),
(2, 1, 'Management System Department - MIS', '2018-10-21 12:06:29', '2020-06-19 15:21:02'),
(3, 2, 'Motorpool', '2018-10-21 12:06:30', '2020-06-19 15:21:16'),
(4, 0, 'Executive Officers', '2018-10-21 12:06:30', '2019-06-06 18:56:03'),
(5, 2, 'Marketing', '2018-10-21 12:06:31', '2020-06-19 15:21:16'),
(6, 2, 'Sales', '2018-10-21 12:06:33', '2020-06-19 15:21:16'),
(7, 2, 'Purchasing & Inventory', '2018-10-21 12:06:34', '2020-06-19 15:21:16'),
(8, 1, 'Treasury', '2018-10-21 12:06:34', '2020-06-19 15:21:02'),
(9, 3, 'Payroll', '2018-10-21 12:06:42', '2020-06-19 15:21:29'),
(10, 1, 'Management System', '2018-10-21 12:06:43', '2020-06-19 15:21:02'),
(11, 3, 'Recruitment', '2019-06-03 19:05:25', '2020-06-19 15:21:29'),
(12, 1, 'Trades & Payables', '2019-06-04 12:39:44', '2020-06-19 15:21:02'),
(13, 0, 'Board of Directors', '2019-06-04 12:42:44', '2019-06-04 12:42:44'),
(14, 3, 'Government Compliance', '2019-12-07 20:39:28', '2020-06-19 15:21:29'),
(15, 0, 'Business Development', '2019-12-07 20:40:41', '2020-06-19 13:37:15'),
(16, 0, 'Audit', '2020-10-28 06:40:13', '2020-10-28 06:40:13'),
(17, 0, 'Technical Service', '2022-12-26 08:26:45', '2022-12-26 08:26:45'),
(18, 0, 'Accounting', '2022-12-27 04:38:54', '2022-12-27 04:38:54');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Finance', '2019-06-06 18:53:58', '2019-06-06 18:53:58'),
(2, 'Operations', '2019-06-06 18:54:53', '2019-06-06 18:54:53'),
(3, 'Human Resource', '2019-06-06 18:57:09', '2019-06-06 18:57:09');

-- --------------------------------------------------------

--
-- Table structure for table `file_settings`
--

CREATE TABLE `file_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `email_notif` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_types`
--

CREATE TABLE `file_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(6, '2022_12_13_152028_create_bk_customer_histories_table', 1),
(7, '2022_12_13_152048_create_bk_customer_infos_table', 1),
(8, '2022_12_13_152131_create_bk_units_table', 1),
(9, '2022_12_13_152141_create_bk_requests_table', 1),
(10, '2022_12_15_131700_create_bk_jobs_updates_table', 1),
(11, '2023_01_12_092458_create_bk_scalates_table', 1),
(12, '2023_01_12_164207_create_bk_scalate_updates_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(1, 'App\\User', 3),
(1, 'App\\User', 842),
(1, 'App\\User', 848),
(1, 'App\\User', 870),
(1, 'App\\User', 908),
(1, 'App\\User', 926),
(1, 'App\\User', 930),
(1, 'App\\User', 1016),
(1, 'App\\User', 1091),
(1, 'App\\User', 1221),
(1, 'App\\User', 1389),
(1, 'App\\User', 1560),
(1, 'App\\User', 1607),
(18, 'App\\User', 43),
(18, 'App\\User', 48),
(18, 'App\\User', 49),
(18, 'App\\User', 64),
(18, 'App\\User', 67),
(18, 'App\\User', 69),
(18, 'App\\User', 81),
(18, 'App\\User', 105),
(18, 'App\\User', 107),
(18, 'App\\User', 127),
(18, 'App\\User', 130),
(18, 'App\\User', 131),
(18, 'App\\User', 147),
(18, 'App\\User', 148),
(18, 'App\\User', 168),
(18, 'App\\User', 173),
(18, 'App\\User', 174),
(18, 'App\\User', 176),
(18, 'App\\User', 181),
(18, 'App\\User', 190),
(18, 'App\\User', 194),
(18, 'App\\User', 218),
(18, 'App\\User', 220),
(18, 'App\\User', 224),
(18, 'App\\User', 243),
(18, 'App\\User', 244),
(18, 'App\\User', 248),
(18, 'App\\User', 258),
(18, 'App\\User', 260),
(18, 'App\\User', 282),
(18, 'App\\User', 283),
(18, 'App\\User', 309),
(18, 'App\\User', 311),
(18, 'App\\User', 332),
(18, 'App\\User', 335),
(18, 'App\\User', 350),
(18, 'App\\User', 352),
(18, 'App\\User', 370),
(18, 'App\\User', 375),
(18, 'App\\User', 385),
(18, 'App\\User', 388),
(18, 'App\\User', 401),
(18, 'App\\User', 403),
(18, 'App\\User', 427),
(18, 'App\\User', 429),
(18, 'App\\User', 443),
(18, 'App\\User', 444),
(18, 'App\\User', 462),
(18, 'App\\User', 463),
(18, 'App\\User', 488),
(18, 'App\\User', 489),
(18, 'App\\User', 490),
(18, 'App\\User', 506),
(18, 'App\\User', 508),
(18, 'App\\User', 522),
(18, 'App\\User', 527),
(18, 'App\\User', 549),
(18, 'App\\User', 553),
(18, 'App\\User', 573),
(18, 'App\\User', 575),
(18, 'App\\User', 590),
(18, 'App\\User', 592),
(18, 'App\\User', 609),
(18, 'App\\User', 610),
(18, 'App\\User', 629),
(18, 'App\\User', 630),
(18, 'App\\User', 653),
(18, 'App\\User', 656),
(18, 'App\\User', 665),
(18, 'App\\User', 666),
(18, 'App\\User', 683),
(18, 'App\\User', 685),
(18, 'App\\User', 691),
(18, 'App\\User', 692),
(18, 'App\\User', 694),
(18, 'App\\User', 707),
(18, 'App\\User', 711),
(18, 'App\\User', 712),
(18, 'App\\User', 726),
(18, 'App\\User', 728),
(18, 'App\\User', 738),
(18, 'App\\User', 741),
(18, 'App\\User', 744),
(18, 'App\\User', 745),
(18, 'App\\User', 747),
(18, 'App\\User', 758),
(18, 'App\\User', 759),
(18, 'App\\User', 774),
(18, 'App\\User', 775),
(18, 'App\\User', 789),
(18, 'App\\User', 790),
(18, 'App\\User', 806),
(18, 'App\\User', 807),
(18, 'App\\User', 817),
(18, 'App\\User', 818),
(18, 'App\\User', 820),
(18, 'App\\User', 822),
(18, 'App\\User', 824),
(18, 'App\\User', 836),
(18, 'App\\User', 837),
(18, 'App\\User', 838),
(18, 'App\\User', 845),
(18, 'App\\User', 867),
(18, 'App\\User', 868),
(18, 'App\\User', 871),
(18, 'App\\User', 872),
(18, 'App\\User', 886),
(18, 'App\\User', 897),
(18, 'App\\User', 1061),
(18, 'App\\User', 1389),
(18, 'App\\User', 1607),
(19, 'App\\User', 842),
(19, 'App\\User', 908),
(19, 'App\\User', 926),
(19, 'App\\User', 1221),
(19, 'App\\User', 1389),
(19, 'App\\User', 1607),
(19, 'App\\User', 1609),
(27, 'App\\User', 3),
(27, 'App\\User', 1091),
(27, 'App\\User', 1607),
(27, 'App\\User', 1609),
(51, 'App\\User', 1607),
(61, 'App\\User', 1607),
(61, 'App\\User', 1609),
(77, 'App\\User', 844),
(77, 'App\\User', 1371),
(77, 'App\\User', 1606),
(77, 'App\\User', 1607),
(82, 'App\\User', 1606),
(82, 'App\\User', 1607),
(83, 'App\\User', 1607),
(83, 'App\\User', 1609),
(83, 'App\\User', 1611),
(83, 'App\\User', 1612),
(83, 'App\\User', 1613),
(83, 'App\\User', 1614),
(83, 'App\\User', 1615),
(84, 'App\\User', 1610),
(85, 'App\\User', 1612),
(88, 'App\\User', 1607),
(88, 'App\\User', 1609);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Administer roles & permissions', 'web', NULL, NULL),
(2, 'Show Users', 'web', NULL, NULL),
(3, 'Create Users', 'web', NULL, NULL),
(4, 'Edit Users', 'web', NULL, NULL),
(5, 'Delete Users', 'web', NULL, NULL),
(70, 'Access Pending Charts', 'web', NULL, NULL),
(79, 'Show Employees', 'web', NULL, NULL),
(80, 'Edit Employees', 'web', NULL, NULL),
(82, 'Edit User Employments', 'web', NULL, NULL),
(83, 'Show User Authorizations', 'web', NULL, NULL),
(84, 'Edit User Authorizations', 'web', NULL, NULL),
(101, 'Show Branches', 'web', NULL, NULL),
(102, 'Create Branches', 'web', NULL, NULL),
(103, 'Edit Branches', 'web', NULL, NULL),
(104, 'Delete Branches', 'web', NULL, NULL),
(105, 'Show Branch Schedules', 'web', NULL, NULL),
(106, 'Create Branch Schedules', 'web', NULL, NULL),
(107, 'Edit Branch Schedules', 'web', NULL, NULL),
(108, 'Delete Branch Schedules', 'web', NULL, NULL),
(109, 'Show Regions', 'web', NULL, NULL),
(110, 'Create Regions', 'web', NULL, NULL),
(111, 'Edit Regions', 'web', NULL, NULL),
(112, 'Delete Regions', 'web', NULL, NULL),
(113, 'Show Departments', 'web', NULL, NULL),
(114, 'Create Departments', 'web', NULL, NULL),
(115, 'Edit Departments', 'web', NULL, NULL),
(116, 'Delete Departments', 'web', NULL, NULL),
(117, 'Show Positions', 'web', NULL, NULL),
(118, 'Create Positions', 'web', NULL, NULL),
(119, 'Edit Positions', 'web', NULL, NULL),
(120, 'Delete Positions', 'web', NULL, NULL),
(121, 'Show Access Charts', 'web', NULL, NULL),
(122, 'Create Access Charts', 'web', NULL, NULL),
(123, 'Edit Access Charts', 'web', NULL, NULL),
(124, 'Delete Access Charts', 'web', NULL, NULL),
(125, 'Show Approving Officers', 'web', NULL, NULL),
(126, 'Assign Approving Officers', 'web', NULL, NULL),
(131, 'Show Divisions', 'web', '2019-06-06 18:52:06', '2019-06-06 18:52:06'),
(132, 'Create Divisions', 'web', '2019-06-06 18:52:12', '2019-06-06 18:52:12'),
(133, 'Edit Divisions', 'web', '2019-06-06 18:52:18', '2019-06-06 18:52:18'),
(134, 'Delete Divisions', 'web', '2019-06-06 18:52:23', '2019-06-06 18:52:23'),
(145, 'Show Companies', 'web', NULL, NULL),
(146, 'Create Companies', 'web', NULL, NULL),
(147, 'Edit Companies', 'web', NULL, NULL),
(148, 'Delete Companies', 'web', NULL, NULL),
(174, 'Create Roles', 'web', '2020-06-19 14:56:59', '2020-06-19 14:56:59'),
(175, 'Edit Roles', 'web', '2020-06-19 14:57:08', '2020-06-19 14:57:08'),
(176, 'Delete Roles', 'web', '2020-06-19 14:57:16', '2020-06-19 14:57:16'),
(177, 'Show Roles', 'web', '2020-06-19 14:57:21', '2020-06-19 14:57:21'),
(178, 'Create Permissions', 'web', '2020-06-19 14:57:32', '2020-06-19 14:57:32'),
(179, 'Edit Permissions', 'web', '2020-06-19 14:57:38', '2020-06-19 14:57:38'),
(180, 'Delete Permissions', 'web', '2020-06-19 14:57:44', '2020-06-19 14:57:44'),
(181, 'Show Permissions', 'web', '2020-06-19 14:57:59', '2020-06-19 14:57:59'),
(241, 'SapApiAccess Branch', 'web', '2022-06-25 20:38:08', '2022-06-25 20:39:03'),
(245, 'Admin Access', 'web', '2022-09-04 13:25:25', '2022-09-04 13:25:25'),
(246, 'Create Database', 'web', '2022-09-22 17:08:37', '2022-09-22 17:08:37'),
(247, 'View Database', 'web', '2022-09-22 17:08:45', '2022-09-22 17:08:45'),
(248, 'Update Database', 'web', '2022-09-22 17:08:53', '2022-09-22 17:08:53'),
(249, 'Delete Database', 'web', '2022-09-22 17:09:03', '2022-09-22 17:09:03'),
(250, 'Test Database', 'web', '2022-09-22 17:09:23', '2022-09-22 17:09:23'),
(251, 'Jobs Updates', 'web', '2022-12-24 06:22:03', '2022-12-24 06:22:03'),
(252, 'Booking Restore', 'web', '2022-12-24 06:22:09', '2022-12-24 06:22:09'),
(253, 'Booking Update', 'web', '2022-12-24 06:22:17', '2022-12-24 06:22:17'),
(254, 'Api Control', 'web', '2022-12-24 06:22:26', '2022-12-24 06:22:26'),
(255, 'Approved', 'web', '2022-12-24 06:22:34', '2022-12-24 06:22:34'),
(256, 'Show User Employments', 'web', '2022-12-26 08:20:20', '2022-12-26 08:20:20'),
(257, 'AREA-1', 'web', '2023-01-07 03:24:42', '2023-01-07 03:24:42'),
(258, 'AREA-2', 'web', '2023-01-07 03:24:49', '2023-01-07 03:24:49'),
(259, 'AREA-3', 'web', '2023-01-07 03:24:54', '2023-01-07 03:24:54');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Account Analyst', '2018-10-21 12:06:28', '2018-10-21 12:06:28'),
(2, 'Web Developer', '2018-10-21 12:06:29', '2018-10-21 12:06:29'),
(3, 'Driver', '2018-10-21 12:06:29', '2018-10-21 12:06:29'),
(4, 'Encoder', '2018-10-21 12:06:30', '2018-10-21 12:06:30'),
(5, 'Bookkeeper', '2018-10-21 12:06:30', '2018-10-21 12:06:30'),
(6, 'Helper', '2018-10-21 12:06:31', '2018-10-21 12:06:31'),
(7, 'Technician', '2018-10-21 12:06:33', '2018-10-21 12:06:33'),
(8, 'Sales Support', '2018-10-21 12:06:33', '2018-10-21 12:06:33'),
(9, 'Cashier', '2018-10-21 12:06:34', '2018-10-21 12:06:34'),
(10, 'Assistant Supervisor', '2018-10-21 12:06:35', '2018-10-21 12:06:35'),
(11, 'Warehouseman', '2018-10-21 12:06:41', '2018-10-21 12:06:41'),
(12, 'Supervisor Trainee', '2018-10-21 12:06:41', '2018-10-21 12:06:41'),
(13, 'Supervisor', '2018-10-21 12:06:42', '2018-10-21 12:06:42'),
(14, 'Branch Manager', '2018-10-21 12:06:42', '2018-10-21 12:06:42'),
(15, 'Store Supervisor', '2018-10-21 12:06:47', '2018-10-21 12:06:47'),
(16, 'Assistant BM', '2018-10-21 12:07:17', '2018-10-21 12:07:17'),
(17, 'Helper/Driver', '2018-10-21 12:07:26', '2018-10-21 12:07:26'),
(18, 'Driver/Technician', '2018-10-21 12:08:34', '2018-10-21 12:08:34'),
(19, 'Warehouseman/Technician', '2018-10-21 12:08:53', '2018-10-21 12:08:53'),
(20, 'Technical Support', '2018-12-19 14:41:33', '2018-12-19 14:41:33'),
(21, 'IT Specialist', '2019-01-04 14:48:05', '2019-01-04 14:48:05'),
(22, 'Division Manager', '2019-04-06 18:50:30', '2019-04-06 18:50:30'),
(23, 'Department Manager', '2019-06-03 19:00:22', '2019-06-03 19:00:22'),
(24, 'SAP Programmer', '2019-06-04 12:15:17', '2019-06-04 12:15:17'),
(25, 'Staff', '2019-06-04 12:18:30', '2019-06-04 12:18:30'),
(26, 'President', '2019-06-04 12:42:44', '2019-06-04 12:42:44'),
(27, 'General Manager', '2019-06-08 13:35:37', '2019-06-08 13:35:37'),
(28, 'installer', '2022-12-26 08:21:35', '2022-12-26 08:21:35');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'South Luzon', NULL, NULL),
(2, 'North East Luzon', NULL, NULL),
(3, 'North West Luzon', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', NULL, '2020-06-19 15:02:54'),
(18, 'Employee User', 'web', NULL, NULL),
(19, 'Employee Admin', 'web', NULL, NULL),
(27, 'Authorize Users', 'web', '2019-05-20 12:27:09', '2019-05-20 12:27:09'),
(51, 'Access Chart Admin', 'web', '2020-12-16 10:52:26', '2020-12-16 10:52:26'),
(61, 'Company', 'web', '2021-08-10 13:32:45', '2021-08-10 13:32:45'),
(77, 'SapApiAccess', 'web', '2022-06-25 20:39:53', '2022-06-25 20:39:53'),
(82, 'Database Administrator', 'web', '2022-09-22 17:11:22', '2022-09-22 17:11:22'),
(83, 'Booking Admin User', 'web', '2022-12-24 06:23:18', '2022-12-24 06:23:18'),
(84, 'Booking Branch User', 'web', '2022-12-24 06:23:48', '2022-12-24 06:23:48'),
(85, 'AREA1', 'web', '2023-01-07 03:27:02', '2023-01-07 03:27:02'),
(86, 'AREA2', 'web', '2023-01-07 03:27:11', '2023-01-07 03:27:11'),
(87, 'AREA3', 'web', '2023-01-07 03:27:19', '2023-01-07 03:27:19'),
(88, 'AREASALL', 'web', '2023-01-07 03:28:26', '2023-01-07 03:28:26');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(3, 1),
(4, 1),
(5, 1),
(70, 51),
(79, 19),
(80, 18),
(82, 1),
(83, 1),
(84, 1),
(84, 27),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(121, 51),
(122, 1),
(122, 51),
(123, 1),
(123, 51),
(124, 1),
(124, 51),
(125, 1),
(126, 1),
(131, 1),
(132, 1),
(133, 1),
(134, 1),
(145, 1),
(145, 61),
(146, 1),
(146, 61),
(147, 1),
(147, 61),
(148, 1),
(148, 61),
(174, 1),
(175, 1),
(176, 1),
(177, 1),
(178, 1),
(179, 1),
(180, 1),
(181, 1),
(241, 77),
(246, 82),
(247, 82),
(248, 82),
(249, 82),
(250, 82),
(251, 83),
(251, 84),
(252, 83),
(252, 84),
(253, 83),
(253, 84),
(254, 83),
(254, 84),
(255, 83),
(256, 19),
(257, 85),
(257, 88),
(258, 86),
(258, 88),
(259, 87),
(259, 88);

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `skin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sidebar_collapse` tinyint(1) DEFAULT NULL,
  `sidebar_mini` tinyint(1) DEFAULT NULL,
  `fixed` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `user_id`, `skin`, `sidebar_collapse`, `sidebar_mini`, `fixed`, `created_at`, `updated_at`) VALUES
(1, 3, 'skin-black', 0, 1, 1, '2019-05-11 11:55:14', '2021-04-21 15:47:23'),
(2, 666, 'skin-green', 0, 1, 1, '2019-05-11 12:12:55', '2019-12-12 13:51:44'),
(3, 926, 'skin-blue-light', 0, 1, 1, '2019-05-11 12:38:30', '2019-07-12 13:43:40'),
(4, 818, 'skin-black-light', 0, 1, 1, '2019-05-11 12:45:52', '2019-08-12 13:47:03'),
(5, 993, 'skin-yellow', 0, 1, 1, '2019-05-11 13:02:01', '2019-09-03 16:40:16'),
(6, 508, 'skin-purple', 1, 1, 1, '2019-05-11 13:03:12', '2019-11-22 22:22:08'),
(7, 506, 'skin-green', 0, 1, 1, '2019-05-11 13:04:42', '2019-05-11 13:09:20'),
(8, 863, 'skin-black-light', 0, 1, 1, '2019-05-11 13:06:42', '2019-09-05 12:30:33'),
(9, 553, 'skin-blue', 0, 1, 1, '2019-05-11 13:10:57', '2019-05-12 13:05:28'),
(10, 1091, 'skin-red', 0, 1, 1, '2019-05-11 13:20:13', '2019-05-14 17:37:24'),
(11, 820, 'skin-purple-light', 0, 1, 1, '2019-05-11 13:22:22', '2019-05-11 13:22:22'),
(12, 908, 'skin-green', 0, 1, 1, '2019-05-11 13:24:39', '2019-05-11 13:24:39'),
(13, 654, 'skin-purple', 0, 1, 1, '2019-05-11 13:24:49', '2019-11-28 21:42:06'),
(14, 845, 'skin-yellow', 0, 1, 1, '2019-05-11 13:32:37', '2019-05-11 14:50:22'),
(15, 489, 'skin-blue-light', 0, 1, 1, '2019-05-11 13:44:24', '2019-05-11 20:39:15'),
(16, 539, 'skin-green-light', 0, 1, 1, '2019-05-11 13:51:12', '2019-08-10 13:07:00'),
(17, 490, 'skin-blue', 0, 0, 0, '2019-05-11 14:16:06', '2019-07-27 13:42:08'),
(18, 310, 'skin-purple-light', 0, 1, 1, '2019-05-11 14:17:47', '2019-09-26 17:59:40'),
(19, 769, 'skin-yellow', 0, 1, 1, '2019-05-11 14:41:22', '2019-05-13 15:13:28'),
(20, 633, 'skin-green', 0, 1, 1, '2019-05-11 15:19:29', '2019-09-16 19:01:22'),
(21, 630, 'skin-green', 0, 1, 1, '2019-05-11 15:21:18', '2019-05-11 15:21:18'),
(22, 160, 'skin-blue', 0, 1, 0, '2019-05-11 16:35:32', '2020-01-17 14:22:23'),
(23, 663, 'skin-purple', 0, 1, 1, '2019-05-11 16:52:17', '2019-05-23 12:16:26'),
(24, 864, 'skin-black-light', 0, 1, 1, '2019-05-11 17:23:17', '2019-05-11 17:24:11'),
(25, 1022, 'skin-purple-light', 0, 1, 1, '2019-05-11 18:12:14', '2019-05-14 13:09:34'),
(26, 474, 'skin-blue-light', 0, 1, 1, '2019-05-11 18:39:33', '2019-05-11 18:39:33'),
(27, 439, 'skin-purple', 1, 1, 1, '2019-05-11 19:05:17', '2020-03-09 17:38:56'),
(28, 712, 'skin-red-light', 0, 1, 1, '2019-05-11 19:11:25', '2019-05-11 19:11:25'),
(29, 403, 'skin-purple-light', 0, 1, 1, '2019-05-11 19:54:27', '2020-01-27 13:42:47'),
(30, 702, 'skin-black-light', 0, 1, 1, '2019-05-11 20:27:15', '2020-03-05 14:13:32'),
(31, 393, 'skin-black', 0, 1, 1, '2019-05-11 20:49:12', '2020-02-12 18:10:38'),
(32, 260, 'skin-blue', 0, 1, 1, '2019-05-11 21:41:05', '2019-10-01 19:08:15'),
(33, 683, 'skin-blue', 0, 1, 0, '2019-05-11 22:07:44', '2020-05-29 20:37:54'),
(34, 190, 'skin-black', 0, 1, 1, '2019-05-12 12:27:00', '2020-07-25 11:54:08'),
(35, 101, 'skin-purple', 1, 0, 1, '2019-05-12 13:21:52', '2019-06-02 14:06:07'),
(36, 96, 'skin-green', 1, 1, 1, '2019-05-12 14:52:07', '2019-06-11 13:49:35'),
(37, 917, 'skin-black', 1, 1, 1, '2019-05-12 15:00:31', '2020-06-29 21:05:57'),
(38, 107, 'skin-black-light', 0, 1, 1, '2019-05-12 15:11:51', '2019-05-12 15:11:51'),
(39, 616, 'skin-purple', 0, 1, 1, '2019-05-12 20:32:21', '2020-01-12 17:46:27'),
(40, 114, 'skin-black', 0, 1, 1, '2019-05-12 20:48:45', '2019-05-12 20:48:45'),
(41, 871, 'skin-red', 0, 1, 1, '2019-05-12 21:46:52', '2019-10-04 21:37:09'),
(42, 938, 'skin-green', 0, 1, 1, '2019-05-12 21:52:52', '2019-09-29 21:26:20'),
(43, 610, 'skin-black-light', 0, 1, 1, '2019-05-13 13:02:34', '2019-05-13 13:02:34'),
(44, 937, 'skin-black', 0, 1, 1, '2019-05-13 13:03:19', '2019-06-11 12:13:00'),
(45, 147, 'skin-black-light', 0, 1, 1, '2019-05-13 14:13:09', '2019-05-13 14:13:09'),
(46, 866, 'skin-green', 0, 1, 1, '2019-05-13 15:05:43', '2019-06-06 15:08:50'),
(47, 49, 'skin-green-light', 1, 1, 1, '2019-05-13 17:33:28', '2020-03-07 23:37:15'),
(48, 653, 'skin-yellow', 0, 1, 1, '2019-05-13 20:09:00', '2019-05-13 20:09:00'),
(49, 575, 'skin-purple', 0, 1, 1, '2019-05-13 21:03:24', '2019-05-13 21:04:50'),
(50, 444, 'skin-black', 0, 1, 1, '2019-05-14 14:49:23', '2019-05-14 14:49:23'),
(51, 744, 'skin-purple', 0, 1, 1, '2019-05-14 16:58:47', '2019-07-06 20:34:43'),
(52, 1016, 'skin-black-light', 0, 1, 1, '2019-05-14 18:21:55', '2019-05-14 18:22:30'),
(53, 67, 'skin-blue', 1, 1, 1, '2019-05-14 20:41:02', '2019-10-21 19:58:41'),
(54, 347, 'skin-yellow', 1, 1, 1, '2019-05-14 20:43:35', '2019-05-14 20:54:06'),
(55, 849, 'skin-black', 0, 1, 1, '2019-05-14 20:46:59', '2019-05-14 20:47:41'),
(56, 807, 'skin-blue-light', 0, 1, 1, '2019-05-14 21:49:01', '2019-05-14 21:49:01'),
(57, 800, 'skin-green', 0, 1, 1, '2019-05-14 21:51:33', '2019-05-14 21:54:30'),
(58, 427, 'skin-yellow-light', 0, 1, 1, '2019-05-14 21:57:45', '2019-05-14 21:57:45'),
(59, 691, 'skin-green-light', 0, 1, 1, '2019-05-15 12:56:21', '2020-09-11 21:17:19'),
(60, 26, 'skin-green-light', 0, 1, 1, '2019-05-15 14:24:58', '2020-01-20 22:47:35'),
(61, 668, 'skin-red-light', 0, 1, 1, '2019-05-15 17:09:43', '2020-02-09 16:28:00'),
(62, 759, 'skin-purple', 0, 1, 1, '2019-05-15 21:03:38', '2019-05-15 21:07:25'),
(63, 901, 'skin-red-light', 0, 1, 1, '2019-05-16 13:31:48', '2019-05-16 13:32:19'),
(64, 927, 'skin-blue', 1, 1, 1, '2019-05-16 14:03:27', '2020-03-08 17:01:25'),
(65, 928, 'skin-red', 0, 1, 1, '2019-05-16 14:06:04', '2019-05-16 14:06:39'),
(66, 527, 'skin-green-light', 0, 1, 1, '2019-05-17 13:32:02', '2019-05-24 18:41:31'),
(67, 867, 'skin-purple', 0, 1, 0, '2019-05-17 19:21:37', '2019-05-24 17:37:31'),
(68, 350, 'skin-black-light', 0, 1, 1, '2019-05-18 12:23:21', '2019-05-18 12:23:21'),
(69, 842, 'skin-green', 0, 1, 1, '2019-05-18 16:49:58', '2019-05-18 16:49:58'),
(70, 1061, 'skin-green', 0, 0, 0, '2019-05-18 19:54:03', '2019-09-06 17:00:18'),
(71, 375, 'skin-purple', 0, 1, 1, '2019-05-19 12:58:22', '2019-06-17 17:39:18'),
(72, 503, 'skin-black', 1, 1, 1, '2019-05-19 13:46:14', '2019-07-18 18:25:32'),
(73, 239, 'skin-purple', 0, 1, 1, '2019-05-21 16:06:55', '2019-05-21 16:06:55'),
(74, 930, 'skin-black-light', 0, 1, 1, '2019-05-21 18:32:09', '2019-05-21 18:37:25'),
(75, 388, 'skin-blue', 0, 1, 1, '2019-05-21 21:22:25', '2020-10-01 17:59:48'),
(76, 837, 'skin-green-light', 0, 1, 1, '2019-05-23 17:59:36', '2019-05-23 18:00:07'),
(77, 140, 'skin-purple', 1, 1, 1, '2019-05-24 17:33:32', '2019-07-19 17:41:07'),
(78, 284, 'skin-black-light', 0, 0, 1, '2019-05-24 20:27:25', '2019-05-24 20:27:25'),
(79, 870, 'skin-green', 0, 1, 1, '2019-05-25 18:03:54', '2020-07-17 14:58:49'),
(80, 43, 'skin-purple-light', 0, 1, 1, '2019-05-26 21:02:32', '2019-05-26 21:02:42'),
(81, 592, 'skin-green-light', 0, 1, 1, '2019-05-31 00:08:11', '2019-05-31 00:08:30'),
(82, 753, 'skin-red', 0, 1, 1, '2019-05-31 13:27:49', '2019-08-02 19:32:08'),
(83, 752, 'skin-red', 0, 1, 1, '2019-06-02 13:28:13', '2020-03-01 20:46:12'),
(84, 978, 'skin-black-light', 0, 1, 1, '2019-06-04 17:44:39', '2019-06-04 17:44:39'),
(85, 431, 'skin-black', 0, 1, 1, '2019-06-04 21:10:21', '2019-06-04 21:10:56'),
(86, 738, 'skin-purple-light', 0, 1, 1, '2019-06-05 23:10:09', '2019-06-05 23:10:09'),
(87, 939, 'skin-red', 0, 0, 1, '2019-06-06 13:18:33', '2019-10-08 18:35:42'),
(88, 892, 'skin-blue', 1, 1, 1, '2019-06-06 13:47:06', '2020-02-11 18:55:30'),
(89, 730, 'skin-green', 0, 1, 1, '2019-06-06 21:41:18', '2020-09-07 18:46:10'),
(90, 518, 'skin-purple-light', 0, 1, 1, '2019-06-07 20:33:53', '2019-06-07 20:33:53'),
(91, 745, 'skin-black-light', 0, 1, 1, '2019-06-07 21:04:12', '2019-06-07 21:04:12'),
(92, 419, 'skin-black-light', 0, 1, 1, '2019-06-08 14:22:18', '2019-06-08 14:22:18'),
(93, 335, 'skin-yellow', 0, 1, 1, '2019-06-08 19:49:49', '2020-01-06 20:24:15'),
(94, 916, 'skin-black', 0, 1, 1, '2019-06-11 14:42:40', '2019-06-11 14:42:40'),
(95, 848, 'skin-blue-light', 0, 1, 1, '2019-06-17 12:23:04', '2019-11-23 16:31:26'),
(96, 601, 'skin-blue', 0, 1, 1, '2019-06-29 20:48:57', '2019-08-02 19:22:25'),
(97, 443, 'skin-purple', 0, 0, 1, '2019-07-09 20:49:38', '2020-02-10 15:58:30'),
(98, 721, 'skin-green-light', 0, 1, 1, '2019-07-10 13:24:22', '2019-07-10 13:24:22'),
(99, 862, 'skin-yellow', 0, 1, 1, '2019-07-10 14:45:53', '2019-09-09 15:16:55'),
(100, 130, 'skin-green', 0, 1, 1, '2019-07-11 12:45:04', '2019-07-11 12:45:04'),
(101, 69, 'skin-black-light', 0, 1, 1, '2019-07-11 19:09:19', '2019-07-11 19:09:19'),
(102, 558, 'skin-black-light', 0, 1, 1, '2019-07-11 20:24:17', '2019-07-11 20:24:17'),
(103, 789, 'skin-green-light', 0, 1, 1, '2019-07-14 17:37:30', '2019-07-14 17:37:43'),
(104, 139, 'skin-green', 0, 1, 1, '2019-07-16 13:42:51', '2019-07-22 14:23:32'),
(105, 102, 'skin-black-light', 0, 1, 1, '2019-07-18 13:17:57', '2019-07-18 13:17:57'),
(106, 148, 'skin-blue', 0, 1, 1, '2019-07-24 18:09:40', '2019-07-24 18:09:40'),
(107, 711, 'skin-green', 0, 1, 1, '2019-07-30 15:41:26', '2019-07-30 15:41:26'),
(108, 803, 'skin-blue', 0, 1, 1, '2019-07-30 17:43:45', '2019-07-30 17:43:45'),
(109, 346, 'skin-black-light', 0, 1, 1, '2019-08-05 14:30:02', '2019-08-05 14:30:02'),
(110, 869, 'skin-blue-light', 0, 1, 1, '2019-08-06 16:09:04', '2019-08-06 16:09:27'),
(111, 220, 'skin-blue-light', 0, 1, 1, '2019-08-10 17:14:01', '2019-08-10 17:35:07'),
(112, 992, 'skin-blue-light', 0, 1, 1, '2019-08-22 21:11:49', '2019-09-07 21:58:55'),
(113, 48, 'skin-black-light', 0, 1, 1, '2019-08-30 15:06:54', '2019-08-30 15:06:54'),
(114, 50, 'skin-black-light', 0, 1, 1, '2019-09-02 19:10:26', '2019-09-02 19:10:26'),
(115, 1221, 'skin-red', 0, 1, 1, '2019-09-04 19:08:47', '2019-09-04 20:18:45'),
(116, 931, 'skin-red', 0, 1, 1, '2019-09-05 17:55:33', '2019-09-05 17:55:33'),
(117, 309, 'skin-red', 0, 1, 1, '2019-09-07 12:59:35', '2019-12-26 16:14:26'),
(118, 780, 'skin-green', 0, 1, 1, '2019-09-08 20:04:51', '2019-09-08 20:05:07'),
(119, 747, 'skin-blue-light', 0, 1, 1, '2019-09-14 14:11:19', '2020-08-31 14:07:03'),
(120, 1169, 'skin-purple-light', 0, 1, 1, '2019-09-14 15:11:53', '2020-07-11 16:04:10'),
(121, 71, 'skin-green', 0, 1, 1, '2019-09-16 18:09:19', '2019-09-16 18:09:19'),
(122, 1242, 'skin-blue', 0, 1, 1, '2019-09-30 13:58:28', '2019-09-30 13:58:28'),
(123, 188, 'skin-purple-light', 0, 1, 1, '2019-10-04 12:37:53', '2019-10-04 12:37:53'),
(124, 986, 'skin-black-light', 0, 1, 1, '2019-10-10 12:04:29', '2019-10-10 12:04:29'),
(125, 453, 'skin-black-light', 0, 1, 1, '2019-10-14 14:33:20', '2019-10-14 14:33:20'),
(126, 106, 'skin-blue-light', 0, 1, 1, '2019-10-21 20:35:15', '2019-10-21 20:35:15'),
(127, 582, 'skin-red-light', 0, 1, 1, '2019-10-22 20:48:39', '2019-10-22 20:49:00'),
(128, 282, 'skin-yellow', 0, 1, 1, '2019-11-21 14:43:51', '2019-11-21 14:44:14'),
(129, 386, 'skin-purple', 0, 1, 1, '2019-11-26 14:45:58', '2020-09-08 13:34:34'),
(130, 1217, 'skin-blue', 0, 1, 1, '2019-12-07 14:49:32', '2019-12-07 21:04:45'),
(131, 463, 'skin-blue-light', 0, 1, 1, '2019-12-08 14:12:02', '2020-01-07 14:43:27'),
(132, 194, 'skin-black-light', 0, 1, 1, '2019-12-10 18:58:40', '2019-12-10 18:58:40'),
(133, 689, 'skin-blue-light', 0, 1, 1, '2020-01-15 19:45:55', '2020-09-10 18:19:30'),
(134, 779, 'skin-green-light', 0, 1, 1, '2020-01-17 18:59:21', '2020-06-03 10:53:55'),
(135, 1327, 'skin-red', 0, 1, 1, '2020-01-23 18:30:21', '2020-02-13 13:27:52'),
(136, 61, 'skin-black-light', 0, 1, 1, '2020-01-24 18:46:06', '2020-01-24 18:46:06'),
(137, 1263, 'skin-yellow', 0, 1, 1, '2020-01-27 17:49:05', '2020-01-27 17:49:05'),
(138, 573, 'skin-yellow', 1, 1, 1, '2020-02-02 00:32:51', '2020-08-22 13:12:28'),
(139, 897, 'skin-black-light', 0, 1, 1, '2020-02-10 14:20:52', '2020-02-10 14:20:52'),
(140, 353, 'skin-blue-light', 0, 1, 1, '2020-02-12 16:48:00', '2020-02-12 16:48:00'),
(141, 694, 'skin-black-light', 0, 1, 1, '2020-02-12 16:50:45', '2020-02-12 16:50:45'),
(142, 1275, 'skin-black-light', 0, 1, 1, '2020-02-15 13:34:32', '2020-02-15 13:34:32'),
(143, 174, 'skin-blue', 0, 1, 1, '2020-02-21 15:04:17', '2020-02-21 15:05:13'),
(144, 1111, 'skin-green-light', 0, 1, 1, '2020-02-21 21:14:56', '2020-05-31 20:16:35'),
(145, 682, 'skin-black', 0, 1, 1, '2020-03-04 15:17:44', '2020-03-04 15:17:44'),
(146, 860, 'skin-blue', 0, 1, 1, '2020-03-05 14:25:00', '2020-03-05 14:25:00'),
(147, 1371, 'skin-red', 0, 1, 1, '2020-03-05 21:20:58', '2020-03-05 21:20:58'),
(148, 1376, 'skin-blue', 0, 1, 1, '2020-03-09 18:04:33', '2020-03-09 18:04:33'),
(149, 838, 'skin-black-light', 0, 1, 1, '2020-05-04 14:42:31', '2020-05-04 14:42:31'),
(150, 1247, 'skin-purple', 0, 1, 1, '2020-06-04 19:45:52', '2020-06-04 19:46:44'),
(151, 254, 'skin-black-light', 0, 1, 1, '2020-06-06 17:15:36', '2020-06-06 17:15:36'),
(152, 354, 'skin-purple-light', 0, 1, 1, '2020-06-10 15:46:31', '2020-06-15 16:37:06'),
(153, 7, 'skin-blue-light', 0, 0, 1, '2020-06-11 13:11:20', '2020-06-11 13:17:30'),
(154, 1355, 'skin-green-light', 0, 1, 1, '2020-06-13 15:05:43', '2020-06-13 15:05:43'),
(155, 1392, 'skin-purple', 0, 1, 1, '2020-06-15 18:42:31', '2020-06-15 18:43:32'),
(156, 370, 'skin-black-light', 0, 1, 1, '2020-07-02 19:31:44', '2020-07-02 19:31:44'),
(157, 1387, 'skin-black-light', 0, 1, 1, '2020-07-04 12:25:36', '2020-07-04 12:25:36'),
(158, 1199, 'skin-purple', 0, 1, 1, '2020-07-12 17:34:28', '2020-07-12 17:34:28'),
(159, 1422, 'skin-black-light', 0, 1, 1, '2020-07-28 15:06:48', '2020-07-28 15:06:48'),
(160, 741, 'skin-yellow', 1, 1, 1, '2020-08-01 14:49:03', '2020-08-01 15:15:15'),
(161, 283, 'skin-black-light', 0, 1, 1, '2020-08-28 20:50:56', '2020-08-28 20:50:56'),
(162, 1560, 'skin-yellow', 0, 1, 1, '2020-09-30 14:05:06', '2020-09-30 14:05:35'),
(163, 966, 'skin-black-light', 0, 1, 1, '2020-10-05 22:04:05', '2020-10-05 22:04:05'),
(164, 823, 'skin-green-light', 0, 1, 1, '2020-12-19 06:00:50', '2020-12-19 06:00:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `branch_id` int(10) UNSIGNED DEFAULT 0,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `company_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `extn_email1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extn_email2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extn_email3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sqldb` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `branch_id`, `first_name`, `last_name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `company_id`, `extn_email1`, `extn_email2`, `extn_email3`, `sqldb`) VALUES
(1, 0, 'Stevefox', 'Linux', 'stevefoxlinux@gmail.com', '$2y$10$7Ru.9X5th16DUsAOkZprReVfFJ0TBLzGDNdgWY0OdhDhW6RCqc/pu', 'w817CflFgQbk3lS5Ym8N2vjmZ9sJenW2TY0MkoGliJmm0kQJRbXKxEVtSEJP', NULL, '2020-06-19 14:09:00', 1, NULL, NULL, NULL, 5),
(1607, 5, 'Steven', 'Calimlim', 'steven@appletronics.com', '$2y$10$etIL.ih5Pb9QZ.MkcBDawuQrPna6We3woiVaaRVS2oBuzvZqDNEg6', NULL, '2022-12-07 00:47:33', '2023-01-07 05:47:32', 1, NULL, NULL, NULL, NULL),
(1608, 4, 'Mike', 'Doe', 'mike@appletronics.com', '$2y$10$Fc99rSMEAmDlDyNa0SDoZe0fcPVtxzVpHMuVi5W5JkIZtzqcEIr1C', NULL, '2022-12-17 04:54:50', '2022-12-17 04:54:50', 1, NULL, NULL, NULL, NULL),
(1609, 5, 'Appletronics', 'Main', 'main@appletronics.com', '$2y$10$R8stUNLAKBNCTbxm/Kc/2OHGhifcKl0QuUFr94gnoYeEztqYhYOdW', NULL, '2022-12-17 08:34:03', '2023-01-12 03:43:21', 1, NULL, NULL, NULL, NULL),
(1610, 3, 'Branch', 'Testing', 'branch@appletronics.com', '$2y$10$QYhy.th2XUh5oRBreDLKGOyk.gIfzu92UMUX7H5HtwrFPNUjqpFW6', NULL, '2022-12-17 08:34:57', '2023-01-07 05:28:19', 1, NULL, NULL, NULL, NULL),
(1611, 5, 'Appletronics', 'Technician', 'installer@appletronics.com', '$2y$10$/fwv.NX.hMVQ8vIutD1DceE.np8Er2l2wKM9Wgwwi5S3w3V5Nlr/2', NULL, '2022-12-26 08:25:35', '2022-12-26 08:25:35', 1, NULL, NULL, NULL, NULL),
(1612, 5, 'Call in', '1', 'callin1@appletronics.com', '$2y$10$ZY8Xf5mzfPU8zmKRs4PM1e2GH4PsflKzO4zMyavf3cwmcNpZMT4vO', NULL, '2023-01-06 00:59:55', '2023-01-06 01:02:11', 1, NULL, NULL, NULL, NULL),
(1613, 5, 'Call in', '2', 'callin2@appletronics.com', '$2y$10$l30OBzNbvkOHABeSsc1xRuWL6s5ZDTRIJbUPJ8OCmo2k8r5pFJabm', NULL, '2023-01-06 01:00:39', '2023-01-06 01:01:59', 1, NULL, NULL, NULL, NULL),
(1614, 5, 'Call in', '3', 'callin3@appletronics.com', '$2y$10$HJiKob/pFl8wum18wFYES.vgI2MkHDVWylmkVMczcKcrIK/uPlSSe', NULL, '2023-01-06 01:01:05', '2023-01-06 01:01:51', 1, NULL, NULL, NULL, NULL),
(1615, 5, 'Call in', '4', 'callin4@appletronics.com', '$2y$10$L3SKN8vRxcdLYGMgXOBtU.P1bmUtd4jVXJQexT68aqIf1o8vSyF9G', NULL, '2023-01-06 01:01:39', '2023-01-06 01:01:39', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_customer_maps`
--

CREATE TABLE `user_customer_maps` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_employments`
--

CREATE TABLE `user_employments` (
  `id` int(10) UNSIGNED NOT NULL,
  `sss` int(11) DEFAULT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` int(11) UNSIGNED DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `accesschart_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `payroll` int(11) DEFAULT NULL,
  `time_from` time DEFAULT NULL,
  `time_to` time DEFAULT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_date_reported` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mrf_accesschart_id` int(10) UNSIGNED DEFAULT NULL,
  `po_file_accesschart_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_employments`
--

INSERT INTO `user_employments` (`id`, `sss`, `user_id`, `division_id`, `department_id`, `position_id`, `accesschart_id`, `branch_id`, `payroll`, `time_from`, `time_to`, `remarks`, `last_date_reported`, `created_at`, `updated_at`, `mrf_accesschart_id`, `po_file_accesschart_id`) VALUES
(1605, 2345, '1607', NULL, 2, 2, NULL, 5, 1, NULL, NULL, NULL, NULL, '2022-12-07 00:47:33', '2022-12-07 01:25:53', NULL, NULL),
(1606, NULL, '1608', NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL, '2022-12-17 04:54:50', '2022-12-17 04:54:50', NULL, NULL),
(1607, 323423423, '1609', NULL, 18, 25, NULL, 5, 0, NULL, NULL, NULL, NULL, '2022-12-17 08:34:03', '2022-12-27 04:40:10', NULL, NULL),
(1608, 232323, '1610', NULL, 18, 25, NULL, 3, 0, NULL, NULL, NULL, NULL, '2022-12-17 08:34:57', '2023-01-07 05:28:19', NULL, NULL),
(1609, 342342, '1611', NULL, 17, 7, NULL, 5, 0, NULL, NULL, NULL, NULL, '2022-12-26 08:25:35', '2022-12-26 08:27:10', NULL, NULL),
(1610, 22312, '1612', NULL, 18, 25, NULL, 5, 0, NULL, NULL, NULL, NULL, '2023-01-06 00:59:55', '2023-01-06 01:02:42', NULL, NULL),
(1611, 2134123, '1613', NULL, 18, 25, NULL, 5, 0, NULL, NULL, NULL, NULL, '2023-01-06 01:00:39', '2023-01-06 01:02:56', NULL, NULL),
(1612, 123423, '1614', NULL, 18, 25, NULL, 5, 0, NULL, NULL, NULL, NULL, '2023-01-06 01:01:05', '2023-01-06 01:03:09', NULL, NULL),
(1613, 312312, '1615', NULL, 18, 25, NULL, 5, 1, NULL, NULL, NULL, NULL, '2023-01-06 01:01:39', '2023-01-06 01:03:20', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_charts`
--
ALTER TABLE `access_charts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `access_chart_user_maps`
--
ALTER TABLE `access_chart_user_maps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `access_levels`
--
ALTER TABLE `access_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bk_customer_histories`
--
ALTER TABLE `bk_customer_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bk_customer_infos`
--
ALTER TABLE `bk_customer_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bk_jobs_updates`
--
ALTER TABLE `bk_jobs_updates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bk_requests`
--
ALTER TABLE `bk_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bk_scalates`
--
ALTER TABLE `bk_scalates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bk_scalate_updates`
--
ALTER TABLE `bk_scalate_updates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bk_units`
--
ALTER TABLE `bk_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `branches_name_unique` (`name`);

--
-- Indexes for table `branch_schedules`
--
ALTER TABLE `branch_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `companies_id_index` (`id`);

--
-- Indexes for table `custom_db`
--
ALTER TABLE `custom_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `database_selections`
--
ALTER TABLE `database_selections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_settings`
--
ALTER TABLE `file_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_types`
--
ALTER TABLE `file_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_customer_maps`
--
ALTER TABLE `user_customer_maps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_employments`
--
ALTER TABLE `user_employments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_charts`
--
ALTER TABLE `access_charts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `access_chart_user_maps`
--
ALTER TABLE `access_chart_user_maps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `access_levels`
--
ALTER TABLE `access_levels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bk_customer_histories`
--
ALTER TABLE `bk_customer_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bk_customer_infos`
--
ALTER TABLE `bk_customer_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bk_jobs_updates`
--
ALTER TABLE `bk_jobs_updates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bk_requests`
--
ALTER TABLE `bk_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bk_scalates`
--
ALTER TABLE `bk_scalates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bk_scalate_updates`
--
ALTER TABLE `bk_scalate_updates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bk_units`
--
ALTER TABLE `bk_units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `branch_schedules`
--
ALTER TABLE `branch_schedules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `custom_db`
--
ALTER TABLE `custom_db`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `database_selections`
--
ALTER TABLE `database_selections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `file_settings`
--
ALTER TABLE `file_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_types`
--
ALTER TABLE `file_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1616;

--
-- AUTO_INCREMENT for table `user_customer_maps`
--
ALTER TABLE `user_customer_maps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_employments`
--
ALTER TABLE `user_employments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1614;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
