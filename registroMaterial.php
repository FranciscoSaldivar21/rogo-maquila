<?php 
	require "conectaDB.php";
	$con = conecta();

    $descripcion = $_REQUEST['material'];
    $color = $_REQUEST['color'];
    $precio = $_REQUEST['precio'];
    $idProveedor = $_REQUEST['idProveedor'];
	$uniMEd = $_REQUEST['uniMed'];
    $cantidad = $_REQUEST['cantidad'];
	$descripcion = $descripcion.' color '.$color;
	
	$sql = "INSERT INTO material VALUES ('0','$descripcion','$idProveedor','$cantidad','$precio','0','$uniMEd')";
	$res = $con->query($sql);
	header("Location: tablaMaterial.php"); //Redirige hacia esa pagina
?>