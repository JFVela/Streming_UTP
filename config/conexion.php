<?php

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

/*
//BASE DE DATOS EN LA NUBE
$server = "b3gi50wd4cjp04rkeioh-mysql.services.clever-cloud.com"; 
$user = "ujodavwbkvtbxg1u"; 
$pass = "sCKOdOXeu0mH8yNxoEXI"; 
$bd = "b3gi50wd4cjp04rkeioh"; 
*/



