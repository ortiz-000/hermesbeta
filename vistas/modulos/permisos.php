  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Permisos</h1>
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


<!-- ======================================================================================================= -->

<div class="wrapper">
  
  <!-- Contenedor principal -->
  <div class="content-wrapper p-3">
    
    <!-- Tarjeta (card) para la gestión de roles -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Gestión de equipos</h3>
      </div>
      
      <div class="card-body">
        <!-- Formulario para guardar la configuración de permisos -->
        <form action="/ruta-de-tu-accion" method="POST">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nombre/Rol</th>
                <th>CE</th>
                <th>Ce</th>
                <th>ME</th>
                <th>IE</th>
                <th>AE</th>
                <th>RE</th>
              </tr>
            </thead>
            <tbody>
              <!-- Fila: Líder TIC -->
              <tr>
                <td>Líder TIC</td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="liderTIC_ce" name="liderTIC_ce" value="1">
                    <label for="liderTIC_ce"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="liderTIC_Ce" name="liderTIC_Ce" value="1">
                    <label for="liderTIC_Ce"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="liderTIC_me" name="liderTIC_me" value="1">
                    <label for="liderTIC_me"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="liderTIC_ie" name="liderTIC_ie" value="1">
                    <label for="liderTIC_ie"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="liderTIC_ae" name="liderTIC_ae" value="1">
                    <label for="liderTIC_ae"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="liderTIC_re" name="liderTIC_re" value="1">
                    <label for="liderTIC_re"></label>
                  </div>
                </td>
              </tr>

              <!-- Fila: Mesa de ayuda -->
              <tr>
                <td>Mesa de ayuda</td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="mesaAyuda_ce" name="mesaAyuda_ce" value="1">
                    <label for="mesaAyuda_ce"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="mesaAyuda_Ce" name="mesaAyuda_Ce" value="1">
                    <label for="mesaAyuda_Ce"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="mesaAyuda_me" name="mesaAyuda_me" value="1">
                    <label for="mesaAyuda_me"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="mesaAyuda_ie" name="mesaAyuda_ie" value="1">
                    <label for="mesaAyuda_ie"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="mesaAyuda_ae" name="mesaAyuda_ae" value="1">
                    <label for="mesaAyuda_ae"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="mesaAyuda_re" name="mesaAyuda_re" value="1">
                    <label for="mesaAyuda_re"></label>
                  </div>
                </td>
              </tr>

              <!-- Fila: Admin almacén -->
              <tr>
                <td>Admin almacén</td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="adminAlmacen_ce" name="adminAlmacen_ce" value="1">
                    <label for="adminAlmacen_ce"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="adminAlmacen_Ce" name="adminAlmacen_Ce" value="1">
                    <label for="adminAlmacen_Ce"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="adminAlmacen_me" name="adminAlmacen_me" value="1">
                    <label for="adminAlmacen_me"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="adminAlmacen_ie" name="adminAlmacen_ie" value="1">
                    <label for="adminAlmacen_ie"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="adminAlmacen_ae" name="adminAlmacen_ae" value="1">
                    <label for="adminAlmacen_ae"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="adminAlmacen_re" name="adminAlmacen_re" value="1">
                    <label for="adminAlmacen_re"></label>
                  </div>
                </td>
              </tr>

              <!-- Fila: Admin biblioteca -->
              <tr>
                <td>Admin biblioteca</td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="adminBiblioteca_ce" name="adminBiblioteca_ce" value="1">
                    <label for="adminBiblioteca_ce"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="adminBiblioteca_Ce" name="adminBiblioteca_Ce" value="1">
                    <label for="adminBiblioteca_Ce"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="adminBiblioteca_me" name="adminBiblioteca_me" value="1">
                    <label for="adminBiblioteca_me"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="adminBiblioteca_ie" name="adminBiblioteca_ie" value="1">
                    <label for="adminBiblioteca_ie"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="adminBiblioteca_ae" name="adminBiblioteca_ae" value="1">
                    <label for="adminBiblioteca_ae"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="adminBiblioteca_re" name="adminBiblioteca_re" value="1">
                    <label for="adminBiblioteca_re"></label>
                  </div>
                </td>
              </tr>

              <!-- Fila: Admin coordinación -->
              <tr>
                <td>Admin coordinación</td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="adminCoordinacion_ce" name="adminCoordinacion_ce" value="1">
                    <label for="adminCoordinacion_ce"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="adminCoordinacion_Ce" name="adminCoordinacion_Ce" value="1">
                    <label for="adminCoordinacion_Ce"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="adminCoordinacion_me" name="adminCoordinacion_me" value="1">
                    <label for="adminCoordinacion_me"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="adminCoordinacion_ie" name="adminCoordinacion_ie" value="1">
                    <label for="adminCoordinacion_ie"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="adminCoordinacion_ae" name="adminCoordinacion_ae" value="1">
                    <label for="adminCoordinacion_ae"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="adminCoordinacion_re" name="adminCoordinacion_re" value="1">
                    <label for="adminCoordinacion_re"></label>
                  </div>
                </td>
              </tr>

              <!-- Fila: Aprendiz -->
              <tr>
                <td>Aprendiz</td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="aprendiz_ce" name="aprendiz_ce" value="1">
                    <label for="aprendiz_ce"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="aprendiz_Ce" name="aprendiz_Ce" value="1">
                    <label for="aprendiz_Ce"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="aprendiz_me" name="aprendiz_me" value="1">
                    <label for="aprendiz_me"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="aprendiz_ie" name="aprendiz_ie" value="1">
                    <label for="aprendiz_ie"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="aprendiz_ae" name="aprendiz_ae" value="1">
                    <label for="aprendiz_ae"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="aprendiz_re" name="aprendiz_re" value="1">
                    <label for="aprendiz_re"></label>
                  </div>
                </td>
              </tr>

              <!-- Fila: Instructor -->
              <tr>
                <td>Instructor</td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="instructor_ce" name="instructor_ce" value="1">
                    <label for="instructor_ce"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="instructor_Ce" name="instructor_Ce" value="1">
                    <label for="instructor_Ce"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="instructor_me" name="instructor_me" value="1">
                    <label for="instructor_me"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="instructor_ie" name="instructor_ie" value="1">
                    <label for="instructor_ie"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="instructor_ae" name="instructor_ae" value="1">
                    <label for="instructor_ae"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="instructor_re" name="instructor_re" value="1">
                    <label for="instructor_re"></label>
                  </div>
                </td>
              </tr>

              <!-- Fila: Vigilante -->
              <tr>
                <td>Vigilante</td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="vigilante_ce" name="vigilante_ce" value="1">
                    <label for="vigilante_ce"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="vigilante_Ce" name="vigilante_Ce" value="1">
                    <label for="vigilante_Ce"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="vigilante_me" name="vigilante_me" value="1">
                    <label for="vigilante_me"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="vigilante_ie" name="vigilante_ie" value="1">
                    <label for="vigilante_ie"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="vigilante_ae" name="vigilante_ae" value="1">
                    <label for="vigilante_ae"></label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="vigilante_re" name="vigilante_re" value="1">
                    <label for="vigilante_re"></label>
                  </div>
                </td>
              </tr>

            </tbody>
          </table>
          <!-- Botón para guardar los cambios -->
          <div class="mt-3">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save"></i> Guardar
            </button>
          </div>
        </form>
      </div>
    </div>
    
  </div><!-- /.content-wrapper -->
  
</div><!-- /.wrapper -->









<!-- ======================================================================================================= -->



















    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->