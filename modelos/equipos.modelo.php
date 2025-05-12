<?php

require_once "conexion.php";

class ModeloEquipos{
    public static function mdlMostrarEquipos($tabla, $item, $valor){
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT 
            e.equipo_id,
            e.numero_serie,
            e.etiqueta,
            e.descripcion,
            e.fecha_entrada,
            u.ubicacion_id,
            c.categoria_id,
            cu.id_usuario,
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
        WHERE e." . $item . " = :" . $item);

            if ($item = "numero_serie" || $item == "etiqueta" || $item == "descripcion") {
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
            }
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT 
            e.equipo_id,
            e.numero_serie,
            e.etiqueta,
            e.descripcion,
            e.fecha_entrada,
            u.ubicacion_id,
            c.categoria_id,
            cu.id_usuario,
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
            usuarios cu ON e.cuentadante_id = cu.id_usuario");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        $stmt->close();
        $stmt = null;
    } // fin del metodo mdlMostrarEquipos

    // =====================================
    //     REALIZAR TRASPASO CUENTADANTE
    // =====================================
    public static function mdlMostrarDatosCuentadanteOrigen($tabla, $item, $valor){
        try {
            // SQL CAPTURANDO LOS DATOS DEL CUENTADANTE ACTUAL A MOSTRAR EN EL MODAL
            $stmt1 = Conexion::conectar()->prepare("SELECT e.equipo_id,
                                                us.nombre,
                                                us.numero_documento,
                                                ub.nombre as ubicacion_nombre,
                                                ur.id_rol
                                                FROM $tabla e
                                                LEFT JOIN usuarios us ON e.cuentadante_id = us.id_usuario
                                                LEFT JOIN ubicaciones ub ON e.ubicacion_id = ub.ubicacion_id
                                                LEFT JOIN usuario_rol ur ON us.id_usuario = ur.id_usuario
                                                WHERE $item = :$item;");
            if ($item == "equipo_id") {
                $stmt1->bindParam(":" . $item, $valor, PDO::PARAM_INT);
            } else {
                $stmt1->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            }
            $stmt1->execute();
            return $stmt1->fetch();
        } catch (Exception $e) {
            error_log("Error al editar usuario: " . $e->getMessage());
        } finally {
            //Cerrar la conexión
            $stmt1 = null;
        }
    } // fin del metodo mdlRealizarTraspasoCuentadante

    public static function mdlMostrarDatosCuentadanteTraspaso($tabla, $item, $valor){
        try{
            $stmt = Conexion::conectar()->prepare("SELECT 
                                                    us.numero_documento,
                                                    us.nombre AS cuentadante_nombre,
                                                    e.cuentadante_id,
                                                    e.ubicacion_id,
                                                    e.equipo_id,
                                                    ub.nombre AS ubicacion_nombre,  -- ¡Aquí está la ubicación!
                                                    ur.id_rol
                                                FROM 
                                                    $tabla us
                                                LEFT JOIN 
                                                    usuario_rol ur ON us.id_usuario = ur.id_usuario
                                                LEFT JOIN 
                                                    equipos e ON us.id_usuario = e.cuentadante_id
                                                LEFT JOIN 
                                                    ubicaciones ub ON e.ubicacion_id = ub.ubicacion_id
                                                WHERE 
                                                    $item = :$item;");
            if($item == "id_rol" || $item == "equipo_id"){
                $stmt -> bindParam(":" . $item, $valor, PDO::PARAM_INT);
            } else {
                $stmt -> bindParam(":" . $item, $valor, PDO::PARAM_STR);
            }
            $stmt -> execute();
            return $stmt -> fetch();
        } catch (Exception $e){
            error_log("Error al cambiar de cuentadante: " . $e->getMessage());
        } finally {
            $stmt = null;
        }
    }

    public static function mdlRealizarTraspasoCuentadante($tabla, $datos){
        try{
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla 
                                                    SET cuentadante_id = :cuentadante_id, 
                                                    ubicacion_id = :ubicacion_id
                                                    WHERE equipo_id = :equipo_id");
            
            // Corrección en los bindParam
            $stmt->bindParam(":equipo_id", $datos["idTraspasoEquipo"], PDO::PARAM_INT);
            $stmt->bindParam(":cuentadante_id", $datos["cuentadante_id"], PDO::PARAM_INT);
            $stmt->bindParam(":ubicacion_id", $datos["ubicacion_id"], PDO::PARAM_INT);

            $stmt->execute();
            // Verificar si se actualizó realmente algún registro
            $stmt -> fetch();
            return ($stmt->rowCount() > 0) ? "success" : "nochange";
        } catch (Exception $e){
            error_log("Error al cambiar de cuentadante: " . $e->getMessage());
            return "error";
        } finally {
            $stmt = null;
        }
    }

    // =====================================
    //     AGREGAR EQUIPOS
    // =====================================
    public static function mdlAgregarEquipos($tabla, $datos) {} // fin del metodo mdlAgregarEquipos

} // fin de la clase
