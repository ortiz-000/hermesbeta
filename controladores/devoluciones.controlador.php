<?php
    class ControladorDevoluciones {
        /*=============================================
        MOSTRAR DEVOLUCIONES (LISTADO)
        =============================================*/
        static public function ctrMostrarDevoluciones($item, $valor) {
            $tabla = "prestamos";
            $respuesta = ModeloDevoluciones::mdlMostrarDevoluciones($tabla, $item, $valor);
            return $respuesta;
        }

	/*============================================= 
	MARCAR EQUIPO EN DETALLE_PRESTAMO COMO MANTENIMIENTO (ACTUALIZANDO ID_ESTADO)
	=============================================*/
	static public function ctrMarcarMantenimientoDetalle($idPrestamo, $idEquipo){

		$tabla = "detalle_prestamo";
		// Asumimos que el id_estado para 'Mantenimiento' es 4.
		// Si es diferente, ajusta este valor.
		$datos = array("id_prestamo" => $idPrestamo,
					   "equipo_id" => $idEquipo,
					   "id_estado" => 4); // Cambiado de "estado" => "Mantenimiento"

		$respuesta = ModeloDevoluciones::mdlMarcarMantenimientoDetalle($tabla, $datos);

		return $respuesta;

	}

}
?>