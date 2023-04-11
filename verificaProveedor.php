<?php 
	require "conectaDB.php";
	$con = conecta();
	
    $idCliente = $_POST['idProveedor'];
    $nombre = '';
    //verifica existencia
    $sql = "SELECT nombre FROM proveedor WHERE id = '$idCliente'";
    $res = $con->query($sql);

    while($fila = $res->fetch_assoc()){
        $nombre = $fila['nombre'];
    }

        echo $nombre;
?>