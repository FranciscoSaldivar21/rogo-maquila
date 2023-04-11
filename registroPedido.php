<?php 
	require "conectaDB.php";
	$con = conecta();

    $idProveedor = $_REQUEST['idProveedor'];
    date_default_timezone_set('America/Monterrey');
    $date = date('d-m-Y H:i');
	
	$sql = "INSERT INTO pedido VALUES ('0','$date','$idProveedor','0','0')";
	$res = $con->query($sql);
    $sql2 = "SELECT * FROM pedido ORDER BY fecha DESC LIMIT 1";
    $resultado = $con->query($sql2);
    $idPedido = '';
    $proveedor = '';
    while($fila = $resultado->fetch_assoc())
    {
        $idPedido = $fila['id'];
    }
    $sql3 = "SELECT * FROM proveedor WHERE id = '$idProveedor'";
    $resultado = $con->query($sql3);
    while($fila = $resultado->fetch_assoc())
    {
        $proveedor = $fila['nombre'];
    }
    $mensaje= array('idPedido' => $idPedido, 'fecha' => $date, 'proveedor' => $proveedor);
    echo json_encode($mensaje);
    //echo $idVenta;
?>