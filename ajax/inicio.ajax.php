<?php

require_once "../controladores/inicio.controlador.php";
require_once "../modelos/inicio.modelo.php";

$tipo = $_GET["tipo"] ?? 'actual';

$datos = ControladorInicio::ctrObtenerPrestamosPorDia($tipo);

header('Content-Type: application/json');
echo json_encode($datos);
