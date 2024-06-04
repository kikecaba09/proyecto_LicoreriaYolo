function login() {
    var userName = document.getElementById('userName').value;
    var userPassword = document.getElementById('userPassword').value;

    // Hacer la solicitud AJAX para cargar los datos de los clientes desde el archivo JSON
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../data/clientes.json', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Parsear los datos JSON
            var clientes = JSON.parse(xhr.responseText);

            // Verificar las credenciales
            var authenticated = false;
            var clientId = null;
            for (var i = 0; i < clientes.length; i++) {
                if (clientes[i].usuario === userName && clientes[i].contraseña === userPassword) {
                    authenticated = true;
                    clientId = clientes[i].id;
                    break;
                }
            }

            // Mostrar mensaje de éxito o error
            var loginMessage = document.getElementById('loginMessage');
            if (authenticated) {
                loginMessage.textContent = 'Inicio de sesión exitoso';
                // Redirigir al menú con el ID del cliente
                window.location.href = "/HTML/cliente/MenuCliente/menu.html?idCliente=" + clientId;
            } else {
                loginMessage.textContent = 'Nombre de usuario o contraseña incorrectos';
            }
        } else {
            console.error('Error al cargar los datos de cliente:', xhr.statusText);
        }
    };
    xhr.send();

    // Evitar que se envíe el formulario
    return false;
}
