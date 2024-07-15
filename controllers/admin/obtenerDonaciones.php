<?php
// Habilitar la visualización de errores (solo para desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//Inner Join
$table = <<<EOT
 (
    SELECT d.id_Donación AS a, 
    u.nombreUsuario AS b, 
    d.id_Transaccion AS c, 
    d.estado AS d, 
    d.monto AS e, 
    d.campaña AS f, 
    d.fecha AS g
    FROM donación d
    INNER JOIN usuarios u ON d.id_Usuarios = u.id_Usu
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
    array('db' => 'f', 'dt' => 5),
    array('db' => 'g', 'dt' => 6)
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
