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

            <!-- grafico de estado de prestamo jack -->
            <div class="card-header bg-dark">
              <h3 class="card-title"><i class="fas fa-chart-pie"></i> Estados de Préstamos</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>

            <?php
            $estadosPrestamos = ControladorInicio::ctrObtenerPrestamosPorEstado();

            $labels = [];
            $data = [];
            $colors = [];

            // Mapeo de estados a colores
            $coloresPorEstado = [
              'Pendiente' => '#ffc107',  // Amarillo
              'Aprobado' => '#28a745',    // Verde
              'Rechazado' => '#dc3545',   // Rojo
              'Devuelto' => '#17a2b8',    // Azul claro
              'Perdido' => '#673AB7',     // Gris
              'En préstamo' => '#007bff' // Azul
            ];

            foreach ($estadosPrestamos as $estado) {
              $labels[] = $estado['estado_prestamo'];
              $data[] = $estado['cantidad'];
              $colors[] = $coloresPorEstado[$estado['estado_prestamo']] ?? '#6c757d'; // Gris por defecto
            }
            ?>

            <div class="card-body">
              <canvas id="pie-chart-estados"
                style="min-height: 250px; height: 150px; background-color:rgba(255, 255, 255, 0.5);"></canvas>
            </div>
          </div>
        </div>
        <!-- fin grafico de estado de prestamo jack -->

        <!--  grafico de prestamo por dia alonso -->
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
              <center>
                <button type="button" class="btn btn-sm btn-info" id="semana-actual">Semana Actual</button>
                <button type="button" class="btn btn-sm btn-secondary" id="semana-anterior">Semana Anterior</button>
              </center>
            </div>

            <div class="card-body">
              <canvas id="line-chart-prestamos"
                style="min-height: 250px; height: 150px; background-color:rgba(88, 165, 216, 0.38);"></canvas>
            </div>
          </div>



        </div>
        <!-- fin grafico de estado de prestamo alonso -->
      </div><!-- /.row -->

  </section>




  <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<script>
  // Gráfica de Línea (Préstamos por día) - SE MANTIENE IGUAL
  const ctx = document.getElementById('line-chart-prestamos').getContext('2d');

  let chart;

  function cargarGrafico(tipo = 'actual') {
    fetch(`ajax/inicio.ajax.php?tipo=${tipo}`)
      .then(res => res.json())
      .then(data => {
        const dias = data.map(d => d.dia);
        const cantidades = data.map(d => d.cantidad);

        if (chart) chart.destroy(); // limpiar gráfico anterior

        chart = new Chart(ctx, {
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
      });
  }

  // Eventos para los botones
  document.getElementById('semana-actual').addEventListener('click', () => cargarGrafico('actual'));
  document.getElementById('semana-anterior').addEventListener('click', () => cargarGrafico('anterior'));

  // Cargar gráfico por defecto
  cargarGrafico();
</script>

<script>

  // Gráfica de Pie (Estados de Préstamos) - MODIFICADA CON COLORES Y PORCENTAJES
  const ctxPie = document.getElementById('pie-chart-estados').getContext('2d');
  const totalPrestamos = <?php echo array_sum($data); ?>; // Calcula el total para porcentajes

  new Chart(ctxPie, {
    type: 'pie',
    data: {
      labels: <?php echo json_encode($labels); ?>,
      datasets: [{
        data: <?php echo json_encode($data); ?>,
        backgroundColor: [
          '#FF6384', // Pendiente (Rosa)
          '#36A2EB', // Aprobado (Azul)
          '#FFCE56', // Rechazado (Amarillo)
          '#4BC0C0', // Devuelto (Turquesa)
          '#9966FF', // Perdido (Morado)
          '#FF9F40'  // En préstamo (Naranja)
        ],
        borderColor: '#fff',
        borderWidth: 2
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'right',
          labels: {
            color: '#000',
            font: { size: 12 },
            generateLabels: function (chart) {
              const data = chart.data;
              return data.labels.map((label, i) => {
                const value = data.datasets[0].data[i];
                const percentage = totalPrestamos > 0 ? Math.round((value / totalPrestamos) * 100) : 0;
                return {
                  text: `${label}: ${value} (${percentage}%)`, // Leyenda con porcentaje
                  fillStyle: data.datasets[0].backgroundColor[i],
                  hidden: false,
                  index: i
                };
              });
            }
          }
        },
        tooltip: {
          callbacks: {
            label: function (context) {
              const label = context.label || '';
              const value = context.raw || 0;
              const percentage = totalPrestamos > 0 ? Math.round((value / totalPrestamos) * 100) : 0;
              return `${label}: ${value} (${percentage}%)`; // Tooltip con porcentaje
            }
          }
        }
      }
    }
  });
</script>