<?php 
	require "conectaDB.php";
	$con = conecta();

	$file_name = $_FILES['archivo']['name'];
	$file_tmp = $_FILES['archivo']['tmp_name'];
	$cadena = explode(".", $file_name);
	$ext = $cadena[1];
	$dir = "imagenes/";
	$file_enc = md5_file($file_tmp);

	if($file_name != ''){
        $fileName1 = "$file_enc.$ext";
        copy($file_tmp, $dir.$fileName1);
	}

	$archivo = $file_enc.'.'.$ext;
    $producto = $_REQUEST['producto'];
	$talla = $_REQUEST['talla'];
    $precio = $_REQUEST['precio'];
	$descripcion = $producto.' talla '.$talla;
	
	$sql = "INSERT INTO productos VALUES ('0','$descripcion','$precio','$archivo','0')";
	$res = $con->query($sql);
	header("Location: tablaProductos.php"); //Redirige hacia esa pagina
?>