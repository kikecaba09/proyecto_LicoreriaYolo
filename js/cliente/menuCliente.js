// Obtener el ID del cliente de la URL
var urlParams = new URLSearchParams(window.location.search);
var clientId = urlParams.get('idCliente');

// Definir los elementos del menú para cada cliente
var menuItems = {
    "1": ["Ver información de la cuenta", "Comprar productos", "Ver pedidos"],
    "2": ["Ver información de la cuenta", "Comprar productos"],
    // Agregar más clientes y elementos del menú según sea necesario
};

// Obtener la lista de menú
var menuList = document.getElementById('menu-list');

// Verificar si el cliente tiene elementos de menú asociados
if (menuItems.hasOwnProperty(clientId)) {
    // Crear elementos de lista para cada elemento del menú
    menuItems[clientId].forEach(function(item) {
        var listItem = document.createElement('li');
        var link = document.createElement('a');
        link.href = "#" + item.replace(" ", "-").toLowerCase(); // Cambiar espacios a guiones y convertir a minúsculas para el hash
        link.textContent = item;
        listItem.appendChild(link);
        menuList.appendChild(listItem);
    });
} else {
    // Si el cliente no tiene elementos de menú asociados, mostrar un mensaje de error
    var errorMessage = document.createElement('li');
    errorMessage.textContent = "Error: Cliente no encontrado o sin menú asociado";
    menuList.appendChild(errorMessage);
}
