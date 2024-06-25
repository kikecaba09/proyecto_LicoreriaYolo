<?php
include_once '../conexion.php';

// Consulta para obtener las categorías
$sqlCategorias = "SELECT * FROM Categoria";
$resultadoCategorias = $conexion->query($sqlCategorias);

// Consulta para obtener las ofertas
$sqlOfertas = "SELECT * FROM Oferta";
$resultadoOfertas = $conexion->query($sqlOfertas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías y Ofertas</title>
    <link rel="stylesheet" href="../../css/administrador/categoriaOfertas.css">
    <!-- Font Awesome (Asegúrate de tener la última versión de Font Awesome incluida) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1 class="titulo-principal">Categorías y Ofertas</h1>
        
        <!-- Sección de Categorías -->
        <div class="seccion">
            <h2>Categorías</h2>
            <?php if ($resultadoCategorias->num_rows > 0) { ?>
                <table class="tabla">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre de la Categoría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($categoria = $resultadoCategorias->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $categoria['idCategoria']; ?></td>
                                <td><?php echo htmlspecialchars($categoria['nombreCategoria']); ?></td>
                                <td>
                                    <a href="modificar_categoria.php?id=<?php echo $categoria['idCategoria']; ?>" class="boton"><i class="fas fa-edit"></i></a>
                                    <a href="eliminar_categoria.php?id=<?php echo $categoria['idCategoria']; ?>" class="boton eliminar" onclick="return confirm('¿Está seguro de que desea eliminar esta categoría?');"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>No hay categorías disponibles.</p>
            <?php } ?>
        </div>
        
        <!-- Sección de Ofertas -->
        <div class="seccion">
            <h2>Ofertas</h2>
            <?php if ($resultadoOfertas->num_rows > 0) { ?>
                <table class="tabla">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Motivo</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($oferta = $resultadoOfertas->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $oferta['idOferta']; ?></td>
                                <td><?php echo htmlspecialchars($oferta['motivo']); ?></td>
                                <td><?php echo $oferta['fecha_inicio']; ?></td>
                                <td><?php echo $oferta['fecha_fin'] ? $oferta['fecha_fin'] : 'Indefinida'; ?></td>
                                <td>
                                    <a href="modificar_oferta.php?id=<?php echo $oferta['idOferta']; ?>" class="boton"><i class="fas fa-edit"></i></a>
                                    <a href="eliminar_oferta.php?id=<?php echo $oferta['idOferta']; ?>" class="boton eliminar" onclick="return confirm('¿Está seguro de que desea eliminar esta oferta?');"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>No hay ofertas disponibles.</p>
            <?php } ?>
        </div>
    </div>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conexion->close();
?>
