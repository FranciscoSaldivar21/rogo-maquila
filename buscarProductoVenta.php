<html>
    <script src="../jquery-3.3.1.min.js"></script>
    <script>
        function eliminaProducto(idDetalle,venta){ 
            if(confirm("¿Estás seguro?")){
                $.ajax({
                    url : 'eliminaProductoVenta.php',
                    type : 'post',
                    dataType : 'text', //Tipo de dato que recibe
                    data : {idDetalle: idDetalle}, 
                    success : function(bandera){
                        $("#"+idDetalle).remove();
                        obtenTotal(venta);
                    }, 
                    error : function(){
                        alert("No se encontro el archivo");
                    }
                });
            }
        }

        function obtenTotal(venta){ 
                $.ajax({
                    url : 'obtenTotal.php',
                    type : 'post',
                    dataType : 'text', //Tipo de dato que recibe
                    data : {idVenta: venta}, 
                    success : function(total){
                        if(total != 0){
                            document.getElementById('total').style.display = 'table-row';
                            document.getElementById('total1').style.display = 'table-row';
                        }
                        $("#total").val(' $ '+total);
                    }, 
                    error : function(){
                        alert("No se encontro el archivo");
                    }
                });
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
    </style>
</html>
<?php
    require "conectaDB.php";
    $con = conecta();
    $idVenta = $_REQUEST['idVenta'];
    $salida = "";
    $sql = "SELECT d.id,d.idProducto,d.cantidad,d.precio,p.imagen,p.descripcion FROM detalleventa d JOIN productos p ON d.idProducto = p.id where d.idVenta = '$idVenta'";

    $salida.="<table class = 'tabla_datos'>
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>ID Producto</th>  
                        <th>Descripcion</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Eliminar</th>
                        <th>Total</th>
                    </tr>
                </thead>
            <tbody>";
    
    if($resultado = $con->query($sql)){
        while($fila = $resultado->fetch_assoc()){
            $id = $fila['id'];
            $precio = $fila['precio'];
            $cantidad = $fila['cantidad'];
            $total = intval($precio) * intval($cantidad);
                $salida.="<tr id=\"$id\">
                            <td><img style = \"margin-top: 8px; height: 60px; width: 60px;\"id = \"img2\" src = \"imagenes/".$fila['imagen']."\"></td>
                            <td>".$fila['idProducto']."</td>
                            <td>".$fila['descripcion']."</td>
                            <td>".$fila['cantidad']."</td>
                            <td>".$fila['precio']."</td>
                            <td><img onclick = eliminaProducto($id,$idVenta) src=\"imagenes/borrar.png\"></td>
                            <td>".$total."</td>
                        </tr>";
        }
    }
    $salida.="<tr id = \"total1\" style = \" display: none;\"><td><label>TOTAL: <input disabled style = \"border: 0; width: 80px; display: none;\" id = \"total\"></label></td></tr>";
    $salida.="</tbody></table>";

    echo $salida;
?>
<script language="javascript">obtenTotal(<?php echo $idVenta;?>);</script> 