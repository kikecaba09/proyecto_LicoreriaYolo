$(document).ready(function() {
    // Abrir el modal
    $('#editBtn').click(function() {
        $('#myModal').css('display', 'block');
    });

    // Cerrar el modal cuando se hace clic en la X
    $('.close').click(function() {
        $('#myModal').css('display', 'none');
    });

    // Cerrar el modal si se hace clic fuera de él
    $(window).click(function(event) {
        if ($(event.target).is('#myModal')) {
            $('#myModal').css('display', 'none');
        }
    });
});
