let tablaAuditoria;

$(document).ready(function () {
  tablaAuditoria = $('#tablaAuditoria').DataTable({
    ajax: {
      url: "ajax/auditoria.ajax.php",
      dataSrc: "data"
    },

    columns: [
      { data: "id_usuario", title: "ID Usuario" },
      { data: "tipo_documento", title: "Tipo Doc." },
      { data: "numero_documento", title: "Número Doc." },
      { data: "nombre", title: "Nombre" },
      { data: "apellido", title: "Apellido" },
      {
        data: "nombre_editor",
        title: "Editado Por",
        render: function (data) {
          return data && data.trim() !== '' ? data : 'Sistema';
        }
      },
      {
        data: "campo_modificado",
        title: "Campos Modificados",
        render: function (data) {
          return Array.isArray(data) ? data.join(", ") : data;
        }
      },
      {
        data: "valor_anterior",
        title: "Valores Anteriores",
        render: function (data) {
          return Array.isArray(data) ? data.map(v => v || '-').join(", ") : (data || '-');
        }
      },
      {
        data: "valor_nuevo",
        title: "Valores Nuevos",
        render: function (data) {
          return Array.isArray(data) ? data.map(v => v || '-').join(", ") : (data || '-');
        }
      },
      { data: "fecha_cambio", title: "Fecha Cambio" }
    ],

    responsive: true,
    dom: 'Bfrtip',
    buttons: ['csv', 'excel'],

    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
    },

    order: [[9, 'desc']], // ahora la columna "fecha_cambio" está en el índice 9
    pageLength: 10
  });
});

function recargarTablaAuditoria() {
  if (tablaAuditoria) {
    tablaAuditoria.ajax.reload(null, false);
  }
}
