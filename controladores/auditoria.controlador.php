<?php
require_once "../modelos/AuditoriaModelo.php";

class AuditoriaControlador {

    public static function ctrMostrarAuditoria() {
        return AuditoriaModelo::mdlMostrarAuditoria();
    }
}
