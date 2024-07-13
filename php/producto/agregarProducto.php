<?php
include '../conexion.php';

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$cantidad_disponible = $_POST['cantidad_disponible'];
$en_oferta = $_POST['en_oferta'];
$idCategoria = $_POST['idCategoria'];
$idOferta = $_POST['idOferta'];
$idDescuento = $_POST['descuento'];

// Manejar la imagen subida
$imagen = $_FILES['imagen'];
$nombre_imagen = $imagen['name'];
$tipo_imagen = $imagen['type'];
$tamano_imagen = $imagen['size'];
$ruta_temporal = $imagen['tmp_name'];

// Obtener la extensión del archivo
$extension = pathinfo($nombre_imagen, PATHINFO_EXTENSION);

// Definir la carpeta de destino según la categoría seleccionada
if ($idCategoria == 1) { // Cervezas
    $carpeta_destino = "../../img/Cervezas/";
} elseif ($idCategoria == 2) { // Vinos
    $carpeta_destino = "../../img/Vinos/";
} else { // Otros
    $carpeta_destino = "../../img/Otros/";
}

// Nombre de archivo único
$nombre_archivo = uniqid('producto_') . '.' . $extension;

// Ruta completa del archivo
$ruta_destino = $carpeta_destino . $nombre_archivo;

// Mover la imagen a la carpeta de destino
if (move_uploaded_file($ruta_temporal, $ruta_destino)) {
    // Insertar los datos en la base de datos
    $sql = "INSERT INTO Producto (nombre, descripcion, precio, cantidad_disponible, en_oferta, idCategoria, idOferta, descuento, imagen)
            VALUES ('$nombre', '$descripcion', '$precio', '$cantidad_disponible', '$en_oferta', '$idCategoria', '$idOferta', '$idDescuento', '$ruta_destino')";

    if ($conexion->query($sql) === TRUE) {
        echo "Producto agregado correctamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
} else {
    echo "Error al subir la imagen.";
}

$conexion->close();
?>
