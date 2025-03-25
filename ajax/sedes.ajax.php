<?php

require_once "../controladores/sedes.controlador.php";
require_once "../modelos/sedes.modelo.php";

class AjaxSedes
{
    /*=============================================
    EDITAR SEDE
    =============================================*/
    public $idSede;

    public $idEstadoSede;
    public $estadoSede;

    public function ajaxEditarSede()
    {
        $item = "id_sede";
        $valor = $this->idSede;

        $respuesta = ControladorSedes::ctrMostrarSedes($item, $valor);

        echo json_encode($respuesta);
    }

    public function ajaxActivarSede()
    {
        $tabla = "sedes";
        $item1 = "id_sede";
        $valor1 = $this->idEstadoSede;
        $item2 = "estado";
        $valor2 = $this->estadoSede;

        $respuesta = ModeloSedes::mdlActualizarSede($tabla, $item1, $valor1, $item2, $valor2);

        echo json_encode($respuesta);
    }
}

if (isset($_POST["idSede"])) {
    $editar = new AjaxSedes();
    $editar->idSede = $_POST["idSede"];
    $editar->ajaxEditarSede();
}

if (isset($_POST["idEstadoSede"])) {
    $activarSede = new AjaxSedes();
    $activarSede->idEstadoSede = $_POST["idEstadoSede"];
    $activarSede->estadoSede = $_POST["estadoSede"];
    $activarSede->ajaxActivarSede();
}