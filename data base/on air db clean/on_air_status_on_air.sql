-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: on_air
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.25-MariaDB

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
-- Table structure for table `status_on_air`
--

DROP TABLE IF EXISTS `status_on_air`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status_on_air` (
  `k_id_status_onair` int(11) NOT NULL,
  `k_id_substatus` int(11) DEFAULT NULL,
  `k_id_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`k_id_status_onair`),
  KEY `fk_status_onair` (`k_id_substatus`),
  KEY `fk_substatus_onair` (`k_id_status`),
  CONSTRAINT `fk_status_onair` FOREIGN KEY (`k_id_substatus`) REFERENCES `substatus` (`k_id_substatus`),
  CONSTRAINT `fk_substatus_onair` FOREIGN KEY (`k_id_status`) REFERENCES `status` (`k_id_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_on_air`
--

LOCK TABLES `status_on_air` WRITE;
/*!40000 ALTER TABLE `status_on_air` DISABLE KEYS */;
INSERT INTO `status_on_air` VALUES (1,1,3),(2,1,4),(4,1,6),(5,1,7),(6,2,3),(7,2,4),(8,2,5),(10,2,7),(11,3,3),(12,3,4),(13,3,5),(14,3,6),(15,3,7),(16,4,3),(17,4,4),(18,4,5),(20,4,7),(21,5,3),(22,5,4),(23,5,5),(25,5,7),(26,6,3),(27,6,4),(28,6,5),(29,6,6),(31,7,1),(32,8,3),(33,8,4),(34,8,5),(35,8,6),(36,8,7),(37,9,2),(38,10,3),(39,10,4),(40,10,5),(42,10,7),(43,11,3),(44,11,4),(45,11,5),(48,12,3),(49,12,4),(50,12,5),(53,13,3),(54,13,4),(58,14,3),(59,14,4),(63,15,3),(64,15,4),(65,15,5),(68,16,3),(69,16,4),(70,16,5),(71,16,6),(72,16,7),(73,17,3),(74,17,4),(75,17,5),(76,17,6),(77,17,7),(78,18,9),(79,19,9),(80,20,9),(81,21,9),(82,22,9),(83,23,9),(84,24,8),(85,25,8),(86,26,8),(87,27,8),(88,28,8),(89,29,8),(90,30,10);
/*!40000 ALTER TABLE `status_on_air` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-16  0:47:11
