<?php

Class ControladorCategorias{
    static public function ctrMostrarCategorias($item, $valor){
        $tabla = "categorias";

        $resultado = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);
        return $resultado;
    }
}