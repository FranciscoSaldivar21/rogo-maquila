<html>
    <script src="../jquery-3.3.1.min.js"></script>
    <script>
        function agregaMaterial(idMaterial,idPedido,fila, precio){
            cantidad = document.getElementById('fila'+fila).value;
            if(cantidad < 1){
                $('#mensaje').html('Ingresa cantidad valida').show(); 
                setTimeout(function(){ //INICIO UN RELOJ 
                    $('#mensaje').html('').show();//OCULTO EL MENSAJE
                },5000);
                $('#fila'+fila).val('');
                return;
            }
            $.ajax({
                url : 'agregarMaterialPedido.php',
                type : 'post',
                dataType : 'text', //Tipo de dato que recibe
                data : {idMaterial : idMaterial, idPedido : idPedido, cantidad : cantidad, precio : precio},
                success : function(bandera){
                    buscaMaterialPedido(idPedido);
                    if(bandera){
                        $('#fila'+fila).val('');
                    }else{
                        $('#mensaje').html('Error al ingresar el material').show(); //Permite que se vuelva a mostrar despues de ser ocultado
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

        function buscaMaterialPedido(idPedido){
            $.ajax({
                    url : "buscarMaterialPedido.php",
                    type : 'POST',
                    dataType : 'html',
                    data: {idPedido: idPedido},
                })
                .done(function(respuesta){
                    $("#datos").html(respuesta);
                })
                .fail(function(respuesta){
                    console.log("error");
                })
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
        thead{
            height: 30px;
        }
        #datos{
                width: 1500px;
                height: auto;
                text-align: center;
                margin: auto; 
        }
        .tabla_datos{
            margin-top: 50px;
        }
    </style>
    <body>
        <section class = "principal">
            <div id = "datos">

            </div>
        </section>
    </body>
</html>
<?php
    require "conectaDB.php";
    $con = conecta();

    $salida = "";
    $idProveedor = $_REQUEST['idProveedor'];
    $idPedido = $_REQUEST['idPedido'];
    $query = "SELECT * FROM material WHERE eliminado = 0 AND '$idProveedor' = idProveedor";

    $resultado = $con->query($query);

    if($resultado->num_rows > 0){
        $salida.="<table class = 'tabla_datos'>
                    <thead>
                        <tr>
                            <td colspan = \"7\"><b>PRODUCTOS DISPONIBLES</b></td>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descripcion</th>  
                            <th>Inventario</th>
                            <th>Unidad de medida</th>
                            <th>Precio por unidad</th>
                            <th>Cantidad</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                <tbody>";
        $i = 0;
        while($fila = $resultado->fetch_assoc()){
            $id = $fila['id'];
            $precio = $fila['precio'];
            $fila2 = 'fila'.$i;
            $salida.="<tr>
                        <td>".$fila['id']."</td>
                        <td>".$fila['descripcion']."</td>
                        <td>".$fila['cantidad'].' '.$fila['uniMed']."</td>
                        <td>".$fila['uniMed']."</td>
                        <td>$".$fila['precio']."</td>
                        <td><input type = \"number\" id = \"$fila2\"</td>
                        <td><img onclick = agregaMaterial($id,$idPedido,$i,$precio) src=\"imagenes/agregar.png\"></td>
                    </tr>";
            $i = intval($i) + 1;
        }
        $salida.="</tbody></table>";
        $salida.="<div class=\"div2\" id=\"mensaje\" style=\"color:#F00; font-size:16px;\"></div><br>";
    }else{
        $salida.= "No hay datos";
    }
#hacer json_encode con las dos salidas
    echo $salida;
?>