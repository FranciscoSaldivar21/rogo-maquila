<?php 
	require "conectaDB.php";
	$con = conecta();
	$id = $_REQUEST['idPedido'];
    $bandera = '';
	$sql = "DELETE FROM pedido WHERE id = '$id'";
    $sql2 = "DELETE FROM detallepedido WHERE idPedido = '$id'";
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