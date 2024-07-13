<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Disponibles</title>
    <link rel="stylesheet" href="../../css/administrador/productoAdmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../../css/producto//editarModal.css"> <!-- Enlace al archivo CSS de la ventana modal -->
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
                        $enOferta = $row["en_oferta"] == 1 ? "Sí" : "No";
                        echo "<tr>
                                <td><img src='" . htmlspecialchars($row['imagen']) . "' alt='Imagen del Cliente'></td>
                                <td>" . htmlspecialchars($row["nombre"]) . "</td>
                                <td>" . htmlspecialchars($row["descripcion"]) . "</td>
                                <td>" . htmlspecialchars($row["precio"]) . "</td>
                                <td>" . htmlspecialchars($row["cantidad_disponible"]) . "</td>
                                <td>" . $enOferta . "</td>
                                <td>
                                    <a href='#' onclick='openModal(" . json_encode($row) . ")' class='btn-edit'>
                                    <i class='fa fa-pencil'></i></a>
                                    <a href='#' onclick='eliminarProducto(" . $row["idProducto"] . "); return false;' class='btn-delete'>
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

    <!-- Ventana Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Editar Producto</h2>
            <form id="editForm" action="actualizarProducto.php" method="POST">
                <input type="hidden" id="idProducto" name="idProducto">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre"><br><br>
                <label for="descripcion">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion"><br><br>
                <label for="precio">Precio:</label>
                <input type="text" id="precio" name="precio"><br><br>
                <label for="cantidad_disponible">Cantidad Disponible:</label>
                <input type="text" id="cantidad_disponible" name="cantidad_disponible"><br><br>
                <label for="en_oferta">En Oferta:</label>
                <select id="en_oferta" name="en_oferta">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select><br><br>
                <button type="submit">Guardar Cambios</button>
            </form>
        </div>
    </div>

    <script>
        // JavaScript para manejar la apertura y cierre de la ventana modal
        function openModal(producto) {
            document.getElementById('idProducto').value = producto.idProducto;
            document.getElementById('nombre').value = producto.nombre;
            document.getElementById('descripcion').value = producto.descripcion;
            document.getElementById('precio').value = producto.precio;
            document.getElementById('cantidad_disponible').value = producto.cantidad_disponible;
            document.getElementById('en_oferta').value = producto.en_oferta;
            document.getElementById('editModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        // Cierra la ventana modal si el usuario hace clic fuera de ella
        window.onclick = function(event) {
            var modal = document.getElementById('editModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>
</html>
