<?php

include_once("conexion.php");
Class ModeloEquipos{
    static public function mdlMostrarEquipos($tabla, $item, $valor){
        if($item != null){
            $stmt = Conexion::conectar()->prepare("SELECT e.equipo_id,
                                                    e.numero_serie,
                                                    e.etiqueta,
                                                    e.descripcion,
                                                    e.fecha_entrada,
                                                    u.ubicacion_id,
                                                    c.categoria_id,
                                                    us.id_usuario,
                                                    es.id_estado
                                                FROM $tabla e
                                                LEFT JOIN ubicaciones u ON e.ubicacion_id = u.ubicacion_id
                                                LEFT JOIN categorias c ON e.categoria_id = c.categoria_id
                                                LEFT JOIN usuarios us ON e.cuentadante_id = us.id_usuario
                                                LEFT JOIN estados es ON e.id_estado = es.id_estado
                                                WHERE $item = :$item
                                                ORDER BY e.equipo_id DESC
                                                LIMIT 1;");
            if($item == "equipo_id" || $item == "ubicacion_id" || $item == "cuentadante_id" ||
            $item == "categoria_id" || $item == "id_estado"){
                $stmt -> bindParam(":" . $item, $valor, PDO::PARAM_INT);
            } else {
                $stmt -> bindParam(":" . $item, $valor, PDO::PARAM_STR);
            }
            $stmt -> execute();
            return $stmt -> fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");  
            $stmt -> execute();
            return $stmt -> fetchAll();
        }
        $stmt -> close();
        $stmt = null;
    }

    static public function mdlRealizarTraspasoCuentadante($tabla, $item, $valor){
        try{
            // SQL CAPTURANDO LOS DATOS DEL CUENTADANTE ACTUAL A MOSTRAR EN EL MODAL
            $stmt1 = Conexion::conectar()->prepare("SELECT e.equipo_id,
                                                us.nombre,
                                                ub.nombre as ubicacion_nombre
                                                FROM $tabla e
                                                LEFT JOIN usuarios us ON e.cuentadante_id = us.id_usuario
                                                LEFT JOIN ubicaciones ub ON e.ubicacion_id = ub.ubicacion_id
                                                WHERE $item = :$item;");
            if($item == "equipo_id"){
                $stmt1 -> bindParam(":" . $item, $valor, PDO::PARAM_INT);
            } else {
                $stmt1 -> bindParam(":" . $item, $valor, PDO::PARAM_STR);
            }
            $stmt1 -> execute();
            return $stmt1 -> fetch();
        } catch (Exception $e){
            error_log("Error al editar usuario: " . $e -> getMessage());
        } finally {
            //Cerrar la conexión
            $stmt1 = null;
        }
    }

    static public function mdlAgregarEquipos($tabla, $datos){
        
    }
}