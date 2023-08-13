<?php
session_start();
error_reporting(0);
include('conectar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">

    <title>Pedidos</title>
</head>
<body>
    <header>
        <?php include('includes/encabezado-arriba.php'); ?>
        <?php include('includes/menu-barra.php'); ?>
    </header>
    <div>
    <div class="container">
            <div class="">
                <ul class="list-inline">
                    <li class="">
                        <a class="" href="#">
                            Inicio
                        </a>
                    </li>
                    <li class="active">Pedidos</li>
                </ul>
            </div>
        </div>
    </div>

    <div>
        <div>
            <div>
                <div>
                    <div>
                        <h2>Ver pedido</h2>
                        <span>
                            Ingrese el id
                        </span>
                        <form action="">
                            <div>
                                <label for="">Pedido id</label>
                                <input type="text" name="pedidoid" id="">
                            </div>
                            <div>
                                <label for="">Correo</label>
                                <input type="email" name="correo" id="">
                            </div>
                            <button class="btn btn-primary" type="submit" name="enviar">Ver</button>
                            
                        </form>
                        <div>
                            <a href="pedido-historial.php">Historial</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
