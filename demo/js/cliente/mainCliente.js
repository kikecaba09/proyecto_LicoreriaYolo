let clientes = [];

fetch("../../data/clientes.json")
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
        <span>Acciones</span>
    `;
    contenedorClientes.append(header);

    if (clientesElegidos.length === 0) {
        contenedorClientes.innerHTML = "<p>No hay ningún cliente registrado.</p>";
        return;
    }

    // Crear línea horizontal debajo del encabezado
    const hr = document.createElement("hr");
    hr.classList.add("header-line");
    contenedorClientes.append(hr);

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
                <div class="clientes-acciones">
                    <button class="cliente-ver-pedidos" data-id="${cliente.id}">Ver Mis Pedidos</button>
                </div>
            </div>
        `;
        contenedorClientes.append(div);
    });

    // Añadir manejador de eventos para botones de ver pedidos
    document.querySelectorAll(".cliente-ver-pedidos").forEach(boton => {
        boton.addEventListener("click", verPedidosCliente);
    });
}

function verPedidosCliente(e) {
    const idCliente = e.currentTarget.getAttribute("data-id");
    const url = `pedidos.html?cliente=${idCliente}`;
    window.location.href = url;
}

tituloPrincipal.innerText = "Todos los clientes";
cargarClientes(clientes);
