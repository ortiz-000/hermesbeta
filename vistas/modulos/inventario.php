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
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            </ol>
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
                <th>A. Cuentadante</th>
                <th>Estado</th>
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
                echo '<td>' . $equipo['categoria_id']    . '</td>';
                echo '<td>' . $equipo['cuentadante_id']  . '</td>';
                echo '<td>' . $equipo['a_cuentadante']   . '</td>';
                  
                  // Botón de estado
                  switch ($equipo["estado"]) {
                    case "activo":
                      echo '<td><button class="btn btn-success btn-xs btnActivarEquipo" idEquipo="' . $equipo["equipo_id"] . '" estadoEquipo="inactivo">Activo</button></td>';
                      break;
                    case "inactivo":
                      echo '<td><button class="btn btn-danger btn-xs btnActivarEquipo" idEquipo="' . $equipo["equipo_id"] . '" estadoEquipo="mantenimiento">Inactivo</button></td>';
                      break;
                    case "mantenimiento":
                      echo '<td><button class="btn btn-warning btn-xs btnActivarEquipo" idEquipo="' . $equipo["equipo_id"] . '" estadoEquipo="baja">Mantenimiento</button></td>';
                      break;
                    case "baja":
                      echo '<td><button class="btn btn-secondary btn-xs btnActivarEquipo" idEquipo="' . $equipo["equipo_id"] . '" estadoEquipo="activo">En baja</button></td>';
                      break;
                  }
                  
                  // Botón de acciones
                  echo '<td>
                        <div class="btn-group">
                          <button class="btn btn-default btn-xs btnEditarEquipo" idEquipo="' . $equipo["equipo_id"] . '" data-toggle="modal" data-target="#modalEditarEquipo">
                            <i class="fas fa-edit  mr-1 ml-1"></i>
                          </button>
                          <button class="btn btn-default btn-xs btnEditarEquipo" idEquipo="' . $equipo["equipo_id"] . '" data-toggle="modal" data-target="#modalEditarEquipo"><i class="fas fa-edit mr-1 ml-1"></i></button>
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