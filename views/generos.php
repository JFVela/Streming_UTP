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
    <title>Categorias</title>
    <!--ESTILOS-->
    <link rel="stylesheet" href="/assents/css/generos.css">
</head>

<body>
    <!--HEADER-->
    <?php
    include "../includes/header.php";
    ?>
    <!--FIN HEADER-->

    <div class="row row-cols-2 row-cols-md-4 g-3 m-4 ">
        <?php
        include '../config/conexion.php';

        $sql = "SELECT nomb_genero, imagen, id_Genero FROM cineandes.genero";
        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col">
                <a href="/views/Movie_gener.php?id_genero=' . $row["id_Genero"] . '" class="custom-button btn ms-auto card">
                <div style="max-height: 170px; overflow: hidden;">
                        <img src="../assents/imag/generos/' . $row["imagen"] . '" class="card-img-top img-fluid d-none d-md-block" alt="..." style="object-fit: cover; width: 100%; height: 100%;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">' . $row["nomb_genero"] . '</h5>
                    </div>
                </a>
            </div>';
            }
        } else {
            echo "0 resultados";
        }

        $conexion->close();
        ?>
    </div>

    <!--FOOTER-->
    <?php
    include "../includes/footer.php";
    ?>
    <!--FIN FOOTER-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>