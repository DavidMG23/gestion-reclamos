<?php
    require ('../../admin/conexion.php');
    $dato="UPDATE bd_chimbas SET estado='$_POST[nuevoEstado]' WHERE id=$_REQUEST[Nreclamo]";
    mysqli_query($conexion, $dato);

    header('Location:recepcion.php');
    ?> 