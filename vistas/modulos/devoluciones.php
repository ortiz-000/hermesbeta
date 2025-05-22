<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Devoluciones</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">inicio</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <table id="tblDevoluciones" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Identificación</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Telefono</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Devolución</th>
                    <th>Tipo de Préstamo</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                  $item = null;
                  $valor = null;
                  $devoluciones = ControladorDevoluciones::ctrMostrarDevoluciones($item, $valor);

                  foreach ($devoluciones as $key => $value) {
                    echo '
                    <tr>
                      <td>' . ($key + 1) . '</td>
                      <td>' . $value["numero_documento"] . '</td>
                      <td>' . $value["nombre"] . '</td>
                      <td>' . $value["apellido"] . '</td>
                      <td>' . $value["telefono"] . '</td>
                      <td>' . $value["fecha_inicio"] . '</td>
                      <td>' . $value["fecha_fin"] . '</td>
                      <td>' . $value["estado_prestamo"] . '</td>
                      <td>
                        <div class="btn-group">';
                    if ($value["estado_prestamo"] == "Inmediato") {
                      echo '<button class="btn btn-info btn-sm btnVerUsuario" data-id="' . $value["id_prestamo"] . '" data-toggle="modal" data-target="#modalVerUsuarioInmediato">
                                    <i class="fas fa-eye"></i> Ver
                                  </button>';
                    } else {
                      echo '<button class="btn btn-info btn-sm btnVerUsuario" data-id-reservado="' . $value["id_prestamo"] . '" data-toggle="modal" data-target="#modalVerUsuarioReservado">
                                    <i class="fas fa-eye"></i> Ver
                                  </button>';
                    }
                    echo '</div>
                      </td>
                    </tr>';
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

<!-- Modal Ver Usuario -->
<div class="modal fade" id="modalVerUsuarioReservado" tabindex="-1" role="dialog" aria-labelledby="modalVerUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="modalVerUsuarioLabel">Detalles de la Devolución</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- Información del Usuario -->
          <div class="col-md-4 text-center">
            <img class="img-circle elevation-2 mb-3" id="userImage" src="vistas/img/usuarios/default/anonymous.png" alt="User Image" style="width: 120px; height: 120px;">
            <h4 id="userName">Nombre del Usuario</h4>
            <p class="text-muted" id="userRol">Rol</p>
          </div>

          <!-- Detalles del Préstamo -->
          <div class="col-md-8">
            <div class="card card-outline card-info">
              <div class="card-header">
                <h3 class="card-title">Información del Préstamo</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <table class="table table-sm">
                      <tbody class="info-prestamo">
                        <tr>
                          <th style="width: 40%">Identificación:</th>
                          <td><span id="prestamoIdentificacion"></span></td>
                        </tr>
                        <tr>
                          <th>Nombre:</th>
                          <td><span id="prestamoNombre"></span></td>
                        </tr>
                        <tr>
                          <th>Apellido:</th>
                          <td><span id="prestamoApellido"></span></td>
                        </tr>
                        <tr>
                          <th>Teléfono:</th>
                          <td><span id="prestamoTelefono"></span></td>
                        </tr>
                        <tr>
                          <th>Ficha:</th>
                          <td><span id="prestamoFicha"></span></td>
                        </tr>
                        <tr>
                          <th>Tipo de Préstamo:</th>
                          <td><span id="prestamoTipo"></span></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class="table table-sm">
                      <tbody class="info-prestamo-2">
                        <tr>
                          <th style="width: 40%">Fecha de Inicio:</th>
                          <td><span id="prestamoFechaInicio"></span></td>
                        </tr>
                        <tr>
                          <th>Fecha de Devolución:</th>
                          <td><span id="prestamoFechaFin"></span></td>
                        </tr>
                        <tr>
                          <th>Estado:</th>
                          <td><span id="prestamoEstado"></span></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <!-- Detalles del Equipo -->
            <div class="card card-outline card-success">
              <div class="card-header">
                <h3 class="card-title">Información del Equipo</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <table class="table table-sm">
                      <tbody class="info-equipos">
                        <tr>
                          <th style="width: 40%">Serial:</th>
                        </tr>
                        <tr>
                          <th>Marca:</th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class="table table-sm">
                      <tbody class="info-equipos-2">
                        <tr>
                          <th style="width: 40%">Modelo:</th>
                        </tr>
                        <tr>
                          <th>Categoría:</th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- Botón de devolución para cada equipo -->
                  <div class="col-12 text-center mt-3">
                    <button type="button" class="btn btn-success btn-devolver" data-equipo-id="">
                      <i class="fas fa-check-circle mr-2"></i>Marcar como Devuelto
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Buen Estado -->
<div class="modal fade" id="modalVerUsuarioInmediato" tabindex="-1" role="dialog" aria-labelledby="modalBuenEstadoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title text-white" id="modalBuenEstadoLabel">Confirmar Devolución</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formBuenEstado" method="POST">
          <input type="hidden" id="buenEstadoEquipoId" name="equipoId">
          <input type="hidden" id="buenEstadoTipoPrestamo" name="tipoPrestamo">

          <div class="text-center mb-4">
            <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
          </div>

          <p class="text-center">¿Está seguro que desea registrar la devolución de este equipo en buen estado?</p>

          <div class="alert alert-info">
            <i class="fas fa-info-circle mr-2"></i>
            <span id="mensajeTipoPrestamo">Si confirma, el equipo será marcado como disponible en el sistema.</span>
          </div>

          <div class="d-flex justify-content-center mt-4">
            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal" style="width: 150px;">Cancelar</button>
            <button type="button" class="btn btn-success" id="btnConfirmarBuenEstado" style="width: 150px;">Confirmar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
