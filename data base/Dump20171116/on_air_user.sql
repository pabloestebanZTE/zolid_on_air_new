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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `k_id_user` int(11) NOT NULL,
  `n_name_user` varchar(150) NOT NULL,
  `n_last_name_user` varchar(150) NOT NULL,
  `n_username_user` varchar(100) NOT NULL,
  `n_mail_user` varchar(100) DEFAULT NULL,
  `i_phone_user` int(11) DEFAULT NULL,
  `i_cellphone_user` int(11) DEFAULT NULL,
  `n_password` varchar(30) DEFAULT NULL,
  `n_role_user` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`k_id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1000,'',' ',' ',NULL,NULL,NULL,NULL,NULL),(1001,'Alejandro Ortega',' ',' ',NULL,NULL,NULL,NULL,NULL),(1002,'Alexander Barrios',' ',' ',NULL,NULL,NULL,NULL,NULL),(1003,'Andres Chitan',' ',' ',NULL,NULL,NULL,NULL,NULL),(1004,'Andres Fabian Ortiz',' ',' ',NULL,NULL,NULL,NULL,NULL),(1005,'Andrés Fabián Ortiz',' ',' ',NULL,NULL,NULL,NULL,NULL),(1006,'Andrés Fabián Ortiz Vivero',' ',' ',NULL,NULL,NULL,NULL,NULL),(1007,'Andres Felipe Chitan',' ',' ',NULL,NULL,NULL,NULL,NULL),(1008,'Andres Gilberto Salas Cubillos',' ',' ',NULL,NULL,NULL,NULL,NULL),(1009,'Andrés Gilberto Salas Cubillos',' ',' ',NULL,NULL,NULL,NULL,NULL),(1010,'Andres Ortiz',' ',' ',NULL,NULL,NULL,NULL,NULL),(1011,'Andres Ortiz Viver',' ',' ',NULL,NULL,NULL,NULL,NULL),(1012,'Andres Ortiz Vivero',' ',' ',NULL,NULL,NULL,NULL,NULL),(1013,'Andres Ortiz Viveros',' ',' ',NULL,NULL,NULL,NULL,NULL),(1014,'Andres Salas',' ',' ',NULL,NULL,NULL,NULL,NULL),(1015,'Astrid  Meléndez',' ',' ',NULL,NULL,NULL,NULL,NULL),(1016,'Astrid Melendez',' ',' ',NULL,NULL,NULL,NULL,NULL),(1017,'Astrid Meléndez',' ',' ',NULL,NULL,NULL,NULL,NULL),(1018,'Astrid Meléndez.',' ',' ',NULL,NULL,NULL,NULL,NULL),(1019,'Carlos Felipe Triana Salinas',' ',' ',NULL,NULL,NULL,NULL,NULL),(1020,'Carlos Mendoza',' ',' ',NULL,NULL,NULL,NULL,NULL),(1021,'Carlos Omar Ortiz Arevalo',' ',' ',NULL,NULL,NULL,NULL,NULL),(1022,'CARLOS ORRTIZ',' ',' ',NULL,NULL,NULL,NULL,NULL),(1023,'Carlos Ortiz',' ',' ',NULL,NULL,NULL,NULL,NULL),(1024,'CAROLINA MANTILLA',' ',' ',NULL,NULL,NULL,NULL,NULL),(1025,'Carolina Naranjo',' ',' ',NULL,NULL,NULL,NULL,NULL),(1026,'Christian Motta',' ',' ',NULL,NULL,NULL,NULL,NULL),(1027,'DARWIN ROSO',' ',' ',NULL,NULL,NULL,NULL,NULL),(1028,'Darwin Rozo',' ',' ',NULL,NULL,NULL,NULL,NULL),(1029,'Diana Bocarejo',' ',' ',NULL,NULL,NULL,NULL,NULL),(1030,'Diego Ledesma',' ',' ',NULL,NULL,NULL,NULL,NULL),(1031,'Diego Ledezma',' ',' ',NULL,NULL,NULL,NULL,NULL),(1032,'Duban Garzón Velandia',' ',' ',NULL,NULL,NULL,NULL,NULL),(1033,'Earlys Gutierrez',' ',' ',NULL,NULL,NULL,NULL,NULL),(1034,'Earlys Gutierrez.',' ',' ',NULL,NULL,NULL,NULL,NULL),(1035,'Edna Quidley Rivera Cifuentes',' ',' ',NULL,NULL,NULL,NULL,NULL),(1036,'Edna Rivera',' ',' ',NULL,NULL,NULL,NULL,NULL),(1037,'ergio Andres Camacho Amarillo',' ',' ',NULL,NULL,NULL,NULL,NULL),(1038,'Erika Paola Hernandez Suarique',' ',' ',NULL,NULL,NULL,NULL,NULL),(1039,'Fabian Peña',' ',' ',NULL,NULL,NULL,NULL,NULL),(1040,'Fabio Nelson García Torres',' ',' ',NULL,NULL,NULL,NULL,NULL),(1041,'Franancisco Javier Zapata Sanabria',' ',' ',NULL,NULL,NULL,NULL,NULL),(1042,'Francisco Javier Zapata',' ',' ',NULL,NULL,NULL,NULL,NULL),(1043,'Francisco Javier Zapata  Sanabria',' ',' ',NULL,NULL,NULL,NULL,NULL),(1044,'Francisco Javier Zapata Sanabria',' ',' ',NULL,NULL,NULL,NULL,NULL),(1045,'Francisco Peña',' ',' ',NULL,NULL,NULL,NULL,NULL),(1046,'FRANCISCO ZAPATA',' ',' ',NULL,NULL,NULL,NULL,NULL),(1047,'Franklin Roberto Chacon Mendez',' ',' ',NULL,NULL,NULL,NULL,NULL),(1048,'Gustavo Angarita',' ',' ',NULL,NULL,NULL,NULL,NULL),(1049,'Helver Chaparro',' ',' ',NULL,NULL,NULL,NULL,NULL),(1050,'Ivan Mauricio Ochoa Salamanca',' ',' ',NULL,NULL,NULL,NULL,NULL),(1051,'Ivan Ochoa',' ',' ',NULL,NULL,NULL,NULL,NULL),(1052,'JAIDITH RIOS',' ',' ',NULL,NULL,NULL,NULL,NULL),(1053,'Jaidith ríos',' ',' ',NULL,NULL,NULL,NULL,NULL),(1054,'Jairo Andres Fajardo Mendoza',' ',' ',NULL,NULL,NULL,NULL,NULL),(1055,'Javier Alonso Romero García',' ',' ',NULL,NULL,NULL,NULL,NULL),(1056,'Javier Sebastian Torres',' ',' ',NULL,NULL,NULL,NULL,NULL),(1057,'Javier Sebastian Torres morales',' ',' ',NULL,NULL,NULL,NULL,NULL),(1058,'Jennifer Barragan',' ',' ',NULL,NULL,NULL,NULL,NULL),(1059,'Jennifer Barragan Rincon',' ',' ',NULL,NULL,NULL,NULL,NULL),(1060,'Jhon Alexander Sanchez',' ',' ',NULL,NULL,NULL,NULL,NULL),(1061,'jhon Alexander Sanchez Quintero',' ',' ',NULL,NULL,NULL,NULL,NULL),(1062,'Jhon davis naranjo',' ',' ',NULL,NULL,NULL,NULL,NULL),(1063,'Jhon Diego Ledesma',' ',' ',NULL,NULL,NULL,NULL,NULL),(1064,'Jhon Diego Ledesma C',' ',' ',NULL,NULL,NULL,NULL,NULL),(1065,'Jhon Diego Ledesma Castano',' ',' ',NULL,NULL,NULL,NULL,NULL),(1066,'Jhon Diego Ledesma Castaño',' ',' ',NULL,NULL,NULL,NULL,NULL),(1067,'Jhon Diego Ledezma',' ',' ',NULL,NULL,NULL,NULL,NULL),(1068,'Jhon Enciso',' ',' ',NULL,NULL,NULL,NULL,NULL),(1069,'jhon encizo',' ',' ',NULL,NULL,NULL,NULL,NULL),(1070,'JhOon Diego Ledesma Castaño',' ',' ',NULL,NULL,NULL,NULL,NULL),(1071,'Jidith Mirleidys Rios Guzmán',' ',' ',NULL,NULL,NULL,NULL,NULL),(1072,'Joan David Rodríguez Toro',' ',' ',NULL,NULL,NULL,NULL,NULL),(1073,'Johanna Paola Mesa',' ',' ',NULL,NULL,NULL,NULL,NULL),(1074,'Johanna Paola Mesa Sarmiento',' ',' ',NULL,NULL,NULL,NULL,NULL),(1075,'Johanna Paola Mesa Sarmiento.',' ',' ',NULL,NULL,NULL,NULL,NULL),(1076,'Johanna Paola. Mesa Sarmiento',' ',' ',NULL,NULL,NULL,NULL,NULL),(1077,'John Naranjo',' ',' ',NULL,NULL,NULL,NULL,NULL),(1078,'Jonathan David Leguizamón',' ',' ',NULL,NULL,NULL,NULL,NULL),(1079,'Jonathan David Leguizamón Turca',' ',' ',NULL,NULL,NULL,NULL,NULL),(1080,'Jorge Cantor',' ',' ',NULL,NULL,NULL,NULL,NULL),(1081,'Jorge Guillermo Vega',' ',' ',NULL,NULL,NULL,NULL,NULL),(1082,'Jorge Orlando Cantor',' ',' ',NULL,NULL,NULL,NULL,NULL),(1083,'Jorge Orlando Cantor Henao',' ',' ',NULL,NULL,NULL,NULL,NULL),(1084,'Jorge Romero',' ',' ',NULL,NULL,NULL,NULL,NULL),(1085,'Jorge Vega',' ',' ',NULL,NULL,NULL,NULL,NULL),(1086,'Jose David Sierra Lara',' ',' ',NULL,NULL,NULL,NULL,NULL),(1087,'Juan David Gonzalez',' ',' ',NULL,NULL,NULL,NULL,NULL),(1088,'Juan David Gonzalez Caballero',' ',' ',NULL,NULL,NULL,NULL,NULL),(1089,'Juan David Ospina Díaz',' ',' ',NULL,NULL,NULL,NULL,NULL),(1090,'Juan Ospina',' ',' ',NULL,NULL,NULL,NULL,NULL),(1091,'Lenin Joel Pinzón',' ',' ',NULL,NULL,NULL,NULL,NULL),(1092,'Lenin Joel Pinzón Santos',' ',' ',NULL,NULL,NULL,NULL,NULL),(1093,'LICETH PACHECO P.',' ',' ',NULL,NULL,NULL,NULL,NULL),(1094,'Lorena Diaz',' ',' ',NULL,NULL,NULL,NULL,NULL),(1095,'Lorena Sotomonte',' ',' ',NULL,NULL,NULL,NULL,NULL),(1096,'Luis Alejandro Ortega',' ',' ',NULL,NULL,NULL,NULL,NULL),(1097,'Luis Alejandro Ortega Garcia',' ',' ',NULL,NULL,NULL,NULL,NULL),(1098,'Luis Carlos Hidalgo',' ',' ',NULL,NULL,NULL,NULL,NULL),(1099,'Luis Carlos Hidalgo Rengifo',' ',' ',NULL,NULL,NULL,NULL,NULL),(1100,'Luis.Carlos.Hidalgo.Rengifo',' ',' ',NULL,NULL,NULL,NULL,NULL),(1101,'Manuel Eslava',' ',' ',NULL,NULL,NULL,NULL,NULL),(1102,'Manuel Francisco Peña Belalcazar',' ',' ',NULL,NULL,NULL,NULL,NULL),(1103,'Maria Lorena Diaz',' ',' ',NULL,NULL,NULL,NULL,NULL),(1104,'María Lorena Díaz Borray',' ',' ',NULL,NULL,NULL,NULL,NULL),(1105,'Martinez Hever Moncayo',' ',' ',NULL,NULL,NULL,NULL,NULL),(1106,'Mauricio Rodriguez',' ',' ',NULL,NULL,NULL,NULL,NULL),(1107,'Nelson Cetina',' ',' ',NULL,NULL,NULL,NULL,NULL),(1108,'Nestor Alexander Rodriguez',' ',' ',NULL,NULL,NULL,NULL,NULL),(1109,'Nestor Alexander Rodríguez',' ',' ',NULL,NULL,NULL,NULL,NULL),(1110,'Nestor Rodríguez',' ',' ',NULL,NULL,NULL,NULL,NULL),(1111,'Octavio Torrado',' ',' ',NULL,NULL,NULL,NULL,NULL),(1112,'Octavio Torrado Quintero',' ',' ',NULL,NULL,NULL,NULL,NULL),(1113,'OSCAR ALEJANDRO BELTRAN',' ',' ',NULL,NULL,NULL,NULL,NULL),(1114,'Oscar Beltran',' ',' ',NULL,NULL,NULL,NULL,NULL),(1115,'Oscar Cañon',' ',' ',NULL,NULL,NULL,NULL,NULL),(1116,'Oscar Cañón',' ',' ',NULL,NULL,NULL,NULL,NULL),(1117,'Oscar Javier Ruiz',' ',' ',NULL,NULL,NULL,NULL,NULL),(1118,'Oscar Javier Ruiz Gil',' ',' ',NULL,NULL,NULL,NULL,NULL),(1119,'PAOLA MESA',' ',' ',NULL,NULL,NULL,NULL,NULL),(1120,'Rafael Acosta Carvajal',' ',' ',NULL,NULL,NULL,NULL,NULL),(1121,'Rafael Sanchez',' ',' ',NULL,NULL,NULL,NULL,NULL),(1122,'Rafael Sanchez',' ',' ',NULL,NULL,NULL,NULL,NULL),(1123,'rancisco Javier Zapata Sanabria',' ',' ',NULL,NULL,NULL,NULL,NULL),(1124,'Raul Zuñiga',' ',' ',NULL,NULL,NULL,NULL,NULL),(1125,'Raúl Zuñiga',' ',' ',NULL,NULL,NULL,NULL,NULL),(1126,'Raúl Zúñiga',' ',' ',NULL,NULL,NULL,NULL,NULL),(1127,'Ronald Jardim',' ',' ',NULL,NULL,NULL,NULL,NULL),(1128,'RONALD JARDIN',' ',' ',NULL,NULL,NULL,NULL,NULL),(1129,'Sandra Montero',' ',' ',NULL,NULL,NULL,NULL,NULL),(1130,'Sandra Pico',' ',' ',NULL,NULL,NULL,NULL,NULL),(1131,'SERGIO ANDRES CAMACHO',' ',' ',NULL,NULL,NULL,NULL,NULL),(1132,'Sergio Andrés Camacho',' ',' ',NULL,NULL,NULL,NULL,NULL),(1133,'Sergio Andres Camacho Amarillo',' ',' ',NULL,NULL,NULL,NULL,NULL),(1134,'Sergio Andres Camacho Amarillo.',' ',' ',NULL,NULL,NULL,NULL,NULL),(1135,'Sergio Andres Camacho Camacho',' ',' ',NULL,NULL,NULL,NULL,NULL),(1136,'STAVO ANGARITA',' ',' ',NULL,NULL,NULL,NULL,NULL),(1137,'uan David Gonzalez Caballero',' ',' ',NULL,NULL,NULL,NULL,NULL),(1138,'WILLIAM AMADO',' ',' ',NULL,NULL,NULL,NULL,NULL),(1139,'William Diaz Cobos',' ',' ',NULL,NULL,NULL,NULL,NULL),(1140,'WILLIAM LEONARDO DIAZ COBOS',' ',' ',NULL,NULL,NULL,NULL,NULL),(1141,'William Leonardo Díaz Cobos',' ',' ',NULL,NULL,NULL,NULL,NULL),(1142,'William Mauricio Amado',' ',' ',NULL,NULL,NULL,NULL,NULL),(1143,'William Mauricio Amado Rodriguez',' ',' ',NULL,NULL,NULL,NULL,NULL),(1144,'William Mauricio Amado Rodríguez',' ',' ',NULL,NULL,NULL,NULL,NULL),(1145,'Yolaima Vergel',' ',' ',NULL,NULL,NULL,NULL,NULL),(5829019,'JUAN CARLOS','GUTIERREZ GUTIERREZ','jcgutierrezg','Juan.Gutierrezg.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(7182918,'MAURICIO','HERRERA NEIRA ','mherreran','Mauricio.Herrera.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(7731175,'DIEGO FERNANDO','PARRADO BARRIOS','dfparradob','Diego.Parrado.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(10756694,'LUIS CARLOS ','HIDALGO RENGIFO','lchidalgor','Luis.Hidalgo.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(13703881,'FRANKLIN ROBERTO','CHACON MENDEZ','frchaconm','Franklin.Chaconm.Ext@claro.com.co',1,1,'abc123','Coordinador'),(56771859,'RAUL','ZUÑIGA','rzuñiga','NO',1,1,'abc123','Ingeniero'),(63556518,'EDNA QUIDLEY ','RIVERA CIFUENTES','eqriverac','NO',1,1,'abc123','Ingeniero'),(74859920,'VICTOR HUGO','TORRES ARENAS','vhtorresa','NO',1,1,'abc123','Ingeniero'),(79351878,'HERNANDO','LARROTA MARTINEZ','hlarrotam','Hernando.Larrota.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(79555523,'NELSON ORLANDO','CASTRO HERNANDEZ','nocastroh','NO',1,1,'abc123','Ingeniero'),(79903226,'MIGUEL ANGEL ','URREA GELVEZ','maurreag','Joan.Rodriguez.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(79953655,'JUAN FELIPE','VALENCIA BOHORQUEZ','jfvalenciab','Juan.Valencia.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(79972714,'OSCAR ALEJANDRO','BELTRAN MORENO','oabeltranm','Oscar.Beltranm.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(80052296,'OSCAR','VANEGAS LANDINEZ','ovanegasl','Oscar.Vanegas.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(80070973,'FABIO NELSON','GARCIA TORRES','fngarciat','Fabio.Garciat.Ext@claro.com.co',1,1,'abc123','Documentador'),(80094721,'DANIEL JOSE','CASTRILLON PUENTES','djcastrillonp','Daniel.Castrillon.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(80118555,'ANDRES GILBERTO','SALAS CUBILLOS','agsalasc','Andres.Salas.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(80167627,'MICHAEL ANTONIO','FRANCO RAMIREZ','mafrancor','Michael.Francor.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(80214552,'JEISSON ANDRES','GALLEGO CASTILLO','jagallegoc','Jeisson.Gallego.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(80245877,'OSCAR JAVIER','RUIZ GIL','ojruizg','Oscar.Ruiz.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(80255600,'JORGE ORLANDO','CANTOR','jocantor','Jorge.Cantor.ext@claro.com.co',1,1,'abc123','Ingeniero'),(80723336,'MANUEL VICENTE ','PARDO GÓMEZ','mvpardog','Manuel.Pardog.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(80731105,'JHON JAIRO','DIMATE BOHORQUEZ','jjdimateb','Jhon.Dimate.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(80732480,'WILSON FERNANDO','OSORIO GUZMÁN','wfosoriog','Wilson.Osorio.ext@claro.com.co',1,1,'abc123','Ingeniero'),(80750965,'EDWIN DAVID','RODRIGUEZ DUARTE','edrodriguezd','Edwin.Rodriguez.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(80763541,'ALBEIRO','FORERO MALDONADO','aforerom','Albeiro.Forero.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(80821773,'HEVER','MONCAYO MARTINEZ','hmoncayom','Hever.Moncayom.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(80842787,'OSWALDO ALEXIS','SILVA GUILLEN','oasilvag','Oswaldo.Silva.ext@claro.com.co',1,1,'abc123','Ingeniero'),(80845660,'GUILLERMO ALBERTO','ROJAS GUTIERREZ','garojasg','Guillermo.Rojas.ext@claro.com.co',1,1,'abc123','Ingeniero'),(80859728,'WILLIAM LEONARDO','DIAZ COBOS','wldiazc','William.Diaz.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(1010192663,'OSCAR ALEXIS','GARZON PARRA','oagarzonp','Oscar.Garzonp.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(1010212242,'JUAN DAVID','OSPINA DIAZ ','jdospinad','NO',1,1,'abc123','Ingeniero'),(1012369910,'DARWIN JOAN','ROSO FRANCO','djrosof','NO',1,1,'abc123','Ingeniero'),(1014233450,'JOAN DAVID','RODRIGUEZ TORO','jdrodriguezt','Joan.Rodriguez.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(1015397820,'ADRIAN ORLANDO','CLAVIJO ROMERO','aoclavijor','Adrian.Clavijo.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(1015413292,'SEBASTIAN','VARGAS VELASQUEZ','svargasv','Sebastian.Vargasv.ext@claro.com.co',1,1,'abc123','Ingeniero'),(1015994636,'LENIN JOEL','PINZON','ljpinzon','Lenin.Pinzon.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(1016020742,'JHON DIEGO','LEDESMA CASTAÑO','jdledesmac','NO',1,1,'abc123','Ingeniero'),(1018429648,'JHON ALEXANDER ','SANCHEZ QUINTERO','jasanchezq','Jhon.Sanchezq.ext@claro.com.co',1,1,'abc123','Ingeniero'),(1019003214,'MIGUEL ANGEL ','NIÑO HUERFANO','maniñoh','Miguel.Ninoh.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(1019011362,'SANDRA MILENA','DIAZ GOYENECHE','smdiazg','Sandra.Diazg.ext@claro.com.co',1,1,'abc123','Coordinador'),(1019016770,'RICARDO ANDRES','MIKAN FAJARDO','ramikanf','Ricardo.Mikan.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(1019041808,'ANDRES FABIAN','ORTIZ VIVERO','afortizv','NO',1,1,'abc123','Ingeniero'),(1019053210,'CARLOS FELIPE ','TRIANA SALINAS','cftrianas','NO',1,1,'abc123','Ingeniero'),(1019068513,'JORGE','MUÑOZ SALAZAR','jmuñozs','Jorge.Munoz.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(1022337026,'NESTOR ALEXANDER','RODRIGUEZ TRUJILLO','narodriguezt','Nestor.Rodriguezt.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(1022948202,'JESÚS DAVID','GÓMEZ SIERRA ','jdgómezs','NO',1,1,'abc123','Ingeniero'),(1022994131,'ERIKA PAOLA ','HERNANDEZ SUARIQUE','ephernandezs','Erika.Hernandez.ext@claro.com.co',1,1,'abc123','Ingeniero'),(1023909261,'DIEGO FELIPE','DAZA TORRES','dfdazat','Diego.Dazat.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(1024482221,'JOHANNA PAOLA','MESA SARMIENTO','jpmesas','Johanna.Mesa.ext@claro.com.co',1,1,'abc123','Ingeniero'),(1024492738,'MANUEL FREANCISCO ','PEÑA BELALCAZAR','mfpeñab','NO',1,1,'abc123','Ingeniero'),(1024501684,'MAYRA ALEJANDRA','CORTES NUÑEZ','macortesn','Mayra.Cortesn.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(1026574006,'DANIEL ALBERTO','DAZA VALBUENA','dadazav','Daniel.Daza.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(1030530444,'JAVIER ALONSO','ROMERO GARCIA','jaromerog','Javier.Romerog.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(1030562892,'BELLO NICOLAS','ROBLES','bnrobles','Nicolas.Robles.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(1030593528,'ANDRES FELIPE','NAVERRETE LOPEZ','afnaverretel','Andres.Naverrete.ext@claro.com.co',1,1,'abc123','Ingeniero'),(1030596266,'STIVENSON','HERNANDEZ PEREZ','shernandezp','Stivenson.Hernandezp.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(1031169516,'DUBAN FELIPE','DELGADILLO CALDERON','dfdelgadilloc','Duban.Delgadilloc.ext@claro.com.co',1,1,'abc123','Documentador'),(1032373067,'ANDRES ','ESCOBAR QUICENO','aescobarq','Andres.Escobarq.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(1032390028,'MARIA LORENA ','DIAZ BORRAY','mldiazb','NO',1,1,'abc123','Ingeniero'),(1032409839,'JAIRO ANDRES ','FAJARDO MENDOZA','jafajardom','Jairo.Fajardo.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(1032438508,'LOWELL FERNEY','SUAREZ SANCHEZ','lfsuarezs','NO',1,1,'abc123','Ingeniero'),(1049637364,'TATIANA MILENA ','TORRES ULLOA','tmtorresu','Tatiana.Torres.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(1053610149,'JESUS ALBERTO ','VALBUENA VARGAS','javalbuenav','Jesus.Valbuenav.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(1069728225,'ORLANDO','DUQUE POLO','oduquep','Orlando.Duquep.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(1069739600,'JAVIER SEBASTIAN','TORRRES MORALES','jstorrresm','NO',1,1,'abc123','Ingeniero'),(1071142125,'DUBAN ','GARZON VELANDIA','dgarzonv','NO',1,1,'abc123','Ingeniero'),(1071329512,'ERIC FABIAN','GOMEZ BALLEN','efgomezb','Eric.Gomez.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(1072651024,'SERGIO ANDRES','CAMACHO','sacamacho','NO',1,1,'abc123','Ingeniero'),(1075288718,'SEBASTIAN DAVITH','PARRADO BARRIOS','sdparradob','Sebastian.Parrado.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(1090384205,'GUSTAVO ADOLFO','ANGARITA PADILLA','gaangaritap','NO',1,1,'abc123','Ingeniero'),(1090444665,'FRANCISCO JAVIER','ZAPATA SANABRIA','fjzapatas','Francisco.Zapatas.Ext@claro.com.co',1,1,'abc123','Ingeniero'),(1098650914,'CARLOS OMAR','ORTIZ AREVALO','coortiza','NO',1,1,'abc123','Ingeniero'),(1098690755,'JIDITH MIRLEIDYS','RIOS GUZMAN','jmriosg','NO',1,1,'abc123','Ingeniero'),(1100961459,'ASTRID ','MELENDEZ','amelendez','Astrid.Melendez.ext@claro.com.co',1,1,'abc123','Ingeniero'),(1110485280,'WILLIAM MAURICIO','AMADO RODRÍGUEZ ','wmamador','NO',1,1,'abc123','Ingeniero'),(1127604383,'RAFAEL LEONARDO','FLOREZ ','rlflorez','Rafael.Florez.Ext@claro.com.co',1,1,'abc123','Ingeniero');
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

-- Dump completed on 2017-11-16  4:53:40
