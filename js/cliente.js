document.addEventListener('DOMContentLoaded', function() {
    const passwordField = document.querySelector('input[name="password"]');
    const passwordRequirements = document.querySelector('.password-requirements');
    const passwordRequirementItems = passwordRequirements.querySelectorAll('li');

    // Objeto para almacenar el estado de los requisitos cumplidos
    const requirementsMet = {
        length: false,
        uppercase: false,
        specialChar: false
    };

    // Función para mostrar los requisitos de la contraseña
    function showPasswordRequirements() {
        passwordRequirements.style.display = 'block';
    }

    // Función para ocultar los requisitos de la contraseña
    function hidePasswordRequirements() {
        passwordRequirements.style.display = 'none';
    }

    // Función para marcar un requisito de contraseña como cumplido
    function markRequirementAsMet(requirementItem) {
        requirementItem.style.color = 'green'; // Cambiar color a verde
        if (requirementItem.querySelector('.check') === null) {
            const check = document.createElement('span');
            check.className = 'check';
            check.innerHTML = '&#10004;';
            requirementItem.appendChild(check);
        }
    }

    // Función para restablecer un requisito de contraseña a su estado normal
    function resetRequirement(requirementItem) {
        requirementItem.style.color = ''; // Restablecer color
        const check = requirementItem.querySelector('.check');
        if (check !== null) {
            check.remove();
        }
    }

    // Validar la contraseña y actualizar los requisitos
    function validateAndUpdatePassword(password) {
        // Reiniciar los requisitos cumplidos
        for (let requirement in requirementsMet) {
            requirementsMet[requirement] = false;
        }

        if (password.length >= 8) {
            markRequirementAsMet(passwordRequirementItems[0]);
            requirementsMet.length = true;
        } else {
            resetRequirement(passwordRequirementItems[0]);
        }

        if (/[A-Z]/.test(password)) {
            markRequirementAsMet(passwordRequirementItems[1]);
            requirementsMet.uppercase = true;
        } else {
            resetRequirement(passwordRequirementItems[1]);
        }

        if (/[!@#$%^&*()_+]/.test(password)) {
            markRequirementAsMet(passwordRequirementItems[2]);
            requirementsMet.specialChar = true;
        } else {
            resetRequirement(passwordRequirementItems[2]);
        }
    }

    // Mostrar u ocultar los requisitos de la contraseña según el foco del campo de contraseña
    passwordField.addEventListener('focus', showPasswordRequirements);
    passwordField.addEventListener('blur', hidePasswordRequirements);

    // Ocultar los requisitos de la contraseña al cargar la página
    hidePasswordRequirements();

    // Validar la contraseña al escribir en el campo de contraseña
    passwordField.addEventListener('input', function() {
        const password = passwordField.value;
        if (password === '') {
            for (let requirement in requirementsMet) {
                requirementsMet[requirement] = false;
            }
            for (let i = 0; i < passwordRequirementItems.length; i++) {
                resetRequirement(passwordRequirementItems[i]);
            }
        } else {
            validateAndUpdatePassword(password);
        }
    });

    // Restablecer los requisitos si se modifica la contraseña
    passwordField.addEventListener('change', function() {
        const password = passwordField.value;
        if (password === '') {
            for (let requirement in requirementsMet) {
                requirementsMet[requirement] = false;
            }
            for (let i = 0; i < passwordRequirementItems.length; i++) {
                resetRequirement(passwordRequirementItems[i]);
            }
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const ageField = document.getElementById('age');
    const ageError = document.getElementById('ageError');

    ageField.addEventListener('input', function() {
        const age = ageField.value;
        if (parseInt(age) < 18) {
            ageError.style.display = 'block';
        } else {
            ageError.style.display = 'none';
        }
    });
});
