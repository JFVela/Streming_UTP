<?php
include "../../config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnRegistrar']) && $_POST['btnRegistrar'] == 'ok') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $anio = $_POST['anio'];
    $duracion = $_POST['duracion'];
    $url = $_POST['url'];
    $director = $_POST['director'];

    $sql = $conexion->query("INSERT INTO cineandes.movie (titulo, descripcion, año, duracion, url, director) VALUES ('$titulo', '$descripcion','$anio' ,'$duracion' ,'$url' ,'$director' )");
    if ($sql) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
