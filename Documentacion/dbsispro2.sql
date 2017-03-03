-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.6.21 - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para dbsispro
CREATE DATABASE IF NOT EXISTS `dbsispro` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dbsispro`;


-- Volcando estructura para tabla dbsispro.spactividad
CREATE TABLE IF NOT EXISTS `spactividad` (
  `pkActividad` int(11) NOT NULL AUTO_INCREMENT,
  `fkPoligono` int(11) NOT NULL DEFAULT '0',
  `codigo` char(2) NOT NULL DEFAULT '0',
  `descripcion` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pkActividad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla dbsispro.spconceptos
CREATE TABLE IF NOT EXISTS `spconceptos` (
  `pkCargo` int(11) NOT NULL,
  `pkTipo` int(11) NOT NULL,
  `spCodigo` char(3) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`pkCargo`,`pkTipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Aqui estaran los componentes basicos como cargo, tipo de contrato, etc';

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla dbsispro.spequipo
CREATE TABLE IF NOT EXISTS `spequipo` (
  `pkEquipo` int(11) NOT NULL AUTO_INCREMENT,
  `fkTipoEquipo` int(11) NOT NULL DEFAULT '0',
  `fkModelo` int(11) NOT NULL DEFAULT '0',
  `codigo` char(8) NOT NULL DEFAULT '0',
  `fkTipoContrato` int(11) NOT NULL DEFAULT '0',
  `fechaIngreso` date NOT NULL DEFAULT '0000-00-00',
  `fkOrdenTrabajo` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pkEquipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla dbsispro.spgestion
CREATE TABLE IF NOT EXISTS `spgestion` (
  `pkGestion` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` char(2) NOT NULL DEFAULT '0',
  `fechaIni` date NOT NULL DEFAULT '0000-00-00',
  `fechaFin` date NOT NULL DEFAULT '0000-00-00',
  `estado` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pkGestion`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla dbsispro.spimproductiva
CREATE TABLE IF NOT EXISTS `spimproductiva` (
  `pkImproductiva` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(4) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`pkImproductiva`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabla de actividades improductivas';

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla dbsispro.spitemobra
CREATE TABLE IF NOT EXISTS `spitemobra` (
  `pkItemObra` int(11) NOT NULL AUTO_INCREMENT,
  `fkOrdenTrabajo` int(11) NOT NULL DEFAULT '0',
  `fkPoligono` int(11) NOT NULL DEFAULT '0',
  `fkActividad` int(11) NOT NULL DEFAULT '0',
  `codigo` char(6) NOT NULL DEFAULT '0',
  `descripcion` varchar(50) DEFAULT '0',
  `area` decimal(10,2) DEFAULT '0.00',
  `rendimiento` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`pkItemObra`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla dbsispro.spordentrabajo
CREATE TABLE IF NOT EXISTS `spordentrabajo` (
  `pkOrdenTrabajo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(3) NOT NULL,
  `fkGestion` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `supervisor` varchar(50) DEFAULT NULL,
  `areaEstimada` decimal(10,0) NOT NULL,
  `estado` smallint(6) NOT NULL,
  `data` varchar(6) NOT NULL,
  PRIMARY KEY (`pkOrdenTrabajo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla dbsispro.sppersonal
CREATE TABLE IF NOT EXISTS `sppersonal` (
  `pkPersonal` int(11) NOT NULL AUTO_INCREMENT,
  `nombreComp` varchar(50) NOT NULL DEFAULT '0',
  `apellidos` varchar(50) NOT NULL DEFAULT '0',
  `direccion` varchar(50) NOT NULL DEFAULT '0',
  `telefono` varchar(50) NOT NULL DEFAULT '0',
  `fkcargo` int(11) NOT NULL DEFAULT '0',
  `fkOrdenTrabajo` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pkPersonal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla dbsispro.sppoligono
CREATE TABLE IF NOT EXISTS `sppoligono` (
  `pkPoligono` int(11) NOT NULL AUTO_INCREMENT,
  `fkOrdenTrabajo` int(11) NOT NULL DEFAULT '0',
  `codigo` char(3) NOT NULL DEFAULT '0',
  `descripcion` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pkPoligono`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
