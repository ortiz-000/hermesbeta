<?php
require_once "conexion.php";

class ModeloPrestamos {

    /* ========== CONTAR PRÉSTAMOS POR ESTADO ========== */
    static public function mdlContarPrestamosPorEstado() {
        $stmt = Conexion::conectar()->prepare(
            "SELECT 
                estado_prestamo, 
                COUNT(*) as total 
             FROM prestamos 
             GROUP BY estado_prestamo"
        );
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ========== OBTENER TODOS LOS ESTADOS ÚNICOS ========== */
    static public function mdlObtenerEstadosPrestamo() {
        $stmt = Conexion::conectar()->prepare(
            "SELECT DISTINCT estado_prestamo FROM prestamos"
        );
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
?>