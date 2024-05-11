<?php
$server = "localhost";
$user = "root";
$pass = "";
$bd = "cineandes";

$conexion = new mysqli($server, $user, $pass, $bd);
if ($conexion->connect_errno) {
    die("Conexion fallida" . $conexion->connect_errno);
}
?>
