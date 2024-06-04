async function validateLogin(event) {
    event.preventDefault();
    
    const userName = document.querySelector('input[name="userName"]').value;
    const userPassword = document.querySelector('input[name="userPassword"]').value;

    try {
        const response = await fetch('../data/clients.json');
        const users = await response.json();

        const user = users.find(u => u.usuario === userName && u.contraseña === userPassword);

        if (user) {
            // Save user details to localStorage
            localStorage.setItem('loggedInUser', JSON.stringify(user));
            alert("Inicio de sesión exitoso");
            // Redirect to user information page with query parameter
            window.location.href = `userInfo.html?idcliente=${user.id}`;
        } else {
            alert("Credenciales incorrectas, intente nuevamente.");
        }
    } catch (error) {
        console.error('Error fetching users:', error);
        alert("Ocurrió un error al procesar la solicitud. Por favor, intente nuevamente.");
    }
}
