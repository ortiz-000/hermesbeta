<?php

require_once "conexion.php";

class ModeloVencidas {
    
    static public function mdlMostrarSolicitudesVencidas($item, $valor) {
        if($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT p.id_prestamo, p.fecha_inicio, p.fecha_fin,
                                                u.nombre, u.apellido, r.nombre_rol,
                                                e.numero_serie AS numero_serie,
                                                e.descripcion AS tipo
                                            FROM prestamos p 
                                            INNER JOIN usuarios u ON p.usuario_id = u.id_usuario
                                            INNER JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                                            INNER JOIN roles r ON ur.id_rol = r.id_rol
                                            INNER JOIN detalle_prestamo dp ON p.id_prestamo = dp.id_prestamo
                                            INNER JOIN equipos e ON dp.equipo_id = e.equipo_id
                                            WHERE p.fecha_fin < CURRENT_DATE() 
                                            AND p.$item = :$item");
        
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT p.id_prestamo, p.fecha_inicio, p.fecha_fin,
                                                u.nombre, u.apellido, r.nombre_rol,
                                                e.numero_serie AS numero_serie,
                                                e.descripcion AS tipo
                                            FROM prestamos p 
                                            INNER JOIN usuarios u ON p.usuario_id = u.id_usuario
                                            INNER JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                                            INNER JOIN roles r ON ur.id_rol = r.id_rol
                                            INNER JOIN detalle_prestamo dp ON p.id_prestamo = dp.id_prestamo
                                            INNER JOIN equipos e ON dp.equipo_id = e.equipo_id
                                            WHERE p.fecha_fin < CURRENT_DATE()");
        
            $stmt->execute();
            return $stmt->fetchAll();
        }
        
        $stmt->close();
        $stmt = null;
    }
}