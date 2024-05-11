// Captura del evento clic en el botón de edición
$(document).on("click", ".editBtn", function() {
    // Obtener el ID de la película desde el atributo data
    var idPelicula = $(this).data('id');

    // Hacer una solicitud al script PHP que obtiene los detalles de la película
    $.ajax({
        url: '../../controllers/admin/GetMovie.php',
        method: 'POST',
        data: {
            id: idPelicula
        },
        dataType: 'json',
        success: function(response) {
            // Limpiar el cuerpo de la tabla en el modal
            $('#cuerpo').empty();
            // Agregar los detalles de la película al cuerpo de la tabla en el modal
            $.each(response, function(index, pelicula) {
                // Agregar cada detalle a la tabla
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

                // Agregar los detalles de la película al formulario
                $('#editForm #titulo').val(pelicula.titulo);
                $('#editForm #descripcion').val(pelicula.descripcion);
                $('#editForm #anio').val(pelicula.año);
                $('#editForm #duracion').val(pelicula.duracion);
                $('#editForm #url').val(pelicula.url);
                $('#editForm #director').val(pelicula.director);
            });
            // Mostrar el modal después de cargar los detalles de la película
            $('#editModal').modal('show');
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});
