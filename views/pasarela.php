<!--CUENTA DOLARES: sb-wfsrp31077559@personal.example.com 4+ysTO2g -->
<!--CUENTA SOLES: sb-l430jk31074533@personal.example.com 3oz<zUgM -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donaciones</title>
    <script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js" charset="UTF-8"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        h1 {
            text-align: center;
        }

        .donacionDeslizar {
            max-width: 800px;
            margin: 0 auto;
            margin-top: 50px;
        }

        .btn-warning {
            color: #fff;
            background-color: #ff9800;
            border-color: #ff9800;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .donation-form {
            padding: 20px;
        }

        .botonDonacion {
            width: 180px;
            margin: 0 auto;
            display: block;
        }

        #paypal-donate-button-container img {
            width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="d-grid donacionDeslizar" style="padding: 2%">
        <button class="btn btn-warning" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Dona Aquí </button>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <h1>¡Bienvenido!</h1>
                <p>Gracias por considerar apoyar a los más necesitados. En CineAndes, creemos en el poder de la comunidad. Todas las donaciones se dirigen a quienes más lo necesitan, siguiendo las políticas de seguridad y privacidad de nuestra empresa. Si tienes dudas, puedes consultar nuestras <a href="#">Preguntas frecuentes</a>.</p>
                <h3>¿Cómo puedes donar?</h3>
                <p>1. Elige una campaña específica a la que te gustaría contribuir.</p>
                <p>2. Una vez elegida, haz clic en el botón de *PayPal*.</p>
                <p>3. Sigue los pasos indicados por PayPal para completar tu donación.</p>
                <form id="donation-form" class="donation-form">
                    <label for="campaign">Elige la campaña para tu donación:</label>
                    <select id="campaign" name="campaign">
                        <option value="Educacion">Educación</option>
                        <option value="Salud">Salud</option>
                        <option value="Alimentacion">Alimentación</option>
                        <option value="Vivienda">Vivienda</option>
                    </select>
                    <br><br>
                    <div class="botonDonacion" id="paypal-donate-button-container"></div>
                </form>
                <h5>¡Muchas gracias por tu apoyo! Juntos, podemos hacer una diferencia.</h5>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>