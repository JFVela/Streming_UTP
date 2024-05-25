<!doctype html>
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
    <title>CineAndes</title>
    <!--ESTILOS-->
    <link rel="stylesheet" href="../assents/css/inicio.css">
</head>

<body>
    <?php
    include "../includes/header.php";
    ?>
    <!-- CONTENIDO -->
    <div class="header-content container">
        <div class="header-1">
            <img src="../assents/imag/PROTOTIPO.jpeg" alt="">
            <a href="#" class="btn-2">Ver ahora</a>
        </div>
        <div class="header-2">
            <h1>Las mejores <br> Peliculas </h1>
            <img src="../assents/imag/Play.png" alt="">
        </div>
    </div>



    <!-- SECCION DE PELICULAS -->
    <section class="movies container">
        <h2>Peliculas mas vistas</h2>
        <hr>
        <div class="box-container-1">
            <div class="box-1">
                <div class="content">
                    <img src="../assents/imag/fondoLogin.jpeg" alt="">
                    <h3>Pelicula en HD</h3>
                    <p>
                        Este es mi primer avance de nuestro trabajo de innovación.
                    </p>
                </div>
            </div>
            <div class="box-1">
                <div class="content">
                    <img src="../assents/imag/fondoLogin.jpeg" alt="">
                    <h3>Pelicula en HD</h3>
                    <p>
                        Este es mi primer avance de nuestro trabajo de innovación.
                    </p>
                </div>
            </div>
            <div class="box-1">
                <div class="content">
                    <img src="../assents/imag/fondoLogin.jpeg" alt="">
                    <h3>Pelicula en HD</h3>
                    <p>
                        Este es mi primer avance de nuestro trabajo de innovación.
                    </p>
                </div>
            </div>
            <div class="box-1">
                <div class="content">
                    <img src="../assents/imag/fondoLogin.jpeg" alt="">
                    <h3>Pelicula en HD</h3>
                    <p>
                        Este es mi primer avance de nuestro trabajo de innovación.
                    </p>
                </div>
            </div>
        </div>
        <div class="load-more" id="load-more-1"> Cargar mas</div>
    </section>

    <!-- Peliculas de Accion-->
    <section class="movies container">
        <h2>Peliculas de accion</h2>
        <hr>
        <div class="box-container-2">
            <div class="box-2">
                <div class="content">
                    <img src="../assents/imag/fondoLogin.jpeg" alt="">
                    <h3>Pelicula en HD</h3>
                    <p>
                        Este es mi primer avance de nuestro trabajo de innovación.
                    </p>
                </div>
            </div>
            <div class="box-2">
                <div class="content">
                    <img src="../assents/imag/fondoLogin.jpeg" alt="">
                    <h3>Pelicula en HD</h3>
                    <p>
                        Este es mi primer avance de nuestro trabajo de innovación.
                    </p>
                </div>
            </div>
            <div class="box-2">
                <div class="content">
                    <img src="../assents/imag/fondoLogin.jpeg" alt="">
                    <h3>Pelicula en HD</h3>
                    <p>
                        Este es mi primer avance de nuestro trabajo de innovación.
                    </p>
                </div>
            </div>
            <div class="box-2">
                <div class="content">
                    <img src="../assents/imag/fondoLogin.jpeg" alt="">
                    <h3>Pelicula en HD</h3>
                    <p>
                        Este es mi primer avance de nuestro trabajo de innovación.
                    </p>
                </div>
            </div>
        </div>
        <div class="load-more" id="load-more-2"> Cargar mas</div>
    </section>

    <!--FOOTER-->
    <?php
    include "../includes/footer.php";
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>