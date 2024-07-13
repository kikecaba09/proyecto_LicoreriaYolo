<?php
include '../conexion.php';

// Obtener los datos del formulario
$idProducto = $_POST['idProducto'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$cantidad_disponible = $_POST['cantidad_disponible'];
$en_oferta = $_POST['en_oferta'];

// Crear la consulta SQL para actualizar el producto
$sql = "UPDATE Producto SET
    nombre = ?,
    descripcion = ?,
    precio = ?,
    cantidad_disponible = ?,
    en_oferta = ?
    WHERE idProducto = ?";

// Preparar la declaración
$stmt = $conexion->prepare($sql);

// Verificar si la preparación de la declaración fue exitosa
if ($stmt === false) {
    die('Error en la preparación de la declaración: ' . htmlspecialchars($conexion->error));
}

// Bindear los parámetros a la declaración
$stmt->bind_param('ssdiii', $nombre, $descripcion, $precio, $cantidad_disponible, $en_oferta, $idProducto);

// Ejecutar la declaración
if ($stmt->execute()) {
    echo "Producto actualizado correctamente";
} else {
    echo "Error actualizando el producto: " . htmlspecialchars($stmt->error);
}

// Cerrar la declaración y la conexión
$stmt->close();
$conexion->close();

// Redireccionar de vuelta a la página de productos
header("Location: producto.php");
exit();
?>
