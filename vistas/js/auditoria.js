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
      { data: "correo_electronico", title: "Correo" },
      { data: "nombre_usuario", title: "Usuario" },
      { data: "telefono", title: "Teléfono" },
      { data: "direccion", title: "Dirección" },
      { data: "genero", title: "Género" },
      {
        data: "foto",
        title: "Foto",
        render: function (data) {
          if (data && data.trim() !== "") {
            return `<img src="uploads/${data}" style="width:40px;height:40px;border-radius:50%" alt="Foto Usuario">`;
          }
          return 'Sin foto';
        }
      },
      { data: "estado", title: "Estado" },
      { data: "condicion", title: "Condición" },
      { data: "fecha_registro", title: "Fecha Registro" },
      {
        data: "nombre_editor",
        title: "Editado Por",
        render: function(data) {
          return data && data.trim() !== '' ? data : 'Sistema';
        }
      },
      {
        data: "campo_modificado",
        title: "Campos Modificados",
        render: function(data) {
          if (Array.isArray(data)) {
            return data.join(", ");
          }
          return data;
        }
      },
      {
        data: "valor_anterior",
        title: "Valores Anteriores",
        render: function(data) {
          if (Array.isArray(data)) {
            return data.map(v => v || '-').join(", ");
          }
          return data || '-';
        }
      },
      {
        data: "valor_nuevo",
        title: "Valores Nuevos",
        render: function(data) {
          if (Array.isArray(data)) {
            return data.map(v => v || '-').join(", ");
          }
          return data || '-';
        }
      },
      { data: "fecha_cambio", title: "Fecha Cambio" },
      {
        data: null,
        title: "Detalle",
        orderable: false,
        searchable: false,
        render: function (data, type, row) {
          const detalleJSON = JSON.stringify(row).replace(/'/g, "&apos;");
          return `<button class="btn btn-info btn-sm btn-detalle" data-detalle='${detalleJSON}'>Ver Detalle</button>`;
        }
      }
    ],
    responsive: true,
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
    },
    order: [[18, 'desc']], // Ordenar por fecha_cambio descendente
    pageLength: 10
  });

  // Evento para botón "Ver Detalle"
  $('#tablaAuditoria tbody').on('click', '.btn-detalle', function () {
    const detalleData = $(this).data('detalle');

    let campos = [];
    let valoresAnteriores = [];
    let valoresNuevos = [];

    try {
      campos = Array.isArray(detalleData.campo_modificado) ? detalleData.campo_modificado : JSON.parse(detalleData.campo_modificado);
    } catch {
      campos = [];
    }

    try {
      valoresAnteriores = Array.isArray(detalleData.valor_anterior) ? detalleData.valor_anterior : JSON.parse(detalleData.valor_anterior);
    } catch {
      valoresAnteriores = [];
    }

    try {
      valoresNuevos = Array.isArray(detalleData.valor_nuevo) ? detalleData.valor_nuevo : JSON.parse(detalleData.valor_nuevo);
    } catch {
      valoresNuevos = [];
    }

    const camposAmigables = {
      'telefono': 'Teléfono',
      'direccion': 'Dirección',
      'genero': 'Género',
      'nombre': 'Nombre',
      'apellido': 'Apellido',
      'correo_electronico': 'Correo Electrónico',
      'nombre_usuario': 'Nombre de Usuario',
      'estado': 'Estado',
      'condicion': 'Condición',
      'foto': 'Foto',
      'tipo_documento': 'Tipo de Documento',
      'numero_documento': 'Número de Documento',
      'fecha_registro': 'Fecha de Registro'
    };

    let contenido = `
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="thead-light">
            <tr>
              <th>Campo</th>
              <th>Valor Anterior</th>
              <th>Valor Nuevo</th>
            </tr>
          </thead>
          <tbody>
    `;

    for (let i = 0; i < campos.length; i++) {
      const campoLegible = camposAmigables[campos[i]] || campos[i];
      contenido += `
        <tr>
          <td><strong>${campoLegible}</strong></td>
          <td class="text-danger">${valoresAnteriores[i] || '-'}</td>
          <td class="text-success">${valoresNuevos[i] || '-'}</td>
        </tr>
      `;
    }

    contenido += `
          </tbody>
        </table>
      </div>
    `;

    $('#modalDetalleBody').html(contenido);
    $('#modalDetalle').modal('show');
  });
});

// Función para recargar tabla si necesitas
function recargarTablaAuditoria() {
  if (tablaAuditoria) {
    tablaAuditoria.ajax.reload(null, false);
  }
}
