  $(function () {
    //Enable check and uncheck all functionality
    $('.checkbox-toggle').click(function () {
      var clicks = $(this).data('clicks')
      if (clicks) {
        //Uncheck all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
        $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
      } else {
        //Check all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
        $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
      }
      $(this).data('clicks', !clicks)
    })

    //Handle starring for font awesome
    $('.mailbox-star').click(function (e) {
      e.preventDefault()
      //detect type
      var $this = $(this).find('a > i')
      var fa    = $this.hasClass('fa')

      //Switch states
      if (fa) {
        $this.toggleClass('fa-star')
        $this.toggleClass('fa-star-o')
      }
    })

        $(function () {
        //Add text editor
        $('#compose-textarea').summernote()
    })

  })

  // ===============================
  // Funciones para manejo de notificaciones
  // ===============================

    // Actualiza los contadores de notificaciones
  function actualizarContadores() {
    $.ajax({
      url: 'ajax/notificaciones.ajax.php',
      type: 'POST',
      dataType: 'json',
      data: { accion: 'contadores' },
      success: function (response) {
        if (response.success && response.totalNotificaciones !== undefined) {
          $('#count-notificaciones').text(response.totalNotificaciones);
        }
      }
    });
  }

  $('#btn-leidos').on('click', function(e) {
    e.preventDefault();
    // Asegúrate de que el contenedor existe en el HTML
    if ($('#contenido-notificaciones').length === 0) {
      // Puedes agregarlo dinámicamente si no existe
      $('body').append('<div id="contenido-notificaciones"></div>');
    }
    $('#contenido-notificaciones').html('<div class="text-center">Cargando...</div>');
    $.ajax({
      url: 'vistas/modulos/leidos.php',
      type: 'GET',
      success: function(data) {
        $('#contenido-notificaciones').html(data);
      },
      error: function() {
        $('#contenido-notificaciones').html('<div class="text-danger">Error al cargar los leídos.</div>');
      }
    });
  });


    // Elimina una notificación individual por ID
    function eliminarNotificacion(id) {
      $.ajax({
        url: 'ajax/notificaciones.ajax.php',
        type: 'POST',
        dataType: 'json',
        data: { id: id },
        success: function (response) {
          if (response.success) {
            // Elimina el elemento del DOM
            $('#notificacion-' + id).remove();
            Swal.fire({
              icon: 'success',
              title: 'Notificación eliminada',
              showConfirmButton: false,
              timer: 1500
            });
            actualizarContadores();
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Error al eliminar la notificación: ' + response.message
            });
          }
        },
        error: function () {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al procesar la solicitud.'
          });
        }
      });
    }

    // Evento para eliminar una notificación al hacer click en el botón correspondiente
      $('.btn-delete').click(function () {
        var id = $(this).data('id');
        eliminarNotificacion(id);
      });

      // Evento para eliminar notificaciones seleccionadas por checkbox
      $('.btn-delete-selected').click(function () {
    var ids = [];
    $('.mailbox-messages input[type="checkbox"]:checked').each(function () {
      var id = $(this).val();
      if (id) ids.push(id);
    });

    if (ids.length === 0) {
      Swal.fire({
        icon: 'info',
        title: 'No hay notificaciones seleccionadas',
        showConfirmButton: false,
        timer: 1500
      });
      return;
    }

    // Petición AJAX para eliminar varias notificaciones
    $.ajax({
      url: 'ajax/notificaciones.ajax.php',
      type: 'POST',
      dataType: 'json',
      data: { ids: ids },
      success: function (response) {
        if (response.success) {
          ids.forEach(function (id) {
            $('#notificacion-' + id).remove();
          });
          Swal.fire({
            icon: 'success',
            title: 'Notificaciones eliminadas',
            showConfirmButton: false,
            timer: 1500
          });
          actualizarContadores();
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: response.message || 'Error al eliminar las notificaciones.'
          });
        }
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Error al procesar la solicitud.'
        });
      }
    });
  });

    // Evento para marcar todas las notificaciones como leídas al hacer click en el icono de campana
    $('#campana-notificaciones').on('click', function(e) {
      e.preventDefault();
      $.ajax({
        url: 'ajax/notificaciones.ajax.php',
        type: 'POST',
        dataType: 'json',
        data: { accion: 'marcar_todas_leidas' },
        success: function(response) {
          if (response.success) {
            $('#count-notificaciones').text('0');
          }
        }
      });
    });
