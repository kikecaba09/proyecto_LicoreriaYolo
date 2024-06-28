<?php
header('Content-Type: application/json');

// Iniciar la sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir la clase de conexión
include_once '../conexion.php';

// Verificar la sesión de administrador
if (!isset($_SESSION['idAdministrador'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Acceso denegado. Debes iniciar sesión como administrador.'
    ]);
    exit;
}

$p_idAdministrador = $_SESSION['idAdministrador'];

try {
    // Preparar la llamada al procedimiento almacenado
    $stmt = $conexion->prepare("CALL ObtenerDatosAdministrador(?)");
    $stmt->bind_param("i", $p_idAdministrador);
    $stmt->execute();

    // Obtener resultados del procedimiento almacenado
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $administrador = $result->fetch_assoc();
        // Devolver respuesta JSON con éxito y los datos del administrador
        echo json_encode([
            'success' => true,
            'administrador' => $administrador
        ]);
    } else {
        // Devolver respuesta JSON con error si no se encontraron datos
        echo json_encode([
            'success' => false,
            'message' => 'No se encontró ningún administrador con el ID proporcionado'
        ]);
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conexion->close();

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al procesar la solicitud: ' . $e->getMessage()
    ]);
}
?>
