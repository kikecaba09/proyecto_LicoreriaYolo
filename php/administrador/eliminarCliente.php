<?php
// Incluir el archivo de conexión a la base de datos
include '../conexion.php';

// Verificar si el ID del cliente se ha pasado como parámetro en la URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Obtener el ID del cliente desde el parámetro de la URL
    $idCliente = intval($_GET['id']);

    // Iniciar una transacción
    $conexion->begin_transaction();

    try {
        // Eliminar registros relacionados en otras tablas (ejemplo: Pedidos y Pagos relacionados con el cliente)
        $sqlEliminarPagos = "DELETE FROM Pago WHERE idCliente = ?";
        $stmtEliminarPagos = $conexion->prepare($sqlEliminarPagos);
        $stmtEliminarPagos->bind_param('i', $idCliente);
        $stmtEliminarPagos->execute();

        // Eliminar registros relacionados en la tabla DetallePedido
        $sqlEliminarDetallePedido = "DELETE FROM DetallePedido 
                                     WHERE idPedido IN (SELECT idPedido 
                                                        FROM Pedido 
                                                        WHERE idCliente = ?)";
        $stmtEliminarDetallePedido = $conexion->prepare($sqlEliminarDetallePedido);
        $stmtEliminarDetallePedido->bind_param('i', $idCliente);
        $stmtEliminarDetallePedido->execute();
        $stmtEliminarDetallePedido->close();

        $sqlEliminarPedidos = "DELETE FROM Pedido WHERE idCliente = ?";
        $stmtEliminarPedidos = $conexion->prepare($sqlEliminarPedidos);
        $stmtEliminarPedidos->bind_param('i', $idCliente);
        $stmtEliminarPedidos->execute();

        // Preparar y ejecutar la consulta para eliminar el cliente
        $sqlEliminarCliente = "DELETE FROM Cliente WHERE idCliente = ?";
        $stmtEliminarCliente = $conexion->prepare($sqlEliminarCliente);
        $stmtEliminarCliente->bind_param('i', $idCliente);
        $stmtEliminarCliente->execute();

        // Comprobar si se eliminaron registros en todas las tablas
        if ($stmtEliminarPagos->affected_rows > 0 && $stmtEliminarPedidos->affected_rows > 0 && $stmtEliminarCliente->affected_rows > 0) {
            // Confirmar la transacción si todas las operaciones fueron exitosas
            $conexion->commit();
            // Redirigir a la lista de clientes después de la eliminación exitosa
            header('Location: cliente.php'); // Asegúrate de reemplazar el path con el correcto
            exit();
        } else {
            // Si no se eliminaron registros en alguna tabla, revertir la transacción
            $conexion->rollback();
            echo "Error: No se pudieron eliminar todos los registros relacionados.";
        }

        // Cerrar las declaraciones preparadas
        $stmtEliminarPagos->close();
        $stmtEliminarPedidos->close();
        $stmtEliminarCliente->close();

    } catch (Exception $e) {
        // Manejar cualquier excepción que pueda ocurrir
        $conexion->rollback();
        echo "Error: " . $e->getMessage();
    }
} else {
    // Si no se pasa un ID, redirigir a la lista de clientes
    header('Location: ../path/to/your/cliente.php'); // Asegúrate de reemplazar el path con el correcto
    exit();
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
