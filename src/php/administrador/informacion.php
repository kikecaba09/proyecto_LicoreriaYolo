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
    ?>
    <div>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($admin['nombreAdministrador']); ?></p>
        <p><strong>Edad:</strong> <?php echo htmlspecialchars($admin['edad']); ?></p>
        <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($admin['telefono']); ?></p>
        <p><strong>Dirección:</strong> <?php echo htmlspecialchars($admin['direccion']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($admin['email']); ?></p>
        <p><strong>Rol:</strong> <?php echo htmlspecialchars($admin['rol']); ?></p>
        <img src="<?php echo htmlspecialchars($admin['imagen']); ?>" alt="Imagen del Administrador">
    </div>
    <?php
} else {
    echo "<p>No se encontró la información del administrador.</p>";
}

$stmt->close();
$conexion->close();
?>
