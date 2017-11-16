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
-- Table structure for table `scaled_on_air`
--

DROP TABLE IF EXISTS `scaled_on_air`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scaled_on_air` (
  `k_id_scaled_on_air` int(11) NOT NULL AUTO_INCREMENT,
  `k_id_onair` int(11) DEFAULT NULL,
  `k_id_sacled` int(11) DEFAULT NULL,
  `d_time_escalado` varchar(100) DEFAULT NULL,
  `d_fecha_escalado` datetime DEFAULT NULL,
  `i_cont_esc_imp` int(11) DEFAULT NULL,
  `time_esc_imp` int(11) DEFAULT NULL,
  `i_cont_esc_rf` int(11) DEFAULT NULL,
  `i_time_esc_rf` int(11) DEFAULT NULL,
  `cont_esc_npo` int(11) DEFAULT NULL,
  `i_time_esc_npo` int(11) DEFAULT NULL,
  `cont_esc_care` int(11) DEFAULT NULL,
  `i_time_esc_care` int(11) DEFAULT NULL,
  `i_cont_esc_gdrt` int(11) DEFAULT NULL,
  `i_time_esc_gdrt` int(11) DEFAULT NULL,
  `i_cont_esc_oym` int(11) DEFAULT NULL,
  `time_esc_oym` int(11) DEFAULT NULL,
  `cont_esc_calidad` int(11) DEFAULT NULL,
  `i_time_esc_calidad` int(11) DEFAULT NULL,
  `n_tipificacion_solucion` varchar(100) DEFAULT NULL,
  `n_detalle_solucion` varchar(300) DEFAULT NULL,
  `n_ultimo_subestado_de_escalamiento` varchar(100) DEFAULT NULL,
  `n_round` int(11) DEFAULT NULL,
  `n_atribuible_nokia` varchar(100) DEFAULT NULL,
  `n_atribuible_nokia2` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`k_id_scaled_on_air`),
  KEY `fk_on_air_scaled` (`k_id_onair`),
  KEY `fk_scaled_real` (`k_id_sacled`),
  CONSTRAINT `fk_on_air_scaled` FOREIGN KEY (`k_id_onair`) REFERENCES `ticket_on_air` (`k_id_onair`),
  CONSTRAINT `fk_scaled_real` FOREIGN KEY (`k_id_sacled`) REFERENCES `scaled` (`k_id_sacled`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scaled_on_air`
--

LOCK TABLES `scaled_on_air` WRITE;
/*!40000 ALTER TABLE `scaled_on_air` DISABLE KEYS */;
/*!40000 ALTER TABLE `scaled_on_air` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-16  0:47:08
