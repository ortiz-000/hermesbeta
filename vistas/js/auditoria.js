let tablaAuditoria;

function inicializarTablaAuditoria(idUsuario = null) {
  let url = "ajax/auditoria.ajax.php";
  if (idUsuario) {
    url += "?id_usuario=" + idUsuario;
  }

  tablaAuditoria = $('#tablaAuditoria').DataTable({
    ajax: {
      url: url,
      dataSrc: "data"
    },
    columns: [
      { data: "tipo_documento", title: "Tipo Doc." },
      { data: "numero_documento", title: "Número Doc." },
      { data: "nombre", title: "Nombre" },
      { data: "apellido", title: "Apellido" },
      { data: "nombre_editor", title: "Editado Por" },
      { data: "fecha_cambio", title: "Fecha de Cambio" },
      {
        data: null,
        title: "Detalle",
        orderable: false,
        render: function (data, type, row) {
          return `
            <button class="btn btn-primary btn-sm verDetalle" 
              data-campos="${row.campo_modificado}" 
              data-anteriores="${row.valor_anterior}" 
              data-nuevos="${row.valor_nuevo}">
              <i class="fas fa-eye"></i>
            </button>
          `;
        }
      }
    ],
    responsive: true,
    dom: 'Bfrtip',
    buttons: ['csv', 'excel'],
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
    },
    order: [[5, 'desc']], // Ordenar por fecha
    pageLength: 10
  });
}

function recargarTablaAuditoria(idUsuario = null) {
  let url = "ajax/auditoria.ajax.php";
  if (idUsuario) {
    url += "?id_usuario=" + idUsuario;
  }

  if (tablaAuditoria) {
    tablaAuditoria.ajax.url(url).load();
  } else {
    inicializarTablaAuditoria(idUsuario);
  }
}

// Evento para abrir modal con detalle
$(document).on('click', '.verDetalle', function () {
  const campos = $(this).data('campos').split(';').map(c => c.trim());
  const anteriores = $(this).data('anteriores').split(';').map(a => a.trim());
  const nuevos = $(this).data('nuevos').split(';').map(n => n.trim());

  let contenido = '<table class="table table-bordered">';
  contenido += '<thead><tr><th>Campo</th><th>Valor Anterior</th><th>Valor Nuevo</th></tr></thead><tbody>';

  for (let i = 0; i < campos.length; i++) {
    contenido += `
      <tr>
        <td>${campos[i]}</td>
        <td>${anteriores[i] || ''}</td>
        <td>${nuevos[i] || ''}</td>
      </tr>
    `;
  }

  contenido += '</tbody></table>';
  $('#detalleAuditoriaBody').html(contenido);
  $('#modalDetalleAuditoria').modal('show');
});

// Inicializar tabla al cargar la página
$(document).ready(function () {
  inicializarTablaAuditoria();
});
