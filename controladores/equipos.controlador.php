<?php

class ControladorEquipos
{

    static public function ctrMostrarEquipos($item, $valor)
    {
        $tabla = "equipos";
        $respuesta = ModeloEquipos::mdlMostrarEquipos($tabla, $item, $valor);
        return $respuesta;
    }

    static public function ctrAgregarEquipos()
    {
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
                } else {
                    echo '<script>alert("Error al agregar equipo");</script>';
                }
            }
        }
    }

    public static function ctrEditarEquipos(){
        if (isset($_POST["numeroSerieEdit"]) && isset($_POST["etiquetaEdit"]) && isset($_POST["descripcionEdit"]) && isset($_POST["ubicacionEdit"]) && isset($_POST["categoriaEditId"]) && isset($_POST["estadoEdit"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["numeroSerieEdit"]) &&
            preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["etiquetaEdit"]) &&
            preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcionEdit"])){
                $tabla = "equipos";
                $datos = array(
                    "equipo_id" => $_POST["idEditEquipo"],
                    "numeroSerieEdit" => $_POST["numeroSerieEdit"],
                    "etiquetaEdit" => $_POST["etiquetaEdit"],
                    "descripcionEdit" => $_POST["descripcionEdit"],
                    "ubicacionEdit" => $_POST["ubicacionEdit"],
                    "categoriaEdit" => $_POST["categoriaEditId"]
                );
                $respuesta = ModeloEquipos::mdlEditarEquipos($tabla, $datos);
                if ($respuesta == "ok") {
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡El equipo ha sido editado correctamente!",
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
                        Swal.fire({
                            icon: "error",
                            title: "¡Error al editar el equipo!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "inventario";
                            }
                        });
                    </script>';
                }
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Revisar parametros!",
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

    static public function ctrRealizarTraspasoCuentadante($item, $valor)
    {
        $tabla = "equipos";
        $respuesta = ModeloEquipos::mdlRealizarTraspasoCuentadante($tabla, $item, $valor);
        //var_dump($respuesta);
        return $respuesta;
    }
}
