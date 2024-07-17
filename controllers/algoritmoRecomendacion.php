<?php
// CONEXION A BASE DE DATOS
include '../config/conexion.php';

// Consulta SQL para obtener los datos requeridos
$sql = "SELECT 
            usuarios.id_Usu as user_id,
            usuarios.nombreUsuario as a,
            movie.idMovie as movie_id,
            movie.titulo as b,
            movie.portada as portada,
            historial.reaccion as c
        FROM 
            historial
        JOIN 
            usuarios ON historial.Usuarios_id = usuarios.id_Usu
        JOIN 
            movie ON historial.Movie_id = movie.idMovie";

$result = $conexion->query($sql);

// Arreglo para almacenar las reacciones de los usuarios
$ratings = [];
$usuario_id_map = [];
$movie_id_map = [];

// Procesar los resultados y llenar el arreglo $ratings
if ($result->num_rows > 0) {
    while ($fila = $result->fetch_assoc()) {
        $usuarioID = $fila['user_id'];
        $usuarioDB = $fila['a'];
        $peliculaID = $fila['movie_id'];
        $peliculaDB = $fila['b'];
        $portadaDB = $fila['portada'];
        $reaccionDB = $fila['c'];

        // Verificar si el usuario ya está en el arreglo, sino, agregarlo
        if (!isset($ratings[$usuarioID])) {
            $ratings[$usuarioID] = [];
            $usuario_id_map[$usuarioID] = $usuarioDB; // Mapear ID a nombre de usuario
        }

        // Verificar si la película ya está en el mapa de IDs, sino, agregarla
        if (!isset($movie_id_map[$peliculaDB])) {
            $movie_id_map[$peliculaDB] = ['id' => $peliculaID, 'portada' => $portadaDB];
        }

        // Asignar la reacción a la película para el usuario
        $ratings[$usuarioID][$peliculaDB] = $reaccionDB;
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
function get_recommendations($user_id, $ratings, $item_similarity, $threshold = 0.1)
{
    if (!isset($ratings[$user_id])) {
        return [];
    }

    $user_ratings = $ratings[$user_id];
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
