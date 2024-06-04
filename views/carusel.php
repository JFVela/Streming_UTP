<?php
include '../controllers/carusel_Inicio.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Carousel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assents/css/carrusel.css">
</head>

<body class="">
    <div id="carouselExampleCaptions" class="cuerpo_Carrusel carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-indicators">
            <?php foreach ($peliculas as $index => $pelicula) : ?>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?= $index ?>" class="<?= $index == 0 ? 'active' : '' ?>" aria-current="<?= $index == 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $index + 1 ?>">
                </button>
            <?php endforeach; ?>
        </div>
        <div class="carousel-inner">
            <?php foreach ($peliculas as $index => $pelicula) : ?>
                <div class="carousel-item <?= $index == 0 ? 'active' : '' ?>">
                    <div class="d-flex">
                        <div class="left-content">
                            <div>
                                <h1><?= htmlspecialchars($pelicula['titulo']) ?></h1>
                                <p><?= htmlspecialchars($pelicula['descripcion']) ?></p>
                                <p>
                                    <i class="bi bi-emoji-laughing"> Likes: <?= $pelicula['total_likes'] ?> </i>
                                </p>
                                <p>
                                    <i class="bi bi-emoji-dizzy-fill"> Dislikes: <?= $pelicula['total_dislikes'] ?> </i>
                                </p>
                                <br>
                                <a type="button" href="" class="play-button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-play-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M6.79 5.093A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="right-content">
                            <img src="<?= $pelicula['portada'] ?>" class="d-block w-100" alt="...">
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>