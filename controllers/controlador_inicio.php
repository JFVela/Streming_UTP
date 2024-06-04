<?php
include "../config/conexion.php";

// Consulta SQL para obtener las 4 películas con más likes por género
$sql = "SELECT 
sub.idMovie,
sub.titulo,
sub.portada,
sub.id_Genero,
sub.nomb_genero,
sub.num_likes,
sub.num_dislikes
FROM (
SELECT 
    m.idMovie,
    m.titulo,
    m.portada,
    g.id_Genero,
    g.nomb_genero,
    SUM(CASE WHEN h.reaccion = 1 THEN 1 ELSE 0 END) AS num_likes,
    SUM(CASE WHEN h.reaccion = 0 THEN 1 ELSE 0 END) AS num_dislikes,
    ROW_NUMBER() OVER (PARTITION BY g.id_Genero ORDER BY SUM(CASE WHEN h.reaccion = 1 THEN 1 ELSE 0 END) DESC) AS row_num
FROM 
    movie m
JOIN 
    movie_genero mg ON m.idMovie = mg.Movie_id
JOIN 
    genero g ON mg.Genero_id = g.id_Genero
LEFT JOIN 
    historial h ON m.idMovie = h.Movie_id
GROUP BY 
    m.idMovie, m.titulo, m.portada, g.id_Genero, g.nomb_genero
) sub
WHERE sub.row_num <= 6
ORDER BY sub.id_Genero, sub.num_likes DESC";

// Ejecutar la consulta
$result = $conexion->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Organizar los resultados por género
    $movies_by_genre = [];
    while ($row = $result->fetch_assoc()) {
        $movies_by_genre[$row['nomb_genero']][] = $row;
    }
} else {
    echo "0 resultados";
}

// Cerrar la conexión
$conexion->close();
?>