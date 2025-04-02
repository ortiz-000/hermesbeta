<?php

class ControladorPermisos
{
    /*=============================================
    MOSTRAR PERMISOS
    =============================================*/

    static public function ctrMostrarPermisos($item, $valor)
    {
        $respuesta = ModeloPermisos::mdlMostrarPermisos($item, $valor);

        foreach ($respuesta as $key => $row) {
            if (!isset($resultado[$row["id_rol"]])) {
                $resultado[$row["id_rol"]] = array(
                    "id_rol" => $row["id_rol"],
                    "nombre_rol" => $row["nombre_rol"],
                    "descripcion_rol" => $row["descripcion_rol"],
                    "permisos" => array()
                );
            }
            $resultado[$row["id_rol"]]["permisos"][] = $row["id_permiso"];
        }

        return $resultado;
    }

    static public function ctrTraerPermisos()
    {
        $tabla = "permisos";
        $respuesta = ModeloPermisos::mdlTraerPermisos($tabla);

        return $respuesta;
    }

    /*=============================================
    ACTUALIZAR PERMISOS
    =============================================*/
    static public function ctrActualizarPermisos($tabla, $datos)
    {
        // Primero eliminamos los permisos existentes para el rol
        $eliminar = ModeloPermisos::mdlEliminarPermisos($tabla, $datos["id_rol"]);

        if ($eliminar == "ok") {
            // Luego insertamos los nuevos permisos
            foreach (json_decode($datos["permisos"], true) as $idPermiso) {
                $respuesta = ModeloPermisos::mdlAgregarPermiso($tabla, $datos["id_rol"], $idPermiso);

                if ($respuesta != "ok") {
                    return "error";
                }
            }
            return "ok";
        } else {
            return "error";
        }
    }
}