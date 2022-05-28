-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 28, 2022 at 12:55 PM
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

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `hex`) VALUES
(41, '#336699');

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
(16, 'dankje robbe', 161, 12),
(17, 'jow', 160, 8),
(18, 'efe', 160, 8);

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
-- Table structure for table `invite_links`
--

CREATE TABLE `invite_links` (
  `id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invite_links`
--

INSERT INTO `invite_links` (`id`, `code`) VALUES
(2, '$2y$13$QeL.XAElTg6zNR19J9gaUen.5sUD80fZ0VzpoRkvhgPWZUAVhTzAW'),
(3, '$2y$13$nE/J35URrcToBygwnhCPZuRRzItKvtpDfZo6O9DBTcibHRy3T8VXa'),
(4, '$2y$13$gxCsjXnhEw/7Of.Y1dKz4.NB831jsLg17.3wjYk2WgSk6SV8lNll.'),
(5, '$2y$13$0Gn02Db0aFl6UzkoND2e/uD6Oc6h/V71ZWRm6zxXCNSDc2Yofi7VC'),
(6, '$2y$13$1hSsLUowJOLnWmEUnLkur.DdUbmLqKwwJjy5M19IRLn999CGnkvEy'),
(7, '$2y$13$ZVkm3DL4Jyz8ffK8aA3Pq.G1j9oEtTEiDZ9V2wmmzCDFVMxnYeYfq');

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
(394, 160, 12, 1),
(395, 187, 8, 1);

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
(34, 8, '2022-05-10 18:37:12', '1627a94b7e4442', 0),
(35, 8, '2022-05-27 21:59:46', '162912db1d6dc5', 0);

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
  `publicId` varchar(255) NOT NULL DEFAULT '',
  `showcase` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `image`, `description`, `posted_at`, `user_id`, `publicId`, `showcase`) VALUES
(154, 'kwetter branding', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1650885984/posts/vwgxwncsaqcsirke4ydw.webp', 'I made this logo for a brand ', '2022-04-25 13:26:27', 8, 'posts/vwgxwncsaqcsirke4ydw', 1),
(157, 'mooie huizen enzo', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1651696077/posts/i15qnav69spnzbuhc19r.webp', 'hallo, hier deel ik mijn mooie huizen', '2022-05-04 22:27:58', 9, 'posts/i15qnav69spnzbuhc19r', 1),
(160, 'hubride logo 🚀', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1652641413/posts/jusvyqhzzv4inyu2igoa.webp', 'Logo for my brother', '2022-05-15 21:03:35', 8, 'posts/jusvyqhzzv4inyu2igoa', 0),
(161, 'Podcast cover voor de rechtvaardige rechters', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1652710532/posts/cepnxq5f7axdbsjxikds.webp', 'dit is een beetje uitleg', '2022-05-16 16:15:34', 12, 'posts/cepnxq5f7axdbsjxikds', 1),
(162, 'een spontane auto', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653681440/posts/puxrfubm2d0weeyaggcc.webp', 'halll enzo ', '2022-05-27 21:57:20', 8, 'posts/puxrfubm2d0weeyaggcc', 0),
(163, 'efaefef', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653682447/posts/mtyaicbyoklvh3xhr8nd.webp', '', '2022-05-27 22:14:08', 8, 'posts/mtyaicbyoklvh3xhr8nd', 0),
(164, 'efefzef', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653682464/posts/sy5ryimbo8zanraswin7.webp', '', '2022-05-27 22:14:25', 8, 'posts/sy5ryimbo8zanraswin7', 0),
(165, 'eaggag', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653682499/posts/xvqv3gueyagrpkdzt4qi.webp', '', '2022-05-27 22:15:00', 8, 'posts/xvqv3gueyagrpkdzt4qi', 0),
(167, 'aegaege', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653685928/posts/rdiozxzw8e9libztsudw.webp', '', '2022-05-27 23:12:08', 8, 'posts/rdiozxzw8e9libztsudw', 0),
(168, 'egegeg', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653686096/posts/imycuxj3qdfz3gmwkx9c.webp', '', '2022-05-27 23:14:57', 8, 'posts/imycuxj3qdfz3gmwkx9c', 0),
(169, 'gegzgez', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653686198/posts/jz9pgxmpzarufhjubb4e.webp', '', '2022-05-27 23:16:39', 8, 'posts/jz9pgxmpzarufhjubb4e', 0),
(170, 'gerggegergrger', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653686423/posts/fhxgpuwhxknvvbqwzail.webp', '', '2022-05-27 23:20:24', 8, 'posts/fhxgpuwhxknvvbqwzail', 0),
(171, 'gegz', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653687242/posts/buqlouwrq532ljtc27qy.webp', '', '2022-05-27 23:34:02', 8, 'posts/buqlouwrq532ljtc27qy', 0),
(172, 'efzefezf', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653687548/posts/qf11swzs05mamylnlkol.webp', '', '2022-05-27 23:39:09', 8, 'posts/qf11swzs05mamylnlkol', 0),
(173, 'ezgeg', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653687934/posts/ovwd5faw4jztf4hll62m.webp', '', '2022-05-27 23:45:35', 8, 'posts/ovwd5faw4jztf4hll62m', 0),
(174, 'ezgeg', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653688018/posts/ent7ljuz6nozz03ibpfd.webp', '', '2022-05-27 23:46:59', 8, 'posts/ent7ljuz6nozz03ibpfd', 0),
(175, 'ezgeg', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653688161/posts/ldtbrbypqw2jfo0llt4k.webp', '', '2022-05-27 23:49:22', 8, 'posts/ldtbrbypqw2jfo0llt4k', 0),
(176, 'egezeg', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653688266/posts/gbxbijvvbwqxk6ucke4m.webp', '', '2022-05-27 23:51:07', 8, 'posts/gbxbijvvbwqxk6ucke4m', 0),
(177, 'egezeg', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653688292/posts/nuhhv7qx2jkjzjaasdde.webp', '', '2022-05-27 23:51:33', 8, 'posts/nuhhv7qx2jkjzjaasdde', 0),
(178, 'egezeg', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653688354/posts/j8zxd5fasvalb5tkogna.webp', '', '2022-05-27 23:52:35', 8, 'posts/j8zxd5fasvalb5tkogna', 0),
(179, 'gregzgrg', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653688399/posts/ma6083q1azxtirihdqcu.webp', '', '2022-05-27 23:53:20', 8, 'posts/ma6083q1azxtirihdqcu', 0),
(180, 'gregzgrg', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653688471/posts/ruxjpbtrpzvbjpes7umv.webp', '', '2022-05-27 23:54:32', 8, 'posts/ruxjpbtrpzvbjpes7umv', 0),
(181, 'egzgr', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653688586/posts/etnlfoq2zqxqfnhi9adc.webp', '', '2022-05-27 23:56:27', 8, 'posts/etnlfoq2zqxqfnhi9adc', 0),
(182, 'gergerg', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653688654/posts/jlyc2l9dg1q15smmd6eo.webp', '', '2022-05-27 23:57:35', 8, 'posts/jlyc2l9dg1q15smmd6eo', 0),
(183, 'egergerg', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653688697/posts/pfs44iqylhsmmw0tpnrs.webp', '', '2022-05-27 23:58:19', 8, 'posts/pfs44iqylhsmmw0tpnrs', 0),
(184, 'egergerg', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653724034/posts/p7lpxdrqrfwxfqbz6pr1.webp', '', '2022-05-28 09:47:15', 8, 'posts/p7lpxdrqrfwxfqbz6pr1', 0),
(185, 'efezfezf', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653724105/posts/dgyatvpcsamy56ngqpva.webp', '', '2022-05-28 09:48:26', 8, 'posts/dgyatvpcsamy56ngqpva', 0),
(186, 'efze', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653724126/posts/enlid1d5t8rusdzasoqg.webp', '', '2022-05-28 09:48:47', 8, 'posts/enlid1d5t8rusdzasoqg', 0),
(187, 'efze', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653724160/posts/hdmvrfpp6rq8cqa3jxvo.webp', '', '2022-05-28 09:49:21', 8, 'posts/hdmvrfpp6rq8cqa3jxvo', 0),
(191, 'zgregergergerg', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1653726929/posts/a1bf6nk3w7h92jhni0ez.webp', '', '2022-05-28 10:35:31', 8, 'posts/a1bf6nk3w7h92jhni0ez', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_colors`
--

CREATE TABLE `project_colors` (
  `id` int(11) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
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
(160, 156, 108),
(161, 156, 109),
(162, 157, 107),
(163, 157, 78),
(164, 157, 110),
(171, 154, 103),
(172, 154, 111),
(173, 154, 112),
(180, 160, 117),
(181, 160, 84),
(182, 160, 78),
(183, 160, 118),
(184, 161, 119),
(185, 161, 120),
(186, 162, 121),
(187, 162, 122),
(188, 163, 95),
(189, 164, 123),
(190, 164, 124),
(191, 165, 125),
(192, 167, 95),
(193, 168, 95),
(194, 169, 126),
(195, 170, 95),
(196, 171, 95),
(197, 172, 95),
(198, 173, 95),
(199, 174, 95),
(200, 175, 95),
(201, 176, 95),
(202, 177, 95),
(203, 178, 95),
(204, 179, 95),
(205, 180, 95),
(206, 181, 95),
(207, 182, 95),
(208, 183, 95),
(209, 184, 95),
(210, 185, 95),
(211, 186, 95),
(212, 187, 95),
(216, 191, 95);

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
(35, '2022-05-17 12:11:41', 12, 13),
(36, '2022-05-28 11:26:06', 14, 15);

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
(120, 'podcasts'),
(121, 'spontaan'),
(122, 'auto'),
(123, 'ejieopf'),
(124, 'ieofpj'),
(125, 'efa'),
(126, 'eg');

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
  `publicId` varchar(255) DEFAULT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `publicViews` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `bio`, `role`, `created_at`, `profile_image`, `secondEmail`, `publicId`, `banned`, `publicViews`) VALUES
(8, 'Robbe', 'bierebeeck', 'robbe.bierebeeck@student.thomasmore.be', '$2y$13$f0GRCmR7qJ8P6VGO2CNcpeFHf007gWdtZr3.eUGl31R79D62Fv2f6', NULL, 'Moderator', '2022-05-28 11:13:59', './upload/96530804_1670282383112621_2857099351530930176_o.jpg', NULL, NULL, 0, 0),
(9, 'hannah', 'claes', 'hannah@student.thomasmore.be', '$2y$13$1Ew9dNpjDPJa.CRyROwHpOiQrA1LP5XHfuyD0p9BFdM4gGc/wqxzu', NULL, 'User', '2022-05-26 19:32:17', './upload/headerLow.jpg', NULL, NULL, 0, 1),
(10, 'Nick', 'bevers', 'r0702962@student.thomasmore.be', '$2y$13$BeKm2Pt7LkFwHtWI6j6I1.b4.8AfjT0Sz8ChLuoLPT1tR1VeSgs/e', NULL, 'User', '2022-05-26 19:32:19', './upload/Dia1.JPG', NULL, NULL, 0, 1),
(11, 'Mystery', 'man', 'x.y@thomasmore.be', '$2y$13$6i1Rmqs19IEhSPKR76mw4uBsszEcSsUp7Dl7Km0bdw0kv0bX77W9K', "hey I\'m here to try out the app", 'User', '2022-05-28 10:59:35', './upload/mystery.png', NULL, NULL, 0, 1),
(12, 'Bob', 'Storms', 'bob.storms@student.thomasmore.be', '$2y$13$qJuLEta.7X/1DcLEB834BudzEqHXUrMya9J9d5R0gwy6Tf4hzuhgK', NULL, 'User', '2022-05-27 00:10:04', './upload/Optie 1.jpg', NULL, NULL, 0, 1),
(14, 'a', 'dl', 'r0834380@student.thomasmore.be', '$2y$13$5WOfTOKCxTw2AJO70llw5.S9sxq3F/pOltz2fzI81c9m/rEeWUXxC', NULL, 'Moderator', '2022-05-28 14:55:06', 'http://res.cloudinary.com/df5hbsklz/image/upload/v1652984285/profile_pictures/hk5lhjtx8iufkvw3oryj.webp', NULL, 'profile_pictures/hk5lhjtx8iufkvw3oryj', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip` varchar(255) NOT NULL DEFAULT '',
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `ip`, `project_id`, `user_id`) VALUES
(1, '127.0.0.1', 157, 8),
(2, '127.0.0.1', 154, 8),
(3, '127.0.0.1', 161, 8),
(4, '127.0.0.1', 160, 8),
(5, '127.0.0.1', 190, 8),
(6, '127.0.0.1', 189, 8),
(7, '127.0.0.1', 188, 8),
(8, '127.0.0.1', 187, 8);

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
-- Indexes for table `invite_links`
--
ALTER TABLE `invite_links`
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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invite_links`
--
ALTER TABLE `invite_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=396;

--
-- AUTO_INCREMENT for table `password_reset_temp`
--
ALTER TABLE `password_reset_temp`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `project_colors`
--
ALTER TABLE `project_colors`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_tags`
--
ALTER TABLE `project_tags`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `reported_projects`
--
ALTER TABLE `reported_projects`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reported_users`
--
ALTER TABLE `reported_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `warned_users`
--
ALTER TABLE `warned_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
