<?php

class ControladorDevoluciones {

    /*=============================================
    MOSTRAR DEVOLUCIONES
    =============================================*/

    static public function ctrMostrarDevoluciones($item, $valor) {

        $tabla = "prestamos";
        $respuesta = ModeloDevoluciones::mdlMostrarDevoluciones($tabla, $item, $valor);

        return $respuesta;
    }




















}

?>