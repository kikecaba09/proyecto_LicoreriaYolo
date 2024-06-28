document.addEventListener('DOMContentLoaded', function () {
    fetch('../../php/administrador/informacion.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Mostrar los datos del administrador en la página
                const administrador = data.administrador;
                let detalles = `
                    <p>ID: ${administrador.idAdministrador}</p>
                    <p>Nombre: ${administrador.nombreAdministrador}</p>
                    <p>Edad: ${administrador.edad}</p>
                    <p>Teléfono: ${administrador.telefono}</p>
                    <p>Dirección: ${administrador.direccion}</p>
                    <p>Email: ${administrador.email}</p>
                    <p>Rol: ${administrador.rol}</p>
                    <img src="${administrador.imagen}" alt="Imagen del Administrador">
                `;
                document.getElementById('datosAdministrador').innerHTML = detalles;
            } else {
                // Mostrar mensaje de error si no se encontraron datos
                document.getElementById('datosAdministrador').innerHTML = `<p>${data.message}</p>`;
            }
        })
        .catch(error => {
            console.error('Error en la solicitud:', error);
            document.getElementById('datosAdministrador').innerHTML = `<p>Error al obtener los datos del administrador.</p>`;
        });

    document.getElementById('cerrarSesionBtn').addEventListener('click', function () {
        fetch('../../php/login/cerrarSesion.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirigir al usuario a la página de inicio de sesión
                    window.location.href = 'login.php';
                } else {
                    console.error('Error al cerrar sesión:', data.message);
                }
            })
            .catch(error => {
                console.error('Error en la solicitud:', error);
            });
    });
});
