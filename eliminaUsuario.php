<?php 
	require "conectaDB.php";
	$con = conecta();

	$id = $_REQUEST['id'];

	//$sql = "DELETE FROM administradores WHERE id = $id";
	$sql = "UPDATE usuarios SET eliminado = 1 WHERE id = $id";
	$res = $con->query($sql);
	$bandera = TRUE;
	echo $bandera;
	//header("Location: tablaAdministradores.php"); //Redirige hacia esa pagina
?>