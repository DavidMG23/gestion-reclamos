<?php
	require ('admin/conexion.php');
	$dpto = "SELECT * FROM departamentos ORDER BY departamento";
	$resDpto = mysqli_query($conexion, $dpto);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Oxygen:300,400,700" rel="stylesheet">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/estilosFormulario.css">
	<script src="js/jquery.min.js"></script>
	<title>Gestión de reclamos</title>
	<script>
		$(document).ready(function(){
			$("#departamento").change(function () {
				$("#departamento option:selected").each(function () {
					ID_Dpto = $(this).val();
					$.post("admin/getreclamo.php", { ID_Dpto: ID_Dpto }, function(data){
						$("#reclamo").html(data);
					});            
				});
			})
		});
	</script>
</head>
<body>
	<div class="container menu">
		<div class="row">
			<div class="col-12">
				<h2 class="saludo">Complete el formulario para iniciar su reclamo</h2>
			</div>
		</div>
	</div>
	<div class="container cuerpo">
		<div class="row">
			<div class="col-12">
				<form class="was-validated form-row" name="formulario" action="recibe.php" method="POST">
					<div class="form-group col-md-5">
				    	<select class="custom-select" name="departamento" id="departamento" required>
					      <option value="">Elija Departamento</option>

						  <?php while($opcion = $resDpto->fetch_assoc()) { ?>
							<option value="<?php echo $opcion['departamento']; ?>"><?php echo $opcion['departamento']; ?></option>
						  <?php } ?>

				    	</select>
				  	</div>
					<div class="form-group col-md-5">
				    	<select class="custom-select" name="reclamo" id="reclamo" required>
						<option value=''>Seleccionar Reclamo</option>
						</select>
				  	</div>
					<div class="form-group col-md-2">
					    <input type="date" id="txtfecha" name="txtfecha" class="form-control" value="<?php echo date('Y-n-j'); ?>" />
					</div>
				    <div class="form-group col-md-6" >
				    	<label for="direccion">Dirección</label>
				      	<input type="text" class="form-control" id="direccion" name="direccion" placeholder="Especifique orientacion Ej.: Mitre Este " required>
				    </div>

				    <div class="form-group col-md-2">
				      	<label for="numeracion">Altura</label>
				      	<input type="text" class="form-control" id="numeracion" name="numeracion" placeholder="Numero" required>
				    </div>
				    <div class="form-group col-md-4">
				      	<label for="entre">Entre (Opcional)</label>
				      	<input type="text" class="form-control" id="entre" name="entre" placeholder="Calle A y Calle B">
				    </div>
					<div class="form-group col-md-4">
						<label for="nombres">Nombres</label>
					   	<input type="text" class="form-control" id="nombres" name="nombres" required>
					</div>
					<div class="form-group col-md-4">
					   	<label for="apellidos">Apellidos</label>
					   	<input type="text" class="form-control" id="apellidos" name="apellidos" required>
					</div>
					<div class="form-group col-md-4">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="email" required>
					</div>
					<!-- <div class="form-group col-md-6">
						<label for="celular">N° Celular</label>
						<input type="text" minlength="10" maxlength="10" class="form-control" id="celular" name="celular" placeholder="Ej.: 2645123456" required>
					</div> -->
				  	<div class="form-group col-md-12">
				    <label for="Textarea">Comentario (Opcional)</label>
				    <textarea class="form-control" id="Textarea" rows="2" maxlength="100" name="textarea" placeholder="Algo que deseé agregar para tener en cuenta. (Maximo 100 caracteres)"></textarea>
				  	</div>
					
					<input type="hidden" name="estado" value="Pendiente">

				  	<div class="form-grup col-12 boton">
				  	<button type="submit" class="btn btn-info">Enviar</button> 
				  	</div>
				  	<div class="form-grup col-12 boton" >
				  		<a href="index.php" class="btn btn-dark">Volver</a>
				  	</div>
				</form>
			</div>
		</div>
	</div>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>