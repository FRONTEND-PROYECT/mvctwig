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
CREATE DATABASE IF NOT EXISTS `dbsiagro` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dbsiagro`;


-- Volcando estructura para tabla dbsispro.spactividad
CREATE TABLE IF NOT EXISTS `spactividad` (
  `pkActividad` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` char(2) NOT NULL DEFAULT '0',
  `descripcion` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pkActividad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla dbsispro.spcargo
CREATE TABLE IF NOT EXISTS `spcargo` (
  `pkCargo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` char(3) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`pkCargo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla dbsispro.spdettransfequipo
CREATE TABLE IF NOT EXISTS `spdettransfequipo` (
  `pkDetTransfEquipo` int(11) NOT NULL AUTO_INCREMENT,
  `fkTransfEquipo` int(11) NOT NULL DEFAULT '0',
  `item` int(11) NOT NULL DEFAULT '0',
  `fkEquipo` int(11) NOT NULL DEFAULT '0',
  `observacion` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pkDetTransfEquipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla dbsispro.spdettransfpersonal
CREATE TABLE IF NOT EXISTS `spdettransfpersonal` (
  `pkDetTransfPersonal` int(11) NOT NULL AUTO_INCREMENT,
  `fkTransfPersonal` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `fkPersonal` int(11) NOT NULL,
  `observacion` varchar(25) NOT NULL,
  PRIMARY KEY (`pkDetTransfPersonal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla dbsispro.speqmodelo
CREATE TABLE IF NOT EXISTS `speqmodelo` (
  `pkEqModelo` int(11) NOT NULL AUTO_INCREMENT,
  `fkEqTipo` int(11) DEFAULT '0',
  `codigo` char(2) DEFAULT '0',
  `descripcion` varchar(25) DEFAULT '0',
  PRIMARY KEY (`pkEqModelo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla dbsispro.speqtipo
CREATE TABLE IF NOT EXISTS `speqtipo` (
  `pkEqTipo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` char(2) DEFAULT '0',
  `descripcion` varchar(25) DEFAULT '0',
  PRIMARY KEY (`pkEqTipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `codigo` varchar(4),
  `descripcion` varchar(50),
  PRIMARY KEY (`pkImproductiva`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla dbsispro.spitemobra
CREATE TABLE IF NOT EXISTS `spitemobra` (
  `pkItemObra` int(11) NOT NULL AUTO_INCREMENT,
  `fkOrdenTrabajo` int(11) NOT NULL DEFAULT '0',
  `fkPoligono` int(11) NOT NULL DEFAULT '0',
  `fkActividad` int(11) NOT NULL DEFAULT '0',
  `codigo` char(6) NOT NULL DEFAULT '0',
  `descripcion` varchar(50) DEFAULT '0',
  `areaTrab` decimal(10,2) DEFAULT '0.00',
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
  `estado` char(1) NOT NULL,
  `data` varchar(6) NOT NULL,
  PRIMARY KEY (`pkOrdenTrabajo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla dbsispro.sppersonal
CREATE TABLE IF NOT EXISTS `sppersonal` (
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


-- Volcando estructura para tabla dbsispro.sptransfequipo
CREATE TABLE IF NOT EXISTS `sptransfequipo` (
  `pkTransfEquipo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` char(4) NOT NULL DEFAULT '0',
  `fkGestion` int(11) NOT NULL DEFAULT '0',
  `fecha` date NOT NULL DEFAULT '0000-00-00',
  `fkOrdenOrigen` int(11) NOT NULL DEFAULT '0',
  `fkOrdenDestino` int(11) NOT NULL DEFAULT '0',
  `observacion` varchar(50) NOT NULL DEFAULT '0',
  `data` varchar(7) NOT NULL DEFAULT '0',
  `estado` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pkTransfEquipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla dbsispro.sptransfpersonal
CREATE TABLE IF NOT EXISTS `sptransfpersonal` (
  `pkTransfPersonal` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` char(4) NOT NULL,
  `fkGestion` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fkOrdenOrigen` int(11) NOT NULL,
  `fkOrdenDestino` int(11) NOT NULL,
  `observacion` varchar(50) NOT NULL,
  `data` varchar(7) NOT NULL,
  `estado` char(1) NOT NULL,
  PRIMARY KEY (`pkTransfPersonal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;