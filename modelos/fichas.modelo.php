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

    // Read a ficha by ID
    public function leerFicha($id) {

    }

    // Update a ficha by ID
    public function actualizarFicha($id, $data) {
    }

    // Delete a ficha by ID
    public function eliminarFicha($id) {
    }

    // List all fichas
    static public function mdlMostrarFichas($tabla, $item, $valor) {
        if ($item != null) {




            $stmt = Conexion::conectar()->prepare("SELECT f.*, s.nombre_sede FROM $tabla f JOIN sedes s ON f.id_sede = s.id_sede WHERE f.$item = :$item ORDER BY f.codigo ASC");
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
}
?>

