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
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Administrador</title>
    <link rel="stylesheet" href="../../css/administrador/cuentaAdministrador.css">
</head>
<body>
    <div class="container">
        <div class="admin-info">
            <div class="admin-details">
                <h2>Información de mi cuenta</h2>
                <p><strong>Nombre:</strong> <?php echo htmlspecialchars($admin['nombreAdministrador']); ?></p>
                <p><strong>Edad:</strong> <?php echo htmlspecialchars($admin['edad']); ?></p>
                <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($admin['telefono']); ?></p>
                <p><strong>Dirección:</strong> <?php echo htmlspecialchars($admin['direccion']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($admin['email']); ?></p>
                <p><strong>Rol:</strong> <?php echo htmlspecialchars($admin['rol']); ?></p>
            </div>
            <div class="admin-image">
                <img src="<?php echo htmlspecialchars($admin['imagen']); ?>" alt="Imagen del Administrador">
            </div>
        </div>
    </div>
</body>
</html>
<?php
} else {
    echo "<p>No se encontró la información del administrador.</p>";
}

$stmt->close();
$conexion->close();
?>
