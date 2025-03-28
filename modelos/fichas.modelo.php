<?php

require_once "conexion.php";

class ModeloFichas {

    // Create a new ficha
    static public function mdlCrearFicha($tabla, $data) {
        $query = "INSERT INTO $tabla (codigo, descripcion, id_sede, fecha_inicio, fecha_fin) VALUES (:codigo, :descripcion, :idsede, :fecha_inicio, :fecha_fin)";
        $stmt = Conexion::conectar()->prepare($query);
        
        // Bind parameters
        $stmt->bindParam(':codigo', $data['codigo'], PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $data['descripcion'], PDO::PARAM_STR);
        $stmt->bindParam(':idsede', $data['idSede'], PDO::PARAM_INT);
        $stmt->bindParam(':fecha_inicio', $data['fecha_inicio'], PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $data['fecha_fin'], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            // Capture the error and return it for debugging
            $errorInfo = $stmt->errorInfo();
            return "error: " . $errorInfo[2];
        }
        // Close the statement and connection
        $stmt -> close();
        $stmt = null;
    }

    static public function mdlActualizarFicha($tabla, $item1, $valor1, $item2, $valor2) {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item2 = :$item2 WHERE $item1 = :$item1");
        $stmt->bindParam(":".$item1, $valor1, PDO::PARAM_INT);
        $stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            // Capture the error and return it for debugging
            $errorInfo = $stmt->errorInfo();
            return "error: " . $errorInfo[2];
        }
        // Close the statement and connection
        $stmt -> close();
        $stmt = null;
    }

 

    // List all fichas
    static public function mdlMostrarFichas($tabla, $item, $valor) {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT f.*, s.nombre_sede FROM $tabla f JOIN sedes s ON f.id_sede = s.id_sede WHERE f.$item = :$item ORDER BY s.nombre_sede ASC");
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT f.*, s.nombre_sede FROM $tabla f JOIN sedes s ON f.id_sede = s.id_sede ORDER BY f.codigo ASC");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt->close();
        $stmt = null;

    }

    // Edit a ficha
    static public function mdlEditarFicha($tabla, $data) {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo = :codigo, descripcion = :descripcion, id_sede = :idsede, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin WHERE id_ficha = :id_ficha");
        $stmt->bindParam(":codigo", $data["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $data["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":idsede", $data["idSede"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_inicio", $data["fecha_inicio"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_fin", $data["fecha_fin"], PDO::PARAM_STR);
        $stmt->bindParam(":id_ficha", $data["id_ficha"], PDO::PARAM_INT);
        if ($stmt->execute()) {
            return "ok";
        } else {
            // Capture the error and return it for debugging
            $errorInfo = $stmt->errorInfo();
            return "error: " . $errorInfo[2];
        }
        // Close the statement and connection
        $stmt -> close();
        $stmt = null;
    }
}
?>

