<?php

class ControladorModulos
{
    /*=============================================
    CREAR MÓDULO
    =============================================*/
    static public function ctrCrearModulo()
    {
        if (isset($_POST["nombreModulo"]) && isset($_POST["descripcionModulo"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreModulo"])) {

                $tabla = "modulos";
                $datos = array(
                    "nombre" => $_POST["nombreModulo"],
                    "descripcion" => $_POST["descripcionModulo"]
                );

                $respuesta = ModeloModulos::mdlCrearModulo($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡El módulo ha sido guardado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "modulos";
                            }
                        });
                    </script>';
                } else {
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡Error al guardar el módulo!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "modulos";
                            }
                        });
                    </script>';
                }
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Revisar parámetros!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "modulos";
                        }
                    });
                </script>';
            }
        }
    }

    /*=============================================
    MOSTRAR MÓDULOS
    =============================================*/
    static public function ctrMostrarModulos($item, $valor)
    {
        $tabla = "modulos";
        $respuesta = ModeloModulos::mdlMostrarModulos($tabla, $item, $valor);

        return $respuesta;
    }

    /*=============================================
    EDITAR MÓDULO
    =============================================*/
    static public function ctrEditarModulo()
    {
        if (isset($_POST["nombreEditModulo"]) && isset($_POST["descripcionEditModulo"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreEditModulo"])) {

                $tabla = "modulos";
                $datos = array(
                    "id" => $_POST["idEditModulo"],
                    "nombre" => $_POST["nombreEditModulo"],
                    "descripcion" => $_POST["descripcionEditModulo"]
                );

                $respuesta = ModeloModulos::mdlEditarModulo($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡El módulo ha sido editado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "modulos";
                            }
                        });
                    </script>';
                } else {
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡Error al editar el módulo!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "modulos";
                            }
                        });
                    </script>';
                }
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Revisar parámetros!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "modulos";
                        }
                    });
                </script>';
            }
        }
    }
}