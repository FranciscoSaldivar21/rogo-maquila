<?php 
	require "conectaDB.php";
	$con = conecta();
	
    $idProducto = $_REQUEST['idProducto'];
    $id = $_REQUEST['id'];
    //verifica existencia
    $sql = "SELECT idProducto FROM productos WHERE id = '$id'";
    $res = $con->query($sql);
    $bandera = -1;
    while($row = $res->fetch_array()){
        if($idProducto == $row['idProducto'])
            $bandera = 1; //Se confirma que el correo es del mismo id
        else
            $bandera = 0;
    }
    echo $bandera;
?>