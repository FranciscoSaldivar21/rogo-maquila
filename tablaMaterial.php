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
        #divBoton{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 50px;
        }
        .boton{
            color: white;
            padding: 5px 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 2px 2px;
            cursor: pointer;
            background-color: #555557;
        }
    </style>
    <head>
        <script src="../jquery-3.3.1.min.js"></script>
        <script>
            $(buscarDatos());
            function buscarDatos(consulta){
                $.ajax({
                    url : "buscarMaterial.php",
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
            </div>
            <div id = "datos">

            </div>
        </section>
        <div id="divBoton">
            <a href = "agregarMaterial.php"><button class = "boton">Nuevo Material</button>
            <a href = "tablaSalidasMaterial.php"><button class = "boton">Ver movimientos</button>
        </div>
    </body>
</html>