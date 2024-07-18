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
                // Guardar mensaje de éxito en la sesión
                $_SESSION['message'] = '<script>
                                        Swal.fire({
                                            position: "center",                            
                                            imageUrl: "/assents/imag/SweetAlert/TaBien.gif",
                                            imageAlt: "Usuario registrado con éxito",
                                            imageWidth: 400,
                                            title: "Gracias por registarse!",                        
                                            showConfirmButton: false
                                        });
                                        </script>';
                echo "<script>window.location.href='/views/createLogin.php';</script>";
                die();
            } else {
                echo 'Contraseña incorrecta';
            }
        } else {
            echo 'Usuario no encontrado';
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = '<script>
                                    Swal.fire({
                                        position: "center",                            
                                        imageUrl: "/assents/imag/SweetAlert/bobEsponja.gif",
                                        imageAlt: "error",
                                        imageWidth: 400,
                                        title: "Hubo un error al registrar el usuario!",
                                    });
                                </script>';
        echo "<script>window.location.href='/views/createLogin.php';</script>";
        die();
    }

    $query->close();
}
