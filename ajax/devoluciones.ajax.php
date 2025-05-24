<?php

require_once "../controladores/devoluciones.controlador.php";
require_once "../modelos/devoluciones.modelo.php";

class AjaxDevoluciones {
    public $idPrestamo;
    public $idEquipo;
    public $accion;

    public function ajaxObtenerDatosPrestamo() {
        $item = "id_prestamo";
        $valor = $this->idPrestamo;

        // La respuesta ahora será un array de equipos si el préstamo tiene varios
        $respuesta = ControladorDevoluciones::ctrMostrarDevoluciones($item, $valor);

        echo json_encode($respuesta);
    }

    /*=============================================
    MARCAR EQUIPO EN DETALLE_PRESTAMO COMO MANTENIMIENTO
    =============================================*/
    public function ajaxMarcarMantenimientoDetalle() {
        // No se necesita pasar id_estado desde aquí, ya que se define en el controlador
        $respuestaModelo = ControladorDevoluciones::ctrMarcarMantenimientoDetalle($this->idPrestamo, $this->idEquipo);
        
        if ($respuestaModelo == "ok") {
            echo json_encode(array("success" => true, "message" => "Equipo marcado para mantenimiento correctamente."));
        } else if ($respuestaModelo == "no_change") {
            echo json_encode(array("success" => false, "message" => "El equipo ya estaba en el estado deseado o no se encontró."));
        } else {
            echo json_encode(array("success" => false, "message" => "Error al actualizar el estado del equipo en el modelo."));
        }
    }
}

// Obtener datos del préstamo
if(isset($_POST["idPrestamo"]) && !isset($_POST["accion"])) {
    $prestamo = new AjaxDevoluciones();
    $prestamo->idPrestamo = $_POST["idPrestamo"];
    $prestamo->ajaxObtenerDatosPrestamo();
}

// Marcar equipo en detalle_prestamo como Mantenimiento
if(isset($_POST["accion"]) && $_POST["accion"] === "marcarMantenimientoDetalle") {
    $devolucion = new AjaxDevoluciones();
    $devolucion->idPrestamo = $_POST["idPrestamo"];
    $devolucion->idEquipo = $_POST["idEquipo"];
    $devolucion->ajaxMarcarMantenimientoDetalle();
}