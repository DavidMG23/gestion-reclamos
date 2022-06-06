<?php
	require 'admin/conexion.php';
	if ($departamento == 'Capital') {
		$dato = 'SELECT id FROM bd_capital ORDER BY id DESC LIMIT 1';
		$numero = mysqli_query($conexion, $dato);
	}
	if ($departamento == 'Santa Lucia') {
		$dato = 'SELECT id FROM bd_sl ORDER BY id DESC LIMIT 1';
		$numero = mysqli_query($conexion, $dato);
	}
	if ($departamento == 'Chimbas') {
		$dato = 'SELECT id FROM bd_chimbas ORDER BY id DESC LIMIT 1';
		$numero = mysqli_query($conexion, $dato);
	}
?>
<div class="alert alert-success" role="alert">
	<strong>¡Recepción Exitosa!</strong> Lo resolveremos a la brevedad. Gracias por su tiempo.
	<br><strong>Comprobante N° <?php 
		while ($a = mysqli_fetch_array($numero)) {
			echo $a['id'];
		}
	?></strong>
</div>
