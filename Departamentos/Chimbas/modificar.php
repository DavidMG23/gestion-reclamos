<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/estilosRecepcion.css">
    <title>Modificar estado del reclamo</title>
</head>
<body>
    <?php
        require ('../../admin/conexion.php');
        $dato="SELECT id,reclamo,estado FROM bd_chimbas WHERE id=$_REQUEST[Nreclamo]";
        $registro=mysqli_query($conexion, $dato);

        if($mostrar=$registro->fetch_array())
        {
            ?>
            <div class="cuadro">
            <p>N° de Reclamo: <?php echo $mostrar['id']; ?></p> 
            <!-- <p>Departamento: <?php echo $mostrar['departamento']; ?></p> -->
            <p>Reclamo: <?php echo $mostrar['reclamo']; ?></P>
            <p>Estado actual: <?php echo $mostrar['estado']; ?></p>
            <form action="modificar2.php" method="POST">
                <select name="nuevoEstado" class="selectNestado">
                    <?php 
                    $dato= "SELECT * FROM estado";
                    $opnReclamo = mysqli_query($conexion, $dato);
                    while ($opcion = mysqli_fetch_array($opnReclamo)) {
                        echo '<option value="'.$opcion['estado'].'">'.$opcion['estado'].'</option>';
                    }
                    ?>
                </select>
                <input type="hidden" name="Nreclamo" value="<?php echo $_REQUEST['Nreclamo']; ?>">
                <button type="submit" class="btn-cambiar">Cambiar</button>
            </form>
        <?php
        }
        ?>
            </div>
</body>
</html>