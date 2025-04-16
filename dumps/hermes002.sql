-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-04-2025 a las 20:19:55
-- Versión del servidor: 9.1.0
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hermes002`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aprendices_ficha`
--

CREATE TABLE `aprendices_ficha` (
  `id_aprendiz_ficha` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_ficha` int NOT NULL,
  `fecha_asignacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('activo','inactivo','desertor','trasladado') DEFAULT 'activo'
) 

--
-- Volcado de datos para la tabla `aprendices_ficha`
--

INSERT INTO `aprendices_ficha` (`id_aprendiz_ficha`, `id_usuario`, `id_ficha`, `fecha_asignacion`, `estado`) VALUES
(2, 44, 5, '2025-04-04 17:32:43', 'activo'),
(3, 50, 4, '2025-04-04 17:32:43', 'activo'),
(4, 60, 10, '2025-04-04 17:32:43', 'activo'),
(5, 72, 11, '2025-04-13 17:11:36', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichas`
--

CREATE TABLE `fichas` (
  `id_ficha` int NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `id_sede` int NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('activa','inactiva') DEFAULT 'activa'
) 

--
-- Volcado de datos para la tabla `fichas`
--

INSERT INTO `fichas` (`id_ficha`, `codigo`, `descripcion`, `id_sede`, `fecha_inicio`, `fecha_fin`, `fecha_creacion`, `estado`) VALUES
(1, '1000001', 'Tecnología en Análisis y Desarrollo de Software', 1, '2024-01-15', '2024-12-15', '2025-03-24 23:26:50', 'inactiva'),
(2, '1000002', 'Técnico en Sistemas', 28, '2024-02-01', '2024-11-30', '2025-03-24 23:26:50', 'activa'),
(3, '1000003', 'Gestión Administrativa', 3, '2024-03-10', '2024-12-10', '2025-03-24 23:26:50', 'activa'),
(4, '1000004', 'Diseño e Integración de Multimedia', 27, '2024-04-05', '2025-03-05', '2025-03-24 23:26:50', 'activa'),
(5, '1000005', 'Producción Agropecuaria', 28, '2024-05-20', '2025-04-20', '2025-03-24 23:26:50', 'inactiva'),
(6, '1000006', 'Electricidad Industrial', 1, '2024-06-01', '2025-05-01', '2025-03-24 23:26:50', 'activa'),
(7, '1000007', 'Mecánica Automotriz', 2, '2024-07-15', '2025-06-15', '2025-03-24 23:26:50', 'activa'),
(8, '1000008', 'Contabilidad y Finanzas', 28, '2024-08-10', '2025-07-10', '2025-03-24 23:26:50', 'activa'),
(9, '1000009', 'Seguridad y Salud en el Trabajo', 27, '2024-09-05', '2025-08-05', '2025-03-24 23:26:50', 'inactiva'),
(10, '1000010', 'Redes y Telecomunicaciones', 28, '2024-10-20', '2025-09-20', '2025-03-24 23:26:50', 'activa'),
(11, '2847523', 'ADSO', 1, '2025-03-01', '2025-03-31', '2025-03-25 01:00:56', 'activa'),
(12, '1111', 'ADSO', 28, '2025-03-01', '2025-03-29', '2025-03-26 17:44:36', 'activa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_roles`
--

CREATE TABLE `historial_roles` (
  `id_historial` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_rol_anterior` int DEFAULT NULL,
  `id_rol_nuevo` int NOT NULL,
  `fecha_cambio` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario_modificador` int NOT NULL
) 

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id_modulo` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('activo','inactivo') DEFAULT 'activo'
) 

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id_modulo`, `nombre`, `descripcion`, `fecha_creacion`, `estado`) VALUES
(1, 'Gestión de equipos', 'Módulo para administrar equipos tecnológicos', '2025-03-22 16:35:28', 'activo'),
(2, 'Gestión de solicitudes', 'Módulo para gestionar solicitudes y asignaciones de equipos', '2025-03-22 16:35:28', 'activo'),
(3, 'Devoluciones', 'Módulo para gestionar devoluciones de equipos', '2025-03-22 16:35:28', 'activo'),
(4, 'Salidas', 'Módulo para controlar salidas de equipos', '2025-03-22 16:35:28', 'activo'),
(5, 'Configuración', 'Módulo para configuración general del sistema', '2025-03-22 16:35:28', 'activo'),
(6, 'Autorizaciones', 'Módulo para la autorización de las solicitudes ', '2025-03-31 01:40:46', 'activo'),
(7, 'Fichas', 'Módulo para administrar las fichas', '2025-04-14 22:54:08', 'activo'),
(8, 'Sedes', 'Módulo para la administración de las sedes', '2025-04-16 17:00:23', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int NOT NULL,
  `id_modulo` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('activo','inactivo') DEFAULT 'activo'
) 

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `id_modulo`, `nombre`, `descripcion`, `fecha_creacion`, `estado`) VALUES
(1, 1, 'Registrar equipooooo', 'Crear nuevos equipos en el sistemas', '2025-03-22 16:35:28', 'activo'),
(2, 1, 'Consultar equipos', 'Consultar información de equipos', '2025-03-22 16:35:28', 'activo'),
(3, 1, 'Modificar equipos', 'Modificar información de equipos', '2025-03-22 16:35:28', 'activo'),
(4, 1, 'Inhabilitar equipos', 'Inhabilitar equipos', '2025-03-22 16:35:28', 'activo'),
(5, 1, 'Asignar equipos', 'Asignar equipos a cuentadantes', '2025-03-22 16:35:28', 'activo'),
(6, 1, 'Revisar equipos', 'Revisar el estado de los equipos', '2025-03-22 16:35:28', 'activo'),
(7, 2, 'Realizar solicitudes', 'Realizar solicitudes de préstamo', '2025-03-22 16:35:28', 'activo'),
(8, 2, 'Consultar equipos', 'Consultar información de equipos para solicitudes', '2025-03-22 16:35:28', 'activo'),
(9, 2, 'Cancelar solicitudes', 'Cancelar solicitudes', '2025-03-22 16:35:28', 'activo'),
(10, 2, 'Aprobar solicitudes', 'Aprobar solicitudes de préstamo', '2025-03-22 16:35:28', 'activo'),
(11, 2, 'Entregar equipos', 'Entregar equipos a los usuarios', '2025-03-22 16:35:28', 'activo'),
(12, 3, 'Recibir equipos', 'Registrar la devolución de equipos', '2025-03-22 16:35:28', 'activo'),
(13, 3, 'Consultar solicitudes', 'Consultar solicitudes relacionadas con devoluciones', '2025-03-22 16:35:28', 'activo'),
(14, 3, 'Revisar equipos', 'Revisar el estado de los equipos devueltos', '2025-03-22 16:35:28', 'activo'),
(15, 3, 'Actualizar estados', 'Actualizar el estado de los equipos', '2025-03-22 16:35:28', 'activo'),
(16, 4, 'Autorizar salidas', 'Autorizar salidas de equipos', '2025-03-22 16:35:28', 'activo'),
(17, 4, 'Verificar autorizaciones', 'Verificar autorizaciones de salida', '2025-03-22 16:35:28', 'activo'),
(18, 4, 'Consultar salidas', 'Consultar registros de salidas de equipos', '2025-03-22 16:35:28', 'activo'),
(19, 5, 'Configuraraciones ', 'Acceso a configuraciones del sistema', '2025-03-22 16:35:28', 'activo'),
(20, 5, 'Gestionar usuarios', 'Gestionar usuarios del sistema', '2025-03-22 16:35:28', 'activo'),
(21, 5, 'Gestionar roles', 'Gestionar roles y permisos', '2025-03-22 16:35:28', 'activo'),
(22, 7, 'Gestionar fichas', 'Gestionar las fichas del sistema', '2025-04-14 22:57:21', 'activo'),
(23, 8, 'Editar sedes', 'Realizar cambios en la información de las sedes', '2025-04-16 17:03:36', 'activo'),
(24, 8, 'Crear sedes', 'Crear nuevas sedes en el sistema', '2025-04-16 17:03:36', 'activo'),
(25, 8, 'Consultar sedes', 'Permite entrar a consultar las sedes del sistema', '2025-04-16 18:13:24', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int NOT NULL,
  `nombre_rol` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('activo','inactivo') DEFAULT 'activo'
) 

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`, `descripcion`, `fecha_creacion`, `estado`) VALUES
(1, 'Líder TIC', 'Rol con acceso completo a todos los módulos y permisos', '2025-03-22 16:35:28', 'activo'),
(2, 'Mesa de ayuda', 'Rol con permisos limitados para atención de solicitudes', '2025-03-22 16:35:28', 'activo'),
(3, 'Almacén', 'Rol con permisos para gestionar equipos y solicitudes', '2025-03-22 16:35:28', 'activo'),
(4, 'Biblioteca', 'Rol con permisos para consultar equipos y gestionar solicitudes', '2025-03-22 16:35:28', 'activo'),
(5, 'Coordinación', 'Rol con permisos similares a adminBiblioteca', '2025-03-22 16:35:28', 'activo'),
(6, 'Aprendiz', 'Rol con permisos limitados para realizar solicitudes', '2025-03-22 16:35:28', 'activo'),
(7, 'Instructor', 'Rol con permisos para solicitudes y autorizar salidas', '2025-03-22 16:35:28', 'activo'),
(8, 'Vigilante', 'Rol con permisos para verificar autorizaciones', '2025-03-22 16:35:28', 'activo'),
(9, 'Administrador', 'Rol con acceso completo a todos los módulos y configuración', '2025-03-22 16:35:28', 'activo'),
(10, 'Auxiliar administrativo', 'permisos de coordinación pero limitados', '2025-03-29 18:46:36', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_permiso`
--

CREATE TABLE `rol_permiso` (
  `id_rol` int NOT NULL,
  `id_permiso` int NOT NULL,
  `fecha_asignacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) 

--
-- Volcado de datos para la tabla `rol_permiso`
--

INSERT INTO `rol_permiso` (`id_rol`, `id_permiso`, `fecha_asignacion`) VALUES
(1, 1, '2025-03-22 16:35:28'),
(1, 2, '2025-03-22 16:35:28'),
(1, 3, '2025-03-22 16:35:28'),
(1, 4, '2025-03-22 16:35:28'),
(1, 5, '2025-03-22 16:35:28'),
(1, 6, '2025-03-22 16:35:28'),
(1, 7, '2025-03-22 16:35:28'),
(1, 8, '2025-03-22 16:35:28'),
(1, 9, '2025-03-22 16:35:28'),
(1, 10, '2025-03-22 16:35:28'),
(1, 11, '2025-03-22 16:35:28'),
(1, 12, '2025-03-22 16:35:28'),
(1, 13, '2025-03-22 16:35:28'),
(1, 14, '2025-03-22 16:35:28'),
(1, 15, '2025-03-22 16:35:28'),
(1, 16, '2025-03-22 16:35:28'),
(1, 17, '2025-03-22 16:35:28'),
(1, 18, '2025-03-22 16:35:28'),
(1, 19, '2025-03-22 16:35:28'),
(1, 20, '2025-03-22 16:35:28'),
(1, 21, '2025-03-22 16:35:28'),
(2, 2, '2025-04-16 18:15:44'),
(2, 6, '2025-04-16 18:15:44'),
(2, 12, '2025-04-16 18:15:44'),
(2, 14, '2025-04-16 18:15:44'),
(2, 15, '2025-04-16 18:15:44'),
(2, 25, '2025-04-16 18:15:44'),
(3, 1, '2025-03-22 16:35:28'),
(3, 2, '2025-03-22 16:35:28'),
(3, 3, '2025-03-22 16:35:28'),
(3, 4, '2025-03-22 16:35:28'),
(3, 5, '2025-03-22 16:35:28'),
(3, 7, '2025-03-22 16:35:28'),
(3, 8, '2025-03-22 16:35:28'),
(3, 9, '2025-03-22 16:35:28'),
(3, 10, '2025-03-22 16:35:28'),
(3, 11, '2025-03-22 16:35:28'),
(3, 12, '2025-03-22 16:35:28'),
(3, 13, '2025-03-22 16:35:28'),
(4, 2, '2025-03-22 16:35:28'),
(4, 7, '2025-03-22 16:35:28'),
(4, 8, '2025-03-22 16:35:28'),
(4, 9, '2025-03-22 16:35:28'),
(4, 10, '2025-03-22 16:35:28'),
(4, 11, '2025-03-22 16:35:28'),
(4, 12, '2025-03-22 16:35:28'),
(4, 13, '2025-03-22 16:35:28'),
(5, 2, '2025-03-22 16:35:28'),
(5, 7, '2025-03-22 16:35:28'),
(5, 8, '2025-03-22 16:35:28'),
(5, 9, '2025-03-22 16:35:28'),
(5, 10, '2025-03-22 16:35:28'),
(5, 11, '2025-03-22 16:35:28'),
(5, 12, '2025-03-22 16:35:28'),
(5, 13, '2025-03-22 16:35:28'),
(6, 7, '2025-03-22 16:35:28'),
(6, 8, '2025-03-22 16:35:28'),
(6, 9, '2025-03-22 16:35:28'),
(7, 7, '2025-03-22 16:35:28'),
(7, 8, '2025-03-22 16:35:28'),
(7, 9, '2025-03-22 16:35:28'),
(7, 16, '2025-03-22 16:35:28'),
(8, 17, '2025-04-13 18:23:05'),
(8, 18, '2025-04-13 18:23:05'),
(9, 1, '2025-04-16 17:04:20'),
(9, 2, '2025-04-16 17:04:20'),
(9, 3, '2025-04-16 17:04:20'),
(9, 4, '2025-04-16 17:04:20'),
(9, 5, '2025-04-16 17:04:20'),
(9, 6, '2025-04-16 17:04:20'),
(9, 7, '2025-04-16 17:04:20'),
(9, 8, '2025-04-16 17:04:20'),
(9, 9, '2025-04-16 17:04:20'),
(9, 10, '2025-04-16 17:04:20'),
(9, 11, '2025-04-16 17:04:20'),
(9, 12, '2025-04-16 17:04:20'),
(9, 13, '2025-04-16 17:04:20'),
(9, 14, '2025-04-16 17:04:20'),
(9, 15, '2025-04-16 17:04:20'),
(9, 16, '2025-04-16 17:04:20'),
(9, 17, '2025-04-16 17:04:20'),
(9, 18, '2025-04-16 17:04:20'),
(9, 19, '2025-04-16 17:04:20'),
(9, 20, '2025-04-16 17:04:20'),
(9, 21, '2025-04-16 17:04:20'),
(9, 22, '2025-04-16 17:04:20'),
(9, 23, '2025-04-16 17:04:20'),
(9, 24, '2025-04-16 17:04:20'),
(10, 18, '2025-04-13 21:51:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `id_sede` int NOT NULL,
  `nombre_sede` varchar(100) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('activa','inactiva') DEFAULT 'activa'
) 

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`id_sede`, `nombre_sede`, `direccion`, `descripcion`, `fecha_creacion`, `estado`) VALUES
(1, 'Sede Principal', 'Carrera 50 #10-25', 'Sede central con capacidad para 1000 aprendices', '2025-03-23 15:18:06', 'activa'),
(2, 'Sede Norte', 'Calle 80 #45-12', 'Sede especializada en tecnologías de la información', '2025-03-23 15:18:06', 'inactiva'),
(3, 'Sede Sur', 'Avenida 1 de Mayo #30-15', 'Sede con enfoque en áreas industriales', '2025-03-23 15:18:06', 'activa'),
(27, 'Sagrado', 'Cra 26 25', 'Horario de formacion en ambas jornadas', '2025-03-24 14:57:38', 'activa'),
(28, 'Bicentenario', 'CC Bicentenario Plazas', 'dos salones de 25 aprendices (202 y 205)', '2025-03-24 14:57:58', 'activa'),
(29, 'aa', 'aa', 'aa', '2025-04-04 20:56:06', 'activa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL,
  `tipo_documento` varchar(5) NOT NULL,
  `numero_documento` varchar(30) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo_electronico` varchar(100) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `genero` int DEFAULT '3',
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) 

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `tipo_documento`, `numero_documento`, `nombre`, `apellido`, `correo_electronico`, `nombre_usuario`, `clave`, `telefono`, `direccion`, `genero`, `estado`, `fecha_registro`) VALUES
(1, 'CC', '1', 'Admin', 'Sistema', 'admin@sistema.com', 'admin', 'admin123', NULL, NULL, 3, 'activo', '2025-03-22 16:35:28'),
(42, 'CC', '1023456789', 'Juan', 'Pérez', 'juan.perez@email.com', 'juanperez1', 'clave123', NULL, NULL, 3, 'activo', '2025-04-02 03:29:02'),
(43, 'TI', '1234567', 'María', 'Gómez', 'maria.gomez@email.com', 'mariagomez2', 'clave123', NULL, NULL, 3, 'activo', '2025-04-02 03:29:02'),
(44, 'CC', '1098765432', 'Carlos', 'López', 'carlos.lopez@email.com', 'carloslopez3', 'clave123', NULL, NULL, 3, 'inactivo', '2025-04-02 03:29:02'),
(45, 'TI', '7654321', 'Ana', 'Martínez', 'ana.martinez@email.com', 'anamartinez4', 'clave123', NULL, NULL, 3, 'activo', '2025-04-02 03:29:02'),
(46, 'CC', '1002345678', 'Pedro', 'Sánchez', 'pedro.sanchez@email.com', 'pedrosanchez5', 'clave123', NULL, NULL, 3, 'activo', '2025-04-02 03:29:02'),
(47, 'TI', '1122334', 'Laura', 'Fernández', 'laura.fernandez@email.com', 'laurafernandez6', 'clave123', NULL, NULL, 3, 'activo', '2025-04-02 03:29:02'),
(48, 'CC', '1034567890', 'Luis', 'Torres', 'luis.torres@email.com', 'luistorres7', 'clave123', NULL, NULL, 3, 'activo', '2025-04-02 03:29:02'),
(49, 'TI', '2233445', 'Sofía', 'Ramírez', 'sofia.ramirez@email.com', 'sofiaramirez8', 'clave123', NULL, NULL, 3, 'inactivo', '2025-04-02 03:29:02'),
(50, 'CC', '1045678901', 'Andrés', 'Vargas', 'andres.vargas@email.com', 'andresvargas9', 'clave123', NULL, NULL, 3, 'activo', '2025-04-02 03:29:02'),
(51, 'TI', '3344556', 'Elena', 'Hernández', 'elena.hernandez@email.com', 'elenahernandez10', 'clave123', NULL, NULL, 3, 'activo', '2025-04-02 03:29:02'),
(52, 'CC', '1056789012', 'Gabriel', 'Castro', 'gabriel.castro@email.com', 'gabrielcastro11', 'clave123', NULL, NULL, 3, 'activo', '2025-04-02 03:29:02'),
(53, 'TI', '4455667', 'Paula', 'Ortega', 'paula.ortega@email.com', 'paulaortega12', 'clave123', NULL, NULL, 3, 'activo', '2025-04-02 03:29:02'),
(54, 'CC', '1067890123', 'Ricardo', 'Molina', 'ricardo.molina@email.com', 'ricardomolina13', 'clave123', NULL, NULL, 3, 'activo', '2025-04-02 03:29:02'),
(55, 'TI', '5566778', 'Fernanda', 'Ruiz', 'fernanda.ruiz@email.com', 'fernandaruiz14', 'clave123', NULL, NULL, 3, 'activo', '2025-04-02 03:29:02'),
(56, 'CC', '1078901234', 'Hugo', 'Silva', 'hugo.silva@email.com', 'hugosilva15', 'clave123', NULL, NULL, 3, 'activo', '2025-04-02 03:29:02'),
(57, 'TI', '6677889', 'Isabel', 'Jiménez', 'isabel.jimenez@email.com', 'isabeljimenez16', 'clave123', NULL, NULL, 3, 'activo', '2025-04-02 03:29:02'),
(58, 'CC', '1089012345', 'José', 'Morales', 'jose.morales@email.com', 'josemorales17', 'clave123', NULL, NULL, 3, 'activo', '2025-04-02 03:29:02'),
(59, 'TI', '7788990', 'Natalia', 'Paredes', 'natalia.paredes@email.com', 'nataliaparedes18', 'clave123', NULL, NULL, 3, 'activo', '2025-04-02 03:29:02'),
(60, 'CC', '1090123456', 'Emilio', 'Guzmán', 'emilio.guzman@email.com', 'emilioguzman19', 'clave123', NULL, NULL, 3, 'activo', '2025-04-02 03:29:02'),
(61, 'TI', '8899001', 'Valeria', 'Díaz', 'valeria.diaz@email.com', 'valeriadiaz20', 'clave123', NULL, NULL, 3, 'activo', '2025-04-02 03:29:02'),
(71, 'CC', '75', 'German', 'Ramirez', 'test@example.us', '75', '75', '6019521325', 'calle 20 33a42', 2, 'activo', '2025-04-04 16:00:40'),
(72, 'CC', '1116', 'Alonso', 'Arboleda', 'teste@exemplo.us', '1116', '1116', '315', 'calle 20 33a42', 2, 'activo', '2025-04-04 16:16:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `id_usuario` int NOT NULL,
  `id_rol` int NOT NULL,
  `fecha_asignacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) 

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`id_usuario`, `id_rol`, `fecha_asignacion`) VALUES
(1, 9, '2025-03-22 16:35:28'),
(42, 2, '2025-04-04 17:26:54'),
(43, 5, '2025-04-04 17:26:54'),
(44, 6, '2025-04-04 17:26:54'),
(45, 8, '2025-04-04 17:26:54'),
(46, 9, '2025-04-04 17:26:54'),
(47, 7, '2025-04-04 17:26:54'),
(48, 10, '2025-04-04 17:26:54'),
(49, 8, '2025-04-04 17:26:54'),
(50, 6, '2025-04-04 17:26:54'),
(51, 9, '2025-04-04 17:26:54'),
(52, 2, '2025-04-04 17:26:54'),
(53, 1, '2025-04-04 17:26:54'),
(54, 8, '2025-04-04 17:26:54'),
(55, 9, '2025-04-04 17:26:54'),
(56, 8, '2025-04-04 17:26:54'),
(57, 5, '2025-04-04 17:26:54'),
(58, 9, '2025-04-04 17:26:54'),
(59, 10, '2025-04-04 17:26:54'),
(60, 6, '2025-04-04 17:26:54'),
(71, 7, '2025-04-04 16:00:40'),
(72, 6, '2025-04-04 16:16:32');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aprendices_ficha`
--
ALTER TABLE `aprendices_ficha`
  ADD PRIMARY KEY (`id_aprendiz_ficha`),
  ADD UNIQUE KEY `unique_aprendiz_ficha` (`id_usuario`,`id_ficha`),
  ADD KEY `id_ficha` (`id_ficha`);

--
-- Indices de la tabla `fichas`
--
ALTER TABLE `fichas`
  ADD PRIMARY KEY (`id_ficha`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `id_sede` (`id_sede`);

--
-- Indices de la tabla `historial_roles`
--
ALTER TABLE `historial_roles`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_rol_anterior` (`id_rol_anterior`),
  ADD KEY `id_rol_nuevo` (`id_rol_nuevo`),
  ADD KEY `id_usuario_modificador` (`id_usuario_modificador`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id_modulo`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`),
  ADD UNIQUE KEY `unique_permiso_modulo` (`id_modulo`,`nombre`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre` (`nombre_rol`);

--
-- Indices de la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD PRIMARY KEY (`id_rol`,`id_permiso`),
  ADD KEY `id_permiso` (`id_permiso`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id_sede`),
  ADD UNIQUE KEY `nombre_sede` (`nombre_sede`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  ADD UNIQUE KEY `numero_documento_UNIQUE` (`numero_documento`);

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aprendices_ficha`
--
ALTER TABLE `aprendices_ficha`
  MODIFY `id_aprendiz_ficha` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `fichas`
--
ALTER TABLE `fichas`
  MODIFY `id_ficha` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `historial_roles`
--
ALTER TABLE `historial_roles`
  MODIFY `id_historial` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id_modulo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
  MODIFY `id_sede` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aprendices_ficha`
--
ALTER TABLE `aprendices_ficha`
  ADD CONSTRAINT `aprendices_ficha_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `aprendices_ficha_ibfk_2` FOREIGN KEY (`id_ficha`) REFERENCES `fichas` (`id_ficha`);

--
-- Filtros para la tabla `fichas`
--
ALTER TABLE `fichas`
  ADD CONSTRAINT `fichas_ibfk_1` FOREIGN KEY (`id_sede`) REFERENCES `sedes` (`id_sede`);

--
-- Filtros para la tabla `historial_roles`
--
ALTER TABLE `historial_roles`
  ADD CONSTRAINT `historial_roles_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `historial_roles_ibfk_2` FOREIGN KEY (`id_rol_anterior`) REFERENCES `roles` (`id_rol`),
  ADD CONSTRAINT `historial_roles_ibfk_3` FOREIGN KEY (`id_rol_nuevo`) REFERENCES `roles` (`id_rol`),
  ADD CONSTRAINT `historial_roles_ibfk_4` FOREIGN KEY (`id_usuario_modificador`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`id_modulo`) REFERENCES `modulos` (`id_modulo`);

--
-- Filtros para la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD CONSTRAINT `rol_permiso_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`),
  ADD CONSTRAINT `rol_permiso_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id_permiso`);

--
-- Filtros para la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD CONSTRAINT `usuario_rol_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `usuario_rol_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
