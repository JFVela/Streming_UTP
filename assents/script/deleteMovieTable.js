$(document).ready(function() {
    $('.deleteBtn').click(function() {
        var id = $(this).data('id');
        Swal.fire({
            title: "¿Estás seguro?",
            text: "No podrás revertir esto",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminarlo",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../controllers/admin/deleteMovie.php',
                    method: 'GET',
                    data: {
                        idPeli: id
                    },
                    success: function(response) {
                        if (response == 'success') {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Registro Eliminado Exitosamente',
                                showConfirmButton: false,
                                timer: 2000,
                            });
                            setTimeout(() => {
                                window.history.replaceState(null, null, window.location.pathname);
                            }, 0);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Hubo un error al intentar eliminar el registro',
                                imageUrl: '../../assents/imag/error.gif',
                                imageWidth: 400,
                                imageHeight: 200
                            });
                        }
                    }
                });
            }
        });
    });
});
