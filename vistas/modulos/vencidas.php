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
                                <thead>
                                    <tr>
                                        <th>N° Solicitud</th>
                                        <th>Usuarios</th>
                                        <th>Fecha solicitud</th>
                                        <th>Número de serie</th>
                                        <th>Tipo</th>
                                        <th>Cantidad de objetos</th>
                                        <th>Fecha de entrega</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#1234567</td>
                                        <td>Alejo Claro<br>Aprendiz</td>
                                        <td>11/5/2025</td>
                                        <td>#8756483</td>
                                        <td>Video Beam</td>
                                        <td>02</td>
                                        <td>11/5/2025</td>
                                    </tr>
                                    <tr>
                                        <td>#1234568</td>
                                        <td>Zelda Millan<br>Instructor</td>
                                        <td>11/5/2025</td>
                                        <td>#8756483</td>
                                        <td>Equipo</td>
                                        <td>02</td>
                                        <td>11/5/2025</td>
                                    </tr>
                                    <tr>
                                        <td>#1234569</td>
                                        <td>Vegeto Osorio<br>Aprendiz</td>
                                        <td>11/5/2025</td>
                                        <td>#8756483</td>
                                        <td>Video Beam</td>
                                        <td>02</td>
                                        <td>11/5/2025</td>
                                    </tr>
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