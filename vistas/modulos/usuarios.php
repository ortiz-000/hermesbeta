  <!-- Content Wrapper. Contains page content -->
  <!-- <div class="content-wrapper"> -->
  <!-- Content Header (Page header) -->
  <!-- <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item">Usuarios</li>
            </ol>
          </div>
        </div>
      </div>
    </section> -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Fichas</h1>
          </div>
          <div class="col-sm-6">
            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#registrarUsuario">Agregar usuario</button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <!-- <div class="card">
            <div class="card-header">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registrarUsuario">
              Agregar Usuario</button> -->


      <!-- </div> -->
      <div class="card-body">
        <table id="tblUsuarios" class="table table-bordered table-striped">
        <!-- <table id="tblUsuarios" class="table table-bordered table-striped"> -->
          <thead>
            <tr>
              <th>#</th>
              <th>Tipo de documento</th>
              <th>Numero de documento</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Correo</th>
              <th>Estado</th>
              <!-- <th>Rol</th> -->
              <!-- Solo si es estudiante -->
              <!-- <th>Ficha</th>
              <th>Estado</th>
              <th>Ultimo Acceso</th>-->
              <th>Acciones</th>
            </tr>
          </thead>
          <?php
          $item = null;
          $valor = null;
          $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
          
          foreach ($usuarios as $key => $usuario) {
            if ($usuario["id_usuario"] == 1) {
              continue; // Skip the user with id_usuario = 1
            }
            echo '<tr>
                <td>' . ($key + 1) . '</td>
                <td>' . $usuario["tipo_documento"] . '</td>
                <td>' . $usuario["numero_documento"] . '</td>                
                <td>' . $usuario["nombre"] . '</td>
                <td>' . $usuario["apellido"] . '</td>
                <td>' . $usuario["correo_electronico"] . '</td>
                <td>';
                if ($usuario["estado"] == "activo") {
                  echo '<button class="btn btn-success btn-xs btnActivarUsuario" idSede="'.$usuario["id_usuario"].'" estadoSede="inactivo"">Activo</button>';
              } else {
                  echo '<button class="btn btn-danger btn-xs btnActivarUsuario" idSede="'.$usuario["id_usuario"].'" estadoSede="activo">Inactivo</button></td>';
              };
              echo '<td>
                  <div class="btn-group">
                    <button class="btn btn-default btn-xs"><i class="fas fa-eye"></i></button>
                    <button class="btn btn-default btn-xs"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-default btn-xs"><i class="fas fa-laptop"></i></button>
                    <button class="btn btn-default btn-xs"><i class="fas fa-file"></i></button>
                  </div>
                </td>
                </tr>';
          }
          ?>
          </tbody>
        </table

          </div>
        <!-- /.card-body -->

      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <div class="modal fade" id="registrarUsuario">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agregar usuario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="box-body">

            <!-- row nombre y apellido -->
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6">
                  <div class="input-group ">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" name="nuevoNombre" placeholder="Nombre" required>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="input-group ">
                    <input type="text" class="form-control" name="nuevoApellido" placeholder="Apellido" required>
                  </div>
                </div>
              </div>
              <!-- row -->
            </div>
            <!-- form group -->

            <!-- row documento -->
            <div class="form-group">
              <div class="row">

                <div class="col-lg-4">
                  <label>Tipo</label>
                  <select class="form-control">
                    <option>TI</option>
                    <option>CC</option>
                    <option>PS</option>
                    <option>PI</option>
                  </select>
                </div>

                <div class="col-lg-8">
                  <label>Numero de documento</label>
                  <div class="input-group ">
                    <input type="text" class="form-control" name="nuevoNumero" placeholder="Apellido" required>
                  </div>
                </div>
              </div>
              <!-- row -->
            </div>
            <!-- form group -->

            <!-- row rol -->
            <div class="form-group">
              <div class="row">
                <div class="col-lg-12">
                  <label>Rol</label>
                  <div class="input-group ">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <select class="form-control">
                      <option>Líder TIC</option>
                      <option>Mesa de ayuda</option>
                      <option>Almacén</option>
                      <option>Biblioteca</option>
                      <option>Coordinación</option>
                      <option>Instructor</option>
                      <option>Aprendiz</option>
                      <option>Vigilante</option>
                    </select>
                  </div>
                </div>

              </div>
              <!-- row -->
            </div>
            <!-- form group -->

            <!-- row sede  -->
            <div class="form-group">
              <div class="row">
                <div class="col-lg-12">
                  <label>Sede</label>
                  <div class="input-group ">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <select class="form-control">
                      <option>Sagrado</option>
                      <option>Salesiano</option>
                      <option>Bicentenario</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- row -->
            </div>
            <!-- form group -->

            <!-- row grupo y programa -->
            <div class="form-group">
              <div class="row">

                <div class="col-lg-4">
                  <label>Grupo</label>
                  <select class="form-control">
                    <option>2847523</option>
                    <option>2823094</option>
                    <option>1921881</option>
                    <option>3113772</option>
                    <option>3063989</option>
                    <option>3113758</option>
                  </select>
                </div>

                <div class="col-lg-8">
                  <label>Programa</label>
                  <div class="input-group ">
                    <input type="text" class="form-control" name="nuevoNumero" placeholder="ANÁLISIS Y DESARROLLO DE SOFTWARE (ADSO)" disabled>
                  </div>
                </div>
              </div>
              <!-- row -->
            </div>
            <!-- form group -->


            <!-- row mail  -->
            <div class="form-group">
              <div class="row">
                <div class="col-lg-12">
                  <div class="input-group ">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input type="text" class="form-control" name="nuevoNombre" placeholder="Email" required>
                  </div>
                </div>
              </div>
              <!-- row -->
            </div>
            <!-- form group -->

            <!-- row telefono  -->
            <div class="form-group">
              <div class="row">
                <div class="col-lg-12">
                  <div class="input-group ">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" class="form-control" name="nuevoNombre" placeholder="celular" required>
                  </div>
                </div>
              </div>
              <!-- row -->
            </div>
            <!-- form group -->

            <!-- row Direccion  -->
            <div class="form-group">
              <div class="row">
                <div class="col-lg-12">
                  <div class="input-group ">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                    </div>
                    <input type="text" class="form-control" name="nuevoNombre" placeholder="Dirección" required>
                  </div>
                </div>
              </div>
              <!-- row -->
            </div>
            <!-- form group -->

            <!-- row Genero  -->
            <div class="form-group">
              <div class="row">
                <div class="col-lg-12">
                  <label>Género</label>
                  <div class="input-group ">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-transgender"></i></span>
                    </div>
                    <select class="form-control">
                      <option>Femenino</option>
                      <option>Masculino</option>
                      <option>No declara</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- row -->
            </div>
            <!-- form group -->





          </div>
          <!-- box-body  -->
        </div>
        <!-- modal-body  -->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Agregar</button>
        </div>

      </div>
    </div>
    <!-- modal-content  -->
  </div>
  <!-- modal-dialog  -->
  </div>
  <!-- modal  -->


  <script>



  </script>