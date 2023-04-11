<?php
	require "conectaDB.php";
	$con = conecta();
    $total = 0;
    @$idPedido = $_REQUEST['idPedido'];
    if($idPedido == null)
        echo 0;
    else{
        $sql = "SELECT cantidad, precio FROM detalleventa WHERE idPedido = '$idPedido'";
        if($con->query($sql)){
            while($fila = $con->fetch_assoc()){
                $total = intval($total) + intval($fila['precio']) * intval($fila['cantidad']); 
            }
            echo $total;
        }
    }
?>