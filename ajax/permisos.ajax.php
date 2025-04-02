<?php

    require_once "../controladores/permisos.controlador.php";
    require_once "../modelos/permisos.modelo.php";

    class AjaxPermisos
    {
        public $idRol;
        public $permisos;
        
        public function ajaxPermisosRol()
        {
            $item = "id_rol";
            $valor = $this->idRol;

            $respuesta = ControladorPermisos::ctrMostrarPermisos($item, $valor);

            echo json_encode($respuesta);
        }

        public function ajaxGuardarPermisosRol()
        {
            $tabla = "rol_permiso";
            $datos = array(
                "id_rol" => $this->idRol,
                "permisos" => $this->permisos
            );

            $respuesta = ControladorPermisos::ctrActualizarPermisos($tabla, $datos);

            echo json_encode($respuesta);
        }

    }

    if (isset($_POST["idRol"])) {
        $permisos = new AjaxPermisos();
        $permisos->idRol = $_POST["idRol"];
        $permisos->ajaxPermisosRol();
    }

    if (isset($_POST["id_Rol"]) && isset($_POST["permisos"])) {
        $guardarPermisos = new AjaxPermisos();
        $guardarPermisos->idRol = $_POST["id_Rol"];
        $guardarPermisos->permisos = $_POST["permisos"];
        $guardarPermisos->ajaxGuardarPermisosRol();

    }