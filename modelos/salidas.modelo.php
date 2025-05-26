<?php

require_once "conexion.php";

class ModeloSalidas {
    
    static public function mdlMostrarSalidas($tabla, $item, $valor) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT id_prestamo, usuario_id, estado_prestamo * FROM $tabla ORDER BY id DESC");

            $stmt -> execute();

            return $stmt -> fetchAll();
        }
        
        $stmt->execute();
        
        return $stmt->fetchAll();
        
        $stmt = null;
    }
}

?>