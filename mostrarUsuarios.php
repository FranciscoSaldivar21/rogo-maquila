<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    @$usuario=$_SESSION['usuario'];
    @$nombre=$_SESSION['nombre'];
    @$cargo=$_SESSION['cargo'];

    if (!$_SESSION['usuario']){
        echo "<script>location.href='loginFront.php';</script>";
    }
?>
<html>
    <head>
        <title>USUARIOS</title>
        <script src="../jquery-3.3.1.min.js"></script>
        <script>
            function borrarUsuario(id){
                if(confirm("¿Estás seguro?")){
                    $.ajax({
                        url : 'eliminaUsuario.php',
                        type : 'post',
                        dataType : 'text', //Tipo de dato que recibe
                        data : 'id='+id, //Manda el usuario
                        success : function(bandera){
                            if(bandera){
                                nombrefila = "filas"+id;
                                fila = document.getElementById(nombrefila); //Extrae el div a eliminar
                                $(fila).hide(); //Oculta la fila
                                $('#mensaje').html('Usuario eliminado').show(); //Lanza mensaje 
                                setTimeout(function(){  //Define el tiempo del mensaje
                                    $('#mensaje').html('').show();
                                },5000);
                            }else{
								$('#mensaje').html('Error en la eliminacion.').show();  //Mensaje de error
								$('#mensaje').slideUp(5000); //oculta de abajo hacia arriba
								alert('No se borro');
                            }
                        }, 
                        error : function(){
                            alert("No se encontro el archivo");
                        }
                    });
                }
            }
        </script>
        <style>
            #titulo{
                width: 1000px;
                height: 30px;
                text-align: center;
                background-color: #DEDEDE;
                color: black;
                display: table-cell;

            }
            #divtitulo{
                width: 1078px;
                height: auto; 
                margin-top: 20px;
                margin: 0 auto;
                text-align: center;
                display: table;
            }
            #table{
                width: auto;
                height: auto; 
                margin-top: 20px;
                margin: 0 auto;
                text-align: center;
                display: table;
            }
            .filas{
                display: table-row;
                width:        16.5%;
                height:        50px;
                border:        1px solid #FFFFFF;
                background-color: #FFFFFF;
                color: black;
                text-align: center;
            }
            .columnas{
                display: table-cell;
                width:        16.5%;
                height:        50px;
                border:        1px solid #FFFFFF;
                text-align: center;
            }
            #enlace{
                color: black;
            }
            .boton{
                border: 1px solid #6F6F70;
                color: white;
                padding: 10px 10px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
                background-color: #6F6F70;
            }
            #divBoton{
                display: flex;
                justify-content: center;
                align-items: center;
            }
            img{
                width: 30px;
                height: 30px;
            }
        </style>
    </head>
    <body>
        <?php include("menuGerente.php"); ?>
        <div id = "divTitulo">
            <div id = "titulo">Usuarios</div>
        </div>
        <div id = "table">
            <div class = "filas">Usuario  
                <div class = "columnas">Nombre</div>
                <div class = "columnas">Cargo</div>
                <div class = "columnas">Accion</div>
                <div class = "columnas">Editar</div>
            </div>
            <?php
                require "conectaDB.php";
                $con = conecta();
        
                $sql = "SELECT * FROM usuarios WHERE  eliminado = 0";
                $res = $con->query($sql);

                while ($row = $res->fetch_array()) {
                    $id = $row["id"];
                    $user = $row["usuario"];
                    $nombre = $row["nombre"];
                    $password = $row["password"];
                    $cargo = $row["cargo"];
                    $cargo2 = '';

                    if($cargo == '1')
                        $cargo2 = "Gerente";
                    else if($cargo == '2')
                        $cargo2 = "Ejecutivo ventas";
                    else if($cargo == '3')
                        $cargo2 = "Almacenista";

                    $concatenacion = 'filas'. $id;
                    echo "<div class = \"filas\" id = $concatenacion>";
                        echo "<div class = \"columnas\"> $user </div>";
                        echo "<div class = \"columnas\"> $nombre </div>";
                        echo "<div class = \"columnas\"> $cargo2 </div>";
                        echo "<div class = \"columnas\"> <a  href = \"\" onclick = borrarUsuario($id)><img src=\"imagenes/borrar.png\"></div>";
                        echo "<div class = \"columnas\"> <a href = \"editaUsuario.php?id=$id\"><img src=\"imagenes/editar.png\"></a> </div>";
                    echo "</div>";
                }
            ?>
            <div id="mensaje" style="color:#F00;font-size:16px;"></div>
        </div>
        <br><br>
        <div id="divBoton">
            <a href = "agregarUsuario.php"><button class = "boton">+ Nuevo usuario</button>
        </div>
    </body>
</html>