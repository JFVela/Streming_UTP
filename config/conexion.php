<?php
$server = "localhost";
$user = "root";
$pass = "";
$bd = "cineandes";

$conexion = new mysqli($server, $user, $pass, $bd);
if ($conexion->connect_errno) {
    die("Conexion fallida" . $conexion->connect_errno);
} else {
    // Imprimir mensaje de éxito en la consola del navegador
    echo '<script>console.log("Conectado a la base de datos");</script>';
}
?>
