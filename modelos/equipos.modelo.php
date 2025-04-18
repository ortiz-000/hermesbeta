<?php

Class ModeloEquipos{
    static public function mdlMostrarEquipos($tabla, $item, $valor){
        if($item != null){
            $stmt = Conexion::conectar()->prepare("SELECT e.equipo_id, e.numero_serie, e.etiqueta, e.descripcion,
                                                e.fecha_entrada, 
                                                u.ubicacion_id AS ubicacion,
                                                e.categoria AS categoria, 
                                                us.id_usuario AS nombre_cuentadante,
                                                e.a_cuentadante AS area_cuentadante, 
                                                e.estado FROM $tabla e 
                                                LEFT JOIN ubicaciones u ON e.ubicacion_id = u.ubicacion_id 
                                                LEFT JOIN usuarios us ON e.cuentadante_id = us.id_usuario 
                                                WHERE $item = :$item 
                                                ORDER BY e.equipo_id DESC
                                                LIMIT 1;");
            if($item == "equipo_id" && $item == "ubicacion_id" && $item == "cuentadante_id"){
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

    static public function mdlAgregarEquipos($tabla, $datos){
        
    }
}