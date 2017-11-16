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
-- Table structure for table `on_air24h`
--

DROP TABLE IF EXISTS `on_air24h`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `on_air24h` (
  `k_id_24h_real` int(11) NOT NULL AUTO_INCREMENT,
  `k_id_onair` int(11) DEFAULT NULL,
  `d_start24h` timestamp NULL DEFAULT NULL,
  `d_start_temp` timestamp NULL DEFAULT NULL,
  `k_id_follow_up_24h` int(11) DEFAULT NULL,
  `d_fin24h` datetime DEFAULT NULL,
  `n_comentario` varchar(1000) DEFAULT NULL,
  `i_timestamp` bigint(20) NOT NULL DEFAULT '0',
  `i_round` int(11) NOT NULL DEFAULT '0',
  `i_percent` tinyint(1) NOT NULL DEFAULT '0',
  `i_state` tinyint(1) NOT NULL DEFAULT '0',
  `i_hours` int(11) DEFAULT '0',
  `d_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`k_id_24h_real`),
  KEY `fk_follow_24h` (`k_id_follow_up_24h`),
  KEY `fk_on_air_24h` (`k_id_onair`),
  CONSTRAINT `fk_follow_24h` FOREIGN KEY (`k_id_follow_up_24h`) REFERENCES `follow_up_24h` (`k_id_follow_up_24h`),
  CONSTRAINT `fk_on_air_24h` FOREIGN KEY (`k_id_onair`) REFERENCES `ticket_on_air` (`k_id_onair`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `on_air24h`
--

LOCK TABLES `on_air24h` WRITE;
/*!40000 ALTER TABLE `on_air24h` DISABLE KEYS */;
/*!40000 ALTER TABLE `on_air24h` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-16  0:47:07
