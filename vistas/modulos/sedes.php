<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sedes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <button type="button" data-toggle="modal" data-target="#modalAgregar" class="btn btn-block btn-primary btn-sm">Agregar sede</button>
                        </button>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tabla sedes</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tblSedes" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#Id sede</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $item = null;
                        $valor = null;
                        $sedes = ControladorSedes::ctrMostrarSedes($item, $valor);
                        foreach ($sedes as $key => $value) {
                            echo '<tr>
                                <td>' . ($key + 1) . '</td>
                                <td>' . $value["nombre_sede"] . '</td>
                                <td>' . $value["direccion"] . '</td>
                                <td>' . $value["descripcion"] . '</td>
                                
                                <td>';
                            if ($value["estado"] == "Activa") {
                                echo '<button class="btn btn-success btn-xs btnActivarSede" idSede="' . $value["id_sede"] . '" estadoSede="Inactiva">Activa</button>';
                            } else {
                                echo '<button class="btn btn-danger btn-xs btnActivarSede" idSede="' . $value["id_sede"] . '" estadoSede="Activa">Inactivo</button>';
                            }
                            echo '<td>
                                        <button class="btn btn-default btn-xs btnEditarSede" idSede="'. $value["id_sede"]. '" data-toggle="modal" data-target="#modalEditar"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>';
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

<!-- MODAL DE AGREGAR -->
<div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="archivoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="archivoModalLabel">Agregar sede</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label for="nombreSede">Nombre</label>
                        <input type="text" class="form-control" id="nombreSede" placeholder="Ingrese el nombre de la sede">
                    </div>
                    <div class="form-group">
                        <label for="direccionSede">Dirección</label>
                        <input type="text" class="form-control" id="direccionSede" name="direccionSede" placeholder="Ingrese la dirección de la sede">
                    </div>
                    <div class="form-group">
                        <label for="descripcionSede">Descripción</label>
                        <textarea class="form-control" id="descripcionSede" name="descripcionSede" rows="3" placeholder="Ingrese una descripción"></textarea>

                    </div>
                    <div class="modal-footer justify-content-start">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                    
                    <?php

                        $item = null;
                        $valor = null;
                        $sedes = ControladorSedes::ctrCrearSedes($item, $valor);

                    ?>

                </form>
            </div>

        </div>
    </div>
</div>

<!-- MODAL DE EDITAR -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="archivoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="archivoModalLabel">Editar sede</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <input type="hidden" id="idEditSede" name="idEditSede">
                    <div class="form-group">
                        <label for="nombreEditSede">Nombre</label>
                        <input type="text" class="form-control" id="nombreEditSede" placeholder="Ingrese el nombre de la sede">
                    </div>
                    <div class="form-group">
                        <label for="direccionEditSede">Dirección</label>
                        <input type="text" class="form-control" id="direccionEditSede" placeholder="Ingrese la dirección de la sede">
                    </div>
                    <div class="form-group">
                        <label for="descripcionEditSede">Descripción</label>
                        <textarea class="form-control" id="descripcionEditSede" rows="3" placeholder="Ingrese una descripción"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-start">
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>