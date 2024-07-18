<?php
include "../config/conexion.php";

if (!empty($_POST["btnRegistrar"])) {
    // Obtener datos del formulario
    $ObtenerNombreUsuario = $_POST["nombreUsuario"];
    $ObtenerTelefono = $_POST["phone"];
    $ObtenerCorreo = $_POST["email"];
    $ObtenerContraseña = $_POST["password"];
    $ObtenerVerificación = $_POST["confirmPassword"];
    $contraseñaHash = password_hash($ObtenerContraseña, PASSWORD_DEFAULT);

    // Insertar usuario
    $query = $conexion->prepare("INSERT INTO usuarios (nombreUsuario, telefono, correo, contraseña) VALUES (?, ?, ?, ?)");
    $query->bind_param('ssss', $ObtenerNombreUsuario, $ObtenerTelefono, $ObtenerCorreo, $contraseñaHash);

    if ($query->execute()) {
        $usuario = $_POST["email"];
        $contraseña = $_POST["password"];

        // Consulta para obtener la información del usuario
        $sql = "SELECT * FROM cineandes.usuarios WHERE correo = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param('s', $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        echo $usuario;
        echo $contraseña;
        // Verificar si se encontró algún resultado
        if ($datos = $resultado->fetch_object()) {
            // Verificar la contraseña usando password_verify
            if (password_verify($contraseña, $datos->contraseña)) {
                $_SESSION["idUsuario"] = $datos->id_Usu;
                $_SESSION["nombre_Usuario"] = $datos->nombreUsuario;
                echo "<script>window.location.href='/views/inicio.php';</script>";
                die();
                // Redireccionar al usuario después de iniciar sesión
            } else {
                echo 'Contraseña incorrecta';
            }
        } else {
            echo 'Usuario no encontrado';
        }
        $stmt->close();
    } else {
        echo "<script>window.location.href='/views/inicio.php';</script>";
        die();
    }

    $query->close();
}
