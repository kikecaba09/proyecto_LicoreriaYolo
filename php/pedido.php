<?php

$nombredelservidor = "localhost:8080";
$nombredeusuario = "root";
$contrasena = "";
$basededatos = "licoreriayolo";

$conn = new mysqli($nombredelservidor, $nombredeusuario, $contrasena, $basededatos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];
    $producto = $_POST["producto"];
    $cantidad = $_POST["cantidad"];
    $metodoPago = $_POST["metodoPago"];
    $comentario = $_POST["comentario"];

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO registropedido (nombre, telefono, direccion, producto, cantidad, metodoPago, comentario)
    VALUES ('$nombre', '$telefono', '$direccion', '$producto', '$cantidad', '$metodoPago', '$comentario')";

    if ($conn->query($sql) === TRUE) {
        echo "Pedido realizado con éxito.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
