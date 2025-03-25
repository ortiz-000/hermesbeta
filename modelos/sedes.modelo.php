<?php

require_once "conexion.php";

class ModeloSedes
{
    /*=============================================
    INGRESAR SEDE
    =============================================*/
    static public function mdlCrearSede($tabla, $datos)
    {
        try {
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_sede, direccion, descripcion) VALUES (:nombre, :direccion, :descripcion)");

            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

            if ($stmt->execute()) {
                return "ok";
            } else {
                // Captura el error y devuélvelo para depuración
                $errorInfo = $stmt->errorInfo();
                return "error: " . $errorInfo[2];
            }
        } catch (PDOException $e) {
            // Captura cualquier excepción y devuélvela para depuración
            return "error: " . $e->getMessage();
        } finally {
            $stmt->closeCursor();
            $stmt = null;
        }
    }


    /*=============================================
    MOSTRAR SEDE
    =============================================*/
    static public function mdlMostrarSedes($tabla, $item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    EDITAR SEDE
    =============================================*/
    static public function mdlEditarSede($tabla, $datos)
    {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_sede = :nombre, direccion = :direccion, descripcion = :descripcion WHERE id_sede = :id");

            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

            if ($stmt->execute()) {
                return "ok";
            } else {
                // Captura el error y devuélvelo para depuración
                $errorInfo = $stmt->errorInfo();
                return "error: " . $errorInfo[2];
            }
        } catch (PDOException $e) {
            // Captura cualquier excepción y devuélvela para depuración
            return "error: " . $e->getMessage();
        } finally {
            $stmt->closeCursor();
            $stmt = null;
        }
    }

    /*=============================================
    ACTUALIZAR SEDE
    =============================================*/
    static public function mdlActualizarSede($tabla, $item1, $valor1, $item2, $valor2)
    {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item2 = :$item2 WHERE $item1 = :$item1");

            $stmt->bindParam(":".$item1, $valor1, PDO::PARAM_INT);
            $stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return "ok";
            } else {
                // Captura el error y devuélvelo para depuración
                $errorInfo = $stmt->errorInfo();
                return "error: " . $errorInfo[2];
            }
        } catch (PDOException $e) {
            // Captura cualquier excepción y devuélvela para depuración
            return "error: " . $e->getMessage();
        } finally {
            $stmt->closeCursor();
            $stmt = null;
        }
    }
}