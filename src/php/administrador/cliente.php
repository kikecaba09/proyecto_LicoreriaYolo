<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes Registrados</title>
    <link rel="stylesheet" href="../../css/administrador/clientesAdministrador.css">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
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
                    session_start();
                    include '../conexion.php';

                    // Verificar si el administrador está autenticado
                    if (!isset($_SESSION['idAdministrador'])) {
                        echo "<tr><td colspan='8'>No tienes permiso para acceder a esta información.</td></tr>";
                    } else {
                        // Consulta SQL para seleccionar todos los clientes
                        $sql = "SELECT * FROM Cliente";
                        $resultado = $conexion->query($sql);

                        // Comprobar si hay resultados
                        if ($resultado->num_rows > 0) {
                            while ($fila = $resultado->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td><img src='" . htmlspecialchars($fila['imagen']) . "' alt='Imagen del Cliente'></td>";
                                echo "<td>" . htmlspecialchars($fila['nombreCliente']) . "</td>";
                                echo "<td>" . $fila['edad'] . "</td>";
                                echo "<td>" . htmlspecialchars($fila['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($fila['telefono']) . "</td>";
                                echo "<td>" . htmlspecialchars($fila['direccion']) . "</td>";
                                echo "<td>" . $fila['fechaRegistro'] . "</td>";
                                echo "<td>";
                                echo "<button onclick='eliminarCliente(" . $fila['idCliente'] . ")'>Eliminar</button>";
                                echo "<button onclick='verPedidos(" . $fila['idCliente'] . ")'>Ver Pedidos</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>No se encontraron clientes registrados.</td></tr>";
                        }
                    }

                    // Cerrar la conexión
                    $conexion->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- JavaScript personalizado -->
    <script src="../../js/administrador/cliente.js"></script>
</body>
</html>
