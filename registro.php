<?php session_start();

if (isset($_SESSION['usuario'])) {
	header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$dpto = $_POST['departamento'];
	$usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
	$password = $_POST['password'];
	$password2 = $_POST['password2'];

	$errores = '';
	if (empty($usuario) or empty($password) or empty($password2) ) {
		$errores .= '<li>Por favor completa los datos correctamente.</li>';
	} else {
		require ('admin/conexion.php');

		$consulta = "SELECT * FROM usuarios WHERE departamento = '$dpto' AND usuario = '$usuario'"; 
		$resultado = mysqli_query($conexion, $consulta);
		$val=0;
		while ($res = mysqli_fetch_object($resultado)) {
			if ($res->departamento == $dpto AND $res->usuario == $usuario) {
				$val=1; //existe usuario
			}
		}
		$password = hash('sha512', $password);
		$password2 = hash('sha512', $password2);
		if ($val == 0) {
			if ($password == $password2) {
				$insertar = "INSERT INTO usuarios (id, departamento, usuario, pass) VALUES (null, '$dpto','$usuario', '$password')";
				$agregar = mysqli_query($conexion, $insertar);
				header('Location: login.php');		
			}else{
				$errores .= '<li>Las contraseñas no son iguales</li>';
			}
			
		}else {
			$errores .= '<li>El nombre de usuario ya existe</li>';			
		}
	}
}
require 'vistas/registro.vista.php';