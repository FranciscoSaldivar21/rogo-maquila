<?php 
	require "conectaDB.php";
	$con = conecta();
	
    $idCliente = $_POST['idCliente'];
    $nombre = '';
    //verifica existencia
    $sql = "SELECT nombre FROM clientes WHERE id = '$idCliente'";
    $res = $con->query($sql);

    while($fila = $res->fetch_assoc()){
        $nombre = $fila['nombre'];
    }

        echo $nombre;
?>