$(document).ready(function() {
    
  // Cargar datos en el modal de detalles
  $(document).on("click", ".btnVerDetalles", function(){
      var idAutorizacion = $(this).attr("data-id");
      var nombreUsuario = $(this).attr("data-usuario");
      var idPrestamo = $(this).attr("data-prestamo");
      var emailUsuario = $(this).attr("data-email");
      var idUsuario = $(this).attr("data-idusuario");
      
      $("#idAutorizacion").val(idAutorizacion);
      $("#nombreUsuario").val(nombreUsuario);
      $("#idPrestamo").val(idPrestamo);
      $("#emailUsuario").val(emailUsuario);
      $("#mostrarEmailUsuario").val(emailUsuario);
      $("#idUsuario").val(idUsuario);
  });

  // Manejar autorización
  $(".btnAutorizar").click(function(){
      var idAutorizacion = $("#idAutorizacion").val();
      var idPrestamo = $("#idPrestamo").val();
      
      Swal.fire({
          title: '¿Autorizar préstamo?',
          text: "¿Estás seguro de autorizar este préstamo?",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#28a745',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Sí, autorizar',
          cancelButtonText: 'Cancelar'
      }).then((result) => {
          if (result.isConfirmed) {
              var datos = new FormData();
              datos.append("idAutorizacion", idAutorizacion);
              datos.append("idPrestamo", idPrestamo);
              datos.append("estado", "autorizado");
              
              $.ajax({
                  url: "ajax/autorizaciones.ajax.php",
                  method: "POST",
                  data: datos,
                  cache: false,
                  contentType: false,
                  processData: false,
                  beforeSend: function() {
                      Swal.showLoading();
                  },
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
                      } else {
                          Swal.fire({
                              icon: 'error',
                              title: 'Error',
                              text: 'Ocurrió un error al autorizar: ' + respuesta
                          });
                      }
                  },
                  error: function(xhr, status, error) {
                      Swal.fire({
                          icon: 'error',
                          title: 'Error',
                          text: 'Error en la solicitud: ' + error
                      });
                  }
              });
          }
      });
  });
  
  // Manejar botón Rechazar (abre modal de confirmación con correo)
  $(".btnRechazar").click(function(){
      // Obtener los datos de la modal de detalles
      var idAutorizacion = $("#idAutorizacion").val();
      var nombreUsuario = $("#nombreUsuario").val();
      var emailUsuario = $("#emailUsuario").val();
      var idUsuario = $("#idUsuario").val();
      var idPrestamo = $("#idPrestamo").val();
      var motivoRechazo = $("#motivoRechazo").val();
      
      // Llenar la modal de rechazo con correo
      $("#idAutorizacionCorreo").val(idAutorizacion);
      $("#nombreUsuarioCorreo").val(nombreUsuario);
      $("#emailMostrarCorreo").val(emailUsuario);
      $("#emailUsuarioCorreo").val(emailUsuario);
      $("#idUsuarioCorreo").val(idUsuario);
      $("#idPrestamoCorreo").val(idPrestamo);
      $("#motivoRechazoCorreo").val(motivoRechazo);
      
      // Cerrar la modal de detalles y abrir la de rechazo con correo
      $("#modalDetalles").modal("hide");
      $("#modalRechazoCorreo").modal("show");
  });
  
  // Manejar envío de rechazo con correo
  $("#formRechazoCorreo").submit(function(e){
      e.preventDefault();
      
      Swal.fire({
          title: '¿Rechazar préstamo?',
          text: "Se enviará una notificación al usuario por correo electrónico",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Sí, rechazar y notificar',
          cancelButtonText: 'Cancelar'
      }).then((result) => {
          if (result.isConfirmed) {
              var datos = new FormData(this);
              datos.append("estado", "rechazado");
              
              $.ajax({
                  url: "ajax/autorizaciones.ajax.php",
                  method: "POST",
                  data: datos,
                  cache: false,
                  contentType: false,
                  processData: false,
                  beforeSend: function() {
                      Swal.showLoading();
                  },
                  success: function(respuesta){
                      if(respuesta == "ok"){
                          Swal.fire({
                              icon: 'success',
                              title: 'Préstamo rechazado',
                              text: 'El usuario ha sido notificado por correo',
                              showConfirmButton: false,
                              timer: 1500
                          }).then(function(){
                              window.location = "autorizaciones";
                          });
                      } else {
                          Swal.fire({
                              icon: 'error',
                              title: 'Error',
                              text: 'Ocurrió un error al rechazar: ' + respuesta
                          });
                      }
                  },
                  error: function(xhr, status, error) {
                      Swal.fire({
                          icon: 'error',
                          title: 'Error',
                          text: 'Error en la solicitud: ' + error
                      });
                  }
              });
          }
      });
  });
  
  // Opcional: Cargar motivo de rechazo si existe al abrir el modal
  $('#modalDetalles').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var motivoRechazo = button.data('motivo') || '';
      $('#motivoRechazo').val(motivoRechazo);
  });
});

$(document).ready(function() {
  // Configurar Toastr
  toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "timeOut": "5000"
  };

  // Manejar el clic en el botón Ver Detalles
  $('.btnVerDetalles').on('click', function() {
    var idAutorizacion = $(this).data('id');
    var nombreUsuario = $(this).data('usuario');
    var emailUsuario = $(this).data('email');
    
    $('#idAutorizacion').val(idAutorizacion);
    $('#nombreUsuario').val(nombreUsuario);
    $('#emailUsuario').val(emailUsuario);
  });

  // Manejar el clic en el botón Rechazar
  $(document).on('click', '.btnRechazar', function(e) {
    e.preventDefault();
    
    // Obtener datos del formulario
    var idAutorizacion = $('#idAutorizacion').val();
    var emailUsuario = $('#emailUsuario').val();
    
    // Validar que se haya seleccionado una autorización
    if(!idAutorizacion) {
      toastr.error('No se ha seleccionado ninguna autorización');
      return;
    }
    
    // Llenar los campos del modal de rechazo
    $('#idAutorizacionCorreo').val(idAutorizacion);
    $('#emailUsuarioCorreo').val(emailUsuario);
    
    // Mostrar el modal de rechazo con correo
    $('#modalDetalles').modal('hide');
    $('#modalRechazoCorreo').modal('show');
  });
  
  // Configurar validación del formulario de rechazo
  $("#formRechazoCorreo").validate({
    rules: {
      motivoRechazoCorreo: "required",
      mensajeCorreo: "required"
    },
    messages: {
      motivoRechazoCorreo: "Por favor ingrese el motivo de rechazo",
      mensajeCorreo: "Por favor ingrese un mensaje para el cliente"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    },
    submitHandler: function(form) {
      enviarRechazo();
    }
  });
  
  // Función para enviar el rechazo por correo
  function enviarRechazo() {
    var formData = $('#formRechazoCorreo').serialize();
    
    $.ajax({
      url: 'procesar_rechazo.php',
      type: 'POST',
      data: formData,
      beforeSend: function() {
        $('#modalRechazoCorreo').find('button[type="submit"]').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Enviando...');
      },
      success: function(response) {
        try {
          var res = JSON.parse(response);
          if(res.status == 'success') {
            toastr.success(res.message);
            $('#modalRechazoCorreo').modal('hide');
            // Recargar la tabla después de 1.5 segundos
            setTimeout(function() {
              location.reload();
            }, 1500);
          } else {
            toastr.error(res.message);
          }
        } catch(e) {
          toastr.error('Error al procesar la respuesta del servidor');
        }
      },
      error: function(xhr, status, error) {
        toastr.error('Error al enviar el rechazo: ' + error);
      },
      complete: function() {
        $('#modalRechazoCorreo').find('button[type="submit"]').prop('disabled', false).html('Enviar Rechazo por Correo');
      }
    });
  }
  
  // Manejar el clic en el botón Autorizar
  $(document).on('click', '.btnAutorizar', function() {
    var idAutorizacion = $('#idAutorizacion').val();
    
    if(!idAutorizacion) {
      toastr.error('No se ha seleccionado ninguna autorización');
      return;
    }
    
    Swal.fire({
      title: '¿Autorizar préstamo?',
      text: "¿Estás seguro de que deseas autorizar este préstamo?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, autorizar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: 'procesar_autorizacion.php',
          type: 'POST',
          data: {idAutorizacion: idAutorizacion},
          beforeSend: function() {
            $('.btnAutorizar').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Procesando...');
          },
          success: function(response) {
            try {
              var res = JSON.parse(response);
              if(res.status == 'success') {
                toastr.success(res.message);
                $('#modalDetalles').modal('hide');
                // Recargar la tabla después de 1.5 segundos
                setTimeout(function() {
                  location.reload();
                }, 1500);
              } else {
                toastr.error(res.message);
              }
            } catch(e) {
              toastr.error('Error al procesar la respuesta del servidor');
            }
          },
          error: function(xhr, status, error) {
            toastr.error('Error al autorizar: ' + error);
          },
          complete: function() {
            $('.btnAutorizar').prop('disabled', false).html('Autorizar');
          }
        });
      }
    });
  });
});

$(document).ready(function() {
  // Manejar el clic en el botón Ver Detalles
  $('.btnVerDetalles').on('click', function() {
    var idAutorizacion = $(this).data('id');
    var nombreUsuario = $(this).data('usuario');
    
    $('#idAutorizacion').val(idAutorizacion);
    $('#nombreUsuario').val(nombreUsuario);
    $('#motivoRechazo').val(''); // Limpiar el campo de motivo al mostrar
  });

  // Manejar el clic en el botón Autorizar
  $(document).on('click', '.btnAutorizar', function() {
    var idAutorizacion = $('#idAutorizacion').val();
    
    if(!idAutorizacion) {
      Swal.fire('Error', 'No se ha seleccionado ninguna autorización', 'error');
      return;
    }
    
    Swal.fire({
      title: '¿Autorizar préstamo?',
      text: "¿Estás seguro de que deseas autorizar este préstamo?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, autorizar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: 'procesar_autorizacion.php',
          type: 'POST',
          data: {
            idAutorizacion: idAutorizacion,
            accion: 'autorizar'
          },
          beforeSend: function() {
            $('.btnAutorizar').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Procesando...');
          },
          success: function(response) {
            try {
              var res = JSON.parse(response);
              if(res.status == 'success') {
                Swal.fire('Éxito', res.message, 'success');
                $('#modalDetalles').modal('hide');
                setTimeout(function() {
                  location.reload();
                }, 1500);
              } else {
                Swal.fire('Error', res.message, 'error');
              }
            } catch(e) {
              Swal.fire('Error', 'Error al procesar la respuesta del servidor', 'error');
            }
          },
          error: function(xhr, status, error) {
            Swal.fire('Error', 'Error al autorizar: ' + error, 'error');
          },
          complete: function() {
            $('.btnAutorizar').prop('disabled', false).html('Autorizar');
          }
        });
      }
    });
  });
  
  // Manejar el clic en el botón Rechazar
  $(document).on('click', '.btnRechazar', function() {
    var idAutorizacion = $('#idAutorizacion').val();
    var motivoRechazo = $('#motivoRechazo').val();
    
    if(!idAutorizacion) {
      Swal.fire('Error', 'No se ha seleccionado ninguna autorización', 'error');
      return;
    }
    
    Swal.fire({
      title: '¿Rechazar préstamo?',
      html: '¿Estás seguro de que deseas rechazar este préstamo?<br>' + 
            (motivoRechazo ? '<br><strong>Motivo:</strong> ' + motivoRechazo : ''),
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Sí, rechazar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: 'procesar_autorizacion.php',
          type: 'POST',
          data: {
            idAutorizacion: idAutorizacion,
            accion: 'rechazar',
            motivoRechazo: motivoRechazo
          },
          beforeSend: function() {
            $('.btnRechazar').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Procesando...');
          },
          success: function(response) {
            try {
              var res = JSON.parse(response);
              if(res.status == 'success') {
                Swal.fire('Éxito', res.message, 'success');
                $('#modalDetalles').modal('hide');
                setTimeout(function() {
                  location.reload();
                }, 1500);
              } else {
                Swal.fire('Error', res.message, 'error');
              }
            } catch(e) {
              Swal.fire('Error', 'Error al procesar la respuesta del servidor', 'error');
            }
          },
          error: function(xhr, status, error) {
            Swal.fire('Error', 'Error al rechazar: ' + error, 'error');
          },
          complete: function() {
            $('.btnRechazar').prop('disabled', false).html('Rechazar');
          }
        });
      }
    });
  });
});