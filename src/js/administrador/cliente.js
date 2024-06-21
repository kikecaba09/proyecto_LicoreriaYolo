function eliminarCliente(idCliente) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar cliente'
    }).then((result) => {
        if (result.isConfirmed) {
            // Petición AJAX para eliminar el cliente
            $.ajax({
                url: '../../php/administrador/eliminarCliente.php',
                type: 'POST',
                dataType: 'json',
                data: { idCliente: idCliente },
                success: function (response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            title: 'Cliente eliminado',
                            text: response.message,
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(function () {
                            // Recargar la página después de eliminar el cliente
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        title: 'Error',
                        text: 'Se produjo un error al eliminar el cliente.',
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }
    });
}
