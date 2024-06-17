document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('infoCuentaLink').addEventListener('click', function() {
        cargarContenido('../../html/administrador/cuentaAdministrador.html');
        cambiarClaseActiva(this);
    });

    document.getElementById('clientesLink').addEventListener('click', function() {
        cargarContenido('../../html/administrador/administrador-Cliente.html');
        cambiarClaseActiva(this);
    });

    document.getElementById('productosLink').addEventListener('click', function() {
        cargarContenido('../../html/administrador/administrador-Producto.html');
        cambiarClaseActiva(this);
    });

    // Cargar la vista inicial
    cargarContenido('../../html/administrador/cuentaAdministrador.html');
});

function cargarContenido(url) {
    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById('contenido').innerHTML = data;
            cargarScript(url.replace('.html', '.js')); // Carga el script correspondiente
        })
        .catch(error => console.error('Error:', error));
}

function cambiarClaseActiva(element) {
    let links = document.querySelectorAll('.nav-link');
    links.forEach(link => {
        link.classList.remove('active');
    });
    element.classList.add('active');
}

function cargarScript(scriptUrl) {
    let script = document.createElement('script');
    script.src = scriptUrl;
    document.body.appendChild(script);
}
