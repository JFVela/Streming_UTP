<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnRegistrar']) && $_POST['btnRegistrar'] == 'ok') {
    include "../../config/conexion.php";

    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $anio = $_POST['anio'];
    $duracion = $_POST['duracion'];
    $url = $_POST['url'];
    $director = $_POST['director'];

    $sql=$conexion->query("INSERT INTO cineandes.movie (titulo, descripcion, año, duracion, url, director) VALUES ('$titulo', '$descripcion','$anio' ,'$duracion' ,'$url' ,'$director' )");
    if ($sql==1) {
      echo "<script>
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Registro Exitoso',
                showConfirmButton: false,
                timer: 3000
              });
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
    $conexion->close();
}
?>