<?php session_start();

if (isset($_SESSION['usuario'])) {
    header('Location: recepcion.php');
} else {
    header('Location: login.php');
}