<?php 
session_start();
include('conectar.php');

if (strlen($_SESSION['adingresar'])==0) {
    header('location:index.php');
}else {
    $oid=intval($_GET['oid']);
if (isset($_POST['enviar2'])) {
    $estado=$_POST['estado'];
    $re=$_POST['remarcar'];
    $query=mysqli_query($conn,"insert into historiaPedidos(pedidoId,estado,observar) values('$oid','$estado','$re')");
    $sql=mysqli_query($conn,"update pedidos set pedidoEstado='$estado' where id='$oid'");
    switch ($estado) {
        case 'Entregado':
            $sql="SELECT * FROM `pedidos` where `id`='$oid'";
            $res=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($res);
            $cantidad=$row['cantidad'];
            $productoId=$row['productoId'];
            $sql= "UPDATE `inventario` set `salidaExistencia`=`salidaExistencia` + '$cantidad' , restante=restante-'$cantidad' where `productoId`='$productoId'";        
            mysqli_query($conn,$sql);
            $sql= "SELECT * FROM `inventario` where `productoId`=$productoId";        
            $res=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($res);
            if ($row['restante']<1) {
                $sql= "UPDATE `productos` set `disponibilidad`=`Fuera de Stock` where `id`=$productoId";        
                mysqli_query($conn,$sql);
            }
            break;
            default;
            break;
    }
    echo "<script>alert('Pedido actualizado');</script>";
}
?>
    <script>
        var popUpWin=0;
        function f2() {
            window.close();
        }ser
        function f3() {
            window.print();
        }
    </script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido</title>

</head>
<body>
    <div style="margin-left: 50px;">
        <form name="actualizarboleta" id="actualizarboleta" method="post">
            <table width="100%" ccellspacing="0" cellpadding="0">
                <tr height="50">
                    <td colspan="2" style="padding-left:0px">
                        <div>
                            <b>Actualización</b>
                        </div>
                    </td>
                </tr>
                <tr height="30">
                    <td>
                        <b>Pedido id:</b>
                    </td>
                    <td>
                        <?php echo $oid; ?>
                    </td>
                </tr>

                <?php
                    $ret=mysqli_query($conn,"SELECT * FROM historiaPedidos where pedidoId=$oid");
                    while ($row=mysqli_fetch_array($ret)) {
                ?>

                <tr height="20">
                    <td><b>Fecha:</b></td>
                    <td>
                    <?php echo $row['fechaPublicar']; ?>
                    </td>
                </tr>
                <tr height="20">
                    <td><b>Estado::</b></td>
                    <td>
                    <?php echo $row['estado']; ?>
                    </td>
                </tr>
                <tr height="20">
                    <td><b>Observación:</b></td>
                    <td>
                    <?php echo $row['observar']; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
                <?php } ?>
                <?php 
                    $st='Entregado';
                    $rt=mysqli_query($conn,"SELECT * FROM pedidos where id=$oid");
                    while ($num=mysqli_fetch_array($rt)) {
                        $currentSt=$num['pedidoEstado'];
                    }
                    if ($st==$currentSt) {
                ?>
                    <tr>
                        <td colspan="2"><b>Producto entregado</b></td>
                    </tr>

                <?php }else {
                ?>

                <tr height="50">
                    <td>Estado:</td>
                    <td>
                        <span>
                            <select name="estado" id="" required="required">
                                <option value="">Seleccionar</option>
                                <option value="En proceso">En proceso</option>
                                <option value="Entregado">Entregado</option>
                                <option value="Rechazado">Rechazado</option>
                            </select>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Observación:</td>
                    <td>
                        <span>
                            <textarea name="remarcar" id="" cols="50" rows="7" required="required">

                            </textarea>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="enviar2" value="Actualizar" size="40" style="cursor: pointer;">&nbsp;&nbsp;
                        <input type="submit" name="Enviar2" value="Cerrar" onClick="return f2();" style="cursor: pointer;">
                    </td>
                </tr>
                <?php } ?>

            </table>
        </form>
    </div>

</body>
</html>

<?php } ?>
