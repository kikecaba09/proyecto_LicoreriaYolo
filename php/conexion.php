<?php

$host = 'localhost'; 
$usuario = 'root'; 
$contraseña = ''; 
$baseDeDatos = 'licoreriayolo'; 
$puerto = 3308; 

$conexion = new mysqli($host, $usuario, $contraseña, $baseDeDatos, $puerto);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// No cierres la conexión aquí
// echo "Conexión exitosa a la base de datos.";
?>
