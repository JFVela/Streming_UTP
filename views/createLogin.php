<!DOCTYPE html>
<html lang="en">
<?php
include '../controllers/controlador_registrar_usuario.php';
?>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../assents/css/login.css">
</head>

<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2" style="background-image: url('../assents/imag/fondoLogin.jpeg');">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">We are more than just a company</h4>
                                    <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="../assents/imag/logoAndes.png" style="width: 185px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">Porfavor complete el formulario</h4>
                                    </div>

                                    <!-- Formulario para regsitrar -->
                                    <form action="" method="post" class="registrarUsuario" onsubmit="return validarContraseña();">
                                        <div class="row">
                                            <div class="col">
                                                <label for="firstName" class="form-label">Primer Nombre</label>
                                                <input type="text" class="form-control" id="firstName" name="firstName" required>
                                            </div>
                                            <div class="col">
                                                <label for="secondName" class="form-label">Segundo Nombre</label>
                                                <input type="text" class="form-control" id="secondName" name="secondName" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="lastName1" class="form-label">Apellido Paterno</label>
                                                <input type="text" class="form-control" id="lastName1" name="lastName1" required>
                                            </div>
                                            <div class="col">
                                                <label for="lastName2" class="form-label">Apellido Materno</label>
                                                <input type="text" class="form-control" id="lastName2" name="lastName2" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Correo Electrónico</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Número de Teléfono (Opcional)</label>
                                            <input type="tel" class="form-control" id="phone" name="phone" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Contraseña</label>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
                                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                                        </div>
                                        <div class="text-center pt-1 mb-5 pb-1 cuenta">
                                            <input type="submit" class="btn btn-primary" value="Registrar" name="registro"></input>
                                            <a href="login.php">Iniciar sección</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="../assents/script/validarContraseña.js"></script>
</body>

</html>