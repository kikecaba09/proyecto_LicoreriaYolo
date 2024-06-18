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

            // Verificar las credenciales de los clientes
            var authenticated = false;
            var clientId = null;
            for (var i = 0; i < clientes.length; i++) {
                if (clientes[i].usuario === userName && clientes[i].contraseña === userPassword) {
                    authenticated = true;
                    clientId = clientes[i].id;
                    break;
                }
            }

            // Si las credenciales de cliente son válidas, redirigir al menú de cliente
            if (authenticated) {
                window.location.href = "/HTML/cliente/MenuCliente/menu.html?idCliente=" + clientId;
                return;
            }

            // Si las credenciales de cliente no son válidas, verificar las credenciales del administrador
            var xhrAdmin = new XMLHttpRequest();
            xhrAdmin.open('GET', '../data/administrador.json', true);
            xhrAdmin.onload = function () {
                if (xhrAdmin.status === 200) {
                    // Parsear los datos JSON del administrador
                    var administrador = JSON.parse(xhrAdmin.responseText)[0];

                    // Verificar las credenciales del administrador
                    if (administrador.usuario === userName && administrador.contraseña === userPassword) {
                        // Credenciales de administrador válidas, redirigir al menú de administrador
                        window.location.href = "../HTML/administrador/administrador.html";
                    } else {
                        // Credenciales de administrador inválidas, mostrar mensaje de error
                        var loginMessage = document.getElementById('loginMessage');
                        loginMessage.textContent = 'Nombre de usuario o contraseña incorrectos';
                    }
                } else {
                    console.error('Error al cargar los datos del administrador:', xhrAdmin.statusText);
                }
            };
            xhrAdmin.send();
        } else {
            console.error('Error al cargar los datos de cliente:', xhr.statusText);
        }
    };
    xhr.send();

    // Evitar que se envíe el formulario
    return false;
}
