<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>
        .logo_Imagen {
            max-width: 100px;
            height: auto;
            border: 2px solid black;
            border-radius: 480%;
            display: block;
        }

        /* Estilo para los enlaces */
        .navbar-nav .nav-link {
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            font-size: 20px;
            color: red;
        }

        .navbar-nav .nav-link:active {
            color: blue;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="../views/inicio.php">
                <img class="logo_Imagen" src="../assents/imag/logoAndes.png" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../views/inicio.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Peliculas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Series</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categoria</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Acción</a></li>
                            <li><a class="dropdown-item" href="#">Drama</a></li>
                            <li><a class="dropdown-item" href="#">Comedia</a></li>
                            <li><a class="dropdown-item" href="#">Terror</a></li>
                            <li><a class="dropdown-item" href="#">Ciencia Ficción</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../views/generos.php">Ver todo</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Mi espacio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Gracias por preferirnos!</a>
                    </li>
                </ul>
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control form-control-dark" placeholder="Buscar..." aria-label="Buscar">
                </form>
                <?php
                if (isset($_SESSION["idUsuario"])) {
                    echo '<div class="d-flex align-items-center">';
                    echo '<div class="usuario-info">BIENVENIDO! ' . $_SESSION["nombreUsuario"] . ', ' . $_SESSION["apellidoUsuario"] . '</div>';
                    echo '<a type="button" href="../controllers/controlador_cerrar_seccion.php" class="btn btn-danger ms-auto">Cerrar Sesión</a>';
                    echo '</div>';
                } else {
                    echo '<a type="button" href="../views/login.php" class="btn btn-outline-success me-2">Ingresar</a>';
                    echo '<a type="button" class="btn btn-warning">Registrarse</a>';
                }
                ?>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>