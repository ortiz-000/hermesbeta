<div class="wrapper">
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Autorizaciones</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="card">
        <div class="card-body">
          <table id="tblAutorizaciones" class="table table-bordered table-striped">
            <thead class="bg-dark">
              <tr>
                <th>Préstamo</th>
                <th>Solicitante</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Estado Préstamo</th>
                <th>Fecha Solicitud</th>
                <th>Coo</th>
                <th>Tic</th>
                <th>Alm</th>
                <th>Detalle</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $item = null;
              $valor = null;
              $prestamos = ControladorSolicitudes::ctrMostrarPrestamo($item, $valor);
              // var_dump($prestamos[0]);
              foreach ($prestamos as $key => $value) {
                if ($value["tipo_prestamo"] == "Reservado") {
                  $item = "id_prestamo";
                  $valor = $value["id_prestamo"];
                  $autorizaciones = ControladorAutorizaciones::ctrMostrarAutorizaciones($item, $valor);
                  // var_dump($autorizaciones);
                  echo '<tr>
                          <td>' . $value["id_prestamo"] . '</td>
                          <td>' . $value["solicitante"] . '</td>
                          <td>' . date('Y-m-d H:i', strtotime($value["fecha_inicio"])) . '</td>
                          <td>' . date('Y-m-d H:i', strtotime($value["fecha_fin"])) . '</td>';
                  if ($value["estado_prestamo"] == "Rechazado") {
                    echo '<td class="bg-danger">' . $value["estado_prestamo"] . '</td>';
                  } else {
                    echo '<td>' . $value["estado_prestamo"] . '</td>';
                  };
                  echo   '<td>' . date('Y-m-d H:i', strtotime($value["fecha_solicitud"])) . '</td>
                          <td>
                            <div class="icheck-primary d-inline mx-1">';
                  if ($autorizaciones["firma_coordinacion"] == "Firmado") {
                    echo '<input type="checkbox" checked disabled>';
                  } else {
                    echo '<input type="checkbox" disabled>';
                  }
                  echo '</div>
                          </td>
                          <td>
                            <div class="icheck-primary d-inline mx-1">';
                  if ($autorizaciones["firma_lider_tic"] == "Firmado") {
                    echo '<input type="checkbox" checked disabled>';
                  } else {
                    echo '<input type="checkbox" disabled>';
                  }
                  echo '</div>
                          </td>
                          <td>
                            <div class="icheck-primary d-inline mx-1">';
                  if ($autorizaciones["firma_almacen"] == "Firmado") {
                    echo '<input type="checkbox" checked disabled>';
                  } else {
                    echo '<input type="checkbox" disabled>';
                  }
                  echo '</div>
                          </td>
                          <td>
                            <button class="btn btn-info btn-sm btnVerDetallePrestamo_Autorizar" idPrestamo="' . $value["id_prestamo"] . '" title="Detalles del Prestamo" data-toggle="modal" data-target="#modalVerDetallesPrestamo">
                              <i class="fas fa-eye"></i>
                            </button>
                          </td>
                        </tr>';
                } //fin REservado

              }
              ?>
            </tbody>
          </table>
        </div>
      </div>


    </section>
  </div>
</div>


<!-- Modal de Detalles del Préstamo -->

<div class="modal fade" id="modalVerDetallesPrestamo" tabindex="-1" role="dialog" aria-labelledby="modalVerDetallesPrestamoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Detalle del Préstamo #<span id="numeroPrestamo"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Usuario -->
                    <div class="col-md-4 text-center">
                        <img src="vistas/img/usuarios/default/anonymous.png" class="rounded-circle mb-2" alt="Avatar" width="100" height="100">
                        <h5 class="mb-0" id="detalleUsuarioNombre">Nombre Usuario</h5>
                        <small class="text-muted" id="detalleUsuarioRol">Rol</small>
                    </div>

                    <!-- Detalles del préstamo -->
                    <div class="col-md-8">
                        <div class="card card-outline card-info">
                            <div class="card-header py-2">
                                <h6 class="card-title m-0">Información del Préstamo</h6>
                            </div>
                            <div class="card-body p-2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><strong>Estado:</strong> <span id="detalleTipoPrestamo">----</span></p>
                                        <p><strong>Fecha Préstamo::</strong> <span id="detalleFechaInicio">----</span></p>
                                        <p><strong>Fecha Devolución:</strong> <span id="detalleFechaFin">----</span></p>
                                        <p><strong>Motivo:</strong> <span id="detalleMotivoPrestamo">----</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Equipos Solicitados</h5>
                            </div>
                            <div class="card-body p-10">
                                <table class="table table-bordered table-striped" id="tblDetallePrestamo">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Categoría</th>
                                            <th>Equipo</th>
                                            <th>etiqueta</th>
                                            <th>Serial</th>
                                            <th>Ubicación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <div class="alert alert-danger d-none mt-3" id="alertaRechazado" role="alert">
                                    El préstamo fue rechazado por otro usuario - <span id="usuarioNombreRechaza"></span>                                    
                                </div>
                                <button type="button" class="btn btn-default float-right" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="idRolSesion" value="<?= $_SESSION['rol'] ?>">
                <input type="hidden" id="nombre_rolSesion" value="<?= $_SESSION['nombre_rol'] ?>">
                <input type="hidden" id="id_UsuarioSesion" value="<?= $_SESSION['id_usuario'] ?>">
                
               
                <button type="button" class="btn btn-danger btnRechazar btnAccionFirma d-none" data-toggle="modal" data-target="#modalMotivoRechazo">Rechazar</button>
                <button type="button" class="btn btn-primary btnAutorizar btnAccionFirma d-none">Autorizar</button>
                <button type="button" class="btn btn-danger btnDesautorizar d-none">Desautorizar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal del motivo de rechazo -->
<div class="modal fade" id="modalMotivoRechazo" tabindex="-1" role="dialog" aria-labelledby="modalMotivoRechazoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Motivo de Rechazo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <input type="hidden" id="numeroPrestamoRechazar" name="numeroPrestamoRechazar">
                    <input type="hidden" id="idUsuarioRechazar" name="idUsuarioRechazar" value="<?php echo $_SESSION['id_usuario'] ?>">
                    <input type="hidden" id="idRolRechazar" name="idRolRechazar" value="<?php echo $_SESSION['rol'] ?>">
                    <div class="form-group">
                        <label for="motivoRechazo">Motivo de Rechazo:</label>
                        <textarea class="form-control" id="motivoRechazo" rows="4" name="motivoRechazoAutorizacion" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger btnRechazarConfirmar">Rechazar</button>
                </div>
                <?php
                $rechazar = new ControladorAutorizaciones();
                $rechazar->ctrRechazarPrestamo();
                ?>
            </form>
        </div>
    </div>
</div>
