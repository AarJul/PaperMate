-- MySQL dump 10.13  Distrib 5.7.24, for osx11.1 (x86_64)
--
-- Host: localhost    Database: papermate
-- ------------------------------------------------------
-- Server version	8.0.33

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `commentid` int NOT NULL AUTO_INCREMENT,
  `postid` int NOT NULL,
  `userid` int DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `comment` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`commentid`),
  KEY `useridx_idx` (`userid`),
  KEY `postidx_idx` (`postid`),
  CONSTRAINT `postidx` FOREIGN KEY (`postid`) REFERENCES `post` (`postid`),
  CONSTRAINT `useridx` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,1,2,'2023-01-01 00:00:00','Make sure to bring all the necessary documents with you.'),(2,1,1,'2023-01-02 00:00:00','How long did the process take for you?'),(3,2,1,'2023-01-03 00:00:00','Congratulations on your new address!'),(4,2,2,'2023-01-04 00:00:00','Thanks! The process was smooth and took about an hour.'),(5,1,1,'2023-11-30 02:48:57','ok'),(6,1,1,'2023-11-30 02:49:07','こんにちは'),(7,2,1,'2023-11-30 02:49:42','xin chao\r\n'),(8,1,2,'2023-11-30 02:56:41','ok'),(9,1,1,'2023-11-30 02:56:47','ok'),(10,1,1,'2023-12-05 00:49:38','LOL\r\n'),(11,1,1,'2023-12-05 01:33:25','CHAT KKJJK\r\n'),(12,4,1,'2023-12-14 02:51:37','iughkjk'),(13,6,1,'2024-01-16 00:39:59','uyhu');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document`
--

DROP TABLE IF EXISTS `document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `document` (
  `documentid` int NOT NULL AUTO_INCREMENT,
  `documentname` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documentpics` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`documentid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document`
--

LOCK TABLES `document` WRITE;
/*!40000 ALTER TABLE `document` DISABLE KEYS */;
INSERT INTO `document` VALUES (1,'Residence Registration Form',NULL),(2,'Identification Card (e.g., Passport)',NULL),(11,'Transfer','yuusoutennsyu.jpeg');
/*!40000 ALTER TABLE `document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `postid` int NOT NULL AUTO_INCREMENT,
  `userid` int DEFAULT NULL,
  `postcontent` varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `postname` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stepsid` int DEFAULT NULL,
  PRIMARY KEY (`postid`),
  KEY `userid_idx` (`userid`),
  KEY `stepsid` (`stepsid`),
  CONSTRAINT `stepsid` FOREIGN KEY (`stepsid`) REFERENCES `steps` (`stepsid`),
  CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (1,1,'Just moved to a new address in Tokyo. What are the required documents?','2023-01-01','New Tokyo address',1),(2,2,'Registered my new address successfully. Here are the steps I followed:','2023-01-02','Passport update',2),(3,1,'ABC','2023-12-12','Help me',6),(4,1,'132s','2023-12-12','Help me',3),(5,1,'jjkkjjk','2023-12-14','jjj',1),(6,1,'uiuiuiu','2024-01-16','hhh',14);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `steps`
--

DROP TABLE IF EXISTS `steps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `steps` (
  `stepsid` int NOT NULL AUTO_INCREMENT,
  `stepsno` int DEFAULT NULL,
  `stepsname` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stepspic` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documentid` int DEFAULT NULL,
  PRIMARY KEY (`stepsid`),
  KEY `documentid_idx` (`documentid`),
  CONSTRAINT `documentid` FOREIGN KEY (`documentid`) REFERENCES `document` (`documentid`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `steps`
--

LOCK TABLES `steps` WRITE;
/*!40000 ALTER TABLE `steps` DISABLE KEYS */;
INSERT INTO `steps` VALUES (1,1,'Visit the local ward office',NULL,1),(2,2,'Submit Residence Registration Form',NULL,1),(3,3,'Provide Proof of Address and Identification',NULL,1),(4,1,'Visit the local ward office',NULL,2),(5,2,'Submit Residence Registration Form',NULL,2),(6,3,'Receive Confirmation and Documentation',NULL,2),(14,NULL,'date of transfer','date of transfer.png',11),(15,NULL,'address new and old','address new and old.png',11),(16,NULL,'person who sent','person who sent.png',11),(17,NULL,'foreigner info','foreigner info.png',11);
/*!40000 ALTER TABLE `steps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `todo`
--

DROP TABLE IF EXISTS `todo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `todo` (
  `todoid` int NOT NULL AUTO_INCREMENT,
  `userid` int DEFAULT NULL,
  `todoname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`todoid`),
  KEY `todo_idx` (`userid`),
  CONSTRAINT `todo` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `todo`
--

LOCK TABLES `todo` WRITE;
/*!40000 ALTER TABLE `todo` DISABLE KEYS */;
/*!40000 ALTER TABLE `todo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `userid` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `userid_UNIQUE` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'JohnDoe','john.doe@example.com','password123',NULL,NULL),(2,'JaneSmith','jane.smith@example.com','securepass',NULL,NULL),(3,'Christopher Ivan Santoso','ivankurniawan2012@gmail.com','$2y$10$pob5KgzJlsFKA4REImFBv.HYvWlG5AKn/rhvCYLnEoLaaZKakEbOi','08130','English'),(4,NULL,NULL,'$2y$10$nFzWUNtEzvTLM.teUnuXSuf1wpcg17LGUXcjFsfpGJ/.QXur7zPV2',NULL,NULL),(5,NULL,NULL,'$2y$10$NTq/g94JNvHQKoNN0o1gtuSypSaresaHGg05E22TrW6jl9cnrDpES',NULL,NULL),(6,'test','test@gmail.com','$2y$10$2pTbPdXadcs5eK9FrZZ4oOddA1uh5V.6r7x/b6rFo0v4XPV3iGTHu','12345','English');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-16  9:56:08
