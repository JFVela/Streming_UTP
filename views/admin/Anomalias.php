<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donaciones</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
</head>

<body>
    <div class="container">
        <h2 class="mt-5">Lista de Donaciones</h2>
        <table id="listaDonaciones" class="table table-sm table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Id Donación</th>
                    <th>Usuario</th>
                    <th>Transacción</th>
                    <th>Estado</th>
                    <th>Monto($)</th>
                    <th>Campaña</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Id Donación</th>
                    <th>Usuario</th>
                    <th>Transacción</th>
                    <th>Estado</th>
                    <th>Monto($)</th>
                    <th>Campaña</th>
                    <th>Fecha</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="container">
        <h2 class="mt-5">Lista de Anomalias</h2>
        <table id="listaAnomalias" class="table table-sm table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Id Usuario</th>
                    <th>Usuario</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Monto($)</th>
                    <th>Puntuación Z</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Id Usuario</th>
                    <th>Usuario</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Monto($)</th>
                    <th>Puntuación Z</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <script>
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
                "columns": [
                    { "data": "a" },
                    { "data": "b" },
                    { "data": "c" },
                    { "data": "d" },
                    { 
                        "data": "e",
                        "render": function (data, type, row) {
                            return '$' + parseFloat(data).toFixed(2);
                        }
                    },
                    { "data": "f" }
                ]
            });
        });
    </script>
</body>

</html>