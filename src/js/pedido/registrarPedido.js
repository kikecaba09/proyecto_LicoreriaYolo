// Función para cargar opciones de productos desde la base de datos
function cargarOpcionesProductos(selectElement) {
    // Realizar una petición AJAX para obtener los productos desde el servidor
    $.ajax({
        url: '../../php/Pedido/obtenerProductos.php', // Archivo PHP que obtiene los productos desde la base de datos
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Limpiar opciones actuales del select
            selectElement.empty();
            
            // Agregar opción por defecto
            selectElement.append($('<option>').text('Selecciona un producto').attr('value', ''));
            
            // Agregar cada producto como una opción en el select
            data.forEach(function(producto) {
                selectElement.append($('<option>').text(producto.nombre).attr('value', producto.idProducto));
            });
        },
        error: function(xhr, status, error) {
            console.error('Error al obtener productos:', error);
        }
    });
}

// Función para agregar dinámicamente los campos de productos
function agregarCamposProducto() {
    const cantidadProductos = document.getElementById('cantidad_productos').value;
    const divProductos = document.getElementById('productos');
    divProductos.innerHTML = ''; // Limpiar contenido anterior
    
    for (let i = 1; i <= cantidadProductos; i++) {
        const nuevoProducto = document.createElement('div');
        nuevoProducto.classList.add('producto');

        nuevoProducto.innerHTML = `
            <label for="producto${i}">Producto ${i}:</label>
            <select name="productos[]" class="productoSelect" required>
                <option value="">Selecciona un producto</option>
                <!-- Opciones de productos se llenarán dinámicamente con JavaScript -->
            </select>
            
            <label for="cantidad${i}">Cantidad:</label>
            <input type="number" name="cantidades[]" class="cantidadInput" min="1" required><br><br>
        `;

        divProductos.appendChild(nuevoProducto);

        // Obtener el select del nuevo producto y cargar las opciones desde la base de datos
        const selectProducto = nuevoProducto.querySelector('.productoSelect');
        cargarOpcionesProductos($(selectProducto));
    }
}

// Esperar a que el documento esté completamente cargado
$(document).ready(function() {
    // Agregar evento al botón "Agregar" para llamar a la función agregarCamposProducto
    $('#agregar').click(function() {
        agregarCamposProducto();
    });
});
