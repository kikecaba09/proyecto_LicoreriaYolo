<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Disponibles</title>
    <link rel="stylesheet" href="../../css/administrador/productoAdmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
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
                <?php
                include '../conexion.php';

                $sql = "SELECT * FROM Producto";
                $result = $conexion->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td><img src='" . htmlspecialchars($row['imagen']) . "' alt='Imagen del Cliente'></td>
                                <td>" . htmlspecialchars($row["nombre"]) . "</td>
                                <td>" . $row["descripcion"] . "</td>
                                <td>" . htmlspecialchars($row["precio"]) . "</td>
                                <td>" . htmlspecialchars($row["cantidad_disponible"]) . "</td>
                                <td>" . htmlspecialchars($row["en_oferta"]) . "</td>
                                <td>
                                    <a href='verPedidos.php?id=" . $row["idProducto"] . "' class='btn-edit'>
                                    <i class='fa fa-pencil'></i></a>
                                    <a href='#' onclick='eliminarCliente(" . $row["idProducto"] . "); return false;' class='btn-delete'>
                                    <i class='fa fa-trash'></i></a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No hay Productos registrados</td></tr>";
                }

                $conexion->close();
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../../js/administrador/productosAdministrador.js"></script>
</body>
</html>
