# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.34)
# Database: drop
# Generation Time: 2022-03-25 12:31:38 +0000
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



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
	(2,1,'1648150179','1623cc6a1ecad2',0),
	(3,1,'1648150897','1623cc96f8c5aa',0),
	(4,1,'1648196957','1623d7d5b4c2ae',0);

/*!40000 ALTER TABLE `Password_Reset_Temp` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Projects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Projects`;

CREATE TABLE `Projects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `posted_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `private_views` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;

INSERT INTO `Users` (`id`, `firstname`, `lastname`, `email`, `password`, `bio`, `role`, `created_at`, `profile_image`)
VALUES
	(1,'Robbe','Bierebeeck','robbe.bierebeeck4@gmail.com','$2y$13$wvngSvuTcRq.OTkQDJoxQ.7nE2e8E5C2.oty3rwK5iRl79AKgd49a',NULL,'0','2022-03-25 09:36:22',NULL),
	(2,'Hannah','Claes','hannahclaes1@hotmail.com','123456',NULL,'0','2022-03-22 16:19:17',NULL);

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
