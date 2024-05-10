<?php
include "../../config/conexion.php";

$id = $_POST['id'];

$sql = $conexion->prepare("SELECT * FROM cineandes.movie WHERE idMovie = ?");
$sql->bind_param("i", $id);
$sql->execute();
$result = $sql->get_result();
$datos = $result->fetch_object();

// Generar el formulario de actualización
$formulario = <<<HTML
<form id="updateForm" action="update_movie.php" method="post">
                    <input type="hidden" name="id" value="<?= $datos->idMovie ?>">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título de la película</label>
                        <input type="text" id="titulo" name="titulo" class="form-control" value="<?= $datos->titulo ?>" required maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea id="descripcion" name="descripcion" class="form-control" required><?= $datos->descripcion ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="anio" class="form-label">Año</label>
                            <input type="number" id="anio" name="anio" class="form-control" value="<?= $datos->año ?>" min="1888" max="9999" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="duracion" class="form-label">Duración (HH:MM:SS)</label>
                            <input type="text" id="duracion" name="duracion" class="form-control" value="<?= $datos->duracion ?>" pattern="[0-9]{2}:[0-5][0-9]:[0-5][0-9]" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="url" class="form-label">URL de la película</label>
                        <input type="url" id="url" name="url" class="form-control" value="<?= $datos->url ?>" maxlength="255" required>
                    </div>
                    <div class="mb-3">
                        <label for="director" class="form-label">Director</label>
                        <input type="text" id="director" name="director" class="form-control" value="<?= $datos->director ?>" maxlength="100" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="btnActualizar">Actualizar</button>
                </form>
HTML;

// Devolver el formulario como respuesta
echo $formulario;
