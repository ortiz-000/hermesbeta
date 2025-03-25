<?php
require_once "../controladores/fichas.controlador.php";
require_once "../modelos/fichas.modelo.php";

class AjaxFichas
{
    /*=============================================
    EDITAR FICHA
    =============================================*/
    public $idFicha;

    public function ajaxEditarFicha()
    {
        $item = "id_ficha";
        $valor = $this->idFicha;

        $respuesta = ControladorFichas::ctrMostrarFichas($item, $valor);

        echo json_encode($respuesta);
    }
}

if (isset($_POST["idFicha"])) {
    $editar = new AjaxFichas();
    $editar->idFicha = $_POST["idFicha"];
    $editar->ajaxEditarFicha();
}