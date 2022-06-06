<?php
    require ('conexion.php');
	
	$id_departamento = $_POST['ID_Dpto'];

	
	$reclamo = "SELECT * FROM reclamos WHERE departamento = '$id_departamento' ORDER BY treclamo";
	$resReclamo = mysqli_query($conexion, $reclamo);
	
	$html= "<option value=''>Seleccionar Reclamo</option>";
	
	while($opcion = $resReclamo->fetch_assoc()){
		$html .= "<option value='".$opcion['treclamo']."'>".$opcion['treclamo']."</option>";
	}
    
	echo $html;
?>	