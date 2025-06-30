<div class="content-wrapper">
  <!-- Encabezado de la pagina -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Mantenimiento</h1>
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

  <!-- Inicio de la tabla -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <table id="tblMantenimiento" class="table table-bordered table-striped">
                <thead class="bg-dark">
                  <tr>
                    <th>ID</th>
                    <th>Numero de serie</th>
                    <th>Etiqueta</th>
                    <th>Descripcion</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $item = null;
                  $valor = null;
                  $mantenimientos = ControladorMantenimiento::ctrMostrarMantenimientos($item, $valor);

                  if (!empty($mantenimientos) && is_array($mantenimientos)) {
                    foreach ($mantenimientos as $key => $value) {
                      echo '
                        <tr>
                          <td>' . $value["equipo_id"] . '</td>
                          <td>' . $value["numero_serie"] . '</td>
                          <td>' . $value["etiqueta"] . '</td>
                          <td>' . $value["descripcion"] . '</td>
                          <td>
                            <div class="btn-group">
                              <button title="Ver detalles" class="btn btn-default btn-sm btnVerDetalles" data-id="' . $value["equipo_id"] . '" data-toggle="modal" data-target="#modalVerDetalles">
                                <i class="fas fa-eye"></i>
                              </button>
                              <button title="Editar mantenimiento" class="btn btn-default btn-sm btnEditarMantenimiento" data-id="' . $value["Id_mantenimiento"] . '" data-toggle="modal" data-target="#modalEditarMantenimiento">
                                <i class="fas fa-edit"></i>
                              </button>
                              <button title="Solicitudes asociadas" class="btn btn-default btn-sm btnSolicitudesMantenimiento" data-id="' . $value["equipo_id"] . '">
                                <i class="fas fa-laptop"></i>
                              </button>
                            </div>
                          </td>
                        </tr>';
                    }
                  } else {
                    echo '<tr><td colspan="6" class="text-center">No hay equipos en mantenimiento</td></tr>';
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

<<<<<<< Updated upstream
  <!-- Modal Ver Detalles -->
  <div class="modal fade" id="modalVerDetalles">
    <div class="modal-dialog">
=======

  <!-- Modal Finalizar Mantenimiento -->
  <div class="modal fade" id="modalFinalizarMantenimiento">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Detalles del Equipo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-4 text-center border-right">
              <div class="equipment-image mb-3">
                <i class="fas fa-desktop fa-6x text-info"></i>
              </div>
              <span id="equipoEtiqueta" class="d-block font-weight-bold h5"></span>
              
              <div class="card card-info mt-3">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>Información del Equipo</h3>
                </div>
                <div class="card-body p-2">
                  <table class="table table-sm">
                    <tbody>
                      <tr>
                        <th><i class="fas fa-barcode mr-2"></i>Serie:</th>
                        <td id="equipoSerie"></td>
                      </tr>
                      <tr>
                        <th><i class="fas fa-info-circle mr-2"></i>Descripción:</th>
                        <td id="equipoDescripcion"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
            <div class="col-md-8">
              <div class="p-3">
                <h5 class="border-bottom pb-2 text-info">
                  <i class="fas fa-tools mr-2"></i>Estado del Mantenimiento
                </h5>
                <form id="formFinalizarMantenimiento" method="post">
                  <input type="hidden" id="equipoId" name="equipoId">

                  <div class="form-group">
                    <label class="font-weight-bold">Nivel de Gravedad:</label>
                    <div class="d-flex flex-wrap">
                      <div class="custom-control custom-radio mr-4 mb-2">
                        <input type="radio" id="sinNovedad" name="gravedad" value="ninguno" class="custom-control-input">
                        <label class="custom-control-label" for="sinNovedad">
                          <i class="fas fa-check-circle text-success mr-1"></i>Sin novedad
                        </label>
                      </div>
                      <div class="custom-control custom-radio mr-4 mb-2">
                        <input type="radio" id="problemaLeve" name="gravedad" value="leve" class="custom-control-input">
                        <label class="custom-control-label" for="problemaLeve">
                          <i class="fas fa-exclamation-circle text-warning mr-1"></i>Problema leve
                        </label>
                      </div>
                      <div class="custom-control custom-radio mb-2">
                        <input type="radio" id="problemaGrave" name="gravedad" value="grave" class="custom-control-input">
                        <label class="custom-control-label" for="problemaGrave">
                          <i class="fas fa-exclamation-triangle text-danger mr-1"></i>Problema grave
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="tipoMante" class="form-label font-weight-bold">
                      <i class="fas fa-wrench mr-2"></i>Tipo de Mantenimiento:
                    </label>
                    <select name="tipoMantenimiento" id="tipoMante" class="form-control custom-select">
                      <option value="" disabled selected>Seleccione el tipo de mantenimiento</option>
                      <option value="preventivo">Preventivo</option>
                      <option value="correctivo">Correctivo</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="descripcionProblema" class="font-weight-bold">
                      <i class="fas fa-clipboard mr-2"></i>Descripción del problema:
                    </label>
                    <textarea class="form-control" id="descripcionProblema" name="detalles" rows="4" required></textarea>
                  </div>

                  <div class="text-right mt-4">
                    <button type="submit" class="btn btn-info btn-lg px-5" id="btnGuardarMantenimiento">
                      <i class="fas fa-check-circle mr-2"></i>Finalizar Mantenimiento
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Editar Mantenimiento -->
  <div class="modal fade" id="modalEditarMantenimiento">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Editar Mantenimiento</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Formulario para editar mantenimiento iría aquí</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Guardar Cambios</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Incluir el archivo JavaScript -->
  <script src="vistas/js/mantenimiento.js"></script>
</div>