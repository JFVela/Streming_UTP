<?php
include "../config/conexion.php";
if (!empty($_POST["registro"])) {
    $primerNombre = $_POST["firstName"];
    $segundoNombre = $_POST["secondName"];
    $apellidoPaterno = $_POST["lastName1"];
    $apellidoMaterno = $_POST["lastName2"];
    $correoElectronico = $_POST["email"];
    $telefono = $_POST["phone"];
    $contrasena = $_POST["password"];
    $confirmarContrasena = $_POST["confirmPassword"];

    if ($contrasena != $confirmarContrasena) {
        echo '<div class="alert">Las contraseñas no coinciden</div>';
        exit();
    } else {
        $contraseñaHash = password_hash($contrasena, PASSWORD_DEFAULT);
        $sql = $conexion->query("INSERT INTO cineandes.usuarios (nomb1, nomb2, ape1, ape2, telefono, correo, contraseña, fecha_registro) VALUES ('$primerNombre', '$segundoNombre', '$apellidoPaterno', '$apellidoMaterno', '$telefono', '$correoElectronico', '$contraseñaHash', NOW())");
        if ($sql == 1) {
            echo '<div class="alert">Agregado correctamente</div>';
        } else {
            echo '<div class="alert">
            Error al registrar 
            <br> 
            El correo: "' . $correoElectronico . '", ya existe.
            </div>';
        }
    }
}

?>
