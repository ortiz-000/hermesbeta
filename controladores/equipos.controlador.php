<?php

Class ControladorEquipos{

    static public function ctrMostrarEquipos($item, $valor){
        $tabla = "equipos";
        $respuesta = ModeloEquipos::mdlMostrarEquipos($tabla, $item, $valor);
        return $respuesta;
    }

    static public function ctrAgregarEquipos(){
        if (
            isset($_POST["numero_serie"]) &&
            isset($_POST["etiqueta"]) &&
            isset($_POST["descripcion"]) &&
            isset($_POST["fecha_entrada"]) &&
            isset($_POST["ubicacion_id"]) &&
            isset($_POST["categoria_id"]) &&
            isset($_POST["cuentadante_id"]) &&
            isset($_POST["a_cuentadante"]) &&
            isset($_POST["id_estado"])
            
        ) {
    
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["numero_serie"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["etiqueta"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ.,() ]+$/', $_POST["descripcion"])
            ) {
                $tabla = "equipos";
    
                $datos = array(
                    "numero_serie"    => $_POST["numero_serie"],
                    "etiqueta"        => $_POST["etiqueta"],
                    "descripcion"     => $_POST["descripcion"],
                    "fecha_entrada"   => $_POST["fecha_entrada"],
                    "ubicacion_id"    => $_POST["ubicacion_id"],
                    "categoria_id"    => $_POST["categoria_id"],
                    "cuentadante_id"  => $_POST["cuentadante_id"],
                    "a_cuentadante"   => $_POST["a_cuentadante"],
                    "id_estado"       => $_POST["id_estado"]
                );
    
                $respuesta = ModeloEquipos::mdlAgregarEquipos($tabla, $datos);
                if ($respuesta == "ok") {
                    echo '<script>alert("Equipo agregado correctamente");</script>';
                }else {
                    echo '<script>alert("Error al agregar equipo");</script>';
                }
                }
        } 
    }
    
}
    