<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Boostrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--Iconos Boostrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--Iconos Google-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!--INCLUDES-->
    <link rel="stylesheet" href="/assents/css/includes.css">
    <!--Titulo-->
    <title>CineTotal</title>
    <!--FAVICON-->
    <link rel="icon" type="image/png" href="/assents/imag/favicon/cine.png">
    <!--ESTILOS-->
    <link rel="stylesheet" href="../assents/css/inicio.css">
</head>

<body>

    <!--HEADER-->
    <?php
    include "../includes/header.php";
    ?>
    <!--FIN HEADER-->

    <section class="Grupo_Cartas">
        <?php
        if (isset($_SESSION['idUsuario'])) {
            echo "<h1>Resultados de Búsqueda</h1>";

            if (isset($_GET['consulta'])) {
                $consulta = $_GET['consulta'];
                include '../controllers/obtenerTF-IDF.php';

                // Asegurarse de que la palabra clave esté definida y no vacía
                if (!empty($consulta)) {
                    $tfidf_documentos = calcularTfidf($documentos);

                    $consulta_tokens = explode(" ", strtolower($consulta));
                    $tfidf_consulta = [];
                    foreach ($consulta_tokens as $palabra) {
                        if (!empty($palabra)) {
                            $tf_consulta = substr_count(strtolower($consulta), $palabra) / count($consulta_tokens);
                            $idf_consulta = log(count($documentos) / (isset($diccionario[$palabra]) ? $diccionario[$palabra] + 1 : 1), 2);
                            $tfidf_consulta[$palabra] = $tf_consulta * $idf_consulta;
                        }
                    }

                    $similitudes = [];
                    foreach ($tfidf_documentos as $i => $tfidf_doc) {
                        $similitud = cosineSimilarity($tfidf_consulta, $tfidf_doc);
                        $similitudes[$i] = $similitud;
                    }

                    arsort($similitudes); ?>
                    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-6 g-4">
                        <?php foreach ($similitudes as $i => $similitud) {
                            if ($similitud > 0) { ?>
                                <div class="col">
                                    <a href="#" class="Cartas btn card h-100">
                                        <img src="<?php echo $portada[$i]; ?>" class="card-img-top" alt="<?php echo $titulos[$i]; ?>">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $titulos[$i]; ?></h5>
                                        </div>
                                        <div class="card-footer">
                                            <h6>
                                                <i class="bi bi-search" style="color: yellow;"></i> Similitud: <?php echo number_format($similitud * 100, 2) . "%"; ?>
                                            </h6>
                                        </div>
                                    </a>
                                </div>
                        <?php
                            }
                        } ?>
                    </div>
        <?php
                } else {
                    echo "La palabra clave no está definida.";
                }
            } else {
                echo "No se ha proporcionado una palabra clave para buscar.";
            }
        } else {
            include "../includes/mensajeError.php";
        }
        ?>
    </section>

    <!--FOOTER-->
    <?php
    include "../includes/footer.php";
    ?>
    <!--FIN FOOTER-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>