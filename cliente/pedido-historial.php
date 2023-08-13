<?php
session_start();
error_reporting(0);
include('conectar.php');
if (strlen($_SESSION['ingresar'])==0) {
    header('location:ingresar.php');
}else {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <script>
        var popUpWin=0;
        function popUpWindow(URLStr, left, top, width, height)
        {
            if (popUpWin) {
                if (!popUpWin.closed) popUpWin.close(); 
            }
            popUpWin=open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,statis=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+400+',height='+600+',left='+left+',top='+top+',screenX='+left+',screenY='+top+'');
        }
    </script>
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
                    <li class="active">Historial</li>
                </ul>
            </div>
        </div>
    </div>

    <div>
        <div>
            <div>
                <div>
                    <div>
                        <div>
                            <form action="" method="post">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Imagen</th>
                                        <th>Producto</th>

                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Envío</th>
                                        <th>Suma total</th>
                                        <th>Método de pago</th>
                                        <th>Fecha</th>
                                        <th>Acción</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
$query = mysqli_query($conn,"select productos.imagen1 as 
pi1,productos.producto as pnombre,pedidos.productoId as 
opid,pedidos.cantidad as qty,productos.precio as pprecio,
productos.costoEnviar as envCosto,pedidos.metodoPago as 
mPago,pedidos.fechaPedido as pFecha,pedidos.id as 
pid from pedidos join productos 
on pedidos.productoId=productos.id where
 pedidos.usuarioId='".$_SESSION['id']."' and
  pedidos.metodoPago is not null");
                                    $cnt=1;
                                    while ($row=mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td>
                                            <a href="">
                                            <img src="../administrador/productoImagen/<?php echo $row['pnombre']; ?>/<?php echo $row['pi1']; ?>"  width="80" height="80" alt="">
                                            </a>
                                        </td>
                                        <td>
                                            <h4>
                                                <a href="producto-detalles.php?pid=<?php echo $row['opid'];?>">
                                                    <?php echo $row['pnombre']; ?>
                                                </a>
                                            </h4>
                                        </td>
                                        <td>
                                            <?php echo $cantidad=$row['qty']; ?>
                                        </td>
                                        <td><?php echo $precio=$row['pprecio']; ?></td>
                                        <td><?php echo $envCosto=$row['envCosto']; ?></td>
                                        <td><?php echo (($cantidad*$precio)+$envCosto); ?></td>
                                        <td><?php echo $row['mPago']; ?></td>
                                        <td><?php echo $row['pFecha']; ?></td>
                                        <td>
                                            <a href="javascript:void(0);" onclick="popUpWindow('pedido-detalles.php?oid=<?php echo htmlentities($row['pid']); ?>');" title="seguir">Seguimiento</a>
                                            <a href="javascript:void(0);" onclick="popUpWindow('boleta.php?oid=<?php echo htmlentities($row['pid']); ?>');">Imprimir</a>
                                        </td>
                                    </tr>
                                    <?php $cnt=$cnt+1;} ?>
                                    </tbody>
                                </table>
                            </form>
                            
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
