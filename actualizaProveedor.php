<?php 
	require "conectaDB.php";
	$con = conecta();

    $id = $_REQUEST["idProveedor"];
    $nombre = $_REQUEST["nombre"];
	$correo = $_REQUEST["correo"];
    $telefono = $_REQUEST["telefono"];
    
    $sql = "UPDATE proveedor SET nombre = '$nombre', correo = '$correo', telefono = '$telefono' WHERE id = '$id'";
    if($con->query($sql)){
        header("Location: tablaProveedor.php");
    }
    else{
        echo "Error: ".$sql."<br>".mysqli_error($con);
    }   
?>
