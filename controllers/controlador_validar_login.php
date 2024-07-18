<?php
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
            $_SESSION["nombre_Usuario"] = $datos->nombreUsuario;
            // Guardar mensaje de éxito en la sesión
            $_SESSION['message'] = '<script>
                                        Swal.fire({
                                            position: "top-end",
                                            icon: "success",
                                            title: "¡Acceso concedido!",
                                            showConfirmButton: false,
                                            timer: 3000
                                        });
                                    </script>';
            echo "<script>window.location.href='/views/inicio.php';</script>";
            die();
        } else {
            $_SESSION['message'] = '<script>
                                        Swal.fire({
                                            position: "center",                            
                                            imageUrl: "/assents/imag/SweetAlert/contraseñaIncorrecta.gif",
                                            imageWidth: 400,
                                            title: "Contraseña incorrecta",                        
                                            showConfirmButton: false
                                        });
                                    </script>';
            echo "<script>window.location.href='/views/Login.php';</script>";
            die();
        }
    } else {
        $_SESSION['message'] = '<script>
                                    Swal.fire({
                                        position: "center",                            
                                        imageUrl: "/assents/imag/SweetAlert/usuarioNoExiste.gif",
                                        imageWidth: 400,
                                        title: "Usuario no encontrado",                        
                                        showConfirmButton: false
                                    });
                                </script>';
        echo "<script>window.location.href='/views/Login.php';</script>";
        die();
    }
}
