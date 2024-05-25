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
    <title>Peliculas</title>
    <!--ESTILOS-->
    <link rel="stylesheet" href="/assents/css/movie_genero.css">
</head>

<body>
    <!--HEADER-->
    <?php
    include "../includes/header.php";
    ?>
    <!--FIN HEADER-->

    <section class="seccion-peliculas">
        <div class="row row-cols-2 row-cols-md-5 g-4">
            <?php
            // Incluir el archivo de conexión a la base de datos
            include '../config/conexion.php';

            // Verificar si se proporcionó el ID del género en la URL
            if (isset($_GET['id_genero'])) {
                // Obtener el ID del género de la URL
                $id_genero = $_GET['id_genero'];

                // Consulta SQL para obtener los títulos de las películas del género específico
                $sql = "SELECT m.titulo, m.portada
            FROM movie m
            JOIN movie_genero mg ON m.idMovie = mg.Movie_id
            JOIN genero g ON mg.Genero_id = g.id_Genero
            WHERE g.id_Genero = $id_genero";

                // Ejecutar la consulta
                $resultado = mysqli_query($conexion, $sql);

                // Verificar si se obtuvieron resultados
                if ($resultado) {
                    // Comenzar el bucle para generar las cartas de películas
                    while ($fila = mysqli_fetch_assoc($resultado)) {
            ?>
                        <div class="col">
                            <a href="#" class="cartaPelicula btn card h-100">
                                <img src="<?php echo $fila['portada']; ?>" class="card-img-top img-responsiva" alt="...">
                                <div class="contenido-Card card-body d-flex flex-column">
                                    <h5 class="card-title"><?php echo $fila['titulo']; ?></h5>
                                    <div class="btn-group mt-auto">
                                        <div class="likesPorciento">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="red" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                                                <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1" />
                                            </svg>
                                            Likes: 15%
                                        </div>
                                        <br>
                                        <div class="dislikePorcentaje">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="blue" class="bi bi-hand-thumbs-down-fill" viewBox="0 0 16 16">
                                                <path d="M6.956 14.534c.065.936.952 1.659 1.908 1.42l.261-.065a1.38 1.38 0 0 0 1.012-.965c.22-.816.533-2.512.062-4.51q.205.03.443.051c.713.065 1.669.071 2.516-.211.518-.173.994-.68 1.2-1.272a1.9 1.9 0 0 0-.234-1.734c.058-.118.103-.242.138-.362.077-.27.113-.568.113-.856 0-.29-.036-.586-.113-.857a2 2 0 0 0-.16-.403c.169-.387.107-.82-.003-1.149a3.2 3.2 0 0 0-.488-.9c.054-.153.076-.313.076-.465a1.86 1.86 0 0 0-.253-.912C13.1.757 12.437.28 11.5.28H8c-.605 0-1.07.08-1.466.217a4.8 4.8 0 0 0-.97.485l-.048.029c-.504.308-.999.61-2.068.723C2.682 1.815 2 2.434 2 3.279v4c0 .851.685 1.433 1.357 1.616.849.232 1.574.787 2.132 1.41.56.626.914 1.28 1.039 1.638.199.575.356 1.54.428 2.591" />
                                            </svg>
                                            Dislike: 85%
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
            <?php
                    }
                } else {
                    // Manejar el caso de error
                    echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
                }
            } else {
                echo "No se proporcionó el ID del género.";
            }

            // Cerrar la conexión a la base de datos
            mysqli_close($conexion);
            ?>
        </div>
    </section>
    <!--FOOTER-->
    <?php
    include "../includes/footer.php";
    ?>
    <!--FIN FOOTER-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>