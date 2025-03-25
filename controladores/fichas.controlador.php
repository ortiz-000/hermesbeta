<?php

class ControladorFichas {

    // Método para crear una nueva ficha
    static public function ctrCrearFicha() {
        
        if (isset($_POST["codigoFicha"]) && isset($_POST["descripcionFicha"])  && isset($_POST["id_sede"]) && isset($_POST["fechaInicio"]) && isset($_POST["fechaFin"])) {
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["codigoFicha"]) && 
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ \s]+$/', $_POST["descripcionFicha"])) {

                $tabla = "fichas";
                $datos = array(
                    "codigo" => $_POST["codigoFicha"],
                    "descripcion" => $_POST["descripcionFicha"],
                    "idSede" => $_POST["id_sede"],
                    "fecha_inicio" => $_POST["fechaInicio"],
                    "fecha_fin" => $_POST["fechaFin"]
                );

                $respuesta = ModeloFichas::mdlCrearFicha($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡La ficha ha sido creada correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "fichas";
                            }
                        });                        
                    </script>';
                } else {
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡Error al crear la ficha!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "fichas";
                            }
                        });
                    </script>';
                }
            }
        }


    }

    static public function ctrEditarFicha() {
        // Implementar la lógica para editar una ficha
        if (isset($_POST["editCodigo"]) && isset($_POST["editDescripcion"])  && isset($_POST["editSede"]) && isset($_POST["EditFechaInicio"]) && isset($_POST["EditFechaFin"])) {
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editCodigo"]) && 
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ \s]+$/', $_POST["editDescripcion"])) {

                // Validar que la fecha de inicio sea menor que la fecha de fin
                if ($_POST["fechaInicio"] > $_POST["fechaFin"]) {
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡La fecha de inicio no puede ser mayor que la fecha de fin!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "fichas";
                            }
                        });
                    </script>';
                    return;
                }
            }
            // Validar y procesar los datos de la ficha
            $tabla = "fichas";
            $datos = array(
                "id" => $_POST["idFicha"],
                "codigo" => $_POST["editCodigo"],
                "descripcion" => $_POST["editDescripcion"],
                "idSede" => $_POST["editSede"],
                "fecha_inicio" => $_POST["editFechaInicio"],
                "fecha_fin" => $_POST["EditFechaFin"]
            );

            $respuesta = ModeloFichas::mdlActualizarFicha($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡La ficha ha sido editada correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "fichas";
                        }
                    });
                </script>';
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error al editar la ficha!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "fichas";
                        }
                    });
                </script>';
            }
        }
    }

    // Método para leer una ficha por su ID
    public function leerFicha($id) {
        // Lógica para leer una ficha de la base de datos por su ID
    }

    // Método para actualizar una ficha existente
    public function actualizarFicha($id, $datos) {
        // Lógica para actualizar una ficha existente en la base de datos
    }

    // Método para eliminar una ficha por su ID
    public function eliminarFicha($id) {
        // Lógica para eliminar una ficha de la base de datos por su ID
    }

    // Método para listar todas las fichas
    static public function ctrMostrarFichas($item, $valor) {
        $tabla = "fichas";
        $respuesta = ModeloFichas::mdlMostrarFichas($tabla, $item, $valor);
        return $respuesta;
        
    }
}

?>