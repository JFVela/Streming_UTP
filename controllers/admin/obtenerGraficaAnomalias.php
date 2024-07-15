<?php
// Habilitar la visualización de errores (solo para desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Información de conexión a la base de datos
$dbDetails = array(
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'db' => 'cineandes'
);

// Crear conexión a la base de datos
$conn = new mysqli($dbDetails['host'], $dbDetails['user'], $dbDetails['pass'], $dbDetails['db']);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta para obtener los datos
$query = "
    SELECT 
        d.monto,
        ABS((d.monto - stats.avg_monto) / stats.std_monto) AS puntuacion_z
    FROM 
        donación d
    INNER JOIN (
        SELECT 
            id_Usuarios, 
            AVG(monto) AS avg_monto, 
            STDDEV(monto) AS std_monto
        FROM 
            donación
        GROUP BY 
            id_Usuarios
    ) AS stats ON d.id_Usuarios = stats.id_Usuarios
    WHERE 
        ABS((d.monto - stats.avg_monto) / stats.std_monto) > 3";

$result = $conn->query($query);

$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
