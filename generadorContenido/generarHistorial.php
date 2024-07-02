<?php
//CONEXION A BASE DE DATOS
include '../config/conexion.php';

$usuariosRange = range(45, 380);
$moviesRange = range(91, 114);
$reacciones = [0, 1, 2];
$fechaVisu = date("Y-m-d H:i:s");

foreach ($usuariosRange as $usuario) {
    foreach ($moviesRange as $movie) {
        $reaccion = $reacciones[array_rand($reacciones)];
        $sqlInsert = "INSERT INTO historial (Usuarios_id, Movie_id, fecha_visu, reaccion) VALUES ('$usuario', '$movie', '$fechaVisu', '$reaccion')";

        if ($conexion->query($sqlInsert) === TRUE) {
            echo "Nuevo registro creado exitosamente: Usuario $usuario, Película $movie, Reacción $reaccion<br>";
        } else {
            echo "Error: " . $sqlInsert . "<br>" . $conexion->error . "<br>";
        }
    }
}

$conexion->close();
?>
