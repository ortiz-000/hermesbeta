window.addEventListener("load", function(){
    initializeDataTable("#tblSedes");
    initializeDataTable("#tblUsuarios");
    initializeDataTable("#tblEquipos");
    initializeDataTable("#tblTraspasos");
    initializeDataTable("#tblAutorizaciones");
    initializeDataTable("#tblInmediatas");
});

function initializeDataTable(selector){
    $(selector).DataTable({
        "responsive": true,
        "autoWidth": false,
        "lengthChange": true,
        "lengthMenu": [10, 25, 50, 100],
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultado",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(Filtrado de _MAX_ total de registros)",
            "search": "Buscar",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        "buttons": ["csv", "excel", "pdf"]
    }).buttons().container().appendTo(selector + '_wrapper .col-md-6:eq(0)');
}

