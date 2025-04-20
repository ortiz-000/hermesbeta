<?php

class ControladorSolicitudes{

    static public function ctrMostrarEquiposDisponible($fechaInicio, $fechaFin){



        $respuesta = ModeloSolicitudes::mdlMostrarEquiposDisponible($fechaInicio, $fechaFin);

        return $respuesta;

    }

    
}