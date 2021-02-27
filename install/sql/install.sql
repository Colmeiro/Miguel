-- 
-- Your SQL Queries Here
--

-- --------------------------------------------------------
-- Host:                         10.0.0.99
-- Versión del servidor:         5.5.68-MariaDB - MariaDB Server
-- SO del servidor:              Linux
-- HeidiSQL Versión:             10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla fish_arvi.grupo
CREATE TABLE IF NOT EXISTS `grupo` (
  `grupo_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL DEFAULT '',
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  `orden` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`grupo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla fish_arvi.grupo: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `grupo` DISABLE KEYS */;
INSERT INTO `grupo` (`grupo_id`, `nombre`, `activo`, `orden`) VALUES
	(1, 'Grupo 1', 1, 1),
	(2, 'Grupo 2', 1, 2);
/*!40000 ALTER TABLE `grupo` ENABLE KEYS */;

-- Volcando estructura para tabla fish_arvi.rol
CREATE TABLE IF NOT EXISTS `rol` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `orden` int(11) DEFAULT '1',
  `es_admin` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla fish_arvi.rol: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`rol_id`, `nombre`, `activo`, `orden`, `es_admin`) VALUES
	(1, 'Administrador', 1, 1, 1),
	(2, 'Resto', 1, 2, 0);
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;

-- Volcando estructura para tabla fish_arvi.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) DEFAULT '',
  `dni` varchar(255) DEFAULT '',
  `ciudad` varchar(255) DEFAULT '',
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla fish_arvi.usuario: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`usuario_id`, `fecha_creacion`, `fecha_modificacion`, `nombre`, `apellidos`, `dni`, `ciudad`, `email`, `password`, `rol_id`, `activo`, `orden`) VALUES
	(1, '2021-01-27 16:23:10', '0000-00-00 00:00:00', 'Admin', 'Test', '99999999A', 'Vigo', 'desarrollo@teconsite.com', '2b41cb358f1df8c5812967509ab7ba1b', 1, 1, 1),
	(2, '2021-01-27 16:23:10', '0000-00-00 00:00:00', 'Usuario', 'Test', '99999999X', 'Vigo', 'pruebas@teconsite.com', '2b41cb358f1df8c5812967509ab7ba1b', 2, 1, 2);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Volcando estructura para tabla fish_arvi.usuario_grupo
CREATE TABLE IF NOT EXISTS `usuario_grupo` (
  `usuario_grupo_id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_id` int(11) NOT NULL DEFAULT '0',
  `usuario_id` int(11) NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `orden` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`usuario_grupo_id`),
  UNIQUE KEY `grupo_id_usuario_id` (`grupo_id`,`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla fish_arvi.usuario_grupo: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario_grupo` DISABLE KEYS */;
INSERT INTO `usuario_grupo` (`usuario_grupo_id`, `grupo_id`, `usuario_id`, `activo`, `orden`) VALUES
	(1, 1, 1, 1, 1);
/*!40000 ALTER TABLE `usuario_grupo` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;