# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.28-0ubuntu0.12.04.2-log)
# Datenbank: app
# Erstellungsdauer: 2013-08-15 17:40:20 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Export von Tabelle category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_64C19C1727ACA70` (`parent_id`),
  CONSTRAINT `FK_64C19C1727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;

INSERT INTO `category` (`id`, `parent_id`, `label`)
VALUES
	(1,NULL,'Tech'),
	(2,NULL,'Novel');

/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle channel
# ------------------------------------------------------------

DROP TABLE IF EXISTS `channel`;

CREATE TABLE `channel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Export von Tabelle contact_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contact_data`;

CREATE TABLE `contact_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `contact_data` WRITE;
/*!40000 ALTER TABLE `contact_data` DISABLE KEYS */;

INSERT INTO `contact_data` (`id`, `email`, `phone`)
VALUES
	(1,'max.mustermann@example.com','12345678'),
	(2,'maria.musterfrau@example.com','87654321'),
	(3,'john.doe@example.com','53627525');

/*!40000 ALTER TABLE `contact_data` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle friends
# ------------------------------------------------------------

DROP TABLE IF EXISTS `friends`;

CREATE TABLE `friends` (
  `user_id` int(11) NOT NULL,
  `friend_user_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`friend_user_id`),
  KEY `IDX_21EE7069A76ED395` (`user_id`),
  KEY `IDX_21EE706993D1119E` (`friend_user_id`),
  CONSTRAINT `FK_21EE706993D1119E` FOREIGN KEY (`friend_user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_21EE7069A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Export von Tabelle post_tag
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_tag`;

CREATE TABLE `post_tag` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`tag_id`),
  KEY `IDX_5ACE3AF04B89032C` (`post_id`),
  KEY `IDX_5ACE3AF0BAD26311` (`tag_id`),
  CONSTRAINT `FK_5ACE3AF04B89032C` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_5ACE3AF0BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `post_tag` WRITE;
/*!40000 ALTER TABLE `post_tag` DISABLE KEYS */;

INSERT INTO `post_tag` (`post_id`, `tag_id`)
VALUES
	(1,1),
	(1,2),
	(1,3),
	(3,3);

/*!40000 ALTER TABLE `post_tag` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `discr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `videoUrl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imageUrl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_885DBAFAA76ED395` (`user_id`),
  KEY `IDX_885DBAFA12469DE2` (`category_id`),
  CONSTRAINT `FK_885DBAFA12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_885DBAFAA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `title`, `content`, `discr`, `videoUrl`, `imageUrl`)
VALUES
	(1,1,NULL,'Parallel computing','Parallel computing is a form of computation in which many calculations are carried out simultaneously, operating on the principle that large problems can often be divided into smaller ones, which are then solved concurrently (\"in parallel\"). There are several different forms of parallel computing: bit-level, instruction level, data, and task parallelism. Parallelism has been employed for many years, mainly in high-performance computing, but interest in it has grown lately due to the physical constraints preventing frequency scaling. As power consumption (and consequently heat generation) by computers has become a concern in recent years, parallel computing has become the dominant paradigm in computer architecture, mainly in the form of multicore processors. Parallel computers can be roughly classified according to the level at which the hardware supports parallelism, with multi-core and multi-processor computers having multiple processing elements within a single machine, while clusters, MPPs, and grids use multiple computers to work on the same task. Specialized parallel computer architectures are sometimes used alongside traditional processors, for accelerating specific tasks. Parallel computer programs are more difficult to write than sequential ones, because concurrency introduces several new classes of potential software bugs, of which race conditions are the most common. Communication and synchronization between the different subtasks are typically some of the greatest obstacles to getting good parallel program performance. The maximum possible speed-up of a program as a result of parallelization is known as Amdahl\'s law.','text',NULL,NULL),
	(2,1,NULL,'The Million Dollar Homepage','The Million Dollar Homepage is a website conceived in 2005 by Alex Tew, a student from Wiltshire, England, to raise money for his university education. The home page consists of a million pixels arranged in a 1000 × 1000 pixel grid; the image-based links on it were sold for US$1 per pixel in 10 × 10 blocks. The purchasers of these pixel blocks provided tiny images to be displayed on them, a URL to which the images were linked, and a slogan to be displayed when hovering a cursor over the link. The aim of the website was to sell all of the pixels in the image, thus generating a million dollars of income for the creator. The Wall Street Journal has commented that the site inspired other websites that sell pixels.[2][3]\nLaunched on 26 August 2005, the website became an Internet phenomenon. The Alexa ranking of web traffic peaked at around 127; as of 18 December 2009, it is 35,983.[4] On 1 January 2006, the final 1,000 pixels were put up for auction on eBay. The auction closed on 11 January with a winning bid of $38,100 that brought the final tally to $1,037,100 in gross income. His website was also featured in the book \"Cool Tech Gadgets, Games, Robots, and the Digital World\".\nDuring the January 2006 auction, the website was subject to a distributed denial-of-service attack and ransom demand, which left it inaccessible to visitors for a week while its security system was upgraded. The Federal Bureau of Investigation and Wiltshire Constabulary investigated the attack and extortion attempt.[5][6]','text',NULL,NULL),
	(3,2,NULL,'Macintosh Classic','The Macintosh Classic is a personal computer manufactured by Apple. Introduced on October 15, 1990, it was the first Apple Macintosh to sell for less than US$1,000. Production of the Classic was prompted by the success of the Macintosh Plus and the Macintosh SE. The system specifications of the Classic were very similar to its predecessors, with the same 9-inch (23 cm) monochrome CRT display, 512×384 pixel resolution, and 4 megabyte (MB) memory limit of the older Macintosh computers.Apple\'s decision to not update the Classic with newer technology such as a 68010 CPU, higher RAM capacity or color display ensured compatibility with the Mac\'s by-then healthy software base as well as enabled it to fit the lower price-point Apple intended for it. Nevertheless, the Classic featured several improvements over the aging Macintosh Plus, which it replaced as Apple\'s low-end Mac computer. It was up to 25 percent faster than the Plus and included an Apple SuperDrive 3.5-inch (9 cm) floppy disk drive as standard. The Classic was an adaptation of Jerry Manock\'s and Terry Oyama\'s 1984 Macintosh 128K industrial design, as had been the earlier Macintosh SE. Apple released two versions that ranged in price from $1,000 to $1,500. Reviewer reactions were mixed; most focused on the slow processor performance and lack of expansion slots. The consensus was that the Classic was only useful for word processing, spreadsheets and databases. The price point and the availability of education software led to the Classic\'s popularity in education. It was sold alongside the more powerful Macintosh Classic II in 1991 until its discontinuation the next year.','text',NULL,NULL);

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle posts_image
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts_image`;

CREATE TABLE `posts_image` (
  `id` int(11) NOT NULL,
  `imageUrl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Export von Tabelle posts_video
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts_video`;

CREATE TABLE `posts_video` (
  `id` int(11) NOT NULL,
  `videoUrl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Export von Tabelle role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;

INSERT INTO `role` (`id`, `label`)
VALUES
	(1,'Base-User'),
	(2,'Pro-User'),
	(3,'Admin-User');

/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle tag
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tag`;

CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;

INSERT INTO `tag` (`id`, `label`)
VALUES
	(1,'Computer'),
	(2,'Internet'),
	(3,'Apple');

/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle user_info
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_info`;

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `signUpDate` datetime DEFAULT NULL,
  `signOffDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `user_info` WRITE;
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;

INSERT INTO `user_info` (`id`, `signUpDate`, `signOffDate`)
VALUES
	(1,'2013-04-02 17:00:00',NULL),
	(2,'2012-08-09 16:00:00',NULL),
	(3,'2012-08-09 12:00:00',NULL);

/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `name_prefix` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contactData_id` int(11) DEFAULT NULL,
  `userInfo_id` int(11) DEFAULT NULL,
  `lifePartner_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E991E948A2` (`contactData_id`),
  UNIQUE KEY `UNIQ_1483A5E9E5704DA` (`userInfo_id`),
  UNIQUE KEY `UNIQ_1483A5E9275DD7BF` (`lifePartner_id`),
  CONSTRAINT `FK_1483A5E9275DD7BF` FOREIGN KEY (`lifePartner_id`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_1483A5E991E948A2` FOREIGN KEY (`contactData_id`) REFERENCES `contact_data` (`id`),
  CONSTRAINT `FK_1483A5E9E5704DA` FOREIGN KEY (`userInfo_id`) REFERENCES `user_info` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `name_prefix`, `username`, `password`, `contactData_id`, `userInfo_id`, `lifePartner_id`)
VALUES
	(1,'Max','Mustermann',2,'Prof. Dr.',NULL,NULL,1,1,2),
	(2,'Maria','Musterfrau',1,'Prof. Dr.',NULL,NULL,2,2,1),
	(3,'John','Doe',2,NULL,NULL,NULL,3,3,NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle users_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_categories`;

CREATE TABLE `users_categories` (
  `user` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  PRIMARY KEY (`user`,`category`),
  UNIQUE KEY `UNIQ_ED98E9FC64C19C1` (`category`),
  KEY `IDX_ED98E9FC8D93D649` (`user`),
  CONSTRAINT `FK_ED98E9FC64C19C1` FOREIGN KEY (`category`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_ED98E9FC8D93D649` FOREIGN KEY (`user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Export von Tabelle users_roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_roles`;

CREATE TABLE `users_roles` (
  `user` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  PRIMARY KEY (`user`,`role`),
  KEY `IDX_51498A8E8D93D649` (`user`),
  KEY `IDX_51498A8E57698A6A` (`role`),
  CONSTRAINT `FK_51498A8E57698A6A` FOREIGN KEY (`role`) REFERENCES `role` (`id`),
  CONSTRAINT `FK_51498A8E8D93D649` FOREIGN KEY (`user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users_roles` WRITE;
/*!40000 ALTER TABLE `users_roles` DISABLE KEYS */;

INSERT INTO `users_roles` (`user`, `role`)
VALUES
	(1,1),
	(1,2),
	(2,1),
	(2,2);

/*!40000 ALTER TABLE `users_roles` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
