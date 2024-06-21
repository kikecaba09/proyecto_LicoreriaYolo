<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo json_encode(['error' => 'Usuario no autenticado.']);
    exit();
}

$adminInfo = [
    'nombreAdministrador' => $_SESSION['nombreAdministrador'],
    'edad' => $_SESSION['edad'],
    'telefono' => $_SESSION['telefono'],
    'direccion' => $_SESSION['direccion'],
    'email' => $_SESSION['email'],
    'rol' => $_SESSION['rol'],
    'imagen' => $_SESSION['imagen']
];

echo json_encode($adminInfo);
?>
