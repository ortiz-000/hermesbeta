<?php

require_once "conexion.php";

class ModeloAutorizaciones {

    // modelo para mostrar autorizaciones
    static public function mdlMostrarAutorizaciones($tabla, $item, $valor){
        if($item != null){
            $stmt = Conexion::conectar()->prepare("SELECT p.id_prestamo,
                                                        MAX(CASE WHEN ar.id_rol = (SELECT id_rol FROM roles WHERE nombre_rol = 'Coordinación') THEN 'Firmado' ELSE 'Pendiente' END) AS firma_coordinacion,
                                                        MAX(CASE WHEN ar.id_rol = (SELECT id_rol FROM roles WHERE nombre_rol = 'Coordinación') THEN ar.id_usuario ELSE NULL END) AS id_usuario_coordinacion,
                                                        MAX(CASE WHEN ar.id_rol = (SELECT id_rol FROM roles WHERE nombre_rol = 'Líder TIC') THEN 'Firmado' ELSE 'Pendiente' END) AS firma_lider_tic,
                                                        MAX(CASE WHEN ar.id_rol = (SELECT id_rol FROM roles WHERE nombre_rol = 'Líder TIC') THEN ar.id_usuario ELSE NULL END) AS id_usuario_tic,
                                                        MAX(CASE WHEN ar.id_rol = (SELECT id_rol FROM roles WHERE nombre_rol = 'Almacén') THEN 'Firmado' ELSE 'Pendiente' END) AS firma_almacen,
                                                        MAX(CASE WHEN ar.id_rol = (SELECT id_rol FROM roles WHERE nombre_rol = 'Almacén') THEN ar.id_usuario ELSE NULL END) AS id_usuario_almacen
                                                    FROM prestamos p
                                                    LEFT JOIN autorizaciones ar ON p.id_prestamo = ar.id_prestamo
                                                    where p.id_prestamo = :id_prestamo
                                                    GROUP BY p.id_prestamo;");



            $stmt->bindParam(":id_prestamo", $valor, PDO::PARAM_INT);
            
            $stmt->execute();
            return $stmt->fetch();

            $stmt->close();
            $stmt = null;
        }
    }
}