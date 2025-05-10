<!-- Contenido Principal -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Consultar Préstamos</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Buscar Usuario</h3>
                        </div>
                        <div class="card-body">
                            <div class="input-group">
                                <input type="text" id="cedula" class="form-control"
                                    placeholder="Ingrese número de cédula">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" id="btn-buscar">
                                        <i class="fas fa-search"></i> Buscar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User Information Card -->
                    <div class="card card-info" id="userinfo" style="display: none;">
                        <div class="card-header">
                            <h3 class="card-title">Información del Usuario</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <dl class="row">
                                        <dt class="col-sm-4">Nombres:</dt>
                                        <dd class="col-sm-8" id="user-names">-</dd>

                                        <dt class="col-sm-4">Apellidos:</dt>
                                        <dd class="col-sm-8" id="user-lastnames">-</dd>
                                    </dl>
                                </div>
                                <div class="col-md-12">
                                    <dl class="row">
                                        <dt class="col-sm-4">Dirección:</dt>
                                        <dd class="col-sm-8" id="user-address">-</dd>

                                        <dt class="col-sm-4">Teléfono:</dt>
                                        <dd class="col-sm-8" id="user-phone">-</dd>
                                    </dl>
                                </div>
                                <div class="col-md-12">
                                    <dl class="row">
                                        <dt class="col-sm-4">Correo:</dt>
                                        <dd class="col-sm-8" id="user-address">-</dd>

                                        <dt class="col-sm-4">Rol:</dt>
                                        <dd class="col-sm-8" id="user-phone">-</dd>
                                    </dl>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabla de Préstamos -->
                <div class="card card-success col-md-8" id="resultados" style="display: none;">
                    <div class="card-header">
                        <h3 class="card-title">Préstamos del Usuario</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th># Préstamo</th>
                                    <th>Fecha Solicitud</th>
                                    <th>Fecha Devolución</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Ejemplo de datos ficticios -->
                                <tr>
                                    <td>#1234</td>
                                    <td>2023-08-15</td>
                                    <td>2023-09-15</td>
                                    <td><span class="badge bg-success">Activo</span></td>
                                    <td>
                                        <button class="btn btn-info btn-detalle"
                                            data-toggle="modal"
                                            data-target="#modal-detalle">
                                            <i class="fas fa-eye"></i> Ver Detalle
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#9876</td>
                                    <td>2023-07-01</td>
                                    <td>2023-07-15</td>
                                    <td><span class="badge bg-secondary">Finalizado</span></td>
                                    <td>
                                        <button class="btn btn-info btn-detalle"
                                            data-toggle="modal"
                                            data-target="#modal-detalle">
                                            <i class="fas fa-eye"></i> Ver Detalle
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </section>
</div>

<!-- Modal Detalle Préstamo -->
<div class="modal fade" id="modal-detalle">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detalle del Préstamo #1234</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <dl class="row">
                            <dt class="col-sm-4">Solicitante:</dt>
                            <dd class="col-sm-8">Juan Pérez</dd>

                            <dt class="col-sm-4">Fecha Préstamo:</dt>
                            <dd class="col-sm-8">2023-08-15</dd>

                            <dt class="col-sm-4">Fecha Devolución:</dt>
                            <dd class="col-sm-8">2023-09-15</dd>

                            <dt class="col-sm-4">Motivo:</dt>
                            <dd class="col-sm-8">Préstamo para laboratorio de electrónica</dd>
                        </dl>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Equipos Solicitados</h5>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Equipo</th>
                                            <th>Modelo</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Osciloscopio Digital</td>
                                            <td>RIGOL DS1202Z-E</td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td>Fuente de Alimentación</td>
                                            <td>GW INSTEK GPS-3303</td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <td>Multímetro</td>
                                            <td>FLUKE 117</td>
                                            <td>5</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>




<script>
    $(document).ready(function() {
        // Simular búsqueda
        $('#btn-buscar').click(function() {
            $('#resultados').fadeIn();
            $('#userinfo').fadeIn();
        });

        // Simular carga de datos en el modal
        $('.btn-detalle').click(function() {
            // Aquí iría una llamada AJAX para cargar datos reales
            console.log("Cargar detalles del préstamo...");
        });
    });
</script>