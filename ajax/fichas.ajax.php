<?php
require_once "../controladores/fichas.controlador.php";
require_once "../modelos/fichas.modelo.php";

class AjaxFichas
{
    /*=============================================
    EDITAR FICHA
    =============================================*/
    public $idFicha;
    public $estadoFicha;

    public function ajaxEditarFicha()
    {
        $item = "id_ficha";
        $valor = $this->idFicha;

        $respuesta = ControladorFichas::ctrMostrarFichas($item, $valor);

        echo json_encode($respuesta);
    }

    public function ajaxActivarFicha()
    {
        $tabla = "fichas";
        $item1 = "id_ficha";
        $valor1 = $this->idFicha;
        $item2 = "estado";
        $valor2 = $this->estadoFicha;

        $respuesta = ModeloFichas::mdlActualizarFicha($tabla,$item1, $valor1, $item2, $valor2);

        echo json_encode($respuesta);
    }
}

if (isset($_POST["idFicha"])) {
    $editar = new AjaxFichas();
    $editar->idFicha = $_POST["idFicha"];
    $editar->ajaxEditarFicha();
}

if (isset($_POST["idFichaActivar"]) && isset($_POST["estadoFicha"])) {
    $activar = new AjaxFichas();
    $activar->idFicha = $_POST["idFichaActivar"];
    $activar->estadoFicha = $_POST["estadoFicha"];
    $activar->ajaxActivarFicha();

    
}