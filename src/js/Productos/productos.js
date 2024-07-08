document.addEventListener('DOMContentLoaded', function() {
    const contenedorProductos = document.getElementById('contenedor-productos');
    const botonesCategorias = document.querySelectorAll('.boton-categoria');
    const tituloPrincipal = document.getElementById('titulo-principal');
    let productosEnCarrito = [];

    // Cargar todos los productos al cargar la página
    cargarProductos('todos');

    // Escuchar clics en los botones de categoría
    botonesCategorias.forEach(boton => {
        boton.addEventListener('click', function() {
            const categoria = boton.id;
            cargarProductos(categoria);
        });
    });

    function cargarProductos(categoria) {
        fetch(`../../php/producto/productoCliente.php?categoria=${categoria}`)
            .then(response => response.json())
            .then(data => {
                mostrarProductos(data, categoria);
            })
            .catch(error => {
                console.error('Error al cargar productos:', error);
            });
    }

    function mostrarProductos(productos, categoria) {
        contenedorProductos.innerHTML = '';
        tituloPrincipal.textContent = categoria === 'todos' ? 'Todos los productos' : categoria.charAt(0).toUpperCase() + categoria.slice(1);

        productos.forEach(producto => {
            const divProducto = document.createElement('div');
            divProducto.classList.add('producto');

            const cantidadDisponible = producto.cantidad;
            const precioFormateado = new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(producto.precio);

            divProducto.innerHTML = `
                <div class="producto-contenido">
                    <img class="producto-imagen" src="${producto.imagen}" alt="${producto.nombre}">
                    <div class="producto-detalles">
                        <h3 class="producto-titulo">${producto.nombre}</h3>
                        <p class="producto-precio">Precio: ${precioFormateado}</p>
                        <p class="producto-cantidad">Cantidad disponible: ${cantidadDisponible}</p>
                    </div>
                </div>
                <button class="producto-agregar" data-id="${producto.id}">Agregar</button>
            `;

            contenedorProductos.appendChild(divProducto);
        });

        // Actualizar botones agregar
        actualizarBotonesAgregar();
    }

    function actualizarBotonesAgregar() {
        const botonesAgregar = document.querySelectorAll('.producto-agregar');
        botonesAgregar.forEach(boton => {
            boton.addEventListener('click', agregarAlCarrito);
        });
    }

    function agregarAlCarrito(event) {
        const idProducto = event.target.dataset.id;
        const productoSeleccionado = productosEnCarrito.find(producto => producto.id === idProducto);

        if (productoSeleccionado) {
            productoSeleccionado.cantidad++;
        } else {
            const producto = productos.find(p => p.id === idProducto);
            productosEnCarrito.push({
                id: producto.id,
                nombre: producto.nombre,
                precio: producto.precio,
                cantidad: 1
            });
        }

        // Guardar en localStorage
        localStorage.setItem('productos-en-carrito', JSON.stringify(productosEnCarrito));

        // Actualizar número en el carrito (si tienes un elemento numerito en tu HTML)
        actualizarNumerito();
    }

    function actualizarNumerito() {
        const numerito = document.getElementById('numerito');
        const cantidadTotal = productosEnCarrito.reduce((total, producto) => total + producto.cantidad, 0);
        numerito.textContent = cantidadTotal;
    }

    // Cargar productos en el carrito si existen
    const productosEnCarritoLS = JSON.parse(localStorage.getItem('productos-en-carrito')) || [];
    productosEnCarrito = productosEnCarritoLS;
    actualizarNumerito();
});
