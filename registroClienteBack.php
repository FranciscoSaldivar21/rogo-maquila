<?php 
	require "conectaDB.php";
	$con = conecta();

    $telefono = $_REQUEST['telefono'];
	$nombre = $_REQUEST['nombre'];
    $correo = $_REQUEST['correo'];
    $domicilio = $_REQUEST['domicilio'];
	
	$sql = "INSERT INTO clientes VALUES ('0','$nombre','$correo','$domicilio','$telefono','0')";
	$res = $con->query($sql);
	header("Location: tablaClientes.php"); //Redirige hacia esa pagina
?>