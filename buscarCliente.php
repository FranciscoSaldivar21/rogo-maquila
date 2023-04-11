<html>
    <script>
        function eliminaCliente(fila){
                if(confirm("¿Estás seguro?")){
                    $.ajax({
                        url : 'eliminaCliente.php',
                        type : 'post',
                        dataType : 'text', //Tipo de dato que recibe
                        data : 'id='+fila, //Manda el id del material
                        success : function(bandera){
                            if(bandera){
                                window.location.href = 'tablaClientes.php';
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
    $query = "SELECT * FROM clientes WHERE eliminado = 0";
    if(isset($_POST['consulta'])){
        $q = $con->real_escape_string($_POST['consulta']); //Palabra a buscar
        $query = "SELECT * FROM clientes WHERE id LIKE '%".$q."%' OR nombre LIKE '%".$q."%' OR correo LIKE '%".$q."%'"; 
    }

    $resultado = $con->query($query);

    if($resultado->num_rows > 0){
        $salida.="<table class = 'tabla_datos'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>  
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Domicilio</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                <tbody>";
        while($fila = $resultado->fetch_assoc()){
            $id = $fila['id'];
            $salida.="<tr>
                        <td>".$fila['id']."</td>
                        <td>".$fila['nombre']."</td>
                        <td>".$fila['telefono']."</td>
                        <td>".$fila['correo']."</td>
                        <td>".$fila['domicilio']."</td>
                        <td><a href = \"editaCliente.php?id=$id\"><img src=\"imagenes/editar.png\"></a></td>
                        <td><a  href = \"\" onclick = eliminaCliente($id)><img src=\"imagenes/borrar.png\"></a></td>
                    </tr>";
        }
        $salida.="</tbody></table>";
    }else{
        $salida.= "No hay datos";
    }

    echo $salida;
?>