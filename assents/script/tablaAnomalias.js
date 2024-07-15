$(document).ready(function() {
    $('#listaDonaciones').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "/controllers/admin/obtenerDonaciones.php"
    });
});
$(document).ready(function() {
    $('#listaAnomalias').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "/controllers/admin/obtenerAnomalias.php",
        "columns": [{
                "data": "id_Usuarios"
            },
            {
                "data": "nombreUsuario"
            },
            {
                "data": "telefono"
            },
            {
                "data": "correo"
            },
            {
                "data": "monto",
                "render": function(data, type, row) {
                    return '$' + parseFloat(data).toFixed(2);
                }
            },
            {
                "data": "puntuacion_z"
            },
            {
                "data": null,
                "defaultContent": '<button class="btn btn-primary btn-sm enviar-mensaje">Enviar mensaje</button>',
                "orderable": false
            }
        ]
    });


    $('#listaAnomalias tbody').on('click', '.enviar-mensaje', function() {
        var data = $('#listaAnomalias').DataTable().row($(this).parents('tr')).data();
        var correo = data.correo;
        var asunto = "Hemos detectado Anomalias en su donación!";
        var body = "";
        var mailto_link = 'mailto:' + correo + '?subject=' + encodeURIComponent(asunto) + '&body=' + encodeURIComponent(body);
        window.location.href = mailto_link;
    });
});