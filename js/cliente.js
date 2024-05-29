// script.js
document.addEventListener('DOMContentLoaded', function() {
    const passwordField = document.querySelector('input[name="password"]');
    const passwordRequirements = document.querySelector('.password-requirements');

    // Mostrar los requisitos de la contraseña al seleccionar el campo de contraseña
    passwordField.addEventListener('focus', function() {
        passwordRequirements.style.display = 'block';
    });

    // Ocultar los requisitos de la contraseña al deseleccionar el campo de contraseña
    passwordField.addEventListener('blur', function() {
        passwordRequirements.style.display = 'none';
    });

    const form = document.querySelector('.form-register');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const fullName = form.querySelector('input[name="fullName"]').value;
        const email = form.querySelector('input[name="email"]').value;
        const username = form.querySelector('input[name="username"]').value;
        const password = form.querySelector('input[name="password"]').value;

        const validationMessage = validatePassword(password);

        if (validationMessage === 'valid') {
            const clientData = {
                fullName: fullName,
                email: email,
                username: username,
                password: password
            };

            // Guardar los datos del cliente en localStorage
            saveDataToLocalStorage(clientData);
        } else {
            alert(validationMessage);
        }
    });

    function validatePassword(password) {
        // Verificar si la contraseña cumple con los requisitos mínimos
        if (password.length < 8) {
            return 'La contraseña debe tener al menos 8 caracteres.';
        }
        if (!/[A-Z]/.test(password)) {
            return 'La contraseña debe contener al menos una letra mayúscula.';
        }
        if (!/[!@#$%^&*()_+]/.test(password)) {
            return 'La contraseña debe contener al menos un caracter especial';
        }
        return 'valid';
    }

    function saveDataToLocalStorage(clientData) {
        // Convertir el objeto a cadena JSON y guardarlo en localStorage
        localStorage.setItem('clientData', JSON.stringify(clientData));
        alert('Cliente registrado exitosamente.');
    }
});
