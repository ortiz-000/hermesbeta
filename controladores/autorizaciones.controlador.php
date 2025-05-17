<?php

class ControladorAutorizaciones {

    static public function ctrMostrarAutorizaciones($item, $valor){
        $tabla = "autorizaciones";
        $respuesta = ModeloAutorizaciones::mdlMostrarAutorizaciones($tabla, $item, $valor);
        return $respuesta;
    }

    public function ctrActualizarAutorizacion(){
        if(isset($_POST["idAutorizacion"])){
            $tabla = "autorizaciones";
            
            if(isset($_POST["motivoRechazo"]) && !empty($_POST["motivoRechazo"])){
                $datos = array(
                    "id_autorizacion" => $_POST["idAutorizacion"],
                    "estado" => "rechazado",
                    "motivo_rechazo" => $_POST["motivoRechazo"]
                );
            } else {
                $datos = array(
                    "id_autorizacion" => $_POST["idAutorizacion"],
                    "estado" => "autorizado",
                    "motivo_rechazo" => null
                );
            }

            $respuesta = ModeloAutorizaciones::mdlActualizarAutorizacion($tabla, $datos);

            if($respuesta == "ok"){
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡La autorización ha sido actualizada correctamente!",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(result){
                        window.location = "autorizaciones";
                    });
                </script>';
            }
        }
    }
}