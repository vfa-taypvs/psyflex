-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 05, 2018 at 05:18 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `psyflex`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `updated_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `updated_date`) VALUES
(1, 'psyflex', 'WtA7amOimcTtqJU1NkTd2g==:UzhTY0xTWXE2OVl1UUNrekJoRDdNZz09', '2018-06-17');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `item_id` varchar(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `lang` varchar(5) DEFAULT 'en',
  `questions` varchar(30) DEFAULT NULL COMMENT 'questions ID',
  `test_id` varchar(30) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT 'type = 1: positive; type = 2 : negative; type = 3 : 0',
  `color` varchar(20) DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `other` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `item_id`, `title`, `lang`, `questions`, `test_id`, `type`, `color`, `updated_date`, `other`) VALUES
(424, '1531924573_type1_0', 'New Answer 1 in En', 'en', '1531924573_0', '1531924355', 1, '#6318de', '2018-07-18', NULL),
(425, '1531924573_type1_0', 'New Answer 1 in Fr', 'fr', '1531924573_0', '1531924355', 1, '#6318de', '2018-07-18', NULL),
(426, '1531924573_type1_0', 'New Answer 1 in Vietnamese', 'vi', '1531924573_0', '1531924355', 1, '#6318de', '2018-07-18', NULL),
(427, '1531924573_type2_0', 'New Answer 2 in En', 'en', '1531924573_0', '1531924355', 2, '#ff0a0a', '2018-07-18', NULL),
(428, '1531924573_type2_0', 'New Answer 2 in Fr', 'fr', '1531924573_0', '1531924355', 2, '#ff0a0a', '2018-07-18', NULL),
(429, '1531924573_type2_0', 'New Answer 2 in Vietnamese', 'vi', '1531924573_0', '1531924355', 2, '#ff0a0a', '2018-07-18', NULL),
(430, '1531924573_type3_0', 'Not Sure', 'en', '1531924573_0', '1531924355', 3, '#bdbdbd', '2018-07-18', NULL),
(431, '1531924573_type3_0', 'Not Sure', 'fr', '1531924573_0', '1531924355', 3, '#bdbdbd', '2018-07-18', NULL),
(432, '1531924573_type3_0', 'Not Sure', 'vi', '1531924573_0', '1531924355', 3, '#bdbdbd', '2018-07-18', NULL),
(433, '1531924573_type1_1', 'New Answer 1 in En', 'en', '1531924573_1', '1531924355', 1, '#8731b0', '2018-07-18', NULL),
(434, '1531924573_type1_1', 'New Answer 1 in Fr', 'fr', '1531924573_1', '1531924355', 1, '#8731b0', '2018-07-18', NULL),
(435, '1531924573_type1_1', 'New Answer 1 in Vn', 'vi', '1531924573_1', '1531924355', 1, '#8731b0', '2018-07-18', NULL),
(436, '1531924573_type2_1', 'New Answer 2 in En', 'en', '1531924573_1', '1531924355', 2, '#5c9163', '2018-07-18', NULL),
(437, '1531924573_type2_1', 'New Answer 2 in Fr', 'fr', '1531924573_1', '1531924355', 2, '#5c9163', '2018-07-18', NULL),
(438, '1531924573_type2_1', 'New Answer 2 in Vn', 'vi', '1531924573_1', '1531924355', 2, '#5c9163', '2018-07-18', NULL),
(439, '1531924573_type3_1', 'Not Sure', 'en', '1531924573_1', '1531924355', 3, '#bdbdbd', '2018-07-18', NULL),
(440, '1531924573_type3_1', 'Not Sure', 'fr', '1531924573_1', '1531924355', 3, '#bdbdbd', '2018-07-18', NULL),
(441, '1531924573_type3_1', 'Not Sure', 'vi', '1531924573_1', '1531924355', 3, '#bdbdbd', '2018-07-18', NULL),
(442, '1531924573_type1_2', 'New Answer 1 in En', 'en', '1531924573_2', '1531924355', 1, '#6318de', '2018-07-18', NULL),
(443, '1531924573_type1_2', 'New Answer 1 in Fr', 'fr', '1531924573_2', '1531924355', 1, '#6318de', '2018-07-18', NULL),
(444, '1531924573_type1_2', 'New Answer 1 in Vn', 'vi', '1531924573_2', '1531924355', 1, '#6318de', '2018-07-18', NULL),
(445, '1531924573_type2_2', 'New Answer 2 in En', 'en', '1531924573_2', '1531924355', 2, '#ff0a0a', '2018-07-18', NULL),
(446, '1531924573_type2_2', 'New Answer 2 in Fr', 'fr', '1531924573_2', '1531924355', 2, '#ff0a0a', '2018-07-18', NULL),
(447, '1531924573_type2_2', 'New Answer 2 in Vn', 'vi', '1531924573_2', '1531924355', 2, '#ff0a0a', '2018-07-18', NULL),
(448, '1531924573_type3_2', 'Not Sure', 'en', '1531924573_2', '1531924355', 3, '#bdbdbd', '2018-07-18', NULL),
(449, '1531924573_type3_2', 'Not Sure', 'fr', '1531924573_2', '1531924355', 3, '#bdbdbd', '2018-07-18', NULL),
(450, '1531924573_type3_2', 'Not Sure', 'vi', '1531924573_2', '1531924355', 3, '#bdbdbd', '2018-07-18', NULL),
(451, '1531924573_type1_3', 'New Answer 1 in En', 'en', '1531924573_3', '1531924355', 1, '#8731b0', '2018-07-18', NULL),
(452, '1531924573_type1_3', 'New Answer 1 in Fr', 'fr', '1531924573_3', '1531924355', 1, '#8731b0', '2018-07-18', NULL),
(453, '1531924573_type1_3', 'New Answer 1 in Vn', 'vi', '1531924573_3', '1531924355', 1, '#8731b0', '2018-07-18', NULL),
(454, '1531924573_type2_3', 'New Answer 2 in En', 'en', '1531924573_3', '1531924355', 2, '#5c9163', '2018-07-18', NULL),
(455, '1531924573_type2_3', 'New Answer 2 in Fr', 'fr', '1531924573_3', '1531924355', 2, '#5c9163', '2018-07-18', NULL),
(456, '1531924573_type2_3', 'New Answer 2 in Vn', 'vi', '1531924573_3', '1531924355', 2, '#5c9163', '2018-07-18', NULL),
(457, '1531924573_type3_3', 'Not Sure', 'en', '1531924573_3', '1531924355', 3, '#bdbdbd', '2018-07-18', NULL),
(458, '1531924573_type3_3', 'Not Sure', 'fr', '1531924573_3', '1531924355', 3, '#bdbdbd', '2018-07-18', NULL),
(459, '1531924573_type3_3', 'Not Sure', 'vi', '1531924573_3', '1531924355', 3, '#bdbdbd', '2018-07-18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personals`
--

CREATE TABLE `personals` (
  `id` int(3) NOT NULL,
  `item_id` int(5) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `explanation` varchar(255) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `lang` varchar(5) DEFAULT NULL,
  `updated_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personals`
--

INSERT INTO `personals` (`id`, `item_id`, `name`, `explanation`, `color`, `lang`, `updated_date`) VALUES
(1, 1, 'Concrete', 'Your thinking style is concrete', '#6318de', 'en', '2018-07-28'),
(2, 2, 'Abstract', 'Your thinking style is abstract', '#ff0a0a', 'en', '2018-07-05'),
(3, 3, 'Ambivalent thinking', 'Your thinking style is ambivalent', '#bdbdbd', 'en', '2018-07-05'),
(4, 4, 'Polychronic', 'your behavioral style ispolychronic', '#8731b0', 'en', '2018-07-05'),
(5, 5, 'Monochronic', 'your behavioral style isMonochronic', '#5c9163', 'en', '2018-07-05'),
(6, 6, 'Ambivalent behavior', 'your behavioral style isambivalent', '#bdbdbd', 'en', '2018-07-05'),
(7, 2, 'Abstract Fr', 'Your thinking style is abstract Fr', '#ff0a0a', 'fr', '2018-07-05'),
(8, 2, 'Abstract Vi', 'Your thinking style is abstract Vi', '#ff0a0a', 'vi', '2018-07-05'),
(9, 3, 'Ambivalent thinking Fr', 'Your thinking style is ambivalent Fr', '#bdbdbd', 'fr', '2018-07-05'),
(10, 3, 'Ambivalent thinking Vi', 'Your thinking style is ambivalent Vi', '#bdbdbd', 'vi', '2018-07-05'),
(11, 4, 'Polychronic Fr', 'your behavioral style ispolychronic Fr', '#8731b0', 'fr', '2018-07-05'),
(12, 4, 'Polychronic Vi', 'your behavioral style ispolychronic Vi', '#8731b0', 'vi', '2018-07-05'),
(13, 5, 'Monochronic Fr', 'your behavioral style isMonochronic Fr', '#5c9163', 'fr', '2018-07-05'),
(14, 5, 'Monochronic Vi', 'your behavioral style isMonochronic Vi', '#5c9163', 'vi', '2018-07-05'),
(15, 6, 'Ambivalent behavior Fr', 'your behavioral style isambivalent Fr', '#bdbdbd', 'fr', '2018-07-05'),
(16, 6, 'Ambivalent behavior Vi', 'your behavioral style isambivalent Vi', '#bdbdbd', 'vi', '2018-07-05'),
(17, 1, 'concrete fr', 'Your thinking style is concrete fr', '#6318de', 'fr', '2018-07-28'),
(18, 1, 'concrete vi', 'Your thinking style is concrete vi', '#6318de', 'vi', '2018-07-28');

-- --------------------------------------------------------

--
-- Table structure for table `personals_type`
--

CREATE TABLE `personals_type` (
  `id` int(10) NOT NULL,
  `item_id` int(10) DEFAULT NULL,
  `type_name` varchar(255) DEFAULT NULL,
  `lang` varchar(5) DEFAULT NULL,
  `updated_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personals_type`
--

INSERT INTO `personals_type` (`id`, `item_id`, `type_name`, `lang`, `updated_date`) VALUES
(1, 1, 'type 1', 'en', '2018-08-26'),
(2, 1, 'type 1', 'vi', '2018-08-26'),
(3, 1, 'type 1', 'fr', '2018-08-26');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `item_id` varchar(20) NOT NULL,
  `test_id` int(10) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `lang` varchar(5) DEFAULT 'en',
  `position` int(5) DEFAULT NULL,
  `type` int(11) DEFAULT '1',
  `updated_date` date DEFAULT NULL,
  `delete` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `item_id`, `test_id`, `title`, `lang`, `position`, `type`, `updated_date`, `delete`) VALUES
(142, '1531924573_0', 1531924355, 'You are more engaged when the task is…', 'en', 0, 1, '2018-07-18', 0),
(143, '1531924573_0', 1531924355, 'You are more engaged when the task is…', 'fr', 0, 1, '2018-07-18', 0),
(144, '1531924573_0', 1531924355, 'You are more engaged when the task is…', 'vi', 0, 1, '2018-07-18', 0),
(145, '1531924573_1', 1531924355, 'New Q En 2', 'en', 1, 1, '2018-07-18', 0),
(146, '1531924573_1', 1531924355, 'New Q Fr 2', 'fr', 1, 1, '2018-07-18', 0),
(147, '1531924573_1', 1531924355, 'New Q Vn 2', 'vi', 1, 1, '2018-07-18', 0),
(148, '1531924573_2', 1531924355, 'New Q En 3', 'en', 2, 1, '2018-07-18', 0),
(149, '1531924573_2', 1531924355, 'New Q Fr 3', 'fr', 2, 1, '2018-07-18', 0),
(150, '1531924573_2', 1531924355, 'New Q Vn 3', 'vi', 2, 1, '2018-07-18', 0),
(151, '1531924573_3', 1531924355, 'New Q En 4', 'en', 3, 1, '2018-07-18', 0),
(152, '1531924573_3', 1531924355, 'New Q Fr 4', 'fr', 3, 1, '2018-07-18', 0),
(153, '1531924573_3', 1531924355, 'New Q Vn 4', 'vi', 3, 1, '2018-07-18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `test_id` int(20) DEFAULT NULL,
  `point_1` int(11) DEFAULT NULL,
  `point_2` int(11) DEFAULT NULL,
  `point_3` int(11) DEFAULT NULL,
  `point_4` int(11) DEFAULT NULL,
  `point_5` int(11) DEFAULT NULL,
  `point_6` int(11) DEFAULT NULL,
  `updated_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `user_id`, `user_email`, `test_id`, `point_1`, `point_2`, `point_3`, `point_4`, `point_5`, `point_6`, `updated_date`) VALUES
(21, '6', 'sontay.pham@gmail.com', 1531924355, 20, 0, 0, 12, 0, 0, '2018-07-21'),
(22, '6', 'sontay.pham@gmail.com', 1531924355, 10, -10, 0, 0, -16, 0, '2018-07-21'),
(23, '6', 'sontay.pham@gmail.com', 1531924355, 0, -20, 0, 0, -20, 0, '2018-07-21'),
(24, '6', 'sontay.pham@gmail.com', 1531924355, 10, -10, 0, 6, -3, 0, '2018-07-21'),
(25, '6', 'sontay.pham@gmail.com', 1531924355, 20, 0, 0, 20, 0, 0, '2018-07-21'),
(26, '8', 'sontay.pham@gmail.com', 1531924355, 20, 0, 0, 7, 0, 0, '2018-07-21'),
(27, '8', 'sontay.pham@gmail.com', 1531924355, 11, 0, 0, 0, -16, 0, '2018-07-22'),
(28, '8', 'sontay.pham@gmail.com', 1531924355, 9, 0, 0, 0, -7, 0, '2018-07-22'),
(29, '8', 'sontay.pham@gmail.com', 1531924355, 10, -3, 0, 3, -3, 0, '2018-07-22'),
(30, '8', 'sontay.pham@gmail.com', 1531924355, 7, 0, 0, 9, 0, 0, '2018-07-23'),
(31, '8', 'sontay.pham@gmail.com', 1531924355, 16, 0, 0, 1, -6, 0, '2018-07-23'),
(32, '8', 'sontay.pham@gmail.com', 1531924355, 0, -7, 0, 13, 0, 0, '2018-07-25'),
(33, '8', 'sontay.pham@gmail.com', 1531924355, 13, 0, 0, 16, 0, 0, '2018-07-28'),
(34, '8', 'sontay.pham@gmail.com', 1531924355, 10, -10, 0, 11, 0, 0, '2018-07-28'),
(35, '8', 'sontay.pham@gmail.com', 1531924355, 3, 0, 0, 7, 0, 0, '2018-07-28'),
(36, '8', 'sontay.pham@gmail.com', 1531924355, 6, 0, 0, 6, -10, 0, '2018-07-28'),
(37, '1', 'sontaytest@gmail.com', 1531924355, 13, 0, 0, 10, -3, 0, '2018-07-29'),
(38, '1', 'sontaytest@gmail.com', 1531924355, 13, 0, 0, 0, -4, 0, '2018-07-29'),
(39, '1', 'sontaytest@gmail.com', 1531924355, 3, -10, 0, 16, 0, 0, '2018-07-29'),
(40, '1', 'sontaytest@gmail.com', 1531924355, 16, 0, 0, 6, -3, 0, '2018-07-29'),
(41, '1', 'sontaytest@gmail.com', 1531924355, 10, -6, 0, 16, 0, 0, '2018-07-29'),
(42, '1', 'sontaytest@gmail.com', 1531924355, 16, 0, 0, 10, -6, 0, '2018-07-29'),
(43, '1', 'sontaytest@gmail.com', 1531924355, 16, 0, 0, 10, -6, 0, '2018-07-29'),
(44, '1', 'sontaytest@gmail.com', 1531924355, 10, -6, 0, 6, -3, 0, '2018-07-29'),
(45, '1', 'sontaytest@gmail.com', 1531924355, 6, -6, 0, 3, -3, 0, '2018-07-29'),
(46, '1', 'sontaytest@gmail.com', 1531924355, 6, -3, 0, 13, 0, 0, '2018-07-29'),
(47, '1', 'sontaytest@gmail.com', 1531924355, 16, 0, 0, 3, -6, 0, '2018-07-29'),
(48, '1', 'sontaytest@gmail.com', 1531924355, 20, 0, 0, 12, 0, 0, '2018-07-29'),
(49, '1', 'sontaytest@gmail.com', 1531924355, 16, 0, 0, 3, -10, 0, '2018-07-29'),
(50, '1', 'sontaytest@gmail.com', 1531924355, 3, -10, 0, 10, -3, 0, '2018-07-29'),
(51, '1', 'sontaytest@gmail.com', 1531924355, 10, -1, 0, 9, 0, 0, '2018-07-29'),
(52, '1', 'sontaytest@gmail.com', 1531924355, 6, 0, 0, 6, -6, 0, '2018-07-29'),
(53, '1', 'sontaytest@gmail.com', 1531924355, 16, 0, 0, 0, -9, 0, '2018-07-29'),
(54, '1', 'sontaytest@gmail.com', 1531924355, 6, -10, 0, 10, -6, 0, '2018-07-29'),
(55, '1', 'sontaytest@gmail.com', 1531924355, 12, 0, 0, 0, -16, 0, '2018-07-29');

-- --------------------------------------------------------

--
-- Table structure for table `result_detail`
--

CREATE TABLE `result_detail` (
  `id` int(11) NOT NULL,
  `test_id` varchar(100) DEFAULT NULL,
  `question_id` varchar(100) DEFAULT NULL,
  `result_id` int(11) DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `answer_id` varchar(20) DEFAULT NULL,
  `updated_date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `result_detail`
--

INSERT INTO `result_detail` (`id`, `test_id`, `question_id`, `result_id`, `point`, `user_id`, `answer_id`, `updated_date`) VALUES
(33, '1531924355', '1531924573_0', 55, 6, 1, '1531924573_type1_0', 2018),
(34, '1531924355', '1531924573_1', 55, -6, 1, '1531924573_type2_1', 2018),
(35, '1531924355', '1531924573_2', 55, 6, 1, '1531924573_type1_2', 2018),
(36, '1531924355', '1531924573_3', 55, -10, 1, '1531924573_type2_3', 2018);

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `item_id` varchar(20) COLLATE utf8_german2_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_german2_ci DEFAULT NULL,
  `lang` varchar(5) COLLATE utf8_german2_ci DEFAULT 'en',
  `type` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `delete` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `item_id`, `title`, `lang`, `type`, `position`, `updated_date`, `delete`) VALUES
(7, '1531924355', 'Test En', 'en', 1, 1, '2018-07-18', 0),
(8, '1531924355', 'Test Fr', 'fr', 1, 1, '2018-07-18', 0),
(9, '1531924355', 'Test Vi', 'vi', 1, 1, '2018-07-18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `oauth_provider` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `oauth_uid` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `oauth_provider`, `oauth_uid`, `first_name`, `last_name`, `username`, `picture_url`, `profile_url`, `email`, `password`, `gender`, `locale`, `cover`, `picture`, `link`, `created`, `modified`) VALUES
(1, 'facebook', '1754031428013140', 'Phạm', 'Sơn Tây', NULL, NULL, NULL, 'sontaytest@gmail.com', NULL, '', '', '', '', '', '2018-07-07 15:13:01', '2018-07-29 12:26:34'),
(5, 'twitter', '2477966881', 'Pham', 'Viet', 'taypvs', 'http://abs.twimg.com/sticky/default_profile_images/default_profile_normal.png', 'https://twitter.com/taypvs', '', NULL, NULL, 'en', NULL, NULL, NULL, '2018-07-15 06:01:33', '2018-07-17 17:43:53'),
(6, 'linkedin', 'NlcmB29lFO', 'pham', 'tay', NULL, NULL, 'http://www.linkedin.com/in/pham-tay-9295ab102', 'sontay.pham@gmail.com', NULL, NULL, 'United Kin', NULL, NULL, NULL, '2018-07-15 06:41:10', '2018-07-28 10:05:01'),
(7, 'google', '117239051736479776958', 'pham', 'son tay', NULL, NULL, 'https://lh3.googleusercontent.com/-8UB1PCf3Mjo/AAAAAAAAAAI/AAAAAAAAAjI/Gg9vayw8daw/photo.jpg', 'sontay.pham@gmail.com', NULL, NULL, '', NULL, NULL, NULL, '2018-07-15 17:55:50', '2018-07-18 14:48:05'),
(8, 'psyflex', NULL, 'Son Tay', 'Pham', NULL, NULL, NULL, 'sontay.pham@gmail.com', 'NwXtqvJBLSn9FPuTxnbwPw==:b1RkbWVrd1QzeXlPNjRSWUMwdXlDUT09', NULL, NULL, NULL, NULL, NULL, '2018-07-21 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personals`
--
ALTER TABLE `personals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personals_type`
--
ALTER TABLE `personals_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result_detail`
--
ALTER TABLE `result_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=460;

--
-- AUTO_INCREMENT for table `personals`
--
ALTER TABLE `personals`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personals_type`
--
ALTER TABLE `personals_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `result_detail`
--
ALTER TABLE `result_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
