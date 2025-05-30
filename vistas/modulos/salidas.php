<!-- Content Wrapper. Contains page content --> 
<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Salidas</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="tblSedes" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Préstamo</th>
                                        <th>Usuario</th>
                                        <th>Tipo de Préstamo</th>
                                        <th>Estado De Préstamo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $item = null;
                                    $valor = null;
                                    $salidas = Controladorsalidas::ctrMostrarsalidas($item, $valor);

                                    foreach ($salidas as $key => $value) {
                                        echo '<tr>
                                            <td>' . $value["id_prestamo"] . '</td>
                                            <td>' . $value["nombre"] . '</td>
                                            <td>' . $value["tipo_prestamo"] . '</td>
                                            <td>' . $value["estado_prestamo"] . '</td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-start gap-2">
                                                    <div class="form-check form-check-inline m-0">
                                                        <input class="form-check-input" type="checkbox" id="check1_' . $value["id_prestamo"] . '">
                                                    </div>
                                                    <div class="form-check form-check-inline m-0">
                                                        <input class="form-check-input" type="checkbox" id="check2_' . $value["id_prestamo"] . '">
                                                    </div>
                                                    <div class="form-check form-check-inline m-0">
                                                        <input class="form-check-input" type="checkbox" id="check3_' . $value["id_prestamo"] . '">
                                                    </div>
                                                    <button class="btn btn-info btn-sm btnVerDetalles ml-2"
                                                        data-toggle="modal"
                                                        data-target="#modalDetallesPrestamo"
                                                        data-id="' . $value["id_prestamo"] . '"
                                                        data-usuario="' . $value["nombre"] . '"
                                                        data-tipo="' . $value["tipo_prestamo"] . '"
                                                        data-estado="' . $value["estado_prestamo"] . '"
                                                        data-fechainicio="' . $value["fecha_inicio"] . '">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal para prestamos -->
<div class="modal fade" id="modalDetallesPrestamo" tabindex="-1" role="dialog" aria-labelledby="modalDetallesLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalDetallesLabel">
                    <i class="fas fa-clipboard-list mr-2"></i>Detalles del Préstamo 
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!-- Tabla de equipos solicitados -->
                <div class="card card-outline card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-laptop-code mr-1"></i>Equipos Solicitados
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Categoría</th>
                                        <th>Equipo</th>
                                        <th>Etiqueta</th>
                                        <th>Serial</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Datos serán llenados por AJAX -->
                                </tbody>
                            </table>                       
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-success" onclick="mostrarAlertaExito()">
                    <i class="fas fa-check mr-1"></i>ACEPTAR
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Script AJAX para cargar datos de equipos -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btnVerDetalles").forEach(boton => {
        boton.addEventListener("click", function () {
            const idPrestamo = this.getAttribute("data-id");

            fetch("ajax/salidas.ajax.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: "id_prestamo=" + encodeURIComponent(idPrestamo)
            })
            .then(response => response.json())
            .then(data => {
                const tablaDetalles = document.querySelector("#modalDetallesPrestamo tbody");
                tablaDetalles.innerHTML = "";

                if (data.length === 0) {
                    tablaDetalles.innerHTML = `<tr><td colspan="4" class="text-center">No hay equipos para este préstamo</td></tr>`;
                    return;
                }

                data.forEach(item => {
                    tablaDetalles.innerHTML += `
                        <tr>
                            <td>${item.categoria}</td>
                            <td>${item.equipo}</td>
                            <td>${item.etiqueta}</td>
                            <td>${item.serial}</td>
                        </tr>
                    `;
                });
            });
        });
    });
});
</script>

<!-- SweetAlert2 -->
<script>
function mostrarAlertaExito() {
    $('#modalDetallesPrestamo').modal('hide');
    Swal.fire({
        icon: 'success',
        title: '¡Equipo prestado!',
        text: 'El préstamo fue registrado correctamente.',
        confirmButtonColor: '#6c63ff',
        confirmButtonText: 'Cerrar',
        timer: 1000,
        timerProgressBar: true,
        showConfirmButton: true
    });
}
</script>

<!-- Estilo opcional para agrandar checkboxes -->
<style>
.form-check-input {
    transform: scale(1.2);
}
</style>
