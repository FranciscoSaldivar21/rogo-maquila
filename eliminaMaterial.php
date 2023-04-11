<?php 
	require "conectaDB.php";
	$con = conecta();

	$id = $_REQUEST['id'];

	$sql = "UPDATE material SET eliminado = 1 WHERE id = $id";

    if($con->query($sql))
	    $bandera = TRUE;
    else
        $bandera = FALSE;
        
	echo $bandera;
	//header("Location: tablaAdministradores.php"); //Redirige hacia esa pagina
?>