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
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
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
                          <td>'.$value["id_prestamo"].'</td>
                          <td>'.$value["solicitante"].'</td>
                          <td>'.date('Y-m-d H:i', strtotime($value["fecha_inicio"])).'</td>
                          <td>'.date('Y-m-d H:i', strtotime($value["fecha_fin"])).'</td>
                          <td>'.$value["estado_prestamo"].'</td>
                          <td>'.date('Y-m-d H:i', strtotime($value["fecha_solicitud"])).'</td>
                          <td>
                            <div class="icheck-primary d-inline mx-1">';
                              if ($autorizaciones["firma_coordinacion"] == "Firmado") {
                                echo '<input type="checkbox"checked>';                                            
                              }else{
                                echo '<input type="checkbox"';
                              }
                      echo '</div>
                          </td>
                          <td>
                            <div class="icheck-primary d-inline mx-1">';
                              if ($autorizaciones["firma_lider_tic"] == "Firmado") {
                                echo '<input type="checkbox"checked>';                                            
                              }else{
                                echo '<input type="checkbox"';
                              }
                      echo '</div>
                          </td>
                          <td>
                            <div class="icheck-primary d-inline mx-1">';
                              if ($autorizaciones["firma_almacen"] == "Firmado") {
                                echo '<input type="checkbox"checked>';                                            
                              }else{
                                echo '<input type="checkbox"';
                              }
                      echo '</div>
                          </td>
                          <td>
                            <button class="btn btn-info btn-sm btnVerDetallePrestamo_Autorizar" idPrestamo="'.$value["id_prestamo"].'" data-toggle="modal" data-target="#modalVerDetallesPrestamo">
                              <i class="fas fa-eye"></i>
                            </button>
                          </td>
                        </tr>';
                                  
                  }//fin REservado
                                
                }                
                ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>



<div class="modal fade" id="modalVerDetallesPrestamo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Detalle del Préstamo #<span id="num eroPrestamo"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <dl class="row">

                            <dt class="col-sm-4">Estado:</dt>
                            <dd class="col-sm-8" id="detalleTipoPrestamo"></dd>

                            <dt class="col-sm-4">Fecha Préstamo:</dt>
                            <dd class="col-sm-8" id="detalleFechaInicio"></dd>

                            <dt class="col-sm-4">Fecha Devolución:</dt>
                            <dd class="col-sm-8" id="detalleFechaFin"></dd>

                            <dt class="col-sm-4">Motivo:</dt>
                            <dd class="col-sm-8" id="detalleMotivoPrestamo"></dd>
                        </dl>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Equipos Solicitados</h5>
                            </div>
                            <div class="card-body p-10">
                                <table class="table table-bordered table-striped " id="tblDetallePrestamo">
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
                                        
                                        <!-- Aquí se cargarán los detalles del préstamo -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                

                
                <?php
                //si el estado prestamo es diferente de autorizado puede autorizar, rechazar o desautorizar
                if ($value["estado_prestamo"] != "Autorizado") {
                    //BOTON AUTORIZAR Y DESAUTORIZAR Y RECHAZAR
                    //si tiene el rol para firmar y el rol no ha firmado, puede autorizar o rechazar
                    if (($_SESSION["rol"] == "Coordinador" && $autorizaciones["firma_coordinacion"] != "Firmado")  ||
                        ($_SESSION["rol"] == "Lider TIC" && $autorizaciones["firma_lider_tic"]!= "Firmado") ||
                        ($_SESSION["rol"] == "Almacen" && $autorizaciones["firma_almacen"]!= "Firmado")){
                          echo '<button type="button" class="btn btn-danger btnRechazar" >Rechazar</button>';
                          echo '<button type="button" class="btn btn-primary btnAutorizar" >Autorizar</button>';                                
                    }
                    //si tiene el rol para firmar, si el rol ya ha firmado y fue el mismo usuario el que firmo, puede desautorizar
                    if (($_SESSION["rol"] == "Coordinador" && $autorizaciones["firma_coordinacion"]== "Firmado" && $autorizaciones["id_usuario_coordinacion"] == $_SESSION["id_usuario"])  ||
                        ($_SESSION["rol"] == "Lider TIC" && $autorizaciones["firma_lider_tic"]== "Firmado" && $autorizaciones["id_usuario_tic"] == $_SESSION["id_usuario"]) ||
                        ($_SESSION["rol"] == "Almacen" && $autorizaciones["firma_almacen"]== "Firmado" && $autorizaciones["id_usuario_almacen"] == $_SESSION["id_usuario"])){
                          echo '<button type="button" class="btn btn-danger btnDesautorizar" >Desautorizar</button>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
