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
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- chartjs-plugin-annotation -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation@1.0.2"></script>
    <!--INCLUDES-->
    <link rel="stylesheet" href="/assents/css/includes.css">
    <!--ESTILOS-->
    <link rel="stylesheet" href="../assents/css/inicio.css">
</head>

<body>
    <?php
    include "../includes/header.php";
    if (!isset($_SESSION['idUsuario'])) {
        $_SESSION['message'] = '    <script>
                                        Swal.fire({
                                            position: "top-end",
                                            icon: "error",
                                            title: "Inicie sessión antes!",
                                            showConfirmButton: false,
                                            timer: 3000
                                        });
                                    </script>';
        echo "<script>window.location.href='/views/inicio.php';</script>";
        die();
    } else { ?>
        <div class="cuerpoDonacion">
            <div class="Tabla">
                <h2 class="mt-5">Lista de Donaciones</h2>
                <div class="table-responsive">
                    <table id="listaDonaciones" class="table table-warning table-striped table-bordered" style="width:100%">
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
            </div>
            <div class="Tabla">
                <h2 class="mt-5">Lista de Anomalias</h2>
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table id="listaAnomalias" class="table table-warning table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id Usuario</th>
                                    <th>Usuario</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Monto($)</th>
                                    <th>Puntuación Z</th>
                                    <th>Acción</th> <!-- Nueva columna para el botón -->
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
                                    <th>Acción</th> <!-- Nueva columna para el botón -->
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="graficas">
                <div style="background-color: #FCFFE7;" class="container">
                    <h2 class="mt-5">Montos inusuales de los Usuarios</h2>
                    <canvas id="myChart" width="200" height="100"></canvas>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

    <!--FOOTER-->
    <?php
    include "../includes/footer.php";
    ?>
    <!--FIN FOOTER-->

    <script src="/assents/script/tablaAnomalias.js"></script>
    <script src="/assents/script/graficaAnomalias.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>