<?php
//CONEXION A BASE DE DATOS
include '../config/conexion.php';

function generarIdTransaccion($length = 17) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

for ($i = 0; $i < 350; $i++) {
    $idUsuario = rand(21, 43);
    $idTransaccion = generarIdTransaccion();
    $estado = "completed";
    $monto = rand(50, 100);
    $campañas = ["Salud", "Vivienda", "Educación", "Alimentación"];
    $campaña = $campañas[array_rand($campañas)];
    $fecha = date("Y-m-d H:i:s");

    $sqlInsert = "INSERT INTO donación (id_Usuarios, id_Transaccion, estado, monto, campaña, fecha) VALUES ('$idUsuario', '$idTransaccion', '$estado', '$monto', '$campaña', '$fecha')";

    if ($conexion->query($sqlInsert) === TRUE) {
        echo "Nuevo registro creado exitosamente<br>";
    } else {
        echo "Error: " . $sqlInsert . "<br>" . $conexion->error . "<br>";
    }
}

$conexion->close();
?>
