<?php
// Conexión a la base de datos
require_once '../conexion.php';

// Consulta para obtener todos los productos disponibles
$sql = "SELECT idProducto, nombre FROM Producto WHERE disponible = 1";
$stmt = $pdo->query($sql);

// Obtener resultados como un array asociativo
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Devolver productos como JSON
header('Content-Type: application/json');
echo json_encode($productos);
?>
