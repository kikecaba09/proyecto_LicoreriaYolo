<?php
// Iniciar sesión
session_start();

include_once '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta preparada para evitar inyección SQL
    $sql = "SELECT * FROM Administrador WHERE usuario = ? AND contrasena = ?";
    
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
            // Usuario y contraseña válidos
            // Obtener datos del administrador
            $admin = mysqli_fetch_assoc($result);
            
            // Iniciar sesión con información adicional
            $_SESSION['idAdministrador'] = $admin['idAdministrador'];
            $_SESSION['nombreAdministrador'] = $admin['nombreAdministrador'];
            // Puedes agregar más información si es necesario
            
            // Redirigir al panel de administrador
            header("Location: ../../html/administrador/administrador.html");
            exit();
        } else {
            // Usuario o contraseña incorrectos
            echo "Usuario o contraseña incorrectos.";
        }
    }

    // Cerrar declaración y conexión
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}
?>
