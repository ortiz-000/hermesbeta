<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Salidas</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="tblSedes" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Préstamo</th>
                                        <th>Usuario</th>
                                        <th>Tipo de Préstamo</th>
                                        <th>Estado De Préstamo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $item = null;
                                    $valor = null;
                                    $salidas = Controladorsalidas::ctrMostrarsalidas($item, $valor);


                                    foreach ($salidas as $key => $value)   {
                                        echo '
                                        <tr> 
                                        
                                            <td>'.$value["id_prestamo"].'</td>
                                            <td>'.$value["nombre"].'</td>
                                            <td>'.$value["tipo_prestamo"].'</td>
                                            <td>'.$value["estado_prestamo"].'</td>

                                            <td>
                                                <div class="btn-group">';
                                                echo '<button class="btn btn-info btn-sm btnVerDetalles" data-id="'.$value["id_prestamo"].'" data-toggle = "modal"></button>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

    <!-- Modal de Detalles del Préstamo -->
    <div class="modal fade" id="modalDetallesPrestamo" tabindex="-1" role="dialog" aria-labelledby="modalDetallesPrestamoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetallesPrestamoLabel">Detalles del Préstamo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>ID Préstamo:</strong> <span id="modalIdPrestamo"></span></p>
                            <p><strong>Usuario:</strong> <span id="modalUsuario"></span></p>
                            <p><strong>Tipo:</strong> <span id="modalTipo"></span></p>
                            <p><strong>Fecha Inicio:</strong> <span id="modalFechaInicio"></span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Fecha Fin:</strong> <span id="modalFechaFin"></span></p>
                            <p><strong>Estado:</strong> <span id="modalEstado"></span></p>
                            <p><strong>Motivo:</strong> <span id="modalMotivo"></span></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

