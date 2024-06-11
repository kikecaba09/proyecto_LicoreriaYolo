// Obtener el ID del cliente de la URL
var urlParams = new URLSearchParams(window.location.search);
var clientId = urlParams.get('idCliente');

// Definir los elementos del menú y nombres para cada cliente
var menuItems = {
    "1": { 
        "name": "Carlos", 
        "items": ["Ver información de la cuenta", "Comprar productos", "Ver pedidos"] 
    },
    "2": { 
        "name": "María", 
        "items": ["Ver información de la cuenta", "Comprar productos", "Ver pedidos"] 
    },
    "2": { 
        "name": "María", 
        "items": ["Ver información de la cuenta", "Comprar productos", "Ver pedidos"] 
    },
    "2": { 
        "name": "María", 
        "items": ["Ver información de la cuenta", "Comprar productos", "Ver pedidos"] 
    },
    "2": { 
        "name": "María", 
        "items": ["Ver información de la cuenta", "Comprar productos", "Ver pedidos"] 
    },
    "2": { 
        "name": "María", 
        "items": ["Ver información de la cuenta", "Comprar productos", "Ver pedidos"] 
    },
    "2": { 
        "name": "María", 
        "items": ["Ver información de la cuenta", "Comprar productos", "Ver pedidos"] 
    },
    "2": { 
        "name": "María", 
        "items": ["Ver información de la cuenta", "Comprar productos", "Ver pedidos"] 
    },
    "2": { 
        "name": "María", 
        "items": ["Ver información de la cuenta", "Comprar productos", "Ver pedidos"] 
    },
    // Agregar más clientes según sea necesario
};

// Obtener la lista de menú y el mensaje de bienvenida
var menuList = document.getElementById('menu-list');
var welcomeMessage = document.getElementById('welcome-message');

// Verificar si el cliente tiene elementos de menú asociados
if (menuItems.hasOwnProperty(clientId)) {
    // Obtener el nombre del cliente
    var clientName = menuItems[clientId].name;
    
    // Mostrar el mensaje de bienvenida con el nombre del cliente
    welcomeMessage.textContent += ", " + clientName;

    // Crear elementos de lista para cada elemento del menú
    menuItems[clientId].items.forEach(function(item) {
        var listItem = document.createElement('li');
        var link = document.createElement('a');
        link.textContent = item;
        // Agregar el evento de clic a cada elemento del menú
        link.addEventListener('click', function() {
            // Reemplazar espacios en el nombre por guiones bajos para la URL
            var formattedName = clientName.replace(/\s+/g, '_');
            // Redirigir a la página de información del cliente con el nombre del cliente en la URL
            window.location.href = "../../HTML/cliente/MenuCliente/cuenta.html?nombreCliente=" + formattedName;
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
