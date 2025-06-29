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
MARCAR EQUIPO EN DETALLE_PRESTAMO COMO MANTENIMIENTO
=============================================*/
	static public function ctrMarcarMantenimientoDetalle($idPrestamo, $idEquipo){
// Primero obtener el ID del estado 'Mantenimiento' de la tabla estados
        $stmt = Conexion::conectar()->prepare(
            "SELECT id_estado FROM estados WHERE estado = 'Mantenimiento'"
        );
        $stmt->execute();
        $estadoMantenimiento = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$estadoMantenimiento){
            return "error_estado_no_encontrado";
        }

        $datos = array(
            "equipo_id" => $idEquipo,
            "id_estado" => $estadoMantenimiento['id_estado'],
            "id_prestamo" => $idPrestamo
        );

        $respuestaMarcado = ModeloDevoluciones::mdlMarcarMantenimientoDetalle($datos);

        if($respuestaMarcado == "ok"){
            // Verificar si todos los equipos del préstamo han sido devueltos
            $todosDevueltos = ModeloDevoluciones::mdlVerificarTodosEquiposDevueltos($idPrestamo);

            if($todosDevueltos){
                $respuestaActualizacionPrestamo = ModeloDevoluciones::mdlActualizarPrestamoDevuelto($idPrestamo);
                return ($respuestaActualizacionPrestamo == "ok") ? "ok_prestamo_actualizado" : "error_actualizando_prestamo";
            }
            return "ok";
        }
        return $respuestaMarcado;
    }

/*============================================= 
MARCAR EQUIPO EN DETALLE_PRESTAMO COMO DEVUELTO EN BUEN ESTADO (Disponible)
=============================================*/
    static public function ctrMarcarDevueltoBuenEstado($idPrestamo, $idEquipo){
       // Primero obtener el ID del estado 'Disponible' de la tabla estados
        $stmt = Conexion::conectar()->prepare(
            "SELECT id_estado FROM estados WHERE estado = 'Disponible'"
        );
        $stmt->execute();
        $estadoDisponible = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$estadoDisponible){
            return "error_estado_no_encontrado";
        }

        $datos = array(
            "equipo_id" => $idEquipo,
            "id_estado" => $estadoDisponible['id_estado'],
            "id_prestamo" => $idPrestamo
        );

        $respuestaMarcado = ModeloDevoluciones::mdlMarcarMantenimientoDetalle($datos);

        if($respuestaMarcado == "ok"){
            // Verificar si todos los equipos del préstamo han sido devueltos
            $todosDevueltos = ModeloDevoluciones::mdlVerificarTodosEquiposDevueltos($idPrestamo);

            if($todosDevueltos){
                $respuestaActualizacionPrestamo = ModeloDevoluciones::mdlActualizarPrestamoDevuelto($idPrestamo);
                return ($respuestaActualizacionPrestamo == "ok") ? "ok_prestamo_actualizado" : "error_actualizando_prestamo";
            }
            return "ok";
        }
        return $respuestaMarcado;
    }

/*=============================================
MARCAR EQUIPO COMO ROBADO (BAJA)
=============================================*/
    static public function ctrMarcarEquipoRobado($idPrestamo, $idEquipo){
        // Primero obtener el ID del estado 'baja' de la tabla estados
        $stmt = Conexion::conectar()->prepare(
            "SELECT id_estado FROM estados WHERE estado = 'baja'"
        );
        $stmt->execute();
        $estadoBaja = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$estadoBaja){
            return "error_estado_no_encontrado";
        }

        $datos = array(
            "equipo_id" => $idEquipo,
            "id_estado" => $estadoBaja['id_estado'],
            "id_prestamo" => $idPrestamo
        );

        $respuestaMarcado = ModeloDevoluciones::mdlMarcarMantenimientoDetalle($datos);

        if($respuestaMarcado == "ok"){
            // Verificar si todos los equipos del préstamo han sido devueltos
            $todosDevueltos = ModeloDevoluciones::mdlVerificarTodosEquiposDevueltos($idPrestamo);

            if($todosDevueltos){
                $respuestaActualizacionPrestamo = ModeloDevoluciones::mdlActualizarPrestamoDevuelto($idPrestamo);
                return ($respuestaActualizacionPrestamo == "ok") ? "ok_prestamo_actualizado" : "error_actualizando_prestamo";
            }
            return "ok";
        }
        return $respuestaMarcado;
    }
}
?>