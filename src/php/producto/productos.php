<?php
include_once '../conexion.php';

$sql = "SELECT * FROM Producto WHERE disponible = true";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    ob_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Disponibles</title>
    <link rel="stylesheet" href="../../css/producto/producto.css">
</head>
<body>
    <div class="container">
        <h2 class="titulo-principal">Productos Disponibles</h2>
        <div class="contenedor-productos">
            <?php while ($producto = $resultado->fetch_assoc()) { ?>
            <div class="producto">
                <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="Imagen del Producto" class="producto-imagen">
                <div class="producto-detalles">
                    <h3 class="producto-titulo"><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                    
                    <p class="producto-precio">Precio: $<?php echo number_format($producto['precio'], 2); ?></p>
                    
                    <p class="producto-cantidad">Disponible: <?php echo $producto['cantidad_disponible']; ?></p>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
<?php
    echo ob_get_clean();
} else {
    echo "<p>No hay productos disponibles en este momento.</p>";
}

$conexion->close();
?>
