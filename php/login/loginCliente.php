<?php
session_start();
include_once '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta preparada para evitar inyección SQL
    $sql = "SELECT * FROM Cliente WHERE usuario = ? AND contrasena = ?";
    
    // Preparar la consulta
    $stmt = mysqli_stmt_init($conexion);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "Error en la preparación de la consulta.";
    } else {
        // Vincular parámetros
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        
        // Ejecutar consulta
        mysqli_stmt_execute($stmt);
        
        // Obtener resultados
        $result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($result) == 1) {
            $cliente = mysqli_fetch_assoc($result);

            // Iniciar sesión con información adicional
            $_SESSION['idCliente'] = $cliente['idCliente'];
            $_SESSION['nombreCliente'] = $cliente['nombreCliente'];

            // Redirigir con el nombre del cliente en la URL
            $nombreCliente = $cliente['nombreCliente'];
            header("Location: ../../html/cliente/menuCliente.html?nombreCliente=" . urlencode($nombreCliente));
            exit();
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}
?>
