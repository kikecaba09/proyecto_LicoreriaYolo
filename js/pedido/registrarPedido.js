// Función para manejar la adición dinámica de campos de productos
function setupAgregarProductos() {
    var contadorProductos = 0; // Contador para llevar la cuenta de los productos agregados

    $('#agregar').click(function() {
        contadorProductos++; // Incrementa el contador al hacer clic en "Agregar"

        var nuevoProductoHtml = `
            <div class="producto">
                <label for="producto_${contadorProductos}">Producto ${contadorProductos}:</label>
                <input type="text" id="producto_${contadorProductos}" name="productos[]" required>
                
                <label for="cantidad_${contadorProductos}">Cantidad:</label>
                <input type="number" id="cantidad_${contadorProductos}" name="cantidades[]" min="1" required>
                
                <button type="button" class="eliminar" data-producto="${contadorProductos}">Eliminar</button>
            </div>
        `;

        $('#productos-container').append(nuevoProductoHtml); // Agrega el nuevo producto al contenedor
    });

    // Manejar la eliminación de productos
    $('#productos-container').on('click', '.eliminar', function() {
        var productoAEliminar = $(this).data('producto');
        $('#producto_' + productoAEliminar).parent('.producto').remove(); // Elimina el producto del DOM
    });
}

// Ejecutar la función cuando el documento esté listo
$(document).ready(function() {
    setupAgregarProductos(); // Inicia la funcionalidad de agregar productos dinámicamente
});
