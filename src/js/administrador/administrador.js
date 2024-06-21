document.addEventListener('DOMContentLoaded', function() {
    cargarBienvenida();
});

function cargarBienvenida() {
    fetch('../../php/administrador/bienvenida.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('bienvenida').innerHTML = data;
        })
        .catch(error => console.error('Error al cargar la bienvenida:', error));
}

function cargarContenido(pagina) {
    fetch(`../../php/admin/${pagina}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('contenido').innerHTML = data;
        })
        .catch(error => console.error('Error al cargar el contenido:', error));
}
