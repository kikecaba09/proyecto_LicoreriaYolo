<?php
include('../conexion.php'); // Asegúrate de que la ruta es correcta

if (isset($_POST['id']) && isset($_POST['cantidad'])) {
    $id = $_POST['id'];
    $cantidad = $_POST['cantidad'];

    // Actualizar la cantidad disponible en la base de datos
    $sql = "UPDATE Producto SET cantidad = cantidad_disponible - ? WHERE idProducto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $cantidad, $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al actualizar la cantidad."]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Datos incompletos."]);
}
?>
