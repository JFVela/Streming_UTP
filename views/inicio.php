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
    <!--Sweet Alert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <!--HEADER-->
    <?php
    include "../includes/header.php";
    include "../controllers/controlador_inicio.php";
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?>
    <!--FIN HEADER-->

    <?php if (!empty($movies_by_genre)) : ?>
        <?php foreach ($movies_by_genre as $genre => $movies) : ?>
            <section class="Grupo_Cartas ">
                <h1 class="Titulo_genero"><?php echo htmlspecialchars($genre); ?></h1>
                <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-6 g-4">
                    <?php foreach ($movies as $movie) : ?>
                        <div class="col">
                            <a href="#" class="Cartas btn card h-100">
                                <img src="<?php echo htmlspecialchars($movie['portada']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($movie['titulo']); ?>">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <h4><?php echo htmlspecialchars($movie['titulo']); ?></h4>
                                    </h5>
                                </div>
                                <div class="card-footer">
                                    <h6>
                                        <i class="bi bi-star-fill" style="color: yellow;"></i> Likes: <?php echo htmlspecialchars($movie['num_likes']); ?>
                                    </h6>
                                    <h6>
                                        <i class="bi bi-emoji-dizzy-fill" style="color: red;"></i> Dislikes: <?php echo htmlspecialchars($movie['num_dislikes']); ?>
                                    </h6>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endforeach; ?>
    <?php endif; ?>

    <!--FOOTER-->
    <?php
    include "../includes/footer.php";
    ?>
    <!--FIN FOOTER-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>