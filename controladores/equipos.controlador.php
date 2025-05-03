<?php

Class ControladorEquipos{

    static public function ctrMostrarEquipos($item, $valor){
        $tabla = "equipos";
        $respuesta = ModeloEquipos::mdlMostrarEquipos($tabla, $item, $valor);
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

    static public function ctrEditarEquipos(){
        if(isset($_POST["idEditEquipo"]) && isset($_POST["numeroSerieEdit"]) && isset($_POST["etiquetaEdit"]) && isset($_POST["descripcionEdit"]) && isset($_POST["ubicacionEdit"]) && isset($_POST["categoriaEditId"]) && isset($_POST["cuentadanteIdEdit"]) && isset($_POST["estadoEdit"])){
            
            // Validación menos restrictiva que permite números y caracteres especiales
            if(preg_match('/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ .-]+$/', $_POST["numeroSerieEdit"]) && 
               preg_match('/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ .-]+$/', $_POST["etiquetaEdit"]) && preg_match('/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ .-]+$/', $_POST["descripcionEdit"])){
                
                $tabla = "equipos";
                $datos = array(
                    "equipo_id" => $_POST["idEditEquipo"],
                    "numeroSerieEdit" => $_POST["numeroSerieEdit"],
                    "etiquetaEdit" => $_POST["etiquetaEdit"],
                    "descripcionEdit" => $_POST["descripcionEdit"],
                    "ubicacionEdit" => $_POST["ubicacionEdit"],
                    "categoriaEdit" => $_POST["categoriaEditId"],
                    "cuentadanteIdEdit" => $_POST["cuentadanteIdEdit"],
                    "estadoEdit" => $_POST["estadoEdit"]
                );
                
                $respuesta = ModeloEquipos::mdlEditarEquipos($tabla, $datos);
                
                if($respuesta == "ok"){
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡El equipo ha sido editado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "inventario";
                            }
                        });
                    </script>';
                }
            }
        }
    }
}