<?php

class ControladorEquipos{

    static public function ctrMostrarEquipos($item, $valor){
        $tabla = "equipos";
        $respuesta = ModeloEquipos::mdlMostrarEquipos($tabla, $item, $valor);
        //var_dump($respuesta[0]);
        return $respuesta;
    }

    static public function ctrAgregarEquipos(){
        if(isset($_POST["numeroSerie"]) && isset($_POST["etiqueta"])
            && isset($_POST["descripcion"])){
            if(preg_match('/^[a-zA-ZñÑáéíóÁÉÍÓÚ ]+$/',$_POST["numeroSerie"]) && preg_match('/^[a-zA-ZñÑáéíóÁÉÍÓÚ ]+$/', $_POST["etiqueta"]) && preg_match('/^[a-zA-ZñÑáéíóÁÉÍÓÚ ]+$/', $_POST["descripcion"])){
                $tabla = "equipos";
                $datos = array(
                    "numeroSerie" => $_POST["numeroSerie"],
                    "etiqueta" => $_POST["etiqueta"],
                    "descripcion" => $_POST["descripcion"]
                );

                $respuesta = ModeloEquipos::mdlAgregarEquipos($tabla, $datos);
            }
        }
    }

    static public function ctrRealizarTraspasoCuentadante($item, $valor){
        $tabla = "equipos";
        $respuesta = ModeloEquipos::mdlRealizarTraspasoCuentadante($tabla, $item, $valor);
        //var_dump($respuesta);
        return $respuesta;
    }

} //fin de la clase ControladorEquipos    