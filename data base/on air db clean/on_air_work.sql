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
-- Table structure for table `work`
--

DROP TABLE IF EXISTS `work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `work` (
  `k_id_work` int(11) NOT NULL,
  `n_name_ork` varchar(200) NOT NULL,
  PRIMARY KEY (`k_id_work`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work`
--

LOCK TABLES `work` WRITE;
/*!40000 ALTER TABLE `work` DISABLE KEYS */;
INSERT INTO `work` VALUES (1,'Adecuación LTE-Overlay-para LTE'),(2,'Adecuaciones SE '),(3,'Cambio de HW LTE'),(4,'Cambio de HW para MC - Upgrade Modulos RF'),(5,'Cambio de HW para MC_3G-LTE-MMR'),(6,'Cambio de Jumper en Feeder_CP 5P'),(7,'Cambio de Jumper y Breaker Huawei'),(8,'Cambio de Jumper y Breaker_3P-CP-5P'),(9,'Cambio de Jumper y RRU'),(10,'Channel Element'),(11,'Channel Element + Upgrade Modulos RF'),(12,'Channel Element_5P-CP- 5P + RF'),(13,'Modernización Multiradio'),(14,'Reubicación'),(15,'Reubicacion de Equipos'),(16,'RF Sharing a Dedicado'),(17,'Rollback SI APLICA 3G'),(18,'Sector Expasion 2G-3G-LTE'),(19,'Sector Expasion Huawei'),(20,'Segundo Nodo'),(21,'Sitio Nuevo 2G'),(22,'Sitio Nuevo 2G Huawei'),(23,'Sitio Nuevo 3G'),(24,'Sitio Nuevo 3G Huawei'),(25,'Sitio Nuevo LTE'),(26,'Sitio Nuevo LTE Huawei'),(27,'SWAP'),(28,'Swap Antenas Capa 4-5'),(29,'Tercera - Cuarta - Quinta Portadora '),(30,'Tercera - Cuarta - Quinta Portadora Huawei ');
/*!40000 ALTER TABLE `work` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-16  0:47:10
