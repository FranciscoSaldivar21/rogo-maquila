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
        <title>Registro material</title>
    </head>
    <script src="../jquery-3.3.1.min.js"></script>
    <script>
        function validaProveedor(codigo){
            $.ajax({
                    url : 'verificaProveedor.php',
                    type : 'post',
                    dataType : 'text', //Tipo de dato que recibe
                    data : 'idProveedor='+codigo,
                    success : function(data){
                        if(data){
                            $("#nombre").val(data);
                            document.getElementById('nombre').type = 'text';
                        }else{
                            $("#idProveedor").val('');
                            $('#mensaje2').html('Error, el proveedor con id '+codigo+' no existe').show(); //Permite que se vuelva a mostrar despues de ser ocultado
                            //$('#validacion').slideUp(5000); //oculta de abajo hacia arriba
                            setTimeout(function(){ //INICIO UN RELOJ 
                                $('#mensaje2').html('').show();//OCULTO EL MENSAJE
                            },5000);
                        }
                    }, 
                    error : function(){
                        alert("No se encontro el archivo");
                    }
            });
        }
        function validar(){
            var material = document.forma01.material.value;
            var uniMed = document.forma01.uniMed.value;
            var cantidad = document.forma01.cantidad.value;
            var idProveedor = document.forma01.idProveedor.value;
            var color = document.forma01.color.value;
            var precio = document.forma01.precio.value;


            if(material == '' || uniMed == ''|| cantidad == '' || idProveedor == '' || color == '' || precio == ''){
                $('#mensaje2').html('Llene todos los campos').show();
                setTimeout(function(){ //INICIO UN RELOJ 
                $('#mensaje2').html('').show();//OCULTO EL MENSAJE EN 5 SEGUNDOS
                },5000);
            }
            else{
                if(cantidad < 0 || precio < 1){
                    $('#mensaje2').html('Ingrese cantidad valida').show();
                    setTimeout(function(){ //INICIO UN RELOJ 
                    $('#mensaje2').html('').show();//OCULTO EL MENSAJE EN 5 SEGUNDOS
                    },5000);
                }else{
                    document.forma01.method = 'post';
                    document.forma01.enctype = 'multipart/form-data';
                    document.forma01.action = 'registroMaterial.php';
                    document.forma01.submit();
                }
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
        <P SIZE="5" align='center'>AGREGAR MATERIAL</P>
        <div id = "principal">
            <form name = "forma01">
                <label for = "material">Descripcion material<input type = "text" name = "material"/></label><br>
                <label for = "color">Color<input type = "text" name = "color"/></label><br>
                <label for = "precio">Precio por unidad de medida<input type = "number" name = "precio"/></label><br>
                <label for = "cantidad">Cantidad<input type = "number" name = "cantidad"/></label><br>
                <label for = "uniMed">Unidad de medida <input type = "text" name = "uniMed"/></label><br>
                <label for = "proveedor">ID proveedor<input onblur = "validaProveedor(this.value)" id = 'idProveedor' type = "text" name = "idProveedor"/></label><br>
                <label for = "nombre">Nombre proveedor<input disabled type = "hidden" id = "nombre" name = "nombre"/></label><br>
                <div class="div2" id="mensaje2" style="color:#F00; font-size:16px; margin-top : 10px;" ></div><br>
                <div id = "divBoton"> 
                    <input type = "submit" class = "boton" onclick = "validar(); return false;" value = "Agregar"></input>
                </div>
            </form> 
        </div>
        <div id="divBoton">
            <a href = "tablaMaterial.php"><button class = "boton">Cancelar</button>
        </div>
    </body>
</html>