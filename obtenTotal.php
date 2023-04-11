<?php
	require "conectaDB.php";
	$con = conecta();
    $total = 0;
    @$idVenta = $_REQUEST['idVenta'];
    if($idVenta == null)
        echo 0;
    else{
        $sql = "SELECT cantidad, precio FROM detalleventa WHERE idVenta = '$idVenta'";
        $resultado = $con->query($sql);
        while($fila = $resultado->fetch_assoc()){
            $total = intval($total) + intval($fila['precio']) * intval($fila['cantidad']); 
        }
        echo $total;
    }
?>