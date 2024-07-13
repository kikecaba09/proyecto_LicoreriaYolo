<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes Registrados</title>
    <link rel="stylesheet" href="../../css/administrador/clientesAdministrador.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function eliminarCliente(idCliente) {
            console.log('Intentando eliminar cliente con ID:', idCliente); // Verificar que la función se está llamando correctamente
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar cliente'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Petición AJAX para eliminar el cliente
                    $.ajax({
                        url: '../../php/administrador/eliminarCliente.php',
                        type: 'POST',
                        dataType: 'json',
                        data: { idCliente: idCliente },
                        success: function (response) {
                            console.log(response); // Verificar la respuesta del servidor
                            if (response.status === 'success') {
                                Swal.fire({
                                    title: 'Cliente eliminado',
                                    text: response.message,
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(function () {
                                    // Recargar la página después de eliminar el cliente
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: response.message,
                                    icon: 'error',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Error en la solicitud AJAX:', error); // Verificar errores en la solicitud AJAX
                            Swal.fire({
                                title: 'Error',
                                text: 'Se produjo un error al eliminar el cliente.',
                                icon: 'error',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    });
                }
            });
        }
    </script>
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
                                    <a href='verPedidos.php?id=" . $row["idCliente"] . "' class='btn-edit'>Ver Pedidos</a>
                                    <a href='#' onclick='eliminarCliente(" . $row["idCliente"] . "); return false;' class='btn-delete'>Eliminar</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No hay clientes registrados</td></tr>";
                }

                $conexion->close();
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
