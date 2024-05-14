<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot HTML</title>
    <style>
        /* Estilos CSS para el chatbot */
        #chatbox {
            width: 300px;
            height: 400px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div id="chatbox">
        <p>Bienvenido al Chatbot. ¿En qué puedo ayudarte?</p>
    </div>
    <input type="text" id="userInput" placeholder="Escribe tu mensaje...">
    <button onclick="send()">Enviar</button>

    <script>
        function send() {
            var userInput = document.getElementById("userInput").value;
            var chatbox = document.getElementById("chatbox");

            // Agregar mensaje del usuario al chatbox
            chatbox.innerHTML += "<p><strong>Tú:</strong> " + userInput + "</p>";

            // Responder al usuario
            var response = getResponse(userInput);
            chatbox.innerHTML += "<p><strong>Chatbot:</strong> " + response + "</p>";

            // Limpiar el campo de entrada
            document.getElementById("userInput").value = "";

            // Desplazar al fondo del chatbox
            chatbox.scrollTop = chatbox.scrollHeight;
        }
jjjjjj
        function getResponse(input) {
            // Aquí puedes definir tus preguntas y respuestas
            // Por ejemplo:
            if (input.toLowerCase().includes("clima")) {
                return "El clima hoy es soleado.";
            } else if (input.toLowerCase().includes("capital de francia")) {
                return "La capital de Francia es París.";
            } else {
                return "Lo siento, no entiendo tu pregunta.";
            }
        }
    </script>
</body>
</html>
