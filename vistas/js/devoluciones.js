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
                console.log("Respuesta del servidor:", respuesta);
                
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
                            <th style="width: 40%">Serial:</th>
                            <td>${respuesta.numero_serie || 'No disponible'}</td>
                        </tr>
                        <tr>
                            <th>Marca:</th>
                            <td>${respuesta.descripcion || 'No disponible'}</td>
                        </tr>
                    `);
                    
                    $('.info-equipos-2').html(`
                        <tr>
                            <th style="width: 40%">Modelo:</th>
                            <td>${respuesta.equipo_descripcion || 'No disponible'}</td>
                        </tr>
                        <tr>
                            <th>Categoría:</th>
                            <td>${respuesta.nombre_categoria || 'No disponible'}</td>
                        </tr>
                    `);
                    
                    // Habilitar o deshabilitar el botón de devolución según el estado
                    if(respuesta.tipo_prestamo === 'Inmediato' || respuesta.tipo_prestamo === 'Reservado') {
                        $('.btn-devolver').prop('disabled', false).show();
                        $('.btn-devolver').attr('data-equipo-id', respuesta.id_prestamo);
                    } else {
                        $('.btn-devolver').prop('disabled', true).hide();
                    }
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