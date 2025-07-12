<?php


class ControladorInicio {

    public static function ctrObtenerPrestamosPorDia()
     
    {
        
        $modelo = new ModeloInicio();
        $respuesta = $modelo->mdlobtenerPrestamosPorDia();

        return $respuesta; 
    }
    
}


