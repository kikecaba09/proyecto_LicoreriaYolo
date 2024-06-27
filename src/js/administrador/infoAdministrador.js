const btnAbrirModal = document.querySelector("#btn-abrir-modal");
const btnCerrarModal = document.querySelector("#btn-cerrar-modal");
const modal = document.querySelector("#modal");

// Verificar si los elementos fueron encontrados en el DOM
if (btnAbrirModal && btnCerrarModal && modal) {
    // Agregar evento para abrir el modal
    btnAbrirModal.addEventListener("click", () => {
        modal.showModal(); // Intenta mostrar el modal
    });

    // Agregar evento para cerrar el modal
    btnCerrarModal.addEventListener("click", () => {
        modal.close(); // Intenta cerrar el modal
    });
} else {
    console.error("No se encontraron todos los elementos necesarios en el DOM.");
}
