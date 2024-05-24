<?php
session_start();
?>
<header>
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
</header>