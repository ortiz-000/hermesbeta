<?php

require_once "conexion.php";

class ModeloSolicitudes{

    static public function mdlMostrarEquiposDisponible($fechaInicio, $fechaFin){
        
        $stmt = Conexion::conectar()->prepare("SELECT e.*,
                                                    c.nombre AS categoria_nombre,
                                                    u.nombre AS ubicacion_nombre,
                                                    us.nombre AS cuentadante_nombre
                                                FROM 
                                                    equipos e
                                                JOIN 
                                                    categorias c ON e.categoria_id = c.categoria_id
                                                JOIN 
                                                    ubicaciones u ON e.ubicacion_id = u.ubicacion_id
                                                JOIN 
                                                    usuarios us ON e.cuentadante_id = us.id_usuario                                                
                                                WHERE e.id_estado = 1 OR (
                                                    e.id_estado = 3 AND NOT EXISTS (
                                                        SELECT 1
                                                        FROM prestamos p
                                                        JOIN detalle_prestamo dp ON p.id_prestamo = dp.id_prestamo
                                                        WHERE dp.equipo_id = e.equipo_id
                                                        AND p.tipo_prestamo = 'Reservado'
                                                        AND (
                                                            (p.fecha_inicio BETWEEN :fechaInicio AND :fechaFin) OR
                                                            (p.fecha_fin BETWEEN :fechaInicio AND :fechaFin) OR
                                                            (:fechaInicio BETWEEN p.fecha_inicio AND p.fecha_fin) OR
                                                            (:fechaFin BETWEEN p.fecha_inicio AND p.fecha_fin)
                                                        )
                                                    )
                                                )"
                                            );

        $stmt->bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
        $stmt->bindParam(":fechaFin", $fechaFin, PDO::PARAM_STR);

        // error_log("Fecha Inicio: $fechaInicio, Fecha Fin: $fechaFin", 0); 

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return "vacio";
        }

        $stmt->close();
        $stmt = null;
    } // fin del metodo mdlMostrarEquiposDisponible

}//ModeloSolicitudes
