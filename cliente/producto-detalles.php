<?php
session_start();
error_reporting(0);
include('conectar.php');
if (isset($_POST['guardarcar'])) {
    if (isset($_GET['ac']) && $_GET['ac']=="add") {
        $id=intval($_GET['id']);
        $r_qty=$_POST['cantidad'];
        if (isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id]['cantidad']+=$r_qty;
            $sql="SELECT * FROM inventario WHERE productoId=$id";
            $res=mysqli_query($conn,$sql);
            $row=mysqli_fetch_array($res);
            if ($row['restante'] < $_SESSION['carrito'][$id]['cantidad']) {
                echo '<script>alert("No hay productos. El restane es'.$row['restante'].' se añadirá")</script>';
                $_SESSION['carrito'][$id]['cantidad']=$row['restante'];
                echo '<script>window.location="producto-detalles.php?pid='.$id.'"</script>';
            }
        }else {
            $sql_p="SELECT * FROM productos p,inventario i WHERE id=productoId AND id={$id} AND restante > 0";
            $query_p=mysqli_query($conn,$sql_p);
            if (mysqli_num_rows($query_p)!=0) {
                $row_p=mysqli_fetch_array($query_p);
                $_SESSION['carrito'][$row_p['id']]=array("cantidad" => $r_qty, "precio" => $row_p['precio']);
                header('location:mi-carrito.php');
            }else {
                $mensaje="El id no es válido";
            }
        }
    }
}
$pid=intval($_GET['pid']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="owl.carousel.css">

</head>
<body>
    <header>
        <?php include('includes/encabezado-arriba.php'); ?>
        <?php include('includes/menu-barra.php'); ?>
    </header>
    <div class="container">
        <div>
            <div class="">
                <div>
                    <?php 
                        $ret=mysqli_query($conn,"select categorias.categoriaN as catnombre,subCategorias.subcategoria as subcatnombre,productos.producto as pnombre from productos join categorias on categorias.id=productos.categoria join subcategorias on subcategorias.id=productos.subCategoria where productos.id='$pid'");
                        while ($rw=mysqli_fetch_array($ret)) {
                    ?>
                    <ul>
                        <li><a href="index.phhp">Inicio</a></li>
                        <li><?php echo htmlentities($rw['catnombre']); ?></li>
                        <li><?php echo htmlentities($rw['subcatnombre']); ?></li>
                        <li><?php echo htmlentities($rw['pnombre']); ?></li>
                    </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div>
            <div>
                <div>
                    <div>
                        <div>
                            <div>
                                <h3>Categoría</h3>
                                <div>
                                    <div>
                                        <?php 
                                            $sql=mysqli_query($conn,"select id,categoriaN from categorias");
                                            while ($row=mysqli_fetch_array($sql)) {
                                        ?>
                                            <div>
                                                <div>
                                                    <a href="">
                                                        <?php echo $row['categoriaN']; ?>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="LAS MEJORES OFERTAS"></h3>
                            
                            </div>
                        </div>
                    </div>
                    <?php 
                        $ret=mysqli_query($conn,"select * from productos where id='$pid'");
                        while ($row=mysqli_fetch_array($ret)) {
                    ?>
                    <div class="col-md-9">
                        <div id="owl-single-p" class="">
                            <div class="single-p">
                                <a data-title="<?php echo htmlentities($row['producto']); ?>" href="../administrador/productoImagen/<?php echo htmlentities($row['producto']); ?>/<?php echo htmlentities($row['imagen1']); ?>">
                                    <img src="" data-echo="../administrador/productoImagen/<?php echo htmlentities($row['producto']); ?>/<?php echo htmlentities($row['imagen1']); ?>" width="250" height="250" alt="">
                                </a>
                            </div>
                            <div class="single-p-gallery-item">
                                <a data-title="<?php echo htmlentities($row['producto']); ?>" href="../administrador/productoImagen/<?php echo htmlentities($row['producto']); ?>/<?php echo htmlentities($row['imagen1']); ?>">
                                    <img src="" data-echo="../administrador/productoImagen/<?php echo htmlentities($row['producto']); ?>/<?php echo htmlentities($row['imagen1']); ?>" width="250" height="250" alt="">
                                </a>
                            </div>
                            <div class="single-p-gallery-item">
                                <a data-title="" href="../administrador/productoImagen/<?php echo htmlentities($row['producto']); ?>/<?php echo htmlentities($row['imagen2']); ?>">
                                    <img src="" data-echo="../administrador/productoImagen/<?php echo htmlentities($row['producto']); ?>/<?php echo htmlentities($row['imagen2']); ?>" width="250" height="250">
                                </a>
                            </div>
                            <div class="single-p-gallery-item">
                                <a data-title="" href="../administrador/productoImagen/<?php echo htmlentities($row['producto']); ?>/<?php echo htmlentities($row['imagen3']); ?>">
                                    <img src="" data-echo="../administrador/productoImagen/<?php echo htmlentities($row['producto']); ?>/<?php echo htmlentities($row['imagen3']); ?>" width="250" height="250">
                                </a>
                            </div>
                        </div>
                        <div class="gallery-thumbs">
                            <div>
                                <div>
                                    <a data-title="" href="">
                                        <img src="" data-echo="../administrador/productoImagen/<?php echo htmlentities($row['producto']); ?>/<?php echo htmlentities($row['imagen1']); ?>" width="85" height="85">
                                    </a>
                                </div>

                                <div>
                                    <a data-title="" href="">
                                        <img src="" data-echo="../administrador/productoImagen/<?php echo htmlentities($row['producto']); ?>/<?php echo htmlentities($row['imagen2']); ?>" width="85" height="85">
                                    </a>
                                </div>
                                <div>
                                    <a data-title="" href="">
                                        <img src="" data-echo="../administrador/productoImagen/<?php echo htmlentities($row['producto']); ?>/<?php echo htmlentities($row['imagen3']); ?>" width="85" height="85">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div>
                                <h1>
                                    <?php echo htmlentities($row['producto']); ?>
                                </h1>
                                <div>
                                    <div>
                                        <span>
                                            Disponibilidad:
                                        </span>
                                    </div>
                                    <div>
                                        <span>
                                            <?php echo htmlentities($row['disponibilidad']); ?>
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <span>
                                            Empresa:
                                        </span>
                                    </div>
                                    <div>
                                        <span>
                                            <?php echo htmlentities($row['empresa']); ?>
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <span>
                                            Costo envío:
                                        </span>
                                    </div>
                                    <div>
                                        <span>
                                            <?php if($row['costoEnviar']==0){
                                                echo "Fre";
                                            }else {
                                                echo htmlentities($row['costoEnviar']);
                                            } ?>
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <span>
                                            S/.<?php echo htmlentities($row['precio']); ?>
                                        </span>
                                        <span>
                                            S/.<?php echo htmlentities($row['precioAnterior']); ?>
                                        </span>
                                    </div>
                                </div>

                                <form action="">
                                    <div>
                                        <span>
                                            Cantidad:
                                        </span>
                                    </div>
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
                                    <input type="text" value="1" name="cantidad">
                                    <button class="btn btn-primary" type="submit" name="guardarcar"></button>
                                </form>
                                <div>
                                    <div>
                                        <h2>
                                            Descripción:
                                        </h2>
                                    </div>
                                    <div>
                                        <p>
                                            <?php echo $row['describir']; ?>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <?php 
                        $cid=$row['categoria'];
                        $subcid=$row['subcategoria'];
                    } ?>
                    <section class="section fadeInUp">
                        <h3>Productos relacionados</h3>
                        <div>
                            <?php 
                                $qry=mysqli_query($conn,"select * from productos where subcategoria='$subcid' and categoria='$cid'");
                                while ($rw=mysqli_fetch_array($qry)) {
                            ?>
                                <div>
                                    <div>
                                        <div>
                                            <div>
                                                <a href="producto-detalles.php?pid=<?php echo htmlentities($rw['id']); ?>">
                                                    <img src="" data-echo="../administrador/productoImagen/<?php echo htmlentities($rw['producto']); ?>/<?php echo htmlentities($rw['imagen1']); ?>" width="150" height="150" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div>
                                            <h3>
                                                <a href="producto-detalles.php?pid=<?php echo htmlentities($rw['id']); ?>">
                                                    <?php echo htmlentities($rw['producto']); ?>
                                                </a>
                                            </h3>
                                            <div>
                                                <span>
                                                    S/.<?php echo htmlentities($rw['precio']); ?>
                                                </span>
                                                <span>
                                                    S/.<?php echo htmlentities($rw['precioAnterior']); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <button>
                                                            <i></i>
                                                        </button>
                                                        <a href="producto-detalles.php?page=producto&action=add&id=<?php echo $rw['id']; ?>">
                                                            Añadir al carrito
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
<script src="../assets/js/jquery-1.11.1.min.js"></script>
<script src="../assets/js/owl.carousel.min.js"></script>
<script src="../assets/js/echo.min.js"></script>
<script src="../assets/js/scripts.js"></script>

</body>
</html>
