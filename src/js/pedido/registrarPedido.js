$(document).ready(function() {
    var contador = 1;

    $('#agregar').click(function() {
        var nuevoCampo = '<div id="producto' + contador + '">' +
                            '<label for="producto' + contador + '">Producto ' + contador + ':</label>' +
                            '<input type="text" id="producto' + contador + '" name="productos[]">' +
                            '<label for="cantidad' + contador + '">Cantidad:</label>' +
                            '<input type="number" id="cantidad' + contador + '" name="cantidades[]">' +
                         '</div>';
        
        $('#productos-container').append(nuevoCampo);
        contador++;
    });
});
