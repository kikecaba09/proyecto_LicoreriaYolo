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

    }
    
}
?>