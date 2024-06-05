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
            // Encontrar el cliente correspondiente
            var cliente = clientes.find(function(item) {
                return item.id === clientId;
            });

            // Mostrar la información del cliente
            if (cliente) {
                var clienteInfoDiv = document.getElementById('cliente-info');
                clienteInfoDiv.innerHTML = `
                    <h2>Información del Cliente</h2>
                    <p><strong>Nombre Completo:</strong> ${cliente.nombreCompleto}</p>
                    <p><strong>Correo:</strong> ${cliente.correo}</p>
                    <p><strong>Edad:</strong> ${cliente.edad}</p>
                    <p><strong>Usuario:</strong> ${cliente.usuario}</p>
                    <!-- Agregar más detalles del cliente según sea necesario -->
                `;
            } else {
                console.error('Cliente no encontrado');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

// Llamar a la función para cargar los datos del cliente
loadClientData();
