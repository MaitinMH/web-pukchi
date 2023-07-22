-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 22-07-2023 a las 05:13:56
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pukchi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alternativas`
--

DROP TABLE IF EXISTS `alternativas`;
CREATE TABLE IF NOT EXISTS `alternativas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pregunta` int DEFAULT NULL,
  `tipo` varchar(32) DEFAULT NULL,
  `titulo` varchar(120) DEFAULT NULL,
  `correcto` bit(1) DEFAULT NULL,
  `imagen` varchar(120) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL,
  `fe_creacion` datetime DEFAULT NULL,
  `fe_modificacion` datetime DEFAULT NULL,
  `fe_eliminacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alternativas`
--

INSERT INTO `alternativas` (`id`, `id_pregunta`, `tipo`, `titulo`, `correcto`, `imagen`, `estado`, `fe_creacion`, `fe_modificacion`, `fe_eliminacion`) VALUES
(1, 1, 'numeric', '1', b'0', 'uno.svg', 'A', '2023-07-18 03:44:31', NULL, NULL),
(2, 1, 'numeric', '2', b'0', 'dos.svg', 'A', '2023-07-18 03:44:31', NULL, NULL),
(3, 1, 'numeric', '3', b'0', 'tres.svg', 'A', '2023-07-18 03:47:36', NULL, NULL),
(4, 1, 'photo', 'conejo', b'1', 'conejo.png', 'A', '2023-07-18 03:47:36', NULL, NULL),
(5, 1, 'photo', 'elefante', b'1', 'elefante.png', 'A', '2023-07-18 03:48:51', NULL, NULL),
(6, 1, 'photo', 'flamengo', b'1', 'flamengo.png', 'A', '2023-07-18 03:48:51', NULL, NULL),
(7, 2, 'numeric', 'uno', b'1', 'uno.svg', 'A', '2023-07-18 04:51:10', NULL, NULL),
(8, 2, 'numeric', 'dos', b'1', 'dos.svg', 'A', '2023-07-18 04:51:10', NULL, NULL),
(9, 2, 'photo', 'jirafa', b'0', 'jirafa.png', 'A', '2023-07-18 04:52:11', NULL, NULL),
(10, 2, 'photo', 'siervo', b'0', 'siervo.png', 'A', '2023-07-18 04:52:11', NULL, NULL),
(11, 2, 'numeric', 'tres', b'1', 'tres.svg', 'A', '2023-07-18 04:54:13', NULL, NULL),
(12, 2, 'photo', 'mapache', b'0', 'mapache.png', 'A', '2023-07-18 04:54:13', NULL, NULL),
(13, 3, 'numeric', 'cuatro', b'0', '4.svg', 'A', '2023-07-18 00:55:02', NULL, NULL),
(14, 3, 'photo', 'serpiente', b'1', 'serpiente.png', 'A', '2023-07-18 00:55:02', NULL, NULL),
(15, 3, 'photo', 'oso', b'1', 'oso.png', 'A', '2023-07-18 01:05:27', NULL, NULL),
(16, 3, 'numeric', 'cinco', b'0', '5.svg', 'A', '2023-07-18 01:05:27', NULL, NULL),
(17, 3, 'numeric', 'seis', b'0', '6.svg', 'A', '2023-07-18 01:08:18', NULL, NULL),
(18, 3, 'photo', 'zorro', b'1', 'zorro.png', 'A', '2023-07-18 01:08:18', NULL, NULL),
(19, 4, 'numeric', '4', b'1', '4.svg', 'A', '2023-07-20 21:44:18', NULL, NULL),
(20, 4, 'photo', 'zebra', b'0', 'zebra.png', 'A', '2023-07-20 21:44:18', NULL, NULL),
(21, 4, 'photo', 'conejo', b'0', 'conejo.png', 'A', '2023-07-21 21:26:11', NULL, NULL),
(22, 4, 'numeric', 'cinco', b'1', '5.svg', 'A', '2023-07-21 21:26:11', NULL, NULL),
(23, 4, 'numeric', 'seis', b'1', '6.svg', 'A', '2023-07-21 21:27:17', NULL, NULL),
(24, 4, 'photo', 'elefante', b'0', 'elefante.png', 'A', '2023-07-21 21:27:17', NULL, NULL),
(25, 6, 'numeric', 'uno', b'1', '1a.svg', 'A', '2023-07-21 21:36:57', NULL, NULL),
(26, 6, 'numeric', 'dos', b'0', '2a.svg', 'A', '2023-07-21 21:46:46', NULL, NULL),
(27, 6, 'numeric', 'uno', b'1', '1a.svg', 'A', '2023-07-21 21:46:46', NULL, NULL),
(28, 6, 'numeric', 'cuatro', b'0', '4a.svg', 'A', '2023-07-21 21:49:26', NULL, NULL),
(29, 6, 'numeric', 'uno', b'1', '1a.svg', 'A', '2023-07-21 21:49:26', NULL, NULL),
(30, 6, 'numeric', 'cinco', b'0', '5a.svg', 'A', '2023-07-21 21:50:51', NULL, NULL),
(31, 7, 'numeric', 'tres', b'0', '3a.svg', 'A', '2023-07-21 21:51:55', NULL, NULL),
(32, 7, 'numeric', 'dos', b'1', '2a.svg', 'A', '2023-07-21 21:51:55', NULL, NULL),
(33, 7, 'numeric', 'cutro', b'0', '4a.svg', 'A', '2023-07-21 21:52:56', NULL, NULL),
(34, 7, 'numeric', 'dos', b'1', '2a.svg', 'A', '2023-07-21 21:52:56', NULL, NULL),
(35, 7, 'numeric', 'cinco', b'0', '5a.svg', 'A', '2023-07-21 21:54:19', NULL, NULL),
(36, 7, 'numeric', 'seis', b'0', '6a.svg', 'A', '2023-07-21 21:54:19', NULL, NULL),
(37, 8, 'numeric', 'cinco', b'0', '5a.svg', 'A', '2023-07-21 22:53:43', NULL, NULL),
(38, 8, 'numeric', 'seis', b'0', '6a.svg', 'A', '2023-07-21 22:53:43', NULL, NULL),
(39, 8, 'numeric', 'tres', b'1', '3a.svg', 'A', '2023-07-21 22:54:50', NULL, NULL),
(40, 8, 'numeric', 'tres', b'1', '3a.svg', 'A', '2023-07-21 22:54:50', NULL, NULL),
(41, 8, 'numeric', 'siete', b'0', '7a.svg', 'A', '2023-07-21 22:57:12', NULL, NULL),
(42, 8, 'numeric', 'tres', b'1', '3a.svg', 'A', '2023-07-21 22:57:12', NULL, NULL),
(43, 9, 'numeric', 'ocho', b'0', '8a.svg', 'A', '2023-07-21 22:58:08', NULL, NULL),
(44, 9, 'numeric', 'nueve', b'0', '9a.svg', 'A', '2023-07-21 22:58:08', NULL, NULL),
(45, 9, 'numeric', 'cuatro', b'1', '4a.svg', 'A', '2023-07-21 22:59:05', NULL, NULL),
(46, 9, 'numeric', 'diez', b'0', '10a.svg', 'A', '2023-07-21 22:59:05', NULL, NULL),
(47, 9, 'numeric', 'cuatro', b'1', '4a.svg', 'A', '2023-07-21 22:59:54', NULL, NULL),
(48, 9, 'numeric', 'cuatro', b'1', '4a.svg', 'A', '2023-07-21 22:59:54', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
CREATE TABLE IF NOT EXISTS `configuracion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `empresa` varchar(320) NOT NULL,
  `ruc` varchar(32) NOT NULL,
  `razon_social` varchar(320) NOT NULL,
  `direccion` varchar(320) NOT NULL,
  `telefono` varchar(32) NOT NULL,
  `ubicacion` varchar(120) NOT NULL,
  `imagen` varchar(320) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `empresa`, `ruc`, `razon_social`, `direccion`, `telefono`, `ubicacion`, `imagen`) VALUES
(1, 'Agencia', '12345678945', 'Agencia', 'Jr. direcion 123', '125478965', 'Lima', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

DROP TABLE IF EXISTS `preguntas`;
CREATE TABLE IF NOT EXISTS `preguntas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nivel` int DEFAULT NULL,
  `titulo` varchar(220) DEFAULT NULL,
  `archivo` varchar(120) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL,
  `fe_creacion` datetime DEFAULT NULL,
  `fe_modificacion` datetime DEFAULT NULL,
  `fe_eliminacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `nivel`, `titulo`, `archivo`, `estado`, `fe_creacion`, `fe_modificacion`, `fe_eliminacion`) VALUES
(1, 1, 'Presiona los animales', 'nivel_1_preg_01.wav', 'A', '2023-07-18 03:27:41', NULL, NULL),
(2, 1, 'Presiona todo los números', 'nivel_1_preg_02.wav', 'A', '2023-07-18 04:49:21', NULL, NULL),
(3, 1, 'Presiona los animales', 'nivel_1_preg_03.wav', 'A', '2023-07-18 00:49:32', NULL, NULL),
(6, 2, 'Encuentra el mismo número.', 'nivel_2_preg_01.wav', 'A', '2023-07-21 21:33:36', NULL, NULL),
(4, 1, 'Presiona todos los numeros', 'nivel_1_preg_04.wav', 'A', '2023-07-20 21:41:17', NULL, NULL),
(7, 2, 'Encuentra el mismo número.', 'nivel_2_preg_02.wav', 'A', '2023-07-21 21:33:36', NULL, NULL),
(8, 2, 'Encuentra el mismo número.', 'nivel_2_preg_03.wav', 'A', '2023-07-21 22:56:04', NULL, NULL),
(9, 2, 'Encuentra el mismo número.', 'nivel_2_preg_04.wav', 'A', '2023-07-21 22:56:04', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rols`
--

DROP TABLE IF EXISTS `rols`;
CREATE TABLE IF NOT EXISTS `rols` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(220) NOT NULL,
  `descripcion` text,
  `estado` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rols`
--

INSERT INTO `rols` (`id`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'Administrador', 'Personal encargado de todas las funciones del administrador', 'A'),
(2, 'Auditor', 'Personal encargado del uso correcto del administrador', 'E'),
(3, 'modulador', 'Personal encargado de modulos especificos del administrador', 'E'),
(4, 'Estudiante', 'Alumno de la plataforma', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cod_usu` varchar(10) NOT NULL,
  `rol` varchar(120) NOT NULL,
  `imagen` varchar(320) NOT NULL,
  `nombres` varchar(120) NOT NULL,
  `apellidos` varchar(120) NOT NULL,
  `di` varchar(120) NOT NULL,
  `direccion` varchar(220) NOT NULL,
  `telefono` varchar(120) NOT NULL,
  `correo` varchar(120) NOT NULL,
  `pwd` varchar(320) NOT NULL,
  `fechNanc` date NOT NULL,
  `fe_creacion` datetime NOT NULL,
  `fe_modificacion` datetime NOT NULL,
  `fe_lastlogin` datetime NOT NULL,
  `estado` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `cod_usu`, `rol`, `imagen`, `nombres`, `apellidos`, `di`, `direccion`, `telefono`, `correo`, `pwd`, `fechNanc`, `fe_creacion`, `fe_modificacion`, `fe_lastlogin`, `estado`) VALUES
(1, 'COD-0001', '1', '', 'ADMIN', 'ADMIN', '12345678', '', '', 'admin@administrador.com', '202cb962ac59075b964b07152d234b70', '1990-11-14', '2020-11-14 00:00:00', '2020-11-14 15:50:06', '2023-07-20 23:29:49', 'A'),
(2, 'ES-000001', '4', '', 'Estudiante', 'Prueba', '44324567', 'Av. Tacna 22 - Lima', '998345678', 'estudiante01@pukchi.com', 'caf1a3dfb505ffed0d024130f58c5cfa', '2020-07-01', '2023-07-18 03:18:10', '2023-07-18 03:18:10', '2023-07-18 01:55:38', 'A');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
