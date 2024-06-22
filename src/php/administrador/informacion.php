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
    <link rel="stylesheet" href="../../css/administrador/modal.css"> <!-- Estilos para el modal -->
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
        <div class="edit-button">
            <button onclick="openModal()" class="btn-edit">Editar Información</button>
        </div>
    </div>

    <!-- Modal para editar información del administrador -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Editar Información del Administrador</h2>
            <form id="editForm" action="procesarEditarAdministrador.php" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($admin['nombreAdministrador']); ?>" required><br><br>

                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" value="<?php echo htmlspecialchars($admin['edad']); ?>" required><br><br>

                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($admin['telefono']); ?>"><br><br>

                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($admin['direccion']); ?>"><br><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($admin['email']); ?>" required><br><br>

                <input type="submit" value="Guardar Cambios">
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../../js/administrador/infoAdministrador.js"></script> <!-- JavaScript para el modal -->
</body>
</html>

<?php
} else {
    echo "<p>No se encontró la información del administrador.</p>";
}

$stmt->close();
$conexion->close();
?>
