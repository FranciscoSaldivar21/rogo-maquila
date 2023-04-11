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
    <title>Edicion material</title>
</head>
<script src="../jquery-3.3.1.min.js"></script>
<script>
    function validar() {
        var descripcion = document.forma01.descripcion.value;
        var idProveedor = document.forma01.idProveedor.value;
        var precio = document.forma01.precio.value;
        var cantidad = document.forma01.cantidad.value;

        if (descripcion == '' || idProveedor == '' || precio == '' || cantidad == '0') {
            $('#mensaje2').html('Llene todos los campos').show();
            setTimeout(function() { //INICIO UN RELOJ 
                $('#mensaje2').html('').show(); //OCULTO EL MENSAJE EN 5 SEGUNDOS
            }, 5000);
        } else {
            if(cantidad <= 0){
                $('#mensaje2').html('Ingresa cantidad valida').show();
            setTimeout(function() { //INICIO UN RELOJ 
                $('#mensaje2').html('').show(); //OCULTO EL MENSAJE EN 5 SEGUNDOS
            }, 5000);
            }else{
                document.forma01.method = 'post';
                document.forma01.action = 'actualizaMaterial.php';
                document.forma01.submit();
            }
    }}


    function validaProveedor(idProveedor) { 
        if (idProveedor != "") {
            console.log("Entré2");
            $.ajax({
                url: 'verificaProveedor.php',
                type: 'post',
                dataType: 'text',
                data: 'idProveedor=' + idProveedor,
                success: function(data) {
                    if (!data) { //bandera
                        $('#mensaje').html('Error, el proveedor con id ' + idProveedor + ' no existe')
                        $('').show(); //Permite que se vuelva a mostrar despues de ser ocultado
                        //$('#correo').html('');
                        document.getElementById("idProveedor").value = "";
                        setTimeout(function() { //INICIO UN RELOJ 
                            $('#mensaje').html('').show(); //OCULTO EL MENSAJE
                        }, 5000);
                    } else if(data){
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
    <P SIZE="5" align='center'>EDICION MATERIAL</P>
    <?php
        require "conectaDB.php";
        $con = conecta();

        $id = $_REQUEST["id"];
        $sql = "SELECT * FROM material WHERE id = '$id'";
        $res = $con->query($sql);

        while ($row = $res->fetch_array()) {
            $descripcion = $row["descripcion"];
            $idProveedor = $row["idProveedor"];
            $cantidad = $row["cantidad"];
            $precio = $row["precio"];
            $unidad = $row["uniMed"];
            $cantidad = $cantidad.' '.$unidad;
            echo "<div id = \"principal\">";
                echo "<form name = \"forma01\">";
                    echo "<input hidden type = \"text\" name = \"uniMed\" value = \"$unidad\" id = \"uniMed\"/>";
                    echo "<label for = \"id\">ID<input readonly type = \"text\" name = \"id\" value = \"$id\" id = \"id\"/></label><br>";
                    echo "<label for = \"descripcion\">Descripcion<input type = \"text\" name = \"descripcion\" value = \"$descripcion\" id = \"descripcion\"/></label><br>";
                    echo "<label for = \"idProveedor\">ID Proveedor<input type = \"text\" onBlur = \"validaProveedor(value);\" name = \"idProveedor\" value = \"$idProveedor\" id = \"idProveedor\"/></label><br>";
                    echo "<div class=\"div2\" id=\"mensaje\" style=\"color:#F00; font-size:16px;\"></div><br>";
                    echo "<label for = \"precio\">Precio<input id = \"precio\" type = \"number\" name = \"precio\"  value = \"$precio\"/></label><br>";
                    echo "<label for = \"cantidad\">Existencia<input readonly id = \"cantidad\" type = \"text\" name = \"cantidad\"  value = \"$cantidad\"/></label><br>";
                    echo "<br>";
                    echo "<label for = \"salida\">Cantidad de salida<input id = \"inventario\" type = \"number\" name = \"inventario\"/></label><br>";
                    echo "<div class=\"div2\" id=\"mensaje2\" style=\"color:#F00; font-size:16px; margin-top : 10px;\"></div><br>"; //Mensaje de faltan campos
                    echo "<div id = \"divBoton\">";
                        echo "<input type = \"submit\" class = \"boton\" onclick = \"validar(); return false;\" value = \"Actualizar\"></input>";
                    echo "</div>";
                echo "</form>"; 
            echo "</div>";
        }
        ?>
    <div id="divBoton">
        <a href = "tablaMaterial.php"><button class = "boton">Regresar</button>
    </div>
</body>

</html>