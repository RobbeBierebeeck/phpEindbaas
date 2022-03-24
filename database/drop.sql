# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.34)
# Database: drop
# Generation Time: 2022-03-24 21:38:45 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table Color
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Color`;

CREATE TABLE `Color` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hex` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table Comment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Comment`;

CREATE TABLE `Comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `comment` varchar(255) NOT NULL DEFAULT '',
  `Project_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table Followers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Followers`;

CREATE TABLE `Followers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) DEFAULT NULL,
  `Following_id` int(11) NOT NULL,
  `Follower_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table Like
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Like`;

CREATE TABLE `Like` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Project_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table Password_Reset_Temp
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Password_Reset_Temp`;

CREATE TABLE `Password_Reset_Temp` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `User_id` int(11) NOT NULL,
  `exp_date` varchar(255) NOT NULL DEFAULT '',
  `code` varchar(255) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `Password_Reset_Temp` WRITE;
/*!40000 ALTER TABLE `Password_Reset_Temp` DISABLE KEYS */;

INSERT INTO `Password_Reset_Temp` (`id`, `User_id`, `exp_date`, `code`, `active`)
VALUES
	(2,1,'1648150179','1623cc6a1ecad2',0),
	(3,1,'1648150897','1623cc96f8c5aa',0);

/*!40000 ALTER TABLE `Password_Reset_Temp` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Project
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Project`;

CREATE TABLE `Project` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `posted_at` datetime NOT NULL,
  `User_id` int(11) NOT NULL,
  `private_views` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table Project_Color
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Project_Color`;

CREATE TABLE `Project_Color` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Project__id` int(11) NOT NULL,
  `Color_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table Project_Tag
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Project_Tag`;

CREATE TABLE `Project_Tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Project_id` int(11) NOT NULL,
  `Tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table Reported_project
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Reported_project`;

CREATE TABLE `Reported_project` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `reported_at` datetime NOT NULL,
  `Project_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table Reported_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Reported_user`;

CREATE TABLE `Reported_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `reported_at` datetime NOT NULL,
  `User_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table Social_link
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Social_link`;

CREATE TABLE `Social_link` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `User_id` int(11) NOT NULL,
  `link` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table Tag
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Tag`;

CREATE TABLE `Tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table User
# ------------------------------------------------------------

DROP TABLE IF EXISTS `User`;

CREATE TABLE `User` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL DEFAULT '',
  `lastname` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `bio` text,
  `role` varchar(255) NOT NULL DEFAULT 'User',
  `created_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `profile_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;

INSERT INTO `User` (`id`, `firstname`, `lastname`, `email`, `password`, `bio`, `role`, `created_at`, `profile_image`)
VALUES
	(1,'Robbe','Bierebeeck','robbe.bierebeeck4@gmail.com','$2y$13$kqECWvXXL/pc1tD8DVWqVOgKcb/4AXe0nCeuAj4UmfIffOidBvfWm',NULL,'0','2022-03-24 20:42:09',NULL),
	(2,'Hannah','Claes','hannahclaes1@hotmail.com','123456',NULL,'0','2022-03-22 16:19:17',NULL);

/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Views
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Views`;

CREATE TABLE `Views` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL DEFAULT '',
  `Project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
