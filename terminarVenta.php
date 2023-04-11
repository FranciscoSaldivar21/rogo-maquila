<?php 
	require "conectaDB.php";
	$con = conecta();

    $idCliente = $_REQUEST['idCliente'];
    date_default_timezone_set('America/Monterrey');
    $date = date('d-m-Y H:i');
	
	$sql = "INSERT INTO ventas VALUES ('0','$date','$idCliente','0','0','0','0')";
	$res = $con->query($sql);
    $sql2 = "SELECT * FROM ventas ORDER BY fecha DESC LIMIT 1";
    $resultado = $con->query($sql2);
    $idVenta = '';
    while($fila = $resultado->fetch_assoc())
    {
        $idVenta = $fila['id'];
    }
    $bandera = TRUE;
    $mensaje= array('bandera' => $bandera, 'idVenta' => $idVenta);
    echo json_encode($mensaje);
    //echo $idVenta;
?>