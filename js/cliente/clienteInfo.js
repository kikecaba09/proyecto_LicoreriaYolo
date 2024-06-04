window.onload = function() {
    // Get query parameter value
    const urlParams = new URLSearchParams(window.location.search);
    const userId = urlParams.get('idcliente');

    if (userId) {
        const user = JSON.parse(localStorage.getItem('loggedInUser'));

        if (user && user.id === userId) {
            document.getElementById('user-name').textContent = user.nombreCompleto;
            document.getElementById('user-email').textContent = user.correo;
            document.getElementById('user-age').textContent = user.edad;
            document.getElementById('user-image').src = user.imagen;
        } else {
            alert("No hay usuario autenticado o el ID no coincide.");
            window.location.href = "login.html";
        }
    } else {
        alert("No hay usuario autenticado.");
        window.location.href = "login.html";
    }
}
