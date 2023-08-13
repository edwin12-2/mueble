<?php 
session_start();
include_once 'conectar.php';
$oid=intval($_GET['oid']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte pedido</title>
</head>
<body>
    <div>
        <form action="" method="post">
            <table width="100%">
                <tr height="60">
                    <td>
                        <div>
                            <b>Detalles</b>
                        </div>
                    </td>
                </tr>
                <tr height="20">
                    <td><b>Pedido Id:</b></td>
                    <td><?php echo $oid;?></td>
                </tr>
                <?php 
                $ret = mysqli_query($conn,"select * from historiaPedidos where pedidoId='$oid'");
                $num = mysqli_num_rows($ret);
                if ($num>0) {
                    while($row=mysqli_fetch_array($ret)){
                    ?>
                    <tr height="20">
                        <td><b>Fecha:</b></td>
                        <td><?php echo $row['fechaPublicar'];?></td>
                    </tr>
                    <tr height="20">
                        <td><b>Estado:</b></td>
                        <td><?php echo $row['estado'];?></td>
                    </tr>
                    <tr height="20">
                        <td><b>Observación:</b></td>
                        <td><?php echo $row['observar'];?></td>
                    </tr>
                    <tr>
                        <td><hr></td>
                    </tr>
                <?php } } ?>
            </table>
        </form>
    </div>
</body>
</html>