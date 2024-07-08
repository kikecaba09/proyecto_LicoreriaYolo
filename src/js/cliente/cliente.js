document.addEventListener('DOMContentLoaded', function() {
    cargarBienvenida();
});

function cargarBienvenida() {
    fetch('../../php/cliente/bienvenidaCliente.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('bienvenida').innerHTML = data;
        })
        .catch(error => console.error('Error al cargar la bienvenida:', error));
}

function cargarContenido(pagina) {
    const extension = pagina.endsWith('.php') ? 'php' : 'html';
    console.log(`Cargando contenido: ${pagina} (Extensión: ${extension})`);

    const urlContenido = new URL(`../../php/admin/${pagina}`, window.location.href);
    console.log('URL de contenido:', urlContenido);

    fetch(urlContenido)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.text();
        })
        .then(data => {
            console.log('Datos cargados:', data);
            document.getElementById('contenido').innerHTML = data;
        })
        .catch(error => console.error('Error al cargar el contenido:', error));
}


window.onload = function() {
    // Llama a la función para cargar la información inicial (informacion.php)
    cargarContenido('../../php/cliente/informacionCliente.php');
};
