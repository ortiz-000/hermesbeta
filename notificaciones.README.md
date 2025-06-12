# Scripts SQL para la Base de Datos hermes002

Este archivo contiene instrucciones y consultas SQL que deben ejecutarse en la base de datos `hermes002` para realizar actualizaciones o modificaciones específicas.

**¡IMPORTANTE!**

* Asegúrate de estar conectado a la base de datos `hermes002` antes de ejecutar estas consultas.
* Realiza una copia de seguridad de la base de datos antes de ejecutar cualquier script, por si acaso necesitas revertir los cambios.
* Ejecuta las consultas en el orden en que aparecen en este archivo, si el orden es relevante.


# Módulo de Notificaciones - Sistema Hermes

Este módulo permite la gestión, almacenamiento y visualización de notificaciones dentro del sistema Hermes. Las notificaciones se generan en función de eventos definidos previamente, y permiten mantener informados a los usuarios sobre el estado de sus operaciones o sucesos del sistema.

---

## Descripción General

El sistema está basado en dos tablas principales:

- **tipos_evento_notificacion**: donde se definen los eventos que pueden generar notificaciones.
- **notificaciones**: donde se almacenan las notificaciones generadas para cada usuario.

---

##  Estructura de Base de Datos

### Tabla `tipos_evento_notificacion`

Contiene el catálogo de eventos del sistema.

| Campo | Tipo | Descripción |
| ----- | ---- | ----------- |
| `id_tipo_evento` | int (PK, AI) | ID único del tipo de evento |
| `nombre` | varchar(255) | Nombre del evento |
| `descripcion` | text | Descripción detallada del evento |
| `tipo_notificacion` | enum('info','warning','danger','success') | Tipo visual de la notificación |
| `prioridad` | int | Prioridad (1=Alta, 2=Media, 3=Baja) |

---

###  Tabla `notificaciones`

Almacena las notificaciones enviadas a los usuarios.

| Campo | Tipo | Descripción |
| ----- | ---- | ----------- |
| `id_notificaciones` | int (PK, AI) | ID único de la notificación |
| `id_usuario` | int | ID del usuario destinatario |
| `id_tipo_evento` | int | Relación al evento correspondiente |
| `mensaje` | text | Mensaje descriptivo de la notificación |
| `url` | varchar(255) | URL de redirección (opcional por el momento) |
| `leida` | tinyint(1) | Estado de lectura (0 = no leída, 1 = leída) |
| `fecha_creacion` | timestamp | Fecha de creación |
| `fecha_leida` | datetime | Fecha de lectura (opcional) |

---

##  Script de Instalación Completo

A continuación, se detalla el script SQL completo para crear las tablas e insertar los datos iniciales.

###  Creación de tablas

```sql
-- Crear tabla de tipos de eventos
CREATE TABLE `tipos_evento_notificacion` (
  `id_tipo_evento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `tipo_notificacion` enum('info','warning','danger','success') DEFAULT 'info',
  `prioridad` int(11) DEFAULT 3 COMMENT 'Prioridad: 1=Alta, 2=Media, 3=Baja',
  PRIMARY KEY (`id_tipo_evento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Crear tabla de notificaciones
CREATE TABLE `notificaciones` (
  `id_notificaciones` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_tipo_evento` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `leida` tinyint(1) DEFAULT 0,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_leida` datetime DEFAULT NULL,
  PRIMARY KEY (`id_notificaciones`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_tipo_evento` (`id_tipo_evento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tipos_evento_notificacion` (`id_tipo_evento`, `nombre`, `descripcion`, `tipo_notificacion`, `prioridad`) VALUES
(46, 'Préstamo generado', 'Se generó una solicitud de préstamo', 'info', 2),
(47, 'Préstamo aprobado', 'El préstamo fue aprobado exitosamente', 'success', 1),
(48, 'Préstamo rechazado', 'El préstamo fue rechazado por falta de disponibilidad', 'warning', 1),
(49, 'Usuario inactivo', 'El usuario fue marcado como inactivo', 'danger', 1),
(50, 'Devolución completada', 'El préstamo fue devuelto correctamente', 'success', 3),
(51, 'Suspensión de usuario', 'El usuario ha sido suspendido temporalmente', 'danger', 1),
(52, 'Revisión pendiente', 'El préstamo está pendiente de revisión', 'warning', 2),
(53, 'Nuevo equipo asignado', 'Se asignó un nuevo equipo al usuario', 'success', 2),
(54, 'Error de préstamo', 'Se produjo un error durante el préstamo', 'danger', 1),
(55, 'Solicitud cancelada', 'El préstamo fue cancelado por el usuario', 'warning', 2),
(56, 'Mantenimiento programado', 'Se ha programado mantenimiento del equipo', 'info', 2),
(57, 'Mantenimiento completado', 'El equipo ha pasado mantenimiento exitosamente', 'success', 1),
(58, 'Mantenimiento fallido', 'El mantenimiento del equipo falló', 'danger', 1),
(59, 'Reserva anticipada', 'Se ha realizado una reserva anticipada', 'info', 2),
(60, 'Reserva rechazada', 'La reserva fue rechazada', 'warning', 1),
(61, 'Transferencia de equipo', 'Se transfirió un equipo a otro usuario', 'info', 2),
(62, 'Solicitud de baja', 'El usuario solicitó la baja del equipo', 'warning', 2),
(63, 'Baja aprobada', 'La baja del equipo fue aprobada', 'success', 1),
(64, 'Baja rechazada', 'La baja del equipo fue rechazada', 'danger', 1),
(65, 'Auditoría realizada', 'Se realizó auditoría sobre el equipo', 'info', 3);

INSERT INTO `notificaciones` (`id_usuario`, `id_tipo_evento`, `mensaje`, `url`, `leida`)
VALUES 
(1, 46, 'Se generó la solicitud de préstamo del equipo HP Pavilion', '/prestamos/201', 0),
(1, 47, 'El préstamo del equipo Lenovo ThinkPad fue aprobado exitosamente', '/prestamos/202', 0),
(1, 48, 'El préstamo del monitor Samsung fue rechazado', '/prestamos/203', 0),
(1, 49, 'El usuario Andrea Gómez ha sido marcado como inactivo', '/usuarios/301', 0),
(1, 50, 'La devolución del equipo Dell Inspiron fue completada', '/prestamos/204', 0),
(1, 51, 'El usuario Pedro Martínez ha sido suspendido', '/usuarios/302', 0),
(1, 52, 'Préstamo de herramienta Bosch pendiente de revisión', '/prestamos/205', 0),
(1, 53, 'Se asignó el equipo Lenovo IdeaPad al usuario Luis Rodríguez', '/prestamos/206', 0),
(1, 54, 'Error en el préstamo de herramienta Makita', '/prestamos/207', 0),
(1, 55, 'Solicitud de préstamo de proyector Epson cancelada', '/prestamos/208', 0),
(1, 56, 'Mantenimiento programado para equipo Canon', '/mantenimiento/301', 0),
(1, 57, 'Mantenimiento completado en servidor HP Proliant', '/mantenimiento/302', 0),
(1, 58, 'Mantenimiento fallido en equipo Dell', '/mantenimiento/303', 0),
(1, 59, 'Reserva anticipada de equipo MacBook Pro', '/reservas/401', 0),
(1, 60, 'Reserva rechazada para monitor LG', '/reservas/402', 0),
(1, 61, 'Transferencia de equipo a usuario Carlos Ruiz', '/transferencias/501', 0),
(1, 62, 'Solicitud de baja para impresora Epson', '/bajas/601', 0),
(1, 63, 'Baja de equipo HP aprobada', '/bajas/602', 0),
(1, 64, 'Baja de equipo rechazada por inventario', '/bajas/603', 0),
(1, 65, 'Auditoría realizada sobre el equipo de redes', '/auditorias/701', 0);