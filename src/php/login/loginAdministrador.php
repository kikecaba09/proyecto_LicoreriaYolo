<?php
require_once('../conexion.php');

// Crear una instancia de la clase de conexión
$dbConnection = new DBConnection();
$conn = $dbConnection->conn;

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta SQL para verificar el usuario y contraseña
    $sql = "SELECT * FROM Administrador WHERE usuario = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Usuario encontrado, verificar contraseña
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['contrasena'])) {
            // Inicio de sesión exitoso
            session_start();
            $_SESSION['username'] = $username;
            // Redirigir al dashboard del administrador
            header("Location: /src/html/administrador/administrador.html");
            exit(); // Importante: asegúrate de salir del script después de la redirección
        } else {
            // Contraseña incorrecta
            echo "Contraseña incorrecta";
        }
    } else {
        // Usuario no encontrado
        echo "Usuario no encontrado";
    }
}

// Cerrar conexión a la base de datos al finalizar
$dbConnection->closeConnection();
?>
