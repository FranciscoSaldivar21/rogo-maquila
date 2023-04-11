<?php 
	require "conectaDB.php";
	$con = conecta();
    #idVenta : data.idVenta, idProducto : producto.id, cantidad : producto.cantidad, precio : producto.precio
    $idProducto = $_REQUEST['idProducto'];
    $idVenta = $_REQUEST['idVenta'];
    $cantidad = $_REQUEST['cantidad'];
    $precio = $_REQUEST['precio'];

    $sql = "INSERT INTO detallepedido VALUES('0','$idVenta','$idProducto','$precio','$cantidad')";
    if($con->query($sql))
        echo TRUE;
?>