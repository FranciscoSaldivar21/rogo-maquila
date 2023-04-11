<?php 
	require "conectaDB.php";
	$con = conecta();

	$idProducto = $_REQUEST['idProducto'];
    $idVenta = $_REQUEST['idVenta'];
    $cantidad = $_REQUEST['cantidad'];

	$sql = "UPDATE detalleventa SET cantidad = '$cantidad' WHERE idProducto = '$idProducto' AND idVenta = '$idVenta'";
	$res = $con->query($sql);
	$bandera = TRUE;
	echo $bandera;
?>