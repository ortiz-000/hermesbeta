<?php

require_once "conexion.php";

class ModeloUsuarios{

    static public function mdlCrearUsuario($tabla, $datos){
        try{
            //Iniciar la transacción
            $conexion = Conexion::conectar();
            $conexion->beginTransaction();

            $stmt = $conexion->prepare("INSERT INTO $tabla(tipo_documento, numero_documento, nombre, apellido, correo_electronico, nombre_usuario, clave, telefono, direccion, genero) VALUES (:tipo_documento, :documento, :nombre, :apellido, :email, :usuario, :clave, :telefono, :direccion, :genero)");

            $stmt->bindParam(":tipo_documento", $datos["tipo_documento"], PDO::PARAM_STR);
            $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
            $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":clave", $datos["password"], PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
            $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
            $stmt->bindParam(":genero", $datos["genero"], PDO::PARAM_STR);

            $stmt -> execute();

           
            //insertar los datos en la tabla usuario_rol
            $id_usuario = $conexion->lastInsertId();
            $stmt2 = $conexion->prepare("INSERT INTO usuario_rol(id_usuario, id_rol) VALUES (:id_usuario, :id_rol)");
            $stmt2->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $stmt2->bindParam(":id_rol", $datos["rol"], PDO::PARAM_INT);

            $stmt2 -> execute();



            //si el rol del usuario es 6 (aprendiz) se guarda el id de la ficha y el id del nuevo usuario en la tabla aprendices_ficha
            if ($datos["rol"] == "6") {
                $stmt3 = $conexion->prepare("INSERT INTO aprendices_ficha(id_usuario, id_ficha) VALUES (:id_usuario, :id_ficha)");
                $stmt3->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
                $stmt3->bindParam(":id_ficha", $datos["ficha"], PDO::PARAM_INT);

                $stmt3 -> execute();
    
            }

            //Confirmar transacción
            $conexion->commit();
            return "ok";
        } catch (Exception $e) {
            // Si ocurre un error, se revierte la transacción
            $conexion->rollBack();
            return "error";
        } finally {
            // Cerrar la conexión
            $conexion = null;
        }       
    }
    

    static public function mdlMostrarUsuarios($tabla, $item, $valor){


    //     SELECT 
    //     u.id_usuario,
    //     u.nombre,
    //     u.apellido,
    //     r.id_rol,
    //     r.nombre_rol,
    //     f.id_ficha,
    //     f.descripcion AS descripcion_ficha
    // FROM 
    //     usuarios u
    // LEFT JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
    // LEFT JOIN roles r ON ur.id_rol = r.id_rol
    // LEFT JOIN aprendices_ficha af ON u.id_usuario = af.id_usuario
    // LEFT JOIN fichas f ON af.id_ficha = f.id_ficha;






        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT u.*, 
                                                            r.id_rol, r.nombre_rol, 
                                                            f.id_ficha, f.descripcion AS descripcion_ficha, f.codigo, 
                                                            s.id_sede, s.nombre_sede
                                                    FROM $tabla as u      
                                                    LEFT JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                                                    LEFT JOIN roles r ON ur.id_rol = r.id_rol
                                                    LEFT JOIN aprendices_ficha af ON u.id_usuario = af.id_usuario
                                                    LEFT JOIN fichas f ON af.id_ficha = f.id_ficha 
                                                    LEFT JOIN sedes s ON f.id_sede = s.id_sede
                                                    WHERE u.id_usuario= :id_usuario");
            $stmt -> bindParam(":id_usuario", $valor, PDO::PARAM_INT);
            $stmt -> execute();
            return $stmt -> fetch();
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT u.*, r.id_rol, r.nombre_rol, f.id_ficha, f.descripcion AS descripcion_ficha, f.codigo
                                                    FROM $tabla as u      LEFT JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                                                    LEFT JOIN roles r ON ur.id_rol = r.id_rol
                                                    LEFT JOIN aprendices_ficha af ON u.id_usuario = af.id_usuario
                                                    LEFT JOIN fichas f ON af.id_ficha = f.id_ficha;");
            $stmt -> execute();
            return $stmt -> fetchAll();
        }
        $stmt -> close();
        $stmt = null;
        
    }

    static public function mdlMostrarFichasSede($tabla, $item, $valor){

        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt -> execute();
            return $stmt -> fetchAll();
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt -> execute();
            return $stmt -> fetchAll();
        }
        $stmt -> close();
        $stmt = null;
        
    }
}