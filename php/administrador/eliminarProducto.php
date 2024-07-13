<?php
include '../conexion.php';

// Verificar si el ID del producto se ha pasado como parámetro en POST
if (isset($_POST['idProducto']) && !empty($_POST['idProducto'])) {
    // Obtener y sanitizar el ID del producto
    $idProducto = intval($_POST['idProducto']);

    // Iniciar una transacción
    $conexion->begin_transaction();

    try {
        // Preparar la consulta para eliminar detalles de pedidos relacionados con el producto
        $sqlEliminarDetallesPedidos = "DELETE FROM DetallePedido WHERE idProducto = ?";
        $stmtEliminarDetallesPedidos = $conexion->prepare($sqlEliminarDetallesPedidos);
        $stmtEliminarDetallesPedidos->bind_param('i', $idProducto);
        $stmtEliminarDetallesPedidos->execute();

        // Preparar la consulta para eliminar el producto
        $sqlEliminarProducto = "DELETE FROM Producto WHERE idProducto = ?";
        $stmtEliminarProducto = $conexion->prepare($sqlEliminarProducto);
        $stmtEliminarProducto->bind_param('i', $idProducto);
        $stmtEliminarProducto->execute();

        // Comprobar si se eliminaron registros en ambas tablas
        if ($stmtEliminarDetallesPedidos->affected_rows > 0 && $stmtEliminarProducto->affected_rows > 0) {
            // Confirmar la transacción si todas las operaciones fueron exitosas
            $conexion->commit();

            // Enviar una respuesta JSON al cliente
            $response = array('status' => 'success', 'message' => 'Producto eliminado correctamente');
            echo json_encode($response);
        } else {
            // Si no se eliminaron registros en alguna tabla, revertir la transacción
            $conexion->rollback();
            $response = array('status' => 'error', 'message' => 'Error al eliminar el producto');
            echo json_encode($response);
        }

        // Cerrar las declaraciones preparadas
        $stmtEliminarDetallesPedidos->close();
        $stmtEliminarProducto->close();

    } catch (Exception $e) {
        // Manejar cualquier excepción que pueda ocurrir
        $conexion->rollback();
        $response = array('status' => 'error', 'message' => 'Error en la transacción: ' . $e->getMessage());
        echo json_encode($response);
    }
} else {
    // Si no se pasa un ID válido, enviar una respuesta de error
    $response = array('status' => 'error', 'message' => 'ID de producto no válido');
    echo json_encode($response);
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
