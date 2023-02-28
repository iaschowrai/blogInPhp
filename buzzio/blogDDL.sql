-- MariaDB dump 10.19  Distrib 10.6.12-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: usersdb
-- ------------------------------------------------------
-- Server version	10.6.12-MariaDB-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `compose`
--

DROP TABLE IF EXISTS `compose`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compose` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(5000) NOT NULL,
  `created_date` datetime NOT NULL,
  `compose_username` varchar(255) NOT NULL,
  `highlights` enum('Yes','No') NOT NULL DEFAULT 'No',
  `authurname` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `usersregistration` (`register_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compose`
--

LOCK TABLES `compose` WRITE;
/*!40000 ALTER TABLE `compose` DISABLE KEYS */;
INSERT INTO `compose` VALUES (1,'category','What Is Web Development?','So, you’re interested in becoming a developer? Congratulations, and welcome to your new career! As you’ve started looking into different developer career paths, you’ve probably come across web development.\r\n\r\nBut what is web development exactly? Why is it important, and what kinds of Web Developers are there?\r\n','2023-02-24 22:26:33','johnwick','Yes','John Wick',8),(5,'category','Hear from Microsoft employees','\"At Microsoft, you’ll be empowered to work on things that you’re passionate about. You’ll be given autonomy. Your ideas will matter.\"','2023-02-24 22:40:49','johnwick','No','John Wick',8),(7,'category','Topic changes','The Video Engineering Data Infrastructure team is working on exciting technologies for future Apple products, and we\'re looking for the right Full Stack Developer to join our team to help develop our next generation systems. In this role, you\'ll work on a highly dynamic team that designs and implements data management systems for powering computer vision and deep learning real time video products like FaceID, ARKit and Animoji. You will be working with experts in machine learning to develop tools, automation and pipelines to analyze and validate massive amounts of data.\r\n','2023-02-26 00:39:37','johnwick','Yes','John Wick',8),(9,'category','Inclusive Hiring for people with disabilities','At Microsoft, we know that having a diverse workforce which includes people with disabilities is essential if we are going to deliver on our mission to empower every person and every organization on the planet to achieve more. Our Neurodiversity Hiring Program, Ability Hiring events, and inclusive interviews enable all candidates to showcase their skills and bring their best selves.\r\n','2023-02-26 00:40:04','johnwick','No','John Wick',8);
/*!40000 ALTER TABLE `compose` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usersregistration`
--

DROP TABLE IF EXISTS `usersregistration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usersregistration` (
  `register_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `user_type` enum('admin','user') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`register_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usersregistration`
--

LOCK TABLES `usersregistration` WRITE;
/*!40000 ALTER TABLE `usersregistration` DISABLE KEYS */;
INSERT INTO `usersregistration` VALUES (2,'admin','admin','1986-10-08','male','admin@admin.com','admin','$2y$10$6QR7FXgzTSMnxwdKBALKdedOKhysE2mGcv7gEVq7YwrcLwZVbp.he','2023-02-20 17:03:49','admin'),(8,'John','Wick','2021-01-23','male','johnwick@jw.com','johnwick','$2y$10$npSFb32EBd3wZt05uKzJnuOgQFZhVGaaH4BMqenBXxh6F2658XSDa','2023-02-24 21:11:53','user');
/*!40000 ALTER TABLE `usersregistration` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-02-26  1:09:09
