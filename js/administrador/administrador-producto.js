let productos = [];

fetch("../../data/productos.json")
    .then(response => response.json())
    .then(data => {
        productos = data;
        cargarProductos(productos);
    })

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
        boton.addEventListener("click", eliminarProducto);
    });
}

function eliminarProducto(e) {
    const idProducto = e.currentTarget.dataset.id;
    productos = productos.filter(producto => producto.id !== idProducto);
    cargarProductos(productos);
}
