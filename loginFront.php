<?php
    session_start();
    error_reporting(0);
    if ($_SESSION['usuario'] != '' || $_SESSION['password'] != null){
        if($_SESSION['rol'] == '1'){
            echo "<script>location.href='inicioGerente.php';</script>";
        }
        else if($_SESSION['rol'] == '2'){
            echo "<script>location.href='inicioVentas.php';</script>";
        }
        else if($_SESSION['rol'] == '3'){
            echo "<script>location.href='material.php';</script>";
        }
    }
?>
<html>
<head> 
    <title>LOGIN</title>
    <script src="../jquery-3.3.1.min.js"></script>
    <script>
    function validar() {
        var usuario = $('#usuario').val();
        var password = $('#pass').val();

        if (usuario == '' || password == '') {
            $('#mensaje').html('Llene todos los campos').show();
            setTimeout(function() { //INICIO UN RELOJ 
                $('#mensaje').html('').show(); //OCULTO EL MENSAJE EN 5 SEGUNDOS
            }, 5000);
        } else {
            $.ajax({
                url: 'loginBack.php',
                type: 'post',
                dataType: 'text',
                data: 'usuario='+usuario+'&pass='+password,
                success: function(bandera) {
                    if (bandera == 0) { //bandera
                        console.log(bandera);
                        $('#mensaje').html('Datos de inicio de sesion invalidos')
                    .show(); //Permite que se vuelva a mostrar despues de ser ocultado
                        //$('#validacion').slideUp(5000); //oculta de abajo hacia arriba
                        setTimeout(function() { //INICIO UN RELOJ 
                            $('#mensaje').html('').show(); //OCULTO EL MENSAJE
                        }, 5000);
                    } else if(bandera == 1){
                        window.location.href = "inicioGerente.php";
                        $('#mensaje').html('').show();
                        setTimeout(function() { //INICIO UN RELOJ 
                            $('#mensaje').html('').show(); //OCULTO EL MENSAJE
                        }, 5000);
                    } else if(bandera == 2){
                        window.location.href = "inicioVentas.php";
                        $('#mensaje').html('').show();
                        setTimeout(function() { //INICIO UN RELOJ 
                            $('#mensaje').html('').show(); //OCULTO EL MENSAJE
                        }, 5000);
                    } else if(bandera == 3){
                        window.location.href = "material.php";
                        $('#mensaje').html('').show();
                        setTimeout(function() { //INICIO UN RELOJ 
                            $('#mensaje').html('').show(); //OCULTO EL MENSAJE
                        }, 5000);
                    }
                },
                error: function() {
                    alert('Error archivo no encontrado...');
                }
            });
        }
    }
    </script>
    <style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:400);

    form {
        padding: 60px;
        max-width: 400px;
        background-color: #E7E7E7;
        margin: 0 auto;
    }

    form input,form textarea {
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

    #divBoton {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 50px;
    }

    #principal {
        display: flex;
        width: auto;
        justify-content: center;
        align-items: center;
        background-color: white;
    }

    .boton {
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

    .boton2 {
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
</head>

<body>
    <P SIZE="5" align='center'>LOGIN</P>
    <div id="principal">
        <form name="forma01">
            <label for="usuario">Usuario<input type="text" placeholder="Usuario" id="usuario"/></label><br>
            <label for="pass">Password<input type="password" id="pass" /></label><br>
            <div class="div2" id="mensaje" style="color:#F00; font-size:16px; margin-top : 10px;"></div><br>
            <div id="divBoton">
                <input type="submit" class="boton" onclick="validar(); return false;" value="Ingresar"></input>
            </div>
        </form>
    </div>
</body>

</html>