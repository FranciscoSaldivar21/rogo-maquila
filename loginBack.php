<?php
    session_start();
    require "conectaDB.php";
    
    $con = conecta();
    $usuario = $_REQUEST['usuario'];
    $pass = $_REQUEST['pass'];
    //$password = md5($pass);

    $sql = "SELECT * FROM usuarios WHERE '$usuario' = usuario AND '$pass' = password AND eliminado = 0";
    $res = $con->query($sql);
    $num = $res->num_rows;
    if($num) {
        while($row = $res->fetch_array())
        {
            $usuario = $row['usuario'];
            $nombre = $row['nombre'];
            $cargo = $row['cargo'];
            $_SESSION['usuario'] = $usuario;
            $_SESSION['nombre'] = $nombre;
            $_SESSION['cargo'] = $cargo;
        }
        if($cargo == '1'){
            $bandera = 1; //Retorna que es gerente
            echo $bandera;
        }
        else if($cargo == '2'){
            $bandera = 2; //Retorna que es de ventas
            echo $bandera;
        }
        else if($cargo == '3'){
            $bandera = 3; //Retorna que es de almacen
            echo $bandera;
        }

    }
    else{
        $bandera = 0; //Retorna falso
        echo $bandera;
    }
?>