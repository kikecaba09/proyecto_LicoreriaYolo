<?php
session_start();

if (!isset($_SESSION['idAdministrador']) || !isset($_SESSION['nombreAdministrador'])) {
    echo "Bienvenido";
    exit();
}

$nombreAdministrador = $_SESSION['nombreAdministrador'];
echo "¡Bienvenido, $nombreAdministrador!";
?>
