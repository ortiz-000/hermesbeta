$(document).ready(function() {
    // ... existing code ...

    // Cuando se hace clic en el botón Ver
    $('.btnVerUsuario').click(function() {
        var idPrestamo = $(this).attr('data-id-reservado');
        
        // Realizar petición AJAX
        $.ajax({
            url: "ajax/devoluciones.ajax.php",
            method: "POST",
            data: {
                idPrestamo: idPrestamo
            },
            dataType: "json",
            success: function(respuesta) {
                // Llenar información del usuario
                if(respuesta.foto) {
                    $('#userImage').attr('src', respuesta.foto);
                } else {
                    $('#userImage').attr('src', 'vistas/img/usuarios/default/anonymous.png');
                }
                $('#userName').text(respuesta.nombre + ' ' + respuesta.apellido);
                $('#userRol').text(respuesta.rol);
                
                // Llenar información del préstamo
                $('#prestamoIdentificacion').text(respuesta.numero_documento);
                $('#prestamoNombre').text(respuesta.nombre);
                $('#prestamoApellido').text(respuesta.apellido);
                $('#prestamoTelefono').text(respuesta.telefono);
                $('#prestamoFicha').text(respuesta.ficha_codigo || 'No asignada');
                $('#prestamoTipo').text(respuesta.tipo_prestamo);
                $('#prestamoFechaInicio').text(respuesta.fecha_inicio);
                $('#prestamoFechaFin').text(respuesta.fecha_fin);
                $('#prestamoEstado').text(respuesta.estado_prestamo);
                
                // Llenar información del equipo
                $('.info-equipos').html(`
                    <tr>
                        <th style="width: 40%">Serial:</th>
                        <td>${respuesta.serial || 'No disponible'}</td>
                    </tr>
                    <tr>
                        <th>Marca:</th>
                        <td>${respuesta.marca || 'No disponible'}</td>
                    </tr>
                `);
                
                $('.info-equipos-2').html(`
                    <tr>
                        <th style="width: 40%">Modelo:</th>
                        <td>${respuesta.modelo || 'No disponible'}</td>
                    </tr>
                    <tr>
                        <th>Categoría:</th>
                        <td>${respuesta.nombre_categoria || 'No disponible'}</td>
                    </tr>
                `);
            }
        });
    });
});