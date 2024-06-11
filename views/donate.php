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
    <!--JS AJAX-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <!--HEADER-->
    <?php
    include "../includes/header.php";
    ?>
    <!--FIN HEADER-->

    <!--Carrusel usado por boostrap y css-->
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
                    <h2>Ayudamemos a los mas necesitados</h2>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/assents/imag/donaciones/Imagen2.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Aprendamos a ayudar</h2>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/assents/imag/donaciones/Imagen3.jpeg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Envio Inmediato</h2>
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

    <!--Información de las donaciones-->
    <div class="contenidoDonante">
        <div class="stats-container">
            <div class="stat-item">
                <div class="stat-value" id="liquidez_total">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="stat-label">LIQUIDEZ TOTAL OBTENIDA </div>
            </div>
            <div class="stat-item">
                <div class="stat-value" id="total_participantes">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="stat-label">TOTAL DE PARTICIPANTES</div>
            </div>
            <div class="stat-item">
                <div class="stat-value" id="total_donaciones">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="stat-label">TOTAL DE DONACIONES</div>
            </div>
            <div class="stat-item">
                <div class="stat-value" id="promedioDonaciones">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="stat-label">PROMEDIO POR DONACIÓN</div>
            </div>
        </div>
    </div>

    <!--CUENTAS FALSAS:-->
    <!--CUENTA DOLARES: sb-wfsrp31077559@personal.example.com 4+ysTO2g -->
    <!--CUENTA SOLES: sb-l430jk31074533@personal.example.com 3oz<zUgM -->

    <!--Verifica que exista usuario para hacer donaciones-->
    <div class="d-grid donacionDeslizar">
        <button class="btn btn-warning" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Dona Aquí </button>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <?php
                if (isset($_SESSION['idUsuario']) && $_SESSION['idUsuario'] > 0) { ?>
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
                                <option value="Educación">Educación</option>
                                <option value="Salud">Salud</option>
                                <option value="Alimentación">Alimentación</option>
                                <option value="Vivienda">Vivienda</option>
                            </select>
                        </div>
                        <br><br>
                        <div class="botonDonacion" id="paypal-donate-button-container"></div>
                    </form>
                    <h5>¡Muchas gracias por tu apoyo! Juntos, podemos hacer una diferencia.</h5>
                <?php
                } else {
                ?>
                    <h1>Inicia seccion para Donar</h1>
                    <p>De acuerdo con nuestras políticas de seguridad y
                        los estándares de la empresa, requerimos que todas
                        las personas que deseen hacer una donación voluntaria
                        tengan una cuenta en nuestra página. Esto nos permite
                        realizar un seguimiento adecuado de todas las
                        transacciones realizadas. Si tienes alguna pregunta
                        sobre este proceso, no dudes en consultar nuestras
                        <a href="#">Preguntas frecuentes</a>
                    </p>
                    <h3>¿Cómo puedo Registrarme?</h3>
                    <p>1. Si no tines alguna cuenta haz clic en <b>Regístrate Aquí</b></p>
                    <p>2. En caso ya cuentes con una cuenta da clic en <b>Login</b>.</p>

                    <div class="btn-group d-flex justify-content-center" role="group" aria-label="Basic example">
                        <a href="/views/createLogin.php" type="button" class="btn btn-warning"><b>Regístrate Aquí</b></a>
                        <a href="/views/login.php" type="button" class="btn btn-info"><b>Login</b></a>
                    </div>

                    <h5>¡Muchas gracias por su comprensión!</h5>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <!--Cartas con información de las 4 campañas-->
    <div class="cartasInformación">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
            <div class="col">
                <div class="cartitas card h-100">
                    <img src="/assents/imag/donaciones/EDUCACION.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Apoyo a la Educación</h5>
                        <p class="card-text">Las donaciones se utilizan para proporcionar material educativo, financiar
                            becas, y mejorar infraestructuras escolares en comunidades necesitadas.</p>
                    </div>
                    <div class="card-footer">
                        <small id="idEdu" class="text-body-secondary">
                            <h6 class="placeholder-glow">
                                <span class="placeholder col-7"></span>
                            </h6>
                        </small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="cartitas card h-100">
                    <img src="/assents/imag/donaciones/SALUD.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Salud</h5>
                        <p class="card-text">Se destinan los fondos para comprar medicamentos, equipos médicos, y apoyar
                            programas de salud pública para mejorar el bienestar de las personas.</p>
                    </div>
                    <div class="card-footer">
                        <small id="idSal" class="text-body-secondary">
                            <h6 class="placeholder-glow">
                                <span class="placeholder col-7"></span>
                            </h6>
                        </small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="cartitas card h-100">
                    <img src="/assents/imag/donaciones/ALIMENTOS.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Alimentación</h5>
                        <p class="card-text">Los programas de distribución de alimentos, comedores comunitarios, y otras
                            iniciativas que aseguran que las personas tengan acceso a comidas nutritivas.</p>
                    </div>
                    <div class="card-footer">
                        <small id="idAli" class="text-body-secondary">
                            <h6 class="placeholder-glow">
                                <span class="placeholder col-7"></span>
                            </h6>
                        </small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="cartitas card h-100">
                    <img src="/assents/imag/donaciones/VIVIENDAS.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Vivienda</h5>
                        <p class="card-text">Las donaciones se utilizan para construir y rehabilitar viviendas para
                            familias que viven en condiciones precarias, mejorando su calidad de vida.</p>
                    </div>
                    <div class="card-footer">
                        <small id="idViv" class="text-body-secondary">
                            <h6 class="placeholder-glow">
                                <span class="placeholder col-7"></span>
                            </h6>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--JS PayPal personalizado-->
    <script>
        var id_usuario_scrip = <?php echo $_SESSION['idUsuario'] ?? 0; ?>;
        document.addEventListener("DOMContentLoaded", function(event) {
            var buttonContainer = document.getElementById('paypal-donate-button-container');

            if (id_usuario_scrip > 0) {
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

                        console.log(`ID de Usuario: ${id_usuario_scrip}`);
                        console.log(`ID de Transacción: ${transactionId}`);
                        console.log(`Estado: ${status}`);
                        console.log(`Monto: ${amount} ${currency}`);
                        console.log(`Campaña: ${campaign}`);
                        console.log(`Fecha de donación: ${donationDate}`);

                        // Enviar los datos al servidor usando AJAX
                        const xhr = new XMLHttpRequest();
                        xhr.open("POST", "../controllers/insert_donation.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                // Donación registrada con éxito en la base de datos
                                console.log(xhr.responseText);
                            }
                        };
                        xhr.send("idTransaccion=" + encodeURIComponent(transactionId) +
                            "&amount=" + encodeURIComponent(amount) +
                            "&campaign=" + encodeURIComponent(campaign) +
                            "&user_id=" + encodeURIComponent(id_usuario_scrip) +
                            "&estado=" + encodeURIComponent(status) +
                            "&fecha=" + encodeURIComponent(donationDate));
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
            }
        });
    </script>

    <!--JS para hacer JSON-->
    <script>
        setInterval(function() {
            $.ajax({
                url: '/controllers/get_donation_data.php',
                type: 'GET',
                dataType: 'json', // Agregado para asegurar que la respuesta se interprete como JSON
                success: function(data) {
                    console.log(data); // Para verificar la respuesta en la consola
                    $('#liquidez_total').text('$' + data.liquidez_total);
                    $('#total_participantes').text(data.total_participantes);
                    $('#total_donaciones').text(data.total_donaciones);
                    $('#promedioDonaciones').text('$' + data.promedioDonaciones);
                    $('#idEdu').text('Monto recaudado: $' + data.jsonEdu);
                    $('#idSal').text('Monto recaudado: $' + data.jsonSal);
                    $('#idAli').text('Monto recaudado: $' + data.jsonAli);
                    $('#idViv').text('Monto recaudado: $' + data.jsonViv);
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + error);
                    console.error('Status: ' + status);
                    console.dir(xhr);
                }
            });
        }, 5000);
    </script>

    <!--FOOTER-->
    <?php
    include "../includes/footer.php";
    ?>
    <!--FIN FOOTER-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>