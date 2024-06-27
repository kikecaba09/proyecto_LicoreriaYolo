// infoAdministrador.js

$(document).ready(function() {
    // Abrir el modal
    $('#editBtn').on('click', function() {
        $('#myModal').css('display', 'block');
    });

    // Cerrar el modal cuando se hace clic en la X
    $('.close').on('click', function() {
        $('#myModal').css('display', 'none');
    });

    // Cerrar el modal si se hace clic fuera de él
    $(window).on('click', function(event) {
        if ($(event.target).is('#myModal')) {
            $('#myModal').css('display', 'none');
        }
    });
});
