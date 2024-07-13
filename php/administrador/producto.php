<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Disponibles</title>
    <link rel="stylesheet" href="../../css/administrador/productoAdmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../../css/producto/editarModal.css"> <!-- Enlace al archivo CSS de la ventana modal -->
    <style>
                .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #f0f0f0;
            border-bottom: 1px solid #ccc;
        }

        .container h2 {
            margin: 0; /* Elimina el margen predeterminado del h2 */
            flex: 1; /* Ocupa el espacio restante */
        }

        .btn-agregar {
            background-color: #4CAF50; /* Color de fondo */
            color: white; /* Color del texto */
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-left: 10px; /* Espacio entre el título y el botón */
            cursor: pointer;
            border-radius: 5px; /* Bordes redondeados */
            transition: background-color 0.3s ease; /* Transición suave del color de fondo */
        }

        .btn-agregar:hover {
            background-color: #45a049; /* Color de fondo al pasar el mouse */
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../js/Productos/eliminarProducto.js"></script>
</head>
<body>
    <div class="container">
        <h2>Productos Disponibles</h2>
        <button onclick="openModalAgregar()" class="btn-agregar">Agregar Producto</button>
    </div>
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
                            <td><img src='" . htmlspecialchars($row['imagen']) . "' alt='Imagen del Producto'></td>
                            <td>" . htmlspecialchars($row["nombre"]) . "</td>
                            <td>" . htmlspecialchars($row["descripcion"]) . "</td>
                            <td>" . htmlspecialchars($row["precio"]) . "</td>
                            <td>" . htmlspecialchars($row["cantidad_disponible"]) . "</td>
                            <td>" . $enOferta . "</td>
                            <td>
                                <a href='#' onclick='openModalEditar(" . json_encode($row) . ")' class='btn-edit'>
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

    <!-- Ventana Modal de Editar Producto -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModalEditar()">&times;</span>
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

    <!-- Ventana Modal de Agregar Producto -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModalAgregar()">&times;</span>
        <h2>Agregar Producto</h2>
        <div class="form-container">
            <div class="column">
                <form id="addForm" action="procesar_producto.php" method="POST" enctype="multipart/form-data">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required><br><br>
                    
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion"></textarea><br><br>
                    
                    <label for="precio">Precio:</label>
                    <input type="text" id="precio" name="precio" required><br><br>
                    
                    <label for="cantidad_disponible">Cantidad Disponible:</label>
                    <input type="text" id="cantidad_disponible" name="cantidad_disponible" required><br><br>
                    
                    <label for="en_oferta">En Oferta:</label>
                    <select id="en_oferta" name="en_oferta">
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select><br><br>
                </div>
                <div class="column">
                    <label for="imagen">Imagen:</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*" required><br><br>
                    
                    <label for="idCategoria">Categoría:</label>
                    <select id="idCategoria" name="idCategoria">
                        <!-- Options will be dynamically loaded via PHP -->
                        <?php
                        include '../conexion.php';
                        
                        $sqlCategorias = "SELECT idCategoria, nombreCategoria FROM Categoria";
                        $resultCategorias = $conexion->query($sqlCategorias);
                        
                        if ($resultCategorias->num_rows > 0) {
                            while($rowCategoria = $resultCategorias->fetch_assoc()) {
                                echo "<option value='" . $rowCategoria['idCategoria'] . "'>" . $rowCategoria['nombreCategoria'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay categorías disponibles</option>";
                        }
                        
                        $conexion->close();
                        ?>
                    </select><br><br>
                    
                    <label for="idOferta">Oferta:</label>
                    <select id="idOferta" name="idOferta">
                        <!-- Options will be dynamically loaded via PHP -->
                        <?php
                        include '../conexion.php';
                        
                        $sqlOfertas = "SELECT idOferta, motivo FROM Oferta";
                        $resultOfertas = $conexion->query($sqlOfertas);
                        
                        if ($resultOfertas->num_rows > 0) {
                            while($rowOferta = $resultOfertas->fetch_assoc()) {
                                echo "<option value='" . $rowOferta['idOferta'] . "'>" . $rowOferta['motivo'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay ofertas disponibles</option>";
                        }
                        
                        $conexion->close();
                        ?>
                    </select><br><br>
                    
                    <label for="idDescuento">Descuento:</label>
                    <select id="idDescuento" name="idDescuento">
                        <!-- Options will be dynamically loaded via PHP -->
                        <?php
                        include '../conexion.php';
                        
                        $sqlDescuentos = "SELECT idDescuento, porcentaje FROM Descuento";
                        $resultDescuentos = $conexion->query($sqlDescuentos);
                        
                        if ($resultDescuentos->num_rows > 0) {
                            while($rowDescuento = $resultDescuentos->fetch_assoc()) {
                                echo "<option value='" . $rowDescuento['idDescuento'] . "'>" . $rowDescuento['porcentaje'] . "% de descuento</option>";
                            }
                        } else {
                            echo "<option value=''>No hay descuentos disponibles</option>";
                        }
                        
                        $conexion->close();
                        ?>
                    </select><br><br>
                    
                    <button type="submit">Agregar Producto</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function closeModalAgregar() {
        document.getElementById('addModal').style.display = 'none';
    }
</script>


    <script>
        // JavaScript para manejar la apertura y cierre de la ventana modal de editar
        function openModalEditar(producto) {
            document.getElementById('idProducto').value = producto.idProducto;
            document.getElementById('nombre').value = producto.nombre;
            document.getElementById('descripcion').value = producto.descripcion;
            document.getElementById('precio').value = producto.precio;
            document.getElementById('cantidad_disponible').value = producto.cantidad_disponible;
            document.getElementById('en_oferta').value = producto.en_oferta;
            document.getElementById('editModal').style.display = 'block';
        }

        function closeModalEditar() {
            document.getElementById('editModal').style.display = 'none';
        }

        // JavaScript para manejar la apertura y cierre de la ventana modal de agregar
        function openModalAgregar() {
            document.getElementById('addModal').style.display = 'block';
        }

        function closeModalAgregar() {
            document.getElementById('addModal').style.display = 'none';
        }

        // Cierra las ventanas modales si el usuario hace clic fuera de ellas
        window.onclick = function(event) {
            var editModal = document.getElementById('editModal');
            var addModal = document.getElementById('addModal');
            if (event.target == editModal) {
                editModal.style.display = 'none';
            }
            if (event.target == addModal) {
                addModal.style.display = 'none';
            }
        }
    </script>
</body>
</html>
