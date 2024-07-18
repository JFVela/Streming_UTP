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
    <title>CineTotal</title>
    <!--FAVICON-->
    <link rel="icon" type="image/png" href="/assents/imag/favicon/cine.png">
    <!--ESTILOS-->
    <link rel="stylesheet" href="../assents/css/inicio.css">
</head>

<body>

    <!--HEADER-->
    <?php
    include "../includes/header.php";
    ?>
    <!--FIN HEADER-->

    <!--Mostrar toda las peliculas-->
    <section class="Grupo_Cartas">
        <?php
        if (isset($_SESSION['idUsuario'])) {
            include "../controllers/obtenerCineTotal.php";
        ?>
            <h1 class="Titulo_genero">¡Cine Total: Todas las películas, en un solo lugar!</h1>
            <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-6 g-4">
                <?php
                foreach ($movies as $movie) {
                ?>
                    <div class="col">
                        <a href="#" class="Cartas btn card h-100">
                            <img src="<?php echo htmlspecialchars($movie['portada']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($movie['titulo']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($movie['titulo']); ?></h5>
                            </div>
                            <div class="card-footer">
                                <h6>
                                    <i class="bi bi-calendar" style="color: yellow;"></i> Año: <?php echo htmlspecialchars($movie['año']);  ?>
                                </h6>
                            </div>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php
        } else {
            include "../includes/mensajeError.php";
        }
        ?>
    </section>

    <!--FOOTER-->
    <?php
    include "../includes/footer.php";
    ?>
    <!--FIN FOOTER-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>