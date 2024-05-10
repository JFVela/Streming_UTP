<?php
require_once '../movie.php'; // Incluir el modelo de película
require_once '../../config/conexion.php'; // Incluir el archivo de conexión a la base de datos

class MovieDAO {
    // Método para obtener todas las películas de la base de datos
    public static function getAllMovies() {
        global $conexion; // Obtener la conexión a la base de datos desde el archivo de conexión

        $movies = array();

        // Consulta SQL para seleccionar todas las películas
        $sql = "SELECT * FROM movie";

        // Ejecutar la consulta
        $result = $conexion->query($sql);

        // Recorrer los resultados y crear objetos de película
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $movie = new Movie($row['idMovie'], $row['titulo'], $row['descripcion'], $row['año'], $row['duracion'], $row['url'], $row['director']);
                $movies[] = $movie;
            }
        }

        return $movies;
    }
}
?>
