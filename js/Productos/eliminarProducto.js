function eliminarProducto(idProducto) {
    console.log('Intentando eliminar producto con ID:', idProducto);
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../../php/administrador/eliminarProducto.php',
                type: 'POST',
                dataType: 'json',
                data: { idProducto: idProducto },
                success: function (response) {
                    console.log(response); // Verificar la respuesta del servidor
                    if (response.status === 'success') {
                        Swal.fire({
                            title: 'Producto eliminado',
                            text: response.message,
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(function () {
                            location.reload(); // Recargar la página después de eliminar
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
                error: function (xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error); // Verificar errores en la solicitud AJAX
                    Swal.fire({
                        title: 'Error',
                        text: 'Se produjo un error al eliminar el producto.',
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }
    });
}
