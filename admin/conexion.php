<?php
	$conexion = new mysqli ('localhost', 'root', '', 'sistema_gestion');
	if ($conexion->connect_errno) {
		die('Error de conexion');
	}