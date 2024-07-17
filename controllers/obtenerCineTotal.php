<?php
// CONEXION A BASE DE DATOS
include '../config/conexion.php';
$movies = $conexion->query("SELECT * FROM cineandes.movie order by titulo;");
