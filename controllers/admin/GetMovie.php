<?php
include "../../config/conexion.php";
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $query = "SELECT * FROM cineandes.movie WHERE idMovie = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);
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