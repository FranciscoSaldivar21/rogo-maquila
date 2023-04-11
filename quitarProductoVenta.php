<?php 
	require "conectaDB.php";
	$con = conecta();

	$idProducto = $_REQUEST['idProducto'];
    $idVenta = $_REQUEST['idVenta'];

	$sql = "DELETE FROM detalleVenta WHERE idProducto = '$idProducto' AND idVenta = '$idVenta'";
	$res = $con->query($sql);
	$bandera = TRUE;
	echo $bandera;
?>