<?php


Class ControladorInicio {

    public static function ctrObtenerPrestamosPorDia() {
    require_once "modelos/inicio.modelo.php"; 

    $modelo = new ModeloInicio();
    $resultado = $modelo->mdlobtenerPrestamosPorDia();

    return $resultado; 
}

public static function ctrObtenerPrestamosPorEstado() 
    {
        require_once "modelos/inicio.modelo.php"; 
        
        $modelo = new ModeloInicio();
        $resultado = $modelo->mdlObtenerPrestamosPorEstado();
        
        return $resultado; 
    }

}