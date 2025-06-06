<?php

require_once "conexion.php";

class ModeloAutorizaciones
{

    // modelo para mostrar autorizaciones
    static public function mdlMostrarAutorizaciones($tabla, $item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT p.id_prestamo,
            MAX(CASE WHEN a.id_rol = (SELECT id_rol FROM roles WHERE nombre_rol = 'Coordinacion') THEN 'Firmado' ELSE 'Pendiente' END) AS firma_coordinacion,
            MAX(CASE WHEN a.id_rol = (SELECT id_rol FROM roles WHERE nombre_rol = 'Coordinacion') THEN a.id_usuario ELSE NULL END) AS id_usuario_coordinacion,
            MAX(CASE WHEN a.id_rol = (SELECT id_rol FROM roles WHERE nombre_rol = 'Coordinacion') THEN CONCAT(u_coord.nombre, ' ', u_coord.apellido) ELSE NULL END) AS nombre_usuario_coordinacion,
            MAX(CASE WHEN a.id_rol = (SELECT id_rol FROM roles WHERE nombre_rol = 'Lider TIC') THEN 'Firmado' ELSE 'Pendiente' END) AS firma_lider_tic,
            MAX(CASE WHEN a.id_rol = (SELECT id_rol FROM roles WHERE nombre_rol = 'Lider TIC') THEN a.id_usuario ELSE NULL END) AS id_usuario_lider_tic,
            MAX(CASE WHEN a.id_rol = (SELECT id_rol FROM roles WHERE nombre_rol = 'Lider TIC') THEN CONCAT(u_tic.nombre, ' ', u_tic.apellido) ELSE NULL END) AS nombre_usuario_lider_tic,
            MAX(CASE WHEN a.id_rol = (SELECT id_rol FROM roles WHERE nombre_rol = 'Almacen Maximo') THEN 'Firmado' ELSE 'Pendiente' END) AS firma_almacen,
            MAX(CASE WHEN a.id_rol = (SELECT id_rol FROM roles WHERE nombre_rol = 'Almacen Maximo') THEN a.id_usuario ELSE NULL END) AS id_usuario_almacen,
            MAX(CASE WHEN a.id_rol = (SELECT id_rol FROM roles WHERE nombre_rol = 'Almacen Maximo') THEN CONCAT(u_alm.nombre, ' ', u_alm.apellido) ELSE NULL END) AS nombre_usuario_almacen,
            MAX(CASE WHEN a.motivo_rechazo IS NOT NULL THEN a.motivo_rechazo ELSE NULL END) AS motivo_rechazo,
            MAX(CASE WHEN a.motivo_rechazo IS NOT NULL THEN a.id_rol ELSE NULL END) AS rol_que_rechazo,
            MAX(CASE WHEN a.motivo_rechazo IS NOT NULL THEN CONCAT(u_rech.nombre, ' ', u_rech.apellido) ELSE NULL END) AS usuario_que_rechazo
            FROM prestamos p
            LEFT JOIN autorizaciones a ON p.id_prestamo = a.id_prestamo
            LEFT JOIN usuarios u_coord ON a.id_rol = (SELECT id_rol FROM roles WHERE nombre_rol = 'Coordinacion') AND a.id_usuario = u_coord.id_usuario
            LEFT JOIN usuarios u_tic ON a.id_rol = (SELECT id_rol FROM roles WHERE nombre_rol = 'Lider TIC') AND a.id_usuario = u_tic.id_usuario
            LEFT JOIN usuarios u_alm ON a.id_rol = (SELECT id_rol FROM roles WHERE nombre_rol = 'Almacen Maximo') AND a.id_usuario = u_alm.id_usuario
            LEFT JOIN usuarios u_rech ON a.motivo_rechazo IS NOT NULL AND a.id_usuario = u_rech.id_usuario
            WHERE p.id_prestamo = :id_prestamo
            GROUP BY p.id_prestamo;");



            $stmt->bindParam(":id_prestamo", $valor, PDO::PARAM_INT);

            $stmt->execute();
            return $stmt->fetch();

            $stmt->close();
            $stmt = null;
        }
    }

    static public function mdlAutorizarPrestamo($id_prestamo, $id_rol, $id_usuario)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO autorizaciones (id_prestamo, id_rol, id_usuario) VALUES (:id_prestamo, :id_rol, :id_usuario)");

        $stmt->bindParam(":id_prestamo", $id_prestamo, PDO::PARAM_INT);
        $stmt->bindParam(":id_rol", $id_rol, PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    static public function mdlDesautorizarPrestamo($id_prestamo, $id_rol, $id_usuario)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM autorizaciones WHERE id_prestamo = :id_prestamo AND id_rol = :id_rol AND id_usuario = :id_usuario");

        $stmt->bindParam(":id_prestamo", $id_prestamo, PDO::PARAM_INT);
        $stmt->bindParam(":id_rol", $id_rol, PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }


    static public function mdlRechazarPrestamo($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_prestamo, id_rol, id_usuario, motivo_rechazo) VALUES (:id_prestamo, :id_rol, :id_usuario, :motivo_rechazo)");

        //mostramos error log de la consulta para debuggear

        $stmt->bindParam(":id_prestamo", $datos["id_prestamo"], PDO::PARAM_INT);
        $stmt->bindParam(":id_rol", $datos["id_rol"], PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":motivo_rechazo", $datos["motivo_rechazo"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            error_log(print_r($stmt->errorInfo(), true));
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }
}
