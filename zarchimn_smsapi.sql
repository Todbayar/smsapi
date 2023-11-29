-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 29, 2023 at 03:46 PM
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
(1, 0, '99213557', 'hello world test msg 1', 1, '7b3ce1fa8947b147c8ea188b99fa66e6', '2023-11-28 14:50:22', '2023-11-29 15:18:25'),
(2, 0, '99213557', 'hello world test msg 2', 1, '7b3ce1fa8947b147c8ea188b99fa66e6', '2023-11-28 15:20:47', '2023-11-29 15:18:33'),
(3, 0, '99213557', 'asd test ыбө', 2, '7b3ce1fa8947b147c8ea188b99fa66e6', '2023-11-28 15:20:54', NULL),
(4, 0, '99213557', 'лорыбөлрыбө ыбө', 2, '7b3ce1fa8947b147c8ea188b99fa66e6', '2023-11-28 15:21:11', NULL),
(5, 0, '99213557', 'йыбйы йбый ыб', 2, '7b3ce1fa8947b147c8ea188b99fa66e6', '2023-11-28 15:21:26', NULL),
(6, 0, '99213557', 'йыб йыб', 2, '7b3ce1fa8947b147c8ea188b99fa66e6', '2023-11-28 15:22:41', NULL),
(7, 0, '99213557', 'asd test 1', 1, '7b3ce1fa8947b147c8ea188b99fa66e6', '2023-11-28 15:23:56', '2023-11-29 15:15:08'),
(8, 0, '99213557', 'ыбө ыбө ыбө', 2, '7b3ce1fa8947b147c8ea188b99fa66e6', '2023-11-28 15:24:00', NULL),
(9, 0, '99213557', 'sadsdf sdf ыбөыбө ыбө', 2, '7b3ce1fa8947b147c8ea188b99fa66e6', '2023-11-28 15:25:16', NULL),
(10, 0, '99213557', 'asdasd', 1, '7b3ce1fa8947b147c8ea188b99fa66e6', '2023-11-28 15:31:27', '2023-11-29 15:15:16'),
(11, 0, '99213557', 'asdasd ыбөыбөыбө', 2, '7b3ce1fa8947b147c8ea188b99fa66e6', '2023-11-28 15:31:31', NULL),
(12, 0, '99213557', 'ыбөыбөыбө ыбөыбөыб asdsdf', 2, '7b3ce1fa8947b147c8ea188b99fa66e6', '2023-11-28 15:32:00', NULL),
(13, 0, '99213557', 'ыбөыбөыбө ыбөыбөыб asdsdf 98798654654', 2, '7b3ce1fa8947b147c8ea188b99fa66e6', '2023-11-28 15:32:09', NULL),
(14, 0, '99213557', 'ыбөыбөыбө ыбөыбөыб 97654654', 2, '7b3ce1fa8947b147c8ea188b99fa66e6', '2023-11-28 15:32:15', NULL),
(15, 0, '99213557', 'asd ыбөыб өыб өыбө', 2, '7b3ce1fa8947b147c8ea188b99fa66e6', '2023-11-28 15:32:59', NULL);

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
(1, 1, NULL, '7b3ce1fa8947b147c8ea188b99fa66e6', 2);

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
(1, 'atodko0513@gmail.com', 'asd', NULL, NULL, '66.181.177.93', '2023-11-28 14:48:00', '2023-11-28 14:48:00', 1);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `apikey`
--
ALTER TABLE `apikey`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `validater`
--
ALTER TABLE `validater`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
