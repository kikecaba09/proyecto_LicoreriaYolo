<?php
// Incluir el archivo de conexión a la base de datos
require_once "../conexion.php";

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Consulta para verificar si es administrador
    $sql_admin = "SELECT * FROM Administrador WHERE usuario='$usuario' AND contrasena='$contrasena'";
    $result_admin = $conn->query($sql_admin);

    if ($result_admin->num_rows > 0) {
        // Si el usuario es administrador, redirigir a la página de administrador
        $row = $result_admin->fetch_assoc();
        $nombreUsuario = $row['nombreAdministrador'];
        // Redirigir a administrador.html pasando el nombre de usuario como parámetro
        header("Location: /proyecto_LicoreriaYolo/html/administrador/administrador.html?usuario=$nombreUsuario");
        exit();
    }

    // Consulta para verificar si es cliente
    $sql_cliente = "SELECT * FROM Cliente WHERE usuario='$usuario' AND contrasena='$contrasena'";
    $result_cliente = $conn->query($sql_cliente);

    if ($result_cliente->num_rows > 0) {
        // Si el usuario es cliente, redirigir a la página de cliente
        $row = $result_cliente->fetch_assoc();
        $nombreUsuario = $row['nombreCliente'];
        // Redirigir a menuCliente.html pasando el nombre de usuario como parámetro
        header("Location: /proyecto_LicoreriaYolo/html/cliente/menuCliente.html?usuario=$nombreUsuario");
        exit();
    }

    // Si no se encontró un usuario válido, mostrar mensaje de error
    echo "Usuario o contraseña incorrectos.";

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>
