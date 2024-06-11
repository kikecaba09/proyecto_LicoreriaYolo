// Obtener los parámetros de la URL
var urlParams = new URLSearchParams(window.location.search);
var clientId = urlParams.get('idCliente');

// Simulación de datos de clientes
// En una implementación real, estos datos vendrían de una fuente externa como una base de datos o archivo JSON
var clientes = {
    "1": { "nombre": "Juan Pérez", "menu": ["Ver información de la cuenta", "Comprar productos", "Ver pedidos"] },
    "2": { "nombre": "María Gómez", "menu": ["Ver información de la cuenta", "Ver promociones", "Ver pedidos"] },
    // Agregar más clientes y menús según sea necesario
};

// Obtener la referencia de los elementos de la página
var clientNameElement = document.getElementById('client-name');
var menuList = document.getElementById('menu-list');

// Verificar si el cliente existe en los datos simulados
if (clientes.hasOwnProperty(clientId)) {
    // Obtener el nombre del cliente y los elementos del menú
    var cliente = clientes[clientId];
    var clientName = cliente.nombre;
    var menuItems = cliente.menu;

    // Mostrar el nombre del cliente en la página
    clientNameElement.textContent = clientName;

    // Crear elementos de lista para cada elemento del menú
    menuItems.forEach(function(item) {
        var listItem = document.createElement('li');
        var link = document.createElement('a');
        link.textContent = item;
        // Agregar el evento de clic a cada elemento del menú
        link.addEventListener('click', function() {
            // Redirigir a la página correspondiente con el ID del cliente en la URL
            // Puedes ajustar la URL según la estructura de tu aplicación
            var targetUrl;
            switch (item) {
                case "Ver información de la cuenta":
                    targetUrl = "../../HTML/cliente/MenuCliente/cuenta.html?idCliente=" + clientId;
                    break;
                case "Comprar productos":
                    targetUrl = "../../HTML/cliente/MenuCliente/comprar.html?idCliente=" + clientId;
                    break;
                case "Ver pedidos":
                    targetUrl = "../../HTML/cliente/MenuCliente/pedidos.html?idCliente=" + clientId;
                    break;
                case "Ver promociones":
                    targetUrl = "../../HTML/cliente/MenuCliente/promociones.html?idCliente=" + clientId;
                    break;
                default:
                    targetUrl = "#";
                    break;
            }
            window.location.href = targetUrl;
        });
        listItem.appendChild(link);
        menuList.appendChild(listItem);
    });
} else {
    // Si el cliente no se encuentra o no tiene un menú asociado, mostrar un mensaje de error
    var errorMessage = document.createElement('li');
    errorMessage.textContent = "Error: Cliente no encontrado o sin menú asociado";
    menuList.appendChild(errorMessage);
}
