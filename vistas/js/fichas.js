$(".btnEditarFicha").click(function() {
    var idFicha = $(this).attr("idFicha");
    var datos = new FormData();
    datos.append("idFicha", idFicha);
    $.ajax({
        url: "ajax/fichas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            console.log("respuesta", respuesta);
            $("idEditFicha").val(respuesta["id_ficha"]);
            $("#editCodigoFicha").val(respuesta["codigo"]);
            $("#editDescripcionFicha").val(respuesta["descripcion"]);
            $("#editFechaInicioFicha").val(respuesta["fecha_inicio"]);
            $("#editFechaFinFicha").val(respuesta["fecha_fin"]);
            $("#editSede").val(respuesta["id_sede"]);
        },
    });
});