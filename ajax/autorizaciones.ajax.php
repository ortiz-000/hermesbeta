<?php

require_once "../controladores/autorizaciones.controlador.php";
require_once "../modelos/autorizaciones.modelo.php";

class AjaxAutorizaciones
{
    /*=============================================
    VARIABLES
    =============================================*/
    public $idAutorizacion;
    public $estado;
    public $motivoRechazo;

    /*=============================================
    MOSTRAR DETALLES DE AUTORIZACIÓN
    =============================================*/
    public function ajaxMostrarAutorizacion()
    {
        $item = "id_autorizacion";
        $valor = $this->idAutorizacion;

        $respuesta = ControladorAutorizaciones::ctrMostrarAutorizaciones($item, $valor);
        echo json_encode($respuesta);
    }

    /*=============================================
    ACTUALIZAR ESTADO DE AUTORIZACIÓN
    =============================================*/
    public function ajaxActualizarAutorizacion()
    {
        $datos = array(
            "id_autorizacion" => $this->idAutorizacion,
            "estado" => $this->estado,
            "motivo_rechazo" => $this->motivoRechazo
        );

        $controlador = new ControladorAutorizaciones();
        $respuesta = $controlador->ctrActualizarAutorizacion($datos);
        echo json_encode($respuesta);
    }
}

/*=============================================
MOSTRAR DETALLES DE AUTORIZACIÓN
=============================================*/
if (isset($_POST["idAutorizacion"]) && !isset($_POST["estado"])) {
    $autorizar = new AjaxAutorizaciones();
    $autorizar->idAutorizacion = $_POST["idAutorizacion"];
    $autorizar->ajaxMostrarAutorizacion();
}

/*=============================================
ACTUALIZAR ESTADO DE AUTORIZACIÓN
=============================================*/
if (isset($_POST["idAutorizacion"]) && isset($_POST["estado"])) {
    $actualizar = new AjaxAutorizaciones();
    $actualizar->idAutorizacion = $_POST["idAutorizacion"];
    $actualizar->estado = $_POST["estado"];
    $actualizar->motivoRechazo = isset($_POST["motivoRechazo"]) ? $_POST["motivoRechazo"] : "";
    $actualizar->ajaxActualizarAutorizacion();
}