$(document).ready(function() {
    // Mostrar/Ocultar contraseña
    $('#toggle-password').on('click', function() {
        const passwordField = $('#admin-password');
        const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
        passwordField.attr('type', type);
        $(this).find('i').toggleClass('fa-eye fa-eye-slash');
    });

    // Validación del formulario
    $('#login-form').on('submit', function(event) {
        let valid = true;
        $('.error-message').hide();

        if ($('#admin-username').val().trim() === '') {
            valid = false;
            $('#username-error').text('Por favor, ingrese su usuario.').show();
        }

        if ($('#admin-password').val().trim() === '') {
            valid = false;
            $('#password-error').text('Por favor, ingrese su contraseña.').show();
        }

        if (!valid) {
            event.preventDefault();
        }
    });
});
