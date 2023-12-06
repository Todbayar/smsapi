-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 06, 2023 at 03:05 PM
-- Server version: 8.0.35-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zarchimn_smsapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE `action` (
  `id` int NOT NULL,
  `type` int UNSIGNED NOT NULL COMMENT 'sms_text_send-0',
  `phone` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'phone number',
  `msg` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` tinyint UNSIGNED NOT NULL DEFAULT '0' COMMENT '0-unsent, 1-sent, 2-error',
  `token` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `sent` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`id`, `type`, `phone`, `msg`, `state`, `token`, `created`, `sent`) VALUES
(1, 0, '99213557', 'hello world, this works ok', 1, '0b137306cf67793c037149cce9c972e6', '2023-12-05 13:17:13', '2023-12-05 13:18:12'),
(2, 0, '99213557', 'ok, this works fine.', 1, '0b137306cf67793c037149cce9c972e6', '2023-12-05 13:22:24', '2023-12-05 13:22:38'),
(3, 0, '99213557', 'ok works, last check', 1, '0b137306cf67793c037149cce9c972e6', '2023-12-05 13:37:34', '2023-12-05 13:37:47'),
(4, 0, '99213557', 'Nice works', 1, '30bfe519a829a3780aab1853fa5a4915', '2023-12-05 13:54:28', '2023-12-05 13:54:37'),
(5, 0, '99455432', 'Hello', 1, '2e925c81450ce37c3d5ddd0d1b24f8e4', '2023-12-05 14:36:33', '2023-12-05 14:36:50'),
(6, 0, '99213557', 'hello world, this works ok', 1, '0b137306cf67793c037149cce9c972e6', '2023-12-05 15:09:21', '2023-12-05 15:09:31'),
(7, 0, '99213557', 'hello world, this works ok', 1, '0b137306cf67793c037149cce9c972e6', '2023-12-05 15:30:04', '2023-12-05 15:30:21'),
(8, 0, '99213557', 'nice work good job', 1, '0b137306cf67793c037149cce9c972e6', '2023-12-05 15:31:53', '2023-12-05 15:32:09'),
(9, 0, '99213557', 'test msg 2023-12-5 1', 1, '0b137306cf67793c037149cce9c972e6', '2023-12-05 15:34:03', '2023-12-05 15:34:14'),
(10, 0, '99213557', 'test msg 2023-12-5 2', 1, '0b137306cf67793c037149cce9c972e6', '2023-12-05 15:34:13', '2023-12-05 15:34:32'),
(11, 0, '99213557', 'test msg 2023-12-5 3', 1, '0b137306cf67793c037149cce9c972e6', '2023-12-05 15:35:31', '2023-12-05 15:35:40'),
(12, 0, '95525128', 'hello world, mass sms works', 2, '0b137306cf67793c037149cce9c972e6', '2023-12-06 11:54:35', NULL),
(14, 0, '99213557', 'hello world, works ok test drive', 1, '0b137306cf67793c037149cce9c972e6', '2023-12-06 11:57:31', '2023-12-06 11:57:42'),
(15, 0, '95525128', 'ok, works', 2, '0b137306cf67793c037149cce9c972e6', '2023-12-06 11:58:11', NULL),
(16, 0, '95525128', 'test mass msg', 2, '0b137306cf67793c037149cce9c972e6', '2023-12-06 11:59:01', NULL),
(17, 0, '99213557', 'test mass msg', 1, '0b137306cf67793c037149cce9c972e6', '2023-12-06 11:59:01', '2023-12-06 11:59:26'),
(18, 0, '99213557', 'Test ok', 1, '30bfe519a829a3780aab1853fa5a4915', '2023-12-06 12:12:51', '2023-12-06 12:13:08');

-- --------------------------------------------------------

--
-- Table structure for table `apikey`
--

CREATE TABLE `apikey` (
  `id` int UNSIGNED NOT NULL,
  `userID` int UNSIGNED NOT NULL,
  `title` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit` int UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `apikey`
--

INSERT INTO `apikey` (`id`, `userID`, `title`, `token`, `credit`) VALUES
(1, 1, NULL, '0b137306cf67793c037149cce9c972e6', 86),
(2, 2, NULL, '30bfe519a829a3780aab1853fa5a4915', 8),
(3, 3, NULL, '2e925c81450ce37c3d5ddd0d1b24f8e4', 9),
(4, 4, NULL, '14533e5d826b734c061a59c60499ca3a', 10),
(5, 5, NULL, 'd8b7c07dd695a21b9ce49f4352ff617f', 10),
(6, 0, NULL, '9ae18dea06298a9e3da1922f77e19170', 10);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `credit` int UNSIGNED NOT NULL COMMENT 'Үлдсэн нэгж'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastlogged` datetime NOT NULL,
  `signedup` datetime NOT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=active'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `name`, `phone`, `ip`, `lastlogged`, `signedup`, `isactive`) VALUES
(1, 'atodko0513@gmail.com', 'asd', 'Тодбаяр', '99213557', '66.181.177.93', '2023-12-06 14:35:00', '2023-12-05 13:15:00', 0),
(2, 'misheelgamestudio@gmail.com', 'asd', NULL, NULL, '66.181.177.93', '2023-12-05 13:53:00', '2023-12-05 13:53:00', 1),
(3, 'purevbaasankhuu@gmail.com', 'baaskaa2001', 'Баасанхүү', '99455432', '103.50.206.170', '2023-12-05 14:32:00', '2023-12-05 14:32:00', 1),
(4, 'batbuyan@datacom.mn', 'hi}e6Yahth', NULL, NULL, '202.170.65.54', '2023-12-05 14:36:00', '2023-12-05 14:36:00', 0),
(5, 'support@magicnet.mn', 'zee9kae(Th', NULL, NULL, '202.170.65.54', '2023-12-05 14:43:00', '2023-12-05 14:43:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `validater`
--

CREATE TABLE `validater` (
  `id` int UNSIGNED NOT NULL,
  `value` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` int UNSIGNED NOT NULL COMMENT '0=verifies, 1=verifying, 2=verified',
  `type` int UNSIGNED NOT NULL COMMENT 'type 0=email, 1=billing, 2=phone '
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `validater`
--

INSERT INTO `validater` (`id`, `value`, `state`, `type`) VALUES
(4, '4', 0, 0),
(5, '5', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apikey`
--
ALTER TABLE `apikey`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `validater`
--
ALTER TABLE `validater`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action`
--
ALTER TABLE `action`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `apikey`
--
ALTER TABLE `apikey`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `validater`
--
ALTER TABLE `validater`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
