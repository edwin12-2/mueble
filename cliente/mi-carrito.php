<?php
session_start();
error_reporting(0);
include('includes/conectar.php');
if (isset($_POST['enviar'])) {
    if (!empty($_SESSION['carrito'])) {
        foreach ($_POST['cantidad'] as $key => $val) {
            if ($val==0) {
                unset($_SESSION['carrito'][$key]);
            }else {
                $_SESSION['carrito'][$key]['cantidad']=$val;
                $sql="SELECT * FROM `inventario` where `productoId`=$key";
                $res=mysqli_query($conn,$sql);
                $row=mysqli_fetch_assoc($res);
                if ($row['restante'] < $_SESSION['carrito'][$key]['cantidad']) {
                    echo '<script>alert("El elemento restante es '.$row['restante'].'")</script>';
                    $_SESSION['carrito'][$key]['cantidad']=$row['restante'];
                    echo '<script>window.location="mi-carrito.php"</script>';
                }
            }
        }
        echo "<script>alert('Su carrito se actualizó');</script>";
    }
}
if (isset($_POST['remover_cod'])) {
    if (!empty($_SESSION['carrito'])) {
        foreach ($_POST['remover_cod'] as $key) {
            unset($_SESSION['carrito'][$key]);
        }
        echo "<script>alert('Su carrito se actualizó');</script>";
    }
}
if (isset($_POST['pedidoenv'])) {
    if (strlen($_SESSION['ingresar'])==0) {
        header('location:ingresar.php');
    }else {
        $cantidad=$_POST['cantidad'];
        $pdd=$_SESSION['pid'];
        $enviarA=$_POST['enviarA'];
        $facturarA=$_POST['facturarA'];
        $value=array_combine($pdd,$cantidad);
        $sql= "UPDATE `usuarios` set `enviarA`='{$enviarA}',`facturarA`='{$enviarA}' where `id`=".$_SESSION['id'];        
        mysqli_query($conn,$sql);
        foreach ($value as $qty => $val34) {
            mysqli_query($conn,"insert into pedidos(usuarioId,productoId,cantidad,pedidoEstado) values('".$_SESSION['id']."','$qty','$val34','Pendiente')");
            header('location:pago-metodo.php');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi carrito</title>
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
                    <li class="active">Carrito</li>
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
                                <?php
                                if (!empty($_SESSION['carrito'])) {
                                ?>
                                <div>
                                    <table class="datatable-1 table">
                                        <thead>
                                            <tr>
                                                <th>Remover</th>
                                                <th>Imagen</th>
                                                <th>Nombre producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Costo envío</th>
                                                <th>Suma total</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <td>
                                                    <div>
                                                        <span>
                                                            <a href="index.php">Seguir comprando</a>
                                                            <input type="submit" name="enviar" value="Actualizar">
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>   
                                        <tbody>
                                            <?php
                                            $pdtid=array();
                                            $sql="SELECT * FROM productos WHERE id IN(";
                                            foreach ($_SESSION['carrito'] as $id => $value) {
                                                $sql .=$id. ",";
                                            }
                                            $sql=substr($sql,0,-1) . ") ORDER BY id ASC";
                                            $query=mysqli_query($conn,$sql);
                                            $preciototal=0;
                                            $cantidadtotal=0;
                                            if (!empty($query)) {
                                                while ($row=mysqli_fetch_array($query)) {
                                                    $cantidad=$_SESSION['carrito'][$row['id']]['cantidad'];
                                                    $subtotal=$_SESSION['carrito'][$row['id']]['cantidad']*$row['precio']+$row['costoEnviar'];
                                                    $preciototal+=$subtotal;
                                                    $_SESSION['qnty']=$cantidadtotal+=$cantidad;
                                                    array_push($pdtid,$row['id']);
                                            ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="remover_cod[]" value="<?php echo htmlentities($row['id']);?>">
                                                </td>
                                                <td>
                                                    <a href="">
                                                        <img src="../administrador/productoImagen/<?php echo $row['producto']; ?>/<?php echo $row['imagen1']; ?>"  width="114" height="114" alt="">
                                                    </a>
                                                </td>
                                                <td>
                                                    <h4>
                                                        <a href="producto-detalles.php?pid=<?php echo htmlentities($pd=$row['id']); ?>">
                                                            <?php echo $row['producto']; 
                                                            $_SESSION['sid']=$pd;
                                                            ?>
                                                        </a>                                                
                                                    </h4>
                                                    <div>
                                                        <div>
                                                            <div></div>
                                                        </div>
                                                        <div>
                                                            <?php 
                                                                $rt=mysqli_query($conn,"select * from productosR ");
                                                                $num=mysqli_num_rows($rt); 
                                                                {
                                                            ?>
                                                            <div>
                                                                ( <?php echo htmlentities($num); ?>
                                                                Reseñas )
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <div>
                                                            <div>
                                                                <span>
                                                                    <i></i>
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span>
                                                                    <i></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <input type="text" value="<?php echo $_SESSION['carrito'][$row['id']]['cantidad']; ?>" name="cantidad[<?php echo $row['id']; ?>]">
                                                    </div>
                                                </td>
                                                <td>
                                                    <span>
                                                        <?php echo "s/."." ".$row['precio'];?>
                                                        .00
                                                    </span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <?php echo "s/."." ".$row['costoEnviar'];?>
                                                        .00
                                                    </span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <?php echo ($_SESSION['carrito'][$row['id']]['cantidad']*$row['precio']+$row['costoEnviar']);?>
                                                        .00
                                                    </span>
                                                </td>
                                            </tr>
                                            <?php } }
                                            $_SESSION['pid']=$pdtid;
                                            ?>
                                        </tbody>                                
                                    </table>
                                </div>
                                <div>
                                    <table class="datatable-1 table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <span>
                                                        Dir. de envío
                                                    </span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div>
                                                        <?php 
                                                            $qry=mysqli_query($conn,"select * from usuarios where id='".$_SESSION['id']."'");
                                                            $rt=mysqli_fetch_assoc($qry);
                                                            if ($rt['enviarA']=='') {
                                                                echo '<textarea name="enviarA" required></textarea>';
                                                            }else {
                                                                echo htmlentities($rt['enviarA'])."<br>";
                                                                echo htmlentities($rt['enviarCiudad'])."<br>";
                                                                echo htmlentities($rt['enviarEstado']);
                                                                echo htmlentities($rt['enviarPostal']);
                                                            }
                                                        ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>                                
                                    </table>
                                </div>
                                <div>
                                    <table class="datatable-1 table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <span>
                                                        Dir. permanente
                                                    </span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div>
                                                        <?php 
                                                            $qry=mysqli_query($conn,"select * from usuarios where id='".$_SESSION['id']."'");
                                                            $rt=mysqli_fetch_assoc($qry);
                                                            if ($rt['enviarA']=='') {
                                                                echo '<textarea name="facturarA" required></textarea>';
                                                            }else {
                                                                echo htmlentities($rt['facturarA'])."<br>";
                                                                echo htmlentities($rt['facturarCiudad'])."<br>";
                                                                echo htmlentities($rt['facturarEstado']);
                                                                echo htmlentities($rt['facturarPostal']);
                                                            }
                                                        ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>                                
                                    </table>
                                </div>
                                <div>
                                    <table class="datatable-1 table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div>
                                                        Suma total:
                                                        <span>
                                                            <?php echo $_SESSION['tp']="$preciototal". ".00"; ?>
                                                        </span>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div>
                                                        <button class="btn btn-primary" type="submit" name="pedidoenv">
                                                            Pasar a la caja
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>                                
                                    </table>
                                </div>
                                <?php }else {
                                    echo "Su cesta está vacía";
                                } ?>
                            </form>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

