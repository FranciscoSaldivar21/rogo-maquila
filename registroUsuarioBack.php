<?php 
	require "conectaDB.php";
	$con = conecta();

    $usuario = $_REQUEST['usuario'];
	$nombre = $_REQUEST['nombre'];
    $pass = $_REQUEST['pass'];
    $cargo = $_REQUEST['cargo'];
	//$password = md5($pass); //Contraseña encriptada
	
	$sql = "INSERT INTO usuarios VALUES ('0','$usuario','$nombre','$cargo','$pass','0')";
	$res = $con->query($sql);
	header("Location: mostrarUsuarios.php"); //Redirige hacia esa pagina
?>