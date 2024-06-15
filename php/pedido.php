<?php
include("conexion.php");

if(isset($_POST['registroPedido'])){
    if(
        strlen($_POST['nombreCompleto'])>=1 &&
        strlen($_POST['telefono'])>=1 &&
        strlen($_POST['direccion'])>=1 &&
        strlen($_POST['producto'])>=1 &&
        strlen($_POST['cantidad'])>=1 &&
        strlen($_POST['metodoPago'])>=1 &&
        strlen($_POST['comentario'])>=1 
    ){
        $nombreCompleto = trim($_POST['nombreCompleto']);
        $telefono = trim($_POST['telefono']);
        $direccion = trim($_POST['direccion']);
        $producto = trim($_POST['producto']);
        $cantidad = trim($_POST['cantidad']);
        $metodoPago = trim($_POST['metodoPago']);
        $comentario = trim($_POST['comentario']);
        $fecha = date("d/m/y");

        
    }
    
}
?>