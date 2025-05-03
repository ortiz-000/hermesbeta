<?php

Class ModeloEquipos{
    static public function mdlMostrarEquipos($tabla, $item, $valor){
        if($item != null){
            $stmt = Conexion::conectar()->prepare("SELECT e.equipo_id,
                                                    e.numero_serie,
                                                    e.etiqueta,
                                                    e.descripcion,
                                                    e.fecha_entrada,
                                                    u.ubicacion_id AS ubicacion,
                                                    c.categoria_id AS categoria,
                                                    us.id_usuario AS nombre_cuentadante,
                                                    es.id_estado
                                                FROM equipos e
                                                LEFT JOIN ubicaciones u ON e.ubicacion_id = u.ubicacion_id
                                                LEFT JOIN categorias c ON e.categoria_id = c.categoria_id
                                                LEFT JOIN usuarios us ON e.cuentadante_id = us.id_usuario
                                                LEFT JOIN estados es ON e.id_estado = es.id_estado
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