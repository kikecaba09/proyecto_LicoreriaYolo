<?php
session_start();

if (!isset($_SESSION['idCliente']) || !isset($_SESSION['nombreCliente'])) {
    echo "Bienvenido";
    exit();
}

$nombreCliente = $_SESSION['nombreCliente'];
echo "¡Bienvenido, $nombreCliente!";
?>
