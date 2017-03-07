-- nos vamos a basar en estas tablas mysql
--
-- Table structure for table `spactividad`
--

DROP TABLE IF EXISTS `spactividad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spactividad` (
  `pkActividad` int(11) NOT NULL AUTO_INCREMENT,
  `fkOrdenTrabajo` int(11) NOT NULL,
  `codigo` char(2) NOT NULL DEFAULT '0',
  `descripcion` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pkActividad`),
  KEY `fkOrdenTrabajo` (`fkOrdenTrabajo`),
  CONSTRAINT `spordenTrabajo1` FOREIGN KEY (`fkOrdenTrabajo`) REFERENCES `spordentrabajo` (`pkOrdenTrabajo`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spactividad`
--

LOCK TABLES `spactividad` WRITE;
/*!40000 ALTER TABLE `spactividad` DISABLE KEYS */;
INSERT INTO `spactividad` VALUES (1,1,'99','actividad 1'),(5,2,'OK','KOKOKO'),(6,1,'1T','ttttt'),(10,1,'11','jjjjjjjjjjjjjjjj'),(11,3,'01','ALIVIANADO'),(12,3,'02','CADENEO'),(13,3,'03','BASUREO'),(14,1,'96','UUUU');
/*!40000 ALTER TABLE `spactividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spcargo`
--

DROP TABLE IF EXISTS `spcargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spcargo` (
  `pkCargo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` char(3) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`pkCargo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spcargo`
--

LOCK TABLES `spcargo` WRITE;
/*!40000 ALTER TABLE `spcargo` DISABLE KEYS */;
INSERT INTO `spcargo` VALUES (1,'099','AUXILIAR DE SISTEMAS'),(2,'001','ADMINISTRADOR DE EMPRESA');
/*!40000 ALTER TABLE `spcargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spdettransfequipo`
--

DROP TABLE IF EXISTS `spdettransfequipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spdettransfequipo` (
  `pkDetTransfEquipo` int(11) NOT NULL AUTO_INCREMENT,
  `fkTransfEquipo` int(11) NOT NULL DEFAULT '0',
  `item` int(11) NOT NULL DEFAULT '0',
  `fkEquipo` int(11) NOT NULL DEFAULT '0',
  `observacion` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pkDetTransfEquipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spdettransfequipo`
--

LOCK TABLES `spdettransfequipo` WRITE;
/*!40000 ALTER TABLE `spdettransfequipo` DISABLE KEYS */;
/*!40000 ALTER TABLE `spdettransfequipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spdettransfpersonal`
--

DROP TABLE IF EXISTS `spdettransfpersonal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spdettransfpersonal` (
  `pkDetTransfPersonal` int(11) NOT NULL AUTO_INCREMENT,
  `fkTransfPersonal` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `fkPersonal` int(11) NOT NULL,
  `observacion` varchar(25) NOT NULL,
  PRIMARY KEY (`pkDetTransfPersonal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spdettransfpersonal`
--

LOCK TABLES `spdettransfpersonal` WRITE;
/*!40000 ALTER TABLE `spdettransfpersonal` DISABLE KEYS */;
/*!40000 ALTER TABLE `spdettransfpersonal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `speqmodelo`
--

DROP TABLE IF EXISTS `speqmodelo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `speqmodelo` (
  `pkEqModelo` int(11) NOT NULL AUTO_INCREMENT,
  `fkEqTipo` int(11) NOT NULL DEFAULT '0',
  `codigo` char(2) DEFAULT '0',
  `descripcion` varchar(25) DEFAULT '0',
  PRIMARY KEY (`pkEqModelo`),
  KEY `fkEqTipo` (`fkEqTipo`),
  CONSTRAINT `r_fkEqTipo` FOREIGN KEY (`fkEqTipo`) REFERENCES `speqtipo` (`pkEqTipo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `speqmodelo`
--

LOCK TABLES `speqmodelo` WRITE;
/*!40000 ALTER TABLE `speqmodelo` DISABLE KEYS */;
INSERT INTO `speqmodelo` VALUES (1,1,'CA','CATERPILLAR D7G'),(3,3,'TO','JDJDJDJD'),(4,1,'K8','KATERPILLAR D8K');
/*!40000 ALTER TABLE `speqmodelo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `speqtipo`
--

DROP TABLE IF EXISTS `speqtipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `speqtipo` (
  `pkEqTipo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` char(2) NOT NULL,
  `descripcion` varchar(25) DEFAULT '0',
  PRIMARY KEY (`pkEqTipo`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `speqtipo`
--

LOCK TABLES `speqtipo` WRITE;
/*!40000 ALTER TABLE `speqtipo` DISABLE KEYS */;
INSERT INTO `speqtipo` VALUES (1,'TO','TRACTOR ORUGA'),(3,'TA','TRACTOR AGRICOLA'),(4,'CA','CAMIONETAS');
/*!40000 ALTER TABLE `speqtipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spequipo`
--

DROP TABLE IF EXISTS `spequipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spequipo` (
  `pkEquipo` int(11) NOT NULL AUTO_INCREMENT,
  `fkTipoEquipo` int(11) NOT NULL DEFAULT '0',
  `fkModelo` int(11) NOT NULL DEFAULT '0',
  `codigo` char(9) NOT NULL DEFAULT '0',
  `fkTipoContrato` enum('ALQUILADO','PROPIO') NOT NULL,
  `fechaIngreso` date NOT NULL DEFAULT '0000-00-00',
  `fkOrdenTrabajo` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pkEquipo`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `fkTipoEquipo` (`fkTipoEquipo`),
  KEY `fkModelo` (`fkModelo`),
  KEY `fkOrdenTrabajo` (`fkOrdenTrabajo`),
  CONSTRAINT `spequipo_ibfk_1` FOREIGN KEY (`fkTipoEquipo`) REFERENCES `speqtipo` (`pkEqTipo`),
  CONSTRAINT `spequipo_ibfk_2` FOREIGN KEY (`fkModelo`) REFERENCES `speqmodelo` (`pkEqModelo`),
  CONSTRAINT `spequipo_ibfk_3` FOREIGN KEY (`fkOrdenTrabajo`) REFERENCES `spordentrabajo` (`pkOrdenTrabajo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spequipo`
--

LOCK TABLES `spequipo` WRITE;
/*!40000 ALTER TABLE `spequipo` DISABLE KEYS */;
INSERT INTO `spequipo` VALUES (1,1,4,'TO-K8-001','ALQUILADO','2015-12-18',2,'TRACTOR ORUGA D8k MONSEÑOR');
/*!40000 ALTER TABLE `spequipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spgestion`
--

DROP TABLE IF EXISTS `spgestion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spgestion` (
  `pkGestion` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` char(2) NOT NULL DEFAULT '0',
  `fechaIni` date NOT NULL DEFAULT '0000-00-00',
  `fechaFin` date NOT NULL DEFAULT '0000-00-00',
  `estado` enum('T','F') NOT NULL DEFAULT 'F',
  PRIMARY KEY (`pkGestion`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spgestion`
--

LOCK TABLES `spgestion` WRITE;
/*!40000 ALTER TABLE `spgestion` DISABLE KEYS */;
INSERT INTO `spgestion` VALUES (1,'15','2015-01-01','2015-12-31','T'),(2,'16','2016-01-01','2016-12-31','F'),(3,'17','2017-01-01','2017-12-31','F'),(5,'18','2018-01-01','2018-12-31','T');
/*!40000 ALTER TABLE `spgestion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spimproductiva`
--

DROP TABLE IF EXISTS `spimproductiva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spimproductiva` (
  `pkImproductiva` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(4) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`pkImproductiva`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spimproductiva`
--

LOCK TABLES `spimproductiva` WRITE;
/*!40000 ALTER TABLE `spimproductiva` DISABLE KEYS */;
INSERT INTO `spimproductiva` VALUES (1,'0001','IMPRODUCTIVA'),(2,'0123','IMPRODUCTIVA NUMERO 2'),(3,'0012','FUNCIONAMIENTO MECANICOS'),(4,'YYYY','QQQQQ');
/*!40000 ALTER TABLE `spimproductiva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spitemobra`
--

DROP TABLE IF EXISTS `spitemobra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spitemobra` (
  `pkItemObra` int(11) NOT NULL AUTO_INCREMENT,
  `fkOrdenTrabajo` int(11) NOT NULL DEFAULT '0',
  `fkPoligono` int(11) NOT NULL DEFAULT '0',
  `fkActividad` int(11) NOT NULL DEFAULT '0',
  `codigo` char(6) NOT NULL DEFAULT '0',
  `descripcion` varchar(50) DEFAULT '0',
  `areaTrab` decimal(10,2) DEFAULT '0.00',
  `rendimiento` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`pkItemObra`),
  KEY `fkOrdenTrabajo` (`fkOrdenTrabajo`),
  KEY `fkPoligono` (`fkPoligono`),
  KEY `fkActividad` (`fkActividad`),
  CONSTRAINT `spitemobra_ibfk_1` FOREIGN KEY (`fkOrdenTrabajo`) REFERENCES `spordentrabajo` (`pkOrdenTrabajo`),
  CONSTRAINT `spitemobra_ibfk_2` FOREIGN KEY (`fkPoligono`) REFERENCES `sppoligono` (`pkPoligono`),
  CONSTRAINT `spitemobra_ibfk_3` FOREIGN KEY (`fkActividad`) REFERENCES `spactividad` (`pkActividad`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spitemobra`
--

LOCK TABLES `spitemobra` WRITE;
/*!40000 ALTER TABLE `spitemobra` DISABLE KEYS */;
INSERT INTO `spitemobra` VALUES (2,1,2,11,'B02-01','ALIVIANADO - POLIGONO BO2',7.00,0.90),(3,1,1,5,'B01-OK','CADENEO - POLIGONO BO4',200.00,1.00),(4,1,1,11,'B01-01','undd',12.00,12.00),(8,1,2,1,'001-11','sss',11.00,1.00),(9,1,2,12,'B02-02','CADENEO DE BO2',100.00,0.33);
/*!40000 ALTER TABLE `spitemobra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spordentrabajo`
--

DROP TABLE IF EXISTS `spordentrabajo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spordentrabajo` (
  `pkOrdenTrabajo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(3) NOT NULL,
  `fkGestion` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `supervisor` varchar(50) DEFAULT NULL,
  `areaEstimada` decimal(10,0) NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') NOT NULL,
  `data` varchar(6) NOT NULL,
  PRIMARY KEY (`pkOrdenTrabajo`),
  KEY `fkGestion` (`fkGestion`),
  CONSTRAINT `spordentrabajo_ibfk_1` FOREIGN KEY (`fkGestion`) REFERENCES `spgestion` (`pkGestion`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spordentrabajo`
--

LOCK TABLES `spordentrabajo` WRITE;
/*!40000 ALTER TABLE `spordentrabajo` DISABLE KEYS */;
INSERT INTO `spordentrabajo` VALUES (1,'001',1,'san ignacio','vicente v',999,'ACTIVO','001-15'),(2,'002',1,'jdjdjdj','jdjdj',66,'ACTIVO','002-15'),(3,'003',1,'limehrh','nndhjf',11,'INACTIVO','003-15');
/*!40000 ALTER TABLE `spordentrabajo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sppersonal`
--

DROP TABLE IF EXISTS `sppersonal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sppersonal` (
  `pkPersonal` int(11) NOT NULL AUTO_INCREMENT,
  `fechaIngreso` date NOT NULL DEFAULT '0000-00-00',
  `nombreComp` varchar(50) NOT NULL DEFAULT '0',
  `apellidos` varchar(50) NOT NULL DEFAULT '0',
  `direccion` varchar(50) NOT NULL DEFAULT '0',
  `telefono` varchar(50) NOT NULL DEFAULT '0',
  `ci` varchar(25) NOT NULL DEFAULT '0',
  `fechaNac` date NOT NULL DEFAULT '0000-00-00',
  `fkcargo` int(11) NOT NULL DEFAULT '0',
  `fkOrdenTrabajo` int(11) NOT NULL DEFAULT '0',
  `email` varchar(25) NOT NULL,
  PRIMARY KEY (`pkPersonal`),
  KEY `fkcargo` (`fkcargo`),
  KEY `fkOrdenTrabajo` (`fkOrdenTrabajo`),
  CONSTRAINT `sppersonal_ibfk_1` FOREIGN KEY (`fkcargo`) REFERENCES `spcargo` (`pkCargo`),
  CONSTRAINT `sppersonal_ibfk_2` FOREIGN KEY (`fkOrdenTrabajo`) REFERENCES `spordentrabajo` (`pkOrdenTrabajo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sppersonal`
--

LOCK TABLES `sppersonal` WRITE;
/*!40000 ALTER TABLE `sppersonal` DISABLE KEYS */;
INSERT INTO `sppersonal` VALUES (1,'2015-12-01','ALEX LIMBERT','YALUSQUI GODOY','CALLE YAPACANI # 23','76079622','6252870-SCZ','2015-10-13',1,1,'limbertx@hotmail.com');
/*!40000 ALTER TABLE `sppersonal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sppoligono`
--

DROP TABLE IF EXISTS `sppoligono`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sppoligono` (
  `pkPoligono` int(11) NOT NULL AUTO_INCREMENT,
  `fkOrdenTrabajo` int(11) NOT NULL DEFAULT '0',
  `codigo` char(3) NOT NULL DEFAULT '0',
  `descripcion` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pkPoligono`),
  KEY `fkOrdenTrabajo` (`fkOrdenTrabajo`),
  CONSTRAINT `sppoligono_ibfk_1` FOREIGN KEY (`fkOrdenTrabajo`) REFERENCES `spordentrabajo` (`pkOrdenTrabajo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sppoligono`
--

LOCK TABLES `sppoligono` WRITE;
/*!40000 ALTER TABLE `sppoligono` DISABLE KEYS */;
INSERT INTO `sppoligono` VALUES (1,1,'B01','POLIGONO - B01'),(2,1,'B02','POLIGONO - B02'),(3,1,'B04','POLIGONO - B04');
/*!40000 ALTER TABLE `sppoligono` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sptransfequipo`
--

DROP TABLE IF EXISTS `sptransfequipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sptransfequipo` (
  `pkTransfEquipo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` char(4) NOT NULL DEFAULT '0',
  `fkGestion` int(11) NOT NULL DEFAULT '0',
  `fecha` date NOT NULL DEFAULT '0000-00-00',
  `fkOrdenOrigen` int(11) NOT NULL DEFAULT '0',
  `fkOrdenDestino` int(11) NOT NULL DEFAULT '0',
  `observacion` varchar(50) NOT NULL DEFAULT '0',
  `data` varchar(7) NOT NULL DEFAULT '0',
  `estado` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pkTransfEquipo`),
  KEY `fkGestion` (`fkGestion`),
  KEY `fkOrdenOrigen` (`fkOrdenOrigen`),
  KEY `fkOrdenDestino` (`fkOrdenDestino`),
  CONSTRAINT `fkOrdenDestinoOt` FOREIGN KEY (`fkOrdenDestino`) REFERENCES `spordentrabajo` (`pkOrdenTrabajo`),
  CONSTRAINT `fkOrdenOrigenOt` FOREIGN KEY (`fkOrdenOrigen`) REFERENCES `spordentrabajo` (`pkOrdenTrabajo`),
  CONSTRAINT `fkgestion` FOREIGN KEY (`fkGestion`) REFERENCES `spgestion` (`pkGestion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sptransfequipo`
--

LOCK TABLES `sptransfequipo` WRITE;
/*!40000 ALTER TABLE `sptransfequipo` DISABLE KEYS */;
/*!40000 ALTER TABLE `sptransfequipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sptransfpersonal`
--

DROP TABLE IF EXISTS `sptransfpersonal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sptransfpersonal` (
  `pkTransfPersonal` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` char(4) NOT NULL,
  `fkGestion` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fkOrdenOrigen` int(11) NOT NULL,
  `fkOrdenDestino` int(11) NOT NULL,
  `observacion` varchar(50) NOT NULL,
  `data` varchar(7) NOT NULL,
  `estado` char(1) NOT NULL,
  PRIMARY KEY (`pkTransfPersonal`),
  KEY `fkGestion` (`fkGestion`),
  KEY `fkOrdenOrigen` (`fkOrdenOrigen`),
  KEY `fkOrdenDestino` (`fkOrdenDestino`),
  CONSTRAINT `sptransfpersonal_ibfk_1` FOREIGN KEY (`fkGestion`) REFERENCES `spgestion` (`pkGestion`),
  CONSTRAINT `sptransfpersonal_ibfk_2` FOREIGN KEY (`fkOrdenOrigen`) REFERENCES `spordentrabajo` (`pkOrdenTrabajo`),
  CONSTRAINT `sptransfpersonal_ibfk_3` FOREIGN KEY (`fkOrdenDestino`) REFERENCES `spordentrabajo` (`pkOrdenTrabajo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sptransfpersonal`
--

LOCK TABLES `sptransfpersonal` WRITE;
/*!40000 ALTER TABLE `sptransfpersonal` DISABLE KEYS */;
/*!40000 ALTER TABLE `sptransfpersonal` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-03 14:28:20
