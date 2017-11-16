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
-- Table structure for table `substatus`
--

DROP TABLE IF EXISTS `substatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `substatus` (
  `k_id_substatus` int(11) NOT NULL,
  `n_name_substatus` varchar(100) NOT NULL,
  PRIMARY KEY (`k_id_substatus`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `substatus`
--

LOCK TABLES `substatus` WRITE;
/*!40000 ALTER TABLE `substatus` DISABLE KEYS */;
INSERT INTO `substatus` VALUES (1,'Adyacencias Faltantes'),(2,'Alarmas de energia'),(3,'Alarmas de HW'),(4,'Alarmas de Rx Sistema Radiante'),(5,'Alarmas de TX'),(6,'Alto RTWP'),(7,'Cancelado'),(8,'Degradacion KPI'),(9,'Desmontado'),(10,'Error comisionamiento BTS'),(11,'Error configuracion Acceso'),(12,'Error de instalacion'),(13,'Pendiente CRQ'),(14,'Pendiente Evidencias'),(15,'Pendiente Pruebas Alarmas'),(16,'Revision Parcial'),(17,'Sitio Fuera de Servicio'),(18,'Precheck'),(19,'Reinicio 12H'),(20,'Reinicio Precheck'),(21,'Seguimiento 12H'),(22,'Seguimiento 24H'),(23,'Seguimiento 36H'),(24,'Activacion Cuarta Portadora'),(25,'Pendiente ID RF Tools'),(26,'Pendiente Sitio Limpio'),(27,'Pendiente Tareas Remedy'),(28,'Pendiente Testgestion'),(29,'Produccion'),(30,'Temporal');
/*!40000 ALTER TABLE `substatus` ENABLE KEYS */;
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
