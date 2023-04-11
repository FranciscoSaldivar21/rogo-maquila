<?php 
	require "conectaDB.php";
	$con = conecta();

    $id = $_REQUEST["idCliente"];
    $nombre = $_REQUEST["nombre"];
	$correo = $_REQUEST["correo"];
    $telefono = $_REQUEST["telefono"];
    $domicilio = $_REQUEST["domicilio"];
    
    $sql = "UPDATE clientes SET nombre = '$nombre', correo = '$correo', telefono = '$telefono', domicilio = '$domicilio' WHERE id = '$id'";
    if($con->query($sql)){
        header("Location: tablaClientes.php");
    }
    else{
        echo "Error: ".$sql."<br>".mysqli_error($con);
    }   
?>
