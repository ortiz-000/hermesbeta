$(document).ready(function() {
    // Inicializar DataTable
    $().DataTable({
        "responsive": true,
        "autoWidth": false,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sSearch":         "Buscar:",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            }
        }
    });

    // Manejar clic en botón de ver objetos
    $(document).on('click', '.btnVerObjetos', function() {
        var objetos = JSON.parse($(this).data('objetos'));
        var usuario = $(this).data('usuario');
        var fecha = $(this).data('fecha');
        
        // Actualizar información en la modal
        $('#modalUsuario').text(usuario);
        $('#modalFechaSolicitud').text(fecha);
        
        // Limpiar y llenar la tabla
        $('#tablaObjetos').empty();
        objetos.forEach(function(objeto) {
            $('#tablaObjetos').append(`
                <tr>
                    <td>#${objeto.numero_serie}</td>
                    <td>${objeto.tipo}</td>
                    <td>${objeto.estado || 'Prestado'}</td>
                </tr>
            `);
        });
    });
});