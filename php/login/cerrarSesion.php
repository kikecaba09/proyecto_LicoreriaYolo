<?php
header('Content-Type: application/json');

// Iniciar la sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Finalizar la sesión
session_unset();
session_destroy();

// Devolver respuesta JSON indicando éxito
echo json_encode([
    'success' => true,
    'message' => 'Sesión cerrada correctamente'
]);
?>
