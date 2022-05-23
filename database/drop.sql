-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 23, 2022 at 11:38 AM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drop`
--

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) UNSIGNED NOT NULL,
  `hex` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) UNSIGNED NOT NULL,
  `comment` varchar(255) NOT NULL DEFAULT '',
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `project_id`, `user_id`) VALUES
(1, 'jow', 156, 8),
(2, 'nice', 156, 8),
(3, 'yes', 156, 8),
(4, 'jow', 156, 8),
(5, 'idk', 156, 8),
(6, 'idk', 156, 8),
(7, 'jow', 156, 8),
(8, 'jow', 156, 8),
(9, 'comments', 156, 8),
(10, 'jow', 156, 8),
(11, 'huis', 158, 8),
(12, 'nice', 158, 8),
(13, 'hjiokpl^m', 157, 8),
(14, 'jow', 157, 8),
(15, 'nice bob', 161, 8),
(16, 'dankje robbe', 161, 12);

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(11) UNSIGNED NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `following_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `active`, `following_id`, `follower_id`) VALUES
(2, 1, 9, 8),
(3, 1, 8, 13),
(4, 1, 8, 13);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `project_id`, `user_id`, `status`) VALUES
(380, 157, 8, 1),
(381, 156, 8, 1),
(382, 155, 8, 0),
(383, 154, 8, 1),
(384, 158, 8, 1),
(385, 156, 10, 1),
(386, 157, 10, 1),
(387, 157, 11, 1),
(388, 158, 11, 1),
(389, 0, 11, 1),
(390, 156, 11, 1),
(391, 159, 12, 1),
(392, 158, 12, 1),
(393, 0, 12, 1),
(394, 160, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_temp`
--

CREATE TABLE `password_reset_temp` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `exp_date` varchar(255) NOT NULL DEFAULT '',
  `code` varchar(255) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `password_reset_temp`
--

INSERT INTO `password_reset_temp` (`id`, `user_id`, `exp_date`, `code`, `active`) VALUES
(22, 8, '2022-04-25 13:38:42', '1626688403e527', 0),
(23, 8, '2022-04-26 21:00:48', '16268415ecba12', 1),
(24, 8, '2022-04-26 21:01:42', '162684195a9014', 1),
(25, 8, '2022-04-26 21:02:06', '1626841ad2a8e8', 1),
(26, 8, '2022-04-26 21:02:10', '1626841b147796', 1),
(27, 8, '2022-04-26 21:02:28', '1626841c359b60', 1),
(28, 8, '2022-04-26 21:02:52', '1626841db441ed', 1),
(29, 8, '2022-04-26 21:03:26', '1626841fd9160b', 1),
(30, 8, '2022-05-10 18:00:45', '1627a8c2c44d2f', 1),
(31, 8, '2022-05-10 18:33:24', '1627a93d4221b0', 1),
(32, 8, '2022-05-10 18:34:09', '1627a9400f24cf', 1),
(33, 8, '2022-05-10 18:35:08', '1627a943c211d4', 1),
(34, 8, '2022-05-10 18:37:12', '1627a94b7e4442', 0);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT '',
  `image` varchar(255) DEFAULT '',
  `description` text,
  `posted_at` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `private_views` tinyint(1) DEFAULT NULL,
  `publicId` varchar(255) NOT NULL DEFAULT '',
  `showcase` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `image`, `description`, `posted_at`, `user_id`, `private_views`, `publicId`, `showcase`) VALUES
(154, 'kwetter branding', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1650885984/posts/vwgxwncsaqcsirke4ydw.webp', 'I made this logo for a brand ', '2022-04-25 13:26:27', 8, 0, 'posts/vwgxwncsaqcsirke4ydw', 1),
(155, 'nice buildings', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1651601091/posts/kahktwhdxjclkgs9xqqk.webp', 'efef', '2022-05-03 20:04:52', 8, 0, 'posts/kahktwhdxjclkgs9xqqk', 1),
(157, 'mooie huizen enzo', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1651696077/posts/i15qnav69spnzbuhc19r.webp', 'hallo, hier deel ik mijn mooie huizen', '2022-05-04 22:27:58', 9, 0, 'posts/i15qnav69spnzbuhc19r', 1),
(158, 'ioejfioêjio', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1652197207/posts/oozvfkv5mzkrnvw01oyk.webp', 'eofjapeaf', '2022-05-10 17:40:09', 8, 0, 'posts/oozvfkv5mzkrnvw01oyk', 0),
(159, 'A mystery post', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1652639064/posts/tbd4shjsgz14wlqx4pbx.webp', 'This is a mystery post', '2022-05-15 20:24:26', 11, 0, 'posts/tbd4shjsgz14wlqx4pbx', 1),
(160, 'hubride logo 🚀', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1652641413/posts/jusvyqhzzv4inyu2igoa.webp', 'Logo for my brother', '2022-05-15 21:03:35', 8, 0, 'posts/jusvyqhzzv4inyu2igoa', 0),
(161, 'Podcast cover voor de rechtvaardige rechters', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1652710532/posts/cepnxq5f7axdbsjxikds.webp', 'dit is een beetje uitleg', '2022-05-16 16:15:34', 12, 1, 'posts/cepnxq5f7axdbsjxikds', 1);

-- --------------------------------------------------------

--
-- Table structure for table `project_colors`
--

CREATE TABLE `project_colors` (
  `id` int(11) UNSIGNED NOT NULL,
  `project__id` int(11) NOT NULL,
  `color_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `project_tags`
--

CREATE TABLE `project_tags` (
  `id` int(11) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_tags`
--

INSERT INTO `project_tags` (`id`, `project_id`, `tag_id`) VALUES
(23, 92, 46),
(24, 92, 47),
(25, 92, 61),
(26, 93, 46),
(27, 93, 47),
(28, 93, 61),
(29, 94, 62),
(30, 94, 63),
(31, 94, 64),
(32, 95, 65),
(33, 95, 66),
(34, 95, 67),
(35, 96, 65),
(36, 96, 66),
(37, 96, 67),
(38, 97, 68),
(39, 97, 69),
(40, 98, 68),
(41, 98, 69),
(42, 99, 68),
(43, 99, 69),
(44, 100, 68),
(45, 100, 69),
(46, 101, 68),
(47, 101, 69),
(48, 102, 68),
(49, 102, 69),
(50, 103, 68),
(51, 103, 69),
(52, 104, 68),
(53, 104, 69),
(54, 105, 68),
(55, 105, 69),
(56, 106, 68),
(57, 106, 69),
(58, 107, 68),
(59, 107, 69),
(60, 108, 68),
(61, 108, 69),
(62, 109, 68),
(63, 109, 69),
(64, 110, 68),
(65, 110, 69),
(66, 111, 68),
(67, 111, 69),
(68, 112, 70),
(69, 113, 70),
(70, 114, 70),
(71, 115, 70),
(72, 116, 70),
(73, 117, 71),
(74, 117, 72),
(75, 117, 73),
(76, 118, 70),
(77, 119, 74),
(78, 120, 74),
(79, 121, 75),
(80, 121, 76),
(81, 121, 77),
(82, 121, 78),
(83, 122, 79),
(84, 122, 80),
(85, 123, 81),
(86, 123, 82),
(87, 123, 78),
(88, 124, 83),
(89, 124, 84),
(90, 124, 82),
(91, 124, 78),
(92, 125, 84),
(93, 125, 85),
(94, 125, 76),
(95, 125, 77),
(96, 125, 78),
(97, 126, 77),
(98, 126, 76),
(99, 126, 78),
(100, 126, 86),
(101, 126, 87),
(102, 127, 88),
(103, 127, 76),
(104, 127, 77),
(105, 127, 89),
(106, 127, 87),
(107, 127, 90),
(108, 127, 89),
(109, 128, 91),
(110, 128, 92),
(111, 128, 93),
(112, 128, 78),
(113, 128, 82),
(114, 128, 94),
(115, 129, 95),
(116, 130, 95),
(117, 131, 95),
(118, 132, 95),
(119, 133, 95),
(120, 134, 95),
(121, 135, 95),
(122, 136, 95),
(123, 137, 95),
(124, 138, 95),
(125, 139, 95),
(126, 140, 96),
(127, 140, 97),
(128, 141, 78),
(129, 141, 76),
(130, 141, 77),
(131, 142, 98),
(132, 142, 78),
(133, 142, 99),
(134, 143, 95),
(135, 144, 95),
(136, 145, 100),
(137, 145, 101),
(138, 145, 102),
(139, 145, 103),
(140, 146, 77),
(141, 146, 76),
(142, 146, 78),
(143, 147, 76),
(144, 147, 77),
(145, 147, 78),
(146, 148, 76),
(147, 149, 76),
(148, 150, 76),
(149, 151, 76),
(150, 152, 76),
(151, 152, 77),
(152, 152, 78),
(153, 153, 104),
(158, 155, 77),
(159, 155, 107),
(160, 156, 108),
(161, 156, 109),
(162, 157, 107),
(163, 157, 78),
(164, 157, 110),
(171, 154, 103),
(172, 154, 111),
(173, 154, 112),
(174, 158, 77),
(175, 158, 76),
(176, 158, 113),
(177, 159, 114),
(178, 159, 115),
(179, 159, 116),
(180, 160, 117),
(181, 160, 84),
(182, 160, 78),
(183, 160, 118),
(184, 161, 119),
(185, 161, 120);

-- --------------------------------------------------------

--
-- Table structure for table `reported_projects`
--

CREATE TABLE `reported_projects` (
  `id` int(11) UNSIGNED NOT NULL,
  `reported_at` datetime NOT NULL,
  `project_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reported_users`
--

CREATE TABLE `reported_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `reported_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `reported_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reported_users`
--

INSERT INTO `reported_users` (`id`, `reported_at`, `user_id`, `reported_id`) VALUES
(31, '2022-05-13 16:06:18', 8, 9),
(32, '2022-05-15 20:22:00', 11, 8),
(33, '2022-05-16 16:13:38', 8, 8),
(34, '2022-05-16 16:13:39', 12, 8),
(35, '2022-05-17 12:11:41', 13, 12);

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `link` varchar(255) DEFAULT '',
  `linkName` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) UNSIGNED NOT NULL,
  `tag` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag`) VALUES
(75, 'hallo'),
(76, 'ux'),
(77, 'ui'),
(78, 'design'),
(79, 'fjeiopf'),
(80, 'jfioepjio'),
(81, 'cat'),
(82, 'illustration'),
(83, 'Dragon'),
(84, 'logo'),
(85, 'emblem'),
(86, 'hoppin'),
(87, 'app'),
(88, 'dribbble'),
(89, 'platform'),
(90, 'web'),
(91, '3d'),
(92, 'room'),
(93, 'isometric'),
(94, 'cry'),
(95, ''),
(96, 'wollah'),
(97, 'person'),
(98, 'interieur'),
(99, 'branding'),
(100, 'tag'),
(101, 'dik'),
(102, 'soep'),
(103, 'seks'),
(104, 'pager'),
(105, 'kwetter'),
(106, 'cool'),
(107, 'buildings'),
(108, 'pizza'),
(109, 'nice'),
(110, 'achitecture'),
(111, 'jow'),
(112, 'dick'),
(113, 'ja'),
(114, 'black'),
(115, 'white'),
(116, 'mystery'),
(117, 'somelogo'),
(118, 'fast'),
(119, 'radio2'),
(120, 'podcasts');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL DEFAULT '',
  `lastname` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `bio` text,
  `role` varchar(255) NOT NULL DEFAULT 'User',
  `created_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `profile_image` varchar(255) DEFAULT NULL,
  `secondEmail` varchar(255) DEFAULT NULL,
  `publicId` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `bio`, `role`, `created_at`, `profile_image`, `secondEmail`, `publicId`) VALUES
(8, 'Robbe', 'bierebeeck', 'robbe.bierebeeck@student.thomasmore.be', '$2y$13$AyPr69z1Xqd1KjqiDr6lheWYteUq2Tg2lmIKMQiRiq1Be3lvewmVK', NULL, 'Admin', '2022-05-17 12:15:07', './upload/96530804_1670282383112621_2857099351530930176_o.jpg', NULL, NULL),
(9, 'hannah', 'claes', 'hannah@student.thomasmore.be', '$2y$13$1Ew9dNpjDPJa.CRyROwHpOiQrA1LP5XHfuyD0p9BFdM4gGc/wqxzu', NULL, 'User', '2022-05-04 22:27:13', './upload/headerLow.jpg', NULL, NULL),
(10, 'Nick', 'bevers', 'r0702962@student.thomasmore.be', '$2y$13$BeKm2Pt7LkFwHtWI6j6I1.b4.8AfjT0Sz8ChLuoLPT1tR1VeSgs/e', NULL, 'User', '2022-05-14 15:22:54', './upload/Dia1.JPG', NULL, NULL),
(11, 'Mystery', 'man', 'x.y@thomasmore.be', '$2y$13$6i1Rmqs19IEhSPKR76mw4uBsszEcSsUp7Dl7Km0bdw0kv0bX77W9K', "hey I\'m here to try out the app", 'User', '2022-05-15 20:22:45', './upload/mystery.png', NULL, NULL),
(12, 'Bob', 'Storms', 'bob.storms@student.thomasmore.be', '$2y$13$qJuLEta.7X/1DcLEB834BudzEqHXUrMya9J9d5R0gwy6Tf4hzuhgK', NULL, 'User', '2022-05-23 13:37:27', './upload/Optie 1.jpg', NULL, NULL),
(14, 'ad', 'hd', 'r0834380@student.thomasmore.be', '$2y$13$5WOfTOKCxTw2AJO70llw5.S9sxq3F/pOltz2fzI81c9m/rEeWUXxC', NULL, 'Admin', '2022-05-23 13:37:34', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1652984285/profile_pictures/hk5lhjtx8iufkvw3oryj.webp', NULL, 'profile_pictures/hk5lhjtx8iufkvw3oryj');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip` varchar(255) NOT NULL DEFAULT '',
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `warned_users`
--

CREATE TABLE `warned_users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warned_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warned_at` datetime NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warned_users`
--

INSERT INTO `warned_users` (`id`, `user_id`, `warned_id`, `warned_at`, `status`) VALUES
(5, '13', '14', '2022-05-19 20:19:55', 'agreed'),
(6, '13', '14', '2022-05-19 20:25:55', 'agreed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_temp`
--
ALTER TABLE `password_reset_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_colors`
--
ALTER TABLE `project_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_tags`
--
ALTER TABLE `project_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reported_projects`
--
ALTER TABLE `reported_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reported_users`
--
ALTER TABLE `reported_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warned_users`
--
ALTER TABLE `warned_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=395;

--
-- AUTO_INCREMENT for table `password_reset_temp`
--
ALTER TABLE `password_reset_temp`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `project_colors`
--
ALTER TABLE `project_colors`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_tags`
--
ALTER TABLE `project_tags`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `reported_projects`
--
ALTER TABLE `reported_projects`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reported_users`
--
ALTER TABLE `reported_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warned_users`
--
ALTER TABLE `warned_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
