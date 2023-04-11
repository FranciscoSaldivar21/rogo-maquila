<?php 
	require "conectaDB.php";
	$con = conecta();
	$id = $_REQUEST['idVenta'];
    $bandera = '';
	$sql = "DELETE FROM ventas WHERE id = '$id'";
    $sql2 = "DELETE FROM detalleventa WHERE idVenta = '$id'";
    if($con->query($sql)){
        $bandera = TRUE;
        if($con->query($sql2))
	        $bandera = TRUE;
        else 
            $bandera = FALSE;
    }else
        $bandera = FALSE;
	echo $bandera;
?>