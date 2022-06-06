<?php
    require ('../../admin/conexion.php');
    $dato="UPDATE bd_sl SET estado='$_POST[nuevoEstado]' WHERE id=$_REQUEST[Nreclamo]";
    mysqli_query($conexion, $dato);

    header('Location:recepcion.php');
    ?> 