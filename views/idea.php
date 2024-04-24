<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Screen Capture</title>
    <style>
        #videoElement {
            width: 100%;
            max-width: 800px;
            border: 2px solid #ccc;
        }
    </style>
</head>
<body>
    <h1>Screen Capture</h1>
    <video id="videoElement" autoplay playsinline muted></video>

    <script>
        // Obtener el elemento de video
        const videoElement = document.getElementById('videoElement');

        // Obtener la pantalla del usuario utilizando getUserMedia de WebRTC
        navigator.mediaDevices.getDisplayMedia({ video: true })
            .then(stream => {
                // Asignar la transmisión de pantalla al elemento de video
                videoElement.srcObject = stream;
            })
            .catch(error => {
                console.error('Error al obtener la pantalla:', error);
            });
    </script>
</body>
</html>
