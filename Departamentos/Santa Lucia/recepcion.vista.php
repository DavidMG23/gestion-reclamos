<?php
require ('../../admin/conexion.php');
$usuario = $_SESSION['departamento'];
$xestado="";
$xreclamo="";
$busquedaR="";
$a="";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/estilosRecepcion.css">
    <link href="https://fonts.googleapis.com/css?family=Oxygen:300,400,700" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recepción y administración de reclamos</title>
</head>
<body>
    <h2>Departamento: <?php echo $usuario ?></h2>
    <hr>
    <a href="../../cerrar.php" class="btn btn-primary cerrar">Cerrar Sesión</a>
    <form method="POST" >
        <select name="reclamos" id="" class="select">
            <option value="">Seleccione Reclamo</option>
            <?php
                $dato= "SELECT * FROM reclamos WHERE departamento = '$usuario' ";
                $opnReclamo = mysqli_query($conexion, $dato);
                while ($opcion = mysqli_fetch_array($opnReclamo)) {
                    echo '<option value="'.$opcion['treclamo'].'">'.$opcion['treclamo'].'</option>';
                }
		    ?>
        </select> - 
        <select name="estados" id="" class="select">
            <option value="">Seleccione Estado</option>
            <?php
                $dato= "SELECT * FROM estado";
                $opnReclamo = mysqli_query($conexion, $dato);
                while ($opcion = mysqli_fetch_array($opnReclamo)) {
                    echo '<option value="'.$opcion['estado'].'">'.$opcion['estado'].'</option>';
                }
		    ?>
        </select> - 
        <button name="filtrar" type="submit" class="btn-filtrar">Filtrar Datos</button>
    </form>
    <?php 
    // Menus de filtrado
    if (isset($_REQUEST['filtrar'])) {
        $xreclamo=$_POST['reclamos'];
        $xestado=$_POST['estados'];
    }
    if (empty($xreclamo)||!empty($xreclamo)||empty($xestado)||!empty($xestado)) {
        
        $ver = "SELECT * FROM bd_sl WHERE reclamo = '$xreclamo' OR estado = '$xestado' "; //si queremos usar los select combinados cambiar el OR por AND
        $busquedaR=mysqli_query($conexion, $ver);
    }
    echo '<table class="tablalistadob"><h5>Resultados:</h5><tr><th>N° Reclamo</th><th>Reclamo</th><th>Fecha</th><th>Dirección</th><th>N°</th><th>Entre</th><th>Nombres</th><th>Apellidos</th><th>Mail</th><th>Comentario</th><th>Estado</th></tr>';
    while ($mostrar = mysqli_fetch_array($busquedaR) ) {
        echo '<tr class="marcar"><td>'.$mostrar['id'].'</td>';
        echo '<td>'.$mostrar['reclamo'].'</td>';
        echo '<td>'.$mostrar['fecha'].'</td>';
        echo '<td>'.$mostrar['direccion'].'</td>';
        echo '<td>'.$mostrar['numeracion'].'</td>';
        echo '<td>'.$mostrar['entre'].'</td>';
        echo '<td>'.$mostrar['nombres'].'</td>';
        echo '<td>'.$mostrar['apellidos'].'</td>';
        echo '<td>'.$mostrar['email'].'</td>';
        echo '<td>'.$mostrar['detalle'].'</td>'; 
        echo '<td>'.$mostrar['estado'].' - <a href="modificar.php?Nreclamo='.$mostrar['id'].'">Modificar</a></td></tr>';
        $a=1;
    } 
    if (empty($a)&&isset($_REQUEST['filtrar'])) {
        echo '<p class="mensaje">No se encontraron resultados</p>';
    }
    // estadísticas
    ?>
        <table class="tablalistadoE">
        <h5>Estadisticas:</h5>
        <tr>
            <th>Ingresados</th>
            <th>Pendientes</th>
            <th>En proceso</th>
            <th>Finalizados</th>
        </tr>
        <tr> 
            <td>
                <?php
                $filtro = "SELECT COUNT(*) total FROM bd_sl";
                $result = mysqli_query($conexion,$filtro);
                $contador = mysqli_fetch_assoc($result);
                echo $contador['total'];
                ?>
            </td>
            <td>
                <?php    
                $filtro = "SELECT COUNT(*) total FROM bd_sl WHERE estado = 'Pendiente' ";
                $result = mysqli_query($conexion,$filtro);
                $contador = mysqli_fetch_assoc($result);
                echo $contador['total'];
                ?>
            </td>
            <td>
                <?php    
                $filtro = "SELECT COUNT(*) total FROM bd_sl WHERE estado = 'En proceso' ";
                $result = mysqli_query($conexion,$filtro);
                $contador = mysqli_fetch_assoc($result);
                echo $contador['total'];
                ?>
            </td>
            <td>
                <?php    
                $filtro = "SELECT COUNT(*) total FROM bd_sl WHERE estado = 'Finalizado' ";
                $result = mysqli_query($conexion,$filtro);
                $contador = mysqli_fetch_assoc($result);
                echo $contador['total'];
                ?>
            </td>
        </tr>
    </table>
    <?php
    //------ Listado General------------
    echo '<table class="tablalistado"><h5>Listado General:</h5><tr><th>N° Reclamo</th><th>Reclamo</th><th>Fecha</th><th>Dirección</th><th>Numeración</th><th>Entre</th><th>Nombres</th><th>Apellidos</th><th>Mail</th><th>Comentario</th><th>Estado</th></tr>';
    $ver = "SELECT * FROM bd_sl";
    $busqueda=mysqli_query($conexion, $ver);
    while ($mostrar = mysqli_fetch_array($busqueda) ) {
        echo '<tr class="marcar"><td>'.$mostrar['id'].'</td>';
        echo '<td>'.$mostrar['reclamo'].'</td>';
        echo '<td>'.$mostrar['fecha'].'</td>';
        echo '<td>'.$mostrar['direccion'].'</td>';
        echo '<td>'.$mostrar['numeracion'].'</td>';
        echo '<td>'.$mostrar['entre'].'</td>';
        echo '<td>'.$mostrar['nombres'].'</td>';
        echo '<td>'.$mostrar['apellidos'].'</td>';
        echo '<td>'.$mostrar['email'].'</td>';
        echo '<td>'.$mostrar['detalle'].'</td>'; 
        echo '<td>'.$mostrar['estado'].'</td></tr>'; 
    }
            
    
    ?>
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</body>
</html>