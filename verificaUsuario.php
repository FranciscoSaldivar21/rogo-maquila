<?php 
	require "conectaDB.php";
	$con = conecta();
	
    $usuario = $_POST['usuario'];
    //verifica existencia
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
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