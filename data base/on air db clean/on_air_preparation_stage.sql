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
-- Table structure for table `preparation_stage`
--

DROP TABLE IF EXISTS `preparation_stage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preparation_stage` (
  `k_id_preparation` int(11) NOT NULL AUTO_INCREMENT,
  `n_bcf_wbts_id` varchar(100) DEFAULT NULL,
  `n_bts_id` varchar(100) DEFAULT NULL,
  `d_ingreso_on_air` datetime DEFAULT NULL,
  `b_vistamm` tinyint(1) DEFAULT NULL,
  `n_enteejecutor` varchar(100) DEFAULT NULL,
  `n_controlador` varchar(100) DEFAULT NULL,
  `n_idcontrolador` varchar(100) DEFAULT NULL,
  `d_correccionespendientes` datetime DEFAULT NULL,
  `n_btsipaddress` varchar(100) DEFAULT NULL,
  `n_integrador` varchar(100) DEFAULT NULL,
  `n_wp` varchar(100) DEFAULT NULL,
  `n_crq` varchar(100) DEFAULT NULL,
  `n_testgestion` varchar(100) DEFAULT NULL,
  `n_sitiolimpio` varchar(100) DEFAULT NULL,
  `n_instalacion_hw_sitio` varchar(100) DEFAULT NULL,
  `n_cambios_config_solicitados` varchar(100) DEFAULT NULL,
  `n_cambios_config_final` varchar(100) DEFAULT NULL,
  `n_contratista` varchar(100) DEFAULT NULL,
  `n_comentarioccial` varchar(1000) DEFAULT NULL,
  `n_ticketremedy` varchar(100) DEFAULT NULL,
  `n_lac` varchar(100) DEFAULT NULL,
  `n_rac` varchar(100) DEFAULT NULL,
  `n_sac` varchar(100) DEFAULT NULL,
  `n_integracion_gestion_y_trafica` varchar(100) DEFAULT NULL,
  `puesta_servicio_sitio_nuevo_lte` varchar(100) DEFAULT NULL,
  `n_instalacion_hw_4g_sitio` varchar(100) DEFAULT NULL,
  `pre_launch` varchar(100) DEFAULT NULL,
  `n_evidenciasl` varchar(100) DEFAULT NULL,
  `idenciasl` varchar(100) DEFAULT NULL,
  `i_week` int(11) DEFAULT NULL,
  `id_notificacion` varchar(100) DEFAULT NULL,
  `id_documentacion` varchar(100) DEFAULT NULL,
  `id_rftools` varchar(100) DEFAULT NULL,
  `n_evidenciatg` varchar(100) DEFAULT NULL,
  `n_comentario_doc` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`k_id_preparation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preparation_stage`
--

LOCK TABLES `preparation_stage` WRITE;
/*!40000 ALTER TABLE `preparation_stage` DISABLE KEYS */;
/*!40000 ALTER TABLE `preparation_stage` ENABLE KEYS */;
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
