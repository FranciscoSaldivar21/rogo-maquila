<html>
    <script src="../jquery-3.3.1.min.js"></script>
    <script type = "text/javascript">

        function borrarMaterial(idDetalle){ 
            if(confirm("¿Estás seguro?")){
                $.ajax({
                    url : 'eliminaMaterialPedido.php',
                    type : 'post',
                    dataType : 'text', //Tipo de dato que recibe
                    data : {idDetalle: idDetalle}, 
                    success : function(total){
                        var total1 = $("#total").val();
                        $("#"+idDetalle).remove();
                        $("#total").val(total1-total);
                    }, 
                    error : function(){
                        alert("No se encontro el archivo");
                    }
                });
            }
        }
    </script>
</html>
<?php
    require "conectaDB.php";
    $con = conecta();

    $salida = "";
    $idPedido = $_REQUEST['idPedido'];
    $query = "SELECT d.id,d.precio,d.cantidad,d.total,m.descripcion FROM detallepedido d JOIN material m ON d.idMaterial = m.id WHERE '$idPedido' = d.idPedido";
    
    if($resultado = $con->query($query)){
        if($resultado->num_rows > 0){
            $salida.="<table class = 'tabla_datos'>
                        <thead>
                            <tr>
                                <td colspan = \"5\"><b>PRODUCTOS AGREGADOS</b></td>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th>Descripcion</th>  
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Total</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                    <tbody>";
            $total2 = 0;
            while($fila = $resultado->fetch_assoc()){
                $id = $fila['id'];
                $total2 = intval($total2) + intval($fila['total']);
                $precio = $fila['precio'];
                $cantidad = $fila['cantidad'];
                $salida.="<input type = \"hidden\" id = \"idPedido\" value = \"$idPedido\">
                        <tr id = \"$id\">
                            <td>".$fila['descripcion']."</td>
                            <td>".$fila['cantidad']."</td>
                            <td>".$fila['precio']."</td>
                            <td>$".$fila['total']."</td>
                            <td><img onclick = borrarMaterial($id) src=\"imagenes/borrar.png\"></td>
                        </tr>";
            }
            $salida.="</tbody></table>";
            $salida.="<div id = \"divTotal\"><br>TOTAL: <input id = \"total\" value = \"$total2\"disabled></div>";
        }else{
            $salida.= "No hay datos";
        }
    }else{
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
#hacer json_encode con las dos salidas
    echo $salida;
?>