<?php

require_once "conexion.php";

class ModeloAutorizaciones{

    static public function mdlMostrarAutorizaciones($tabla, $item, $valor){
        if($item != null){
            $stmt = Conexion::conectar()->prepare("SELECT a.*, p.fecha_inicio, p.fecha_fin, p.fecha_solicitud, p.estado_prestamo 
                FROM autorizaciones a 
                INNER JOIN prestamos p ON a.id_prestamo = p.id_prestamo 
                WHERE a.$item = :$item");
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT a.*, p.fecha_inicio, p.fecha_fin, p.fecha_solicitud, p.estado_prestamo 
                FROM autorizaciones a 
                INNER JOIN prestamos p ON a.id_prestamo = p.id_prestamo");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt->close();
        $stmt = null;
    }

    static public function mdlActualizarAutorizacion($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado, motivo_rechazo = :motivo_rechazo WHERE id_autorizacion = :id_autorizacion");

        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":motivo_rechazo", $datos["motivo_rechazo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_autorizacion", $datos["id_autorizacion"], PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }
}