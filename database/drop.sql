# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.34)
# Database: drop
# Generation Time: 2022-05-09 06:26:54 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table Colors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Colors`;

CREATE TABLE `Colors` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hex` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table Comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Comments`;

CREATE TABLE `Comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `comment` varchar(255) NOT NULL DEFAULT '',
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table Followers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Followers`;

CREATE TABLE `Followers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) DEFAULT NULL,
  `following_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table Likes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Likes`;

CREATE TABLE `Likes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `Likes` WRITE;
/*!40000 ALTER TABLE `Likes` DISABLE KEYS */;

INSERT INTO `Likes` (`id`, `project_id`, `user_id`, `status`)
VALUES
	(380,157,8,1),
	(381,156,8,1),
	(382,155,8,0),
	(383,154,8,0);

/*!40000 ALTER TABLE `Likes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Password_Reset_Temp
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Password_Reset_Temp`;

CREATE TABLE `Password_Reset_Temp` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `exp_date` varchar(255) NOT NULL DEFAULT '',
  `code` varchar(255) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `Password_Reset_Temp` WRITE;
/*!40000 ALTER TABLE `Password_Reset_Temp` DISABLE KEYS */;

INSERT INTO `Password_Reset_Temp` (`id`, `user_id`, `exp_date`, `code`, `active`)
VALUES
	(22,8,'2022-04-25 13:38:42','1626688403e527',0),
	(23,8,'2022-04-26 21:00:48','16268415ecba12',1),
	(24,8,'2022-04-26 21:01:42','162684195a9014',1),
	(25,8,'2022-04-26 21:02:06','1626841ad2a8e8',1),
	(26,8,'2022-04-26 21:02:10','1626841b147796',1),
	(27,8,'2022-04-26 21:02:28','1626841c359b60',1),
	(28,8,'2022-04-26 21:02:52','1626841db441ed',1),
	(29,8,'2022-04-26 21:03:26','1626841fd9160b',1);

/*!40000 ALTER TABLE `Password_Reset_Temp` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Project_Colors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Project_Colors`;

CREATE TABLE `Project_Colors` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `project__id` int(11) NOT NULL,
  `color_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table Project_Tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Project_Tags`;

CREATE TABLE `Project_Tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `Project_Tags` WRITE;
/*!40000 ALTER TABLE `Project_Tags` DISABLE KEYS */;

INSERT INTO `Project_Tags` (`id`, `project_id`, `tag_id`)
VALUES
	(23,92,46),
	(24,92,47),
	(25,92,61),
	(26,93,46),
	(27,93,47),
	(28,93,61),
	(29,94,62),
	(30,94,63),
	(31,94,64),
	(32,95,65),
	(33,95,66),
	(34,95,67),
	(35,96,65),
	(36,96,66),
	(37,96,67),
	(38,97,68),
	(39,97,69),
	(40,98,68),
	(41,98,69),
	(42,99,68),
	(43,99,69),
	(44,100,68),
	(45,100,69),
	(46,101,68),
	(47,101,69),
	(48,102,68),
	(49,102,69),
	(50,103,68),
	(51,103,69),
	(52,104,68),
	(53,104,69),
	(54,105,68),
	(55,105,69),
	(56,106,68),
	(57,106,69),
	(58,107,68),
	(59,107,69),
	(60,108,68),
	(61,108,69),
	(62,109,68),
	(63,109,69),
	(64,110,68),
	(65,110,69),
	(66,111,68),
	(67,111,69),
	(68,112,70),
	(69,113,70),
	(70,114,70),
	(71,115,70),
	(72,116,70),
	(73,117,71),
	(74,117,72),
	(75,117,73),
	(76,118,70),
	(77,119,74),
	(78,120,74),
	(79,121,75),
	(80,121,76),
	(81,121,77),
	(82,121,78),
	(83,122,79),
	(84,122,80),
	(85,123,81),
	(86,123,82),
	(87,123,78),
	(88,124,83),
	(89,124,84),
	(90,124,82),
	(91,124,78),
	(92,125,84),
	(93,125,85),
	(94,125,76),
	(95,125,77),
	(96,125,78),
	(97,126,77),
	(98,126,76),
	(99,126,78),
	(100,126,86),
	(101,126,87),
	(102,127,88),
	(103,127,76),
	(104,127,77),
	(105,127,89),
	(106,127,87),
	(107,127,90),
	(108,127,89),
	(109,128,91),
	(110,128,92),
	(111,128,93),
	(112,128,78),
	(113,128,82),
	(114,128,94),
	(115,129,95),
	(116,130,95),
	(117,131,95),
	(118,132,95),
	(119,133,95),
	(120,134,95),
	(121,135,95),
	(122,136,95),
	(123,137,95),
	(124,138,95),
	(125,139,95),
	(126,140,96),
	(127,140,97),
	(128,141,78),
	(129,141,76),
	(130,141,77),
	(131,142,98),
	(132,142,78),
	(133,142,99),
	(134,143,95),
	(135,144,95),
	(136,145,100),
	(137,145,101),
	(138,145,102),
	(139,145,103),
	(140,146,77),
	(141,146,76),
	(142,146,78),
	(143,147,76),
	(144,147,77),
	(145,147,78),
	(146,148,76),
	(147,149,76),
	(148,150,76),
	(149,151,76),
	(150,152,76),
	(151,152,77),
	(152,152,78),
	(153,153,104),
	(158,155,77),
	(159,155,107),
	(160,156,108),
	(161,156,109),
	(162,157,107),
	(163,157,78),
	(164,157,110),
	(171,154,103),
	(172,154,111),
	(173,154,112);

/*!40000 ALTER TABLE `Project_Tags` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Projects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Projects`;

CREATE TABLE `Projects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT '',
  `image` varchar(255) DEFAULT '',
  `description` text,
  `posted_at` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `private_views` tinyint(1) DEFAULT NULL,
  `publicId` varchar(255) NOT NULL DEFAULT '',
  `showcase` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `Projects` WRITE;
/*!40000 ALTER TABLE `Projects` DISABLE KEYS */;

INSERT INTO `Projects` (`id`, `title`, `image`, `description`, `posted_at`, `user_id`, `private_views`, `publicId`, `showcase`)
VALUES
	(154,'kwetter branding','http://res.cloudinary.com/df5hbsklz/image/upload/v1650885984/posts/vwgxwncsaqcsirke4ydw.webp','I made this logo for a brand ','2022-04-25 13:26:27',8,0,'posts/vwgxwncsaqcsirke4ydw',1),
	(155,'nice buildings','http://res.cloudinary.com/df5hbsklz/image/upload/v1651601091/posts/kahktwhdxjclkgs9xqqk.webp','efef','2022-05-03 20:04:52',8,0,'posts/kahktwhdxjclkgs9xqqk',1),
	(156,'good pizza','http://res.cloudinary.com/df5hbsklz/image/upload/v1651668779/posts/hpdgllwknk7ybjvyd77t.webp','hallo, hier is goeie pizza','2022-05-04 14:52:59',8,0,'posts/hpdgllwknk7ybjvyd77t',0),
	(157,'mooie huizen enzo','http://res.cloudinary.com/df5hbsklz/image/upload/v1651696077/posts/i15qnav69spnzbuhc19r.webp','hallo, hier deel ik mijn mooie huizen','2022-05-04 22:27:58',9,0,'posts/i15qnav69spnzbuhc19r',1);

/*!40000 ALTER TABLE `Projects` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Reported_projects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Reported_projects`;

CREATE TABLE `Reported_projects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `reported_at` datetime NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table Reported_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Reported_users`;

CREATE TABLE `Reported_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `reported_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table Social_links
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Social_links`;

CREATE TABLE `Social_links` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `link` varchar(255) DEFAULT '',
  `linkName` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table Tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Tags`;

CREATE TABLE `Tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `Tags` WRITE;
/*!40000 ALTER TABLE `Tags` DISABLE KEYS */;

INSERT INTO `Tags` (`id`, `tag`)
VALUES
	(75,'hallo'),
	(76,'ux'),
	(77,'ui'),
	(78,'design'),
	(79,'fjeiopf'),
	(80,'jfioepjio'),
	(81,'cat'),
	(82,'illustration'),
	(83,'Dragon'),
	(84,'logo'),
	(85,'emblem'),
	(86,'hoppin'),
	(87,'app'),
	(88,'dribbble'),
	(89,'platform'),
	(90,'web'),
	(91,'3d'),
	(92,'room'),
	(93,'isometric'),
	(94,'cry'),
	(95,''),
	(96,'wollah'),
	(97,'person'),
	(98,'interieur'),
	(99,'branding'),
	(100,'tag'),
	(101,'dik'),
	(102,'soep'),
	(103,'seks'),
	(104,'pager'),
	(105,'kwetter'),
	(106,'cool'),
	(107,'buildings'),
	(108,'pizza'),
	(109,'nice'),
	(110,'achitecture'),
	(111,'jow'),
	(112,'dick');

/*!40000 ALTER TABLE `Tags` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Users`;

CREATE TABLE `Users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL DEFAULT '',
  `lastname` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `bio` text,
  `role` varchar(255) NOT NULL DEFAULT 'User',
  `created_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `profile_image` varchar(255) DEFAULT NULL,
  `secondEmail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;

INSERT INTO `Users` (`id`, `firstname`, `lastname`, `email`, `password`, `bio`, `role`, `created_at`, `profile_image`, `secondEmail`)
VALUES
	(8,'Robbe','bierebeeck','robbe.bierebeeck@student.thomasmore.be','$2y$13$LWu/tFWFPnYVMZNegbLDa.N.gCIExliQOoOewGLgdKddkABjINQTm',NULL,'User','2022-04-25 13:39:01','./upload/96530804_1670282383112621_2857099351530930176_o.jpg',NULL),
	(9,'hannah','claes','hannah@student.thomasmore.be','$2y$13$1Ew9dNpjDPJa.CRyROwHpOiQrA1LP5XHfuyD0p9BFdM4gGc/wqxzu',NULL,'User','2022-05-04 22:27:13','./upload/headerLow.jpg',NULL);

/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Views
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Views`;

CREATE TABLE `Views` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL DEFAULT '',
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
