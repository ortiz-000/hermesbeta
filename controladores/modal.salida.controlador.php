public static function ctrMostrarDetallesPrestamo($id_prestamo)
 {
    // Validar el parámetro de entrada
    if (!is_numeric($id_prestamo) || $id_prestamo <= 0) {
        return false;
    }
    
    $resultado = ModeloSalidas::mdlMostrarDetallesPrestamo($id_prestamo);
    
    // Verificar si se obtuvo un resultado válido
    if ($resultado === false) 
    {
        return false;
    }
    
    return $resultado;
}