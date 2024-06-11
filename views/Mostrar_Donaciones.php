<!DOCTYPE html>
<html>

<head>
    <title>Donaciones en tiempo real</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
</head>

<body>
    <table id="myTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Trans</th>
                <th>State</th>
                <th>Monto</th>
                <th>Campaña</th>
                <th>Fecha</th>
                <!-- Agrega más columnas según sea necesario -->
            </tr>
        </thead>
        <tbody>
            <!-- Los datos de la tabla se insertarán aquí -->
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            let table = $('#myTable').DataTable();

            setInterval(function() {
                $.ajax({
                    url: '../views/basededatosDonacion.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Limpia la tabla antes de agregar nuevos datos
                        table.clear().draw();

                        for (var i = 0; i < data.length; i++) {
                            table.row.add([
                                data[i].id_Donación,
                                data[i].id_Usuarios,
                                data[i].id_Transaccion,
                                data[i].estado,
                                data[i].monto,
                                data[i].campaña,
                                data[i].fecha
                            ]).draw();
                        }
                    }
                });
            }, 10); // Actualiza los datos cada 5 segundos
        });
    </script>


</body>

</html>