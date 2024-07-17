<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Boostrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--Iconos Boostrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--Iconos Google-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!--INCLUDES-->
    <link rel="stylesheet" href="/assents/css/includes.css">
    <!--Titulo-->
    <title>Recomendaciones</title>
    <!--FAVICON-->
    <link rel="icon" type="image/png" href="/assents/imag/favicon/recomendacion.png">
    <!--ESTILOS-->
    <link rel="stylesheet" href="../assents/css/inicio.css">
    <link rel="stylesheet" href="../assents/css/cineTotal.css">

</head>

<body>

    <!--HEADER-->
    <?php
    include "../includes/header.php";
    ?>
    <!--FIN HEADER-->

    <!--Mostrar Recomendaciones-->
    <?php
    include "../controllers/algoritmoRecomendacion.php";

    if (isset($_SESSION['idUsuario'])) {
        $idUsuario = $_SESSION['idUsuario'];
        // Obtener y mostrar las recomendaciones para el usuario especificado
        $recomendaciones = get_recommendations($idUsuario, $ratings, $item_similarity);
        if (!empty($recomendaciones)) {
    ?>
            <section class="Grupo_Cartas">
                <h1 class="Titulo_genero"><?php echo "¡Películas que te recomiendo, {$usuario_id_map[$idUsuario]}!"; ?></h1>
                <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-6 g-4">
                    <?php
                    foreach ($recomendaciones as $pelicula => $valor) {
                        $valor = round($valor * 100, 2);
                        $peliculaID = $movie_id_map[$pelicula]['id'];
                        $portada = $movie_id_map[$pelicula]['portada'];
                    ?>
                        <div class="col">
                            <a href="#" class="Cartas btn card h-100">
                                <img src="<?php echo $portada; ?>" class="card-img-top" alt="<?php echo $pelicula; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $pelicula; ?></h5>
                                </div>
                                <div class="card-footer">
                                    <h6>
                                        <i class="bi bi-star-fill" style="color: yellow;"></i> Recomendado: <?php echo $valor; ?>%
                                    </h6>
                                </div>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </section>
        <?php
        } else {
            echo "No hay recomendaciones disponibles para el usuario {$usuario_id_map[$idUsuario]}.";
        }
    } else { ?>
        <section class="Grupo_Cartas">
            <div class="contenidodeImagenes">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="contenedor grande">
                            <a class="redireccion" href="inicio.php">
                                <img src="/assents/imag/sinsesion/imagenGrande.png" alt="imagenGrande">
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="row">
                            <div class="col-6 col-sm-12">
                                <div class="contenedor fila1">
                                    <a class="redireccion" href="login.php">
                                        <img src="/assents/imag/sinsesion/iniciarSesion.png" alt="iniciarSesion">
                                    </a>
                                </div>
                            </div>
                            <div class="col-6 col-sm-12">
                                <div class="contenedor fila2">
                                    <a class="redireccion" href="createLogin.php">
                                        <img src="/assents/imag/sinsesion/registrar.png" alt="registrar">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
    ?>


    <!--FOOTER-->
    <?php
    include "../includes/footer.php";
    ?>
    <!--FIN FOOTER-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>