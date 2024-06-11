<?php
include "../config/conexion.php";

// Verificar la conexión
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM cineandes.donación";
$result = mysqli_query($conexion, $query);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data);

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
