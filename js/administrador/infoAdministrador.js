document.addEventListener("DOMContentLoaded", function() {
    var modal = document.getElementById("modal");
    var btnAbrirModal = document.getElementById("btn-abrir-modal");
    var btnCerrarModal = document.getElementById("btn-cerrar-modal");
    var spanClose = document.querySelector(".close");

    // Función para abrir el modal
    btnAbrirModal.addEventListener("click", function() {
        modal.showModal();
    });

    // Función para cerrar el modal
    function closeModal() {
        modal.close();
    }

    // Cerrar modal al hacer clic en el botón de cerrar
    spanClose.addEventListener("click", closeModal);

    // Cerrar modal al hacer clic en el botón de cancelar
    btnCerrarModal.addEventListener("click", function(event) {
        event.preventDefault();
        closeModal();
    });

    // Cerrar modal al hacer clic fuera del contenido del modal
    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            closeModal();
        }
    });
});
