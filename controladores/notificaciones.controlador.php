<?php

class ControladorNotificaciones {

    /*=============================================
    LISTAR NOTIFICACIONES NO LEÍDAS DE UN USUARIO
    =============================================*/
    static public function listarNoLeidas($usuario_id) {
        $tabla = "notificaciones";
        return ModeloNotificaciones::mdlMostrarNoLeidas($tabla, $usuario_id);
    }

    /*=============================================
    MARCAR NOTIFICACIÓN COMO LEÍDA
    =============================================*/
    static public function marcarComoLeida($id_notificacion) {
        $tabla = "notificaciones";
        return ModeloNotificaciones::mdlMarcarNotificacionLeida($tabla, $id_notificacion);
    }

    /*=============================================
    CREAR NOTIFICACIÓN
    =============================================*/
    static public function crearNotificacion($usuarioId, $idTipoEvento, $mensaje, $url = null) {
        $tabla = "notificaciones";
        $datos = array(
            "id_usuario"    => $usuarioId,
            "id_tipo_evento"=> $idTipoEvento,
            "mensaje"       => $mensaje,
            "url"           => $url
        );
        return ModeloNotificaciones::mdlIngresarNotificacion($tabla, $datos);
    }

    /*=============================================
    EDITAR NOTIFICACIÓN
    =============================================*/
    static public function editarNotificacion($idNotificacion, $usuarioId, $idTipoEvento, $mensaje, $url = null) {
        $tabla = "notificaciones";
        $datos = array(
            "id_notificaciones" => $idNotificacion,
            "id_usuario"    => $usuarioId,
            "id_tipo_evento"=> $idTipoEvento,
            "mensaje"       => $mensaje,
            "url"           => $url
        );
        return ModeloNotificaciones::mdlEditarNotificacion($tabla, $datos);
    }

    /*=============================================
    BORRAR NOTIFICACION
    =============================================*/
    static public function borrarNotificacion($id_notificacion){

        $tabla = "notificaciones";

        return ModeloNotificaciones::mdlBorrarNotificacion($tabla, $id_notificacion);
    }

    /*=============================================
    OBTENER DETALLES DE NOTIFICACION
    =============================================*/
    static public function obtenerDetallesNotificacion($id_notificacion){

        $tabla = "notificaciones";

        return ModeloNotificaciones::mdlObtenerDetallesNotificacion($tabla, $id_notificacion);
    }

    /*=============================================
    NOTIFICAR CAMBIO DE ESTADO DE USUARIO
    =============================================*/
    static public function notificarCambioEstadoUsuario($usuarioId, $estadoAnterior, $estadoNuevo) {
        if ($estadoAnterior !== $estadoNuevo) {
            $mensaje = "El estado de tu cuenta ha cambiado de <b>$estadoAnterior</b> a <b>$estadoNuevo</b>.";
            $idTipoEvento = 3; // Por ejemplo: 3 = Cambio de estado de usuario
            ControladorNotificaciones::crearNotificacion($usuarioId, $idTipoEvento, $mensaje);
        }
    }
}
?>