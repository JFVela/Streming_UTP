<?php
include '../config/conexion.php';

$sql = "SELECT 
            m.titulo,
            m.descripcion,
            m.portada,
            COUNT(CASE WHEN h.reaccion = 1 THEN 1 END) AS total_likes,
            COUNT(CASE WHEN h.reaccion = 0 THEN 1 END) AS total_dislikes
        FROM 
            movie m
        JOIN 
            historial h ON m.idMovie = h.Movie_id
        GROUP BY 
            m.idMovie
        ORDER BY 
            total_likes DESC
        LIMIT 5;";

$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $peliculas = $resultado->fetch_all(MYSQLI_ASSOC);
} else {
    $peliculas = [];
}
$conexion->close();
?>