<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes Registrados</title>
    <link rel="stylesheet" href="../../css/administrador/clientesAdministrador.css">
</head>
<body>
    <div class="container">
        <h2>Clientes Registrados</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Edad</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Fecha de Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
            include '../conexion.php';

            $sql = "SELECT * FROM Cliente";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td><img src='" . htmlspecialchars($row['imagen']) . "' alt='Imagen del Cliente'></td>
<td>" . htmlspecialchars($row["nombreCliente"]) . "</td>
<td>" . $row["edad"] . "</td>
<td>" . htmlspecialchars($row["email"]) . "</td>
<td>" . htmlspecialchars($row["telefono"]) . "</td>
<td>" . htmlspecialchars($row["direccion"]) . "</td>
<td>" . $row["fechaRegistro"] . "</td>

                            <td>
                                <a href='verPedidos.php?id=" . $row["idCliente"] . "' class='btn-edit'>VerPedidos</a>
                                <a href='eliminarCliente.php?id=" . $row["idCliente"] . "' class='btn-delete'>Eliminar</a>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No hay personal registrado</td></tr>";
            }

            $conexion->close();
            ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
