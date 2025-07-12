<?php

include_once "conexion.php";

class ModeloInicio
{
    public function mdlobtenerPrestamosPorDia()
    {
        $sql = "SELECT 
                ELT(WEEKDAY(fecha_solicitud)+1, 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo') AS dia,
                 COUNT(*) AS cantidad
                FROM prestamos
                WHERE WEEK(fecha_solicitud) = WEEK(CURDATE())
                 AND YEAR(fecha_solicitud) = YEAR(CURDATE())
                GROUP BY dia
                ORDER BY FIELD(dia, 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes');";

        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}