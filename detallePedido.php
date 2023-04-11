<html>
    <script src="../jquery-3.3.1.min.js"></script>
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
    $idPedido = $_REQUEST['idPedido'];
    $query = "SELECT v.fecha,v.idProveedor,c.nombre,v.entregado FROM pedido v JOIN proveedor c ON c.id = v.idProveedor WHERE v.id = '$idPedido'";
    $resultado = $con->query($query);

    if($con->query($query)){
        echo "<table class = 'tabla_datos'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>ID pedido</th>";
                    echo "<th>Fecha</th>  ";
                    echo "<th>ID Proveedor</th>";
                    echo "<th>Proveedor</th>";
                    echo "<th>Estatus</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
        while($fila = $resultado->fetch_assoc()){
            //0 en espera- 1 Entregado
            $estatus = $fila['entregado']; 
            $estatus2 = $estatus;
            //$estatus = ($estatus == '0') ? 'En espera' : ($estatus == '1') ? 'Fabricando' : ($estatus == '2') ? 'Terminado' : 'Entregado';
            if($estatus == '0')
                $estatus = 'En espera';
            else if($estatus == '1')
                $estatus = 'Entregado';
            echo "<tr>";
                echo "<td>".$idPedido."</td>";
                echo "<td>".$fila['fecha']."</td>";
                echo "<td>".$fila['idProveedor']."</td>";
                echo "<td>".$fila['nombre']."</td>";
                echo "<td>".$estatus."</td>";;
            echo "</tr>";
        }
        echo "</tbody></table>";
    }
    else{
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
    
    $query = "SELECT d.idMaterial,d.precio,d.cantidad,p.uniMed,p.descripcion FROM detallepedido d JOIN material p ON d.idMaterial = p.id WHERE d.idPedido = '$idPedido'";
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
                    echo "<th>ID Material</th>  ";
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
                echo "<td>".$fila['idMaterial']."</td>";
                echo "<td>".$fila['descripcion']."</td>";
                echo "<td>".$fila['cantidad'].' '.$fila['uniMed']."</td>";
                echo "<td>".$fila['precio']."</td>"; 
                echo "<td>".$costo."</td>";
            echo "</tr>";
        }
        echo "<tr><td><b>TOTAL: </b></td><td>$ $total</td></tr>";
        echo "</tbody></table>";
        echo "<div id=\"divBoton\">";
            echo "<a href = \"tablaPedidos.php\"><button class = \"boton\">Regresar a listado</button></a>";
            echo "<a href = \"editaPedido.php?idPedido=$idPedido\"><button id = \"boton2\">Marcar como entregado</button></a>";
        echo "</div>";
    }
?>