<?php 
	require "conectaDB.php";
	$con = conecta();

    $idMaterial = $_REQUEST['idMaterial'];
    $idPedido = $_REQUEST['idPedido'];
    $cantidad = $_REQUEST['cantidad'];
    $precio = $_REQUEST['precio'];
    $total = intval($precio) * intval($cantidad);
    $sql = "SELECT cantidad,total FROM detallepedido WHERE idMaterial = '$idMaterial' AND idPedido = '$idPedido'";
    $resultado = $con->query($sql);
    if($resultado->num_rows > 0){
        while($fila = $resultado->fetch_assoc()){
            $cantidad = intval($cantidad) + intval($fila['cantidad']); 
            $total = intval($total) + intval($fila['total']); 
        }
        $sql = "UPDATE detallepedido SET cantidad = '$cantidad', total = '$total' WHERE idMaterial = '$idMaterial' AND idPedido = '$idPedido'";
    }else{
        $sql = "INSERT INTO detallepedido VALUES('0','$idPedido','$idMaterial','$precio','$cantidad','$total')";
    }
        if($con->query($sql)){
            $bandera = TRUE;
        }else{
            $bandera = FALSE;
        }
    echo $bandera;
?>