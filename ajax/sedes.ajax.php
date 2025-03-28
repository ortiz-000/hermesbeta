<?php

require_once "../controladores/sedes.controlador.php";
require_once "../modelos/sedes.modelo.php";

class AjaxSedes
{
    /*=============================================
    EDITAR SEDE
    =============================================*/
    public $idSede;
    public $estadoSede;

    public function ajaxEditarSede()
    {
        $item = "id_sede";
        $valor = $this->idSede;

        $respuesta = ControladorSedes::ctrMostrarSedes($item, $valor);

        echo json_encode($respuesta);
    }

    public function ajaxCambiarEstadoSede()
    {

        $valorId = $this->idSede;
        $valorEstado = $this->estadoSede;
        
        $respuesta = ModeloSedes::mdlCambiarEstadoSede($valorId, $valorEstado);

        echo json_encode($respuesta);
        
    }
}

if (isset($_POST["idSede"])) {
    $editar = new AjaxSedes();
    $editar->idSede = $_POST["idSede"];
    $editar->ajaxEditarSede();
}

if (isset($_POST["idSedeActivar"]) && isset($_POST["estadoSede"])) {
    $activarSede = new AjaxSedes();
    $activarSede->idSede = $_POST["idSedeActivar"];
    $activarSede->estadoSede = $_POST["estadoSede"];
    $activarSede->ajaxCambiarEstadoSede();
}