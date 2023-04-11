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
        <title>Registro usuario</title>
    </head>
    <script src="../jquery-3.3.1.min.js"></script>
    <script>
        function validar(){
            var usuario = document.forma01.usuario.value;
            var nombre = document.forma01.nombre.value;
            var cargo = document.forma01.cargo.value;
            var password = document.forma01.pass.value;

            if(usuario == '' || nombre == '' || cargo == '0' || password == ''){
                $('#mensaje2').html('Llene todos los campos').show();
                setTimeout(function(){ //INICIO UN RELOJ 
                $('#mensaje2').html('').show();//OCULTO EL MENSAJE EN 5 SEGUNDOS
                },5000);
            }
            else{
                document.forma01.method = 'post';
                document.forma01.action = 'registroUsuarioBack.php';
                document.forma01.submit();
            }
        }
        
        function validaUsuario(usuario){
            if(usuario != ""){
                console.log("Entré2");
                $.ajax({
                    url      : 'verificaUsuario.php',
                    type     : 'post',
                    dataType : 'text',
                    data     : 'usuario='+usuario,
                    success  : function(bandera) {
                        if (bandera){  //bandera
                            console.log(bandera);
                            $('#mensaje').html('Error, el usuario '+usuario+' ya existe').show(); //Permite que se vuelva a mostrar despues de ser ocultado
                            //$('#validacion').slideUp(5000); //oculta de abajo hacia arriba
                            setTimeout(function(){ //INICIO UN RELOJ 
                            $('#mensaje').html('').show();//OCULTO EL MENSAJE
                            },5000);
                            document.getElementById("usuario").value = "";
                        } else {
                            $('#mensaje').html('').show();
                            setTimeout(function(){ //INICIO UN RELOJ 
                            $('#mensaje').html('').show();//OCULTO EL MENSAJE
                            },5000);
                        }
                    }, error: function() {
                        alert('Error archivo no encontrado...');
                    }
		        });	
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
        <P SIZE="5" align='center'>AGREGAR USUARIO</P>
        <div id = "principal">
            <form name = "forma01">
                <label for = "usuario">Usuario<input id = "usuario" type = "text" name = "usuario" onBlur="validaUsuario(value);"/></label><br>
                <div class="div2" id="mensaje" style="color:#F00; font-size:16px;" ></div><br>
                <label for = "nombre">Nombre<input type = "text" name = "nombre"/></label><br>
                <label for = "precio">Password<input type = "password" name = "pass"/></label><br>
                <label for = "cargo">Cargo &nbsp<select name = cargo>
                    <option value="0">Selecciona</option>
                    <option value="1">Gerente</option>
                    <option value="2">Ventas</option>
                    <option value="3">Almacén</option><br>
                </select></label>
                <div class="div2" id="mensaje2" style="color:#F00; font-size:16px; margin-top : 10px;" ></div><br>
                <div id = "divBoton"> 
                    <input type = "submit" class = "boton" onclick = "validar(); return false;" value = "Agregar"></input>
                </div>
            </form> 
        </div>
        <div id="divBoton">
            <a href = "mostrarUsuarios.php"><button class = "boton">Cancelar</button>
        </div>
    </body>
</html>