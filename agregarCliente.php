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
        <title>Registro cliente</title>
    </head>
    <script src="../jquery-3.3.1.min.js"></script>
    <script>
        function validar(){
            var telefono = document.forma01.telefono.value;
            var nombre = document.forma01.nombre.value;
            var correo = document.forma01.correo.value;
            var domicilio = document.forma01.domicilio.value;

            if(telefono == '' || nombre == '' || correo == '' || domicilio == ''){
                $('#mensaje2').html('Llene todos los campos').show();
                setTimeout(function(){ //INICIO UN RELOJ 
                $('#mensaje2').html('').show();//OCULTO EL MENSAJE EN 5 SEGUNDOS
                },5000);
            }
            else{
                document.forma01.method = 'post';
                document.forma01.action = 'registroClienteBack.php';
                document.forma01.submit();
            }
        }

    </script>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:400);
        form{
            padding: 60px;
            max-width: 400px;
            background-color: #E7E7E7;
            margin: 0 auto;
        }

        form input, form textarea{
            margin-bottom: 15px;
            font-family: "Roboto", sans-serif;
            width: 100%;
            padding: 10px;
            -webkit-box-sizing: border-box;
            box-sizing: border-box; 
            border: none; 
            color: #525c66; 
            font-size: 1em;
            resize: horizontal; 
        }

        #divBoton{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 50px;
        }
        #principal{
            display: flex;
            width: auto;
            justify-content: center;
            align-items: center;
            background-color : white;
        }
        .boton{
            color: white;
            padding: 5px 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 2px 2px;
            cursor: pointer;
            background-color: #555557;
        }
        .boton2{
            color: black;
            padding: 10px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 2px 2px;
            cursor: pointer;
            background-color: #D5D5D5;
        }


    </style>
    <body>
        <P SIZE="5" align='center'>AGREGAR CLIENTE</P>
        <div id = "principal">
            <form name = "forma01">
                <label for = "nombre">Nombre<input type = "text" name = "nombre"/></label><br>
                <label for = "correo">Correo<input type = "correo" name = "correo"/></label><br>
                <label for = "telefono">Telefono<input pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" type = "tel" name = "telefono"/></label><br>
                <label for = "correo">Domicilio<input type = "text" name = "domicilio"/></label><br>
                <div class="div2" id="mensaje2" style="color:#F00; font-size:16px; margin-top : 10px;" ></div><br>
                <div id = "divBoton"> 
                    <input type = "submit" class = "boton" onclick = "validar(); return false;" value = "Agregar"></input>
                </div>
            </form> 
        </div>
        <div id="divBoton">
            <a href = "tablaClientes.php"><button class = "boton">Cancelar</button>
        </div>
    </body>
</html>