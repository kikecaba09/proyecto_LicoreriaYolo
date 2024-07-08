<?php
session_start(); // Iniciar la sesión si no está iniciada
require_once('../conexion.php'); // Incluir el archivo de conexión

// Obtener la categoría seleccionada (si viene como parámetro GET)
$categoria = $_GET['categoria'] ?? '';

// Preparar la consulta SQL según la categoría seleccionada
if ($categoria && $categoria !== 'todos') {
    $query = "SELECT p.idProducto, p.nombre, p.descripcion, p.precio, p.cantidad_disponible, p.imagen, c.nombreCategoria AS categoria
            FROM Producto p
            INNER JOIN Categoria c ON p.idCategoria = c.idCategoria
            WHERE c.nombreCategoria = ?";
    $statement = $conexion->prepare($query);
    $statement->bind_param('s', $categoria);
} else {
    // Si no se especifica categoría o es 'todos', traer todos los productos
    $query = "SELECT p.idProducto, p.nombre, p.descripcion, p.precio, p.cantidad_disponible, p.imagen, c.nombreCategoria AS categoria
            FROM Producto p
            INNER JOIN Categoria c ON p.idCategoria = c.idCategoria";
    $statement = $conexion->prepare($query);
}

// Ejecutar la consulta
$statement->execute();
$resultado = $statement->get_result();

// Array para almacenar los productos
$productos = [];

// Iterar sobre el resultado y guardar en el array
while ($fila = $resultado->fetch_assoc()) {
    $productos[] = [
        'id' => $fila['idProducto'],
        'nombre' => $fila['nombre'],
        'descripcion' => $fila['descripcion'],
        'precio' => floatval($fila['precio']),
        'cantidad' => intval($fila['cantidad_disponible']),
        'imagen' => $fila['imagen'],
        'categoria' => $fila['categoria']
    ];
}

// Liberar resultado y cerrar la consulta
$resultado->close();
$statement->close();

// Devolver los productos como JSON
header('Content-Type: application/json');
echo json_encode($productos);
?>
