<?php
// auditoria.php
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Historial de Auditoría de Usuarios</h1>
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
                            <table id="tablaAuditoria" class="table table-bordered table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>ID Usuario</th>
                                        <th>Tipo Doc.</th>
                                        <th>Número Doc.</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Correo</th>
                                        <th>Usuario</th>
                                        <th>Teléfono</th>
                                        <th>Dirección</th>
                                        <th>Género</th>
                                        <th>Foto</th>
                                        <th>Estado</th>
                                        <th>Condición</th>
                                        <th>Fecha Registro</th>
                                        <th>Editado Por</th>
                                        <th>Campos Modificados</th>
                                        <th>Valores Anteriores</th>
                                        <th>Valores Nuevos</th>
                                        <th>Fecha Cambio</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- El tbody queda vacío porque lo llena DataTables por AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal para Detalle de Cambios -->
<div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="modalDetalleLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetalleLabel">Detalle de Cambios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalDetalleBody">
        <!-- Aquí se cargará el detalle con JS -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Tu archivo JS con la tabla y modal -->
<script src="js/auditoria.js"></script>
