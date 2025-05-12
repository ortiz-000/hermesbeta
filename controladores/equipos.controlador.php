<?php

class ControladorEquipos{

    // =====================================
    //     MOSTRAR EQUIPO
    // =====================================
    public static function crtMostrarEquipos($item, $valor){

        $tabla = "equipos";

        $respuesta = ModeloEquipos::mdlMostrarEquipos($tabla, $item, $valor);

        return $respuesta;

    } // fin metodo crtMostrarEquipos

} //fin de la clase ControladorEquipos    