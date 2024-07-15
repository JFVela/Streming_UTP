<?php
// Habilitar la visualización de errores (solo para desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Definir la tabla y las columnas
$table = <<<EOT
 (
        SELECT 
        d.id_Usuarios as a,
        u.nombreUsuario as b,
        u.telefono as c,
        u.correo as d,
        d.monto as e,
        ABS((d.monto - stats.avg_monto) / stats.std_monto) AS f
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
        ABS((d.monto - stats.avg_monto) / stats.std_monto) > 3
 ) temp
EOT;

// Clave primaria de la tabla
$primaryKey = 'a';

// Columnas de la base de datos que deben ser leídas y enviadas de vuelta a DataTables
$columns = array(
    array('db' => 'a', 'dt' => 'id_Usuarios'),
    array('db' => 'b', 'dt' => 'nombreUsuario'),
    array('db' => 'c', 'dt' => 'telefono'),
    array('db' => 'd', 'dt' => 'correo'),
    array('db' => 'e', 'dt' => 'monto'),
    array('db' => 'f', 'dt' => 'puntuacion_z')
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

// Depuración: Salida de datos en formato JSON
try {
    $json = SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns);
    header('Content-Type: application/json');
    echo json_encode($json);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>
