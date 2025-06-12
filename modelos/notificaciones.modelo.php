<?php

require_once "conexion.php";

class ModeloNotificaciones {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    /*=============================================
    MOSTRAR NOTIFICACIONES NO LEIDAS DE UN USUARIO
    =============================================*/
    static public function mdlMostrarNoLeidas($tabla, $usuario_id) {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("SELECT n.*, t.nombre AS tipo_evento_nombre, t.descripcion AS tipo_evento_descripcion, t.tipo_notificacion, t.prioridad FROM $tabla n INNER JOIN tipos_evento_notificacion t ON n.id_tipo_evento = t.id_tipo_evento WHERE id_usuario = :id_usuario AND leida = 0 ORDER BY fecha_creacion DESC");
        $stmt->bindParam(":id_usuario", $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*=============================================
    MARCAR NOTIFICACION COMO LEIDA
    =============================================*/
    static public function mdlMarcarNotificacionLeida($tabla, $id_notificacion) {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("UPDATE $tabla SET leida = 1, fecha_leida = NOW() WHERE id_notificaciones = :id_notificaciones");
        $stmt->bindParam(":id_notificaciones", $id_notificacion, PDO::PARAM_INT);
        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }
    }

    /*=============================================
    INGRESAR NOTIFICACION
    =============================================*/
    static public function mdlIngresarNotificacion($tabla, $datos) {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO $tabla(id_usuario, id_tipo_evento, mensaje, url) VALUES (:id_usuario, :id_tipo_evento, :mensaje, :url)");
        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":id_tipo_evento", $datos["id_tipo_evento"], PDO::PARAM_INT);
        $stmt->bindParam(":mensaje", $datos["mensaje"], PDO::PARAM_STR);
        $stmt->bindParam(":url", $datos["url"], PDO::PARAM_STR);
        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }
    }

    /*=============================================
    OBTENER DETALLES DE UNA NOTIFICACION
    =============================================*/
    static public function mdlObtenerDetallesNotificacion($tabla, $id_notificacion) {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("SELECT n.*, t.nombre AS tipo_evento_nombre, t.descripcion AS tipo_evento_descripcion, t.tipo_notificacion, t.prioridad FROM $tabla n INNER JOIN tipos_evento_notificacion t ON n.id_tipo_evento = t.id_tipo_evento WHERE id_notificaciones = :id_notificaciones");
        $stmt->bindParam(":id_notificaciones", $id_notificacion, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /*=============================================
    BORRAR NOTIFICACION
    =============================================*/
    static public function mdlBorrarNotificacion($tabla, $id_notificacion){

        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("DELETE FROM $tabla WHERE id_notificaciones = :id_notificaciones");

        $stmt -> bindParam(":id_notificaciones", $id_notificacion, PDO::PARAM_INT);

        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt -> close();

        $stmt = null;

    }
}
?>