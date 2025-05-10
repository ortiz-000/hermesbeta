<?php

require_once "conexion.php";

class ModeloEquipos{
    
    // =====================================
    //     MOSTRAR EQUIPOS
    // =====================================
    public static function mdlMostrarEquipos($tabla, $item, $valor){
        
        if($item != null){
            $stmt = Conexion::conectar()->prepare("SELECT 
            e.equipo_id,
            e.numero_serie,
            e.etiqueta,
            e.descripcion,
            e.fecha_entrada,
            e.id_estado,
            u.nombre AS ubicacion_nombre,
            c.nombre AS categoria_nombre,
            CONCAT_WS(' ',cu.nombre,cu.apellido) AS cuentadante_nombre
        FROM 
            $tabla e
        LEFT JOIN 
            ubicaciones u ON e.ubicacion_id = u.ubicacion_id
        LEFT JOIN 
            categorias c ON e.categoria_id = c.categoria_id
        LEFT JOIN 
            usuarios cu ON e.cuentadante_id = cu.id_usuario
        WHERE e.".$item." = :".$item);

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);
            $stmt -> execute();
            return $stmt -> fetch();
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT 
                                                        e.equipo_id,
                                                        e.numero_serie,
                                                        e.etiqueta,
                                                        e.descripcion,
                                                        e.fecha_entrada,
                                                        e.id_estado,
                                                        u.nombre AS ubicacion_nombre,
                                                        c.nombre AS categoria_nombre,
                                                        CONCAT_WS(' ',cu.nombre,cu.apellido) AS cuentadante_nombre
                                                    FROM 
                                                        equipos e
                                                    LEFT JOIN 
                                                        ubicaciones u ON e.ubicacion_id = u.ubicacion_id
                                                    LEFT JOIN 
                                                        categorias c ON e.categoria_id = c.categoria_id
                                                    LEFT JOIN 
                                                        usuarios cu ON e.cuentadante_id = cu.id_usuario");
            $stmt -> execute();
            return $stmt -> fetchAll();
        }
        
        $stmt -> close();
        $stmt = null;
    } // fin del metodo mdlMostrarEquipos

}// fin de la clase