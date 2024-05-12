<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnActualizar']) && $_POST['btnActualizar'] == 'actualizar') {
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
    $sql = $conexion->query("UPDATE cineandes.movie SET titulo='$titulo', descripcion='$descripcion', año='$anio', duracion='$duracion', url='$url', director='$director' WHERE idMovie='$idPelicula'");
    if ($sql === false) {
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
    } else {
      echo "<script>
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Registro Exitoso',
        showConfirmButton: false,
        timer: 3000
      });
    </script>";    
    }
    $conexion->close();
  }
?>
