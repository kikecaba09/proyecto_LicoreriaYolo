<?php
// Conexión a la base de datos
require_once '../conexion.php';

// Verificar si se recibieron los datos esperados
if (!isset($_POST['fecha_pedido'], $_POST['fecha_entrega'], $_POST['productos'], $_POST['cantidades'])) {
    exit("Error: Datos incompletos.");
}

// Iniciar sesión si no está iniciada
session_start();

// Verificar que el cliente haya iniciado sesión y obtener su ID
if (!isset($_SESSION['idCliente'])) {
    exit("Error: Cliente no ha iniciado sesión.");
}
$idCliente = $_SESSION['idCliente'];

// Obtener datos del formulario
$fecha_pedido = $_POST['fecha_pedido'];
$fecha_entrega = $_POST['fecha_entrega'];
$productos = $_POST['productos'];
$cantidades = $_POST['cantidades'];

try {
    // Iniciar una transacción
    $pdo->beginTransaction();

    // Insertar el pedido en la tabla Pedido
    $sqlPedido = "INSERT INTO Pedido (idCliente, fecha_pedido, fecha_entrega, estado)
                  VALUES (?, ?, ?, 'Pendiente')";
    $stmtPedido = $pdo->prepare($sqlPedido);
    $stmtPedido->execute([$idCliente, $fecha_pedido, $fecha_entrega]);
    $idPedido = $pdo->lastInsertId();

    // Insertar detalles del pedido en la tabla DetallePedido
    $sqlDetallePedido = "INSERT INTO DetallePedido (idPedido, idProducto, cantidad, subtotal)
                         VALUES (?, ?, ?, ?)";
    $stmtDetallePedido = $pdo->prepare($sqlDetallePedido);

    // Iterar sobre cada producto y su cantidad para insertar en DetallePedido
    foreach ($productos as $key => $idProducto) {
        $cantidad = $cantidades[$key];

        // Obtener el precio del producto para calcular el subtotal
        $stmtPrecio = $pdo->prepare("SELECT precio FROM Producto WHERE idProducto = ?");
        $stmtPrecio->execute([$idProducto]);
        $precioProducto = $stmtPrecio->fetchColumn();

        $subtotal = $precioProducto * $cantidad;

        // Insertar detalle del pedido
        $stmtDetallePedido->execute([$idPedido, $idProducto, $cantidad, $subtotal]);
    }

    // Confirmar la transacción
    $pdo->commit();

    // Redireccionar o mostrar mensaje de éxito
    echo "Pedido registrado correctamente.";
} catch (Exception $e) {
    // Revertir la transacción si hay un error
    $pdo->rollBack();
    exit("Error al registrar el pedido: " . $e->getMessage());
}
?>
