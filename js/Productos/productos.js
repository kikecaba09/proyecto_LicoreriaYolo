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
        const producto = productos.find(p => p.id === idProducto);

        // Mostrar ventana emergente de SweetAlert para ingresar la cantidad
        Swal.fire({
            title: `¿Cuántos ${producto.nombre} deseas agregar al carrito?`,
            input: 'number',
            inputAttributes: {
                min: 1,
                max: producto.cantidad,
                step: 1,
                value: 1
            },
            showCancelButton: true,
            confirmButtonText: 'Agregar al Carrito',
            cancelButtonText: 'Cancelar',
            inputValidator: (value) => {
                if (!value || value < 1 || value > producto.cantidad) {
                    return 'Por favor, ingresa una cantidad válida.';
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const cantidadAAgregar = parseInt(result.value, 10);

                // Actualizar la base de datos con la nueva cantidad
                actualizarCantidadEnBD(idProducto, producto.cantidad - cantidadAAgregar)
                    .then(() => {
                        // Mostrar mensaje de confirmación
                        Swal.fire({
                            icon: 'success',
                            title: 'Producto Agregado al Carrito',
                            text: `${cantidadAAgregar} ${producto.nombre} agregado(s) al carrito.`,
                            showConfirmButton: false,
                            timer: 1500 // Ocultar automáticamente después de 1.5 segundos
                        });

                        // Opcional: Puedes actualizar la lista de productos en el carrito en el frontend si lo deseas
                        // productosEnCarrito.push({
                        //     id: producto.id,
                        //     nombre: producto.nombre,
                        //     precio: producto.precio,
                        //     cantidad: cantidadAAgregar
                        // });
                        // actualizarNumerito();
                    })
                    .catch(error => {
                        console.error('Error al actualizar la cantidad en la base de datos:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un problema al agregar el producto al carrito. Por favor, inténtalo de nuevo más tarde.'
                        });
                    });
            }
        });
    }

    function actualizarCantidadEnBD(idProducto, nuevaCantidad) {
        return fetch(`../../php/producto/actualizarCantidad.php?id=${idProducto}&cantidad=${nuevaCantidad}`, {
            method: 'POST',
            // Agregar headers si es necesario
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al actualizar la cantidad en la base de datos');
            }
            // Procesar la respuesta si es necesario
        });
    }

    function actualizarNumerito() {
        const numerito = document.getElementById('numerito');
        const cantidadTotal = productosEnCarrito.reduce((total, producto) => total + producto.cantidad, 0);
        numerito.textContent = cantidadTotal;
    }

    // Cargar productos en el carrito si existen (opcionalmente)
    // const productosEnCarritoLS = JSON.parse(localStorage.getItem('productos-en-carrito')) || [];
    // productosEnCarrito = productosEnCarritoLS;
    // actualizarNumerito();
});
