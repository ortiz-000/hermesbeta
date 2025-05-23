<?php
    $item = null;
    $valor = null;
    $solicitudesVencidas = ControladorVencidas::ctrMostrarSolicitudesVencidas($item, $valor);
    
    // Agrupar solicitudes por usuario y fecha
    $solicitudesAgrupadas = [];
    if($solicitudesVencidas != "vacio") {
        foreach ($solicitudesVencidas as $solicitud) {
            $key = $solicitud["nombre"] . $solicitud["apellido"] . $solicitud["fecha_inicio"];
            if (!isset($solicitudesAgrupadas[$key])) {
                $solicitudesAgrupadas[$key] = [
                    "usuario" => $solicitud["nombre"] . " " . $solicitud["apellido"],
                    "nombre_rol" => $solicitud["nombre_rol"],
                    "fecha_inicio" => $solicitud["fecha_inicio"],
                    "fecha_fin" => $solicitud["fecha_fin"],
                    "objetos" => []
                ];
            }
            $solicitudesAgrupadas[$key]["objetos"][] = [
                "numero_serie" => $solicitud["numero_serie"],
                "tipo" => $solicitud["tipo"],
                "id_prestamo" => $solicitud["id_prestamo"]
            ];
        }
    }
?>

<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Solicitudes Vencidas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="tblvencidas" class="table table-bordered table-striped">
                                <thead style="background-color: black; color: white;">
                                    <tr>
                                        <th>Usuarios</th>
                                        <th>Fecha solicitud</th>
                                        <th>Número de serie</th>
                                        <th>Tipo</th>
                                        <th>Cantidad de objetos</th>
                                        <th>Fecha de entrega</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // En la sección donde se muestra la tabla
                                    foreach ($solicitudesAgrupadas as $solicitud) {
                                        $cantidadObjetos = count($solicitud["objetos"]);
                                        echo '<tr>';
                                        echo '<td>'.$solicitud["usuario"].'<br>'.$solicitud["nombre_rol"].'</td>';
                                        echo '<td>'.$solicitud["fecha_inicio"].'</td>';
                                        
                                        if ($cantidadObjetos > 1) {
                                            echo '<td>Múltiples</td>';
                                            echo '<td>Varios</td>';
                                            echo '<td>
                                                <button type="button" class="btn btn-info btn-sm btnVerObjetos" 
                                                    data-toggle="modal" 
                                                    data-target="#modalObjetos" 
                                                    data-objetos=\''.json_encode($solicitud["objetos"]).'\'
                                                    data-usuario="'.$solicitud["usuario"].'" 
                                                    data-fecha="'.$solicitud["fecha_inicio"].'">
                                                    <i class="fas fa-eye"></i> Ver '.$cantidadObjetos.' objetos
                                                </button>
                                            </td>';
                                        } else {
                                            echo '<td>#'.$solicitud["objetos"][0]["numero_serie"].'</td>';
                                            echo '<td>'.$solicitud["objetos"][0]["tipo"].'</td>';
                                            echo '<td>1</td>';
                                        }
                                        
                                        echo '<td>'.$solicitud["fecha_fin"].'</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- Modal para agregar solicitud -->
<div class="modal fade" id="modalRegistrarSolicitud">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar Solicitud</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAddSolicitud" method="POST">
                    <!-- Aquí puedes agregar los campos necesarios para la solicitud -->
                    <div class="form-group">
                        <label>Número de serie</label>
                        <input type="text" class="form-control" name="numero_serie" placeholder="Número de serie" required>
                    </div>
                    <div class="form-group">
                        <label>Tipo</label>
                        <input type="text" class="form-control" name="tipo" placeholder="Tipo" required>
                    </div>
                    <div class="form-group">
                        <label>Cantidad de objetos</label>
                        <input type="number" class="form-control" name="cantidad" placeholder="Cantidad" required>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para ver objetos -->
<div class="modal fade" id="modalObjetos">
    <div class="modal-dialog modal-lg">  <!-- Cambiado a modal-lg para más espacio -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detalles de la Solicitud</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Usuario:</strong> <span id="modalUsuario"></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Fecha de solicitud:</strong> <span id="modalFechaSolicitud"></span>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Número de Serie</th>
                                <th>Tipo</th>
                                <th>Fecha de entrega</th>
                            </tr>
                        </thead>
                        <tbody id="tablaObjetos">
                            <!-- Los objetos se cargarán dinámicamente aquí -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>