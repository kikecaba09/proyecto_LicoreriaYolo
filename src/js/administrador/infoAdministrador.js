document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('infoCuentaLink').addEventListener('click', function() {
        cargarContenido('../php/obtenerInfoAdmin.php');
    });

    document.getElementById('clientesLink').addEventListener('click', function() {
        cargarContenido('../php/obtenerClientes.php');
    });

    document.getElementById('productosLink').addEventListener('click', function() {
        cargarContenido('../php/obtenerProductos.php');
    });
});

function cargarContenido(url) {
    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById('contenido').innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
}
