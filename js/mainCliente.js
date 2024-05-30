let clientes = [];

fetch("../data/clientes.json")
    .then(response => response.json())
    .then(data => {
        clientes = data;
        cargarClientes(clientes);
    });

const contenedorClientes = document.querySelector("#contenedor-clientes");
const tituloPrincipal = document.querySelector("#titulo-principal");

function cargarClientes(clientesElegidos) {
    contenedorClientes.innerHTML = "";

    // Crear encabezado
    const header = document.createElement("div");
    header.classList.add("cliente-header");

    header.innerHTML = `
        <span>Imagen</span>
        <span>Nombre Completo</span>
        <span>Edad</span>
        <span>Correo Electrónico</span>
        <span>Usuario</span>
        <span>Contraseña</span>
    `;
    contenedorClientes.append(header);

    // Crear clientes
    clientesElegidos.forEach(cliente => {
        const div = document.createElement("div");
        div.classList.add("cliente");

        div.innerHTML = `
            <div class="cliente-contenido">
                <img class="cliente-imagen" src="${cliente.imagen}" alt="${cliente.nombreCompleto}">
                <div class="cliente-detalle">
                    <p class="cliente-nombre">${cliente.nombreCompleto}</p>
                </div>
                <div class="cliente-detalle">
                    <p class="cliente-edad">${cliente.edad}</p>
                </div>
                <div class="cliente-detalle">
                    <p class="cliente-correo">${cliente.correo}</p>
                </div>
                <div class="cliente-detalle">
                    <p class="cliente-usuario">${cliente.usuario}</p>
                </div>
                <div class="cliente-detalle">
                    <p class="cliente-contrasena">${cliente.contraseña}</p>
                </div>
            </div>
        `;
        contenedorClientes.append(div);
    });
}

// Inicializar la vista principal
tituloPrincipal.innerText = "Todos los clientes";
cargarClientes(clientes);
