<?php 
	require "conectaDB.php";
	$con = conecta();
	
    $id = $_REQUEST['id'];
    $usuario = $_REQUEST['usuario'];
    //verifica existencia
    $sql = "SELECT id FROM usuarios WHERE usuario = '$usuario'";
    $res = $con->query($sql);
    $bandera = -1;
    while($row = $res->fetch_array()){
        if($id == $row['id'])
            $bandera = 1; //Se confirma que el correo es del mismo id
        else
            $bandera = 0;
    }
    echo $bandera;
?>