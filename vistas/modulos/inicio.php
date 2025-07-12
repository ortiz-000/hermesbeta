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
        <!-- <div class="col-sm-6"></div> -->
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-dark">
                <h3 class="card-title"><i class="fas fa-chart-line"></i> Préstamos Por Día</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
        
        <?php

        $prestamos = ControladorInicio::ctrObtenerPrestamosPorDia();

        $dias = [];
        $cantidades = [];

        foreach ($prestamos as $registro) {
          $dias[] = $registro['dia'];
          $cantidades[] = $registro['cantidad'];
        }
        ?>
        <div class="card-body">
          <canvas id="line-chart-prestamos"
            style="min-height: 250px; height: 150px; background-color:rgba(88, 165, 216, 0.38);"></canvas>
        </div>
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

  const dias = <?php echo json_encode($dias); ?>;
  const cantidades = <?php echo json_encode($cantidades); ?>;

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: dias,
      datasets: [{
        label: 'Préstamos por día',
        data: cantidades,
        borderColor: '#17a2b8',
        backgroundColor: 'rgba(23, 162, 184, 0.2)',
        fill: true,
        tension: 0.4,
        pointBackgroundColor: '#17a2b8'
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { labels: { color: '#000' } }
      },
      scales: {
        x: { ticks: { color: '#000' } },
        y: { ticks: { color: '#000' } }
      }
    }
  });

</script>