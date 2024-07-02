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


if (isset($_POST['selected_user'])) {
    $selected_user = $_POST['selected_user'];
    $recommendations = get_recommendations($selected_user, $ratings, $item_similarity);

    if (!empty($recommendations)) {
        echo "<h2>Recomendaciones para $selected_user</h2>";
        echo '<div class="table-responsive">
            <table id="myTableRecomendacion" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Película</th>
                        <th>Valor de Recomendación</th>
                        <th>Porcentaje de Recomendación</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Película</th>
                        <th>Valor de Recomendación</th>
                        <th>Porcentaje de Recomendación</th>
                    </tr>
                </tfoot>
                <tbody>';
        foreach ($recommendations as $item => $recommendation) {
            echo "<tr>
                <td>$item</td>
                <td>" . ($recommendation) . "</td>
                <td>" . round($recommendation * 100, 2) . " %</td>
            </tr>";
        }
        echo '</tbody>
            </table>
        </div>';
    } else {
        echo "<p>No se encontraron similitudes.</p>";
    }
} else {
    echo "<p>Elija un usuario para ver recomendaciones.</p>";
}
