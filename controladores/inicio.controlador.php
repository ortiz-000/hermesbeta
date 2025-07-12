<?php
require_once "modelo_prestamos.php";

class ControladorInicio {
    
    public static function ctrObtenerConteoPrestamos() {
        try {
            return ModeloPrestamos::mdlContarPrestamosPorEstado();
        } catch (Exception $e) {
            error_log("Error en ctrObtenerConteoPrestamos: " . $e->getMessage());
            return [];
        }
    }
    
    public static function ctrObtenerEstados() {
        try {
            return ModeloPrestamos::mdlObtenerEstadosPrestamo();
        } catch (Exception $e) {
            error_log("Error en ctrObtenerEstados: " . $e->getMessage());
            return [];
        }
    }
}
?>