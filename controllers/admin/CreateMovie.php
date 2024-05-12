<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnRegistrar']) && $_POST['btnRegistrar'] == 'ok') {
    // Incluir el archivo de conexión a la base de datos
    include "../../config/conexion.php";

    // Obtener los datos del formulario
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $anio = $_POST['anio'];
    $duracion = $_POST['duracion'];
    $url = $_POST['url'];
    $director = $_POST['director'];

    // Preparar la consulta SQL para insertar los datos
    $sql=$conexion->query("INSERT INTO cineandes.movie (titulo, descripcion, año, duracion, url, director) VALUES ('$titulo', '$descripcion','$anio' ,'$duracion' ,'$url' ,'$director' )");
    // Ejecutar la consulta
    if ($sql==1) {
      // Mostrar Sweet Alert 2
      echo "<script>
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Registro Exitoso',
                showConfirmButton: false,
                timer: 3000
              });
            </script>";

            echo "<script>
            console.log('La película tiene una duración de $duracion minutos.');
          </script>";
  } else {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ya existe ese título de Película!',
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
