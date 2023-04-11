<html>
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

    $salida = "";
    $query = "SELECT * FROM logmaterial ORDER BY fecha";
    if(isset($_POST['consulta'])){
        $q = $con->real_escape_string($_POST['consulta']); //Palabra a buscar
        $query = "SELECT * FROM logmaterial WHERE fecha LIKE '%".$q."%' OR id LIKE '%".$q."%' OR idMaterial LIKE '%".$q."%'"; 
    }

    $resultado = $con->query($query);

    if($resultado->num_rows > 0){
        $salida.="<table class = 'tabla_datos'>
                    <thead>
                        <tr>
                            <th>ID Movimiento</th>
                            <th>Fecha</th>  
                            <th>ID Material</th>
                            <th>Cantidad actualizada</th>
                            <th>Cantidad antes de actualizar</th>
                        </tr>
                    </thead>
                <tbody>";
        while($fila = $resultado->fetch_assoc()){
            $id = $fila['id'];
            $salida.="<tr>
                        <td>".$fila['id']."</td>
                        <td>".$fila['fecha']."</td>
                        <td>".$fila['idMaterial']."</td>
                        <td>".$fila['cantidad'].' '.$fila['uniMed']."</td>
                        <td>".$fila['cantidadAnterior'].' '.$fila['uniMed']."</td>
                    </tr>";
        }
        $salida.="</tbody></table>";
    }else{
        $salida.= "No hay datos";
    }

    echo $salida;
?>