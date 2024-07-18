<?php
// CONEXION A BASE DE DATOS
include '../config/conexion.php';

// Consulta SQL preparada para seleccionar los títulos de películas
$sql = "SELECT 
            m.idMovie AS ID,
            m.portada as Portada,
            m.titulo AS Pelicula,
            m.descripcion AS Descripcion,
            m.año AS Año,
            m.duracion AS Duracion,
            m.director AS Director,
            GROUP_CONCAT(g.nomb_genero ORDER BY g.nomb_genero ASC SEPARATOR ', ') AS Genero
        FROM 
            movie m
        JOIN 
            movie_genero mg ON m.idMovie = mg.Movie_id
        JOIN 
            genero g ON mg.Genero_id = g.id_Genero
        GROUP BY 
            m.idMovie, m.titulo, m.descripcion, m.año, m.duracion, m.director
        ORDER BY 
            m.titulo ASC;";

$stmt = $conexion->prepare($sql);

// Verificar si la preparación fue exitosa
if ($stmt === false) {
    die("Error al preparar la consulta: " . $conexion->error);
}

// Ejecutar la consulta
$stmt->execute();
$resultado = $stmt->get_result();
$documentos = [];
$titulos = [];
$portada = [];
$id_DB = []; 

if ($resultado->num_rows > 0) {
    // Recorrer cada fila del resultado
    while ($fila = $resultado->fetch_assoc()) {
        $documentos[] = $fila['Pelicula'] . " " . $fila['Descripcion'] . " " . $fila['Año'] . " " . $fila['Duracion'] . " " . $fila['Director'] . " " . $fila['Genero'];
        $id_DB[] = $fila['ID']; 
        $portada[] = $fila['Portada'];
        $titulos[] = $fila['Pelicula'];
    }
} else {
    echo "No se encontraron resultados";
}

function calcularTfidf($documentos)
{
    // Crear un diccionario de términos y su frecuencia en cada documento
    $diccionario = [];
    foreach ($documentos as $doc) {
        $palabras = explode(" ", strtolower($doc));
        foreach ($palabras as $palabra) {
            if (!isset($diccionario[$palabra])) {
                $diccionario[$palabra] = 1;
            } else {
                $diccionario[$palabra]++;
            }
        }
    }

    // Calcular el total de documentos
    $total_documentos = count($documentos);

    // Calcular TF-IDF para cada término en cada documento
    $tfidf = [];
    foreach ($documentos as $i => $doc) {
        $palabras = explode(" ", strtolower($doc));
        foreach ($palabras as $palabra) {
            // Calcular TF (Frecuencia del término)
            $tf = substr_count(strtolower($doc), $palabra) / count($palabras);
            // Calcular IDF (Frecuencia inversa de documento)
            $idf = log($total_documentos / ($diccionario[$palabra] + 1), 2);
            // Calcular TF-IDF
            $tfidf[$i][$palabra] = $tf * $idf;
        }
    }

    return $tfidf;
}

// Función Coseno
function cosineSimilarity($vec1, $vec2)
{
    $dotProduct = 0;
    $magnitude1 = 0;
    $magnitude2 = 0;

    foreach ($vec1 as $key => $value1) {
        $value2 = isset($vec2[$key]) ? $vec2[$key] : 0;
        $dotProduct += $value1 * $value2;
        $magnitude1 += $value1 ** 2;
        $magnitude2 += $value2 ** 2;
    }

    $magnitudeFinal1 = sqrt($magnitude1);
    $magnitudeFinal2 = sqrt($magnitude2);

    if ($magnitudeFinal1 != 0 && $magnitudeFinal2 != 0) {
        $cosineSimilarity = $dotProduct / ($magnitudeFinal1 * $magnitudeFinal2);
        return $cosineSimilarity;
    } else {
        return 0;
    }
}
