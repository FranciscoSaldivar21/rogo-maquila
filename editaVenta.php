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
    <script src="../jquery-3.3.1.min.js"></script>
    <script>
        function validaProducto(codigo){
            $.ajax({
                    url : 'verificaProducto.php',
                    type : 'post',
                    dataType : 'JSON', //Tipo de dato que recibe
                    data : 'codigo='+codigo,
                    success : function(data){
                        if(data.bandera){
                            $("#precio").val(data.precio);
                            $("#descripcion").val(data.descripcion);
                            document.getElementById('cantidad').disabled = false;
                        }else{
                            $("#idProducto").val('');
                            $("#precio").val('');
                            $("#descripcion").val('');
                            $('#mensaje').html('Error, el producto con codigo '+codigo+' no existe').show(); //Permite que se vuelva a mostrar despues de ser ocultado
                            //$('#validacion').slideUp(5000); //oculta de abajo hacia arriba
                            setTimeout(function(){ //INICIO UN RELOJ 
                                $('#mensaje').html('').show();//OCULTO EL MENSAJE
                            },5000);
                        }
                    }, 
                    error : function(){
                        alert("No se encontro el archivo");
                    }
                });
        }

        function anadirProducto(idVenta){
            idProducto = document.getElementById('idProducto').value;
            cantidad = document.getElementById('cantidad').value;
            precio = document.getElementById('precio').value;

            if(cantidad < 1){
                $('#mensaje').html('Error ingresa cantidad valida').show();
                setTimeout(function(){ //INICIO UN RELOJ 
                    $('#mensaje').html('').show();//OCULTO EL MENSAJE
                },5000);
            }
            else if(idProducto == '' || cantidad == ''){
                $('#mensaje').html('Error llene todos los campos de la compra').show();
                setTimeout(function(){ //INICIO UN RELOJ 
                    $('#mensaje').html('').show();//OCULTO EL MENSAJE
                },5000);
            }else{
                $.ajax({
                        url : 'agregarProdVenta.php',
                        type : 'post',
                        dataType : 'JSON', //Tipo de dato que recibe
                        data : {idProducto : idProducto, idVenta: idVenta, cantidad: cantidad, precio: precio},
                        success : function(data){
                            if(data.bandera){
                                $("#idProducto").val('');
                                $("#cantidad").val('');
                                $("#precio").val('');
                                $("#descripcion").val('');
                                var x = document.getElementById("formulario");
                                x.style.display = 'none';
                                location.reload();
                            }else{
                                $('#mensaje').html('Error').show(); //Permite que se vuelva a mostrar despues de ser ocultado
                                //$('#validacion').slideUp(5000); //oculta de abajo hacia arriba
                                setTimeout(function(){ //INICIO UN RELOJ 
                                    $('#mensaje').html('').show();//OCULTO EL MENSAJE
                                },5000);
                            }
                        }, 
                        error : function(){
                            alert("No se encontro el archivo");
                        }
                    });
                }
        }
        function nuevoProducto(){
            var x = document.getElementById("formulario");
            x.style.display = 'block';
        }
        function guardarVenta(idVenta,estatus){
            var estatusNuevo = document.getElementById("estatus").value;
            if(estatus == '3'){
                $('#mensaje').html('No se puede modificar porque la venta está terminada').show();
                setTimeout(function(){ //INICIO UN RELOJ 
                    $('#mensaje').html('').show();//OCULTO EL MENSAJE
                },5000);
            }else{
                window.location.href='actualizaVenta.php?estatus='+estatusNuevo+'&idVenta='+idVenta;
            }
        }
        function guardarProducto(idProducto, idVenta, fila){
            var cantidad = $("#cantidad"+fila).val();
            if(cantidad < 1){
                $('#mensaje').html('Ingresa cantidad correcta').show();
                setTimeout(function(){ //INICIO UN RELOJ 
                    $('#mensaje').html('').show();//OCULTO EL MENSAJE
                },5000);
            }
            $.ajax({
                    url : 'guardarProductoVenta.php',
                    type : 'post',
                    dataType : 'text', //Tipo de dato que recibe
                    data : {idVenta : idVenta, idProducto : idProducto, cantidad: cantidad},
                    success : function(bandera){
                        if(bandera){
                            location.reload();
                            $('#mensaje').html('Se actualizó la venta').show();
                            setTimeout(function(){ //INICIO UN RELOJ 
                                $('#mensaje').html('').show();//OCULTO EL MENSAJE
                            },5000);
                        }else{
                            $('#mensaje').html('Error al actualizar').show(); 
                            setTimeout(function(){ //INICIO UN RELOJ 
                                $('#mensaje').html('').show();//OCULTO EL MENSAJE
                            },5000);
                        }
                    }, 
                    error : function(){
                        alert("No se encontro el archivo");
                    }
                });
        }

        function quitarProducto(idProducto, idVenta, fila){
            $.ajax({
                    url : 'quitarProductoVenta.php',
                    type : 'post',
                    dataType : 'text', //Tipo de dato que recibe
                    data : {idVenta : idVenta, idProducto : idProducto},
                    success : function(bandera){
                        if(bandera){
                            $('#fila').html('').hide();
                            $('#mensaje').html('Se quitó de la venta').show(); //Permite que se vuelva a mostrar despues de ser ocultado
                            //$('#validacion').slideUp(5000); //oculta de abajo hacia arriba
                            setTimeout(function(){ //INICIO UN RELOJ 
                                $('#mensaje').html('').show();//OCULTO EL MENSAJE
                            },5000);
                        }else{
                            $('#mensaje').html('Error al quitar').show(); //Permite que se vuelva a mostrar despues de ser ocultado
                            //$('#validacion').slideUp(5000); //oculta de abajo hacia arriba
                            setTimeout(function(){ //INICIO UN RELOJ 
                                $('#mensaje').html('').show();//OCULTO EL MENSAJE
                            },5000);
                        }
                    }, 
                    error : function(){
                        alert("No se encontro el archivo");
                    }
                });
        }
        function abrirProductos(){
                strCaracteristicasVentana = "menubar=false,location=false,resizable=false,scrollbars=no,status=no,width=800px,height=400,right=400px";
                ventana = window.open("tablaProductos.php","clientes",strCaracteristicasVentana);
            }
    </script>
    <style>
        table {
            width:1100px;
            font:normal 13px Arial;
            text-align:center;
            border-collapse:collapse;
            margin: auto;
        }
        table th{
            font: 13px Arial;
            background-color:#DADADA;
            text-align: center;
        }
        table td{
            background-color:white;
            height: 60px;
        }
        img{
            width: 30px;
            height: 30px;
        }
        #img2{
            width: 60px;
            height: 60px;
            margin: 8px;
        }
        thead{
            height: 30px;
        }
        .boton {
            color: white;
            padding: 8px 8px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 7px;
            cursor: pointer;
            background-color: #C62D0B;
            border-radius: 5px;
            border: 0px;
        }
            
        #boton2 {
            color: white;
            padding: 8px 8px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 7px;
            cursor: pointer;
            background-color: #13D520;
            border-radius: 5px;
            border: 0px;
        }
        #boton3{
            color: black;
            padding: 11px 11px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 7px;
            cursor: pointer;
            background-color: #69C3FF;
            border-radius: 5px;
            border: 0px;
        }
        #divBoton{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 50px;
        }
        #formulario{
            display: none;
            margin-top: 50px;
            width: 1700px;
            height: auto;
            text-align: center;
        }
        input{
                height: 30px;
                margin: 5px;
                margin-left: 5px;
                border-radius: 5px;
            }
        label{
            font-size: 16px;
            margin-left: 15px;
        }
        #inputTotal{
                width: 80px;
                height: 30px;
                margin: 5px;
                margin-left: 5px;
                border-radius: 5px;
                border : 0;
            }
    </style>
</html>
<?php
    require "conectaDB.php";
    require "menuGerente.php";
    $con = conecta();
    $idVenta = $_REQUEST['idVenta'];
    $query = "SELECT v.fecha,v.idCliente,c.nombre,v.estatus FROM ventas v JOIN clientes c ON c.id = v.idCliente WHERE v.id = '$idVenta'";
    $resultado = $con->query($query);

    if($con->query($query)){
        echo "<table class = 'tabla_datos'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>ID venta</th>";
                    echo "<th>Fecha</th>  ";
                    echo "<th>ID Cliente</th>";
                    echo "<th>Cliente</th>";
                    echo "<th>Estatus actual</th>";
                    echo "<th>Nuevo estatus</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
        while($fila = $resultado->fetch_assoc()){
            //0 en espera- 1 fabricando- 2 listo para entrega- 3 entregado
            $estatus = $fila['estatus']; 
            $estatus2 = $estatus;
            //$estatus = ($estatus == '0') ? 'En espera' : ($estatus == '1') ? 'Fabricando' : ($estatus == '2') ? 'Terminado' : 'Entregado';
            if($estatus == '0')
                $estatus = 'En espera';
            else if($estatus == '1')
                $estatus = 'Frabricando';
            else if($estatus == '2')
                $estatus = 'Listo para entrega';
            else 
                $estatus = 'Entregado';  


            echo "<tr>";
                echo "<td>".$idVenta."</td>";
                echo "<td>".$fila['fecha']."</td>";
                echo "<td>".$fila['idCliente']."</td>";
                echo "<td>".$fila['nombre']."</td>";
                echo "<td>".$estatus."</td>";
                echo "<td><select id = \"estatus\">";
                    echo "<option value=\"0\">En espera</option>";
                    echo "<option value=\"1\">Fabricando</option>";
                    echo "<option value=\"2\">Terminado</option>";
                    echo "<option value=\"3\">Entregado</option><br>";
                echo "</select></td>";

            echo "</tr>";
        }
        echo "</tbody></table>";
    }
    else{
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
    
    $query = "SELECT d.idProducto,d.precio,d.cantidad,p.imagen,p.descripcion FROM detalleventa d JOIN productos p ON d.idProducto = p.id WHERE d.idVenta = '$idVenta'";
    $resultado = $con->query($query);
    if($con->query($query)){
        echo "<table style = \"margin-top: 20px;\" class = 'tabla_datos2' id = 'tabla_datos2'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<td colspan = \"8\"><b>PRODUCTOS</b></td>";
                echo "</tr>";
            echo "</thead>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>Imagen</th>";
                    echo "<th>ID Producto</th>  ";
                    echo "<th>Descripcion</th>";
                    echo "<th>Cantidad anterior</th>";
                    echo "<th>Cantidad nueva</th>";
                    echo "<th>Precio</th>";
                    echo "<th>Costo</th>";
                    echo "<th>Accion</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            $total = 0;
            $row = 0;
        while($fila = $resultado->fetch_assoc()){  
            $costo = intval($fila['precio']) * intval($fila['cantidad']);
            $total = intval($total) + intval($costo);
            $cantidad = intval($fila['cantidad']);
            $idProducto = $fila['idProducto'];
            $concatenacion = 'cantidad'.$row;
            echo "<tr id = \"$row\">";
                echo "<td><img id = \"img2\"src = \"imagenes/".$fila['imagen']."\"</td>";
                echo "<td>".$fila['idProducto']."</td>";
                echo "<td>".$fila['descripcion']."</td>";
                echo "<td>".$fila['cantidad']."</td>";
                echo "<td><input type = \"number\" id = \"$concatenacion\" value = \"$cantidad\"></td>";
                echo "<td>".$fila['precio']."</td>";
                echo "<td>$".$costo."</td>";
                echo "<td><a href = \"#\"><img style = \"width : 20px; height : 20px; margin : 5px;\"onclick = \"quitarProducto($idProducto, $idVenta, $row);\"src = \"imagenes/quitar.png\"></a><a href = \"#\"><img style = \"margin-left: 10px; margin-top : 10px; width : 30px; height : 30px;\" onclick = \"guardarProducto($idProducto,$idVenta,$row)\" src = \"imagenes/guardar.png\"></a></td>";
            echo "</tr>";
            $row = $row + 1;
        }
        echo "<tr><td><b>TOTAL: </b></td><td>$$total</td></tr>";
        echo "</tbody></table>";
        echo "<div id = \"formulario\">";
            echo "<label for = \"idProducto\">ID Producto <input type = \"text\" id = \"idProducto\" onBlur = \"validaProducto(value);\"></label>";
            echo "<label for = \"descripcion\">Descripcion Producto <input disabled type = \"text\" id = \"descripcion\"></label>";
            echo "<label for = \"precio\">Precio <input disabled type = \"number\" id = \"precio\"></label>";
            echo "<label for = \"cantidad\">Cantidad <input disabled type = \"number\" id = \"cantidad\"></label>";
            echo "<input id = \"agregarProducto\" style = \"padding: 5px;\"value = \"Añadir a venta\" type = \"submit\" onclick = \"anadirProducto($idVenta);\">";
            echo "<input id = \"botonProductos\" style = \"padding: 5px;\"value = \"Mostrar Productos\" type = \"submit\" onclick = \"abrirProductos();\">";
            #echo "<div class=\"div2\" id=\"mensaje\" style=\"color:#F00; font-size:16px;\" ></div><br>";
        echo "</div>";

        echo "<div class=\"div2\" id=\"mensaje\" style=\"text-align: center; color:#F00; margin-top: 30px; font-size:16px;\"></div><br>";
        echo "<div id=\"divBoton\">";
            echo "<button onclick = \"nuevoProducto();\"id = \"boton3\">Agregar producto</button>";
        echo "</div>";
        echo "<div id=\"divBoton\">";
            echo "<button onclick = \"guardarVenta($idVenta,$estatus2);\"id = \"boton2\">Guardar</button>";
            echo "<a href = \"tablaVentas.php\"><button class = \"boton\">Cancelar</button></a>";
        echo "</div>";
    }
?>