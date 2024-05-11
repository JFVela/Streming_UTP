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

    if ($resultado) {
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);
        echo json_encode($datos);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}
?>