  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Inventario</h1>
          </div>
          <div class="col-sm-6">
            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modalRegistrarEquipo">Agregar equipo</button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <table id="tblEquipos" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Id Equipo</th>
                <th>N# Serie</th>
                <th>Etiqueta</th>
                <th>Descripción</th>
                <th>Fecha Ingreso</th>
                <th>Ubicación id</th>
                <th>Categoría id</th>
                <th>Cuentadante id</th>
                <th>Id Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php

              $item = null;
              $valor = null;
              $equipos = ControladorEquipos::ctrMostrarEquipos($item, $valor);

              foreach ($equipos as $key => $equipo) {
                echo '<tr>';
                echo '<td>' . ($key + 1) . '</td>';
                echo '<td>' . $equipo['numero_serie']    . '</td>';
                echo '<td>' . $equipo['etiqueta']        . '</td>';
                echo '<td>' . $equipo['descripcion']     . '</td>';
                echo '<td>' . $equipo['fecha_entrada']   . '</td>';
                echo '<td>' . $equipo['ubicacion_id']    . '</td>';
                echo '<td>' . $equipo['categoria_id']       . '</td>';
                echo '<td>' . $equipo['cuentadante_id']  . '</td>';
                echo '<td>' . $equipo['id_estado']   . '</td>';
                // Botón de acciones
                echo '<td>
                        <div class="btn-group">
                          <button class="btn btn-default btn-xs btnEditarEquipo bg-warning" idEquipo="' . $equipo["equipo_id"] . '" data-toggle="modal" data-target="#modalEditarEquipo"><i class="fas fa-edit  mr-1 ml-1"></i></button>
                          <button class="btn btn-default btn-xs ml-2 bg-danger" idEquipo="' . $equipo["equipo_id"] . '" data-toggle="modal" data-target="#modalEliminarEquipo"><i class="fas fa-eraser mr-1 ml-1"></i></button>
                        </div>
                        </td>';
                echo '</tr>';
              }
              ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- ========== Start Section ==========
  MODAL PARA INGRESAR EQUIPO
  ========== End Section ========== -->

  <div class="modal fade" id="modalRegistrarEquipo">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-blue">
          <h4 class="modal-title">Agregar equipo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post">
            <div class="form-row">
              <div class="form-group col-lg-6">
                <label for="numeroSerie">#Número Serie</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                  </div>
                  <input type="text" class="form-control" id="numeroSerie" name="numeroSerie" placeholder="Ej:00ks32.." required>
                </div>
              </div>
              <div class="form-group col-lg-6">
                <label for="etiqueta">Etiqueta</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                  </div>
                  <input type="text" class="form-control" id="etiqueta" name="etiqueta" placeholder="Ej:0022338..." required>
                </div>
              </div>
            </div>
            <div class="form-group col-lg-12">
              <label for="descripcion">Descripción</label>
              <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Ej: El equipo se encuentra en perfecto estado..." rows="3" required></textarea>
            </div>
            <div class="form-row">
              <div class="form-group col-lg-6">
                <label for="ubicacionId">Ubicación</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                  </div>
                  <?php

                  $item = null;
                  $valor = null;
                  $ubicaciones = ControladorUbicaciones::ctrMostrarUbicaciones($item, $valor);
                  echo '<select class="form-control" id="ubicacionId" name="ubicacionId" required>';
                  echo '<option value="">--Seleccione una ubicación--</option>';
                  foreach ($ubicaciones as $key => $ubicacion) {
                    echo '<option value="' . $ubicacion["ubicacion_id"] . '">' . $ubicacion["nombre"] . '</option>';
                  }
                  echo '</select>';
                  ?>

                </div>
              </div>
              <div class="form-group col-lg-6">
                <label for="categoriaId">Categoría</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-list-alt"></i></span>
                  </div>
                  <?php

                  $item = null;
                  $valor = null;
                  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
                  echo '<select class="form-control" id="ubicacionId" name="ubicacionId" required>';
                  echo '<option value="">--Seleccione una ubicación--</option>';
                  foreach ($categorias as $key => $categoria) {
                    echo '<option value="' . $categoria["categoria_id"] . '">' . $categoria["nombre"] . '</option>';
                  }
                  echo '</select>';
                  ?>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-lg-12">
                <label for="cuentadanteId">Cuentadante</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                  </div>
                  <select class="form-control" id="cuentadanteId" name="cuentadanteId" required>
                    <option value="">Seleccione un cuentadante</option>
                    <!-- Opciones dinámicas -->
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            <?php

            $item = null;
            $valor = null;
            ControladorEquipos::ctrAgregarEquipos($item, $valor);

            ?>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- ========== Start Section ==========
  MODAL PARA EDITAR EQUIPO
  ========== End Section ========== -->

  <div class="modal fade" id="modalEditarEquipo">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h4 class="modal-title">Editar equipo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post">
            <input type="hidden" id="idEditEquipo" name="idEditEquipo">
            <div class="form-row">
              <div class="form-group col-lg-6">
                <label for="numeroSerieEdit">#Número Serie</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                  </div>
                  <input type="text" class="form-control" id="numeroSerieEdit" name="numeroSerieEdit" placeholder="Ej:00ks32.." required>
                </div>
              </div>
              <div class="form-group col-lg-6">
                <label for="etiquetaEdit">Etiqueta</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                  </div>
                  <input type="text" class="form-control" id="etiquetaEdit" name="etiquetaEdit" placeholder="Ej:0022338..." required>
                </div>
              </div>
            </div>
            <div class="form-group col-lg-12">
              <label for="descripcionEdit">Descripción</label>
              <textarea class="form-control" id="descripcionEdit" name="descripcionEdit" placeholder="Ej: El equipo se encuentra en perfecto estado..." rows="3" required></textarea>
            </div>
            <div class="form-row mt-2">
              <div class="form-group col-lg-6">
                <label for="ubicacionEdit">Ubicación</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                  </div>
                  <?php

                  $item = null;
                  $valor = null;
                  $ubicaciones = ControladorUbicaciones::ctrMostrarUbicaciones($item, $valor);
                  echo '<select class="form-control" id="ubicacionEdit" name="ubicacionEdit" required>';
                  echo '<option value="">Seleccione una ubicación</option>';
                  foreach ($ubicaciones as $key => $ubicacion) {
                    echo '<option value="' . $ubicacion["ubicacion_id"] . '">' . $ubicacion["nombre"] . '</option>';
                  }
                  echo '</select>';
                  ?>
                </div>
              </div>
              <div class="form-group col-lg-6">
                <label for="categoriaIdEdit">Categoría</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-list-alt"></i></span>
                  </div>
                  <select class="form-control" id="categoriaIdEdit" name="categoriaIdEdit" required>
                    <option value="">Seleccione una categoría</option>
                    <option value="Computador">Computador</option>
                    <option value="Video-beam">Video beam</option>
                    <option value="Cable_hdmi">Cable hdmi</option>
                    <!-- Opciones dinámicas -->
                  </select>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-lg-12">
                <label for="cuentadanteIdEdit">Cuentadante</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                  </div>
                  <select class="form-control" id="cuentadanteIdEdit" name="cuentadanteIdEdit" required>
                    <option value="">Seleccione un cuentadante</option>
                    <!-- Opciones dinámicas -->
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Editar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>