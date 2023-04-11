<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    @$usuario=$_SESSION['usuario'];
    @$nombre=$_SESSION['nombre'];
    @$cargo=$_SESSION['cargo'];

    if (!$_SESSION['usuario']){
        echo "<script>location.href='loginFront.php';</script>";
    }
?>
<html lang="es">
    <head>
        <title>Menu de navegacion</title>
        <meta charset="UTF-8">
        <style>
            *{
                margin: 0;
                padding: 0;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }

            body{
                background: #E9E9E9;
            }

            header{
                width: 100%;
            }

            .navegacion{
                width: 900px;
                margin: 30px auto;
                background: #fff;
            }

            .navegacion ul{
                list-style: none;
            }

            .menu > li{
                position: relative;
                display: inline-block;
            }

            .menu > li > a{
                display: block;
                padding: 15px 20px;
                color: #353535;
                font-family: 'Open sans';
                text-decoration: none;
            }

            .menu li a:hover{
                color: #CE7D35;
                transition: all .3s;
            }

            /* Submenu*/

            .submenu{
                position: absolute;
                background: #333333;
                width: 120%;
                visibility: hidden;
                opacity: 0;
                transition: opacity 1.5s;
            }

            .submenu li a{
                display: block;
                padding: 15px;
                color: #fff;
                font-family: 'Open sans';
                text-decoration: none;
            }

            .menu li:hover .submenu{
                visibility: visible;
                opacity: 1;
            }
            .imagenes{
                width: 32px;
                height: 35px;
            }
        </style>
    </head>
    <body>
        <header>
                <nav class="navegacion">
                    <ul class = "menu">
                        <li><a href='inicioGerente.php'><img class = "imagenes" title = "Inicio" src="imagenes/home.png"></a></li>
                        <li><a href='tablaProductos.php'><img class = "imagenes" title = "Productos" src="imagenes/playera.png"></a>
                            <ul class="submenu">
                                <li><a href = 'tablaProductos.php'>Mostrar productos</a></li>
                                <li><a href = 'agregaProducto.php'>Agregar producto</a></li>
                            </ul>
                        </li>
                        <li><a href='tablaVentas.php'><img class = "imagenes" title = "Ventas" src="imagenes/venta.png"></a>
                            <ul class="submenu">
                                <li><a href = 'tablaVentas.php'>Mostrar ventas</a></li>
                                <li><a href = 'agregarVenta.php'>Agregar venta</a></li>
                            </ul> 
                        </li>
                        <li><a href='tablaClientes.php'><img class = "imagenes" title = "Clientes" src="imagenes/clientes.png"></a>
                            <ul class="submenu">
                                <li><a href = 'tablaClientes.php'>Mostrar clientes</a></li>
                                <li><a href = 'agregarCliente.php'>Agregar cliente</a></li>
                            </ul>
                        </li>
                        <li><a href='tablaPedidos.php'><img class = "imagenes" title = "Pedidos" src="imagenes/pedido.png"></a>
                            <ul class="submenu">
                                <li><a href = 'tablaPedidos.php'>Mostrar pedidos</a></li>
                                <li><a href = 'agregarPedido.php'>Agregar pedido</a></li>
                            </ul>
                        </li>
                        <li><a href='tablaProveedor.php'><img class = "imagenes" title = "Proveedores" src="imagenes/proveedor.png"></a>
                            <ul class="submenu">
                                <li><a href = 'tablaProveedor.php'>Mostrar proveedores</a></li>
                                <li><a href = 'agregarProveedor.php'>Agregar proveedor</a></li>
                            </ul>
                        </li>
                        <li><a href='tablaMaterial.php'><img class = "imagenes" title = "Materiales" src="imagenes/materiales.png"></a>
                            <ul class="submenu">
                                <li><a href = 'tablaMaterial.php'>Mostrar materiales</a></li>
                                <li><a href = 'agregarMaterial.php'>Agregar material</a></li>
                            </ul>
                        </li>
                        <li><a href='mostrarUsuarios.php'><img class = "imagenes" title = "Usuarios" src="imagenes/usuarios.png"></a>
                            <ul class="submenu">
                                <li><a href = 'mostrarUsuarios.php'>Mostrar usuarios</a></li>
                                <li><a href = 'agregarUsuario.php'>Agregar usuario</a></li>
                            </ul>
                        </li>
                        <li><a href='cerrarSesion.php'><img class = "imagenes" title = "Cerrar sesion" src="imagenes/cerrarSesion.png"></a></li>
                        <?php echo "<li><a>$nombre</a></li>"; ?>
                        <li><img class = "imagenes" title = "ROGO" src="imagenes/rogo.jpeg"></li>
                    </ul>
                </nav>
            </div>
        </header>

    </body>
</html>