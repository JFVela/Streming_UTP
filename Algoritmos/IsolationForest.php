<?php
//CONEXION A BASE DE DATOS
include '../config/conexion.php';

// Consulta para obtener las donaciones realizadas por los usuarios
$query = "  SELECT 
            usuarios.id_Usu as id_Usuario, 
            usuarios.nombreUsuario as Usuario ,
            donación.monto as monto
            FROM 
                cineandes.donación
            LEFT JOIN 
                usuarios 
            ON donación.id_Usuarios = usuarios.id_Usu";

$sentenciaSQL = "   SELECT 
                    usuarios.id_Usu as Id_Usuario, 
                    usuarios.nombreUsuario as Usuario,
                    monto,
                    id_Transaccion as codigo,
                    estado,
                    campaña,
                    fecha
                    FROM 
                        cineandes.donación
                    LEFT JOIN 
                        usuarios ON donación.id_Usuarios = usuarios.id_Usu";

$result = mysqli_query($conexion, $query);
$resultadoSQL = mysqli_query($conexion, $sentenciaSQL);

// Verificar si la consulta fue exitosa
if (!$result || !$resultadoSQL) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

$donacionesPorUsuario = [];

// Procesar los resultados
while ($row = mysqli_fetch_assoc($result)) {
    $idUsuario = $row['id_Usuario'];
    $Usuario = $row['Usuario'];
    $monto = $row['monto'];

    // Crear el arreglo solo si el usuario ha realizado al menos una donación
    if (!isset($donacionesPorUsuario[$idUsuario])) {
        $donacionesPorUsuario[$idUsuario] = ['Usuario' => $Usuario, 'Montos' => []];
    }

    // Agregar el monto al arreglo correspondiente
    $donacionesPorUsuario[$idUsuario]['Montos'][] = $monto;
}

// Función para calcular la media (Promedio)
function CalcularPromedio($data)
{
    return array_sum($data) / count($data);
}

// Función para calcular la desviación estándar
function CalcDesvEstandar($data, $mean)
{
    $sum = 0;
    foreach ($data as $value) {
        $sum += pow($value - $mean, 2);
    }
    return sqrt($sum / count($data));
}

// Función para calcular los z-scores
function CalcularPuntuacionZ($data, $mean, $standard_deviation)
{
    $z_scores = [];
    foreach ($data as $value) {
        $z_scores[] = ($value - $mean) / $standard_deviation;
    }
    return $z_scores;
}

// Función para detectar anomalías
function DetectarAnomalias($z_scores, $threshold = 3)
{
    $anomalies = [];
    foreach ($z_scores as $index => $z_score) {
        if (abs($z_score) > $threshold) {
            $anomalies[] = $index;
        }
    }
    return $anomalies;
}
// Cerrar la conexión
mysqli_close($conexion);
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation"></script>
    <title>Isolation Forest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .contenedorGraficas {
            color: #FFF5E0;
            background-color: #141E46;
            border-radius: 20px;
            margin: 2%;
            padding: 1%;
            border: 2px dashed;
        }

        .graficaPuntUsu,
        .graficaPuntMonto {
            background-color: #FFF5E0;
        }

        .colorInusual {
            color: aqua;
        }

        .ContenidoDonacion {
            border-radius: 20px;
            margin: 2%;
            padding: 1%;
            border: 2px dashed;
            background-color: #FDD7AA;
        }
    </style>
</head>

<body>
    <!--
    <div class="ContenidoDonacion">
        <h1 class="titulos">Donaciones</h1>
        <div class="table-responsive">
            <?php
            if ($resultadoSQL->num_rows > 0) {
                echo '<table id="myTable1" class="display" style="width: 100%;">';
                echo '<thead style="background-color: #B6FFCE;">';
                echo '<tr>';
                echo '  <th>#
                            <span class="material-symbols-outlined">
                                volunteer_activism
                            </span>
                        </th>';
                echo '<th>Id_Usuario</th>';
                echo '<th>Usuario</th>';
                echo '<th>Monto</th>';
                echo '<th>Código</th>';
                echo '<th>Estado</th>';
                echo '<th>Campaña</th>';
                echo '<th>Fecha</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tfoot style="background-color: #B6FFCE;">';
                echo '<tr>';
                echo '  <th>#
                            <span class="material-symbols-outlined">
                                volunteer_activism
                            </span>
                        </th>';
                echo '<th>Id_Usuario</th>';
                echo '<th>Usuario</th>';
                echo '<th>Monto</th>';
                echo '<th>Código</th>';
                echo '<th>Estado</th>';
                echo '<th>Campaña</th>';
                echo '<th>Fecha</th>';
                echo '</tr>';
                echo '</tfoot>';
                echo '<tbody>';

                $numDonaciones = 1;
                while ($rowSQL = $resultadoSQL->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $numDonaciones . '</td>';
                    echo '<td>' . $rowSQL['Id_Usuario'] . '</td>';
                    echo '<td>' . $rowSQL['Usuario'] . '</td>';
                    echo '<td>$' . $rowSQL['monto'] . '</td>';
                    echo '<td>' . $rowSQL['codigo'] . '</td>';
                    echo '<td>' . $rowSQL['estado'] . '</td>';
                    echo '<td>' . $rowSQL['campaña'] . '</td>';
                    echo '<td>' . $rowSQL['fecha'] . '</td>';
                    echo '</tr>';
                    $numDonaciones++;
                }

                echo '</tbody>';
                echo '</table>';
            } else {
                echo 'No se encontraron registros.';
            }
            ?>

        </div>
    </div>
    -->


    <div class="ContenidoDonacion" style="border-radius: 20px; margin: 2%; padding: 1%; border: 2px dashed;">
        <h1 class="titulos">Algoritmo Isolation Forest</h1>
        <div class="table-responsive">
            <table id="myTable" class="display" style="width: 100%;">
                <thead style="background-color: #FFBB64;">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Promedio x̄</th>
                        <th>Desv. Estándar σ</th>
                        <th>Puntaje Z > 3</th>
                        <th>Anomalías (Monto)</th>
                    </tr>
                </thead>
                <tfoot style="background-color: #FFBB64;">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Promedio x̄</th>
                        <th>Desv. Estándar σ</th>
                        <th>Puntaje Z > 3</th>
                        <th>Anomalías (Monto)</th>
                    </tr>
                </tfoot>

                <tbody>
                    <?php
                    foreach ($donacionesPorUsuario as $idUsuario => $data) {
                        $montos = $data['Montos'];
                        $mean = CalcularPromedio($montos);
                        $standard_deviation = CalcDesvEstandar($montos, $mean);
                        $z_scores = CalcularPuntuacionZ($montos, $mean, $standard_deviation);
                        $anomalies = DetectarAnomalias($z_scores);
                        $estilo;
                        if (!empty($anomalies)) {
                            foreach ($anomalies as $index) {
                                $estilo = " style='background-color: #FF6868'";
                            }
                        } else {
                            $estilo = " style='background-color: #DCFFB7'";
                        }

                        echo "<tr" . $estilo . ">";
                        echo "<td>$idUsuario</td>";
                        echo "<td>{$data['Usuario']}</td>";
                        echo "<td>" . round($mean, 4) . "</td>";
                        echo "<td>" . round($standard_deviation, 4) . "</td>";
                        echo "<td>";
                        foreach ($z_scores as $score) {
                            if ($score > 3) {
                                echo round($score, 4) . "<br>";
                            }
                        }
                        echo "</td>";
                        echo "<td>";
                        if (!empty($anomalies)) {
                            foreach ($anomalies as $index) {
                                echo "$" . $montos[$index] . "<br>";
                            }
                        } else {
                            echo "No hay anomalías";
                        }
                        echo "</td>";
                        echo "</trif>";
                    }
                    ?>
                </tbody>

            </table>
        </div>
    </div>



    <div class="contenedorGraficas">
        <h2 class="text-center mt-4 mb-4">Gráfico de Puntuación Z</h2>
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <canvas class="graficaPuntUsu" id="zScoreChart" style="border: 1px solid black;"></canvas>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <canvas class="graficaPuntMonto" id="Grafico" style="border: 1px solid black;"></canvas>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
        $(document).ready(function() {
            $('#myTable1').DataTable();
        });
    </script>

    <script>
        const ctx = document.getElementById('zScoreChart').getContext('2d');

        // Generamos los datos para el gráfico de dispersión
        const zScoresData = {
            datasets: [{
                label: 'Puntuación Z',
                data: [
                    <?php
                    foreach ($donacionesPorUsuario as $idUsuario => $data) {
                        $montos = $data['Montos'];
                        $mean = CalcularPromedio($montos);
                        $standard_deviation = CalcDesvEstandar($montos, $mean);
                        $z_scores = CalcularPuntuacionZ($montos, $mean, $standard_deviation);
                        foreach ($z_scores as $score) {
                            echo "{x: $idUsuario, y: " . round($score, 4) . "},";
                        }
                    }
                    ?>
                ],
                borderColor: '#141E46',
                backgroundColor: [
                    <?php
                    foreach ($donacionesPorUsuario as $idUsuario => $data) {
                        $montos = $data['Montos'];
                        $mean = CalcularPromedio($montos);
                        $standard_deviation = CalcDesvEstandar($montos, $mean);
                        $z_scores = CalcularPuntuacionZ($montos, $mean, $standard_deviation);
                        foreach ($z_scores as $score) {
                            if ($score < 3) {
                                echo "'#8DECB4',";
                            } else {
                                echo "'red',";
                            }
                        }
                    }
                    ?>
                ],
                pointRadius: 10,
            }]
        };

        const zScoreChart = new Chart(ctx, {
            type: 'scatter',
            data: zScoresData,
            options: {
                scales: {
                    x: {
                        type: 'linear',
                        position: 'bottom',
                        title: {
                            display: true,
                            text: 'ID del Usuario'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                        title: {
                            display: true,
                            text: 'Puntuación Z'
                        }
                    }
                },
                plugins: {
                    annotation: {
                        annotations: {
                            line1: {
                                type: 'line',
                                yMin: 3,
                                yMax: 3,
                                borderColor: 'red',
                                borderWidth: 2,
                                label: {
                                    content: 'Umbral de Anomalía (y = 3)',
                                    enabled: true,
                                    position: 'center',
                                    backgroundColor: 'rgba(255, 99, 132, 0.25)',
                                    font: {
                                        size: 10
                                    }
                                }
                            }
                        }
                    }
                }
            }
        });
    </script>

    <script>
        const variable = document.getElementById('Grafico').getContext('2d');

        // Generamos los datos para el gráfico de dispersión
        const datos = {
            datasets: [{
                label: 'Puntuación Z',
                data: [
                    <?php
                    foreach ($donacionesPorUsuario as $idUsuario => $data) {
                        $montos = $data['Montos'];
                        $mean = CalcularPromedio($montos);
                        $standard_deviation = CalcDesvEstandar($montos, $mean);
                        $z_scores = CalcularPuntuacionZ($montos, $mean, $standard_deviation);
                        foreach ($montos as $index => $monto) {
                            $score = $z_scores[$index];
                            echo "{x: $monto, y: " . round($score, 4) . "},";
                        }
                    }
                    ?>
                ],
                borderColor: '#141E46',
                backgroundColor: [
                    <?php
                    foreach ($donacionesPorUsuario as $idUsuario => $data) {
                        $montos = $data['Montos'];
                        $mean = CalcularPromedio($montos);
                        $standard_deviation = CalcDesvEstandar($montos, $mean);
                        $z_scores = CalcularPuntuacionZ($montos, $mean, $standard_deviation);
                        foreach ($montos as $index => $monto) {
                            $score = $z_scores[$index];
                            if ($score < 3) {
                                echo "'#8DECB4',";
                            } else {
                                echo "'red',";
                            }
                        }
                    }
                    ?>
                ],
                pointRadius: 10,
            }]
        };

        const Grafico = new Chart(variable, {
            type: 'scatter',
            data: datos,
            options: {
                scales: {
                    x: {
                        type: 'linear',
                        position: 'bottom',
                        title: {
                            display: true,
                            text: 'Monto'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                        title: {
                            display: true,
                            text: 'Puntuación Z'
                        }
                    }
                },
                plugins: {
                    annotation: {
                        annotations: {
                            line1: {
                                type: 'line',
                                yMin: 3,
                                yMax: 3,
                                borderColor: 'red',
                                borderWidth: 2,
                                label: {
                                    content: 'Umbral de Anomalía (y = 3)',
                                    enabled: true,
                                    position: 'center',
                                    backgroundColor: 'rgba(255, 99, 132, 0.25)',
                                    font: {
                                        size: 10
                                    }
                                }
                            }
                        }
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>