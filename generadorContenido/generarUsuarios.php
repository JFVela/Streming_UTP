<?php
//CONEXION A BASE DE DATOS
include '../config/conexion.php';

function generarCadenaAleatoria($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function generarTelefono() {
    $telefono = '9';
    for ($i = 0; $i < 8; $i++) {
        $telefono .= rand(0, 9);
    }
    return $telefono;
}

for ($i = 0; $i < 600; $i++) {
    $nombreUsuario = generarCadenaAleatoria(10);
    $telefono = generarTelefono();
    $correo = $nombreUsuario . "@hotmail.com";
    $contraseña = generarCadenaAleatoria(10);
    $contraseñaHash = password_hash($contraseña, PASSWORD_DEFAULT);
    $fechaRegistro = date("Y-m-d H:i:s");

    $sqlInsert = "INSERT INTO usuarios (nombreUsuario, telefono, correo, contraseña, fecha_registro) VALUES ('$nombreUsuario', '$telefono', '$correo', '$contraseñaHash', '$fechaRegistro')";

    if ($conexion->query($sqlInsert) === TRUE) {
        echo "Nuevo registro creado exitosamente<br>";
    } else {
        echo "Error: " . $sqlInsert . "<br>" . $conexion->error . "<br>";
    }
}

$conexion->close();
?>
