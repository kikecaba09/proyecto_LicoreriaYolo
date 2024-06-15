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

        $consulta = "INSERT INTO pedido(nombreCompleto,telefono,direccion,producto,cantidad,metodoPago,
        comentario) VALUE ('$nombreCompleto','$telefono','$direccion','$producto','$cantidad',
        '$metodoPago','$comentario')";
        $resultado = mysqli_connect($conexion, $consulta);

        if($resultado){
            ?>
            <h3 class="success">Tu pedido se a completado</h3>
            <?php
        }else{
            ?>
            <h3 class="error">Ocurrio un error en el registro</h3>
            <?php
        }
    }else{
        ?>
        <h3 class="error">Llena todos los campos</h3>
        <?php
    }
}
?>