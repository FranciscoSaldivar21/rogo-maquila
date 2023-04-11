<?php 
	require "conectaDB.php";
	$con = conecta();

    $idDetalle = $_REQUEST['idDetalle'];
	$total = 0;
	$sql = "SELECT total FROM detallepedido WHERE id = '$idDetalle'";
	$res = $con->query($sql);
	while($fila = $res->fetch_assoc()){
		$total = intval($fila['total']);
	}
	$sql = "DELETE FROM detallepedido WHERE id = '$idDetalle'";
	$res = $con->query($sql);
	echo $total;
?>