<?php 
	require "conectaDB.php";
	$con = conecta();

	$file_name = $_FILES['archivo']['name'];
	$file_tmp = $_FILES['archivo']['tmp_name'];
	$cadena = explode(".", $file_name);
	@$ext = $cadena[1];
	$dir = "imagenes/";
	@$file_enc = md5_file($file_tmp);

	if($file_name != ''){
        $fileName1 = "$file_enc.$ext";
        copy($file_tmp, $dir.$fileName1);
	}

    $archivo_n = $file_name;
	$archivo = $file_enc.'.'.$ext;
    $id = $_REQUEST['id'];
    $precio = $_REQUEST['precio'];	
	$producto = $_REQUEST['producto'];
	$talla = $_REQUEST['talla'];
	$descripcion = $producto.' talla '.$talla;
    
    if ($file_name != ''){
        $sql = "UPDATE productos SET descripcion = '$descripcion', precio = '$precio', imagen = '$archivo' WHERE id = '$id'";
    }else{
        $sql = "UPDATE productos SET descripcion = '$descripcion', precio = '$precio' WHERE id = '$id'";
    }

    $res = $con->query($sql);
	header("Location: tablaProductos.php"); //Redirige hacia esa pagina
?>