-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2021 a las 13:52:39
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `discos`
--
CREATE DATABASE IF NOT EXISTS `discos` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `discos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `album`
--

DROP TABLE IF EXISTS `album`;
CREATE TABLE `album` (
  `idalbum` int(11) NOT NULL,
  `titulo` varchar(120) NOT NULL,
  `year` year(4) NOT NULL,
  `idgenero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `album`
--

INSERT INTO `album` (`idalbum`, `titulo`, `year`, `idgenero`) VALUES
(1, 'November Rain', 1991, 2),
(2, 'Du Hast', 1997, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artista`
--

DROP TABLE IF EXISTS `artista`;
CREATE TABLE `artista` (
  `idartista` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `nacionalidad` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `artista`
--

INSERT INTO `artista` (`idartista`, `nombre`, `nacionalidad`) VALUES
(1, 'Guns N\' Roses', 'USA'),
(2, 'Rammstein', 'GER');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

DROP TABLE IF EXISTS `genero`;
CREATE TABLE `genero` (
  `idgenero` int(11) NOT NULL,
  `genero` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`idgenero`, `genero`) VALUES
(1, 'pop'),
(2, 'rock'),
(4, 'jazz'),
(5, 'clásica'),
(6, 'heavy'),
(7, 'ligera'),
(8, 'bso'),
(9, 'étnica'),
(10, 'trash'),
(11, 'ópera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relartistaalbum`
--

DROP TABLE IF EXISTS `relartistaalbum`;
CREATE TABLE `relartistaalbum` (
  `idartista` int(11) NOT NULL,
  `idalbum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `relartistaalbum`
--

INSERT INTO `relartistaalbum` (`idartista`, `idalbum`) VALUES
(1, 1),
(2, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`idalbum`),
  ADD KEY `idgenero` (`idgenero`);

--
-- Indices de la tabla `artista`
--
ALTER TABLE `artista`
  ADD PRIMARY KEY (`idartista`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`idgenero`);

--
-- Indices de la tabla `relartistaalbum`
--
ALTER TABLE `relartistaalbum`
  ADD PRIMARY KEY (`idartista`,`idalbum`),
  ADD KEY `relartistaalbum_ibfk_2` (`idalbum`),
  ADD KEY `idartista` (`idartista`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `album`
--
ALTER TABLE `album`
  MODIFY `idalbum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `artista`
--
ALTER TABLE `artista`
  MODIFY `idartista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `idgenero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`idgenero`) REFERENCES `genero` (`idgenero`);

--
-- Filtros para la tabla `relartistaalbum`
--
ALTER TABLE `relartistaalbum`
  ADD CONSTRAINT `relartistaalbum_ibfk_1` FOREIGN KEY (`idartista`) REFERENCES `artista` (`idartista`),
  ADD CONSTRAINT `relartistaalbum_ibfk_2` FOREIGN KEY (`idalbum`) REFERENCES `album` (`idalbum`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
