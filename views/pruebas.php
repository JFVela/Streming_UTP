<?php
include "../config/conexion.php";

// Consulta SQL actualizada
$sql = "SELECT v.Movie_id, p.portada, p.titulo, p.descripcion, SUM(v.like) AS total_likes, SUM(v.dislike) AS total_dislikes
        FROM visualizaciones v
        JOIN movie p ON v.Movie_id = p.idMovie
        GROUP BY v.Movie_id, p.portada, p.titulo, p.descripcion
        ORDER BY total_likes DESC
        LIMIT 5";

$result = $conexion->query($sql);
$movies = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }
} else {
    echo "No results";
}

$conexion->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Slider</title>
    <link rel="stylesheet" href="/assents/css/carrusel.css">
</head>

<body>

    <header>
        <nav>
            <a href="#" class="active">Home</a>
            <a href="#">About</a>
            <a href="#">Portfolio</a>
            <a href="#">Services</a>
            <a href="#">Contact</a>
        </nav>
    </header>

    <div class="slider">
        <div class="list">
            <?php
            $rank = 1; // Variable para el número de ranking
            foreach ($movies as $movie) :
            ?>
                <div class="item">
                    <img src="/assents/imag/portada de pelicula/<?php echo $movie['portada']; ?>" alt="">
                    <div class="content">
                        <div class="title">#<?php echo $rank; ?> más visto</div>
                        <div class="type"><?php echo $movie['titulo']; ?></div>
                        <div class="description"><?php echo $movie['descripcion']; ?></div>
                        <div class="description">
                            <br>
                            <strong>Likes:</strong> <?php echo $movie['total_likes']; ?>
                            <strong>Dislikes:</strong> <?php echo $movie['total_dislikes']; ?>
                        </div>
                        <div class="button">
                            <button class="mira-ahora">Mira Ahora!</button>
                        </div>

                    </div>
                </div>
            <?php
                $rank++; // Incrementar el número de ranking
            endforeach; ?>
        </div>

        <div class="thumbnail">
            <?php foreach ($movies as $movie) : ?>
                <div class="item">
                    <img src="/assents/imag/portada de pelicula/<?php echo $movie['portada']; ?>" alt="">
                </div>
            <?php endforeach; ?>
        </div>

        <div class="nextPrevArrows">
            <button class="prev">
                < </button>
                    <button class="next"> > </button>
        </div>
    </div>

    <script src="/assents/script/carrusel.js"></script>
</body>

</html>