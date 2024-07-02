<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
        <label class="btn btn-outline-warning" for="btnradio1">
            Visto
        </label>
        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
        <label class="btn btn-outline-success" for="btnradio2">
            <i class="bi bi-hand-thumbs-up"></i>
        </label>
        <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
        <label class="btn btn-outline-primary" for="btnradio3">
            <i class="bi bi-hand-thumbs-down"></i>
        </label>
    </div>
    <p id="tipo">TIPO: VISTO</p>

    <script>
        const tipoElement = document.getElementById("tipo");
        const vistoButton = document.getElementById("btnradio1");
        const likeButton = document.getElementById("btnradio2");
        const dislikeButton = document.getElementById("btnradio3");
        var numberSQL=3;

        likeButton.addEventListener("click", () => {
            tipoElement.textContent = "TIPO: ME GUSTA";
            numberSQL=1;
        });

        dislikeButton.addEventListener("click", () => {
            tipoElement.textContent = "TIPO: NO ME GUSTA";
            numberSQL=0;
        });

        vistoButton.addEventListener("click", () => {
            tipoElement.textContent = "TIPO: VISTO";
            numberSQL=3;
        });


    </script>
</body>

</html>