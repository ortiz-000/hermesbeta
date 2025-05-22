$(document).ready(function() {
    // Cuando se hace clic en el botón Ver
    $('.btnVerUsuario').click(function() {
        // Usamos data-id para ambos tipos de préstamo ahora
        var idPrestamo = $(this).attr('data-id');

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

                    // Información del equipo (usando GROUP_CONCAT)
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
                        <tr>
                            <th>Etiquetas:</th>
                            <td>${respuesta.etiqueta || 'No disponible'}</td>
                        </tr>
                    `);

                    // Lógica para mostrar los botones de devolución según el tipo de préstamo
                    var buttonsHtml = '';
                    if (respuesta.tipo_prestamo === 'Inmediato') {
                        buttonsHtml = `
                            <button type="button" class="btn btn-success btn-devolver mr-2" data-prestamo-id="${respuesta.id_prestamo}" data-estado="buen_estado">
                                <i class="fas fa-check-circle mr-2"></i>Equipo en Buen Estado
                            </button>
                            <button type="button" class="btn btn-danger btn-devolver" data-prestamo-id="${respuesta.id_prestamo}" data-estado="mal_estado">
                                <i class="fas fa-times-circle mr-2"></i>Equipo en Mal Estado
                            </button>
                        `;
                    } else if (respuesta.tipo_prestamo === 'Reservado') {
                        buttonsHtml = `
                            <button type="button" class="btn btn-success btn-devolver" data-prestamo-id="${respuesta.id_prestamo}" data-estado="devuelto">
                                <i class="fas fa-check-circle mr-2"></i>Marcar como Devuelto
                            </button>
                        `;
                    }
                    $('#devolucionButtonsContainer').html(buttonsHtml); // Insertar los botones en el contenedor

                    // Mostrar la modal consolidada
                    $('#modalVerDetallesPrestamo').modal('show');

                } else {
                    alert("No se encontraron datos para este préstamo.");
                }
            },
            error: function(xhr, status, error) {
                console.error("Error en la petición AJAX:", error);
                alert("Error al cargar los datos del préstamo");
            }
        });
    });

    // Cuando se hace clic en los botones de devolución (delegación de eventos)
    // Usamos delegación porque los botones se añaden dinámicamente
    $(document).on('click', '#devolucionButtonsContainer .btn-devolver', function() {
        var prestamoId = $(this).attr('data-prestamo-id');
        var estado = $(this).attr('data-estado'); // 'buen_estado', 'mal_estado', 'devuelto'

        console.log("Botón de devolución clickeado:");
        console.log("ID del Préstamo:", prestamoId);
        console.log("Estado:", estado);

        // Lógica para mostrar la modal si el estado es 'mal_estado'
        if (estado === 'mal_estado') {
            // Guardar el ID del préstamo en la modal para usarlo después
            $('#malEstadoPrestamoId').val(prestamoId);
            // Aquí podrías necesitar obtener y guardar el ID del equipo específico si el préstamo tiene varios
            // Por ahora, asumimos que la lógica de backend manejará los equipos asociados a este préstamo
            $('#modalMalEstado').modal('show');
        } else {
            // Por ahora, solo mostramos en consola para 'buen_estado' y 'devuelto'.
            // La funcionalidad de devolución/cambio de estado se implementará más adelante.
            // Aquí iría la llamada AJAX para procesar la devolución en buen estado o la reserva devuelta
            console.log("Procesando devolución en buen estado o reserva devuelta...");
        }


        // Evitar que el botón realice su acción por defecto (si la tuviera)
        return false;
    });

    // Evento para el botón "Guardar Motivo y Enviar a Mantenimiento" dentro de la modal
    $(document).on('click', '#btnGuardarMalEstado', function() {
        var prestamoId = $('#malEstadoPrestamoId').val();
        var motivo = $('#motivoMalEstado').val();

        if (motivo.trim() === '') {
            alert('Por favor, ingrese el motivo del mal estado.');
            return;
        }

        console.log("Guardando motivo de mal estado:");
        console.log("ID del Préstamo:", prestamoId);
        console.log("Motivo:", motivo);

        // Aquí iría la llamada AJAX para enviar el ID del préstamo y el motivo al backend.
        // El backend se encargaría de actualizar el estado del/los equipo/s a 'Mantenimiento',
        // insertar el registro en la tabla 'mantenimiento' con el motivo,
        // y actualizar el estado del préstamo si todos los equipos han sido procesados.
        // Esta lógica de backend es donde se simularía o se usaría el trigger.

        // Por ahora, solo cerramos la modal y limpiamos el formulario
        // sin enviar datos al backend, como solicitaste.
        $('#modalMalEstado').modal('hide');
        $('#formMalEstado')[0].reset(); // Limpiar el formulario
    });
});