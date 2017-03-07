-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-07-2015 a las 21:26:06
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `dbprueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directoriomodel`
--

CREATE TABLE IF NOT EXISTS `directoriomodel` (
  `pkDirectorio` int(11) NOT NULL,
  `fkParent` int(11) NOT NULL,
  `tipoDirectorio` varchar(1) NOT NULL,
  `pathDirectorio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `directoriomodel`
--

INSERT INTO `directoriomodel` (`pkDirectorio`, `fkParent`, `tipoDirectorio`, `pathDirectorio`) VALUES
(1, 0, 'D', 'C:/xampp/htdocs/prueba'),
(2, 1, 'A', 'C:/xampp/htdocs/prueba/index.php'),
(3, 1, 'D', 'C:/xampp/htdocs/prueba/vistas'),
(4, 3, 'A', 'C:/xampp/htdocs/prueba/vistas/GrupoView.php'),
(5, 3, 'A', 'C:/xampp/htdocs/prueba/vistas/IndexView.php'),
(6, 3, 'A', 'C:/xampp/htdocs/prueba/vistas/PrincipalView.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupomodel`
--

CREATE TABLE IF NOT EXISTS `grupomodel` (
`pkGrupo` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupomodel`
--

INSERT INTO `grupomodel` (`pkGrupo`, `descripcion`) VALUES
(2, 'CONTABILIDAD'),
(3, 'ADMINISTRACION'),
(4, 'SISTEMAS'),
(5, 'VENTAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegiogrupomodel`
--

CREATE TABLE IF NOT EXISTS `privilegiogrupomodel` (
  `fkPrivilegio` int(11) NOT NULL,
  `fkGrupo` int(11) NOT NULL,
  `acceso` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `privilegiogrupomodel`
--

INSERT INTO `privilegiogrupomodel` (`fkPrivilegio`, `fkGrupo`, `acceso`) VALUES
(8, 3, 'NV'),
(9, 3, 'NV'),
(1, 4, 'VE'),
(2, 4, 'NV'),
(3, 4, 'NV'),
(4, 4, 'NV'),
(5, 4, 'NV'),
(6, 4, 'NV'),
(7, 4, 'NV'),
(8, 4, 'NV'),
(9, 4, 'NV'),
(10, 4, 'NV'),
(11, 4, 'NV'),
(12, 4, 'NV'),
(10, 5, 'VE'),
(11, 5, 'VE'),
(12, 5, 'VE'),
(3, 2, 'NV'),
(4, 2, 'NV'),
(5, 2, 'NV'),
(6, 2, 'NV'),
(7, 2, 'VE'),
(1, 2, 'NV'),
(2, 2, 'NV');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegiomodel`
--

CREATE TABLE IF NOT EXISTS `privilegiomodel` (
`pkPrivilegio` int(11) NOT NULL,
  `fkDirectorio` int(11) NOT NULL,
  `nombreControl` varchar(25) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `tipoControl` varchar(25) NOT NULL,
  `idControl` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `privilegiomodel`
--

INSERT INTO `privilegiomodel` (`pkPrivilegio`, `fkDirectorio`, `nombreControl`, `descripcion`, `tipoControl`, `idControl`) VALUES
(1, 2, 'namehola', 'Archivo de seleccionar', 'file', 'idhola'),
(2, 2, 'namexxss', 'namexxss modificado', 'text', 'iddxxsss'),
(3, 2, 'nbt1', 'botones denbt1', 'button', 'NT1'),
(4, 2, 'name2', 'name2', 'submit', 'rrr'),
(5, 2, 'oooorr', 'Boton de Guardar datos', 'submit', 'xxsss'),
(6, 2, 'hello', 'hello', 'submit', 'tttq'),
(7, 2, 'btnGuardar', 'Boton de enviar archivo1', 'submit', 'enviarGuardar'),
(8, 4, 'txtpkGrupo', 'txtpkGrupo', 'text', 'GMpkGrupo'),
(9, 4, 'txtxDescrp', 'txtxDescrp', 'text', 'GMdescripcion'),
(10, 4, 'btnnuevo', 'btnnuevo', 'button', 'idbtnNuevo'),
(11, 4, 'btnGuardar', 'btnGuardar', 'button', 'idbtnGuardar'),
(12, 4, 'btnEliminar', 'Es un boton de eliminar', 'button', 'idbtnEliminar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariomodel`
--

CREATE TABLE IF NOT EXISTS `usuariomodel` (
`pkUsuario` int(11) NOT NULL,
  `nickName` varchar(15) NOT NULL,
  `nombreCompleto` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fkGrupoUsuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuariomodel`
--

INSERT INTO `usuariomodel` (`pkUsuario`, `nickName`, `nombreCompleto`, `apellidos`, `email`, `password`, `fkGrupoUsuario`) VALUES
(5, 'mikezen', 'alex limbert', 'yalusqui', 'limbertx@hotmail.com', '200221094', 4),
(7, 'juan', 'juan#', 'vatcano', 'limhdhhd', '2002', 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `directoriomodel`
--
ALTER TABLE `directoriomodel`
 ADD PRIMARY KEY (`pkDirectorio`);

--
-- Indices de la tabla `grupomodel`
--
ALTER TABLE `grupomodel`
 ADD PRIMARY KEY (`pkGrupo`);

--
-- Indices de la tabla `privilegiomodel`
--
ALTER TABLE `privilegiomodel`
 ADD PRIMARY KEY (`pkPrivilegio`);

--
-- Indices de la tabla `usuariomodel`
--
ALTER TABLE `usuariomodel`
 ADD PRIMARY KEY (`pkUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `grupomodel`
--
ALTER TABLE `grupomodel`
MODIFY `pkGrupo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `privilegiomodel`
--
ALTER TABLE `privilegiomodel`
MODIFY `pkPrivilegio` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `usuariomodel`
--
ALTER TABLE `usuariomodel`
MODIFY `pkUsuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
