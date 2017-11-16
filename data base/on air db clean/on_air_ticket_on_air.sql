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
-- Table structure for table `ticket_on_air`
--

DROP TABLE IF EXISTS `ticket_on_air`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_on_air` (
  `k_id_onair` int(11) NOT NULL AUTO_INCREMENT,
  `k_id_status_onair` int(11) DEFAULT NULL,
  `k_id_work` int(11) DEFAULT NULL,
  `k_id_preparation` int(11) DEFAULT NULL,
  `k_id_station` int(11) DEFAULT NULL,
  `k_id_technology` int(11) DEFAULT NULL,
  `k_id_band` int(11) DEFAULT NULL,
  `k_id_precheck` int(11) DEFAULT NULL,
  `b_excpetion_gri` tinyint(1) DEFAULT NULL,
  `d_fecha_ultima_rev` datetime DEFAULT NULL,
  `d_desbloqueo` datetime DEFAULT NULL,
  `d_bloqueo` datetime DEFAULT NULL,
  `n_reviewedfo` varchar(100) DEFAULT NULL,
  `d_fechaproduccion` datetime DEFAULT NULL,
  `n_sectoresbloqueados` varchar(100) DEFAULT NULL,
  `n_sectoresdesbloqueados` varchar(100) DEFAULT NULL,
  `n_estadoonair` varchar(100) DEFAULT 'NO ON AIR',
  `n_atribuible_nokia` varchar(100) DEFAULT NULL,
  `n_kpis_degraded` varchar(1000) DEFAULT NULL,
  `n_atribuible_nokia2` varchar(100) DEFAULT NULL,
  `n_kpi1` varchar(100) DEFAULT NULL,
  `n_kpi2` varchar(100) DEFAULT NULL,
  `n_kpi3` varchar(100) DEFAULT NULL,
  `n_kpi4` varchar(100) DEFAULT NULL,
  `i_valor_kpi1` varchar(100) DEFAULT NULL,
  `i_valor_kpi2` varchar(100) DEFAULT NULL,
  `i_valor_kpi3` varchar(100) DEFAULT NULL,
  `i_valor_kpi4` varchar(100) DEFAULT NULL,
  `n_alarma1` varchar(20) DEFAULT NULL,
  `n_alarma2` varchar(20) DEFAULT NULL,
  `n_alarma3` varchar(20) DEFAULT NULL,
  `n_alarma4` varchar(20) DEFAULT NULL,
  `i_cont_total_escalamiento` int(11) DEFAULT NULL,
  `i_time_total_escalamiento` int(11) DEFAULT NULL,
  `i_lider_cambio` varchar(100) DEFAULT NULL,
  `i_lider_cuadrilla` varchar(100) DEFAULT NULL,
  `n_implementacion_campo` varchar(20) DEFAULT NULL,
  `n_doc` varchar(20) DEFAULT NULL,
  `n_gestion_power` varchar(20) DEFAULT NULL,
  `n_obra_civil` varchar(20) DEFAULT NULL,
  `on_air` varchar(20) DEFAULT NULL,
  `fecha_rft` datetime DEFAULT NULL,
  `d_fecha_cg` datetime DEFAULT NULL,
  `n_exclusion_bajo_trafico` varchar(100) DEFAULT NULL,
  `n_ticket` varchar(100) DEFAULT NULL,
  `n_estado_ticket` varchar(100) DEFAULT NULL,
  `n_sln_modernizacion` varchar(100) DEFAULT NULL,
  `n_en_prorroga` varchar(100) DEFAULT 'FALSE',
  `n_cont_prorrogas` int(11) DEFAULT NULL,
  `n_noc` varchar(100) DEFAULT NULL,
  `n_round` int(11) DEFAULT NULL,
  `d_finish` datetime DEFAULT NULL,
  `d_temporal` datetime DEFAULT NULL,
  `d_actualizacion_final` datetime DEFAULT NULL,
  `d_asignacion_final` datetime DEFAULT NULL,
  `i_precheck_realizado` int(11) DEFAULT NULL,
  `n_comentario_coor` varchar(1000) DEFAULT NULL,
  `i_actualEngineer` int(11) DEFAULT NULL,
  PRIMARY KEY (`k_id_onair`),
  KEY `fk_on_air_band` (`k_id_band`),
  KEY `fk_on_air_precheck` (`k_id_precheck`),
  KEY `fk_on_air_prep_stage` (`k_id_preparation`),
  KEY `fk_on_air_station` (`k_id_station`),
  KEY `fk_on_air_status` (`k_id_status_onair`),
  KEY `fk_on_air_technology` (`k_id_technology`),
  KEY `fk_on_air_work` (`k_id_work`),
  CONSTRAINT `fk_on_air_band` FOREIGN KEY (`k_id_band`) REFERENCES `band` (`k_id_band`),
  CONSTRAINT `fk_on_air_precheck` FOREIGN KEY (`k_id_precheck`) REFERENCES `precheck` (`k_id_precheck`),
  CONSTRAINT `fk_on_air_prep_stage` FOREIGN KEY (`k_id_preparation`) REFERENCES `preparation_stage` (`k_id_preparation`),
  CONSTRAINT `fk_on_air_station` FOREIGN KEY (`k_id_station`) REFERENCES `station` (`k_id_station`),
  CONSTRAINT `fk_on_air_status` FOREIGN KEY (`k_id_status_onair`) REFERENCES `status_on_air` (`k_id_status_onair`),
  CONSTRAINT `fk_on_air_technology` FOREIGN KEY (`k_id_technology`) REFERENCES `technology` (`k_id_technology`),
  CONSTRAINT `fk_on_air_work` FOREIGN KEY (`k_id_work`) REFERENCES `work` (`k_id_work`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_on_air`
--

LOCK TABLES `ticket_on_air` WRITE;
/*!40000 ALTER TABLE `ticket_on_air` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_on_air` ENABLE KEYS */;
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
