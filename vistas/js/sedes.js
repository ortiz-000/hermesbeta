$(".btnEditarSede").click(function () {
    var idSede = $(this).attr("idSede");
    var datos = new FormData();
    datos.append("idSede", idSede);
    $.ajax({
        url: "ajax/sedes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log("respuesta", respuesta);
            $("#nombreEditSede").val(respuesta["nombre_sede"]);
            $("#direccionEditSede").val(respuesta["direccion"]);
            $("#descripcionEditSede").val(respuesta["descripcion"]);
            $("#idEditSede").val(respuesta["id_sede"]);
        },
    });
});

$(".btnActivarSede").click(function () {
    var idSede = $(this).attr("idSede");
    var estadoSede = $(this).attr("estadoSede");
    var datos = new FormData();
    datos.append("idEstadoSede", idSede);
    datos.append("estadoSede", estadoSede);
    $.ajax({
        url: "ajax/sedes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            console.log(respuesta);
        },
    });
    if (estadoSede == "inactivo") {
        $(this).removeClass("btn-success");
        $(this).addClass("btn-danger");
        $(this).html('<i class="fa fa-ban"></i>');
        $(this).attr("estadoSede", "activo");
    }else {
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        $(this).html('<i class="fa fa-check"></i>');
        $(this).attr("estadoSede", "inactivo");
    }
});