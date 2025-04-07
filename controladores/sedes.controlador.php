<?php

    Class ControladorSedes{
        static public function ctrMostrarSedes($item, $valor){
            $tabla = "sedes";
            $respuesta = ModeloSedes::mdlMostrarSedes($tabla, $item, $valor);

            return $respuesta;
        }

        static public function ctrCrearSedes(){
            if(isset($_POST["nombreSede"]) && isset($_POST["direccionSede"]) && isset($_POST["descripcionSede"])){
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreSede"]) && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["direccionSede"])){

                    $tabla = "sedes";
                    $datos = array(
                        "nombre_sede" => $_POST["nombreSede"],
                        "direccion" => $_POST["direccionSede"],
                        "descripcion" => $_POST["descripcionSede"]
                    );

                    $respuesta = ModeloSedes::mdlCrearSedes($tabla, $datos);
                    var_dump($respuesta);
                    
                    if($respuesta == "ok"){
                        echo '<script>
                            Swal.fire({
                                icon: "success",
                                title: "Sede agregada con éxito!",
                                showConfirmButton: true,
                                confirmButton: "Cerrar"
                            }).then((result) => {
                                if(result.isConfirmed){
                                    window.location = "sedes";
                                }
                            });
                        
                        </script>';
                    } else {
                        echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "Error al agregar la Sede!",
                                showConfirmButton: true,
                                confirmButton: "Cerrar"
                            }).then((result) => {
                                if(result.isConfirmed){
                                    window.location = "sedes";
                                }
                            });
                        
                        </script>';
                    }
                } else {
                    echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "Error!",
                                text: "Cáracteres ingresados no admitidos...",
                                showConfirmButton: true,
                                confirmButton: "Cerrar"
                            }).then((result) => {
                                if(result.isConfirmed){
                                    window.location = "sedes";
                                }
                            });
                        
                        </script>';
                }
            }
        }

        
    }

?>