// Captura del evento clic en el botón de edición
$(document).on("click", ".editBtn", function() {
    var idPelicula = $(this).data('id');
    $.ajax({
        url: '../../controllers/admin/GetMovie.php',
        method: 'POST',
        data: {
            id: idPelicula
        },
        dataType: 'json',
        success: function(response) {
            $('#cuerpo').empty();
            $.each(response, function(index, pelicula) {
                $('#cuerpo').append(`
                    <tr>
                        <td>${pelicula.idMovie}</td>
                        <td>${pelicula.titulo}</td>
                        <td>${pelicula.descripcion}</td>
                        <td>${pelicula.año}</td>
                        <td>${pelicula.duracion}</td>
                        <td>${pelicula.url}</td>
                        <td>${pelicula.director}</td>
                    </tr>
                `);
                $('#editForm #idPelicula').val(pelicula.idMovie);
                $('#editForm #titulo1').val(pelicula.titulo);
                $('#editForm #descripcion1').val(pelicula.descripcion);
                $('#editForm #anio1').val(pelicula.año);
                $('#editForm #duracion1').val(pelicula.duracion);
                $('#editForm #url1').val(pelicula.url);
                $('#editForm #director1').val(pelicula.director);
            });
            $('#editModal').modal('show');
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});
