<?php 
	require "conectaDB.php";
	$con = conecta();

    $id = $_REQUEST["idPedido"];
    $idMaterial = '';
    $cantidad = 0;
    $cantidadAnt = 0;

    $sql = "SELECT entregado FROM pedido WHERE id = '$id'";
    $res = $con->query($sql);
    if($con->query($sql)){
        while($fila = $res->fetch_assoc()){
            if($fila['entregado'] == '1')
                header("Location: tablaPedidos.php");
                return;
        }
    }

    
    $sql = "UPDATE pedido SET entregado = '1' WHERE id = '$id'";
    if($con->query($sql)){
        $sql = "SELECT idMaterial,cantidad FROM detallepedido WHERE idPedido = '$id'";
        $res = $con->query($sql);
        if($con->query($sql)){
            while($fila = $res->fetch_assoc()){
                $idMaterial = $fila['idMaterial'];
                $sql = "SELECT cantidad FROM material WHERE id = '$idMaterial'";
                $res2 = $con->query($sql);
                if($con->query($sql)){
                    while($fila2 = $res2->fetch_assoc()){
                        $cantidadAnt = intval($fila2['cantidad']);
                    }
                }
                $cantidad = intval($fila['cantidad']) + intval($cantidadAnt);
                $sql = "UPDATE material SET cantidad = '$cantidad' WHERE id = '$idMaterial'";
                $con->query($sql);
            }
        }
        header("Location: tablaPedidos.php");
    }
    else{
        echo "Error: ".$sql."<br>".mysqli_error($con);
    }   
?>
