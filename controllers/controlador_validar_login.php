<?php
include "../config/conexion.php";
session_start();
if (!empty($_POST["btnLogear"])) {
    $usuario = $_POST["user"];
    $contraseña = $_POST["contra"];

    // Consulta para obtener la información del usuario
    $sql = "SELECT * FROM cineandes.usuarios WHERE correo = '$usuario'";
    $resultado = $conexion->query($sql);

    // Verificar si se encontró algún resultado
    if ($datos = $resultado->fetch_object()) {
        // Verificar la contraseña usando password_verify
        if (password_verify($contraseña, $datos->contraseña)) {
            $_SESSION["idUsuario"] = $datos->id_Usu;
            $_SESSION["nombreUsuario"] = $datos->nomb1;
            $_SESSION["apellidoUsuario"] = $datos->ape1;
            header("location: ../../../views/inicio.php");
        } else {
            echo 'Contraseña incorrecta';
        }
    } else {
        echo 'Usuario no encontrado';
    }
}
?>
