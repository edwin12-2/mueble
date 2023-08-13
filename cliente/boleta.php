<?php 
session_start();
include_once 'conectar.php';
$oid=intval($_GET['oid']);
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver pedido</title>
</head>
<body>
    <div>
    <form action="" method="post">
        <table>
            <tr>
                <th>Empresa</th>
            </tr>
            <tr>
                <th>Ruc:878767</th>
            </tr>
            <tr>
                <th>Dirección: jr. a</th>
            </tr>
            <tr>
                <th>Teléfono:</th>
            </tr>
            <tr>
                <th>Correo:</th>
            </tr>
            <tr>
                <th>----------</th>
            </tr>
        </table>
        <table>
            <thead>
            <tr>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
                $queryu = mysqli_query($conn,"select usuarios.nombre as usnombre from pedidos join usuarios 
                on pedidos.usuarioId=usuarios.id where pedidos.id='$oid'");
                while ($rowu=mysqli_fetch_array($queryu)) {
                ?>
                <tr>
                    <td><?php $nombre=$rowu['usnombre']; ?></td>
                </tr>
                <?php } ?>
            <?php
                $query = mysqli_query($conn,"select productos.producto as
                 pnombre,pedidos.productoId as 
                opid,pedidos.cantidad as qty,productos.precio as pprecio,
                productos.costoEnviar as envCosto,pedidos.metodoPago as 
                mPago,pedidos.fechaPedido as pFecha,pedidos.id as 
                pid from pedidos join productos 
                on pedidos.productoId=productos.id where pedidos.id='$oid'");
                $cnt=1;
                while ($row=mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td>Nro. Ticket:</td>
                    <td><?php echo $row['pid']; ?></td>
                </tr>
                <tr>
                    <td>Fecha: </td>
                    <td><?php echo $row['pFecha']; ?></td>
                </tr>
                <tr><td>------------------</td></tr>
                <tr>
                    <td>Cliente: </td>
                    <td><?php echo $nombre; ?></td>
                </tr>
                <tr>
                    <td>Correo: </td>
                    <td><?php echo $nombre; ?></td>
                </tr>
                <tr>
                    <td>Dirección: </td>
                    <td><?php echo $nombre; ?></td>
                </tr>
                <tr>
                    <td><?php $cnt1=$cnt; ?></td>
                    <td>
                        <h4>
                            <?php $producto1=$row['pnombre']; ?>
                        </h4>
                    </td>
                    <td>
                        <?php $cantidad1=$cantidad=$row['qty']; ?>
                    </td>
                    <td><?php $precio1=$precio=$row['pprecio']; ?></td>
                    <td><?php $costo1=$envCosto=$row['envCosto']; ?></td>
                    <td><?php $total=(($cantidad*$precio)+$envCosto); ?></td>
                    <td><?php $pago1=$row['mPago']; ?></td>
                    <td>
                    </td>
                </tr>
                <?php $cnt=$cnt+1;} ?>
            </table>
            <table>
                <thead>
                    <tr>
                        <th>Método de pago</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $pago1; ?></td>
                    </tr>
                </tbody>
            </table>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Envío</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $cnt1; ?></td>
                        <td><?php echo $producto1; ?></td>
                        <td><?php echo $cantidad1; ?></td>
                        <td><?php echo $precio1; ?></td>
                        <td><?php echo $costo1; ?></td>
                        <td><?php echo $total; ?></td>
                    </tr>
                </tbody>
            </table>
            <table>
                <tr><td>¡Gracias por su compra!</td></tr>
            </table>
        </form>
    </div>
</body>
</html>

<?php 
$html=ob_get_clean();
require_once '../administrador/librerias/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);
$dompdf->setPaper(array(0,0,250,900));
$dompdf->render();
$dompdf->stream("archivo.pdf", array("Attachment" => false));
?>