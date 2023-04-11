<?php 
	require "conectaDB.php";
	$con = conecta();

    $id = $_REQUEST["idUsuario"];
    $usuario = $_REQUEST["user"];
	$nombre = $_REQUEST["nombre"];
    $password = $_REQUEST["pass"];
    $cargo = $_REQUEST["cargo"];
    
    $sql = "UPDATE usuarios SET password = '$password', usuario = '$usuario', nombre = '$nombre', cargo = '$cargo' WHERE id = '$id'";
    if($con->query($sql)){
        header("Location: mostrarUsuarios.php");
    }
    else{
        echo "Error: ".$sql."<br>".mysqli_error($con);
    }   
?>
