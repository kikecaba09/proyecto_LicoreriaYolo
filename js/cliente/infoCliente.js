// Obtener el ID del cliente de la URL
var urlParams = new URLSearchParams(window.location.search);
var clientId = urlParams.get('idCliente');

// Definir los datos de los clientes
var clientes = [
    {
        "id": "1",
        "nombreCompleto": "Laura Martínez",
        "correo": "laura.martinez@example.com",
        "edad": 28,
        "usuario": "lauram",
        "contraseña": "P@ssw0rd1",
        "imagen": "../../img/Clientes/cliente-03.jpg"
    },
    {
        "id": "2",
        "nombreCompleto": "Roberto Rodríguez",
        "correo": "roberto.rodriguez@example.com",
        "edad": 35,
        "usuario": "robertor",
        "contraseña": "Pass123@",
        "imagen": "../../img/Clientes/cliente-04.jpg"
    },
    // Agregar más clientes según sea necesario
];

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
