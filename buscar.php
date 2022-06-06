<?php
    require ('admin/conexion.php');
    error_reporting(E_ALL ^ E_NOTICE); // para no mostrar en princio que $selectDpto y $Nreclamo estan vacios.
	$dpto = "SELECT * FROM departamentos ORDER BY departamento";
    $resDpto = mysqli_query($conexion, $dpto);
    $resbusqueda = '';
    $selectDpto = $_POST['departamento'];
    $Nreclamo = $_POST['Nreclamo'];

    if ($_POST) {
        $busqueda = trim($_POST['Nreclamo']);
        if (empty($busqueda)) {
            $resbusqueda = 'Busqueda sin resultado, verifique los datos ingresados.';
        }else{
            switch ($selectDpto) {
                case 'Capital':
                    $consulta = "SELECT estado,nombres,apellidos FROM bd_capital WHERE id = $Nreclamo";
                    $resultado = mysqli_query($conexion, $consulta);
                    break;
                case 'Chimbas':
                    $consulta = "SELECT estado,nombres,apellidos FROM bd_chimbas WHERE id = $Nreclamo";
                    $resultado = mysqli_query($conexion, $consulta);
                    break;
                case 'Santa Lucia':
                    $consulta = "SELECT estado,nombres,apellidos FROM bd_sl WHERE id = $Nreclamo";
                    $resultado = mysqli_query($conexion, $consulta);
                    break;
                default:
                    # code...
                    break;
            }
            if (mysqli_num_rows($resultado) != 0) {
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    $resbusqueda = "Estimada/o: ".$fila['nombres']. " " .$fila['apellidos']. " su reclamo esta: " .$fila['estado']. ".";
                }
            }else{
                $resbusqueda = "No se encontró el reclamo ingresado.";
            }
            mysqli_close($conexion);
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilosBuscar.css">
    <title>Estados de Reclamos</title>
</head>
<body>
    <div class="container menu">
        <div class="row">
            <div class="col-12">
                <h2 class="saludo">Estados de Reclamos</h2>
            </div>
        </div>
    </div>
    <div class="container cuerpo">
        <div class="row">
            <div class="col-12">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class="formBusqueda" name="buscador">
                    <div class="form-grup">
                        <i class="icono fas fa-map-marker-alt"></i>
                        <select class="dpto custom-select" name="departamento" id="departamento" required>
                            <option value="">Elija Departamento</option>

						    <?php while($opcion = $resDpto->fetch_assoc()) { ?>
							<option value="<?php echo $opcion['departamento']; ?>"><?php echo $opcion['departamento']; ?></option>
						    <?php } ?>
                        </select>
                    </div>
                    <div class="form-grup">
                        <i class="icono fas fa-info"></i>
                        <input type="text" name="Nreclamo" class="Nreclamo" placeholder="N° Reclamo">
                    </div>
                    <div class="form-grup col-12">
                    <button type="submit" class="btn btn-primary" value="buscar"><i class="fas fa-search"></i> Buscar</button>
                    </div>
                    <?php if (!empty($resbusqueda)): ?>
                        <div>
                            <ul class="mensaje">
                                <?php echo $resbusqueda; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </form>
                <br>
                <a href="Index.php" class="btn btn-success">Volver</a>
            </div>
        </div>
    </div>

    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
