<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías y Ofertas</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Tu archivo de estilos personalizados -->
    <link rel="stylesheet" href="../../css//administrador//categoriaOfertas.css">
</head>
<body>
    <div class="container">
        <h1 class="titulo-principal text-center">Categorías y Ofertas</h1>
        <!-- Sección de Categorías -->
        <div class="seccion">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Categorías</h2>
                <a href="agregar_categoria.php" class="btn btn-success"><i class="fas fa-plus"></i> Agregar Categoría</a>
            </div>
                <table class="table mt-3">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre de la Categoría</th>
                            <th>Descripcion</th>
                            <th>Activo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
            include '../conexion.php';

            $sql = "SELECT * FROM Categoria";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $activo = $row["activo"] == 1 ? "Sí" : "No";
                    echo "<tr>
                            <td>" . htmlspecialchars($row["idCategoria"]) . "</td>
                            <td>" . htmlspecialchars($row["nombreCategoria"]) . "</td>
                            <td>" . htmlspecialchars($row["descripcion"]) . "</td>
                            <td>" . $activo . "</td>
                            <td>
                                <a href='#' onclick='openModalEditar(" . json_encode($row) . ")' class='btn-edit'>
                                <i class='fa fa-pencil'></i></a>
                                <a href='#' onclick='eliminarProducto(" . $row["idCategoria"] . "); return false;' class='btn-delete'>
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
        
        <!-- Sección de Ofertas -->
        <div class="seccion">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Ofertas</h2>
                <a href="agregar_oferta.php" class="btn btn-success"><i class="fas fa-plus"></i> Agregar Oferta</a>
            </div>
                <table class="table mt-3">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Motivo</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
            include '../conexion.php';

            $sql = "SELECT * FROM Oferta";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row["idOferta"]) . "</td>
                            <td>" . htmlspecialchars($row["motivo"]) . "</td>
                            <td>" . htmlspecialchars($row["fecha_inicio"]) . "</td>
                            <td>" . htmlspecialchars($row["fecha_fin"]) . "</td>
                            <td>
                                <a href='#' onclick='openModalEditar(" . json_encode($row) . ")' class='btn-edit'>
                                <i class='fas fa-edit'></i></a>
                                <a href='#' onclick='eliminarProducto(" . $row["idOferta"] . "); return false;' class='btn-delete'>
                                <i class='fas fa-trash-alt'></i></a>
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

    <!-- Bootstrap JS (opcional si necesitas funcionalidades como dropdowns, modales, etc.) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
