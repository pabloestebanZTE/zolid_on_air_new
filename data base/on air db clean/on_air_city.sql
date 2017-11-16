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
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city` (
  `k_id_city` int(11) NOT NULL,
  `k_id_regional` int(11) DEFAULT NULL,
  `n_name_city` varchar(100) NOT NULL,
  PRIMARY KEY (`k_id_city`),
  KEY `fk_city_reg` (`k_id_regional`),
  CONSTRAINT `fk_city_reg` FOREIGN KEY (`k_id_regional`) REFERENCES `regional` (`k_id_regional`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` VALUES (1,1,'Bogota'),(2,1,'Chia'),(3,1,'Cundinamarca'),(4,1,'San Andres'),(5,1,'Soacha'),(6,2,'Atlantico'),(7,2,'Barranquilla'),(8,2,'Bolivar'),(9,2,'Cartagena'),(10,2,'Cesar'),(11,2,'Cordoba'),(12,2,'Guajira'),(13,2,'Magdalena'),(14,2,'Monteria'),(15,2,'Sincelejo'),(16,2,'Sucre'),(17,2,'Valledupar'),(18,3,'Antioquia'),(19,3,'Caldas'),(20,3,'Cauca'),(21,3,'Choco'),(22,3,'Medellin'),(23,3,'Pereira'),(24,3,'Quindio'),(25,3,'Risaralda'),(26,4,'Barrancabermeja'),(27,4,'Boyaca'),(28,4,'Bucaramanga'),(29,4,'Cucuta'),(30,4,'Norte de Santander'),(31,4,'Santander'),(32,4,'Tunja'),(33,5,'Arauca'),(34,5,'Casanare'),(35,5,'Chia'),(36,5,'Cundinamarca'),(37,5,'Girardot'),(38,5,'Meta'),(39,5,'Vichada'),(40,5,'Villavicencio'),(41,5,'Yopal'),(42,6,'Buenaventura'),(43,6,'Cali'),(44,6,'Caqueta'),(45,6,'Cauca'),(46,6,'Cucuta'),(47,6,'Florencia'),(48,6,'Huila'),(49,6,'Ibague'),(50,6,'Nariño'),(51,6,'Popayan'),(52,6,'Putumayo'),(53,6,'Santander'),(54,6,'Tolima'),(55,6,'Tulua'),(56,6,'Valle'),(57,6,'Valle del Cauca');
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-16  0:47:09
