<?php
// Iniciar sesión si es necesario
session_start();

// Incluir el archivo de conexión a la base de datos
include_once '../conexion.php';

// Verificar si el administrador está autenticado
if (!isset($_SESSION['idAdministrador'])) {
    header("Location: ../../html/login/loginAdministrador.html");
    exit();
}

// Verificar si se recibió el parámetro idCliente y si es un número válido
if (isset($_POST['idCliente']) && is_numeric($_POST['idCliente'])) {
    $idCliente = $_POST['idCliente'];

    // Consulta SQL para eliminar el cliente
    $sql = "DELETE FROM Cliente WHERE idCliente = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $idCliente);

    if ($stmt->execute()) {
        echo json_encode(array('status' => 'success', 'message' => 'Cliente eliminado correctamente.'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error al eliminar el cliente.'));
    }

    $stmt->close();
} else {
    echo json_encode(array('status' => 'error', 'message' => 'ID de cliente no válido.'));
}

// Cerrar la conexión
$conexion->close();
?>
