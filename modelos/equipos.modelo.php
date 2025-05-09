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
                                                    ub.nombre
                                                    FROM $tabla e
                                                    LEFT JOIN usuarios us ON e.equipo_id = us.id_usuario
                                                    LEFT JOIN ubicaciones ub ON e.equipo_id = ub.ubicacion_id
                                                    WHERE $item = :item;");
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
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(numero_serie, etiqueta, descripcion, fecha_entrada, ubicacion_id, categoria, cuentadante_id, a_cuentadante, estado)
                                                VALUES (:numero_serie, :etiqueta, :descripcion, :fecha_entrada, :ubicacion_id, :categoria, :cuentadante_id, :a_cuentadante, :estado)");
        $stmt -> bindParam(":numero_serie", $datos["numero_serie"], PDO::PARAM_STR);
        $stmt -> bindParam(":etiqueta", $datos["etiqueta"], PDO::PARAM_STR);
        $stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt -> bindParam(":fecha_entrada", $datos["fecha_entrada"], PDO::PARAM_STR);
        $stmt -> bindParam(":ubicacion_id", $datos["ubicacion_id"], PDO::PARAM_INT);
        $stmt -> bindParam(":categoria_id", $datos["categoria_id"], PDO::PARAM_STR);
        $stmt -> bindParam(":cuentadante_id", $datos["cuentadante_id"], PDO::PARAM_INT);
        $stmt -> bindParam(":a_cuentadante", $datos["a_cuentadante"], PDO::PARAM_STR);
        $stmt -> bindParam(":id_estado", $datos["id_estado"], PDO::PARAM_STR);
        if($stmt -> execute()){
            return "ok";
        } else {
            return "error";
        
        }

        
    }

    static public function mdlEditarEquipos($tabla, $datos){
        try{
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
                numero_serie = :numeroSerieEdit,
                etiqueta = :etiquetaEdit,
                descripcion = :descripcionEdit,
                ubicacion_id = :ubicacionEdit,
                categoria_id = :categoriaEdit,
                cuentadante_id = :cuentadanteIdEdit,
                id_estado = :estadoEdit
                WHERE equipo_id = :equipo_id");
                
            $stmt->bindParam(":equipo_id", $datos["equipo_id"], PDO::PARAM_INT);
            $stmt->bindParam(":numeroSerieEdit", $datos["numeroSerieEdit"], PDO::PARAM_STR);
            $stmt->bindParam(":etiquetaEdit", $datos["etiquetaEdit"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcionEdit", $datos["descripcionEdit"], PDO::PARAM_STR);
            $stmt->bindParam(":ubicacionEdit", $datos["ubicacionEdit"], PDO::PARAM_INT);
            $stmt->bindParam(":categoriaEdit", $datos["categoriaEdit"], PDO::PARAM_INT);
            $stmt->bindParam(":cuentadanteIdEdit", $datos["cuentadanteIdEdit"], PDO::PARAM_INT);
            $stmt->bindParam(":estadoEdit", $datos["estadoEdit"], PDO::PARAM_INT);
    
            if($stmt->execute()){
                return "ok";
            } else {
                return "error";
            }
        } catch(PDOException $e){
            return "error: " . $e->getMessage();
        } finally {
            if($stmt){
                $stmt->closeCursor();
                $stmt = null;
            }
        }
    }
}