<?php

$host = 'localhost'; 
$usuario = 'root'; 
$contraseña = ''; 
$baseDeDatos = 'licoreriayolo'; 
$puerto = 3308; 

// Crear conexión
$conexion = new mysqli($host, $usuario, $contraseña, $baseDeDatos, $puerto);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
} else {
    echo "Conexión exitosa a la base de datos.";
}

// No cierres la conexión aquí, ya que todavía puedes necesitarla para ejecutar consultas
?>
