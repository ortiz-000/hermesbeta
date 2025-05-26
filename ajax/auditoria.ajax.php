<?php
require_once "../modelos/Conexion.php";

header('Content-Type: application/json');

$conexion = Conexion::conectar(); // <-- ahora sí obtenemos el objeto PDO

$query = "SELECT 
    a.id_auditoria,
    a.id_usuario_afectado,
    u.tipo_documento,
    u.numero_documento,
    u.nombre,
    u.apellido,
    u.correo_electronico,
    u.nombre_usuario,
    u.clave,
    u.telefono,
    u.direccion,
    u.genero,
    u.foto,
    u.estado,
    u.condicion,
    u.fecha_registro,
    a.id_usuario_editor,
    editor.nombre AS nombre_editor,
    a.campo_modificado,
    a.valor_anterior,
    a.valor_nuevo,
    a.fecha_cambio
FROM auditoria_usuarios a
JOIN usuarios u ON a.id_usuario_afectado = u.id_usuario
JOIN usuarios editor ON a.id_usuario_editor = editor.id_usuario
ORDER BY a.fecha_cambio DESC";

$stmt = $conexion->prepare($query);
$stmt->execute();

$data = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $data[] = [
        "id_usuario" => $row['id_usuario_afectado'],
        "tipo_documento" => $row['tipo_documento'],
        "numero_documento" => $row['numero_documento'],
        "nombre" => $row['nombre'],
        "apellido" => $row['apellido'],
        "correo_electronico" => $row['correo_electronico'],
        "nombre_usuario" => $row['nombre_usuario'],
        "clave" => $row['clave'],
        "telefono" => $row['telefono'],
        "direccion" => $row['direccion'],
        "genero" => $row['genero'],
        "foto" => $row['foto'],
        "estado" => $row['estado'],
        "condicion" => $row['condicion'],
        "fecha_registro" => $row['fecha_registro'],
        "id_usuario_editor" => $row['id_usuario_editor'],
        "nombre_editor" => $row['nombre_editor'],
        "campo_modificado" => $row['campo_modificado'],
        "valor_anterior" => $row['valor_anterior'],
        "valor_nuevo" => $row['valor_nuevo'],
        "fecha_cambio" => $row['fecha_cambio'],
    ];
}
if (!$stmt) {
    echo json_encode(["data" => [], "error" => $conexion->errorInfo()]);
    exit;
}

echo json_encode(["data" => $data]);
