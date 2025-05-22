$(document).ready(function() {
    // Cuando se hace clic en el botón Ver
    $('.btnVerUsuario').click(function() {
        var idPrestamo = $(this).attr('data-id-reservado') || $(this).attr('data-id');
        
        // Realizar petición AJAX
        $.ajax({
            url: "ajax/devoluciones.ajax.php",
            method: "POST",
            data: {
                idPrestamo: idPrestamo
            },
            dataType: "json",
            success: function(respuesta) {
                if(respuesta) {
                    // Imagen y datos básicos del usuario
                    $('#userImage').attr('src', respuesta.foto ? respuesta.foto : 'vistas/img/usuarios/default/anonymous.png');
                    $('#userName').text(respuesta.nombre + ' ' + respuesta.apellido);
                    $('#userRol').text(respuesta.rol || 'No especificado');
                    
                    // Información del préstamo
                    $('#prestamoIdentificacion').text(respuesta.numero_documento || 'No disponible');
                    $('#prestamoNombre').text(respuesta.nombre || 'No disponible');
                    $('#prestamoApellido').text(respuesta.apellido || 'No disponible');
                    $('#prestamoTelefono').text(respuesta.telefono || 'No disponible');
                    $('#prestamoFicha').text(respuesta.ficha_codigo || 'No asignada');
                    $('#prestamoTipo').text(respuesta.tipo_prestamo || 'No especificado');
                    $('#prestamoFechaInicio').text(respuesta.fecha_inicio || 'No especificada');
                    $('#prestamoFechaFin').text(respuesta.fecha_fin || 'No especificada');
                    $('#prestamoEstado').text(respuesta.estado_prestamo || 'No especificado');
                    
                    // Información del equipo
                    $('.info-equipos').html(`
                        <tr>
                            <th style="width: 40%">Seriales:</th>
                            <td>${respuesta.series || 'No disponible'}</td>
                        </tr>
                        <tr>
                            <th>Descripciones:</th>
                            <td>${respuesta.descripciones || 'No disponible'}</td>
                        </tr>
                    `);
                    
                    $('.info-equipos-2').html(`
                        <tr>
                            <th style="width: 40%">Categorías:</th>
                            <td>${respuesta.categorias || 'No disponible'}</td>
                        </tr>
                    `);
                    
                    // Habilitar o deshabilitar el botón de devolución según el estado
                    if(respuesta.tipo_prestamo === 'Inmediato' || respuesta.tipo_prestamo === 'Reservado') {
                        $('.btn-devolver').prop('disabled', false).show();
                        $('.btn-devolver').attr('data-equipo-id', respuesta.id_prestamo);
                    } else {
                        $('.btn-devolver').prop('disabled', true).hide();
                    }
                    
                    // Limpiar el contenedor de equipos
                    $('.equipos-container').empty();
                    
                    // Crear una tabla por cada equipo
                    respuesta.equipos.forEach(function(equipo, index) {
                        var equipoHtml = `
                            <div class="card card-outline card-success mb-3">
                                <div class="card-header">
                                    <h3 class="card-title">Equipo ${index + 1}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-sm">
                                                <tbody>
                                                    <tr>
                                                        <th style="width: 40%">Serial:</th>
                                                        <td>${equipo.numero_serie || 'No disponible'}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Marca:</th>
                                                        <td>${equipo.descripcion || 'No disponible'}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-sm">
                                                <tbody>
                                                    <tr>
                                                        <th style="width: 40%">Modelo:</th>
                                                        <td>${equipo.equipo_descripcion || 'No disponible'}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Categoría:</th>
                                                        <td>${equipo.nombre_categoria || 'No disponible'}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-12 text-center mt-3">
                                            <button type="button" class="btn btn-success btn-devolver" data-equipo-id="${equipo.equipo_id}">
                                                <i class="fas fa-check-circle mr-2"></i>Marcar como Devuelto
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        $('.equipos-container').append(equipoHtml);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("Error en la petición AJAX:", error);
                alert("Error al cargar los datos del préstamo");
            }
        });
    });

    // Cuando se hace clic en el botón de devolución
    $('.btn-devolver').click(function() {
        // Por ahora, el botón no hace nada
        return false;
    });
});