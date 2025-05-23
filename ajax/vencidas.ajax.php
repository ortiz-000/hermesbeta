<?php

require_once "../controladores/vencidas.controlador.php";
require_once "../modelos/vencidas.modelo.php";

class AjaxVencidas {
    
    public $idSolicitud;
    
    public function ajaxMostrarSolicitudVencida() {
        $item = "id_prestamo";
        $valor = $this->idSolicitud;
        
        $respuesta = ControladorVencidas::ctrMostrarSolicitudesVencidas($item, $valor);
        echo json_encode($respuesta);
    }
}

if(isset($_POST["idSolicitud"])) {
    $solicitud = new AjaxVencidas();
    $solicitud->idSolicitud = $_POST["idSolicitud"];
    $solicitud->ajaxMostrarSolicitudVencida();
}