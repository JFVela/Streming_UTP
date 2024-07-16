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
    <title>Recomendaciones</title>
    <!--ESTILOS
    <link rel="stylesheet" href="../assents/css/inicio.css">-->
</head>

<body>

    <!--HEADER-->
    <?php
    include "../includes/header.php";
    ?>
    <!--FIN HEADER-->

    <!--Mostrar Recomendaciones-->
    <?php
    $idUsuario = $_SESSION['idUsuario'];
    include "../controllers/obtenerRecomendacion.php";

    // Obtener y mostrar las recomendaciones para el usuario especificado
    $recomendaciones = get_recommendations($idUsuario, $ratings, $item_similarity);

    if (isset($idUsuario)) {
        if (!empty($recomendaciones)) {
            echo "Recomendaciones para el usuario {$usuario_id_map[$idUsuario]}:<br>";
            foreach ($recomendaciones as $pelicula => $valor) {
                echo "Película: $pelicula, Valor de recomendación: $valor<br>";
            }
        } else {
            echo "No hay recomendaciones disponibles para el usuario {$usuario_id_map[$idUsuario]}.";
        }
    } else {
        echo "";
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