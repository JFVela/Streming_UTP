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
        foreach ($donation_images as $index => $image) {
            echo "<img src='../assents/imag/$image' alt='Donación' class='gallery-image' data-index='$index'>";
        }
        ?>        
        <div class="donation-message" id="donationMessage1">
          <p>Ayúdanos en nuestra meta</p>
          <button onclick="window.location.href='donar.html'">Donar monto a elección</button>
        </div>
        <div class="donation-message-2" id="donationMessage2">
          <p>Juntos revolucionaremos el mundo del streaming</p>
          <button onclick="window.location.href='nosotros.php'">Conoce más...</button>
        </div>
        <button class='prev' onclick='prevImage()'>&#10094;</button>
        <button class='next' onclick='nextImage()'>&#10095;</button>
      </div>
    </div>
</div>
<div class="donation-levels">
      <h2>Niveles de Donación</h2>
      <div class="level">
        <h3>Nivel Básico</h3>
        <p>Acceso a contenido exclusivo y eventos especiales.</p>
        <button onclick="window.location.href='donar.html'">Donar</button>
      </div>
      <div class="level">
        <h3>Nivel Premium</h3>
        <p>Acceso anticipado a nuevas series y películas.</p>
        <button onclick="window.location.href='donar.html'">Donar</button>
      </div>
      <div class="level">
        <h3>Nivel VIP</h3>
        <p>Asistencia a eventos VIP y encuentros con actores y creadores.</p>
        <button onclick="window.location.href='donar.html'">Donar</button>
      </div>
    </div>

    <div class="testimonials">
      <h2>Testimonios de Donantes</h2>
      <div class="testimonial">
        <p>"Gracias a las donaciones, el contenido ha mejorado enormemente y ahora disfruto de nuevas series cada mes." - Juan Pérez</p>
      </div>
      <div class="testimonial">
        <p>"Me encanta ser parte de esta comunidad y apoyar a los creadores de contenido que tanto disfruto." - María García</p>
      </div>
    </div>

    <div class="donor-benefits">
      <h2>Beneficios para Donantes</h2>
      <div class="benefit">
        <p>Acceso a contenido exclusivo.</p>
      </div>
      <div class="benefit">
        <p>Invitaciones a eventos especiales.</p>
      </div>
      <div class="benefit">
        <p>Descuentos en merchandising.</p>
      </div>
    </div>
</div>
<script src="../assents/script/script.js"></script>
</body>
</html>