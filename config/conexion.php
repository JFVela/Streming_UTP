<?php

/*
//BASE DE DATOS EN LA NUBE
$server = "b3gi50wd4cjp04rkeioh-mysql.services.clever-cloud.com"; 
$user = "ujodavwbkvtbxg1u"; 
$pass = "la contraseña se compra :v"; 
$bd = "b3gi50wd4cjp04rkeioh"; 
*/

//BASE DE DATOS LOCAL
$server = "localhost";
$user = "root";
$pass = "";
$bd = "cineandes";

$conexion = new mysqli($server, $user, $pass, $bd);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}




