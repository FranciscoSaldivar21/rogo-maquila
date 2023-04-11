<html>
    <script>
        function eliminaMaterial(fila){
                if(confirm("¿Estás seguro?")){
                    $.ajax({
                        url : 'eliminaMaterial.php',
                        type : 'post',
                        dataType : 'text', //Tipo de dato que recibe
                        data : 'id='+fila, //Manda el id del material
                        success : function(bandera){
                            if(bandera){
                                window.location.href = 'tablaMaterial.php';
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
    </style>
</html>
<?php
    require "conectaDB.php";
    $con = conecta();

    $salida = "";
    $query = "SELECT * FROM material WHERE eliminado = 0";
    if(isset($_POST['consulta'])){
        $q = $con->real_escape_string($_POST['consulta']); //Palabra a buscar
        $query = "SELECT * FROM material WHERE descripcion LIKE '%".$q."%' OR id LIKE '%".$q."%' OR idProveedor LIKE '%".$q."%'"; 
    }

    $resultado = $con->query($query);

    if($resultado->num_rows > 0){
        $salida.="<table class = 'tabla_datos'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descripcion</th>  
                            <th>ID proveedor</th>
                            <th>Cantidad</th>
                            <th>Precio por unidad</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                <tbody>";
        while($fila = $resultado->fetch_assoc()){
            $id = $fila['id'];
            $salida.="<tr>
                        <td>".$fila['id']."</td>
                        <td>".$fila['descripcion']."</td>
                        <td>".$fila['idProveedor']."</td>
                        <td>".$fila['cantidad'].' '.$fila['uniMed']."</td>
                        <td>".$fila['precio']."</td>
                        <td><a href = \"editaMaterial.php?id=$id\"><img src=\"imagenes/editar.png\"></a></td>
                        <td><a  href = \"\" onclick = eliminaMaterial($id)><img src=\"imagenes/borrar.png\"></a></td>
                    </tr>";
        }
        $salida.="</tbody></table>";
    }else{
        $salida.= "No hay datos";
    }

    echo $salida;
?>