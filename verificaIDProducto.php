<?php 
	require "conectaDB.php";
	$con = conecta();
	
    $id = $_POST['id'];
    //verifica existencia
        $sql = "SELECT * FROM productos WHERE id = '$id'";
        $res = $con->query($sql);
        $num = $res->num_rows;
        if ($num >= 1){
            $bandera = TRUE;
            echo $bandera;
        }
        else if ($num <= 0){
            $bandera = FALSE;
            echo $bandera;
        }
?>