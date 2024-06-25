<?php
// Iniciar sesión si es necesario
session_start();

// Incluir el archivo de conexión a la base de datos
include_once '../conexion.php';

// Verificar si el administrador está autenticado, si no, redirigir a la página de inicio de sesión
if (!isset($_SESSION['idAdministrador'])) {
    header("Location: ../../html/login/loginAdministrador.html");
    exit();
}

// Consulta SQL para seleccionar todos los clientes
$sql = "SELECT * FROM Cliente";
$resultado = $conexion->query($sql);

// Comprobar si hay resultados
if ($resultado->num_rows > 0) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes Registrados</title>
    <link rel="stylesheet" href="../../css/administrador/clientesAdministrador.css">
</head>
<body>
    <div class="container">
        <h2>Clientes Registrados</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Edad</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Fecha de Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><img src="<?php echo htmlspecialchars($fila['imagen']); ?>" alt="Imagen del Cliente"></td>
                        <td><?php echo htmlspecialchars($fila['nombreCliente']); ?></td>
                        <td><?php echo $fila['edad']; ?></td>
                        <td><?php echo htmlspecialchars($fila['email']); ?></td>
                        <td><?php echo htmlspecialchars($fila['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($fila['direccion']); ?></td>
                        <td><?php echo $fila['fechaRegistro']; ?></td>
                        <td>
                            <form action="eliminarCliente.php" method="POST">
                                <input type="hidden" name="idCliente" value="<?php echo $fila['idCliente']; ?>">
                                <button type="submit" class="btn-eliminar">Eliminar</button>
                            </form>
                            <a href="../cliente/verPedidos.php?nombreCliente=<?php echo $fila['nombreCliente']; ?>" class="btn-ver-pedidos">Ver Pedidos</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php
} else {
    echo "<p>No se encontraron clientes registrados.</p>";
}

// Cerrar la conexión y liberar recursos
$conexion->close();
?>
