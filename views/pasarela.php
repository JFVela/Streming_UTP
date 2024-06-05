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
</head>

<body>
    <h1>Apoya nuestro proyecto</h1>
    <p>Ayuda a mantener las películas gratuitas para todos. Tu donación proporciona alimentos y educación en comunidades necesitadas.</p>

    <div id="paypal-donate-button-container"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            PayPal.Donation.Button({
                env: 'sandbox',
                business: 'sb-j69ex30579072@business.example.com',
                image: {
                    src: 'https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif',
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
                    console.log(`ID de Transacción: ${transactionId}`);
                    console.log(`Estado: ${status}`);
                    console.log(`Monto: ${amount} ${currency}`);
                    console.log(`Fecha de donación: ${donationDate}`);
                },
                onCancel: function(data) {
                    alert("Donación cancelada");
                    console.log(data);
                },
                onError: function(err) {
                    console.error(err);
                    alert('Ocurrió un error durante la donación');
                }
            }).render('#paypal-donate-button-container');
        });
    </script>

</body>

</html>