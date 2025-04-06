<?php

class ControladorUsuarios{

    public function ctrIngresoUsuario(){
        if (isset($_POST["ingUsuario"])) {
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])) {
                
                $tabla = "usuarios";
                $item = "nombre_usuario";
                $valor = $_POST["ingUsuario"];

                $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

                if ($respuesta["nombre_usuario"] == $_POST["ingUsuario"] && $respuesta["clave"] == $_POST["ingPassword"]) {

                    $_SESSION["iniciarSesion"] = "ok";
                    echo '<script>
                        window.location = "inicio";
                    </script>';
                } else {
                    echo '<br><div class="alert alert-danger">Usuario y contraseña no coinciden</div>';
                }
            }
        }
    }


    static public function ctrCrearUsuario(){
        
        if (isset($_POST["nuevoNombre"]) &&
            isset($_POST["nuevoApellido"]) &&
            isset($_POST["nuevoTipoDocumento"]) &&
            isset($_POST["nuevoNumeroDocumento"]) ){
            if (preg_match('/^[a-zA-ZñÑáéíóÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
                preg_match('/^[a-zA-ZñÑáéíóÁÉÍÓÚ ]+$/', $_POST["nuevoApellido"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoNumeroDocumento"]) ) {
                // si el usuario es aprendiz se debe validar la sede y la ficha
                if ($_POST["selectRol"] != 6) {
                    $sede = "";
                    $ficha = "";
                }else{
                    $sede = $_POST["id_sede"];
                    $ficha = $_POST["id_ficha"];
                }

                $tabla = "usuarios";
                $datos = array(
                    "nombre" => $_POST["nuevoNombre"],
                    "apellido" => $_POST["nuevoApellido"],
                    "tipo_documento" => $_POST["nuevoTipoDocumento"],
                    "documento" => $_POST["nuevoNumeroDocumento"],
                    "email" => $_POST["nuevoEmail"],
                    "telefono" => $_POST["nuevoTelefono"],
                    "direccion" => $_POST["nuevaDireccion"],
                    "genero" => $_POST["nuevoGenero"],
                    "usuario" => $_POST["nuevoNumeroDocumento"],
                    "password" => $_POST["nuevoNumeroDocumento"],
                    "rol" => $_POST["selectRol"],
                    // si es aprendiz
                    "sede" => $sede,
                    "ficha" => $ficha
                );

                $respuesta = ModeloUsuarios::mdlCrearUsuario($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                        swal.fire({
                            icon: "success",
                            title: "¡El usuario ha sido creado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "usuarios";
                            }
                        });
                    </script>';
                } else {
                    echo '<script>
                        swal.fire({
                            icon: "error",
                            title: "¡Error al crear el usuario!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "usuarios";
                            }
                        });
                    </script>';
                }
            } else {
                echo '<script>
                    swal.fire({
                        icon: "error",
                        title: "¡Revisar parametros!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "usuarios";
                        }
                    });
                </script>';
            }
        }
        // var_dump($_POST);
    }





    static public function ctrMostrarUsuarios($item, $valor){
        $tabla = "usuarios";
        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);
        return $respuesta;
    }

    static public function ctrMostrarFichasSede($item, $valor){
        $tabla = "fichas";
        $respuesta = ModeloUsuarios::mdlMostrarFichasSede($tabla, $item, $valor);
        return $respuesta;
    }


    static public function ctrEditarUsuario(){
        if (isset($_POST["editarNombre"]) &&
            isset($_POST["editarApellido"]) &&
            isset($_POST["editarTipoDocumento"]) &&
            isset($_POST["editarNumeroDocumento"]) ){
            if (preg_match('/^[a-zA-ZñÑáéíóÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&
                preg_match('/^[a-zA-ZñÑáéíóÁÉÍÓÚ ]+$/', $_POST["editarApellido"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarNumeroDocumento"]) ) {
                // si el usuario es aprendiz se debe validar la sede y la ficha
                if ($_POST["selectRol"] != 6) {
                    $sede = "";
                    $ficha = "";
                }else{
                    $sede = $_POST["id_sede"];
                    $ficha = $_POST["id_ficha"];
                }

                $tabla = "usuarios";
                $datos = array(
                    "id_usuario" => $_POST["idUsuario"],
                    "nombre" => $_POST["editarNombre"],
                    "apellido" => $_POST["editarApellido"],
                    "tipo_documento" => $_POST["editarTipoDocumento"],
                    "documento" => $_POST["editarNumeroDocumento"],
                    "email" => $_POST["editarEmail"],
                    "telefono" => $_POST["editarTelefono"],
                    "direccion" => $_POST["editarDireccion"],
                    "genero" => $_POST["editarGenero"],
                    "rol" => $_POST["selectRol"],
                    // si es aprendiz
                    "sede" => $sede,
                    "ficha" => $ficha
                );

                $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                        swal.fire({
                            icon: "success",
                            title: "¡El usuario ha sido actualizado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "usuarios";
                            }
                        });
                    </script>';
                } else {
                    echo '<script>
                        swal.fire({
                            icon: "error",
                            title: "¡Error al actualizar el usuario!",
                            showConfirmButton:
}