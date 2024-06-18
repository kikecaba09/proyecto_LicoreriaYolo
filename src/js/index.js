// Función para añadir los botones de inicio de sesión dinámicamente
function addLoginButtons() {
    const loginButtonsContainer = document.getElementById('loginButtonsContainer');

    // Limpiar el contenedor antes de añadir los botones
    loginButtonsContainer.innerHTML = '';

    // Crear botón para Cliente
    const clientButton = document.createElement('button');
    clientButton.textContent = 'Cliente';
    clientButton.classList.add('login-button', 'client-button');
    clientButton.addEventListener('click', () => {
        // Redireccionar a la página de inicio de sesión del cliente
        window.location.href = 'login-cliente.html';
    });

    // Crear botón para Administrador
    const adminButton = document.createElement('button');
    adminButton.textContent = 'Administrador';
    adminButton.classList.add('login-button', 'admin-button');
    adminButton.addEventListener('click', () => {
        // Redireccionar a la página de inicio de sesión del administrador
        window.location.href = 'login-administrador.html';
    });

    // Añadir los botones al contenedor
    loginButtonsContainer.appendChild(clientButton);
    loginButtonsContainer.appendChild(adminButton);
}

// Evento clic para el botón de "Iniciar sesión"
document.getElementById('loginBtn').addEventListener('click', addLoginButtons);
