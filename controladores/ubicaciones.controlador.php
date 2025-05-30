<?php

Class ControladorUbicaciones{
    static public function ctrMostrarUbicaciones($item, $valor){
        $tabla = "ubicaciones";
        $respuesta = ModeloUbicaciones::mdlMostrarUbicaciones($tabla, $item, $valor);
        return $respuesta;
    }
}