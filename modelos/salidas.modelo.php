<?php

require_once "conexion.php";

class ModeloSalidas {

    // Mostrar salidas (todas o una específica)
    static public function mdlMostrarSalidas($tabla, $item, $valor) {
        if ($item != null) {
            // Mostrar una salida específica con JOIN a roles
            $stmt = Conexion::conectar()->prepare(
                "SELECT s.*, r.nombre_rol 
                 FROM $tabla s
                 JOIN roles r ON s.id_rol = r.id_rol
                 WHERE s.$item = :$item"
            );
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            // Mostrar todas las salidas con JOIN a roles
            $stmt = Conexion::conectar()->prepare(
                "SELECT s.id, r.nombre_rol, s.fecha, s.estado, s.acciones 
                 FROM $tabla s
                 JOIN roles r ON s.id_rol = r.id_rol
                 ORDER BY s.fecha DESC"
            );
            $stmt->execute();
            return $stmt->fetchAll();
        }

        $stmt->close();
        $stmt = null;
    }
}