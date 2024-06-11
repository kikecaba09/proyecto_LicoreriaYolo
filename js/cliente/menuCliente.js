// Obtener los parámetros de la URL
var urlParams = new URLSearchParams(window.location.search);
var clientId = urlParams.get('idCliente');

// Obtener la referencia de los elementos de la página
var clientNameElement = document.getElementById('client-name');
var clientImageElement = document.getElementById('client-image');
var menuList = document.getElementById('menu-list');

// Hacer la solicitud AJAX para obtener los datos de los clientes desde el archivo JSON
var xhr = new XMLHttpRequest();
xhr.open('GET', '../../data/clientes.json', true);
xhr.onload = function() {
    if (xhr.status === 200) {
        // Parsear los datos JSON
        var clientes = JSON.parse(xhr.responseText);

        // Verificar si el cliente existe en los datos
        var cliente = clientes.find(function(c) {
            return c.id === clientId;
        });

        if (cliente) {
            // Mostrar el nombre completo del cliente en la página
            clientNameElement.textContent = cliente.nombreCompleto;

            // Mostrar la imagen del cliente si está disponible
            if (cliente.imagen) {
                clientImageElement.src = cliente.imagen;
                clientImageElement.alt = `Imagen de ${cliente.nombreCompleto}`;
                clientImageElement.style.display = 'block'; // Mostrar la imagen
            }

            // Crear elementos de lista para cada elemento del menú
            var menuItems = [
                { nombre: "Ver información de la cuenta", url: "../../HTML/cliente/MenuCliente/cuenta.html" },
                { nombre: "Comprar productos", url: "../../HTML/cliente/MenuCliente/comprar.html" },
                { nombre: "Ver pedidos", url: "../../HTML/cliente/MenuCliente/pedidos.html" }
            ];

            menuItems.forEach(function(item) {
                var listItem = document.createElement('li');
                var link = document.createElement('a');
                link.textContent = item.nombre;
                
                // Agregar el evento de clic a cada elemento del menú
                link.addEventListener('click', function() {
                    // Redirigir a la página correspondiente con el ID del cliente en la URL
                    window.location.href = item.url + "?idCliente=" + clientId;
                });
                
                listItem.appendChild(link);
                menuList.appendChild(listItem);
            });
        } else {
            // Si el cliente no se encuentra, mostrar un mensaje de error
            var errorMessage = document.createElement('li');
            errorMessage.textContent = "Error: Cliente no encontrado o sin menú asociado";
            menuList.appendChild(errorMessage);
        }
    } else {
        console.error('Error al cargar los datos de cliente:', xhr.statusText);
    }
};
xhr.send();
