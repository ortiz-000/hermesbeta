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

    static public function ctrMostrarDatosCuentadanteOrigen($item, $valor){
        $tabla = "equipos";
        $respuesta = ModeloEquipos::mdlMostrarDatosCuentadanteOrigen($tabla, $item, $valor);
        //var_dump($respuesta);
        return $respuesta;
    }

    static public function ctrMostrarDatosCuentadanteTraspaso($item, $valor){
        $tabla = "usuarios";
        $respuesta = ModeloEquipos::mdlMostrarDatosCuentadanteTraspaso($tabla, $item, $valor);
        return $respuesta;
    }

    static public function ctrRealizarTraspasoCuentadante(){
        if(isset($_POST["idTraspasoEquipo"]) && isset($_POST["cuentadanteDestino"]) && isset($_POST["ubicacionTraspaso"])){
            $tabla = "equipos";
            $datos = array(
                "equipo_id" => $_POST["idTraspasoEquipo"],
                "cuentadante_id" => $_POST["cuentadanteDestino"],
                "ubicacion_id" => $_POST["ubicacionTraspaso"]
            );

            $respuesta = ModeloEquipos::mdlRealizarTraspasoCuentadante($tabla, $datos);
            //var_dump($respuesta[0]);

            if($respuesta == "success"){
                echo '<script>
                        swal.fire({
                            icon: "success",
                            title: "¡Traspaso realizado con éxito!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "inventario";
                            }
                        });
                    </script>';
            } else if($respuesta == "nochange"){
                echo '<script>
                        swal.fire({
                            icon: "info",
                            title: "Algo ha fallado. No se realizaron cambios",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "inventario";
                            }
                        });
                    </script>';
            } else {
                echo '<script>
                        swal.fire({
                            icon: "error",
                            title: "¡Ups! Sucedió un error en el traspaso",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "inventario";
                            }
                        });
                    </script>';
            }
        }
    }

} //fin de la clase ControladorEquipos    