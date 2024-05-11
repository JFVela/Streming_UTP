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
            $('#editIdMovie').val(response.idMovie);
            $('#editTitulo').val(response.titulo);
            $('#editAño').val(response.año);
            $('#editDuracion').val(response.duracion);
            $('#editDirector').val(response.director);
            
            // Set the ID value to a hidden input
            $('#idPeliculaHidden').val(response.idMovie);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});

// Handle form submission
$('#editForm').submit(function(event) {
    event.preventDefault();
    
    var idPelicula = $('#idPeliculaHidden').val();
    // Do whatever you need with the movie ID
});
