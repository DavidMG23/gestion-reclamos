<?php session_start();

if(isset($_SESSION['tiempo']) ) {
	//Tiempo en segundos para dar vida a la sesión.
	$inactivo = 600;//10min en este caso.
	//Calculamos tiempo de vida inactivo.
	$vida_session = time() - $_SESSION['tiempo'];
		//Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
		if($vida_session > $inactivo)
		{
			//Removemos sesión.
			session_unset();
			//Destruimos sesión.
			session_destroy();              
			//Redirigimos pagina.
			require 'timeOut.php';
			require 'index.php';
			exit();
		}
}
$_SESSION['tiempo'] = time();

if (isset($_SESSION['departamento'])) {
	require "recepcion.vista.php";
}else {
	header('Location: login.php');
}