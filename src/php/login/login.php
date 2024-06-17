<?php
// Incluir archivo de conexión a la base de datos
require_once '../conexion.php';

// Iniciar sesión
session_start();

// Verificar si se enviaron datos por el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Consulta SQL para verificar si el usuario es cliente
    $query_cliente = "SELECT * FROM Cliente WHERE usuario = '$usuario' AND contrasena = '$contrasena'";
    $result_cliente = mysqli_query($conexion, $query_cliente);

    // Consulta SQL para verificar si el usuario es administrador
    $query_admin = "SELECT * FROM Administrador WHERE usuario = '$usuario' AND contrasena = '$contrasena'";
    $result_admin = mysqli_query($conexion, $query_admin);

    // Verificar si el usuario es cliente
    if (mysqli_num_rows($result_cliente) == 1) {
        // Iniciar sesión como cliente
        $_SESSION['usuario'] = $usuario;
        $_SESSION['tipo_usuario'] = 'cliente';
        header("location: /proyecto_LicoreriaYolo/src/html/cliente/menuCliente.html"); // Redirigir al menú de cliente
        exit();
    } 
    // Verificar si el usuario es administrador
    elseif (mysqli_num_rows($result_admin) == 1) {
        // Iniciar sesión como administrador
        $_SESSION['usuario'] = $usuario;
        $_SESSION['tipo_usuario'] = 'administrador';
        header("location: /proyecto_LicoreriaYolo/src/html/administrador/administrador.html"); // Redirigir a la página de administrador
        exit();
    } 
    else {
        // Si no se encuentra el usuario en ninguna tabla, mostrar mensaje de error
        $error_message = "Usuario o contraseña incorrectos. Por favor, inténtelo de nuevo.";
        echo "<script>alert('$error_message'); window.location.href = 'login.html';</script>";
        exit();
    }
}

// Cerrar conexión (si es necesario cerrarla aquí)
mysqli_close($conexion);
?>
