/* ==================================================
BOTÓN PARA EDITAR EQUIPOS
================================================== */

// Escuchamos el evento "click" sobre cualquier botón con clase "btnEditarEquipo"
$(document).on("click", ".btnEditarEquipo", function() {
    
    // Obtenemos el valor del atributo personalizado "idEquipo" del botón que se clickeó
    var idEquipo = $(this).attr("idEquipo");
    console.log("IdEquipo: ", idEquipo); // Mostramos en consola el id para verificar

    // Creamos un nuevo objeto FormData para enviar datos tipo formulario
    var datos = new FormData();
    
    // Agregamos al FormData el id del equipo con el nombre "idEquipo"
    datos.append("idEquipo", idEquipo);

    // Hacemos una petición AJAX para traer los datos del equipo
    $.ajax({
        url: "ajax/equipos.ajax.php", // A dónde se enviarán los datos
        method: "POST",               // Tipo de método (enviamos datos)
        data: datos,                  // Datos que enviamos (el FormData)
        cache: false,                 // No queremos que se cachee la respuesta
        contentType: false,           // No configuramos el tipo de contenido (lo maneja FormData)
        processData: false,           // No procesamos los datos (lo maneja FormData)
        dataType: "json",             // Esperamos recibir un JSON como respuesta

        success: function(respuesta) {
            // Mostramos la respuesta en consola para verificar
            console.log("datos: ", respuesta);

            // Llenamos los campos del formulario del modal con los datos recibidos
            $("#idEditEquipo").val(respuesta["equipo_id"]);
            $("#numeroSerieEdit").val(respuesta["numero_serie"]);
            $("#etiquetaEdit").val(respuesta["etiqueta"]);
            $("#descripcionEdit").val(respuesta["descripcion"]);
            $("#ubicacionEdit").val(respuesta["ubicacion_id"]);
            $("#categoriaEditId").val(respuesta["categoria_id"]);
            $("#cuentadanteIdEdit").val(respuesta["id_estado"]);
        }
    });

});

/* ==================================================
BOTÓN PARA INSERTAR EL CUENTADANTE Y UBICACIÓN ACTUAL
================================================== */

$(document).on("click", ".btnTraspasarEquipo", function(){
    var idEquipoTraspaso = $(this).attr("idEquipoTraspaso");
    console.log("Id equipo traspaso: ", idEquipoTraspaso);

    var datos = new FormData();

    datos.append("idEquipoTraspaso", idEquipoTraspaso);

    $.ajax({
        url: "ajax/equipos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            try {
                // Verificamos que la respuesta sea válida
                if (respuesta) {
                    console.log("datos: ", respuesta);
                    
                    // Llenamos los campos del formulario del modal con los datos recibidos
                    $("#idEditEquipo").val(respuesta["equipo_id"]);
                    $("#cuentadanteOrigenTraspaso").val(respuesta["nombre"]);
                    $("#ubicacionOrigenTraspaso").val(respuesta["ubicacion_nombre"]);
                } else {
                    console.error("Respuesta inválida del servidor");
                    alert("Error: La respuesta del servidor no tiene el formato esperado");
                }
            } catch (e) {
                console.error("Error al procesar la respuesta:", e);
                alert("Error al procesar la respuesta del servidor");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la petición Ajax:");
            console.error("Status:", status);
            console.error("Error:", error);
            console.error("Respuesta:", xhr.responseText);
            alert("Error al comunicarse con el servidor. Por favor, intente nuevamente.");
        }
    });
});

/* ==================================================
BOTÓN PARA BUSCAR EL CUENTADANTE Y SU UBICACIÓN Y AGREGARLOS EN LOS INPUTS
================================================== */

$(document).on("click", ".btnBuscarCuentadante", function (event){
    event.preventDefault(); // Prevenir la recarga de la página
    // Limpiar los campos antes de buscar de nuevo
    $("#cuentadanteDestino").val("");
    $("#ubicacionTraspaso").val("");

    var buscarDocumentoId = $("#buscarDocumentoId").val();
    let datos = new FormData();

    datos.append("buscarDocumentoId", buscarDocumentoId);
    if (buscarDocumentoId === ""){
        alert(buscarDocumentoId);
        alert("Por favor, ingrese un número de documento para buscar");
        return;
    } else {
        $.ajax({
            url: "ajax/equipos.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(resultado){
                const docIngresado = String(buscarDocumentoId).trim();
                const docEncontrado = String(resultado["numero_documento"] || '').trim();
                console.log("Datos cuentadante: ", resultado["cuentadante_nombre"], resultado["ubicacion_nombre"], resultado["numero_documento"]);
                if(docIngresado != docEncontrado){
                    Swal.fire({
                        icon: 'error',
                        title: 'Documento no coincide',
                        text: 'El número ingresado no corresponde al documento del cuentadante',
                        confirmButtonText: 'Aceptar'
                    });
                    $("#buscarDocumentoId").val("");
                } else if (!resultado){
                    Swal.fire({
                        icon: 'error',
                        title: 'Cuentadante no asignado o no encontrado',
                        text: 'No se encontró el cuentadante',
                        confirmButtonText: 'Aceptar'
                    });
                } else {
                    console.log("Datos cuentadante: ", "nombre: ", resultado["cuentadante_nombre"], "cuentadante_id: ", resultado["cuentadante_id"], "ubicacion: ", resultado["ubicacion_nombre"], "ubicacion_id: ", resultado["ubicacion_id"], resultado["numero_documento"]);
                    $("#cuentadanteDestino").val(resultado["cuentadante_nombre"]);
                    $("#ubicacionTraspaso").val(resultado["ubicacion_nombre"]);
                    $("#cuentadanteDestino").val(resultado["cuentadante_id"]);
                    $("#ubicacionTraspaso").val(resultado["ubicacion_id"]);
                }
            }
        });
    }
});
