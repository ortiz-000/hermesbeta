<?php
// Se incluye el archivo de conexión a la base de datos
require_once "../modelos/conexion.php";

// Se define que la respuesta será en formato JSON
header('Content-Type: application/json');

try {
    // Se establece la conexión con la base de datos usando el método estático conectar()
    $conexion = Conexion::conectar();

    // Consulta SQL que obtiene información de la auditoría y datos del usuario afectado y del editor
    $query = "
        SELECT 
            a.id_usuario_afectado,
            u.tipo_documento,
            u.numero_documento,
            u.nombre,
            u.apellido,
            u.correo_electronico,
            u.nombre_usuario,
            u.telefono,
            u.direccion,
            u.genero,
            u.foto,
            u.estado,
            u.condicion,
            u.fecha_registro,
            a.id_usuario_editor,
            editor.nombre_usuario AS editor_nombre,
            a.campo_modificado,
            a.valor_anterior,
            a.valor_nuevo,
            a.fecha_cambio
        FROM auditoria_usuarios a
        LEFT JOIN usuarios u ON a.id_usuario_afectado = u.id_usuario
        LEFT JOIN usuarios editor ON a.id_usuario_editor = editor.id_usuario
        ORDER BY a.fecha_cambio DESC";

    // Se prepara y ejecuta la consulta
    $stmt = $conexion->prepare($query);
    $stmt->execute();

    // Se inicializa un array para almacenar los resultados
    $data = [];

    // Se recorren los resultados fila por fila
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Se formatea el cambio mostrando valor anterior y nuevo con una flecha
        $valor_formateado = $row['valor_anterior'] . " → " . $row['valor_nuevo'];

        // Se construye un array asociativo con los datos de cada fila
        $data[] = [
            "id_usuario" => $row['id_usuario_afectado'],
            "tipo_documento" => $row['tipo_documento'],
            "numero_documento" => $row['numero_documento'],
            "nombre" => $row['nombre'],
            "apellido" => $row['apellido'],
            "correo_electronico" => $row['correo_electronico'],
            "nombre_usuario" => $row['nombre_usuario'],
            "telefono" => $row['telefono'],
            "direccion" => $row['direccion'],
            "genero" => $row['genero'],
            "foto" => $row['foto'],
            "estado" => $row['estado'],
            "condicion" => $row['condicion'],
            "fecha_registro" => $row['fecha_registro'],
            "id_usuario_editor" => $row['id_usuario_editor'],
            // Si hay un editor, se muestra su nombre; si no, se indica "Sistema"
            "nombre_editor" => !empty($row['id_usuario_editor']) ? $row['editor_nombre'] : 'Sistema',
            "campo_modificado" => $row['campo_modificado'],
            "valor_anterior" => $row['valor_anterior'],
            "valor_nuevo" => $row['valor_nuevo'],
            "valor_formateado" => $valor_formateado,
            "fecha_cambio" => $row['fecha_cambio']
        ];
    }

    // Se devuelve el resultado en formato JSON
    echo json_encode(["data" => $data]);

} catch (PDOException $e) {
    // En caso de error en la base de datos, se devuelve un array vacío con el mensaje de error
    echo json_encode([
        "data" => [],
        "error" => $e->getMessage()
    ]);
}
