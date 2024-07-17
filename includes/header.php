<?php
include "../config/conexion.php";
session_start();
include '../controllers/controlador_validar_login.php';
?>
<header class="p-3 mb-3 border-bottom" style="background-color: #333333;">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="../views/inicio.php">
                <img class="logo_Imagen" src="../assents/imag/logoAndes.png" alt="logo">
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link" href="../views/inicio.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/views/recomendaciones.php">Cine Total</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categoria</a>
                        <ul class="opcionGenero dropdown-menu">
                            <li><a class="dropdown-item" href="/views/Movie_gener.php?id_genero=22">Acción</a></li>
                            <li><a class="dropdown-item" href="/views/Movie_gener.php?id_genero=27">Drama</a></li>
                            <li><a class="dropdown-item" href="/views/Movie_gener.php?id_genero=26">Comedia</a></li>
                            <li><a class="dropdown-item" href="/views/Movie_gener.php?id_genero=21">Terror</a></li>
                            <li><a class="dropdown-item" href="/views/Movie_gener.php?id_genero=24">Ciencia Ficción</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../views/generos.php">Ver todo</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Gracias por preferirnos!</a>
                    </li>
                </ul>
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control form-control-dark" placeholder="Buscar..." aria-label="Buscar">
                </form>
            </div>
            <div class="d-flex align-items-center">
                <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php
                if (isset($_SESSION["idUsuario"])) {
                    $saludo ="Hola! " .$_SESSION["nombre_Usuario"] ;
                    echo '<div class="dropdown text-end">
                            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img class="perfil" src="/assents/imag/avatar/user1.jpg" alt="mdo" width="40" height="40" class="rounded-circle">
                            </a>
                            <ul class="dropdown-menu text-small dropdown-menu-end" aria-labelledby="dropdownUser1" style="">
                                <li style="background-color: #FAEF5D;"><span class="dropdown-item-text">' . $saludo . '</span></li>
                                <li><a class="dropdown-item" href="/views/recomendaciones.php">Para ti!</a></li>
                                <li><a class="dropdown-item" href="#">Configuración</a></li>
                                <li><a class="dropdown-item" href="/views/preguntas.php">Ayuda</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="/controllers/controlador_cerrar_seccion.php">Cerrar Sesión</a></li>
                            </ul>
                        </div>';
                } else {
                    echo '<div class="dropdown text-end">
                            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img class="perfil" src="/assents/imag/avatar/user.png" alt="mdo" width="40" height="40" class="rounded-circle">
                            </a>
                            <ul class="dropdown-menu text-small dropdown-menu-end" aria-labelledby="dropdownUser1" style="">
                                <li><a class="dropdown-item" href="/views/login.php">Login</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="/views/createLogin.php">Regístrate</a></li>
                            </ul>
                        </div>';
                }
                ?>
            </div>
        </div>
    </nav>
</header>
