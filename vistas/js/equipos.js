/* ==================================================
BOTÓN PARA EDITAR EQUIPOS
================================================== */
var idEquipoTraspaso;

// Escuchamos el evento "click" sobre cualquier botón con clase "btnEditarEquipo"
$(document).on("click", ".btnEditarEquipo", function() {
    var idEquipo = $(this).attr("idEquipo");
    console.log("IdEquipo: ", idEquipo);
    $("#idEditEquipo").val(idEquipo);
    
    var datos = new FormData();
    datos.append("idEquipo", idEquipo);

    $.ajax({
        url: "ajax/equipos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            console.log("Respuesta completa del servidor:", respuesta);
            
            try {
                // Verificar si la respuesta es null o undefined
                if (!respuesta) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Error: No se recibieron datos del servidor',
                        position: "bottom-center"
                    });
                    return;
                }

                // Verificar que los campos necesarios existan
                if (!respuesta.hasOwnProperty("equipo_id") || 
                    !respuesta.hasOwnProperty("etiqueta") || 
                    !respuesta.hasOwnProperty("descripcion") || 
                    !respuesta.hasOwnProperty("categoria_id") || 
                    !respuesta.hasOwnProperty("id_estado")) {
                    
                    Toast.fire({
                        icon: 'error',
                        title: 'Error: Datos incompletos del servidor',
                        position: "bottom-center"
                    });
                    console.error("Campos faltantes en la respuesta:", respuesta);
                    return;
                }

                // Si todo está bien, actualizar los campos
                $("#idEditEquipo").val(respuesta["equipo_id"]);
                $("#etiquetaEdit").val(respuesta["etiqueta"]);
                $("#descripcionEdit").val(respuesta["descripcion"]);
                $("#categoriaEditId").val(respuesta["categoria_id"]);
                $("#estadoEdit").val(respuesta["id_estado"]);
                
            } catch(e) {
                console.error("Error al procesar la respuesta:", e);
                Toast.fire({
                    icon: 'error',
                    title: 'Error al procesar los datos recibidos',
                    position: "bottom-center"
                });
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la petición AJAX:");
            console.error("Status:", status);
            console.error("Error:", error);
            console.error("Respuesta del servidor:", xhr.responseText);
            
            Toast.fire({
                icon: 'error',
                title: 'Error en la comunicación con el servidor',
                position: "bottom-center"
            });
        }
    });
});

/* ==================================================
BOTÓN PARA INSERTAR EL CUENTADANTE Y UBICACIÓN ACTUAL
================================================== */

$(document).on("click", ".btnTraspasarEquipo", function(){
    idEquipoTraspaso = $(this).attr("idEquipoTraspaso");
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
    console.log("Id equipo traspaso: ", idEquipoTraspaso);

    $("#cuentadanteDestino").val("");
    $("#ubicacionTraspaso").val("");

    var buscarDocumentoId = $("#buscarDocumentoId").val();
    let datos = new FormData();

    datos.append("buscarDocumentoId", buscarDocumentoId);
    if (buscarDocumentoId === ""){
        Toast.fire({
            icon: 'info',
            title: 'Por favor ingrese un documento a buscar',
            position: "bottom-center"
        })
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
                console.log("cuentadante id: ", resultado["id_usuario"]);
                if(docIngresado != docEncontrado){
                    Toast.fire({
                        icon: 'error',
                        title: 'No se encontró el documento del cuentadante',
                        position: "bottom-center"
                    })
                    $("#buscarDocumentoId").val("");
                } else {
                    console.log("id_usuario: ", resultado["id_usuario"]);
                    // $("#cuentadanteDestino").val(resultado["cuentadante_nombre"]);
                    // $("#ubicacionTraspaso").val(resultado["ubicacion_nombre"]);
                    $("#idTraspasoEquipo").val(idEquipoTraspaso);
                    console.log("ESTE ES EL EQUIPO ID AL CUAL VOY A PASAR: ", idEquipoTraspaso);
                    $("#cuentadanteDestinoId").val(resultado["id_usuario"]);
                    $("#cuentadanteDestino").val(resultado["id_usuario"] + " " + resultado["cuentadante_nombre"]);
                    $("#ubicacionTraspaso").val(resultado["ubicacion_id"] + " " + resultado["ubicacion_nombre"]);
                }
            }
        });
    }
});
