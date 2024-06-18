// Script para validar el formulario antes de enviar
function validarFormulario() {
    var usuario = document.getElementById("userName").value;
    var contrasena = document.getElementById("userPassword").value;

    // Validar que los campos no estén vacíos
    if (usuario.trim() === "" || contrasena.trim() === "") {
        document.getElementById("loginMessage").innerText = "Por favor, complete todos los campos.";
        return false;
    }

    return true;
}
