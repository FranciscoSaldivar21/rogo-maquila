<?php 
	require "conectaDB.php";
	$con = conecta();
	$id = $_REQUEST['id'];

	$sql = "UPDATE clientes SET eliminado = 1 WHERE id = $id";
    if($con->query($sql))
	    $bandera = TRUE;
    else
        $bandera = FALSE;
	echo $bandera;
?>