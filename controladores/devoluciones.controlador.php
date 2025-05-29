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

		$respuestaMarcado = ModeloDevoluciones::mdlMarcarMantenimientoDetalle($tabla, $datos);

		if($respuestaMarcado == "ok"){
			// Verificar si todos los equipos del préstamo han sido devueltos
			$todosDevueltos = ModeloDevoluciones::mdlVerificarTodosEquiposDevueltos($idPrestamo);

			if($todosDevueltos){
				// Si todos han sido devueltos, actualizar el estado del préstamo
				$respuestaActualizacionPrestamo = ModeloDevoluciones::mdlActualizarPrestamoDevuelto($idPrestamo);
				if($respuestaActualizacionPrestamo == "ok"){
					return "ok_prestamo_actualizado"; // Éxito al marcar equipo y actualizar préstamo
				} else {
					return "error_actualizando_prestamo"; // Error al actualizar el préstamo
				}
			} else {
				return "ok"; // Éxito al marcar el equipo, pero no todos han sido devueltos aún
			}
		} else {
			return $respuestaMarcado; // Retorna "no_change" o "error" del marcado inicial
		}

	}
	/*============================================= 
MARCAR EQUIPO EN DETALLE_PRESTAMO COMO DEVUELTO EN BUEN ESTADO
=============================================*/
static public function ctrMarcarDevueltoBuenEstado($idPrestamo, $idEquipo){
    $tabla = "detalle_prestamo";
    $datos = array(
        "id_prestamo" => $idPrestamo,
        "equipo_id" => $idEquipo,
        "id_estado" => 1 // 1 = Disponible
    );

    $respuestaMarcado = ModeloDevoluciones::mdlMarcarDevueltoBuenEstado($tabla, $datos);

    if($respuestaMarcado == "ok"){
        $todosDevueltos = ModeloDevoluciones::mdlVerificarTodosEquiposDevueltos($idPrestamo);

        if($todosDevueltos){
            $respuestaActualizacionPrestamo = ModeloDevoluciones::mdlActualizarPrestamoDevuelto($idPrestamo);
            if($respuestaActualizacionPrestamo == "ok"){
                return "ok_prestamo_actualizado";
            } else {
                return "error_actualizando_prestamo";
            }
        } else {
            return "ok";
        }
    } else {
        return $respuestaMarcado;
    }
}

}
?>