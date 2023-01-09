-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-01-2023 a las 01:03:45
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `app_permisos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `id_modulo` int NOT NULL,
  `name_modulo` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`id_modulo`, `name_modulo`) VALUES
(1, 'Usuarios'),
(2, 'Roles'),
(3, 'Permisos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission`
--

CREATE TABLE `permission` (
  `id_permiso` int NOT NULL,
  `name_permiso` varchar(70) NOT NULL,
  `descripcion` varchar(80) NOT NULL,
  `id_modulo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_role` int NOT NULL,
  `name_rol` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_has_permission`
--

CREATE TABLE `rol_has_permission` (
  `id_permiso` int NOT NULL,
  `id_role` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int NOT NULL,
  `username` varchar(70) NOT NULL,
  `email` varchar(95) NOT NULL,
  `pasword` varchar(60) NOT NULL,
  `foto` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_has_role`
--

CREATE TABLE `usuario_has_role` (
  `id_usuario` int NOT NULL,
  `id_role` int NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `session` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id_permiso`),
  ADD KEY `fk_PERMISSION_MODULO_idx` (`id_modulo`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_role`);

--
-- Indices de la tabla `rol_has_permission`
--
ALTER TABLE `rol_has_permission`
  ADD PRIMARY KEY (`id_permiso`,`id_role`),
  ADD KEY `fk_PERMISSION_has_ROL_ROL1_idx` (`id_role`),
  ADD KEY `fk_PERMISSION_has_ROL_PERMISSION1_idx` (`id_permiso`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `usuario_has_role`
--
ALTER TABLE `usuario_has_role`
  ADD PRIMARY KEY (`id_usuario`,`id_role`),
  ADD KEY `fk_USUARIO_has_ROL_ROL1_idx` (`id_role`),
  ADD KEY `fk_USUARIO_has_ROL_USUARIO1_idx` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `id_modulo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `permission`
--
ALTER TABLE `permission`
  MODIFY `id_permiso` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_role` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `fk_PERMISSION_MODULO` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id_modulo`);

--
-- Filtros para la tabla `rol_has_permission`
--
ALTER TABLE `rol_has_permission`
  ADD CONSTRAINT `fk_PERMISSION_has_ROL_PERMISSION1` FOREIGN KEY (`id_permiso`) REFERENCES `permission` (`id_permiso`),
  ADD CONSTRAINT `fk_PERMISSION_has_ROL_ROL1` FOREIGN KEY (`id_role`) REFERENCES `rol` (`id_role`);

--
-- Filtros para la tabla `usuario_has_role`
--
ALTER TABLE `usuario_has_role`
  ADD CONSTRAINT `fk_USUARIO_has_ROL_ROL1` FOREIGN KEY (`id_role`) REFERENCES `rol` (`id_role`),
  ADD CONSTRAINT `fk_USUARIO_has_ROL_USUARIO1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
