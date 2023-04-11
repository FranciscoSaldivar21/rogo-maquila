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
    <title>Edicion proveedor</title>
</head>
<script src="../jquery-3.3.1.min.js"></script>
<script>
    function validar() {
        var nombre = document.forma01.nombre.value;
        var telefono = document.forma01.telefono.value;
        var correo = document.forma01.correo.value;

        if (nombre == '' || telefono == '' || correo == '') {
            $('#mensaje2').html('Llene todos los campos').show();
            setTimeout(function() { //INICIO UN RELOJ 
                $('#mensaje2').html('').show(); //OCULTO EL MENSAJE EN 5 SEGUNDOS
            }, 5000);
        } else {
            document.forma01.method = 'post';
			document.forma01.action = 'actualizaProveedor.php';
			document.forma01.submit();
    }}

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
    <P SIZE="5" align='center'>EDICION PROVEEDOR</P>
    <?php
        require "conectaDB.php";
        $con = conecta();

        $id = $_REQUEST['id'];
        $sql = "SELECT * FROM proveedor WHERE id = '$id'";
        $res = $con->query($sql);

        while ($row = $res->fetch_array()) {
            $telefono = $row["telefono"];
            $nombre = $row["nombre"];
            $correo = $row["correo"];
            echo "<div id = \"principal\">";
                echo "<form name = \"forma01\">";
                    echo "<input id=\"id\" name=\"idProveedor\" type=\"hidden\" value=\"$id\">";
                    echo "<label for = \"nombre\">Nombre<input type = \"text\" name = \"nombre\" value = \"$nombre\" id = \"nombre\"/></label><br>";
                    echo "<label for = \"correo\">Correo<input type = \"text\" name = \"correo\" value = \"$correo\" id = \"correo\"/></label><br>";
                    echo "<label for = \"telefono\">Telefono<input pattern=\"[0-9]{3}-[0-9]{2}-[0-9]{3}\" required id = \"telefono\" type = \"tel\" name = \"telefono\"  value = \"$telefono\"/></label><br>";
                    echo "<div class=\"div2\" id=\"mensaje2\" style=\"color:#F00; font-size:16px; margin-top : 10px;\"></div><br>"; //Mensaje de faltan campos
                    echo "<div id = \"divBoton\">";
                        echo "<input type = \"submit\" class = \"boton\" onclick = \"validar(); return false;\" value = \"Actualizar\"></input>";
                    echo "</div>";
                echo "</form>"; 
            echo "</div>";
        }
        ?>
    <div id="divBoton">
        <a href = "tablaProveedor.php"><button class = "boton">Regresar</button>
    </div>
</body>

</html>