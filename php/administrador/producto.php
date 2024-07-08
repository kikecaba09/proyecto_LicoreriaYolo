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

// Consulta SQL para seleccionar todos los productos disponibles
$sql = "SELECT * FROM Producto";
$resultado = $conexion->query($sql);

// Comprobar si hay resultados
if ($resultado->num_rows > 0) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Disponibles</title>
    <link rel="stylesheet" href="../../css/administrador/productoAdmin.css">
</head>
<body>
    <div class="container">
        <h2>Productos Disponibles</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Cantidad Disponible</th>
                        <th>En Oferta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><img src="<?php echo htmlspecialchars($fila['imagen']); ?>" alt="Imagen del Producto"></td>
                        <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($fila['descripcion']); ?></td>
                        <td><?php echo number_format($fila['precio'], 2); ?></td>
                        <td><?php echo $fila['cantidad_disponible']; ?></td>
                        <td><?php echo $fila['en_oferta'] ? 'Sí' : 'No'; ?></td>
                        <td>
                            <button onclick="verDetalles(<?php echo $fila['idProducto']; ?>)">Modificar</button>
                            <button onclick="eliminarProducto(<?php echo $fila['idProducto']; ?>)">Eliminar</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../../js/administrador/productosAdministrador.js"></script>
</body>
</html>
<?php
} else {
    echo "<p>No se encontraron productos disponibles.</p>";
}

// Cerrar la conexión y liberar recursos
$conexion->close();
?>
