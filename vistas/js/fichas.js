$(document).on("click", ".btnEditarFicha", function() {
// $(".btnEditarFicha").click(function() {
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
            // console.log("Ficha", respuesta["nom"]);
            $("#idEditFicha").val(respuesta["id_ficha"]);
            $("#editCodigoFicha").val(respuesta["codigo"]);
            $("#editDescripcionFicha").val(respuesta["descripcion"]);
            $("#editFechaInicioFicha").val(respuesta["fecha_inicio"]);
            $("#editFechaFinFicha").val(respuesta["fecha_fin"]);
            
            $("#editSedeFicha").val(respuesta["id_sede"]);
            $("#editSedeFicha").html(respuesta["nombre_sede"]);
            
        },
    });
});

$(document).on("click", ".btnActivarFicha", function() {
    var idFichaActivar = $(this).attr("idFicha");
    var estadoFicha = $(this).attr("estadoFicha");
    var datos = new FormData();
    datos.append("idFichaActivar", idFichaActivar);
    datos.append("estadoFicha", estadoFicha);
    $.ajax({
        url: "ajax/fichas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {
            console.log("cambiado el estado", respuesta);
        }
    })
    if (estadoFicha == "inactiva") {
        $(this).removeClass("btn-success");
        $(this).addClass("btn-danger");
        $(this).html('<i class="fas fa-ban">');
        $(this).attr("estadoFicha", "activa");
    }else {
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        $(this).html('<i class="fas fa-check">');
        $(this).attr("estadoFicha", "inactiva");
    }
});