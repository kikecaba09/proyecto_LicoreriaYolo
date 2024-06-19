<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'administrador') {
    echo "Acceso no autorizado";
    exit();
}

$usuario = $_SESSION['usuario'];
$sql = "SELECT nombreAdministrador, edad, telefono, direccion, email, rol, imagen, usuario FROM Administrador WHERE usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<p><strong>Nombre:</strong> " . htmlspecialchars($row['nombreAdministrador']) . "</p>";
    echo "<p><strong>Edad:</strong> " . htmlspecialchars($row['edad']) . "</p>";
    echo "<p><strong>Teléfono:</strong> " . htmlspecialchars($row['telefono']) . "</p>";
    echo "<p><strong>Dirección:</strong> " . htmlspecialchars($row['direccion']) . "</p>";
    echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
    echo "<p><strong>Rol:</strong> " . htmlspecialchars($row['rol']) . "</p>";
    echo "<p><strong>Usuario:</strong> " . htmlspecialchars($row['usuario']) . "</p>";
    if (!empty($row['imagen'])) {
        echo "<img src='../images/" . htmlspecialchars($row['imagen']) . "' alt='Imagen del Administrador' style='max-width: 150px; max-height: 150px;'>";
    }
} else {
    echo "No se encontró la información del administrador.";
}

$stmt->close();
$conexion->close();
?>