<?php

include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica que todos los campos necesarios estén presentes
    $nombreCompleto = trim($_POST['nombreCompleto'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $direccion = trim($_POST['direccion'] ?? '');
    $producto = trim($_POST['producto'] ?? '');
    $cantidad = trim($_POST['cantidad'] ?? '');
    $metodoPago = trim($_POST['metodoPago'] ?? '');
    $comentario = trim($_POST['comentario'] ?? '');

    if ($nombreCompleto && $telefono && $direccion && $producto && $cantidad && $metodoPago && $comentario) {
        // Obtener fecha y hora actual en formato MySQL
        $fechaHora = date("Y-m-d H:i:s");

        // Prepara la consulta para evitar inyección SQL
        $stmt = $conexion->prepare("INSERT INTO pedido (nombreCompleto, telefono, direccion, producto, cantidad, metodoPago, comentario, fechaHora) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        if ($stmt === false) {
            echo '<h3 class="error">Error al preparar la consulta: ' . $conexion->error . '</h3>';
        } else {
            $stmt->bind_param("ssssisss", $nombreCompleto, $telefono, $direccion, $producto, $cantidad, $metodoPago, $comentario, $fechaHora);
            
            if ($stmt->execute()) {
                echo '<h3 class="success">Tu pedido se ha completado</h3>';
            } else {
                echo '<h3 class="error">Ocurrió un error en el registro: ' . $stmt->error . '</h3>';
            }
            
            $stmt->close();
        }
    } else {
        echo '<h3 class="error">Llena todos los campos</h3>';
    }
} else {
    echo '<h3 class="error">Método de solicitud no válido</h3>';
}

$conexion->close();
?>
