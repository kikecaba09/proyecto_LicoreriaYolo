document.addEventListener('DOMContentLoaded', () => {
    const adminInfoContainer = document.querySelector('.admin-details');
    const modal = document.getElementById('modal');
    const btnAbrirModal = document.getElementById('btn-abrir-modal');
    const btnCerrarModal = document.getElementById('btn-cerrar-modal');

    // Realizar la solicitud AJAX para obtener la información del administrador
    fetch('../../php/administrador/informacion.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(html => {
            // Insertar el HTML recibido en el contenedor
            adminInfoContainer.innerHTML = html;
        })
        .catch(error => {
            console.error('Hubo un problema con la solicitud:', error);
        });

    // Función para abrir el modal
    btnAbrirModal.addEventListener('click', () => {
        modal.showModal();
    });

    // Función para cerrar el modal
    btnCerrarModal.addEventListener('click', () => {
        modal.close();
    });
});

function closeModal() {
    document.getElementById('modal').close();
}
