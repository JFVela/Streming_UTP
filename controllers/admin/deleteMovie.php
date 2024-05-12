<?php
include "../../config/conexion.php";

if (!empty($_GET['idPeli'])) {
    $id = $_GET['idPeli'];

    $query = $conexion->prepare("DELETE FROM cineandes.movie WHERE idMovie = ?");
    $query->bind_param("i", $id);
    $query->execute();

    if ($query->affected_rows > 0) {
        echo 'success'; 
    } else {
        echo 'error'; 
    }
}
?>
