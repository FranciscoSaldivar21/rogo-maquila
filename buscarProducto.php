<html>
    <script>
        function eliminaProducto(fila){
                if(confirm("¿Estás seguro?")){
                    $.ajax({
                        url : 'eliminaProductos.php',
                        type : 'post',
                        dataType : 'text', //Tipo de dato que recibe
                        data : 'idProducto='+fila,
                        success : function(bandera){
                            if(bandera){
                                window.location.href = 'tablaProductos.php';
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
        #img2{
            width: 60px;
            height: 60px;
            margin: 5px;
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
    $query = "SELECT * FROM productos WHERE eliminado = 0 ORDER BY id";
    if(isset($_POST['consulta'])){
        $q = $con->real_escape_string($_POST['consulta']); //Palabra a buscar
        $query = "SELECT * FROM productos WHERE eliminado = 0 AND descripcion LIKE '%".$q."%' OR id LIKE '%".$q."%'"; 
    }

    $resultado = $con->query($query);

    if($resultado->num_rows > 0){
        $salida.="<table class = 'tabla_datos'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descripcion</th>  
                            <th>Precio</th>
                            <th>Imagen</th>
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
                        <td>".$fila['precio']."</td>
                        <td><img id = \"img2\" src = \"imagenes/".$fila['imagen']."\"></td>
                        <td><a href = \"editaProducto.php?id=$id\"><img src=\"imagenes/editar.png\"></a></td>
                        <td><a  href = \"\" onclick = eliminaProducto($id)><img src=\"imagenes/borrar.png\"></a></td>
                    </tr>";
        }
        $salida.="</tbody></table>";
    }else{
        $salida.= "No hay datos";
    }

    echo $salida;
?>