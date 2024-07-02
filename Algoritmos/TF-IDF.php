<?php
//CONEXION A BASE DE DATOS
include '../config/conexion.php';

// Consulta SQL preparada para seleccionar los títulos de películas
$sql = "SELECT 
            m.idMovie AS ID,
            m.titulo AS Pelicula,
            m.descripcion AS Descripcion,
            m.año AS Año,
            m.duracion AS Duracion,
            m.director AS Director,
            GROUP_CONCAT(g.nomb_genero ORDER BY g.nomb_genero ASC SEPARATOR ', ') AS Genero
        FROM 
            movie m
        JOIN 
            movie_genero mg ON m.idMovie = mg.Movie_id
        JOIN 
            genero g ON mg.Genero_id = g.id_Genero
        GROUP BY 
            m.idMovie, m.titulo, m.descripcion, m.año, m.duracion, m.director
        ORDER BY 
            m.titulo ASC";

$stmt = $conexion->prepare($sql);

// Verificar si la preparación fue exitosa
if ($stmt === false) {
    die("Error al preparar la consulta: " . $conexion->error);
}

// Ejecutar la consulta
$stmt->execute();
$resultado = $stmt->get_result();
$documentos = [];
$titulos = [];


if ($resultado->num_rows > 0) {
    // Recorrer cada fila del resultado
    while ($fila = $resultado->fetch_assoc()) {
        $documentos[] = $fila['Pelicula'] . " " . $fila['Descripcion'] . " " . $fila['Año'] . " " . $fila['Duracion'] . " " . $fila['Director'] . " " . $fila['Genero'];
        $id_DB[] = $fila['ID'];
        $titulos[] = $fila['Pelicula'];
    }
} else {
    echo "No se encontraron resultados";
}

// Liberar el resultado y cerrar la conexión
$resultado->free();
$stmt->close();
$conexion->close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Algoritmo de Búsqueda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<style>
    .table {
        width: 100%;
        margin-left: auto;
        margin-right: auto;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
    }

    .contenido {
        padding: 1%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .contenido1 {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-left: 10px;
    }

    .line {
        width: 200px;
        border-top: 1px solid black;
        margin: 10px 0;
    }

    .coseno,
    .resultado,
    .datos,
    .tf-idf {
        margin: 5%;
        padding: 2%;
        border-radius: 20px;
        border: 2px dashed;
    }

    .coseno {
        background-color: #CDE8E5;
    }

    .resultado {
        background-color: #CDFADB;
    }

    .datos {
        background-color: #5C88C4;
    }

    .tf-idf {
        background-color: #1A2130;
        color: #FDFFE2;
    }

    .coseno table th {
        background-color: #4D869C;
    }

    .coseno table td {
        background-color: #EEF7FF;
    }

    .resultado table th {
        background-color: #FFCF96;
    }

    .resultado table td {
        background-color: #F6FDC3;
    }

    .datos table tr {
        background-color: #6FDCE3;
    }

    .datos table td {
        background-color: #FFFDB5;
    }

    .tf-idf table th {
        background-color: #83B4FF;
    }

    .tf-idf table td {
        background-color: #FDFFE2;
    }
</style>

<body>
    <h1>Algoritmo de Búsqueda de Películas</h1>
    <form class="row g-3" method="post">
        <div class="col-auto">
            <label for="consulta" class="visually-hidden">Palabra clave</label>
            <input type="text" class="form-control" id="consulta" name="consulta" placeholder="Palabra clave">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Buscar</button>
        </div>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $consulta = htmlspecialchars($_POST['consulta']);
        echo "Consulta: " . $consulta . "<br>";
    }

    // Función para tokenizar y calcular TF-IDF
    function calcularTfidf($documentos)
    {
        // Crear un diccionario de términos y su frecuencia en cada documento
        $diccionario = [];
        foreach ($documentos as $doc) {
            $palabras = explode(" ", strtolower($doc));
            foreach ($palabras as $palabra) {
                if (!isset($diccionario[$palabra])) {
                    $diccionario[$palabra] = 1;
                } else {
                    $diccionario[$palabra]++;
                }
            }
        }

        echo "<pre>";
        echo "Documentos:";
        print_r($documentos);
        echo "</pre>";

        // Calcular el total de documentos
        $total_documentos = count($documentos);
        echo "Total de documentos: " . $total_documentos . "<br>";

        // Calcular TF-IDF para cada término en cada documento
        $tfidf = [];
        foreach ($documentos as $i => $doc) {
            $palabras = explode(" ", strtolower($doc));
            echo "<div class='tf-idf'>
                    <h1>Operación $i TF-IDF:</h1>";
            echo "      <div class='table-responsive'>
                        <table class='table table-striped-columns'>
                            <thead>
                                <th scope='col'>PALABRA</th>
                                <th scope='col'># Veces que aparece la palabra</th>
                                <th scope='col'># Total de palabras en el doc</th>
                                <th scope='col'>TF <br>(#VECES/TOTAL)</th>
                                <th scope='col'>TOTAL DOC</th>
                                <th scope='col'>Doc con el Termino</th>
                                <th scope='col'>IDF <br>Log(T.Doc/V.Doc)</th>
                                <th scope='col'>TF-IDF <br>(TF x IDF)</th>
                            </thead>
                            <tbody>";
            foreach ($palabras as $palabra) {
                // Calcular TF (Frecuencia del término)
                $tf = substr_count(strtolower($doc), $palabra) / count($palabras);
                // Calcular IDF (Frecuencia inversa de documento)
                $idf = log($total_documentos / ($diccionario[$palabra] + 1), 2);
                // Calcular TF-IDF
                $tfidf[$i][$palabra] = $tf * $idf;
                //Variables para la tabla
                $TF_IDF_Tabla = $tf * $idf;
                $NumVecesAparecePalabra = substr_count(strtolower($doc), $palabra);
                $NumTotalPalabDocumento = count($palabras);
                $DocTermino = $diccionario[$palabra];

                echo "  <tr>
                            <td><b>$palabra</b></td>
                            <td>$NumVecesAparecePalabra</td>
                            <td>$NumTotalPalabDocumento</td>
                            <td><b>$tf</b></td>
                            <td>$total_documentos</td>
                            <td>$DocTermino</td>
                            <td><b>$idf</b></td>
                            <td><b>$TF_IDF_Tabla</b></td>
                        </tr>";
            }
            echo "</tbody>
                    </table>
                        </div>
                            </div>";
        }

        return $tfidf;
    }


    // Función para calcular la similitud coseno entre dos vectores
    function cosineSimilarity($vec1, $vec2)
    {
        $dotProduct = 0;
        $magnitude1 = 0;
        $magnitude2 = 0;
        $ArrayPalabraBuscada = [];
        $ArrayV1_TF_IDF = [];
        $ArrayV2_TF_IDF = [];
        $ArrayProducto = [];
        static $documentNumber = 0;

        // Calcular producto punto y magnitudes
        foreach ($vec1 as $key => $value1) {
            $value2 = isset($vec2[$key]) ? $vec2[$key] : 0;
            $dotProduct += $value1 * $value2;
            $magnitude1 += $value1 ** 2;
            $magnitude2 += $value2 ** 2;

            //Guardar valores
            $ArrayPalabraBuscada[] = $key;
            $ArrayV1_TF_IDF[] = $value1;
            $ArrayV2_TF_IDF[] = $value2;
            $ArrayProducto[] = $value1 * $value2;
        }

        $magnitudeFinal1 = sqrt($magnitude1);
        $magnitudeFinal2 = sqrt($magnitude2);

    ?>
        <div class="coseno">
            <h2>Operación <?php echo $documentNumber; ?> Similitud de Coseno</h2>
            <div class="table-responsive">
                <table class='table table-striped-columns'>
                    <thead>
                        <tr>
                            <th scope='col'>#</th>
                            <?php foreach ($ArrayPalabraBuscada as $key) { ?>
                                <th scope='col'><?php echo $key; ?></th>
                            <?php } ?>
                            <th scope='col'>Σ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Vector 1</td>
                            <?php foreach ($ArrayV1_TF_IDF as $value1) { ?>
                                <td><?php echo $value1; ?></td>
                            <?php } ?>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>Vector 2</td>
                            <?php foreach ($ArrayV2_TF_IDF as $value2) { ?>
                                <td><?php echo $value2; ?></td>
                            <?php } ?>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>Producto Punto</td>
                            <?php
                            $sumaProducto = 0;
                            foreach ($ArrayProducto as $producto) {
                                $sumaProducto += $producto;
                            ?>
                                <td><?php echo $producto; ?></td>
                            <?php } ?>
                            <td><?php echo $sumaProducto; ?></td>
                        </tr>
                        <tr>
                            <td>Mag.Parc 1 (TF-IDF)²</td>
                            <?php foreach ($ArrayV1_TF_IDF as $value1) { ?>
                                <td><?php echo pow($value1, 2); ?></td>
                            <?php } ?>
                            <td><?php echo $magnitude1; ?></td>
                        </tr>
                        <tr>
                            <td>Mag.Parc 2 (TF-IDF)²</td>
                            <?php foreach ($ArrayV2_TF_IDF as $value2) { ?>
                                <td><?php echo pow($value2, 2); ?></td>
                            <?php } ?>
                            <td><?php echo $magnitude2; ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Vector 1</th>
                            <th scope="col">Vector 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Σ Magn.Parc</th>
                            <td><?php echo $magnitude1; ?></td>
                            <td><?php echo $magnitude2; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Modulo: √(Mag.Parc)</th>
                            <td><?php echo $magnitudeFinal1; ?></td>
                            <td><?php echo $magnitudeFinal2; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="contenido">
                <p>Cos(θ) =</p>
                <div class="contenido1">
                    <div>Σ Prod.Punto: <?php echo number_format($dotProduct, 6); ?></div>
                    <div class="line"></div>
                    <div><?php echo number_format($magnitudeFinal1, 6); ?> x <?php echo number_format($magnitudeFinal2, 6); ?></div>
                </div>
            </div>
            <div class="contenido">
                <div>Cos(θ) =&nbsp;</div>
                <div>
                    <?php
                    if ($magnitudeFinal1 != 0 && $magnitudeFinal2 != 0) {
                        $cosineSimilarity = $dotProduct / ($magnitudeFinal1 * $magnitudeFinal2);
                        echo $cosineSimilarity;
                    } else {
                        echo "0";
                    }
                    ?>
                </div>
            </div>
            <div class="contenido">
                <?php
                if ($magnitudeFinal1 != 0 && $magnitudeFinal2 != 0) {
                    echo "<div>Similitud Coseno: " . number_format($cosineSimilarity * 100, 2) . "%</div>";
                } else {
                    echo "<div>Similitud Coseno: 0.00%</div>";
                }
                ?>
            </div>
        </div>
        <?php

        $documentNumber++;
        // Calcular similitud coseno
        if ($magnitudeFinal1 != 0 && $magnitudeFinal2 != 0) {
            $cosineSimilarity = $dotProduct / ($magnitudeFinal1 * $magnitudeFinal2);
            return $cosineSimilarity;
        } else {
            return 0;
        }
    }

    if (!isset($consulta)) {
        echo "La palabra clave no esta definida";
    } else {
        // Calcular TF-IDF para los documentos
        $tfidf_documentos = calcularTfidf($documentos);

        // Tokenizar y calcular TF-IDF para la consulta
        $consulta_tokens = explode(" ", strtolower($consulta));
        $tfidf_consulta = [];
        foreach ($consulta_tokens as $palabra) {
            if (!empty($palabra)) {
                // Calcular TF (Frecuencia del término) para la consulta
                $tf_consulta = substr_count(strtolower($consulta), $palabra) / count($consulta_tokens);
                // Calcular IDF (Frecuencia inversa de documento) para la consulta
                $idf_consulta = log(count($documentos) / (isset($diccionario[$palabra]) ? $diccionario[$palabra] + 1 : 1), 2);
                // Calcular TF-IDF para la consulta
                $tfidf_consulta[$palabra] = $tf_consulta * $idf_consulta;
            }
        }

        // Calcular similitud coseno entre la consulta y cada documento
        $similitudes = [];
        foreach ($tfidf_documentos as $i => $tfidf_doc) {
            $similitud = cosineSimilarity($tfidf_consulta, $tfidf_doc);
            $similitudes[$i] = $similitud;
        }

        // Obtener el documento más relevante (mayor similitud)
        arsort($similitudes);
        $index_mas_relevante = key($similitudes); // Obtiene el índice del documento más relevante
        $documento_mas_relevante = $id_DB[$index_mas_relevante];
        $TituloPeli_Relevante = $titulos[$index_mas_relevante];
        $A = number_format($similitudes[$index_mas_relevante] * 100, 2); // Calcula el porcentaje de similitud


        // Valores para la tabla
        $ClaveDoc = [];
        $ClavePeli = [];
        $TituloSimilitud = [];
        $PorcentajeSimilitud = [];

        // Contadores
        $contadorMuy = 0;
        $contadorSimilar = 0;
        $contadorCasi = 0;
        $contadorPoco = 0;
        $contadorNada = 0;

        // Índice separado para los arrays
        $i_1 = 0;
        $i_2 = 0;
        $i_3 = 0;
        $i_4 = 0;
        $i_5 = 0;

        // Logica
        foreach ($similitudes as $clave => $valorCos) {
            $ClaveDoc[] = $clave;
            $ClavePeli[] = $id_DB[$clave];
            $TituloSimilitud[] = $titulos[$clave];
            $PorcentajeSimilitud[] = number_format($valorCos * 100, 2);

            if ($valorCos >= 0.80 && $valorCos <= 1.00) {
                $contadorMuy++;
            } elseif ($valorCos >= 0.60 && $valorCos < 0.80) {
                $contadorSimilar++;
            } elseif ($valorCos >= 0.40 && $valorCos < 0.60) {
                $contadorCasi++;
            } elseif ($valorCos >= 0.20 && $valorCos < 0.40) {
                $contadorPoco++;
            } elseif ($valorCos >= 0.00 && $valorCos < 0.20) {
                $contadorNada++;
            } else {
                echo "Fuera de rango";
            }
        }
        ?>


        <div class="resultado">
            <h1>Resultados Final:</h1>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="3" class="align-middle"><b>Película más Similar</b></th>
                        </tr>
                        <tr>
                            <th style="width: 20%;">Documento</th>
                            <th style="width: 20%;">ID</th>
                            <th>Título</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php if ($A != 0) { ?>
                                <td><?php echo $index_mas_relevante; ?></td>
                                <td><?php echo $documento_mas_relevante; ?></td>
                                <td><b><?php echo $TituloPeli_Relevante; ?></b></td>
                            <?php } else { ?>
                                <td>#</td>
                                <td>#</td>
                                <td><b>No existe coincidencia alguna</b></td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="datos">
            <h1>Resultados:</h1>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 15%;" rowspan="2" class="align-middle">SIMILITUD</th>
                            <th colspan="4">Datos</th>
                        </tr>
                        <tr>
                            <th style="width: 15%;">Documento</th>
                            <th style="width: 15%;">ID</th>
                            <th>Título</th>
                            <th style="width: 15%;">%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($contadorMuy > 0) { ?>
                            <tr>
                                <td rowspan="<?php echo $contadorMuy; ?>" class="align-middle">Muy Similar<br>(80%-100%)</td>
                                <?php
                                $i_1 = 0;
                                foreach ($similitudes as $clave => $valorCos) {
                                    if ($valorCos >= 0.80 && $valorCos <= 1.00) {
                                ?>
                                        <td><?php echo $ClaveDoc[$i_1]; ?></td>
                                        <td><?php echo $ClavePeli[$i_1]; ?></td>
                                        <td><?php echo $TituloSimilitud[$i_1]; ?></td>
                                        <td><?php echo $PorcentajeSimilitud[$i_1]; ?></td>
                            </tr>
                    <?php
                                    }
                                    $i_1++;
                                }
                            } else { ?>
                    <tr>
                        <td class="align-middle">Muy Similar<br>(80%-100%)</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                <?php } ?>

                <?php if ($contadorSimilar > 0) { ?>
                    <tr>
                        <td rowspan="<?php echo $contadorSimilar; ?>" class="align-middle">Similar<br>(60%-80%)</td>
                        <?php
                        $i_2 = 0;
                        foreach ($similitudes as $clave => $valorCos) {
                            if ($valorCos >= 0.60 && $valorCos < 0.80) {
                        ?>
                                <td><?php echo $ClaveDoc[$i_2]; ?></td>
                                <td><?php echo $ClavePeli[$i_2]; ?></td>
                                <td><?php echo $TituloSimilitud[$i_2]; ?></td>
                                <td><?php echo $PorcentajeSimilitud[$i_2]; ?></td>
                    </tr>
            <?php
                            }
                            $i_2++;
                        }
                    } else { ?>
            <tr>
                <td class="align-middle">Similar<br>(60%-80%)</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
            </tr>
        <?php } ?>

        <?php if ($contadorCasi > 0) { ?>
            <tr>
                <td rowspan="<?php echo $contadorCasi; ?>" class="align-middle">Moderadamente Similar<br>(40%-60%)</td>
                <?php
                $i_3 = 0;
                foreach ($similitudes as $clave => $valorCos) {
                    if ($valorCos >= 0.40 && $valorCos < 0.60) {
                ?>
                        <td><?php echo $ClaveDoc[$i_3]; ?></td>
                        <td><?php echo $ClavePeli[$i_3]; ?></td>
                        <td><?php echo $TituloSimilitud[$i_3]; ?></td>
                        <td><?php echo $PorcentajeSimilitud[$i_3]; ?></td>
            </tr>
    <?php
                    }
                    $i_3++;
                }
            } else { ?>
    <tr>
        <td class="align-middle">Moderadamente Similar<br>(40%-60%)</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>
<?php } ?>

<?php if ($contadorPoco > 0) { ?>
    <tr>
        <td rowspan="<?php echo $contadorPoco; ?>" class="align-middle">Poca Similitud<br>(20%-40%)</td>
        <?php
            $i_4 = 0;
            foreach ($similitudes as $clave => $valorCos) {
                if ($valorCos >= 0.20 && $valorCos < 0.40) {
        ?>
                <td><?php echo $ClaveDoc[$i_4]; ?></td>
                <td><?php echo $ClavePeli[$i_4]; ?></td>
                <td><?php echo $TituloSimilitud[$i_4]; ?></td>
                <td><?php echo $PorcentajeSimilitud[$i_4]; ?></td>
    </tr>
<?php
                }
                $i_4++;
            }
        } else { ?>
<tr>
    <td class="align-middle">Poca Similitud<br>(20%-40%)</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
</tr>
<?php } ?>

<?php if ($contadorNada > 0) { ?>
    <tr>
        <td rowspan="<?php echo $contadorNada; ?>" class="align-middle">Sin Similitud<br>(0%-20%)</td>
        <?php
            $i_5 = 0;
            foreach ($similitudes as $clave => $valorCos) {
                if ($valorCos >= 0 && $valorCos < 0.20) {
        ?>
                <td><?php echo $ClaveDoc[$i_5]; ?></td>
                <td><?php echo $ClavePeli[$i_5]; ?></td>
                <td><?php echo $TituloSimilitud[$i_5]; ?></td>
                <td><?php echo $PorcentajeSimilitud[$i_5]; ?></td>
    </tr>
<?php
                }
                $i_5++;
            }
        } else { ?>
<tr>
    <td class="align-middle">Sin Similitud<br>(0%-20%)</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
</tr>
<?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>