<?php

class ControladorVencidas {
    
    static public function ctrMostrarSolicitudesVencidas($item, $valor) {
        $tabla = "prestamos";
        $respuesta = ModeloVencidas::mdlMostrarSolicitudesVencidas($item, $valor);
        return $respuesta;
    }
}