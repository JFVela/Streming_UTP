<?php
include "../../config/conexion.php";

// Verificar si se recibió un ID válido
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Consultar la base de datos para obtener los detalles de la película con el ID proporcionado
    $query = "SELECT * FROM cineandes.movie WHERE idMovie = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id); // "i" indica que el parámetro es un entero
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Obtener los datos como un array asociativo
        $datos = $resultado->fetch_assoc();
        // Devolver los datos como JSON
        echo json_encode($datos);
    } else {
        // Si no se encuentra ninguna película con el ID proporcionado, devolver un array vacío
        echo json_encode([]);
    }
} else {
    // Si no se proporcionó ningún ID, devolver un array vacío
    echo json_encode([]);
}
?>
