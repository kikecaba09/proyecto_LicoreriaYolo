<?php

$nombredelservidor = "localhost:8080";
$nombredeusuario = "root";
$contrasena = "";
$basededatos = "licoreriayolo";

$conn = new mysqli($nombredelservidor, $nombredeusuario, $contrasena, $basededatos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}else{
    die("Conexion exitosa");
}
?>
