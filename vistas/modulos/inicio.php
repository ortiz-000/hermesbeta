<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Inicio</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          </ol>
        </div>
        <div class="col-lg-3 col-12">
          <!-- small box -->
          <?php
          $conteos = ControladorSolicitudes::ctrContarEquiposPorCategoria();
          $conteos2 = ControladorSolicitudes::ctrContarEquiposPorReserva();

          ?>
          <div class="small-box bg-info">
            <div class="inner">
              <h3>Portátiles</h3>
              <p><strong>Disponibles:</strong> <?php echo isset($conteos[1]) ? $conteos[1] : 0; ?></p>
              <p><strong>Reservados:</strong> <?php echo isset($conteos2[1]) ? $conteos2[1] : 0; ?></p>



            </div>
            <div class="icon">
              <i class="fas fa-desktop"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-12">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>Sonido</h3>
              <p><strong>Disponibles:</strong> <?php echo isset($conteos[3]) ? $conteos[3] : 0; ?></p>
              <p><strong>Reservados:</strong> <?php echo isset($conteos2[3]) ? $conteos2[3] : 0; ?></p>


            </div>
            <div class="icon">
              <i class="fas fa-volume-up"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-12">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>Videobeam</h3>
              <p><strong>Disponibles:</strong> <?php echo isset($conteos[2]) ? $conteos[2] : 0; ?></p>
              <p><strong>Reservados:</strong> <?php echo isset($conteos2[2]) ? $conteos2[2] : 0; ?></p>


            </div>
            <div class="icon">
              <i class="fas fa-video"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-12 ">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>Control remoto</h3>
              <p><strong>Disponibles:</strong> <?php echo isset($conteos[5]) ? $conteos[5] : 0; ?></p>
              <p><strong>Reservados:</strong> <?php echo isset($conteos2[5]) ? $conteos2[5] : 0; ?></p>


            </div>
            <div class="icon">
              <i class="fas fa-gamepad"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="box box-solid bg-teal-gradient">
          <div class="box-header">
            <i class="fa fa-th"></i>
            <h3 class="box-title">Grafico de Prestamos</h3>
          </div>
          <div class="box-body border-radius-none nuevoGraficoPrestamo">
            <canvas class="chart" id="line-chart-prestamos" style="height: 250px;"></canvas>
          </div>
        </div>


      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>

  const ctx = document.getElementById('line-chart-prestamos').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'],
      datasets: [{
        label: 'Prestamos',
        data: [2666, 2778, 4912, 3767, 6810],
        borderColor: '#httght',
        backgroundColor: 'rgba(23, 50, 184, 0.2)',
        fill: true,
        tension: 0.4,
        pointBackgroundColor: '#httght'
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          labels: { color: '#httght' }
        }
      },
      scales: {
        x: {
          ticks: { color: '#httght' },
          grid: { color: 'rgba(243, 8, 8, 0.1)' }
        },
        y: {
          ticks: { color: '#httght' },
          grid: { color: 'rgba(244, 7, 7, 0.1)' }
        }
      }
    }
  });

</script>