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
    <title>Edicion usuario</title>
</head>
<script src="../jquery-3.3.1.min.js"></script>
<script>
    function validar() {
        var usuario = document.forma01.user.value;
        var password = document.forma01.pass.value;
        var nombre = document.forma01.nombre.value;

        if (usuario == '' || password == '' || nombre == '') {
            $('#mensaje2').html('Llene todos los campos').show();
            setTimeout(function() { //INICIO UN RELOJ 
                $('#mensaje2').html('').show(); //OCULTO EL MENSAJE EN 5 SEGUNDOS
            }, 5000);
        } else {
            document.forma01.method = 'post';
			document.forma01.action = 'actualizaUsuario.php';
			document.forma01.submit();
    }}


    function validaUsuario(id,usuario) { 
        if (usuario != "") {
            console.log("Entré2");
            $.ajax({
                url: 'verificaUsuarioActualiza.php',
                type: 'post',
                dataType: 'text',
                data: 'id=' + id + '&usuario=' + usuario,
                success: function(bandera) {
                    console.log("La bandera es: "+ bandera);
                    if (bandera == 0) { //bandera
                        console.log(bandera);
                        $('#mensaje').html('Error, el usuario ' + usuario + ' ya existe')
                        $('').show(); //Permite que se vuelva a mostrar despues de ser ocultado
                        //$('#correo').html('');
                        document.getElementById("usuario").value = "";
                        setTimeout(function() { //INICIO UN RELOJ 
                            $('#mensaje').html('').show(); //OCULTO EL MENSAJE
                        }, 5000);
                    } else if(bandera == 1){
                        console.log(bandera);
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

    form input,
    form textarea {
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

<body>
    <P SIZE="5" align='center'>EDICION USUARIO</P>
    <?php
        require "conectaDB.php";
        $con = conecta();

        $id = $_REQUEST['id'];
        $sql = "SELECT * FROM usuarios WHERE id = '$id'";
        $res = $con->query($sql);

        while ($row = $res->fetch_array()) {
            $user = $row["usuario"];
            $nombre = $row["nombre"];
            $password = $row["password"];
            $cargo = $row["cargo"];
            if($cargo == '1')
                $cargo2 = "Gerente";
            else if($cargo == '2')
                $cargo2 = "Ventas";
            else if($cargo == '3')
                $cargo2 = "Almacén";
            echo "<div id = \"principal\">";
                echo "<form name = \"forma01\">";
                    echo "<input id=\"id\" name=\"idUsuario\" type=\"hidden\" value=\"$id\">";
                    echo "<label for = \"usuario\">Usuario<input type = \"text\" name = \"user\" value = \"$user\" id = \"user\" onBlur = \"validaUsuario($id,value);\"/></label><br>";
                    echo "<div class=\"div2\" id=\"mensaje\" style=\"color:#F00; font-size:16px;\"></div><br>";
                    echo "<label for = \"nombre\">Nombre<input type = \"text\" name = \"nombre\" value = \"$nombre\" id = \"nombre\"/></label><br>";
                    echo "<label for = \"pass\">Password<input required id = \"pass\" type = \"password\" name = \"pass\"/></label><br>";
                    echo "<label for = \"cargo\">Cargo &nbsp<select name = \"cargo\" id = \"cargo\">";
                        echo "<option selected=\"true\" value = \"$cargo\">$cargo2</option>";
                        echo "<option value=\"1\">Gerente</option>";
                        echo "<option value=\"2\">Ventas</option>";
                        echo "<option value=\"3\">Almacén</option><br>";
                    echo "</select></label>";
                    echo "<div class=\"div2\" id=\"mensaje2\" style=\"color:#F00; font-size:16px; margin-top : 10px;\"></div><br>"; //Mensaje de faltan campos
                    echo "<div id = \"divBoton\">";
                        echo "<input type = \"submit\" class = \"boton\" onclick = \"validar(); return false;\" value = \"Actualizar\"></input>";
                    echo "</div>";
                echo "</form>"; 
            echo "</div>";
        }
        ?>
    <div id="divBoton">
        <a href = "tablaProductos.php"><button class = "boton">Regresar</button>
    </div>
</body>

</html>