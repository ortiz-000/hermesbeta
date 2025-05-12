# Scripts SQL para la Base de Datos hermes002

Este archivo contiene consultas SQL que deben ejecutarse en la base de datos `hermes002` para realizar actualizaciones o modificaciones específicas.

**¡IMPORTANTE!**

* Asegúrate de estar conectado a la base de datos `hermes002` antes de ejecutar estas consultas.
* Realiza una copia de seguridad de la base de datos antes de ejecutar cualquier script, por si acaso necesitas revertir los cambios.
* Ejecuta las consultas en el orden en que aparecen en este archivo, si el orden es relevante.

## Consultas SQL

### 1. Actualizar Rol de Usuario y asignar el cuentadante_id por defecto a 42 en la tabla equipos

Esta consulta actualiza en equipos el cuentadante_id que actualmente es nulo y lo asigna para ser el cuentadante_id 42 (Que es el usuario de almacén). Asi por defecto, los equipos los tiene el almacén.

```sql
-- Ejecutar esta consulta SQL estando parado en hermes_002
UPDATE usuario_rol
SET id_rol = 3 
WHERE id_usuario = 42;

UPDATE equipos
SET cuentadante_id = 42
WHERE cuentadante_id IS NULL;
```

### 2. (11/05/2025) Actualización en la tabla de equipos añadiendo nuevos cuentadantes para realizar test del software: 50, 43, 55, 57



```sql
UPDATE equipos SET ubicacion_id = 4 WHERE cuentadante_id = 50;

```