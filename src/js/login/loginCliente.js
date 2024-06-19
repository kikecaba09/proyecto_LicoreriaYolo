$(document).ready(function() {
    $('.titulo-principal').addClass('animate__fadeInDown');
    $('.cliente-login-container').addClass('animate__bounceInUp');
    $('form').on('submit', function(event) {
        // Añade una animación de salida al enviar el formulario
        $('.cliente-login-container').addClass('animate__fadeOut');
    });
});
