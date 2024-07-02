<!DOCTYPE html>
<html lang="en">
<?php
include '../controllers/controlador_registrar_usuario.php';
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--Bootstrap Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--Includes-->
    <link rel="stylesheet" href="/assents/css/includes.css">
    <!--Title-->
    <title>Crear Usuario</title>
    <!--Styles-->
    <link rel="stylesheet" href="../assents/css/login.css">
    <!--Sweet Alert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <!--Header-->
    <?php
    include "../includes/header.php";
    ?>

    <div id="mensajeFinal" class="form-outline mb-4">
        <?php echo isset($mensaje) ? $mensaje : ''; ?>
    </div>

    <!--End Header-->
    <div class="d-flex flex-column min-vh-100">
        <section class="section_login flex-grow-1 gradient-form">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-xl-10">
                        <div class="card rounded-3 text-black">
                            <div class="row g-0">
                                <div class="pequeña_Imagen col-lg-6 d-flex align-items-center gradient-custom-2">
                                    <div class="px-3 py-4 p-md-5 mx-md-4" style="background-color: #ffe6cc; border-radius: 15px;">
                                        <h4 class="mb-4" style="color: #ff6600; font-size: 24px;">¡Registrate ahora!</h4>
                                        <p class="small mb-0" style="color: #333333; font-size: 18px;">Disfruta del mejor catálogo de películas totalmente gratis. Además de poder realizar donaciones a los más necesitados.</p>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="card-body p-md-5 mx-md-4">
                                        <div class="text-center">
                                            <img src="../assents/imag/logoAndes.png" style="width: 185px;" alt="logo">
                                            <h4 class="mt-1 mb-5 pb-1">Donde el entretenimiento encuentra su hogar en las alturas de los Andes</h4>
                                        </div>
                                        <form action="" method="post" class="registrarUsuario" id="registroForm">
                                            <p>Crea un nombre de Usuario</p>
                                            <div class="form-outline mb-4">
                                                <label for="nombreUsuario" class="form-label">Nombre de Usuario</label>
                                                <input type="text" class="form-control" id="idNombreUsuario" name="nombreUsuario" required>
                                                <small id="idMensajeUsuario" class="form-danger"></small>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <label for="phone" class="form-label">Número de Teléfono</label>
                                                <input type="number" class="form-control" id="IdPhone" name="phone" placeholder="Opcional" pattern="9[0-9]{8}|^$">
                                            </div>
                                            <div class="form-outline mb-4">
                                                <label for="email" class="form-label">Correo Electrónico</label>
                                                <input type="email" class="form-control" id="IdEmail" name="email" required>
                                                <small id="idMensajeCorreo" class="form-danger"></small>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <label for="password" class="form-label">Contraseña</label>
                                                <input type="password" class="form-control" id="IdPassword" name="password" required>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
                                                <input type="password" class="form-control" id="IdConfirmPassword" name="confirmPassword" required>
                                                <small id="idMensajeConfirm" class="form-danger"></small>
                                            </div>
                                            <div class="text-center pt-1 mb-5 pb-1">
                                                <input class="btn_ingresar btn btn-block fa-lg gradient-custom-2 mb-3" type="submit" name="btnRegistrar" value="Registrarse Ahora!">
                                                <br>
                                                <p>Al registrarte, aceptas nuestras Condiciones de uso y Políticas de privacidad.</p>
                                                <p>
                                                    ¿Ya tienes una cuenta?
                                                    <a class="text-muted" href="login.php">Iniciar Sesión</a>
                                                </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Footer-->
        <?php
        include "../includes/footer.php";
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#registroForm').on('submit', function(event) {
                var nombreUsuario = $('#idNombreUsuario').val();
                var correo = $('#IdEmail').val();
                var mensajeUsuario = $('#idMensajeUsuario');
                var mensajeCorreo = $('#idMensajeCorreo');
                var password = $('#IdPassword').val();
                var confirmPassword = $('#IdConfirmPassword').val();
                var mensajeConfirm = $('#idMensajeConfirm');

                if (nombreUsuario.length < 4 || nombreUsuario.length > 20) {
                    event.preventDefault();
                    mensajeUsuario.text('Usuario entre 4 a 20 caracteres').css('color', 'red');
                    return;
                }

                if (password !== confirmPassword) {
                    event.preventDefault();
                    mensajeConfirm.text('No coincide la contraseña').css('color', 'red');
                    return;
                }

                $.ajax({
                    url: '/controllers/validate_user.php',
                    method: 'POST',
                    async: false, // Ensuring the request completes before form submission
                    data: {
                        nombreUsuario: nombreUsuario,
                        correo: correo
                    },
                    success: function(response) {
                        var data = JSON.parse(response);

                        if (data.nombreUsuario) {
                            event.preventDefault();
                            mensajeUsuario.text('Usuario Registrado').css('color', 'red');
                        } else {
                            mensajeUsuario.text('Usuario Disponible').css('color', 'green');
                        }
                        if (data.correo) {
                            event.preventDefault();
                            mensajeCorreo.text('Correo electrónico Registrado').css('color', 'red');
                        } else {
                            mensajeCorreo.text('').css('color', '');
                        }
                    }
                });
            });

            $('#IdPassword, #IdConfirmPassword').on('input', function() {
                var password = $('#IdPassword').val();
                var confirmPassword = $('#IdConfirmPassword').val();
                var message = $('#idMensajeConfirm');

                if (password !== confirmPassword) {
                    message.text('No coincide la contraseña').css('color', 'red');
                } else {
                    message.text('');
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
