-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2025 a las 01:50:57
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hermesbeta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autorizaciones`
--

CREATE TABLE `autorizaciones` (
  `id_autorizacion` int(11) NOT NULL,
  `id_prestamo` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_autorizacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `motivo_rechazo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `autorizaciones`
--

INSERT INTO `autorizaciones` (`id_autorizacion`, `id_prestamo`, `id_rol`, `id_usuario`, `fecha_autorizacion`, `motivo_rechazo`) VALUES
(1, 2, 5, 57, '2025-04-18 21:00:00', NULL),
(2, 4, 5, 57, '2025-04-20 15:30:00', 'No se justifica la necesidad'),
(3, 2, 7, 47, '2025-04-18 21:05:00', NULL),
(4, 4, 7, 47, '2025-04-20 16:00:00', NULL),
(5, 1, 6, 60, '2025-04-18 19:55:00', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autorizaciones`
--
ALTER TABLE `autorizaciones`
  ADD PRIMARY KEY (`id_autorizacion`),
  ADD KEY `fk_autorizaciones_prestamos` (`id_prestamo`),
  ADD KEY `fk_autorizaciones_roles` (`id_rol`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `autorizaciones`
--
ALTER TABLE `autorizaciones`
  ADD CONSTRAINT `fk_autorizaciones_prestamos` FOREIGN KEY (`id_prestamo`) REFERENCES `prestamos` (`id_prestamo`),
  ADD CONSTRAINT `fk_autorizaciones_roles` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
