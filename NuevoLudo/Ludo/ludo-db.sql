-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 31-05-2023 a las 23:38:55
-- Versión del servidor: 8.0.18
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ludo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `IdJuego` int(11) NOT NULL,
  `Puntaje` double DEFAULT NULL,
  `NombreJuego` varchar(50) DEFAULT NULL,
  `FechaPartida` datetime DEFAULT CURRENT_TIMESTAMP,
  `NumeroPartida` int(11) DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `IdNivel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`IdJuego`, `Puntaje`, `NombreJuego`, `FechaPartida`, `NumeroPartida`, `IdUsuario`, `IdNivel`) VALUES
(1, 300, 'Cartas', '2023-05-31 16:52:04', 12312, 1, 1),
(2, 300, 'Cartas', '2023-05-31 16:52:38', 12312, 1, 1),
(5, 275, 'Cartas', '2023-05-31 17:32:58', 872, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles`
--

CREATE TABLE `niveles` (
  `IdNivel` int(11) NOT NULL,
  `NombreNivel` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `niveles`
--

INSERT INTO `niveles` (`IdNivel`, `NombreNivel`) VALUES
(1, 'nivel1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `IdRol` int(11) NOT NULL,
  `Rol` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`IdRol`, `Rol`) VALUES
(1, 'Jugador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IdUsuarios` int(11) NOT NULL,
  `Nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `IdRol` int(11) DEFAULT NULL,
  `Email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Clave` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUsuarios`, `Nombre`, `IdRol`, `Email`, `Clave`, `Estado`) VALUES
(1, 'alejandro', 1, 'alejandro010916@hotmail.com', '1234', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`IdJuego`),
  ADD KEY `IdUsuario` (`IdUsuario`),
  ADD KEY `IdNivel` (`IdNivel`);

--
-- Indices de la tabla `niveles`
--
ALTER TABLE `niveles`
  ADD PRIMARY KEY (`IdNivel`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`IdRol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUsuarios`),
  ADD KEY `IdRol` (`IdRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `IdJuego` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `niveles`
--
ALTER TABLE `niveles`
  MODIFY `IdNivel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `IdRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUsuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD CONSTRAINT `juegos_ibfk_1` FOREIGN KEY (`IdUsuario`) REFERENCES `usuarios` (`IdUsuarios`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `juegos_ibfk_2` FOREIGN KEY (`IdNivel`) REFERENCES `niveles` (`IdNivel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`IdRol`) REFERENCES `rol` (`IdRol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
