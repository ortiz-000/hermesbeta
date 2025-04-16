<?php

require_once "conexion.php";

class ModeloModulos
{
    /*=============================================
    INGRESAR MÓDULO
    =============================================*/
    static public function mdlCrearModulo($tabla, $datos)
    {
        try {
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_modulo, descripcion) VALUES (:nombre, :descripcion)");

            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
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
    MOSTRAR MÓDULOS
    =============================================*/
    static public function mdlMostrarModulos($tabla, $item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    EDITAR MÓDULO
    =============================================*/
    static public function mdlEditarModulo($tabla, $datos)
    {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_modulo = :nombre, descripcion = :descripcion WHERE id_modulo = :id");

            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
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
    ACTUALIZAR ESTADO DEL MÓDULO
    =============================================*/
    static public function mdlCambiarEstadoModulo($valorId, $valorEstado)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE modulos SET estado = :estado WHERE id_modulo = :id_modulo");

        $stmt->bindParam(":id_modulo", $valorId, PDO::PARAM_INT);
        $stmt->bindParam(":estado", $valorEstado, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }
}