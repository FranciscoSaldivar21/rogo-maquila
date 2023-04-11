<?php 
	require "conectaDB.php";
	$con = conecta();
	$id = $_REQUEST['idVenta'];

	$sql = "UPDATE ventas SET eliminado = 1 WHERE id = $id";
    if($con->query($sql))
	    $bandera = TRUE;
    else
        $bandera = FALSE;
	echo $bandera;
?>