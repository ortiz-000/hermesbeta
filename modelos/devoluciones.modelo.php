<?php

require_once "conexion.php";

class ModeloDevoluciones
{

    // Modelo para mostrar devoluciones
    static public function mdlMostrarDevoluciones($tabla, $item, $valor)
    {
        if ($item != null) {
            // Consulta para un registro específico con JOIN
            $stmt = Conexion::conectar()->prepare(
                "SELECT p.*, u.numero_documento, u.nombre, u.apellido, u.telefono 
                 FROM $tabla p
                 JOIN usuarios u ON p.usuario_id = u.id_usuario
                 WHERE p.$item = :$item 
                 AND (p.fecha_fin IS NOT NULL OR p.tipo_prestamo = 'Prestado' OR p.estado_prestamo = 'Autorizado')"
            );

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            // Consulta para todos los registros con JOIN
            $stmt = Conexion::conectar()->prepare(
                "SELECT p.id_prestamo, u.numero_documento, u.nombre, u.apellido, u.telefono,
                        p.fecha_inicio, p.fecha_fin, p.tipo_prestamo AS estado_prestamo
                 FROM $tabla p
                 JOIN usuarios u ON p.usuario_id = u.id_usuario
                 WHERE p.fecha_devolucion_real IS NOT NULL OR p.estado_prestamo = 'Prestado' OR p.estado_prestamo = 'Autorizado'
                 ORDER BY p.fecha_devolucion_real DESC"
            );

            $stmt->execute();
            return $stmt->fetchAll();
        }

        $stmt->close();
        $stmt = null;
    }
}
