<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--Iconos Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--INCLUDES-->
    <link rel="stylesheet" href="/assents/css/includes.css">
    <!--Titulo-->
    <title>Preguntas Frecuentes</title>
    <!--ESTILOS-->
    <link rel="stylesheet" type="text/css" href="/assents/css/preguntas.css">
</head>

<body>
    <!--HEADER-->
    <?php include "../includes/header.php"; ?>
    <div class="contenidoPregunta">
        <h1 class="titulo">Preguntas Frecuentes en CineAndes</h1>
        <?php
        $Preguntas = [
            "¿Cómo puedo registrarme en CineAndes?",
            "¿Cuánto cuesta usar CineAndes?",
            "¿Puedo ver películas en CineAndes sin conexión a Internet?",
            "¿Qué tipos de películas están disponibles en CineAndes?",
            "¿Cómo puedo buscar películas en CineAndes?",
            "¿Qué dispositivos son compatibles con CineAndes?",
            "¿Cómo puedo contactar al equipo de soporte de CineAndes?",
            "¿CineAndes está disponible en otros idiomas además de español?",
            "¿Cómo puedo cancelar mi suscripción a CineAndes?"
        ];

        $Respuestas = [
            "Para registrarte en CineAndes, simplemente haz clic en el botón \"Registrarse\" en la esquina superior derecha de la página de inicio. Luego, sigue las instrucciones para completar el proceso de registro.",
            "El uso de CineAndes es completamente gratuito. No hay costos asociados con la creación de una cuenta o la transmisión de películas en nuestra plataforma.",
            "Sí, ofrecemos la opción de descargar películas para verlas sin conexión. Para ello, simplemente selecciona la opción de descarga en la película que deseas ver y luego podrás acceder al contenido descargado desde tu dispositivo sin conexión a Internet.",
            "En CineAndes, ofrecemos una amplia variedad de películas que incluyen géneros como drama, comedia, acción, suspenso, documentales y más. Nuestro objetivo es proporcionar contenido diverso y relevante para todos los gustos.",
            "Puedes buscar películas en CineAndes utilizando la barra de búsqueda en la parte superior de la página. También puedes explorar diferentes categorías y géneros utilizando los filtros disponibles en la página de inicio.",
            "CineAndes es compatible con una amplia gama de dispositivos, incluyendo computadoras de escritorio, laptops, tablets, teléfonos inteligentes, Smart TVs y consolas de juegos.",
            "Para ponerse en contacto con nuestro equipo de soporte, simplemente envía un correo electrónico a support@cineandes.com. Estamos disponibles para ayudarte con cualquier pregunta o problema que puedas tener.",
            "Actualmente, CineAndes está disponible únicamente en español. Sin embargo, estamos trabajando en la implementación de soporte para otros idiomas en el futuro.",
            "Si deseas cancelar tu suscripción a CineAndes, puedes hacerlo desde la sección de configuración de tu cuenta. Simplemente sigue las instrucciones para cancelar tu suscripción y dejarás de recibir cualquier cargo recurrente."
        ];
        ?>

        <div class="accordion" id="accordionPanelsStayOpenExample">
            <?php for ($i = 0; $i < count($Preguntas); $i++) { ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?php echo $i; ?>">
                        <button class="accordion-button <?php echo $i === 0 ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $i; ?>" aria-expanded="false" aria-controls="collapse<?php echo $i; ?>">
                            <h3><?php echo $Preguntas[$i]; ?></h3>
                        </button>
                    </h2>
                    <div id="collapse<?php echo $i; ?>" class="accordion-collapse collapse <?php echo $i === 0 ? 'show' : ''; ?>" aria-labelledby="heading<?php echo $i; ?>">
                        <div class="accordion-body">
                            <h4><?php echo $Respuestas[$i]; ?></h4>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!--FOOTER-->
    <?php include "../includes/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>