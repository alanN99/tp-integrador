-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-11-2021 a las 03:21:11
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tpintegrador`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `numero` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `detalle` varchar(45) NOT NULL,
  `importe` decimal(15,2) UNSIGNED NOT NULL,
  `ciudad` varchar(45) NOT NULL,
  `calle` varchar(45) NOT NULL,
  `altura` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`numero`, `id_usuario`, `nombre`, `apellido`, `detalle`, `importe`, `ciudad`, `calle`, `altura`) VALUES
(1, 1, 'Carlos', 'Santana', 'facturación octubre', '0.00', 'Mitre', '120000', 1234),
(2, 1, 'David', 'Gilmour', 'cuerdas', '0.00', '9 de Julio', '7500', 7421),
(3, 1, 'Sid', 'Vicious', 'vino', '0.00', 'Lascala', '540', 125),
(4, 2, 'Freddie', 'Mercury', 'compra super', '0.00', 'asd', '5200', 123),
(5, 2, 'Roger', 'Watters', 'Bajo', '0.00', 'Brooklyn', '152000', 4587),
(6, 2, 'Diego', 'Arnedo', 'colectivo', '0.00', 'Laprida', '456', 258),
(9, 2, 'Kirk', 'Hammet', 'chicles', '45.00', 'California', 'qweqwr', 123345),
(11, 2, 'David', 'Bowie', 'Whisky', '768.00', 'New York', 'Central Park', 9964);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `nombre`, `apellido`) VALUES
(1, 'ejemplo', '$2y$10$MKEZOE1o/HEE2KAgDMBkq.j6kjw0tiu.FGMSKLdi9wU8MMDQIlpFO', 'Fulano', 'de Tal'),
(2, 'alan', '$2y$10$TdCXnyfdC75h.ExzTaJ7WObv1I8I3olwli4shznazp6qn9E2sOAOe', 'alan', 'nanni');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`numero`),
  ADD KEY `fk_usuarios_idx` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `numero` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `fk_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
