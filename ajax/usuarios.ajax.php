<?php

require_once "../controllers/usuarios.controlador.php";
require_once "../models/usuarios.modelo.php";

class AjaxUsuarios
{

    public $sede;

    public function ajaxFichasSede()
    {
        $item = "sede";
        $valor = $_POST["sede"];
        $respuesta = ControladorUsuarios::ctrMostrarFichasSede($item, $valor);
        echo json_encode($respuesta);
    }

   
}

if (isset($_POST["sede"])) {
    $fichas = new AjaxUsuarios();
    $fichas->sede = $_POST["sede"];
    $fichas->ajaxFichasSede();
}