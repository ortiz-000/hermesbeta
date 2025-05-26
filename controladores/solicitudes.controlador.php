<?php

class ControladorSolicitudes
{

    static public function ctrMostrarEquiposDisponible($fechaInicio, $fechaFin)
    {
        $respuesta = ModeloSolicitudes::mdlMostrarEquiposDisponible($fechaInicio, $fechaFin);
        return $respuesta;
    }
    
    static public function ctrGuardarSolicitud()
    {
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";

        if (
            isset($_POST["idSolicitante"]) &&
            isset($_POST["equipos"])

        ) {



            $datos = array(
                "idSolicitante" => $_POST["idSolicitante"],
                "equipos" => $_POST["equipos"],
                "fechaInicio" => $_POST["fechaInicio"],
                "fechaFin" => $_POST["fechaFin"],
                "observaciones" => $_POST["observaciones"],
                "estado_prestamo" => "pendiente"

            );


            // Determinar tipo de préstamo
            $datos["tipo_prestamo"] = ($_POST["fechaInicio"] === $_POST["fechaFin"]) ? "inmediato" : "reservado";

            $tabla = "prestamos";
            $respuesta = ModeloSolicitudes::mdlGuardarSolicitud($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Solicitud guardada correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "solicitudes";
                    }
                });
            </script>';
                return $respuesta;
            } else {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error al guardar la solicitud",
                    text: "Intente nuevamente.",
                    confirmButtonText: "Cerrar"
                });
            </script>';
                return "error";
            }
        }

        return null;
    }

    static public function ctrMostrarSolicitudes($item, $valor){
        $respuesta = ModeloSolicitudes::mdlMostrarSolicitudes($item, $valor);
        return $respuesta;
    }

    static public function ctrMostrarPrestamo($item, $valor){
        $respuesta = ModeloSolicitudes::mdlMostrarPrestamo($item, $valor);
        return $respuesta;
    }

    static public function ctrMostrarPrestamoDetalle($item, $valor){
        $respuesta = ModeloSolicitudes::mdlMostrarPrestamoDetalle($item, $valor);
        return $respuesta;
    }

    public static function ctrContarEquiposPorCategoria() {
        return ModeloSolicitudes::mdlContarEquiposPorCategoria();
    }



}