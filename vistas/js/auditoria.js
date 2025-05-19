let tablaAuditoria;

$(document).ready(function () {
  // Inicializamos la tabla una sola vez
  tablaAuditoria = $('#tablaAuditoria').DataTable({
    ajax: "ajax/auditoria.ajax.php",
    columns: [
      { data: "id_usuario", title: "ID Usuario" },
      { data: "tipo_documento", title: "Tipo Doc." },
      { data: "numero_documento", title: "Número Doc." },
      { data: "nombre", title: "Nombre" },
      { data: "apellido", title: "Apellido" },
      { data: "correo_electronico", title: "Correo" },
      { data: "nombre_usuario", title: "Usuario" },
      { data: "telefono", title: "Teléfono" },
      { data: "direccion", title: "Dirección" },
      { data: "genero", title: "Género" },
      {
        data: "foto",
        title: "Foto",
        render: function (data) {
          return data ? '<img src="uploads/' + data + '" style="width:40px;height:40px;border-radius:50%">' : 'Sin foto';
        }
      },
      { data: "estado", title: "Estado" },
      { data: "condicion", title: "Condición" },
      { data: "fecha_registro", title: "Fecha Registro" },
      { data: "nombre_editor", title: "Editado Por" },
      { data: "campo_modificado", title: "Campo Modificado" },
      { data: "valor_anterior", title: "Valor Anterior" },
      { data: "valor_nuevo", title: "Valor Nuevo" },
      { data: "fecha_cambio", title: "Fecha Cambio" }
    ],
    responsive: true,
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    language: {
      url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
    }
  });
});

// Función para recargar datos sin reinicializar la tabla
function recargarTablaAuditoria() {
  tablaAuditoria.ajax.reload(null, false); // false para mantener la paginación actual
}
