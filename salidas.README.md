### 1. Actualizar columna   `Estado_prestamo` a la tabla `prestamos`
-- se modifica la columna estado_prestamo
```sql
ALTER TABLE prestamos 
MODIFY COLUMN estado_prestamo ENUM(
    'Prestado', 
    'Devuelto', 
    'Rechazado', 
    'Pendiente', 
    'Asignado', 
    'En trámite', 
    'Autorizado'
) NOT NULL DEFAULT 'En trámite';
```


### 2. Agregar trigger a la tabla  `prestamos`
-- Este trigger se ejecutará después de cada actualización en la tabla prestamos.
```sql
DELIMITER //

CREATE TRIGGER actualizar_estado_equipo_por_prestamo
AFTER UPDATE ON prestamos
FOR EACH ROW
BEGIN
    -- Si el estado cambió a 'Autorizado', actualizar id_estado a 2 (Prestado) en equipos
    IF NEW.estado_prestamo = 'Autorizado' AND (OLD.estado_prestamo != 'Autorizado' OR OLD.estado_prestamo IS NULL) THEN
        UPDATE equipos e
        JOIN detalle_prestamo dp ON e.equipo_id = dp.equipo_id
        SET e.id_estado = 2
        WHERE dp.id_prestamo = NEW.id_prestamo;
    END IF;
    
    -- Si el estado cambió a 'En Trámite', actualizar id_estado a 3 (Reservado) en equipos
    IF NEW.estado_prestamo = 'En Trámite' AND (OLD.estado_prestamo != 'En Trámite' OR OLD.estado_prestamo IS NULL) THEN
        UPDATE equipos e
        JOIN detalle_prestamo dp ON e.equipo_id = dp.equipo_id
        SET e.id_estado = 3
        WHERE dp.id_prestamo = NEW.id_prestamo;
    END IF;
    
    -- Si el estado cambió a 'Devuelto', actualizar id_estado a 1 (Disponible) en equipos
    IF NEW.estado_prestamo = 'Devuelto' AND (OLD.estado_prestamo != 'Devuelto' OR OLD.estado_prestamo IS NULL) THEN
        UPDATE equipos e
        JOIN detalle_prestamo dp ON e.equipo_id = dp.equipo_id
        SET e.id_estado = 1
        WHERE dp.id_prestamo = NEW.id_prestamo;
    END IF;
END//

DELIMITER ;
```