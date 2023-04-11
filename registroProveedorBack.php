<?php 
	require "conectaDB.php";
	$con = conecta();

    $telefono = $_REQUEST['telefono'];
	$nombre = $_REQUEST['nombre'];
    $correo = $_REQUEST['correo'];
	
	$sql = "INSERT INTO proveedor VALUES ('0','$nombre','$telefono','$correo','0')";
	$res = $con->query($sql);
	header("Location: tablaProveedor.php"); //Redirige hacia esa pagina
?>