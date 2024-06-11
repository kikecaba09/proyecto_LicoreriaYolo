// Obtener el ID del cliente de la URL
var urlParams = new URLSearchParams(window.location.search);
var clientId = urlParams.get('idCliente');

// Obtener la lista de menú
var menuList = document.getElementById('menu-list');

// Función para mostrar el menú en la página HTML
function displayMenu(menu) {
    if (menu) {
        // Crear elementos de lista para cada elemento del menú
        menu.forEach(function(item) {
            var listItem = document.createElement('li');
            var link = document.createElement('a');
            link.textContent = item;
            // Agregar el evento de clic a cada elemento del menú
            link.addEventListener('click', function() {
                // Redirigir a la página de información del cliente con el ID del cliente en la URL
                window.location.href = "../../HTML/cliente/MenuCliente/cuenta.html?idCliente=" + clientId;
            });
            listItem.appendChild(link);
            menuList.appendChild(listItem);
        });
    } else {
        // Si el cliente no tiene elementos de menú asociados, mostrar un mensaje de error
        var errorMessage = document.createElement('li');
        errorMessage.textContent = "Error: Cliente no encontrado o sin menú asociado";
        menuList.appendChild(errorMessage);
    }
}

// Cargar el archivo JSON de clientes
fetch('../../data/clientes.json')
    .then(function(response) {
        return response.json();
    })
    .then(function(data) {
        // Encontrar el cliente actual en el JSON
        var client = data.find(function(cliente) {
            return cliente.id === clientId;
        });
        if (client) {
            // Mostrar el menú del cliente en la página
            displayMenu(client.menu);
        } else {
            // Si el cliente no se encuentra en el JSON, mostrar un mensaje de error
            var errorMessage = document.createElement('li');
            errorMessage.textContent = "Error: Cliente no encontrado en la base de datos";
            menuList.appendChild(errorMessage);
        }
    })
    .catch(function(error) {
        // Manejar errores de carga del JSON
        console.error('Error al cargar el archivo JSON:', error);
    });
