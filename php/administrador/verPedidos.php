<?php
// Incluir el archivo de conexión a la base de datos
include '../conexion.php';

// Verificar si se ha pasado el ID del cliente como parámetro en la URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Obtener el ID del cliente desde el parámetro de la URL
    $idCliente = intval($_GET['id']);

    // Consulta SQL para seleccionar todos los pedidos del cliente con sus detalles
    $sqlPedidos = "SELECT p.idPedido, p.fecha_pedido, p.fecha_entrega, p.estado, 
                          dp.idDetallePedido, dp.idProducto, dp.cantidad, dp.subtotal,
                          pr.nombre AS nombreProducto, pr.precio AS precioProducto
                   FROM Pedido p
                   INNER JOIN DetallePedido dp ON p.idPedido = dp.idPedido
                   INNER JOIN Producto pr ON dp.idProducto = pr.idProducto
                   WHERE p.idCliente = ?";
    $stmtPedidos = $conexion->prepare($sqlPedidos);
    $stmtPedidos->bind_param('i', $idCliente);
    $stmtPedidos->execute();
    $resultPedidos = $stmtPedidos->get_result();

    // Verificar si existen pedidos para este cliente
    if ($resultPedidos->num_rows > 0) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pedidos del Cliente</title>
    <link rel="stylesheet" href="../../css/pedido//clientePedidos.css">
</head>
<body>
    <div class="container">
        <h2>Lista de Pedidos del Cliente</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Fecha de Pedido</th>
                        <th>Fecha de Entrega</th>
                        <th>Estado</th>
                        <th>Nombre del Producto</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $totalSubtotales = 0;
                    $pedidoActual = null;
                    while ($row = $resultPedidos->fetch_assoc()) {
                        if ($pedidoActual === null || $pedidoActual['idPedido'] !== $row['idPedido']) {
                            // Mostrar la fila del pedido
                            if ($pedidoActual !== null) {
                                // Mostrar el total de subtotales del pedido anterior
                                echo "<tr><td colspan='7'>Total Subtotales:</td><td>$totalSubtotales</td></tr>";
                            }
                            // Iniciar nuevo pedido
                            $pedidoActual = $row;
                            $totalSubtotales = 0;
                            echo "<tr>
                                    <td>{$pedidoActual['fecha_pedido']}</td>
                                    <td>{$pedidoActual['fecha_entrega']}</td>
                                    <td>{$pedidoActual['estado']}</td>
                                    <td>{$row['nombreProducto']}</td>
                                    <td>{$row['cantidad']}</td>
                                    <td>{$row['subtotal']}</td>
                                </tr>";
                        } else {
                            // Mostrar detalles adicionales del mismo pedido
                            echo "<tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{$row['idDetallePedido']}</td>
                                    <td>{$row['nombreProducto']}</td>
                                    <td>{$row['cantidad']}</td>
                                    <td>{$row['subtotal']}</td>
                                  </tr>";
                        }
                        $totalSubtotales += $row['subtotal'];
                    }
                    // Mostrar el total de subtotales del último pedido
                    if ($pedidoActual !== null) {
                        echo "<tr><td colspan='7'>Total Subtotales:</td><td>$totalSubtotales</td></tr>";
                    }

                    // Calcular y mostrar la suma total de todos los subtotales de pedidos
                    $sqlSumaTotal = "SELECT SUM(dp.subtotal) AS suma_total
                                     FROM Pedido p
                                     INNER JOIN DetallePedido dp ON p.idPedido = dp.idPedido
                                     WHERE p.idCliente = ?";
                    $stmtSumaTotal = $conexion->prepare($sqlSumaTotal);
                    $stmtSumaTotal->bind_param('i', $idCliente);
                    $stmtSumaTotal->execute();
                    $resultSumaTotal = $stmtSumaTotal->get_result();
                    $filaSumaTotal = $resultSumaTotal->fetch_assoc();
                    $sumaTotal = $filaSumaTotal['suma_total'];
                    echo "<tr><td colspan='7'>Suma Total de Pedidos:</td><td>$sumaTotal</td></tr>";

                    // Cerrar la consulta de suma total
                    $stmtSumaTotal->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php
    } else {
        echo "<p>No se encontraron pedidos registrados para este cliente.</p>";
    }

    // Cerrar la consulta y la conexión a la base de datos
    $stmtPedidos->close();
    $conexion->close();

} else {
    // Si no se pasa un ID de cliente válido, redirigir a la página anterior
    header('Location: clientesRegistrados.php'); // Asegúrate de reemplazar con la ruta correcta
    exit();
}
?>
