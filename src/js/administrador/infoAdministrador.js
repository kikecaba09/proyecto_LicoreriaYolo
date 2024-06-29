// Suponemos que el contenido del DOM ya está cargado
const datosAdministradorElement = document.getElementById('datosAdministrador');

if (!datosAdministradorElement) {
    console.error('Elemento "datosAdministrador" no encontrado.');
} else {
    // Realizar la solicitud fetch para obtener los datos del administrador
    fetch('http://localhost/proyecto_LicoreriaYOLO/php/administrador/obtenerDatosAdministrador.php?idAdministrador=1')
        .then(response => {
            // Verificar si la respuesta es exitosa
            if (!response.ok) {
                throw new Error('Error en la respuesta de la red: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            // Verificar si la solicitud fue exitosa
            if (data.success) {
                const admin = data.administrador;
                // Actualizar el contenido de la página con los datos del administrador
                datosAdministradorElement.innerHTML = `
                    <p>ID: ${admin.idAdministrador}</p>
                    <p>Nombre: ${admin.nombreAdministrador}</p>
                    <p>Edad: ${admin.edad}</p>
                    <p>Teléfono: ${admin.telefono}</p>
                    <p>Dirección: ${admin.direccion}</p>
                    <p>Email: ${admin.email}</p>
                    <p>Rol: ${admin.rol}</p>
                    <img src="${admin.imagen}" alt="Imagen del administrador">
                `;
            } else {
                // Mostrar mensaje de error si no se encontraron datos
                datosAdministradorElement.innerText = data.message;
            }
        })
        .catch(error => {
            // Manejar cualquier error que ocurra durante la solicitud
            console.error('Error en la solicitud:', error);
            datosAdministradorElement.innerText = 'Error al cargar los datos del administrador.';
        });
}

// Manejador de eventos para el botón de cerrar sesión
const cerrarSesionBtn = document.getElementById('cerrarSesionBtn');

if (!cerrarSesionBtn) {
    console.error('Botón "cerrarSesionBtn" no encontrado.');
} else {
    cerrarSesionBtn.addEventListener('click', function() {
        // Realizar la solicitud para cerrar sesión
        fetch('http://localhost/proyecto_LicoreriaYOLO/php/login/cerrarSesion.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirigir al usuario a la página de login si la sesión se cierra correctamente
                    window.location.href = 'http://localhost/proyecto_LicoreriaYOLO/html/login/loginAdministrador.html';
                } else {
                    console.error('Error al cerrar sesión:', data.message);
                }
            })
            .catch(error => {
                // Manejar cualquier error que ocurra durante la solicitud de cierre de sesión
                console.error('Error en la solicitud de cierre de sesión:', error);
            });
    });
}
