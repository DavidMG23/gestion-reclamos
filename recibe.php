<?php
print_r($_POST);

if (!$_POST) {
    header('location: http://localhost/Curso_php/mis_trabajos/SistemaPQRs/reclamos_SJ/');
}
//--------------------abrir conexión---------------------------------
$conexion = new mysqli('localhost', 'root', '', 'sistema_gestion');
if ($conexion->connect_errno) {
    die('Error de conexion');
} else {
    $id           = null;
    $departamento = $_POST['departamento'];
    $reclamo      = $_POST['reclamo'];
    $fecha        = $_POST['txtfecha'];
    // $direccion    = filter_var($_POST['direccion'], FILTER_SANITIZE_STRING);
    $direccion    = htmlspecialchars (filter_var($_POST['direccion']));
    $numeracion   = $_POST['numeracion'];
    // $entre        = filter_var($_POST['entre'], FILTER_SANITIZE_STRING);
    // $detalle      = filter_var($_POST['textarea'], FILTER_SANITIZE_STRING);
    // $nombres      = filter_var($_POST['nombres'], FILTER_SANITIZE_STRING);
    // $apellidos    = filter_var($_POST['apellidos'], FILTER_SANITIZE_STRING);
    $entre        = htmlspecialchars(filter_var($_POST['entre']));
    $detalle      = htmlspecialchars(filter_var($_POST['textarea']));
    $nombres      = htmlspecialchars(filter_var($_POST['nombres']));
    $apellidos    = htmlspecialchars(filter_var($_POST['apellidos']));
    $email        = $_POST['email'];
    $estado       = $_POST['estado'];

    if ($departamento == 'Capital') {
        $insertar = "INSERT INTO bd_capital (id, reclamo, fecha, direccion, numeracion, entre, nombres, apellidos, email, detalle, estado) VALUES 
        ('$id', '$reclamo','$fecha', '$direccion', '$numeracion', '$entre', '$nombres', '$apellidos', '$email', '$detalle', '$estado')";
        $conexion->query($insertar);
    }
    if ($departamento == 'Santa Lucia') {
        $insertar = "INSERT INTO bd_sl (id, reclamo, fecha, direccion, numeracion, entre, nombres, apellidos, email, detalle, estado) VALUES 
        ('$id', '$reclamo','$fecha', '$direccion', '$numeracion', '$entre', '$nombres', '$apellidos', '$email', '$detalle', '$estado')";
        $conexion->query($insertar);
    }
    if ($departamento == 'Chimbas') {
        $insertar = "INSERT INTO bd_chimbas (id, reclamo, fecha, direccion, numeracion, entre, nombres, apellidos, email, detalle, estado) VALUES 
        ('$id', '$reclamo','$fecha', '$direccion', '$numeracion', '$entre', '$nombres', '$apellidos', '$email', '$detalle', '$estado')";
        $conexion->query($insertar);
    }
    
    $conexion->close();
    
    require 'cargaOk.php';
    require 'index.php';
}

