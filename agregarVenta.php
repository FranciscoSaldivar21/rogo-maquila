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
        <title>Nueva venta</title>
        <style>
            #datosCliente{
                width: 1400px;
                height: auto;
                text-align: center;
                margin: auto; 
            }
        </style>
        <script src="../jquery-3.3.1.min.js"></script>
        <script>
            //CONSTRUCTOR PARA PRODUCTOS A VENTA 
            var productos = [];
            function capturar(){
                function Producto(id,cantidad,precio){
                    this.id = id;
                    this.cantidad = parseInt(cantidad);
                    this.precio = precio;
                }
                var id = document.getElementById('idProducto').value;
                var cantidad = document.getElementById('cantidad').value;
                var precio = document.getElementById('precio').value;
                var producto = new Producto(id,cantidad,precio);
                
                descripcion = document.getElementById('descripcion').value;

                agregar(producto,descripcion,id,cantidad);
            }

            function agregar(producto,descripcion,id,cantidad){
                bandera = true;
                productos.forEach((producto) => {
                    if(producto.id == id){
                        producto.cantidad = parseInt(producto.cantidad)+parseInt(cantidad);
                        total = parseInt(producto.cantidad) + parseInt(producto.precio);
                        $('#cantidad').val('');
                        $('#idProducto').val('');
                        $('#descripcion').val('');
                        bandera = false;
                    }
                })
                    if(bandera == true){
                        productos.push(producto);
                        total = parseInt(producto.cantidad) * parseInt(producto.precio);
                        $('#cantidad').val('');
                        $('#idProducto').val('');
                        $('#descripcion').val('');
                    }
                console.log(productos);
                imprimeCarrito();
            }

            function imprimeCarrito(){
                total2 = 0;
                document.getElementById('tabla').innerHTML = "<thead><tr><th>ID PRODUCTO</th><th>Cantidad</th><th>Precio unitario</th><th>Total</th></tr></thead>";
                productos.forEach((producto) => {
                    total = parseInt(producto.cantidad) * parseInt(producto.precio);
                    total2 += total;
                    document.getElementById('tabla').innerHTML += "<tbody><td>"+producto.id+"</td><td>"+producto.cantidad+"</td><td>"+producto.precio+"</td><td>"+total+"</td>";
                })
                document.getElementById('tabla').innerHTML += "<tr><td>  TOTAL: $ "+total2+"</td></tr></tbody>";
            }

            function validaCliente(idCliente){
                $.ajax({
                        url : 'verificaCliente.php',
                        type : 'post',
                        dataType : 'text', //Tipo de dato que recibe
                        data : 'idCliente='+idCliente,
                        success : function(bandera){
                            if(bandera){
                                document.getElementById('idCliente').disabled = true;
                                $('#nombre').val(bandera);
                                document.getElementById('productoVenta').style.display = 'block';
                            }else{
                                $('#mensaje').html('Error, el cliente con id '+idCliente+' no existe').show(); //Permite que se vuelva a mostrar despues de ser ocultado
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

            function anadirProducto(){
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
                    capturar();
                    }
            }

            function terminarVenta(){
                cliente = $('#idCliente').val();
                $.ajax({
                    url : 'terminarVenta.php',
                    type : 'post',
                    dataType : 'JSON', //Tipo de dato que recibe
                    data : 'idCliente='+cliente,
                    success : function(data){
                        if(data.bandera){
                            productos.forEach((producto) => {
                                $.ajax({
                                    url : 'agregarProdVenta.php',
                                    type : 'post',
                                    dataType : 'text', //Tipo de dato que recibe
                                    data : {idVenta : data.idVenta, idProducto : producto.id, cantidad : producto.cantidad, precio : producto.precio},
                                    success : function(bandera){
                                        if(bandera){
                                            console.log("Agregado con exito");
                                        }
                                    }, 
                                    error : function(){
                                        alert("No se encontro el archivo");
                                        return;
                                    }
                                });
                            })
                            window.location.href = "tablaVentas.php";
                        }else{
                            alert("Hubo un error inesperado");
                        }
                    }, 
                    error : function(){
                        alert("No se encontro el archivo");
                    }
                });
            }
        
            function abrirClientes(){
                strCaracteristicasVentana = "menubar=false,location=false,resizable=false,scrollbars=no,status=no,width=800px,height=400,right=400px";
                ventana = window.open("tablaClientes.php","clientes",strCaracteristicasVentana);
            }
            function abrirProductos(){
                strCaracteristicasVentana = "menubar=false,location=false,resizable=false,scrollbars=no,status=no,width=800px,height=400,right=400px";
                ventana = window.open("tablaProductos.php","clientes",strCaracteristicasVentana);
            }
        </script>
        <style>
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
            #divBoton{
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 50px;
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
                background-color: #13D520;
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
                background-color: #C62D0B;
                border-radius: 5px;
                border: 0px;
            }
            table, th, td {
                margin: auto;
                border: 0;
                background-color: white;
            }
            th,td{
                padding: 10px;
            }
            th{
                background-color: #A3A8A0;
                color: white;
            }
            td{
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <?php include('menuGerente.php'); ?>
        <div id = "datosCliente">
            <form name = "forma01">
                <label for = "idCliente">ID Cliente <input type = "text" id = "idCliente" onBlur = "validaCliente(value);"></label>
                <input id = "botonClientes" style = "padding: 5px;"value = "Mostrar Clientes" type = "submit" onclick = "abrirClientes();">
                <label for = "cliente">Nombre del cliente <input disabled type = "text" id = "nombre"></label>
            </form>
        </div>
        <div style = "display:none;" id = "productoVenta">
            <label for = "idProducto">ID Producto <input type = "text" id = "idProducto" onBlur = "validaProducto(value);"></label>
            <label for = "descripcion">Descripcion Producto <input disabled type = "text" id = "descripcion"></label>
            <label for = "precio">Precio <input disabled type = "number" id = "precio"></label>
            <label for = "cantidad">Cantidad <input disabled type = "number" id = "cantidad"></label>
            <input id = "agregarProducto" style = "padding: 5px;"value = "Agregar" type = "submit" onclick = "anadirProducto();">
            <input id = "botonProductos" style = "padding: 5px;"value = "Mostrar Productos" type = "submit" onclick = "abrirProductos();">
        </div>
        <div class="div2" id="mensaje" style="color:#F00; font-size:16px;" ></div><br>
        <div class = "container">
            <table class = "tabla" id = "tabla">
                <thead class = "thead-inverse">
                    <tr>
                        <th>ID PRODUCTO</th>
                        <th>Cantidad</th>
                        <th>Precio unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <div id="divBoton">
            <a><button onclick = "terminarVenta();" class = "boton">Guardar</button></a>
            <a href='tablaVentas.php'><button id = "boton2">Cancelar</button></a>
        </div>
    </body>
</html>