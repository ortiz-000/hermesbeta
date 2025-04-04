$(document).on("change", "#selectRol" , function() {
    var idRol = $(this).val();
    console.log(idRol);
    // si el rol es aprendiz, mostrar los inputs de ficha y sede
    if (idRol == 6) {
        $("#sede").removeClass("d-none");
        $("#selectSede").prop("required", true);
        $("#id_ficha").prop("required", true);
        // $("#ficha").removeClass("d-none");
    }
    else {
        $("#sede").addClass("d-none");
        $("#selectSede").removeAttr("required");
        $("#id_ficha").removeAttr("required");
        
        // $("#ficha").addClass("d-none");
    }
});

$(document).on("change", "#selectSede", function() {
    var idSede = $(this).val();
    console.log("Sede seleccionada:", idSede);

    // Verifica si se seleccionó una sede válida
    if (!idSede) {
        console.warn("No se seleccionó una sede válida.");
        $("#id_ficha").empty().append('<option value="">Seleccione una ficha</option>');
        $("#ficha").addClass("d-none");
        return;
    }

    var datos = new FormData();
    datos.append("idSede", idSede);

    // Realiza una petición AJAX para obtener las fichas de la sede seleccionada
    $.ajax({
        url: "ajax/fichas.ajax.php", // Archivo PHP que devolverá las fichas
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            console.log("Fichas obtenidas:", respuesta);

            // Limpia las opciones del select de ficha
            var fichaSelect = $("#id_ficha");
            fichaSelect.empty();
            console.log("registros: ",respuesta[0]);

            if (respuesta.length > 1) {
                fichaSelect.append('<option value="">Ficha</option>');
                // Agrega las nuevas opciones al select de ficha
                respuesta.forEach(function(ficha) {
                    fichaSelect.append('<option value="' + ficha.id_ficha + '">' + ficha.codigo + '</option>');
                });
                $("#ficha").removeClass("d-none");
            }else if (respuesta.length == 0) {
                console.warn("No se encontraron fichas para la sede seleccionada.");
                fichaSelect.append('<option value="">No hay fichas disponibles</option>');
                $("#ficha").addClass("d-none");
            }else {
                console.log("Ficha única encontrada:", respuesta[0]);
                fichaSelect.append('<option value="' + respuesta["id_ficha"] + '">' + respuesta["codigo"] + '</option>');
                $("#ficha").removeClass("d-none");
            }

        },
        error: function(error) {
            console.error("Error al obtener las fichas:", error);
            // Manejo de error: Limpia el select y oculta el contenedor
            $("#id_ficha").empty().append('<option value="">Error al cargar fichas</option>');
            $("#ficha").addClass("d-none");
        }
    });
});

$(document).on("change", "#id_ficha", function() {
    var idFicha = $(this).val();
    console.log("Ficha seleccionada:", idFicha);
    data = new FormData();
    data.append("idFicha", idFicha);
    // Realiza una petición AJAX para obtener los datos de la ficha seleccionada
    $.ajax({
        url: "ajax/fichas.ajax.php", // Archivo PHP que devolverá los datos de la ficha
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            console.log("Datos de la ficha:", respuesta);
            $("#nombre_programa").prop("placeholder", respuesta["descripcion"]);
            // Aquí puedes realizar cualquier acción adicional que necesites con los datos de la ficha
        },
        error: function(error) {
            console.error("Error al obtener los datos de la ficha:", error);
            // Manejo de error
        }
    });
 

    // Aquí puedes realizar cualquier acción adicional que necesites con la ficha seleccionada
})


