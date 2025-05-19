<?php

require_once "../controladores/devoluciones.controlador.php";
require_once "../modelos/devoluciones.modelo.php";

class AjaxDevoluciones {
    public $idPrestamo;

    public function ajaxObtenerDatosPrestamo() {
        $item = "id_prestamo";
        $valor = $this->idPrestamo;
        
        $respuesta = ControladorDevoluciones::ctrMostrarDevoluciones($item, $valor);
        
        echo json_encode($respuesta);
    }
}

// Obtener datos del préstamo
if(isset($_POST["idPrestamo"])) {
    $prestamo = new AjaxDevoluciones();
    $prestamo->idPrestamo = $_POST["idPrestamo"];
    $prestamo->ajaxObtenerDatosPrestamo();
}