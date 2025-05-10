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

    // =====================================
    //     REALIZAR TRASPASO CUENTADANTE
    // =====================================
    public static function mdlRealizarTraspasoCuentadante($tabla, $item, $valor){
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
    } // fin del metodo mdlRealizarTraspasoCuentadante

    // =====================================
    //     AGREGAR EQUIPOS
    // =====================================
    public static function mdlAgregarEquipos($tabla, $datos){
        
    } // fin del metodo mdlAgregarEquipos
    
} // fin de la clase
