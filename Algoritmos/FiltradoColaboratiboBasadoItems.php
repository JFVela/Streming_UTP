<?php
//CONEXION A BASE DE DATOS
include '../config/conexion.php';


// Consulta SQL para obtener los datos requeridos
$sql = "SELECT 
            u.id_Usu AS IdUsuario,
            u.nombreUsuario AS NombreUsuario,
            h.Movie_id AS IdMovie,
            m.titulo AS TitleMovie,
            h.reaccion AS Reaccion
        FROM 
            historial h
        JOIN 
            usuarios u ON h.Usuarios_id = u.id_Usu
        JOIN 
            movie m ON h.Movie_id = m.idMovie";

$result = $conexion->query($sql);
$result_html = $conexion->query($sql);

// Arreglo para almacenar las reacciones de los usuarios
$ratings = [];

// Procesar los resultados y llenar el arreglo $ratings
if ($result->num_rows > 0) {
    while ($fila = $result->fetch_assoc()) {
        $usuarioDB = $fila['NombreUsuario'];
        $peliculaDB = $fila['TitleMovie'];
        $reaccionDB = $fila['Reaccion'];

        // Verificar si el usuario ya está en el arreglo, sino, agregarlo
        if (!isset($ratings[$usuarioDB])) {
            $ratings[$usuarioDB] = [];
        }

        // Asignar la reacción a la película para el usuario
        $ratings[$usuarioDB][$peliculaDB] = $reaccionDB;
    }
} else {
    echo "No se encontraron resultados.";
}

// Función para calcular la similitud de coseno entre dos ítems
function similitudCoseno($item1, $item2)
{
    $dot_product = 0;
    $norm1 = 0;
    $norm2 = 0;

    foreach ($item1 as $user => $rating) {
        if (isset($item2[$user])) {
            $dot_product += $rating * $item2[$user];
            $norm1 += pow($rating, 2);
            $norm2 += pow($item2[$user], 2);
        }
    }

    if ($norm1 == 0 || $norm2 == 0) {
        return 0;
    }
    return $dot_product / (sqrt($norm1) * sqrt($norm2));
}

// Función para crear la matriz de ítems
function matrix_Item($ratings)
{
    $item_matrix = [];

    foreach ($ratings as $user => $user_ratings) {
        foreach ($user_ratings as $item => $rating) {
            if (!isset($item_matrix[$item])) {
                $item_matrix[$item] = [];
            }
            $item_matrix[$item][$user] = $rating;
        }
    }
    return $item_matrix;
}

// Crear la matriz de ítems
$item_matrix = matrix_Item($ratings);

// Calcular la similitud entre todos los ítems
$item_similarity = [];

foreach ($item_matrix as $item1 => $ratings1) {
    $item_similarity[$item1] = [];
    foreach ($item_matrix as $item2 => $ratings2) {
        if ($item1 != $item2) {
            $item_similarity[$item1][$item2] = similitudCoseno($ratings1, $ratings2);
        } else {
            $item_similarity[$item1][$item2] = 1; // La similitud de un ítem consigo mismo es 1
        }
    }
}

// Función para obtener recomendaciones para un usuario
function get_recommendations($user, $ratings, $item_similarity, $threshold = 0.1)
{
    if (!isset($ratings[$user])) {
        return [];
    }

    $user_ratings = $ratings[$user];
    $recommendations = [];

    // Considerar ítems no reaccionados y no vistos
    foreach ($item_similarity as $item => $similarities) {
        if ((isset($user_ratings[$item]) && $user_ratings[$item] == 2) || !isset($user_ratings[$item])) {
            $total_similarity = 0;
            $weighted_sum = 0;

            foreach ($similarities as $similar_item => $similarity) {
                if ($similarity > $threshold && isset($user_ratings[$similar_item]) && $user_ratings[$similar_item] != 2) {
                    $weighted_sum += $similarity * $user_ratings[$similar_item];
                    $total_similarity += $similarity;
                }
            }

            if ($total_similarity > 0) {
                $recommendations[$item] = $weighted_sum / $total_similarity;
            }
        }
    }

    arsort($recommendations);

    return $recommendations;
}

// Obtener todos los usuarios y películas
$users = array_keys($ratings);
$all_movies = [];
foreach ($ratings as $user_ratings) {
    $all_movies = array_merge($all_movies, array_keys($user_ratings));
}
$all_movies = array_unique($all_movies);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Filtrado Colaborativo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .contenidoTabla {
            padding: 4%;
            border-radius: 25px;
            border: 5px dashed;
            margin: 5%;
        }

        .tablaSimilitud th,
        .tablaSimilitud td {
            border: 2px solid black;
        }

        .tablaSimilitud {
            text-align: center;
        }

        /* Añadir scroll vertical */
        .table-responsive {
            max-height: 800px;
            /* Puedes ajustar esta altura según tus necesidades */
            overflow-y: auto;
        }
    </style>
</head>

<body>

    <!--Historial-->
    <div class="contenidoTabla">
        <h2>Historial de Reacciones</h2>
        <div class="table-responsive">
            <table id="TableDB" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>IdUsuario</th>
                        <th>NombreUsuario</th>
                        <th>IdMovie</th>
                        <th>TitleMovie</th>
                        <th>Reaccion</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>IdUsuario</th>
                        <th>NombreUsuario</th>
                        <th>IdMovie</th>
                        <th>TitleMovie</th>
                        <th>Reaccion</th>
                    </tr>
                </tfoot>

                <tbody>
                    <?php
                    $contador = 1;
                    while ($row = $result_html->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$contador}</td>";
                        echo "<td>{$row['IdUsuario']}</td>";
                        echo "<td>{$row['NombreUsuario']}</td>";
                        echo "<td>{$row['IdMovie']}</td>";
                        echo "<td>{$row['TitleMovie']}</td>";
                        echo "<td>" . ($row['Reaccion'] !== null ? $row['Reaccion'] : "No Vista") . "</td>";
                        echo "</tr>";
                        $contador++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!--Datos de Valoración-->
    <div class="contenidoTabla">
        <h2>Datos de Valoraciones</h2>
        <div class="table-responsive">
            <table class="tablaSimilitud table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Usuarios</th>
                        <?php
                        foreach ($all_movies as $movie) {
                            echo "<th>$movie</th>";
                        }
                        ?>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Usuarios</th>
                        <?php
                        foreach ($all_movies as $movie) {
                            echo "<th>$movie</th>";
                        }
                        ?>
                    </tr>
                </tfoot>

                <tbody>
                    <?php
                    foreach ($ratings as $user => $user_ratings) {
                        echo "  <tr>
                                    <td><b>$user</b></td>";
                        foreach ($all_movies as $movie) {
                            echo "  <td>" . (isset($user_ratings[$movie]) ? $user_ratings[$movie] : "No vista") . "</td>";
                        }
                        echo "  </tr>";
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>

    <!--Matriz-->
    <div class="contenidoTabla">
        <h2>Matriz de Ítems</h2>
        <div class="table-responsive">
            <table class="tablaSimilitud table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Película</th>
                        <?php
                        foreach ($users as $user) {
                            echo "<th>$user</th>";
                        }
                        ?>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Película</th>
                        <?php
                        foreach ($users as $user) {
                            echo "<th>$user</th>";
                        }
                        ?>
                    </tr>
                </tfoot>

                <tbody>
                    <?php
                    foreach ($item_matrix as $item => $users_ratings) {
                        echo "<tr>
                            <td><b>$item</b></td>";
                        foreach ($users as $user) {
                            echo "<td>" . (isset($users_ratings[$user]) ? $users_ratings[$user] : "No vista") . "</td>";
                        }
                        echo "
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>

    <!--Similitud de Coseno-->
    <div class="contenidoTabla">
        <h2>Similitud de Coseno entre Ítems</h2>
        <div class="table-responsive">
            <table class="tablaSimilitud table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Película</th>
                        <?php
                        foreach ($all_movies as $movie) {
                            echo "<th scope='col'>$movie</th>";
                        }
                        ?>
                    </tr>
                </thead>
                <tfoot class="thead-dark">
                    <tr>
                        <th scope="col">Película</th>
                        <?php
                        foreach ($all_movies as $movie) {
                            echo "<th scope='col'>$movie</th>";
                        }
                        ?>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($item_similarity as $item1 => $similarities) {
                        echo "  <tr>
                                    <td><b>$item1</b></td>";
                        foreach ($all_movies as $item2) {
                            echo "  <td>" . (isset($similarities[$item2]) ? $similarities[$item2] : 0) . "</td>";
                        }
                        echo "  </tr>";
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>


    <!-- Formulario de selección de usuario -->
    <div class="contenidoTabla">
        <h2>Selecciona un Usuario para Ver Recomendaciones</h2>
        <form id="userForm">
            <div class="form-group d-flex">
                <input type="text" class="form-control" name="selected_user" id="selected_user" placeholder="Escribe el nombre del usuario" required>
                <button type="submit" class="btn btn-primary ms-2">Ok</button>
            </div>
        </form>
    </div>

    <!-- Contenedor para las recomendaciones -->
    <div class="contenidoTabla" id="recommendations">
        <p>Elija un usuario para ver recomendaciones.</p>
    </div>

    <script>
        //Table BD
        $(document).ready(function() {
            $('#TableDB').DataTable();
        });
        //Table Recomendación
        $(document).ready(function() {
            $('#myTableRecomendacion').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#userForm').on('submit', function(e) {
                e.preventDefault();
                var selected_user = $('#selected_user').val();

                $.ajax({
                    url: '/get_recommendations.php',
                    type: 'POST',
                    data: {
                        selected_user: selected_user
                    },
                    success: function(response) {
                        $('#recommendations').html(response);
                        $('#myTableRecomendacion').DataTable(); // Inicializar DataTable para la tabla de recomendaciones
                    }
                });
            });
        });
    </script>
</body>

</html>