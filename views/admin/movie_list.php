<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../assents/css/movie_list.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <h1 class="text-center">Peliculas</h1>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Película</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="tableModal" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Year</th>
                                <th>Duration</th>
                                <th>URL</th>
                                <th>Director</th>
                            </tr>
                        </thead>
                        <tbody id='cuerpo'>
                            <!-- Contenido de la tabla -->
                        </tbody>
                    </table>

                    <!-- Formulario para modificar los detalles de la película -->
                    <form id="editForm" method="post">
                        <?php
                        include "../../controllers/admin/UpdateMovie.php";
                        ?>
                        <!-- Campo oculto para el ID de la película -->
                        <input type="" id="idPelicula" name="idPelicula">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="titulo1" class="form-label">Título de la película</label>
                                <input type="text" id="titulo1" name="titulo1" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="descripcion1" class="form-label">Descripción</label>
                                <textarea id="descripcion1" name="descripcion1" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="anio1" class="form-label">Año</label>
                                <input type="number" id="anio1" name="anio1" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="duracion1" class="form-label">Duración (HH:MM:SS)</label>
                                <input type="text" id="duracion1" name="duracion1" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="url1" class="form-label">URL de la película</label>
                                <input type="url" id="url1" name="url1" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="director1" class="form-label">Director</label>
                                <input type="text" id="director1" name="director1" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning" name="btnActualizar" value="actualizar">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-between">
            <form class="col-md-5 p-3 mx-auto" method="post">
                <fieldset>
                    <legend class="text-center text-secondary">Registrar peliculas</legend>
                    <?php
                    include "../../controllers/admin/CreateMovie.php";
                    ?>
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título de la película</label>
                        <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Ingrese el título" required maxlength="100">
                        <div class="invalid-feedback">
                            Por favor, ingrese el título de la película.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea id="descripcion" name="descripcion" class="form-control" placeholder="Ingrese la descripción" required></textarea>
                        <div class="invalid-feedback">
                            Por favor, ingrese la descripción de la película.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="anio" class="form-label">Año</label>
                            <input type="number" id="anio" name="anio" class="form-control" placeholder="Ingrese el año" min="1888" max="9999" required>
                            <div class="invalid-feedback">
                                Por favor, ingrese un año válido.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="duracion" class="form-label">Duración (HH:MM:SS)</label>
                            <input type="time" step="2" id="duracion" name="duracion" class="form-control" required>
                            <div class="invalid-feedback">
                                Por favor, ingrese una duración válida en formato HH:MM:SS.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="url" class="form-label">URL de la película</label>
                        <input type="url" id="url" name="url" class="form-control" placeholder="Ingrese la URL" maxlength="255" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese una URL válida.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="director" class="form-label">Director</label>
                        <input type="text" id="director" name="director" class="form-control" placeholder="Ingrese el nombre del director" maxlength="100" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese el nombre del director de la película.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success" name="btnRegistrar" value="ok">Agregar</button>
                </fieldset>
            </form>
            <div class="col-md-6 p-3 table-container mx-auto">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Year</th>
                            <th>Duration</th>
                            <th>Director</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "../../config/conexion.php";
                        $sql = $conexion->query("SELECT * FROM cineandes.movie");
                        while ($datos = $sql->fetch_object()) {
                        ?>
                            <tr>
                                <td><?= $datos->idMovie ?></td>
                                <td><?= $datos->titulo ?></td>
                                <td><?= $datos->año ?></td>
                                <td><?= $datos->duracion ?></td>
                                <td><?= $datos->director ?></td>
                                <td>
                                    <button type="button" class="btn btn-small btn-warning editBtn" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $datos->idMovie ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </td>

                                <td>
                                    <a href="" class="btn btn-small btn-danger"><i class="bi bi-file-earmark-x"></i></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Year</th>
                            <th>Duration</th>
                            <th>Director</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
    <!-- Bootstrap Bundle -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script src="../../assents/script/getMovieTable.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>

</html>