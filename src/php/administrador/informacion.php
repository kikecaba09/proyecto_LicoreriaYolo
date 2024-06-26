<?php
session_start();
include '../conexion.php';

// Verificar si el administrador está autenticado
if (!isset($_SESSION['idAdministrador'])) {
    http_response_code(403);
    echo json_encode(["error" => "No tienes permiso para acceder a esta información."]);
    exit();
}

$idAdministrador = $_SESSION['idAdministrador'];
$sql = "SELECT * FROM Administrador WHERE idAdministrador = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $idAdministrador);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $admin = $resultado->fetch_assoc();
    echo json_encode($admin);
} else {
    echo json_encode(["error" => "No se encontró la información del administrador."]);
}

$stmt->close();
$conexion->close();
?>
