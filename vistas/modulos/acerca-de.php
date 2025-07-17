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

    <!-- Estilos para las imágenes de desarrolladores -->
    <style>
        .developer-image-container {
            width: 120px;
            height: 120px;
            margin: 0 auto 15px;
            overflow: hidden;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f4f6f9;
            border: 3px solid #3c8dbc;
        }
        
        .developer-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
    </style>

    <!-- Contenido principal -->
    <section class="content">
        <div class="container-fluid">
            <!-- Sobre el proyecto -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">¿Qué es HERMES?</h3>
                        </div>
                        <div class="card-body">
                            <p><strong>HERMES</strong> (Herramientas y Equipos Reservables para el Manejo Estratégico de Servicios) es un sistema interno diseñado para apoyar la formación en el <strong>SENA</strong>, facilitando el acceso organizado y responsable a los recursos necesarios en las prácticas formativas.</p>

                            <p>Permite gestionar el préstamo de herramientas, equipos y materiales utilizados en el desarrollo de actividades académicas, mostrando su disponibilidad, estado de préstamo y las normas de uso establecidas.</p>

                            <p><strong>¿Quiénes pueden usarlo?</strong></p>
                            <ul>
                                <li>Instructores y aprendices activos del SENA</li>
                                <li>Personal autorizado de cada área formativa</li>
                                <li>Coordinadores de ambiente y logística</li>
                            </ul>

                            <p><strong>Recomendaciones importantes</strong></p>
                            <ul>
                                <li>Revisa el estado del equipo antes de llevártelo.</li>
                                <li>Entrega el material en la fecha y hora acordadas.</li>
                                <li>Reporta cualquier daño o novedad al instructor o coordinador.</li>
                                <li>El uso adecuado garantiza que más aprendices puedan beneficiarse.</li>
                            </ul>

                            <p><strong>Horarios de atención</strong><br>
                                Lunes a viernes: 7:00 a.m. – 12:00 m. | 1:00 p.m. – 5:00 p.m.</p>

                            <blockquote class="text-success">
                                "El buen uso de las herramientas refleja tu compromiso con la formación técnica y profesional"
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lista de Desarrolladores -->
            <div class="row">
                <?php
                $desarrolladores = [
                    ["nombre" => "German Ramirez Ramirez", "rol" => "Product Owner", "foto" => "vistas/img/desarrolladores/grr.jpg"],
                    ["nombre" => "Cristian Camilo Gomez Gonzalez", "rol" => "Líder del módulo de Devoluciones", "foto" => "vistas/img/desarrolladores/ccgg.jpg"],
                    ["nombre" => "Jhoan David Sinisterra Valencia", "rol" => "Líder del módulo de Equipos", "foto" => "vistas/img/desarrolladores/jdsv.jpg"],
                    ["nombre" => "Juan Diego Millán Arango", "rol" => "Líder del módulo de Usuarios", "foto" => "vistas/img/desarrolladores/jdma.jpg"],
                    ["nombre" => "Brayan Camilo Ospina Gonzalez", "rol" => "Líder del módulo de Autorizaciones", "foto" => "vistas/img/desarrolladores/bcog.jpg"],
                    ["nombre" => "Alonso Arboleda Obando", "rol" => "Líder del módulo de Solicitudes", "foto" => "vistas/img/desarrolladores/aao.jpg"],
                    ["nombre" => "Jack Esteban Ortiz Vásquez", "rol" => "Módulo de Autorizaciones", "foto" => "vistas/img/desarrolladores/jeov.jpg"],
                    ["nombre" => "Nicolás Manzano Muriel", "rol" => "Módulo de Autorizaciones", "foto" => "vistas/img/desarrolladores/nmm.jpg"],
                    ["nombre" => "Alejandro Lozada Vera", "rol" => "Módulo de Usuarios", "foto" => "vistas/img/desarrolladores/alv.jpg"],
                    ["nombre" => "Santiago Franco Flórez", "rol" => "Módulo de Solicitudes", "foto" => "vistas/img/desarrolladores/sff.jpg"],
                    ["nombre" => "David Satizábal", "rol" => "Módulo de Equipos", "foto" => "vistas/img/desarrolladores/ds.jpg"],
                    ["nombre" => "Juan Sebastián Velásquez Ortiz", "rol" => "Módulo de Salidas", "foto" => "vistas/img/desarrolladores/jsvo.jpg"],
                    ["nombre" => "Jensen Ballén Banguera", "rol" => "Módulo de Solicitudes", "foto" => "vistas/img/desarrolladores/jbb.jpg"],
                    ["nombre" => "Juan Pablo Montaño Pérez", "rol" => "Módulo de Equipos", "foto" => "vistas/img/desarrolladores/jpmp.jpg"],
                    ["nombre" => "Karen Vanessa Valencia Grueso", "rol" => "Módulo de Salidas", "foto" => "vistas/img/desarrolladores/kvvg.jpg"],
                    ["nombre" => "Jhon Edison Díaz Ruiz", "rol" => "Módulo de Mantenimiento", "foto" => "vistas/img/desarrolladores/jedr.jpg"],
                    ["nombre" => "Cristian Camilo Restrepo Muriel", "rol" => "Módulo de Equipos", "foto" => "vistas/img/desarrolladores/ccrm.jpg"]
                ];

                foreach ($desarrolladores as $dev) {
                    // Verificamos si la imagen existe físicamente en el servidor
                    $rutaRelativa = $dev["foto"];
                    $rutaAbsoluta = $_SERVER["DOCUMENT_ROOT"] . "/hermesbeta/" . $dev["foto"];
                    $foto = file_exists($rutaAbsoluta) ? $rutaRelativa : "vistas/img/usuarios/default/anonymous.jpg";

                    echo '
                        <div class="col-md-4">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile text-center">
                                    <div class="developer-image-container">
                                        <img class="profile-user-img img-fluid img-circle developer-image" src="' . $foto . '" alt="Foto de ' . $dev["nombre"] . '">
                                    </div>
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