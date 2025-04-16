<?php

require_once "../controladores/modulos.controlador.php";
require_once "../modelos/modulos.modelo.php";

class AjaxModulos
{
    /*=============================================
    EDITAR MÓDULO
    =============================================*/
    public $idModulo;
    public $estadoModulo;

    public function ajaxCambiarEstadoModulo()
    {
        $valorId = $this->idModulo;
        $valorEstado = $this->estadoModulo;

        $respuesta = ModeloModulos::mdlCambiarEstadoModulo($valorId, $valorEstado);

        echo json_encode($respuesta);
    }
}

/*=============================================
CAMBIAR ESTADO DEL MÓDULO
=============================================*/
if (isset($_POST["idModuloActivar"]) && isset($_POST["estadoModulo"])) {
    $activarModulo = new AjaxModulos();
    $activarModulo->idModulo = $_POST["idModuloActivar"];
    $activarModulo->estadoModulo = $_POST["estadoModulo"];
    $activarModulo->ajaxCambiarEstadoModulo();
}