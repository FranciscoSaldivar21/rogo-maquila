<?php 
	require "conectaDB.php";
	$con = conecta();

    $idDetalle = $_REQUEST['idDetalle'];

	$sql = "DELETE FROM detalleventa WHERE id = '$idDetalle'";
	$res = $con->query($sql);
	$bandera = TRUE;
	echo $bandera;
?>