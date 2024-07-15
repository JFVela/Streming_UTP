<?php
// Habilitar la visualización de errores (solo para desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inner Join
$table = <<<EOT
 (
        SELECT 
        d.id_Usuarios as a,
        u.nombreUsuario as b,
        u.telefono as c,
        u.correo as d,
        d.monto as e,
        (d.monto - stats.avg_monto) / stats.std_monto AS f
        FROM 
        donación d
        INNER JOIN usuarios u ON d.id_Usuarios = u.id_Usu
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
        (d.monto - stats.avg_monto) / stats.std_monto > 3
 ) temp
EOT;

// Clave primaria de la tabla
$primaryKey = 'a';

// Columnas de la base de datos que deben ser leídas y enviadas de vuelta a DataTables
$columns = array(
    array('db' => 'a', 'dt' => 0),
    array('db' => 'b', 'dt' => 1),
    array('db' => 'c', 'dt' => 2),
    array('db' => 'd', 'dt' => 3),
    array('db' => 'e', 'dt' => 4),
    array('db' => 'f', 'dt' => 5)
);

// Información de conexión a la base de datos
$dbDetails = array(
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'db' => 'cineandes'
);

// Incluir la clase de procesamiento de consultas SQL
require '../../ssp.class.php';

// Depuración: Verificar conexión a la base de datos
$conn = new mysqli($dbDetails['host'], $dbDetails['user'], $dbDetails['pass'], $dbDetails['db']);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Depuración: Salida de datos en formato JSON
try {
    $json = SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns);
    header('Content-Type: application/json');
    echo json_encode($json);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
