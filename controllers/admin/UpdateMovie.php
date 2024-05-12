<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnActualizar1']) && $_POST['btnActualizar1'] == 'actualizar') {
    // Incluir el archivo de conexión a la base de datos
    include "../../config/conexion.php";

    // Obtener los datos del formulario
    $idPelicula = $_POST['idPelicula'];
    $titulo = $_POST['titulo1'];
    $descripcion = $_POST['descripcion1'];
    $anio = $_POST['anio1'];
    $duracion = $_POST['duracion1'];
    $url = $_POST['url1'];
    $director = $_POST['director1'];

    // Preparar la consulta SQL para actualizar los datos
    $sql = $conexion->query("UPDATE cineandes.movie SET titulo='$titulo', descripcion='$descripcion', año='$anio', duracion='$duracion', url='$url', director='$director' WHERE idPelicula='$idPelicula'");
    
    // Ejecutar la consulta
    if ($sql==1) {
        // Mostrar Sweet Alert 2
        echo "<script>
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Actualización Exitosa',
                showConfirmButton: false,
                timer: 3000
              });
            </script>";

        echo "<script>
            console.log('La película con ID $idPelicula ha sido actualizada.');
          </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ha ocurrido un error al actualizar la película',
                imageUrl: '../../assents/imag/error.gif',
                imageWidth: 400,
                imageHeight: 200
            });
          </script>";
    }
    // Cerrar la conexión a la base de datos
    $conexion->close();
}
?>
