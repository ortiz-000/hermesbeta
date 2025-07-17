<div class="content-wrapper">
    <!-- Encabezado -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Acerca del Proyecto Hermes</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Contenido principal -->
    <section class="content">
        <div class="container-fluid">
            <!-- Sobre el proyecto -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">¿Qué es Hermes?</h3>
                        </div>
                        <div class="card-body">
                            <p><strong>Hermes</strong> es una solución desarrollada con el objetivo de gestionar eficientemente el préstamo, autorización, y seguimiento de equipos tecnológicos. Inspirado en el dios griego Hermes, símbolo de mensajería y velocidad, el sistema refleja esos valores: agilidad, orden y comunicación.</p>
                            <p>El sistema fue construido con tecnologías como PHP, MySQL, JavaScript y el framework de interfaz <strong>AdminLTE</strong>.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lista de Desarrolladores -->
            <div class="row">
                <?php
                $desarrolladores = [
                    ["nombre" => "Jhoan David Sinisterra Valencia", "rol" => "Desarrollador líder del módulo de equipos"],
                    ["nombre" => "Juan Diego Millan Arango", "rol" => "Desarrollador líder del módulo de usuarios"],
                    ["nombre" => "Bryan David Uribe Bolivar", "rol" => "Desarrollador líder del módulo de autorizaciones"],
                    ["nombre" => "Jack Esteban Ortiz Vasquez", "rol" => "Autorizaciones"],
                    ["nombre" => "Nicolas Manzano Muriel", "rol" => "Autorizaciones"],
                    ["nombre" => "Alejandro Lozada Vera", "rol" => "Usuarios"],
                    ["nombre" => "Santiago Franco Florez", "rol" => "Solicitudes"],
                    ["nombre" => "Alonso Arboleda Obando", "rol" => "Líder solicitudes"],
                    ["nombre" => "Vocero", "rol" => "Equipos"],
                    ["nombre" => "Botan", "rol" => "Salidas"],
                    ["nombre" => "Jensen Ballen Banguera", "rol" => "Solicitudes"],
                    ["nombre" => "Pasto", "rol" => "Equipos"],
                    ["nombre" => "Karen", "rol" => "Salidas"]
                ];

                foreach ($desarrolladores as $dev) {
                    echo '
          <div class="col-md-4">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile text-center">
                <img class="profile-user-img img-fluid img-circle" src="vistas/img/usuarios/default/anonymous.png" alt="Foto de perfil">
                <h3 class="profile-username">' . $dev["nombre"] . '</h3>
                <p class="text-muted">' . $dev["rol"] . '</p>
              </div>
            </div>
          </div>';
                }
                ?>
            </div>
        </div>
    </section>
</div>