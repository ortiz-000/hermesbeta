<?php
require_once "../controladores/modal.salidas.controlador.php";
require_once "../modelos/modal.salidas.modelo.php";

// Verificar que la solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

// Verificar que el id_prestamo existe y es válido
if (!isset($_POST["id_prestamo"]) || !is_numeric($_POST["id_prestamo"]) || $_POST["id_prestamo"] <= 0) {
    echo json_encode(['error' => 'ID de préstamo inválido']);
    exit;
}

try {
    $respuesta = ControladorSalidas::ctrMostrarDetallesPrestamo($_POST["id_prestamo"]);
    
    if ($respuesta === false) {
        echo json_encode(['error' => 'No se encontraron detalles del préstamo']);
        exit;
    }
    
    echo json_encode($respuesta);
} catch (Exception $e) {
    echo json_encode(['error' => 'Error al procesar la solicitud']);
    // Registrar el error para debugging
    error_log("Error en modal.salidas.ajax.php: " . $e->getMessage());
}
