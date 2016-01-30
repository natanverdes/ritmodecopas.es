-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-02-2015 a las 20:17:57
-- Versión del servidor: 5.5.41-cll-lve
-- Versión de PHP: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `dpobujny_territorios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `congregacion`
--

CREATE TABLE IF NOT EXISTS `congregacion` (
  `id_congregacion` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `correo_electronico` varchar(255) NOT NULL,
  `config_min_salida` int(11) NOT NULL,
  `config_max_salida` int(11) NOT NULL,
  `config_min_entrada` int(11) NOT NULL,
  `config_max_entrada` int(11) NOT NULL,
  PRIMARY KEY (`id_congregacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `congregacion`
--

INSERT INTO `congregacion` (`id_congregacion`, `usuario`, `contrasena`, `correo_electronico`, `config_min_salida`, `config_max_salida`, `config_min_entrada`, `config_max_entrada`) VALUES
(1, 'ramblas', '4c9590d0b5d424c653a118e93e27bbe0', 'natverber@gmail.com', 180, 90, 180, 90);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento`
--

CREATE TABLE IF NOT EXISTS `movimiento` (
  `id_territorio` int(11) NOT NULL,
  `id_publicador` int(11) NOT NULL,
  `fecha_salida` date NOT NULL,
  `fecha_entrada` date DEFAULT NULL,
  `comentario` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_territorio`,`id_publicador`,`fecha_salida`),
  KEY `id_publicador` (`id_publicador`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicador`
--

CREATE TABLE IF NOT EXISTS `publicador` (
  `id_publicador` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `id_congregacion` int(11) NOT NULL,
  `activo` int(11) NOT NULL,
  PRIMARY KEY (`id_publicador`),
  KEY `id_congregacion` (`id_congregacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `territorio`
--

CREATE TABLE IF NOT EXISTS `territorio` (
  `id_territorio` int(11) NOT NULL AUTO_INCREMENT,
  `id_congregacion` int(11) NOT NULL,
  `numero_territorio` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `localizacion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_territorio`),
  KEY `id_congregacion` (`id_congregacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=139 ;

--
-- Volcado de datos para la tabla `territorio`
--

INSERT INTO `territorio` (`id_territorio`, `id_congregacion`, `numero_territorio`, `tipo`, `localizacion`) VALUES
(1, 1, 1, 0, 'Nada'),
(2, 1, 2, 0, ''),
(3, 1, 3, 0, 'Enric Granados / Aragón'),
(4, 1, 4, 0, 'Nada'),
(6, 1, 6, 0, 'Balmes/ C.Valencia'),
(7, 1, 7, 0, ''),
(8, 1, 8, 0, ''),
(9, 1, 9, 0, ''),
(10, 1, 10, 0, 'C.Aribau/ C.Concell de Cent'),
(11, 1, 11, 0, ''),
(12, 1, 12, 0, ''),
(13, 1, 13, 0, ''),
(14, 1, 14, 0, ''),
(15, 1, 15, 0, ''),
(16, 1, 16, 0, ''),
(17, 1, 17, 0, ''),
(18, 1, 18, 0, ''),
(19, 1, 19, 0, ''),
(20, 1, 20, 0, ''),
(21, 1, 21, 0, ''),
(22, 1, 22, 0, ''),
(23, 1, 23, 0, ''),
(24, 1, 24, 0, ''),
(25, 1, 25, 0, ''),
(26, 1, 26, 0, ''),
(27, 1, 27, 0, ''),
(28, 1, 28, 0, ''),
(29, 1, 29, 0, ''),
(30, 1, 30, 0, ''),
(31, 1, 31, 0, ''),
(32, 1, 32, 0, ''),
(33, 1, 33, 0, ''),
(34, 1, 34, 0, ''),
(35, 1, 35, 0, ''),
(36, 1, 36, 0, ''),
(37, 1, 37, 0, ''),
(38, 1, 38, 0, ''),
(39, 1, 39, 0, ''),
(40, 1, 40, 0, ''),
(41, 1, 41, 0, ''),
(42, 1, 42, 0, ''),
(43, 1, 43, 0, ''),
(44, 1, 44, 0, ''),
(45, 1, 45, 0, ''),
(46, 1, 46, 0, ''),
(47, 1, 47, 0, ''),
(48, 1, 48, 0, ''),
(49, 1, 49, 0, ''),
(50, 1, 50, 0, ''),
(51, 1, 51, 0, ''),
(52, 1, 52, 0, ''),
(53, 1, 53, 0, ''),
(54, 1, 54, 0, ''),
(55, 1, 55, 0, ''),
(56, 1, 56, 0, ''),
(57, 1, 57, 0, ''),
(58, 1, 58, 0, ''),
(59, 1, 59, 0, ''),
(60, 1, 60, 0, ''),
(61, 1, 61, 0, ''),
(62, 1, 62, 0, ''),
(63, 1, 63, 0, ''),
(64, 1, 64, 0, ''),
(65, 1, 65, 0, ''),
(66, 1, 66, 0, ''),
(67, 1, 67, 0, ''),
(68, 1, 68, 0, ''),
(69, 1, 69, 0, ''),
(70, 1, 70, 0, ''),
(71, 1, 71, 0, ''),
(72, 1, 72, 0, ''),
(73, 1, 73, 0, ''),
(74, 1, 74, 0, ''),
(75, 1, 75, 0, ''),
(76, 1, 76, 0, ''),
(77, 1, 77, 0, ''),
(78, 1, 78, 0, ''),
(79, 1, 79, 0, ''),
(80, 1, 80, 0, ''),
(81, 1, 81, 0, ''),
(82, 1, 82, 0, ''),
(83, 1, 83, 0, ''),
(84, 1, 84, 0, ''),
(85, 1, 85, 0, ''),
(86, 1, 86, 0, ''),
(87, 1, 87, 0, ''),
(88, 1, 88, 0, ''),
(89, 1, 89, 0, ''),
(90, 1, 90, 0, ''),
(91, 1, 91, 0, ''),
(92, 1, 92, 0, ''),
(93, 1, 93, 0, ''),
(94, 1, 94, 0, ''),
(95, 1, 95, 0, ''),
(96, 1, 96, 0, ''),
(97, 1, 97, 0, ''),
(98, 1, 98, 0, ''),
(99, 1, 99, 0, ''),
(100, 1, 100, 0, ''),
(101, 1, 101, 0, ''),
(102, 1, 102, 0, ''),
(103, 1, 103, 0, ''),
(104, 1, 1, 1, ''),
(105, 1, 2, 1, ''),
(106, 1, 3, 1, ''),
(107, 1, 4, 1, ''),
(108, 1, 5, 1, ''),
(109, 1, 6, 1, ''),
(110, 1, 7, 1, ''),
(111, 1, 8, 1, ''),
(112, 1, 9, 1, ''),
(113, 1, 10, 1, ''),
(114, 1, 11, 1, ''),
(115, 1, 12, 1, ''),
(116, 1, 13, 1, ''),
(117, 1, 14, 1, ''),
(118, 1, 15, 1, ''),
(119, 1, 16, 1, ''),
(120, 1, 17, 1, ''),
(121, 1, 18, 1, ''),
(122, 1, 19, 1, ''),
(123, 1, 20, 1, ''),
(124, 1, 21, 1, ''),
(125, 1, 22, 1, ''),
(126, 1, 23, 1, ''),
(127, 1, 24, 1, ''),
(128, 1, 25, 1, ''),
(129, 1, 26, 1, ''),
(130, 1, 27, 1, ''),
(131, 1, 28, 1, ''),
(132, 1, 29, 1, ''),
(133, 1, 30, 1, ''),
(134, 1, 1, 2, ''),
(135, 1, 2, 2, ''),
(136, 1, 3, 2, ''),
(137, 1, 4, 2, ''),
(138, 1, 5, 2, '');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `movimiento`
--
ALTER TABLE `movimiento`
  ADD CONSTRAINT `movimiento_ibfk_1` FOREIGN KEY (`id_territorio`) REFERENCES `territorio` (`id_territorio`),
  ADD CONSTRAINT `movimiento_ibfk_2` FOREIGN KEY (`id_publicador`) REFERENCES `publicador` (`id_publicador`);

--
-- Filtros para la tabla `publicador`
--
ALTER TABLE `publicador`
  ADD CONSTRAINT `publicador_ibfk_1` FOREIGN KEY (`id_congregacion`) REFERENCES `congregacion` (`id_congregacion`);

--
-- Filtros para la tabla `territorio`
--
ALTER TABLE `territorio`
  ADD CONSTRAINT `territorio_ibfk_1` FOREIGN KEY (`id_congregacion`) REFERENCES `congregacion` (`id_congregacion`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
