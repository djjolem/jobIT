-- MySQL dump 10.13  Distrib 5.5.33, for Linux (x86_64)
--
-- Host: localhost    Database: short_list
-- ------------------------------------------------------
-- Server version	5.5.33-31.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `about` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`company_id`),
  UNIQUE KEY `company_id_UNIQUE` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `job_ad`
--

DROP TABLE IF EXISTS `job_ad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_ad` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) CHARACTER SET latin1 NOT NULL,
  `ad_short` varchar(500) CHARACTER SET latin1 NOT NULL,
  `ad_text` text CHARACTER SET latin1 NOT NULL,
  `deadline` date DEFAULT NULL,
  `created` date NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `company_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`job_id`),
  UNIQUE KEY `job_id_UNIQUE` (`job_id`),
  KEY `fk_job_ad_company_idx` (`company_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `fk_job_ad_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `job_ad_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET latin1 NOT NULL,
  `description` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`tag_id`),
  UNIQUE KEY `tag_id_UNIQUE` (`tag_id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `job_ad_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`job_ad_id`,`tag_id`),
  KEY `fk_tags_job_ad1_idx` (`job_ad_id`),
  KEY `fk_tags_tag1_idx` (`tag_id`),
  CONSTRAINT `fk_tags_job_ad1` FOREIGN KEY (`job_ad_id`) REFERENCES `job_ad` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tags_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `user_password` varchar(100) CHARACTER SET latin1 NOT NULL,
  `user_email` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `user_type` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `reg_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  UNIQUE KEY `user_name_UNIQUE` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_company`
--

DROP TABLE IF EXISTS `user_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_company` (
  `user_company_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_company_id`),
  UNIQUE KEY `user_company_id` (`user_company_id`),
  UNIQUE KEY `user_id` (`user_id`,`company_id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `user_company_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `user_company_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-07-29 21:41:46
