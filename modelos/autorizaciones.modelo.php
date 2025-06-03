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

    static public function mdlAutorizarPrestamo($id_prestamo, $id_rol, $id_usuario){
        $stmt = Conexion::conectar()->prepare("INSERT INTO autorizaciones (id_prestamo, id_rol, id_usuario) VALUES (:id_prestamo, :id_rol, :id_usuario)");

        $stmt->bindParam(":id_prestamo", $id_prestamo, PDO::PARAM_INT);
        $stmt->bindParam(":id_rol", $id_rol, PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();
        $stmt = null;
 
    }

    static public function mdlDesautorizarPrestamo($id_prestamo, $id_rol, $id_usuario){
        $stmt = Conexion::conectar()->prepare("DELETE FROM autorizaciones WHERE id_prestamo = :id_prestamo AND id_rol = :id_rol AND id_usuario = :id_usuario");

        $stmt->bindParam(":id_prestamo", $id_prestamo, PDO::PARAM_INT);
        $stmt->bindParam(":id_rol", $id_rol, PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();
        $stmt = null;
        
    }


    static public function mdlRechazarPrestamo($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_prestamo, id_rol, id_usuario, motivo_rechazo) VALUES (:id_prestamo, :id_rol, :id_usuario, :motivo_rechazo)");

        //mostramos error log de la consulta para debuggear
        
        $stmt->bindParam(":id_prestamo", $datos["id_prestamo"], PDO::PARAM_INT);
        $stmt->bindParam(":id_rol", $datos["id_rol"], PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":motivo_rechazo", $datos["motivo_rechazo"], PDO::PARAM_STR);
        
        if($stmt->execute()){
            return "ok";
        }else{
            error_log(print_r($stmt->errorInfo(), true));
            return "error";
        }

        $stmt->close();
        $stmt = null;
        
    }
}

