<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-image: url('../assents/imag/fondo_Generos.png');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .custom-button {
            display: block;
            border: none;
            padding: 0;
            text-align: center;
            overflow: hidden;
            position: relative;
            transition: transform 0.3s;
            background-color: transparent;
            color: inherit;
            text-decoration: none;
        }

        .custom-button:hover {
            transform: scale(1.05);
        }

        .custom-button .card-body {
            padding: 1rem;
            background: rgba(255, 255, 255, 0.9);
            transition: background 0.3s;
        }

        .custom-button:hover .card-body {
            background: rgba(255, 255, 255, 1);
        }

        .custom-button img {
            transition: transform 0.3s, filter 0.3s;
        }

        .custom-button:hover img {
            transform: scale(1.1);
            filter: brightness(0.8);
        }
    </style>
</head>

<body>
    <header>
        <?php
        include "../includes/header.php";
        ?>
    </header>
    <div class="row row-cols-2 row-cols-md-4 g-3 m-4 ">
        <?php
        include '../config/conexion.php';

        $sql = "SELECT nomb_genero, imagen FROM cineandes.genero";
        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col">
                        <a href="#" class="custom-button btn ms-auto card">
                            <div style="max-height: 170px; overflow: hidden;">
                                <img src="../assents/imag/generos/' . $row["imagen"] . '" class="card-img-top img-fluid" alt="..." style="object-fit: cover; width: 100%; height: 100%;">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>