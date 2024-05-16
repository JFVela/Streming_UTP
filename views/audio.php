<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Transcribir habla a texto con Google Cloud Speech-to-Text</title>
</head>
<body>

<h1>Habla y se transcribirá:</h1>
<button id="startButton">Iniciar Grabación</button>
<button id="stopButton" disabled>Detener Grabación</button>
<p id="output"></p>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://apis.google.com/js/api.js"></script>
<script>
var recognition;
var audioChunks = [];

// Inicializar la API de Google Cloud
function init() {
  gapi.client.init({
    'apiKey': 'TU_API_KEY',
    'discoveryDocs': ['https://speech.googleapis.com/$discovery/rest?version=v1']
  }).then(function() {
    console.log('API loaded');
  });
}

// Función para transcribir audio a texto usando la API de Google Cloud Speech-to-Text
function transcribeAudio() {
  var audioContent = btoa(audioChunks.reduce((acc, chunk) => acc.concat(Array.from(new Uint8Array(chunk)))), '');
  
  gapi.client.speech.speech.recognize({
    'config': {
      'encoding': 'LINEAR16',
      'sampleRateHertz': 16000,
      'languageCode': 'es-ES'
    },
    'audio': {
      'content': audioContent
    }
  }).then(function(response) {
    console.log(response);
    var transcript = response.result.results[0].alternatives[0].transcript;
    document.getElementById('output').innerText = transcript;
  }, function(err) {
    console.error('ERROR:', err);
  });
}

// Botón para iniciar la grabación
document.getElementById('startButton').addEventListener('click', function() {
  navigator.mediaDevices.getUserMedia({ audio: true })
    .then(stream => {
      recognition = new window.webkitSpeechRecognition();
      recognition.continuous = true;
      recognition.interimResults = false;
      recognition.lang = 'es-ES';
      recognition.onresult = function(event) {
        var transcript = event.results[event.results.length - 1][0].transcript;
        document.getElementById('output').innerText = transcript;
      };
      recognition.onend = function() {
        transcribeAudio();
      };
      recognition.start();
      document.getElementById('startButton').disabled = true;
      document.getElementById('stopButton').disabled = false;
    })
    .catch(err => {
      console.error('Error accessing microphone:', err);
    });
});

// Botón para detener la grabación
document.getElementById('stopButton').addEventListener('click', function() {
  recognition.stop();
  document.getElementById('startButton').disabled = false;
  document.getElementById('stopButton').disabled = true;
});

// Cargar la API de Google Cloud y luego inicializarla
gapi.load('client', init);
</script>

</body>
</html>
