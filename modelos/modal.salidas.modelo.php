public static function mdlMostrarDetallesPrestamo($id_prestamo)
 {
    try 
    {
        // Validar el parámetro de entrada
        if (!is_numeric($id_prestamo) || $id_prestamo <= 0)
        {
            throw new Exception("ID de préstamo inválido");
        }

        $stmt = Conexion::conectar()->prepare("SELECT categoria, equipo, etiqueta, serial 
                                               FROM equipos 
                                               WHERE id_prestamo = :id_prestamo");
        $stmt->bindParam(":id_prestamo", $id_prestamo, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Cerrar recursos
        $stmt->closeCursor();
        return $resultado;
        
    } catch (Exception $e) 
    {   
        error_log("Error en mdlMostrarDetallesPrestamo: " . $e->getMessage());
        return false;
    }
}
