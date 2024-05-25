<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Boostrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--Iconos Boostrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--INCLUDES-->
    <link rel="stylesheet" href="/assents/css/includes.css">
    <!--Titulo-->
    <title>Login</title>
    <!--ESTILOS-->
    <link rel="stylesheet" href="../assents/css/login.css">
</head>

<body>
    <!--HEADER-->
    <?php
    include "../includes/header.php";
    ?>
    <!--FIN HEADER-->
    <div class="d-flex flex-column min-vh-100">
        <section class="section_login flex-grow-1 gradient-form">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-xl-10">
                        <div class="card rounded-3 text-black">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="card-body p-md-5 mx-md-4">
                                        <div class="text-center">
                                            <img src="../assents/imag/logoAndes.png" style="width: 185px;" alt="logo">
                                            <h4 class="mt-1 mb-5 pb-1">Donde el entretenimiento encuentra su hogar en las alturas de los Andes</h4>
                                        </div>
                                        <form method="post">
                                            <p>Por favor, ingrese su usuario</p>
                                            <div class="form-outline mb-4">
                                                <input name="user" type="email" id="form2Example11" class="form-control" placeholder="Número telefonico o correo electonico" />
                                                <label class="form-label" for="form2Example11">Username</label>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <input name="contra" type="password" id="form2Example22" class="form-control" />
                                                <label class="form-label" for="form2Example22">Password</label>
                                            </div>
                                            <div class="text-center pt-1 mb-5 pb-1">
                                                <input class="btn_ingresar btn btn-block fa-lg gradient-custom-2 mb-3" type="submit" name="btnLogear" value="Ingresar">
                                                <br>
                                                <a class="text-muted" href="#!">Has olvidado tu contraseña?</a>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center pb-4">
                                                <p class="mb-0 me-2">No tienes una cuenta?</p>
                                                <a href="createLogin.php" class="btn_registrar">Registrate</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="pequeña_Imagen col-lg-6 d-flex align-items-center gradient-custom-2">
                                    <div class="px-3 py-4 p-md-5 mx-md-4" style="background-color: #ffe6cc; border-radius: 15px;">
                                        <h4 class="mb-4" style="color: #ff6600; font-size: 24px;">¡Gracias!</h4>
                                        <p class="small mb-0" style="color: #333333; font-size: 18px;">¡Bienvenido! Prepárate para sumergirte en una experiencia multimedia inigualable. Disfruta de más de 1000 películas completamente GRATIS (bajo ley de derechos de autor). Además, al ser parte de nuestra comunidad, ¡puedes marcar la diferencia! Ayuda a las familias menos favorecidas a través de tus donaciones.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--FOOTER-->
        <?php
        include "../includes/footer.php";
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>