<?php
include "../config/conexion.php";

if (!empty($_POST["btnRegistrar"])) {
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
        $mensaje = '<script>
                        Swal.fire({
                            position: "center",                            
                            imageUrl: "/assents/imag/SweetAlert/TaBien.gif",
                            imageAlt: "Usuario registrado con éxito",
                            imageWidth: 400,
                            title: "USUARIO REGISTRADO",                        
                            showConfirmButton: false,
                            timer: 3500
                        });
                    </script>';
    } else {
        $mensaje = '<script>
                        Swal.fire({
                            position: "center",                            
                            imageUrl: "/assents/imag/SweetAlert/bobEsponja.gif",
                            imageAlt: "error",
                            imageWidth: 400,
                            title: "Hubo un error al registrar el usuario!",
                        });
                    </script>';
    }
    $query->close();
}
