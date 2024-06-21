$(document).ready(function() {
    $('#admin-info-link').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'getAdminInfo.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.error) {
                    alert(data.error);
                    window.location.href = 'loginAdministrador.html'; // Redirige a la página de login si hay un error
                } else {
                    let adminInfoHTML = `
                        <h2>Información del Administrador</h2>
                        <div class="admin-info">
                            <img src="${data.imagen}" alt="Foto del Administrador" class="admin-image">
                            <ul>
                                <li><strong>Nombre:</strong> ${data.nombreAdministrador}</li>
                                <li><strong>Edad:</strong> ${data.edad}</li>
                                <li><strong>Teléfono:</strong> ${data.telefono}</li>
                                <li><strong>Dirección:</strong> ${data.direccion}</li>
                                <li><strong>Email:</strong> ${data.email}</li>
                                <li><strong>Rol:</strong> ${data.rol}</li>
                            </ul>
                        </div>
                    `;
                    $('#content-container').html(adminInfoHTML);
                }
            },
            error: function(xhr, status, error) {
                alert('Error al cargar la información del administrador.');
                console.error(error);
            }
        });
    });
});
