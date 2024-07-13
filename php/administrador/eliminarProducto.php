<?php
// Verifica si se ha enviado un ID de producto válido
if (isset($_GET['id'])) {
    // Conecta a la base de datos (asegúrate de incluir tu archivo de conexión adecuadamente)
    include '../conexion.php';

    // Escapa el ID del producto para evitar inyecciones SQL
    $idProducto = mysqli_real_escape_string($conexion, $_GET['id']);

    // Inicia una transacción para asegurar la integridad de los datos
    mysqli_autocommit($conexion, false);
    $error = false;

    // Elimina el producto de la tabla Producto
    $sqlProducto = "DELETE FROM Producto WHERE idProducto = '$idProducto'";
    if (!$conexion->query($sqlProducto)) {
        $error = true;
    }

    // Elimina los registros relacionados en DetallePedido si existen
    $sqlDetallePedido = "DELETE FROM DetallePedido WHERE idProducto = '$idProducto'";
    if (!$conexion->query($sqlDetallePedido)) {
        $error = true;
    }

    // Verifica si ocurrió algún error durante las eliminaciones
    if ($error) {
        mysqli_rollback($conexion); // Revierte la transacción si hubo algún error
        echo "Error al eliminar el producto y sus registros relacionados.";
    } else {
        mysqli_commit($conexion); // Confirma la transacción si todo fue exitoso
        header('Location: productos.php'); // Redirige a la página de productos después de eliminar
        exit;
    }

    // Cierra la conexión a la base de datos
    $conexion->close();
} else {
    // Manejo si no se proporcionó un ID válido
    echo "ID de producto no especificado.";
}
?>
