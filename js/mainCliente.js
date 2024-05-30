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
                <button class="cliente-eliminar" data-id="${cliente.id}">Eliminar</button>
            </div>
        `;
        contenedorClientes.append(div);
    });

    // Añadir manejador de eventos para botones de eliminar
    document.querySelectorAll(".cliente-eliminar").forEach(boton => {
        boton.addEventListener("click", confirmarEliminarCliente);
    });
}

function confirmarEliminarCliente(e) {
    const idCliente = e.currentTarget.getAttribute("data-id");
    const clienteAEliminar = clientes.find(cliente => cliente.id === idCliente);

    Swal.fire({
        title: `¿Estás seguro de eliminar a ${clienteAEliminar.nombreCompleto}?`,
        text: "Esta acción no se puede deshacer",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            clientes = clientes.filter(cliente => cliente.id !== idCliente);
            cargarClientes(clientes);
            Swal.fire(
                'Eliminado!',
                'El cliente ha sido eliminado.',
                'success'
            );
        }
    });
}

tituloPrincipal.innerText = "Todos los clientes";
cargarClientes(clientes);
