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

function cargarContenido(url) {
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al cargar la página');
            }
            return response.text();
        })
        .then(data => {
            document.getElementById('contenido').innerHTML = data;
        })
        .catch(error => {
            console.error('Hubo un problema al cargar el contenido:', error);
        });
}

window.onload = function() {
    // Llama a la función para cargar la información inicial (informacion.php)
    cargarContenido('../../html/administrador/cuentaAdministrador.html');
};
