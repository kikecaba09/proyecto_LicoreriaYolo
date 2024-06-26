document.addEventListener('DOMContentLoaded', () => {
    const btnAbrirModal = document.getElementById('btn-abrir-modal');
    const modal = document.getElementById('modal');
    const modalContent = document.querySelector('.modal-content');

    // Función para cargar la información del administrador
    function cargarInformacionAdmin() {
        fetch('../../php/administrador/informacion.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('No se pudo cargar la información del administrador.');
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    console.error(data.error);
                    return;
                }
                // Mostrar información del administrador en la página
                document.getElementById('nombre').textContent = data.nombreAdministrador;
                document.getElementById('edad').textContent = data.edad;
                document.getElementById('telefono').textContent = data.telefono;
                document.getElementById('direccion').textContent = data.direccion;
                document.getElementById('email').textContent = data.email;
                document.getElementById('rol').textContent = data.rol;

                // Rellenar formulario del modal con la información actual
                document.getElementById('nombre-edit').value = data.nombreAdministrador;
                document.getElementById('edad-edit').value = data.edad;
                document.getElementById('telefono-edit').value = data.telefono;
                document.getElementById('direccion-edit').value = data.direccion;
                document.getElementById('email-edit').value = data.email;
            })
            .catch(error => console.error('Error al cargar la información del administrador:', error));
    }

    // Abrir modal al hacer clic en el botón "Editar Información"
    btnAbrirModal.addEventListener('click', () => {
        // Cargar la información del administrador antes de mostrar el modal
        cargarInformacionAdmin();
        modal.style.display = 'block'; // Mostrar el modal
    });

    // Cerrar el modal al hacer clic en el botón de cancelar
    document.getElementById('btn-cerrar-modal').addEventListener('click', () => {
        modal.style.display = 'none'; // Ocultar el modal
    });

    // Cerrar el modal si el usuario hace clic fuera del contenido del modal
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none'; // Ocultar el modal
        }
    });

    // Evitar que el modal se cierre al hacer clic dentro del contenido del modal
    modalContent.addEventListener('click', (event) => {
        event.stopPropagation(); // Evitar la propagación del evento de clic
    });

    // Función para cerrar el modal desde cualquier parte del código
    window.closeModal = () => {
        modal.style.display = 'none';
    };
});
