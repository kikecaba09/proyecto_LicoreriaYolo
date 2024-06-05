// Obtener el ID del cliente de la URL
var urlParams = new URLSearchParams(window.location.search);
var clientId = urlParams.get('idCliente');

// Definir la función para cargar los datos de los clientes desde un archivo JSON
function loadClientData() {
    fetch('../../data/clientes.json')
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al cargar el archivo JSON');
            }
            return response.json();
        })
        .then(clientes => {
            // Definir elementos de menú predeterminados
            var defaultMenuItems = ["Ver información de la cuenta", "Comprar productos", "Ver pedidos"];

            // Encontrar el cliente correspondiente
            var cliente = clientes.find(function(item) {
                return item.id === clientId;
            });

            // Obtener la lista de menú
            var menuList = document.getElementById('menu-list');

            if (cliente) {
                // Crear elementos de lista para cada elemento del menú
                defaultMenuItems.forEach(function(item) {
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
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

// Llamar a la función para cargar los datos del cliente
loadClientData();
