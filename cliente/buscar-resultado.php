<?php
session_start();
error_reporting(0);
include('conectar.php');
$find="%{$_POST['producto']}%";
if (isset($_GET['action']) && $_GET['action']=="add") {
    $id=intval($_GET['id']);
    if (isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id]['cantidad']++;
    }else {
        $sql_p="SELECT * FROM productos WHERE id=productoId AND id={$id}";
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <div>
        <header>
            <?php include('includes/encabezado-arriba.php'); ?>
            <?php include('includes/menu-barra.php'); ?>
        </header>
        <div class="body">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="side">
                            <div class="side">
                                <div class="head">
                                    <i></i>Subcategoría
                                </div>
                                <nav class="yamm">
                                    <ul class="nav">
                                        <li>
                                            <?php 
                                                $sql=mysqli_query($conn,"select id,subcategoria from subcategorias");
                                                while ($row=mysqli_fetch_array($sql)) {
                                            ?>
                                            <a href="sub-categoria.php?scid=<?php echo $row['id']; ?>">
                                                <i class=""></i>
                                                <?php echo $row['subcategoria']; ?>
                                            </a> 
                                            <?php } ?>               
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <h3>Comprar por:</h3>
                        <div class="sidebar">
                            <div class="sidebar">
                                <div class="widget">
                                    <h4>Categoría</h4>
                                </div>
                                <div class="sidebar-widget">
                                    <?php 
                                        $sql=mysqli_query($conn,"select id,categoriaN from categorias");
                                        while ($row=mysqli_fetch_array($sql)) {
                                    ?>
                                    <div class="accordion">
                                        <div class="accordion-group">
                                            <div>
                                                <a href="categoria.php?cid=<?php echo $row['id']; ?>">
                                                    <i class=""></i>
                                                    <?php echo $row['categoriaN']; ?>
                                                </a> 
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>               
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="category">
                        <div class="">
                            <div class="image">
                                <img src="" alt="">
                            </div>
                            <div class="container">
                                <div class="caption">
                                    <div class="big">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="search">
                        <div class="tab">
                            <div class="tab-pane">
                                <div class="category-product">
                                    <div class="row">
                                        <?php 
                                            $ret=mysqli_query($conn,"select * from productos where producto like '$find'");
                                            $num=mysqli_num_rows($ret);
                                            if ($num>0) {
                                                while ($row=mysqli_fetch_array($ret)) {
                                        ?>
                                        <div class="accordion">
                                            <div class="accordion-group">
                                                <div>
                                                    <div>
                                                        <div>
                                                            <a href="producto-detalles.php?pid=<?php echo htmlentities($row['id']); ?>">
                                                                <img src="" data-echo="../administrador/productoImagen/<?php echo htmlentities($row['producto']); ?>/<?php echo htmlentities($row['imagen1']); ?>" width="200" height="200" alt="">
                                                            </a>   
                                                        </div>
                                                    </div>
                                                    <div class="product">
                                                        <h3 class="name">
                                                            <a href="producto-detalles.php?pid=<?php echo htmlentities($row['id']); ?>">
                                                                <?php echo htmlentities($row['producto']); ?>
                                                            </a>
                                                        </h3>
                                                        <div></div>
                                                        <div></div>
                                                        <div>
                                                            <span>
                                                                S/.<?php echo htmlentities($row['precio']); ?>
                                                            </span>                                                                                
                                                            <span>
                                                                S/.<?php echo htmlentities($row['precioAnterior']); ?>
                                                            </span> 
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div>
                                                            <ul>
                                                                <li>
                                                                    <button>
                                                                        <i class="fa fa-shopping-cart"></i>
                                                                    </button>
                                                                    <a href="categoria.php?page=producto&action=add&id=<?php echo $row['id']; ?>">
                                                                        <button>Añadir al carrito</button>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } } else {
                                        ?> 
                                            <div>
                                                <h3>No se encontró ningún producto</h3>
                                            </div>
                                        <?php } ?> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
