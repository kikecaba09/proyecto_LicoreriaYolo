<?php
// Establecer conexión a la base de datos (usando tus datos de conexión)
include '../conexion.php'; // Asegúrate de tener un archivo 'conexion.php' que conecte a tu base de datos

session_start(); // Iniciar sesión (asegúrate de haber iniciado sesión correctamente antes de llegar aquí)

$totalAPagar = 0.0; // Variable para almacenar el total a pagar
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos del Cliente</title>
    <!-- Incluir FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Estilos generales */
        /* Estilos adicionales para mejorar la apariencia general */

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Fuente alternativa para una apariencia limpia */
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
    color: #333; /* Color de texto principal */
}

.container {
    max-width: 85%;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Estilos para la tabla principal de pedidos */
.pedido-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.pedido-table th, .pedido-table td {
    padding: 12px;
    text-align: center;
    border: 1px solid #ddd;
}

.pedido-table th {
    background-color: #f2f2f2;
    font-weight: bold;
    text-transform: uppercase;
}

/* Estilos para la tabla de detalles de pedido */
.detalle-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.detalle-table th, .detalle-table td {
    padding: 10px;
    text-align: center;
    border: 1px solid #ddd;
}

.detalle-table th {
    background-color: #f2f2f2;
    font-weight: bold;
}

/* Estilos para los iconos de acción */
/* Estilos para los iconos de acción */
.icon {
    font-size: 18px;
    cursor: pointer;
    margin-left: 10px; /* Espacio a la izquierda de cada icono */
    color: #007bff; /* Color azul para los iconos */
    transition: color 0.3s ease;
}

.icon + .icon {
    margin-left: 20px; /* Espacio adicional entre iconos */
}

.icon:hover {
    color: #0056b3; /* Cambio de color al pasar el mouse */
}

/* Estilos para el botón de cancelar pedido */
.btn-cancelar {
    background-color: #dc3545; /* Color rojo */
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    align-items: center;
    transition: background-color 0.3s ease;
    display: block; /* Mostrar como bloque para ocupar toda la anchura de la celda */
    margin-top: 10px; /* Espacio superior */
}

.btn-cancelar:hover {
    background-color: #c82333; /* Cambio de color al pasar el mouse */
}



/* Estilos para los enlaces */
.action-link {
    text-decoration: none;
}

.action-link:hover {
    text-decoration: underline; /* Subrayado al pasar el mouse */
}

/* Estilos para el total a pagar */
.total-pagar {
    margin-top: 20px;
    text-align: right;
    font-size: 1.2em;
}

/* Estilos para títulos */
h2 {
    color: #007bff; /* Color azul primario */
    margin-bottom: 20px;
}

h3 {
    color: #0056b3; /* Tono azul más oscuro para los subtítulos */
    margin-top: 20px;
}

/* Estilos para el footer */
.footer {
    text-align: center;
    margin-top: 20px;
    padding: 10px;
    background-color: #f2f2f2;
    border-top: 1px solid #ddd;
    clear: both;
}

    </style>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_SESSION['idCliente'])) {
            $idCliente = $_SESSION['idCliente'];

            // Consulta para obtener los pedidos del cliente actual
            $query_pedidos = "SELECT idPedido, fecha_pedido, fecha_entrega, estado FROM Pedido WHERE idCliente = $idCliente";
            $result_pedidos = mysqli_query($conexion, $query_pedidos);

            if (mysqli_num_rows($result_pedidos) > 0) {
                echo "<h2>Pedidos del Cliente</h2>";

                while ($row_pedido = mysqli_fetch_assoc($result_pedidos)) {
                    $idPedido = $row_pedido['idPedido'];
                    $fecha_pedido = $row_pedido['fecha_pedido'];
                    $fecha_entrega = $row_pedido['fecha_entrega'];
                    $estado = $row_pedido['estado'];

                    echo "<h3>Pedido ID: $idPedido</h3>";
                    echo "<table class='pedido-table'>";
                    echo "<tr><th>ID Pedido</th><th>Fecha Pedido</th><th>Fecha Entrega</th><th>Estado</th><th>Acciones</th></tr>";
                    echo "<tr>";
                    echo "<td>$idPedido</td>";
                    echo "<td>$fecha_pedido</td>";
                    echo "<td>$fecha_entrega</td>";
                    echo "<td>$estado</td>";
                    echo "<td>";
                    echo "<a href='#' class='action-link'><i class='fas fa-edit icon' title='Modificar'></i></a>"; // Icono de editar
                    echo "<a href='#' class='action-link'><i class='fas fa-trash-alt icon' title='Eliminar'></i></a>"; // Icono de eliminar
                    echo "<button class='btn-cancelar' title='Cancelar Pedido'><i class='fas fa-times'></i> Cancelar</button>"; // Botón de cancelar pedido
                    echo "</td>";
                    echo "</tr>";
                    echo "</table>";

                    // Consulta para obtener los detalles de cada pedido
                    $query_detalles = "SELECT p.idProducto, p.nombre AS nombre_producto, dp.cantidad, dp.subtotal 
                                       FROM DetallePedido dp 
                                       INNER JOIN Producto p ON dp.idProducto = p.idProducto
                                       WHERE dp.idPedido = $idPedido";
                    $result_detalles = mysqli_query($conexion, $query_detalles);

                    if (mysqli_num_rows($result_detalles) > 0) {
                        echo "<h4>Detalles del Pedido ID: $idPedido</h4>";
                        echo "<table class='detalle-table'>";
                        echo "<tr><th>ID Producto</th><th>Nombre Producto</th><th>Cantidad</th><th>Subtotal</th></tr>";

                        while ($row_detalle = mysqli_fetch_assoc($result_detalles)) {
                            $idProducto = $row_detalle['idProducto'];
                            $nombreProducto = $row_detalle['nombre_producto'];
                            $cantidad = $row_detalle['cantidad'];
                            $subtotal = $row_detalle['subtotal'];

                            // Sumar al total a pagar
                            $totalAPagar += $subtotal;

                            echo "<tr>";
                            echo "<td>$idProducto</td>";
                            echo "<td>$nombreProducto</td>";
                            echo "<td>$cantidad</td>";
                            echo "<td>$subtotal</td>";
                            echo "</tr>";
                        }

                        echo "</table>";
                    } else {
                        echo "<p>No hay detalles disponibles para este pedido.</p>";
                    }
                }

                // Mostrar el total a pagar al final
                echo "<div class='total-pagar'><strong>Total a Pagar:</strong> $totalAPagar</div>";
            } else {
                echo "<p>No se encontraron pedidos para este cliente.</p>";
            }

        } else {
            echo "<p>Cliente no identificado.</p>";
        }

        mysqli_close($conexion);
        ?>
    </div>
</body>
</html>
