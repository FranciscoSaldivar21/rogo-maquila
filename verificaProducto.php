<?php 
	require "conectaDB.php";
	$con = conecta();
	
    $codigo = $_POST['codigo'];
    //verifica existencia
        $sql = "SELECT * FROM productos WHERE id = '$codigo' AND eliminado = 0";
        $res = $con->query($sql);
        $num = $res->num_rows;
        $precio = '';
        $descripcion = '';
        $bandera = FALSE;
        if ($num >= 1){
            while($fila = $res->fetch_assoc())
            {
                $precio = $fila['precio'];
                $descripcion = $fila['descripcion'];
            }
            $bandera = TRUE;
        }
    $mensaje= array('descripcion' => $descripcion, 'precio' => $precio, 'bandera' => $bandera);
    echo json_encode($mensaje);
?>