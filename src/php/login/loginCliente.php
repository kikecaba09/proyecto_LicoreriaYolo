<?php
// Incluir la conexión a la base de datos
include '../conexion.php';

// Verificar si se han enviado los datos del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $usuario = $_POST['username'];
    $contrasena = $_POST['password'];

    // Preparar la consulta para evitar inyección SQL
    $stmt = $conexion->prepare("SELECT * FROM Cliente WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verificar si se encontró el usuario
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($contrasena, $fila['contrasena'])) {
            // Inicio de sesión exitoso
            $nombreCliente = $fila['nombreCliente'];
            // Redirigir al dashboard personalizado del cliente con nombre en la URL
            header("Location: ../../html/cliente/menuCliente.html?nombreCliente=" . urlencode($nombreCliente));
            exit();
        } else {
            // Contraseña incorrecta
            echo "Nombre de usuario o contraseña incorrectos.";
        }
    } else {
        // Usuario no encontrado
        echo "Nombre de usuario o contraseña incorrectos.";
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
}

$conexion->close();
?>
