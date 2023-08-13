<?php
session_start();
error_reporting(0);
include('conectar.php');
if (strlen($_SESSION['ingresar'])==0) {
    header('location:ingresar.php');
}else {
    if (isset($_POST['enviar'])) {
        mysqli_query($conn,"update pedidos set metodoPago='".$_POST['pago']."' where usuarioId='".$_SESSION['id']."' and metodoPago is null");
        unset($_SESSION['carrito']);
        header('location:pedido-historial.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago</title>
    <link rel="stylesheet" href="bootstrap.min.css">

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
                    <li class="active">Pago</li>
                </ul>
            </div>
        </div>
    </div>

    <div>
        <div>
            <div>
                <div>
                    <div>
                        <h2></h2>
                        <div>

                            <div>
                                <div>
                                    <h4>
                                        <a href="">
                                            
                                        </a>
                                    </h4>
                                </div>
                                <div>
                                    <div>
                                        <div>
                                            <form method="post">
                                                <input type="text" name="pago" value="Tarjeta">
                                                <input type="submit" name="enviar" class="btn">
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

<?php } ?>
