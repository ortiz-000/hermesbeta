<?php

require_once "../controladores/permisos.controlador.php";
require_once "../modelos/permisos.modelo.php";

class AjaxPermisos
{
    
    public function ajaxTraerPermisos()
    {
        $respuesta = ControladorPermisos::ctrTraerPermisos();

        echo json_encode($respuesta);
    }

}


$permisos = new AjaxPermisos();
$permisos->ajaxTraerPermisos();
