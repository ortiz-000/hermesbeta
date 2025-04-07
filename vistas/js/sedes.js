$(document).on("click", ".btnEditarSede", function(){
    var idSede = $(this).attr("idSede");
    //console.log("idSede: ", idSede); //Bloque de código para capturar el atributo id de sedes.php

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
        success: function(respuesta){
            console.log("Respuesta: ", respuesta);
            $("#nombreEditSede").val(respuesta["nombre_sede"]);
            $("#direccionEditSede").val(respuesta["direccion"]);
            $("#descripcionEditSede").val(respuesta["descripcion"]);
            $("#idEditSede").val(respuesta["id_sede"]);
        }
    })
}); 


