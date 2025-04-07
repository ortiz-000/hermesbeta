<?php
    require_once "controladores/plantilla.controlador.php";

    //Controladores
    require_once "controladores/usuarios.controlador.php";
    require_once "controladores/sedes.controlador.php";

    //modelos
    require_once "modelos/sedes.modelo.php";
    require_once "modelos/usuarios.modelo.php";
    
    $plantilla = new ControladorPlantilla();
    $plantilla -> ctrPlantilla();
?>