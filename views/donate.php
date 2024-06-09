<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Boostrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--Iconos Boostrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--INCLUDES-->
    <link rel="stylesheet" href="/assents/css/includes.css">
    <!--Titulo-->
    <title>Donación</title>
    <!--ESTILOS-->
    <link rel="stylesheet" href="../assents/css/donaciones.css">
    <!--JS PayPal-->
    <script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js" charset="UTF-8"></script>
</head>

<body>
    <!--HEADER-->
    <?php
    include "../includes/header.php";
    ?>
    <!--FIN HEADER-->
    <div id="carouselExampleCaptions" class="donacionCarrusel carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/assents/imag/donaciones/Imagen1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/assents/imag/donaciones/Imagen2.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/assents/imag/donaciones/Imagen3.jpeg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="contenidoDonante">
        <div class="stats-container">
            <div class="stat-item">
                <div class="stat-value">$260.1M</div>
                <div class="stat-label">TOTAL LIQUIDITY RAISED</div>
            </div>
            <div class="stat-item">
                <div class="stat-value">5004</div>
                <div class="stat-label">TOTAL PROJECTS</div>
            </div>
            <div class="stat-item">
                <div class="stat-value">573,421</div>
                <div class="stat-label">TOTAL PARTICIPANTS</div>
            </div>
            <div class="stat-item">
                <div class="stat-value">$290.5M</div>
                <div class="stat-label">TOTAL VALUES LOCKED</div>
            </div>
        </div>
    </div>

    <!--CUENTAS FALSAS:-->
    <!--CUENTA DOLARES: sb-wfsrp31077559@personal.example.com 4+ysTO2g -->
    <!--CUENTA SOLES: sb-l430jk31074533@personal.example.com 3oz<zUgM -->
    <div class="d-grid donacionDeslizar">
        <button class="btn btn-warning" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Dona Aquí </button>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <h1>¡Bienvenido!</h1>
                <p>Gracias por considerar apoyar a los más necesitados. En CineAndes, creemos en el poder de la
                    comunidad. Todas las donaciones se dirigen a quienes más lo necesitan, siguiendo las políticas de
                    seguridad y privacidad de nuestra empresa. Si tienes dudas, puedes consultar nuestras <a href="#">Preguntas frecuentes</a>.</p>
                <h3>¿Cómo puedes donar?</h3>
                <p>1. Elige una campaña específica a la que te gustaría contribuir.</p>
                <p>2. Una vez elegida, haz clic en el botón de *PayPal*.</p>
                <p>3. Sigue los pasos indicados por PayPal para completar tu donación.</p>
                <form id="donation-form" class="donation-form row">
                    <label for="campaign" class="col-sm-6 col-form-label">Elige la campaña para tu donación:</label>
                    <div class="col-sm-6">
                        <select id="campaign" name="campaign" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <option value="Educacion">Educación</option>
                            <option value="Salud">Salud</option>
                            <option value="Alimentacion">Alimentación</option>
                            <option value="Vivienda">Vivienda</option>
                        </select>
                    </div>
                    <br><br>
                    <div class="botonDonacion" id="paypal-donate-button-container"></div>
                </form>
                <h5>¡Muchas gracias por tu apoyo! Juntos, podemos hacer una diferencia.</h5>
            </div>
        </div>
    </div>

    <div class="cartasInformación">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
            <div class="col">
                <div class="card h-100">
                    <img src="/assents/imag/donaciones/EDUCACION.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Apoyo a la Educación</h5>
                        <p class="card-text">Las donaciones se utilizan para proporcionar material educativo, financiar
                            becas, y mejorar infraestructuras escolares en comunidades necesitadas.</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-body-secondary">Obtenido: 500$</small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="/assents/imag/donaciones/SALUD.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Salud</h5>
                        <p class="card-text">Se destinan los fondos para comprar medicamentos, equipos médicos, y apoyar
                            programas de salud pública para mejorar el bienestar de las personas.</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-body-secondary">Obtenido: 500$</small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="/assents/imag/donaciones/ALIMENTOS.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Alimentación</h5>
                        <p class="card-text">Los programas de distribución de alimentos, comedores comunitarios, y otras
                            iniciativas que aseguran que las personas tengan acceso a comidas nutritivas.</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-body-secondary">Obtenido: 500$</small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="/assents/imag/donaciones/VIVIENDAS.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Vivienda</h5>
                        <p class="card-text">Las donaciones se utilizan para construir y rehabilitar viviendas para
                            familias que viven en condiciones precarias, mejorando su calidad de vida.</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-body-secondary">Obtenido: 500$</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            PayPal.Donation.Button({
                env: 'sandbox',
                business: 'sb-j69ex30579072@business.example.com',
                image: {
                    src: '/assents/imag/donaciones/donate-pp.png',
                    title: 'PayPal - The safer, easier way to pay online!',
                    alt: 'Donate with PayPal button'
                },
                onComplete: function(params) {
                    alert('Donación completada. ¡Gracias por tu apoyo!');
                    const transactionId = params.tx;
                    const status = params.st;
                    const amount = params.amt;
                    const currency = params.cc;
                    const payerName = params.name;
                    const donationDate = new Date().toLocaleString();
                    const campaign = document.getElementById('campaign').value;
                    console.log(`ID de Transacción: ${transactionId}`);
                    console.log(`Estado: ${status}`);
                    console.log(`Monto: ${amount} ${currency}`);
                    console.log(`Campaña: ${campaign}`);
                    console.log(`Fecha de donación: ${donationDate}`);
                },
                onCancel: function(data) {
                    alert("Donación cancelada");
                    console.log(data);
                },
                onError: function(err) {
                    console.error(err);
                    alert('Ocurrió un error durante la donación');
                },
                prefill: {
                    custom1: function() {
                        return document.getElementById('campaign').value;
                    }
                }
            }).render('#paypal-donate-button-container');
        });
    </script>

    <!--FOOTER-->
    <?php
    include "../includes/footer.php";
    ?>
    <!--FIN FOOTER-->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>