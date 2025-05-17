$(document).ready(function() {
    
    // Cargar datos en el modal
    $(document).on("click", ".btnVerDetalles", function(){
      var idAutorizacion = $(this).attr("data-id");
      var nombreUsuario = $(this).attr("data-usuario");
      
      $("#idAutorizacion").val(idAutorizacion);
      $("#nombreUsuario").val(nombreUsuario);
    });
  
    // Manejar autorización
    $(".btnAutorizar").click(function(){
      var idAutorizacion = $("#idAutorizacion").val();
      
      var datos = new FormData();
      datos.append("idAutorizacion", idAutorizacion);
      datos.append("estado", "autorizado");
      
      $.ajax({
        url: "ajax/autorizaciones.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
          if(respuesta == "ok"){
            Swal.fire({
              icon: 'success',
              title: 'La autorización ha sido aprobada',
              showConfirmButton: false,
              timer: 1500
            }).then(function(){
              window.location = "autorizaciones";
            });
          }
        }
      });
    });
  });