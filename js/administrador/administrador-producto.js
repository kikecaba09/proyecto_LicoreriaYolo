let productos = [];
let idProductoAEliminar = null;

// Cargar el script de SweetAlert2
const script = document.createElement("script");
script.src = "https://cdn.jsdelivr.net/npm/sweetalert2@11";
document.head.appendChild(script);

fetch("../../data/productos.json")
    .then(response => response.json())
    .then(data => {
        productos = data;
        cargarProductos(productos);
    });

const contenedorProductos = document.querySelector("#contenedor-productos");
const buscarInput = document.querySelector("#buscar");

buscarInput.addEventListener("input", () => {
    const valor = buscarInput.value.toLowerCase();
    const productosFiltrados = productos.filter(producto =>
        producto.titulo.toLowerCase().includes(valor)
    );
    cargarProductos(productosFiltrados);
});

function cargarProductos(productosMostrar) {
    contenedorProductos.innerHTML = "";
    productosMostrar.forEach(producto => {
        const div = document.createElement("div");
        div.classList.add("producto");

        div.innerHTML = `
            <div class="producto-contenido">
                <img class="producto-imagen" src="${producto.imagen}" alt="${producto.titulo}">
                <div class="producto-detalles">
                    <h3 class="producto-titulo">${producto.titulo}</h3>
                    <p class="producto-precio">Precio: $${producto.precio}0</p>
                    <p class="producto-cantidad">Cantidad disponible: ${producto.cantidad}</p>
                </div>
            </div>
            <button class="eliminar-producto" data-id="${producto.id}">Eliminar</button>
        `;
        contenedorProductos.append(div);
    });
    actualizarBotonesEliminar();
}

function actualizarBotonesEliminar() {
    const botonesEliminar = document.querySelectorAll(".eliminar-producto");
    botonesEliminar.forEach(boton => {
        boton.addEventListener("click", (e) => {
            idProductoAEliminar = e.currentTarget.dataset.id;
            mostrarModalConfirmacion();
        });
    });
}

function mostrarModalConfirmacion() {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo!',
        cancelButtonText: 'No, cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            eliminarProductoConfirmado();
            Swal.fire(
                'Eliminado!',
                'El producto ha sido eliminado.',
                'success'
            )
        }
    });
}

function eliminarProductoConfirmado() {
    if (idProductoAEliminar) {
        productos = productos.filter(producto => producto.id !== idProductoAEliminar);
        cargarProductos(productos);
        idProductoAEliminar = null;
    }
}

