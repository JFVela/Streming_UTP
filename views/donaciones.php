<?php
session_start();
//puedo agregar logica que necesita de login jeje
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Galería de Donaciones</title>
  <link rel="stylesheet" href="../assents/css/donaciones.css">
</head>
<body>
  <div class="container">
    <div class="donation-gallery">
      <div class="gallery">
        <?php
        $donation_images = array("Peliculas1.jpg", "Peliculas2.avif");
        foreach ($donation_images as $image) {
            echo "<img src='../assents/imag/$image' alt='Donación'>";
            // Los botones de flecha se agregan dentro del bucle para que estén encima de cada imagen
            echo "<button class='prev' onclick='prevImage()'>&#10094;</button>";
            echo "<button class='next' onclick='nextImage()'>&#10095;</button>";
        }
        ?>        
      </div>
    </div>
  </div>
  <script src="../assents/script/script.js"></script>
</body>
</html>