<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stalyn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- LINK GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assents/css/nosotros.css">
</head>

<body>
    <!--HEADER-->
    <?php
    include "../includes/header.php";
    ?>
    <section class="about bg-light py-5" id="about">
        <div class="container">
            <h1 class="display-4 text-center mb-5">NOSOTROS</h1>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="/assents/imag/nosotros/proposito.jpg" class="img-fluid rounded mb-4" alt="Our Purpose">
                </div>
                <div class="col-lg-6">
                    <h3 class="text-center">NUESTRO PROPÓSITO</h3>
                    <p class="text-center">Queremos ser un faro de inspiración en el vasto océano del 
                        entretenimiento digital. Nos esforzamos por crear experiencias que cautiven, 
                        emocionen y conecten a nuestra comunidad. Desde las historias más épicas hasta las 
                        comedias más encantadoras, nuestro propósito es ofrecer un escape a través del poder 
                        del streaming. Nos enorgullecemos de ser un destino donde la diversidad es celebrada, 
                        donde cada persona puede encontrar algo que resuene con su corazón y su mente.
                    </p>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-last">
                    <img src="/assents/imag/nosotros/vision.jpg" class="img-fluid rounded mb-4" alt="Our Vision">
                </div>
                <div class="col-lg-6 order-lg-first">
                    <h3 class="text-center">NUESTRA VISIÓN</h3>
                    <p class="text-center">
                    Nuestra visión es trascender los límites de lo ordinario, para convertirnos en un referente 
                    de excelencia en la industria del entretenimiento. Buscamos impactar positivamente en la 
                    vida de las personas, no solo ofreciendo momentos de diversión y emoción, sino también 
                    provocando reflexión y promoviendo valores universales. Queremos ser una fuente de inspiración 
                    y alegría en el día a día de nuestros espectadores, dejando una huella perdurable en sus corazones.
                    </p>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="/assents/imag/nosotros/valores.jpg" class="img-fluid rounded mb-4" alt="Our Values">
                </div>
                <div class="col-lg-6">
                    <h3 class="text-center">NUESTROS VALORES</h3>
                    <p class="text-center"> 
                    En el núcleo de nuestra existencia están nuestros valores, los pilares que guían 
                    cada paso que damos. La excelencia impulsa nuestro compromiso con la calidad, 
                    buscamos superar las expectativas en todo lo que hacemos. La diversidad es nuestra 
                    fortaleza, celebramos las diferencias y buscamos representar la riqueza de la humanidad 
                    en nuestras historias. La accesibilidad es nuestra promesa, queremos que nuestro contenido 
                    sea accesible para todos, sin importar su origen o situación. Y el servicio al cliente es 
                    nuestra prioridad, estamos aquí para satisfacer las necesidades de nuestra 
                    comunidad con amabilidad, eficiencia y empatía.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!--FOOTER-->
    <?php
    include "../includes/footer.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>