<html>
    <style>
        #datos{
            text-align: center;
            align-items: center;
            color: white;
        }
        #caja_busqueda{
            background-color: white;
            color: black;
        }
        .forma01{
            text-align: center;
            margin-bottom: 30px; 
        }
        input[type=text]:focus {
            border: 3px solid #fff;
        }
        label{
            color: black;
        }
        .boton{
            color: black;
            padding: 1px 8px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 13px;
            cursor: pointer;
            background-color: #DEDEDE;
            margin-bottom: 20px;
        }
    </style>
    <head>
        <script src="../jquery-3.3.1.min.js"></script>
        <script>
            $(buscarDatos());
            function buscarDatos(consulta){
                $.ajax({
                    url : "buscarCliente.php",
                    type : 'POST',
                    dataType : 'html',
                    data : {consulta : consulta},
                })
                .done(function(respuesta){
                    $("#datos").html(respuesta);
                })
                .fail(function(respuesta){
                    console.log("error");
                })
            }
            $(document).on('keyup', '#caja_busqueda', function(){
                var valor = $(this).val();
                if(valor != ''){
                    buscarDatos(valor);
                }else{
                    buscarDatos();
                }
            });
        </script>
        <title>Materiales</title>
    </head>
    <body>
        <?php include("menuGerente.php"); ?>
        <section class = "principal">
            <div class = "forma01">
                <label for = "caja busqueda">Buscar</label>
                <input type = "text" name = "caja_busqueda" id = "caja_busqueda"></input>
                <a href = "agregarCliente.php"><button class = "boton">Agregar cliente</button></a>
            </div>
            <div id = "datos">

            </div>
        </section>
    </body>
</html>