// script.js
// Función para agregar un nuevo producto al archivo productos.json
function agregarProductoNuevo(nuevoProducto) {
    // Obtener los productos actuales del localStorage (o inicializar un array vacío si no hay ninguno)
    let productosActuales = [];
    let productosJSON = localStorage.getItem('productos');

    if (productosJSON) {
        productosActuales = JSON.parse(productosJSON);
    }

    // Agregar el nuevo producto al array de productos actuales
    productosActuales.push(nuevoProducto);

    // Guardar los productos actualizados en el localStorage
    localStorage.setItem('productos', JSON.stringify(productosActuales));
}

// Función para manejar el envío del formulario
document.getElementById('formularioProducto').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar que el formulario se envíe normalmente

    // Obtener los valores del formulario
    let id = document.getElementById('id').value;
    let titulo = document.getElementById('titulo').value;
    let imagen = document.getElementById('imagen').value;
    let categoria = document.getElementById('categoria').value;
    let cantidad = document.getElementById('cantidad').value;
    let precio = document.getElementById('precio').value;

    // Crear el objeto del nuevo producto
    let nuevoProducto = {
        "id": id,
        "titulo": titulo,
        "imagen": imagen,
        "categoria": {
            "nombre": categoria,
            "id": categoria.toLowerCase()
        },
        "cantidad": cantidad,
        "precio": parseFloat(precio)
    };

    // Agregar el nuevo producto al archivo productos.json
    agregarProductoNuevo(nuevoProducto);

    // Limpiar el formulario
    document.getElementById('formularioProducto').reset();

    // Mostrar un mensaje de éxito (opcional)
    alert('Producto agregado exitosamente!');
});
