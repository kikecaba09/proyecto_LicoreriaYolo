<?php
session_start();
include '../conexion.php';

// Verificar si el administrador está autenticado
if (!isset($_SESSION['idAdministrador'])) {
    echo "<p>No tienes permiso para acceder a esta información.</p>";
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
    echo "<h2>Mi Información</h2>";
    echo "<p><strong>Nombre:</strong> " . htmlspecialchars($admin['nombreAdministrador']) . "</p>";
    echo "<p><strong>Edad:</strong> " . htmlspecialchars($admin['edad']) . "</p>";
    echo "<p><strong>Teléfono:</strong> " . htmlspecialchars($admin['telefono']) . "</p>";
    echo "<p><strong>Dirección:</strong> " . htmlspecialchars($admin['direccion']) . "</p>";
    echo "<p><strong>Email:</strong> " . htmlspecialchars($admin['email']) . "</p>";
    echo "<p><strong>Rol:</strong> " . htmlspecialchars($admin['rol']) . "</p>";
    echo "<img src='" . htmlspecialchars($admin['imagen']) . "' alt='Imagen del Administrador' class='admin-image'>";
} else {
    echo "<p>No se encontró la información del administrador.</p>";
}

$stmt->close();
$conexion->close();
?>
