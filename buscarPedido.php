<html>
    <script>
        function eliminaVenta(fila){
                if(confirm("¿Estás seguro?")){
                    $.ajax({
                        url : 'eliminaPedido.php',
                        type : 'post',
                        dataType : 'text', //Tipo de dato que recibe
                        data : 'idVenta='+fila, //Manda el id del material
                        success : function(bandera){
                            if(bandera){
                                window.location.href = 'tablaPedidos.php';
                            }else{
								alert('No se borro');
                            }
                        }, 
                        error : function(){
                            alert("No se encontro el archivo");
                        }
                    });
                }
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
        #detalles{

        }
    </style>
</html>
<?php
    require "conectaDB.php";
    $con = conecta();

    $salida = "";
    $query = "SELECT v.id,v.entregado,v.fecha,v.idProveedor,c.nombre FROM pedido v JOIN proveedor c ON c.id = v.idProveedor WHERE v.eliminado = 0";
    if(isset($_POST['consulta'])){
        $q = $con->real_escape_string($_POST['consulta']); //Palabra a buscar
        $query = "SELECT v.id,v.entregado,v.fecha,v.idProveedor,c.nombre FROM pedido v JOIN proveedor c ON c.id = v.idProveedor WHERE v.eliminado = 0 AND v.idProveedor LIKE '%".$q."%' OR c.nombre LIKE '%".$q."%'"; 
    }


    if($con->query($query)){
        $resultado = $con->query($query);
        if($resultado->num_rows > 0){
            $salida.="<table class = 'tabla_datos'>
                        <thead>
                            <tr>
                                <th>ID Pedido</th>
                                <th>Fecha</th>  
                                <th>Estatus</th>
                                <th>Cliente</th>
                                <th>Detalles</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                    <tbody>";
            while($fila = $resultado->fetch_assoc()){
                $id = $fila['id'];
                $estatus = $fila['entregado'];
                if($estatus == '0')
                    $estatus = 'En espera';
                else if($estatus == '1')
                    $estatus = "Entregado";

                $salida.="<tr>
                            <td>".$fila['id']."</td>
                            <td>".$fila['fecha']."</td>
                            <td>".$estatus."</td>
                            <td>".$fila['nombre']."</td>
                            <td><a id = \"detalles\" href = \"detallePedido.php?idPedido=$id\"><img src=\"imagenes/detalle.png\"></a></td>
                            <td><a  href = \"\" onclick = eliminaVenta($id)><img src=\"imagenes/borrar.png\"></a></td>
                        </tr>";
            }
            $salida.="</tbody></table>";
        }else{
            $salida.= "No hay datos";
        }
    }else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }

    echo $salida;
?>