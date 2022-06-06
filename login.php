<?php session_start();

if (isset($_SESSION['departamento'])) {
	header('Location: index.php');
}
$errores = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$dpto = $_POST['departamento'];
	$usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
	$password = $_POST['password'];
	$password = hash('sha512', $password);	

	require ('admin/conexion.php');

 	$consulta = ("SELECT * FROM usuarios WHERE departamento = '$dpto' AND usuario = '$usuario'"); 
	$resultado = mysqli_query($conexion, $consulta);
 	$sesion=mysqli_fetch_array($resultado);

 	if ($password === $sesion['pass']) {
		 $_SESSION['departamento'] = $dpto;
		 
		 header("Location: Departamentos/{$dpto}/recepcion.php");
 	} else {
 		$errores .= '<li>Datos Incorrectos</li>';
 	}
}
require 'vistas/login.vista.php';
