<html>
    <script src="../jquery-3.3.1.min.js"></script>
    <script>
        function editarVenta(estatus, idVenta){
            if(estatus != '3'){
                $(location).attr('href','editaVenta.php?idVenta='+idVenta);
            }else
                alert("La venta solo se puede editar cuando el estatus esta en espera");
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
        #divBoton{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 50px;
        }
    </style>
</html>
<?php
    require "conectaDB.php";
    require "menuGerente.php";
    $con = conecta();
    $idVenta = $_REQUEST['idVenta2'];
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
                    echo "<th>Estatus</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
        while($fila = $resultado->fetch_assoc()){
            //0 en espera- 1 fabricando- 2 terminado- 3 entregado
            $estatus = $fila['estatus']; 
            $estatus2 = $estatus;
            //$estatus = ($estatus == '0') ? 'En espera' : ($estatus == '1') ? 'Fabricando' : ($estatus == '2') ? 'Terminado' : 'Entregado';
            if($estatus == '0')
                $estatus = 'En espera';
            else if($estatus == '1')
                $estatus = 'En proceso';
            else if($estatus == '2')
                $estatus = 'Terminado';
            else 
                $estatus = 'Entregado';  


            echo "<tr>";
                echo "<td>".$idVenta."</td>";
                echo "<td>".$fila['fecha']."</td>";
                echo "<td>".$fila['idCliente']."</td>";
                echo "<td>".$fila['nombre']."</td>";
                echo "<td>".$estatus."</td>";

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
        echo "<table style = \"margin-top: 20px;\" class = 'tabla_datos2'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<td colspan = \"6\">PRODUCTOS</td>";
                echo "</tr>";
            echo "</thead>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>Imagen</th>";
                    echo "<th>ID Producto</th>  ";
                    echo "<th>Descripcion</th>";
                    echo "<th>Cantidad</th>";
                    echo "<th>Precio</th>";
                    echo "<th>Costo</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            $total = 0;
        while($fila = $resultado->fetch_assoc()){  
            $costo = intval($fila['precio']) * intval($fila['cantidad']);
            $total = intval($total) + intval($costo);
            echo "<tr>";
                echo "<td><img id = \"img2\"src = \"imagenes/".$fila['imagen']."\"</td>";
                echo "<td>".$fila['idProducto']."</td>";
                echo "<td>".$fila['descripcion']."</td>";
                echo "<td>".$fila['cantidad']."</td>";
                echo "<td>".$fila['precio']."</td>";
                echo "<td>".$costo."</td>";
            echo "</tr>";
        }
        echo "<tr><td><b>TOTAL: </b></td><td>$$total</td></tr>";
        echo "</tbody></table>";
        echo "<div id=\"divBoton\">";
            echo "<a href = \"tablaVentas.php\"><button class = \"boton\">Regresar a listado</button></a>";
            echo "<a><button onclick = \"editarVenta($estatus2,$idVenta);\" id = \"boton2\">Editar</button></a>";
        echo "</div>";
    }
?>