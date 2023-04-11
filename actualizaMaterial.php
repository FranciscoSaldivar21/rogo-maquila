<?php 
	require "conectaDB.php";
	$con = conecta();
    $con2 = conecta();

    $id = $_REQUEST["id"];
    $descripcion = $_REQUEST["descripcion"];
	$idProveedor = $_REQUEST["idProveedor"];
    $precio = $_REQUEST["precio"];
    $existencia = $_REQUEST["cantidad"]; //Es lo que había
    $inventario = $_REQUEST["inventario"]; //Se quita
    $opcion = $_REQUEST["opcion"];
    date_default_timezone_set('America/Monterrey');
    $date = date('d-m-Y H:i');
    $unidad = $_REQUEST["uniMed"];
    $existencia2 = intval($existencia);
    
    $existencia = intval($existencia) - intval($inventario);
    
    $sql = "UPDATE material SET descripcion = '$descripcion', idProveedor = '$idProveedor', precio = '$precio', cantidad = '$existencia' WHERE id = '$id'";
    $sql2 = "INSERT INTO logmaterial VALUES ('0','$date','$existencia','$id','$unidad','$existencia2')";
    if($con->query($sql) && $con2->query($sql2)){
        header("Location: tablaMaterial.php");
    }
    else{
        echo "Error: ".$sql."<br>".mysqli_error($con)."Error: ".mysqli_error($con2);
    }   
?>
