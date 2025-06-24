<?php

require_once "../controladores/notificaciones.controlador.php";
require_once "../modelos/notificaciones.modelo.php";

class NotificacionesAjax
{
    public static function handleRequest()
    {
        if (isset($_POST['accion']) && $_POST['accion'] === 'contadores') {
            self::actualizarContadores();
        } elseif (isset($_POST['accion']) && $_POST['accion'] === 'marcar_todas_leidas') {
            self::marcarTodasLeidas();
        } elseif (isset($_POST['id'])) {
            self::eliminarNotificacion();
        } elseif (isset($_POST['ids']) && is_array($_POST['ids'])) {
            self::eliminarMultiplesNotificaciones();
        }
    }

    private static function actualizarContadores()
    {
        session_start();
        $usuarioId = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : null;
        $todasNotificaciones = ControladorNotificaciones::listarTodas($usuarioId);
        $totalNotificaciones = !empty($todasNotificaciones) ? count($todasNotificaciones) : 0;
        echo json_encode([
            'success' => true,
            'totalNotificaciones' => $totalNotificaciones
        ]);
        exit;
    }

    private static function marcarTodasLeidas()
    {
        session_start();
        $usuarioId = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : null;
        $ok = ControladorNotificaciones::marcarTodasComoLeidas($usuarioId);
        echo json_encode(['success' => $ok]);
        exit;
    }

    private static function eliminarNotificacion()
    {
        $id = intval($_POST['id']);
        $respuesta = ControladorNotificaciones::eliminarNotificacion($id);

        if ($respuesta === "ok") {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se pudo eliminar']);
        }
        exit;
    }

    private static function eliminarMultiplesNotificaciones()
    {
        $todoOk = true;
        foreach ($_POST['ids'] as $id) {
            $resp = ControladorNotificaciones::eliminarNotificacion(intval($id));
            if ($resp !== "ok") {
                $todoOk = false;
                break;
            }
        }
        if ($todoOk) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se pudieron eliminar todas las notificaciones']);
        }
        exit;
    }
}

NotificacionesAjax::handleRequest();
?>