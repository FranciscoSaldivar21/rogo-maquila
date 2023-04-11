<?php 
	require "conectaDB.php";
	$con = conecta();

	$estatus = $_REQUEST['estatus'];
    $idVenta = $_REQUEST['idVenta'];

	$sql = "UPDATE ventas SET estatus = '$estatus' WHERE id = '$idVenta'";
    if($con->query($sql))
        header("Location: tablaVentas.php");
    else {
        echo "Error";
    }
?>