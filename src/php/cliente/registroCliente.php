<?php
// Incluir el archivo de conexión
require 'c../'; // Asegúrate de que el archivo conexion.php esté en la misma carpeta o ajusta la ruta

// Obtener datos del formulario
$nombreCliente = $_POST['nombreCliente'];
$edad = isset($_POST['edad']) ? (int)$_POST['edad'] : NULL;
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$usuario = $_POST['usuario'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

// Ruta de la carpeta de imágenes
$target_dir = "../../img/Clientes/";

// Verificar si la carpeta existe, si no, crearla
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Manejar la subida de la imagen
$imagen = "";
if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
    $imagen_nombre = basename($_FILES["imagen"]["name"]);
    $imagen_ruta = $target_dir . $imagen_nombre;

    // Verificar si el archivo es una imagen
    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $imagen_ruta)) {
            $imagen = $imagen_ruta; // Guardar la ruta relativa de la imagen
        } else {
            echo "Error al subir la imagen.";
            exit;
        }
    } else {
        echo "El archivo no es una imagen.";
        exit;
    }
}

// Insertar datos en la base de datos
$sql = "INSERT INTO Cliente (nombreCliente, edad, email, telefono, direccion, imagen, usuario, contrasena)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("sissssss", $nombreCliente, $edad, $email, $telefono, $direccion, $imagen, $usuario, $contrasena);

if ($stmt->execute()) {
    echo "Nuevo registro creado con éxito";
    // Redirigir a una página de éxito o mostrar un mensaje
    // header("Location: success.php");
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

$stmt->close();
$conexion->close();
?>
