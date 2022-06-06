<?php
	require ('admin/conexion.php');
	$dpto = "SELECT * FROM departamentos ORDER BY departamento";
	$resDpto = mysqli_query($conexion, $dpto);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilosLogin.css">
    <title>Iniciar Sesión</title>
</head>
<body>
    <div class="container menu">
        <div class="row">
            <div class="col-12">
                <h2 class="saludo">Iniciar Sesión</h2>
            </div>
        </div>
    </div>
    <div class="container cuerpo">
        <div class="row">
            <div class="col-12">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class="formReg" name="login">
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
                        <i class="icono fas fa-user-tie"></i>
                        <input type="text" name="usuario" class="usuario" placeholder="Usuario">
                    </div>
                    <div class="form-grup">
                        <i class="icono fas fa-fingerprint"></i>
                        <input type="password" name="password" class="password" placeholder="Contraseña">
                    </div>
                    <div class="form-grup col-12">
                    <button type="submit" class="btn btn-success"><i class="fas fa-power-off"></i> Iniciar</button>
                    </div>
                    <?php if (!empty($errores)): ?>
                        <div>
                            <ul>
                                <?php echo $errores; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </form>
                <p class="texto-registrate" >¿Aun no tienes una cuenta?</p>
                <a href="registro.php" class="registrate">Registrate</a>
                <br>
                <a href="Index.php" class="volver">Volver</a>
            </div>
        </div>
    </div>

    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
